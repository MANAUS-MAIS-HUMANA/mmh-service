<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Doador\DoadorResource;
use App\Services\DoadorService;

/**
 * @group DoadorController
 *
 * Controller responsável pelo CRUD de doadores.
 */
class DoadorController extends Controller
{
    /**
     * @var DoadorService
     */
    private DoadorService $doadorService;
    /**
     * DoadorController constructor.
     * @param DoadorService $doadorService
     */
    public function __construct(DoadorService $doadorService)
    {
        $this->doadorService = $doadorService;
    }

    /**
     * Listar
     *
     * Endpoint para buscar doadores ordernados pela quantidade de cestas doadas
     *
     * @queryParam page Número da página para retornar os dados. Example: "1"
     * @queryParam limit Total de elementos por página para retornar. Example: "6"
     *
     * @responseFile 200 responses/DoadorController/getRanking.200.json
     * @responseFile 500 responses/DoadorController/internalServerError.500.json
     */
    public function getRanking(Request $request): JsonResponse
    {
        $resultado = $this->doadorService->getRanking($request);

        $resource = new DoadorResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }
}
