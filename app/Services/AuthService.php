<?php

declare(strict_types=1);

namespace App\Services;

use App\Mail\RedefinirSenha as RedefinirSenhaMail;
use App\Models\RedefinirSenha;
use App\Models\User;
use App\Traints\Usuario as UsuarioTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AuthService
{
    use UsuarioTrait;

    /**
     * Faz a autenticação do usuário
     *
     * @param Request $request
     * @return array
     */
    public function login(Request $request): array
    {
        try {
            $usuario = User::whereEmail($request->email)
                ->whereStatus('A')
                ->first();

            throw_if(
                !$usuario || !Hash::check($request->senha, $usuario->senha),
                \Exception::class, "E-mail ou senha de usuário inválido!", 401
            );

            $token = auth('api')->login($usuario);

            return [
                'success' => true,
                'data' => $this->respondWithToken((string)$token),
                'message' => 'Usuário logado com sucesso!',
                'code' => 200,
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    /**
     * Desloga o usuário
     *
     * @return array
     */
    public function logout(): array
    {
        try {
            auth('api')->logout();

            return [
                'success' => true,
                'message' => 'Usuário deslogado com sucesso!',
                'code' => 200,
            ];
        } catch (\Throwable $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
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
                'senha' => Hash::make($request->senha),
                'status' => 'I'
            ]);

            throw_if(!$usuario, \Exception::class, 'Não foi possível criar o usuaŕio!', 500);

            $this->perfilByNameAttach($usuario, 'parceiro');

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

            throw_if(
                !$pwdReset, \Exception::class, 'Não foi possível solicitador a recuperação da senha!', 500
            );

            Mail::to($pwdReset->email)
                ->locale('pt-BR')
                ->send(new RedefinirSenhaMail($usuario, $pwdReset));

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

            throw_if(
                !$pwdReset, \Exception::class, 'Não foi possível redefinir a senha do usuaŕio!', 500
            );

            $pwdReset = tap($pwdReset)->update([
                'status' => 'I'
            ])->fresh();

            $usuario = $pwdReset->usuario;

            $usuario = tap($usuario)->update([
                'password' => Hash::make($request->senha)
            ])->fresh();

            DB::commit();

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
     * Retorna os dados de acesso
     *
     * @param string $token
     * @return array
     */
    public function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ];
    }
}
