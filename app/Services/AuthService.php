<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pessoa;
use App\Models\RedefinirSenha;
use App\Models\User;
use App\Mail\RedefinirSenha as RedefinirSenhaMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    /**
     * @var PessoaService
     */
    private PessoaService $pessoaService;

    /**
     * @var UsuarioService
     */
    private UsuarioService $usuarioService;

    /**
     * AuthService constructor.
     * @param PessoaService $pessoaService
     * @param UsuarioService $usuarioService
     */
    public function __construct(PessoaService $pessoaService, UsuarioService $usuarioService)
    {
        $this->pessoaService = $pessoaService;
        $this->usuarioService = $usuarioService;
    }

    /**
     * Cria o usuário
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            $pessoa = $this->createPessoa($request);

            $usuario = User::create([
                'email' => $request->email,
                'senha' => Hash::make($request->senha),
                'pessoa_id' => $pessoa->id,
            ]);

            throw_if($usuario, \Exception::class, 'Não foi possível criar o usuaŕio!', 500);

            $this->perfisAttach($usuario, $request->perfis);

            DB::commit();

            auth()->login($usuario);

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
                'code' => $e->getCode(),
            ];
        }
    }

    /**
     * Registra a solicitação de recuperação de senha
     *
     * @param Request $request
     * @return array
     */
    public function passwordReset(Request $request): array
    {
        DB::beginTransaction();

        try {
            $usuario = $this->getUsuarioByEmail($request);

            $pwdReset = RedefinirSenha::create([
                'user_id' => $usuario->id,
                'email' => $usuario->email,
                'token' => Str::random(60),
                'validade' => now()->addDay(),
            ]);

            throw_if(!$pwdReset, \Exception::class, 'Não foi possível solicitador a recuperação da senha!', 500);

            Mail::to($pwdReset->email)->locale('pt-BR')->send(new RedefinirSenhaMail($usuario, $pwdReset));

            DB::commit();

            return [
                'success' => true,
                'data' => $pwdReset,
                'message' => 'Recuperação de Senha solicitada com sucesso!',
                'code' => 200,
            ];
        } catch (\Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    /**
     * Solicita a criação de Pessoa
     *
     * @param Request $request
     * @return Pessoa
     * @throws \Throwable
     */
    private function createPessoa(Request $request): Pessoa
    {
        $pessoa = $this->pessoaService->create($request);

        throw_if(!$pessoa['success'] ??= [], \Exception::class, $pessoa['message'], $pessoa['code']);

        return $pessoa['data'];
    }

    /**
     * Associa o usuário ao perfil
     *
     * @param User $user
     * @param array $perfis
     */
    private function perfisAttach(User $user, array $perfis): void
    {
        $user->perfis()->attach(data_get($perfis, '*.id'));
    }

    /**
     * Retorna o usuário pelo E-mail
     *
     * @param Request $request
     * @return User
     * @throws \Throwable
     */
    private function getUsuarioByEmail(Request $request): User
    {
        $usuario = $this->usuarioService->getUsuarioByEmail($request);

        throw_if(!$usuario['data'] ??= [], \Exception::class, $usuario['message'], $usuario['code']);

        return $usuario['data'];
    }
}
