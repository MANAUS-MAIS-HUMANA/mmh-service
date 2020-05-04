<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Perfil;

class PerfilService
{
    /**
     * Retorna os dados do perfil pelo nome de perfil
     *
     * @param string $perfil
     * @return array
     */
    public function getByPerfil(string $perfil): array
    {
        try {
            $perfil = Perfil::wherePerfil($perfil)
                ->first();

            throw_if(!$perfil, \Exception::class, "Perfil {$perfil} não encontrado!", 404);

            return [
                'success' => true,
                'data' => $perfil,
                'message' => "Perfil econtrado com sucesso!",
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
