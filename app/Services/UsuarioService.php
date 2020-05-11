<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\DefinirSenha;
use App\Models\User;
use App\Traits\Usuario as UsuarioTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
    public function findAll(): array
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

    /**
     * Cria um novo usuário
     *
     * @param Request $request
     * @return array
     */
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

            throw_if(!$usuario, \Exception::class, 'Não foi possível criar o usuário!', 500);

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
    public function findById(int $id): array
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

    /**
     * Atualiza os dados do usuário.
     *
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function update(int $id, Request $request): array
    {
        DB::beginTransaction();

        try {
            $usuario = User::find($id);

            throw_if(
                !$usuario, \Exception::class, 'Usuário não encontrado!', 404
            );

            $pessoa = $usuario->pessoa;

            $this->updatePessoa($pessoa->id, $request);

            $usuario = tap($usuario)->update([
                'email' => $request->email ??= $usuario->email,
                'status' => $request->status ??= $usuario->status
            ])->fresh();

            $this->perfilByIdsSync($usuario, $request->perfis ??= $usuario->perfis->toArray());

            DB::commit();

            return [
                'success' => true,
                'data' => $usuario,
                'message' => 'Usuário atualizado com sucesso!',
                'code' => 200
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
     * Define a senha do usuário.
     *
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function setPassword(int $id, Request $request): array
    {
        DB::beginTransaction();

        try {
            $usuario = User::find($id);

            throw_if(
                !$usuario, \Exception::class, 'Usuário não encontrado!', 404
            );

            $this->validateEmailAndToken($usuario, $request);

            $usuario = tap($usuario)->update([
                'senha' => Hash::make($request->senha),
                'status' => 'A'
            ])->fresh();

            DB::commit();

            return [
                'success' => true,
                'data' => $usuario,
                'message' => 'Senha de usuário definida com sucesso!',
                'code' => 200
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
     * Atualiza o status do usuário.
     *
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function setStatus(int $id, Request $request): array
    {
        DB::beginTransaction();

        try {
            $usuario = User::find($id);

            throw_if(
                !$usuario, \Exception::class, 'Usuário não encontrado!', 404
            );

            $usuario = tap($usuario)->update([
                'status' => $request->status
            ])->fresh();

            DB::commit();

            return [
                'success' => true,
                'data' => $usuario,
                'message' => 'Status de usuário atualizado com sucesso!',
                'code' => 200
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
}
