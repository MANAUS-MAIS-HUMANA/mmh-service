<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\RedefinirSenha as RedefinirSenhaMail;
use App\Models\Pessoa;
use App\Models\RedefinirSenha;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UsuarioService
{
    /**
     * @var PessoaService
     */
    private PessoaService $pessoaService;

    /**
     * AuthService constructor.
     * @param PessoaService $pessoaService
     */
    public function __construct(PessoaService $pessoaService)
    {
        $this->pessoaService = $pessoaService;
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
                'pessoa_id' => $pessoa->id,
                'email' => $request->email,
                'password' => Hash::make($request->senha),
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
                'validade' => now()->addDay()
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
     * Redefine a senha de usuário
     *
     * @param Request $request
     * @return array
     */
    public function confirmPasswordReset(Request $request): array
    {
        DB::beginTransaction();

        try {
            $pwdReset = RedefinirSenha::whereToken($request->token)
                ->whereDate('validade', '>', now())
                ->whereStatus('A')
                ->latest()
                ->first();

            throw_if(!$pwdReset, \Exception::class, 'Não foi possível redefinir a senha do usuaŕio!', 500);

            $pwdReset->update([
                'status' => 'I'
            ]);

            $usuario = $pwdReset->usuario;

            $usuario->update([
                'password' => Hash::make($request->senha)
            ]);

            DB::commit();

            auth()->login($usuario);

            return [
                'success' => true,
                'data' => $usuario,
                'message' => 'Senha de usuário redefinida com sucesso!',
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
     * @throws \Exception
     */
    private function getUsuarioByEmail(Request $request): User
    {
        try {
            $usuario = User::whereEmail($request->email)
                ->first();

            throw_if(!$usuario, \Exception::class, 'Usuário não encontrado!', 404);

            return $usuario;
        } catch (\Throwable $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
        }
    }
}
