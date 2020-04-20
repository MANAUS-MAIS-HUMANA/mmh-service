<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;

class UsuarioService
{
    /**
     * Retorna o usuário pelo ID
     *
     * @param Request $request
     * @return array
     */
    public function getUsuario(Request $request): array
    {
        try {
            $user = User::find($request->id);

            throw_if(!$user, \Exception::class, 'Usuário não encontrado!', 404);

            return [
                'success' => true,
                'data' => $user,
                'message' => 'Usuário encontrado!',
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
     * Retorna o usuário pelo E-mail
     *
     * @param Request $request
     * @return array
     */
    public function getUsuarioByEmail(Request $request): array
    {
        try {
            $user = User::whereEmail($request->email)->first();

            throw_if(!$user, \Exception::class, 'Usuário não encontrado!', 404);

            return [
                'success' => true,
                'data' => $user,
                'message' => 'Usuário encontrado!',
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
}
