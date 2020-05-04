<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\CriarUsuarioRequest;
use App\Http\Resources\Usuario\CriarUsuarioResource;
use App\Http\Resources\Usuario\UsuarioResource;
use App\Http\Resources\Usuario\UsuariosResource;
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

    /**
     * Index
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
    public function index(): JsonResponse
    {
        $result = $this->usuarioService->getAll();

        return (new UsuariosResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    public function store(CriarUsuarioRequest $request): JsonResponse
    {
        $result = $this->usuarioService->create($request);

        return (new CriarUsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Show
     *
     * Endpoint que retorna o usuário pelo id.
     *
     * @authenticated
     *
     * @urlParam usuario required ID do usuário. Example: 1
     *
     * @responseFile 200 responses/UsuarioController/getById.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/UsuarioController/getById.404.json
     *
     * @param int $usuario
     * @return JsonResponse
     */
    public function show(int $usuario): JsonResponse
    {
        $result = $this->usuarioService->getById($usuario);

        return (new UsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    public function setStatus(int $id)
    {
        //
    }
}
