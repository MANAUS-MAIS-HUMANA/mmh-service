<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Auth\ConfirmarRedefinirSenhaRequest;
use App\Http\Requests\Auth\CriarUsuarioRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RedefinirSenhaRequest;
use App\Http\Resources\Auth\ConfirmarRedefinirSenhaResource;
use App\Http\Resources\Auth\CriarUsuarioResource;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\LogoutResource;
use App\Http\Resources\Auth\RedefinirSenhaResource;
use App\Http\Resources\Auth\RefreshResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * @group AuthController
 *
 * Controller responsável pelo gerenciamento de Usuários do lado público.
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
        $this->middleware(['auth:api', 'validarToken'])->except(
            [
                'login', 'create', 'passwordReset', 'confirmPasswordReset'
            ]
        );

        $this->authService = $authService;
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

        return (new LoginResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
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
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $result = $this->authService->logout();

        return (new LogoutResource(
            null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Create
     *
     * Endpoint para criação de um novo usuário.
     *
     * @bodyParam nome string required Nome do novo usuário - (max. 255). Example: Fulano de Tal
     * @bodyParam email string required Endereço de e-mail - (max. 255). Example: fulano@tal.com
     * @bodyParam senha string required Senha de usuário (min. 8). Example: 5&bnaC#f
     * @bodyParam senha_confirmation string required Confirmação de senha de usuário. Example: 5&bnaC#f
     * @bodyParam telefone string Telefone do usuário (min. 10). Example: 92991234567
     *
     * @responseFile 201 responses/AuthController/create.201.json
     * @responseFile 422 responses/AuthController/create.422.json
     * @responseFile 500 responses/AuthController/create.500.json
     *
     * @param CriarUsuarioRequest $request
     * @return JsonResponse
     */
    public function create(CriarUsuarioRequest $request): JsonResponse
    {
        $result = $this->authService->create($request);

        return (new CriarUsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Password Reset
     *
     * Endpoint para solicitação de redefinição de senha do usuário.
     * <p>
     * <strong>Obs.:</strong> Será enviado um link por e-mail para o usuário,
     * ao clicar no link, o mesmo será redirecionado para página de redefinição de senha
     * na aplicação frontend, no corpo do link, terá o <u>endereço
     * de e-mail e o token de autorização condificado em base64</u>.<br>
     * Para separação do e-mail e token, foi colocado <strong>&&</strong>.
     *  <p>
     *      <strong>Exemplos:</strong>
     *      <ul>
     *          <li><strong>Codificado</strong>:
     * ZnVsYW5vQGZ1bGFuby5jb20mJkJGS1NkaGw2Q05TOUNaZk1O</li>
     *          <li><strong>Decodificado</strong>: fulano@fulano.com&&BFKSdhl6CNS9CZfMN</li>
     *      </ul>
     *  </p>
     *</p>
     *
     * @bodyParam email string required Endereço de e-mail. Example: fulano@fulano.com
     *
     * @responseFile 200 responses/AuthController/passwordReset.200.json
     * @responseFile 422 responses/AuthController/passwordReset.422.json
     * @responseFile 500 responses/AuthController/passwordReset.500.json
     *
     * @param RedefinirSenhaRequest $request
     * @return JsonResponse
     */
    public function passwordReset(RedefinirSenhaRequest $request): JsonResponse
    {
        $result = $this->authService->passwordReset($request);

        return (new RedefinirSenhaResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Confirm Password Reset
     *
     * Endpoint para confirmar a solicitação de redefinição de senha.
     *
     * @bodyParam token string required Token de validação. Example: BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y
     * @bodyParam email string required Endereço de e-mail. Example: fulano@fulano.com
     * @bodyParam senha string required Nova senha (min. 8). Example: 5&bnaC#f
     * @bodyParam senha_confirmation string required Confirmação de nova senha. Example: 5&bnaC#f
     *
     * @responseFile 200 responses/AuthController/confirmPasswordReset.200.json
     * @responseFile 422 responses/AuthController/confirmPasswordReset.422.json
     * @responseFile 500 responses/AuthController/confirmPasswordReset.500.json
     *
     * @param ConfirmarRedefinirSenhaRequest $request
     * @return JsonResponse
     */
    public function confirmPasswordReset(ConfirmarRedefinirSenhaRequest $request): JsonResponse
    {
        $result = $this->authService->confirmPasswordReset($request);

        return (new ConfirmarRedefinirSenhaResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Refresh Access token
     *
     * Endpoint para fazer um refresh de um access token previamente gerado.
     * Após o refresh, o token antigo não poderá ser mais usado.
     *
     * @authenticated
     *
     * @responseFile 200 responses/AuthController/refresh.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     *
     * @param ConfirmarRedefinirSenhaRequest $request
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $result = $this->authService->refresh();

        $resource = new RefreshResource(
            $result['data'] ??= null,
            $result['success'],
            $result['message'],
        );

        return $resource->response()->setStatusCode($result['code']);
    }
}
