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
}
