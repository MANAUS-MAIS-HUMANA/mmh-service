<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Resources\Usuario\UsuarioResource;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;

/**
 * @group UsuarioController
 *
 * Controller responsável pelo gerenciamento de Usuários
 */
class UsuarioController extends Controller
{
    /**
     * GetAll
     *
     * Endpoint que retorna todos os usuários.
     *
     * @authenticated
     *
     * @responseFile 200 responses/UsuarioController/getAll.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/UsuarioController/getAll.404.json
     *
     * @return JsonResponse
     */
    public function getAll(): JsonResponse
    {
        $result = $this->usuarioService->getAll();

        return (new UsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * @var UsuarioService
     */
    private UsuarioService $usuarioService;

    /**
     * UsuarioController constructor.
     * @param UsuarioService $usuarioService
     */
    public function __construct(UsuarioService $usuarioService)
    {
        $this->middleware(['auth:api', 'validarToken']);

        $this->usuarioService = $usuarioService;
    }
}
