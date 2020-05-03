<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;

class UsuarioService
{
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
