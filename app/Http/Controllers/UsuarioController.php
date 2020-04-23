<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\CriarUsuarioRequest;
use App\Http\Requests\Usuario\ConfirmarRedefinirSenhaRequest;
use App\Http\Requests\Usuario\RedefinirSenhaRequest;
use App\Http\Resources\Usuario\CriarUsuarioResource;
use App\Http\Resources\Usuario\ConfirmarRedefinirSenhaResource;
use App\Http\Resources\Usuario\RedefinirSenhaResource;
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

    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }

    /**
     * Create
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
     * @responseFile 201 responses/UsuarioController/create.201.json
     * @responseFile 422 responses/UsuarioController/create.422.json
     * @responseFile 500 responses/UsuarioController/create.500.json
     *
     * @param CriarUsuarioRequest $request
     * @return JsonResponse
     */
    public function create(CriarUsuarioRequest $request): JsonResponse
    {
        $result = $this->usuarioService->create($request);

        return (new CriarUsuarioResource($result['data'] ??= null, $result['success'], $result['message']))
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
     *          <li><strong>Codificado</strong>: ZnVsYW5vQGZ1bGFuby5jb20mJkJGS1NkaGw2Q05TOUNaZk1O</li>
     *          <li><strong>Decodificado</strong>: fulano@fulano.com&&BFKSdhl6CNS9CZfMN</li>
     *      </ul>
     *  </p>
     *</p>
     *
     * @bodyParam email string required Endereço de e-mail. Example: fulano@fulano.com
     *
     * @responseFile responses/UsuarioController/passwordReset.200.json
     * @responseFile 422 responses/UsuarioController/passwordReset.422.json
     * @responseFile 500 responses/UsuarioController/passwordReset.500.json
     *
     * @param RedefinirSenhaRequest $request
     * @return JsonResponse
     */
    public function passwordReset(RedefinirSenhaRequest $request): JsonResponse
    {
        $result = $this->usuarioService->passwordReset($request);

        return (new RedefinirSenhaResource($result['data'] ??= null, $result['success'], $result['message']))
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
     * @responseFile responses/UsuarioController/confirmPasswordReset.200.json
     * @responseFile 422 responses/UsuarioController/confirmPasswordReset.422.json
     * @responseFile 500 responses/UsuarioController/confirmPasswordReset.500.json
     *
     * @param ConfirmarRedefinirSenhaRequest $request
     * @return JsonResponse
     */
    public function confirmPasswordReset(ConfirmarRedefinirSenhaRequest $request): JsonResponse
    {
        $result = $this->usuarioService->confirmPasswordReset($request);

        return (new ConfirmarRedefinirSenhaResource($result['data'] ??= null, $result['success'], $result['message']))
            ->response()
            ->setStatusCode($result['code']);
    }
}
