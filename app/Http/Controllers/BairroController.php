<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Bairro\BairroResource;
use App\Services\BairroService;

/**
 * @group BairroController
 *
 * Controller responsável pelo gerenciamento de bairros.
 */
class BairroController extends Controller
{
    /**
     * @var BairroService
     */
    private BairroService $bairroService;
    /**
     * BairroController constructor.
     * @param BairroService $bairroService
     */
    public function __construct(BairroService $bairroService)
    {
        $this->bairroService = $bairroService;
    }

    /**
     * Listar
     *
     * Endpoint para buscar os bairros cadastrados.
     *
     * @responseFile 200 responses/BairroController/get.200.json
     */
    public function get(Request $request): JsonResponse
    {
        $resultado = $this->bairroService->get($request);

        $resource = new BairroResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }
}
