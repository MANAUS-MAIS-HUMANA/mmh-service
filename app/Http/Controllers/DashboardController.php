<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\Dashboard\DashboardResource;
use App\Services\DashboardService;

/**
 * @group DashboardController
 *
 * Controller responsável por retornar as informações do dashboard.
 */
class DashboardController extends Controller
{
    /**
     * @var DashboardService
     */
    private DashboardService $dashboardService;
    /**
     * DashboardController constructor.
     * @param DashboardService $dashboardService
     */
    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    /**
     * Listar
     *
     * Endpoint para retornar informações do dashboard
     *
     * @responseFile 200 responses/DashboardController/get.200.json
     * @responseFile 500 responses/DashboardController/internalServerError.500.json
     */
    public function get(Request $request): JsonResponse
    {
        $resultado = $this->dashboardService->get($request);

        $resource = new DashboardResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }
}
