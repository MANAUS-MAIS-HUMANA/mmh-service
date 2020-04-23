<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
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

            throw_if(!$usuario || !Hash::check($request->senha, $usuario->senha), \Exception::class, "E-mail ou senha de usuário inválido!", 401);

            $token = auth()->login($usuario);

            return [
                'success' => true,
                'data' => $this->respondWithToken((string)$token),
                'message' => 'Usuário logado com sucesso!',
                'code' => 202,
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
