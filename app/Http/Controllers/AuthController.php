<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Requests\RedefinirSenhaRequest;
use App\Http\Resources\AuthResource;
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
}
