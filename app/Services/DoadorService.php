<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiError;
use App\Helpers\HttpStatus;
use App\Models\Doador;

class DoadorService
{
    const DOADORES_POR_PAGINA = 6;

    public function __construct(Doador $doador)
    {
        $this->doador = $doador;
    }

    public function getRanking(Request $request): array
    {
        $limit = (int)$request->query('limit');

        if ($limit == 0) {
            $limit = self::DOADORES_POR_PAGINA;
        }

        try {
            $doadors = $this->doador->select(
              'doadores.id',
              'doadores.nome',
              'doadores.logo_url',
              DB::raw('SUM(doacoes.total_cestas_basicas) as total_cestas_basicas'))
              ->join('doacoes', 'doadores.id', '=', 'doacoes.doador_id' )
              ->groupBy('doacoes.doador_id')
              ->orderBy('total_cestas_basicas', 'desc')
              ->paginate($limit);

            $resultado = [
                'success' => true,
                'data' => $doadors,
                'message' => 'Raqueamento dos doadores obtidos com sucesso!',
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
