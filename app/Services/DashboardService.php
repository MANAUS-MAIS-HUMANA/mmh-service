<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiError;
use App\Helpers\HttpStatus;

class DashboardService
{
    public function get(Request $request): array
    {
        try {
            $dashboard_info = [
                'valor_arrecadados' => 364823.78,
                'meta_valor_arrecadacao' => 670000.0,
                'cestas_doadas' => 5370,
                'meta_cestas_doadas' => 10000,
                'pessoas_impactadas' => 21480,
                'meta_pessoas_impactadas' => 40000,
                'familias_atendidas' => 5370,
                'meta_familias_atendidas' => 10000,
                'instituicoes_contemplada' => 57,
                'zonas' => [
                    'sul' => 13.08,
                    'oeste' => 17.30,
                    'norte' => 16.61,
                    'leste' => 13.04,
                    'centro_sul' => 39.97,
                    'centro_oeste' => 0,
                ],
                'arrecadacao_mensal' => [
                    ['x' => 'Abril', 'y' => 59270.45],
                    ['x' => 'Maio', 'y' => 201000],
                    ['x' => 'Junho', 'y' => 3202.82],
                ],
            ];

            $resultado = [
                'success' => true,
                'data' => $dashboard_info,
                'message' => 'Informações do dashboard obtidas com sucesso!',
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
