<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use App\Helpers\ApiError;
use App\Helpers\HttpStatus;
use App\Models\Bairro;

class BairroService
{
    public function __construct(Bairro $bairro)
    {
        $this->bairro = $bairro;
    }

    public function get(Request $request): array
    {
        try {
            $bairros = $this->bairro->orderBy('nome')->get(['id', 'nome']);

            $resultado = [
                'success' => true,
                'data' => $bairros,
                'message' => 'Bairros obtidos com sucesso!',
                'code' => HttpStatus::OK,
            ];
        } catch (Exception $e) {
            $resultado = [
                'success' => false,
                'message' => ApiError::erroInesperado($e->getMessage()),
                'code' => HttpStatus::INTERNAL_SERVER_ERROR,
            ];
        }

        return $resultado;
    }
}
