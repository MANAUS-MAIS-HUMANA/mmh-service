<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\DefinirSenha;
use App\Models\User;
use App\Traints\Usuario as UsuarioTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsuarioService
{
    use UsuarioTrait;

    /**
     * Retorna a lista de usuários
     *
     * @return array
     */
    public function getAll(): array
    {
        try {
            $usuarios = User::all();

            throw_if(!$usuarios, \Exception::class, 'Não foram encontrados usuários!', 404);

            return [
                'success' => true,
                'data' => $usuarios,
                'message' => 'Usuários encontrados!',
                'code' => 200
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
    }

    public function create(Request $request): array
    {
        DB::beginTransaction();

        try {
            $pessoa = $this->createPessoa($request);

            $usuario = User::create([
                'pessoa_id' => $pessoa->id,
                'email' => $request->email,
                'senha' => Str::random(60),
                'status' => 'I'
            ]);

            throw_if(!$usuario, \Exception::class, 'Não foi criar o usuário!', 500);

            $this->perfilByIdsAttach($usuario, $request->perfis);

            Mail::to($usuario->email)
                ->locale('pt-BR')
                ->send(new DefinirSenha($usuario));

            DB::commit();

            return [
                'success' => true,
                'data' => $usuario,
                'message' => 'Usuário criado com sucesso!',
                'code' => 201
            ];
        } catch (\Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
    }

    /**
     * Retorna o usuário pelo Id.
     *
     * @param int $id
     * @return array
     */
    public function getById(int $id): array
    {
        try {
            $usuario = User::find($id);

            throw_if(!$usuario, \Exception::class, 'Usuário não encontrado!', 404);

            return [
                'success' => true,
                'data' => $usuario,
                'message' => 'Usuário encontrado!',
                'code' => 200
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode()
            ];
        }
    }
}
