<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\ConfirmarRedefinirSenhaRequest;
use App\Http\Requests\RedefinirSenhaRequest;
use App\Http\Resources\AuthResource;
use App\Http\Resources\ConfirmarRedefinirSenhaResource;
use App\Http\Resources\RedefinirSenhaResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;

/**
 * @group AuthController
 *
 * Controller responsável pelo gerenciamento de Usuários
 */
class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Criar usuário
     *
     * Endpoint para criação de um novo usuário.
     *
     * @bodyParam nome string required Nome do novo usuário - (max. 255). Example: Fulano de Tal
     * @bodyParam email string required Endereço de e-mail - (max. 255). Example: fulano@tal.com
     * @bodyParam endereco string required Endereço residencial - (max. 255). Example: Rua Dom Pedro, S/N, Dom Pedro
     * @bodyParam estado string required Estado - (tam. 2). Example: AM
     * @bodyParam tipo_pessoa string required Tipo de Pessoa (PF ou PJ). Example: pf
     * @bodyParam cpf string Número do CPF do usuário (obrigatório se não houver CNPJ). Example: 111.111.111-11
     * @bodyParam cnpj string Número do CNPJ da instituição (obrigatório se não houver CPF). Example: 11.111.111/1111-11
     * @bodyParam perfis array required Matriz de perfis
     * @bodyParam perfis[0].id int required ID do perfil. Example: 1
     * @bodyParam perfis[0].descricao string Descricao do perfil. Example: Master
     * @bodyParam perfis[1].id int required ID do perfil. Example: 2
     * @bodyParam senha string required Senha de usuário (min. 8). Example: 5&bnaC#f
     * @bodyParam senha_confirmation string required Confirmação de senha de usuário. Example: 5&bnaC#f
     *
     * @responseFile responses/AuthController/create.get.json
     * @responseFile 422 responses/AuthController/create.422.json
     * @responseFile 500 responses/AuthController/create.500.json
     *
     * @param AuthRequest $request
     * @return JsonResponse
     */
    public function create(AuthRequest $request): JsonResponse
    {
        $result = $this->authService->create($request);

        return (new AuthResource($result['data'] ??= null, $result['success'], $result['message']))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Redefinir senha
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
     *          <li><strong>Codificado</strong>: ZnVsYW5vQGZ1bGFuby5jb20mJkJGS1NkaGw2Q05TOUNaZk1O</li>
     *          <li><strong>Decodificado</strong>: fulano@fulano.com&&BFKSdhl6CNS9CZfMN</li>
     *      </ul>
     *  </p>
     *</p>
     *
     * @bodyParam email string required Endereço de e-mail. Example: fulano@fulano.com
     *
     * @responseFile responses/AuthController/passwordReset.get.json
     * @responseFile 422 responses/AuthController/passwordReset.422.json
     * @responseFile 500 responses/AuthController/passwordReset.500.json
     *
     * @param RedefinirSenhaRequest $request
     * @return JsonResponse
     */
    public function passwordReset(RedefinirSenhaRequest $request): JsonResponse
    {
        $result = $this->authService->passwordReset($request);

        return (new RedefinirSenhaResource($result['data'] ??= null, $result['success'], $result['message']))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Confirmar redefinição de senha
     *
     * Endpoint para confirmar a solicitação de redefinição de senha.
     *
     * @bodyParam token string required Token de validação. Example: BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y
     * @bodyParam email string required Endereço de e-mail. Example: fulano@fulano.com
     * @bodyParam senha string required Nova senha (min. 8). Example: 5&bnaC#f
     * @bodyParam senha_confirmation string required Confirmação de nova senha. Example: 5&bnaC#f
     *
     * @responseFile responses/AuthController/confirmPasswordReset.get.json
     * @responseFile 422 responses/AuthController/confirmPasswordReset.422.json
     * @responseFile 500 responses/AuthController/confirmPasswordReset.500.json
     *
     * @param ConfirmarRedefinirSenhaRequest $request
     * @return JsonResponse
     */
    public function confirmPasswordReset(ConfirmarRedefinirSenhaRequest $request): JsonResponse
    {
        $result = $this->authService->confirmPasswordReset($request);

        return (new ConfirmarRedefinirSenhaResource($result['data'] ??= null, $result['success'], $result['message']))
            ->response()
            ->setStatusCode($result['code']);
    }
}
