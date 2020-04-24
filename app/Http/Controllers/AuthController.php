<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\LogoutResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * @group AuthController
 *
 * Controller responsável pela autenticação do usuário
 */
class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;

        $this->middleware(['auth:api', 'validarToken'])->except('login');
    }

    /**
     * Login
     *
     * Endpoint para autenticar o usuário.
     *
     * @bodyParam email string required Endereço de e-mail. Example: fulano@fulano.com
     * @bodyParam senha string required Senha (min. 8). Example: 5&bnaC#f
     *
     * @responseFile 202 responses/AuthController/login.202.json
     * @responseFile 422 responses/AuthController/login.422.json
     * @responseFile 401 responses/AuthController/login.401.json
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->authService->login($request);

        return (new LoginResource($result['data'] ??= null, $result['success'], $result['message']))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Logout
     *
     * Endpoint para deslogar o usuário.
     *
     * @authenticated
     *
     * @responseFile 200 responses/AuthController/logout.200.json
     * @responseFile 401 responses/AuthController/logout.401.json
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $result = $this->authService->logout();

        return (new LogoutResource(null, $result['success'], $result['message']))
            ->response()
            ->setStatusCode($result['code']);
    }
}
