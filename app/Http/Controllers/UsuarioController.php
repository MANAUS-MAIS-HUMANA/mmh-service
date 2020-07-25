<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\AtualizarStatusUsuarioRequest;
use App\Http\Requests\Usuario\AtualizarUsuarioRequest;
use App\Http\Requests\Usuario\CriarUsuarioRequest;
use App\Http\Requests\Usuario\DefinirSenhaUsuarioRequest;
use App\Http\Resources\Usuario\AtualizarStatusUsuarioResource;
use App\Http\Resources\Usuario\CriarUsuarioResource;
use App\Http\Resources\Usuario\DefinirSenhaUsuarioResource;
use App\Http\Resources\Usuario\UsuarioResource;
use App\Http\Resources\Usuario\UsuariosResource;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;

/**
 * @group UsuarioController
 *
 * Controller responsável pelo gerenciamento de Usuários do lado privado.
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
        $this->middleware(['auth:api', 'validarToken'])->except([
            'setPassword'
        ]);

        $this->usuarioService = $usuarioService;
    }

    /**
     * Index
     *
     * Endpoint que retorna todos os usuários.
     *
     * @authenticated
     *
     * @responseFile 200 responses/UsuarioController/index.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/UsuarioController/index.404.json
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $result = $this->usuarioService->findAll();

        return (new UsuariosResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Store
     *
     * Endpoint para criação de novo usuário.
     * <p>
     * <strong>Obs.:</strong> Será enviado um link por e-mail para o usuário,
     * ao clicar no link, o mesmo será redirecionado para página de definição de senha
     * na aplicação frontend, no corpo do link, terá o <u>ID de usuário, endereço
     * de e-mail e o token condificado em base64</u>.<br>
     * Para separação do e-mail e token, foi colocado <strong>&&</strong>.
     *  <p>
     *      <strong>Exemplos:</strong>
     *      <ul>
     *          <li><strong>Codificado</strong>: ZnVsYW5vQGZ1bGFuby5jb20mJkJGS1NkaGw2Q05TOUNaZk1O</li>
     *          <li><strong>Decodificado</strong>: 2&&fulano@fulano.com&&BFKSdhl6CNS9CZfMN</li>
     *      </ul>
     *  </p>
     *</p>
     *
     * @authenticated
     *
     * @bodyParam nome string required Nome do novo usuário - (max. 255). Example: Fulano de Tal
     * @bodyParam email string required Endereço de e-mail - (max. 255). Example: fulano@tal.com
     * @bodyParam endereco string required Endereço residencial - (max. 255). Example: Rua Dom Pedro, S/N, Dom Pedro
     * @bodyParam estado string required Estado - (tam. 2). Example: AM
     * @bodyParam tipo_pessoa string required Tipo de Pessoa (PF ou PJ). Example: pf
     * @bodyParam cpf string Número do CPF do usuário (obrigatório se não houver CNPJ). Example: 111.111.111-11
     * @bodyParam cnpj string Número do CNPJ da instituição (obrigatório se não houver CPF). Example: 11.111.111/1111-11
     * @bodyParam perfis array required Matriz de perfis.
     * @bodyParam perfis[0].id int required ID do perfil. Example: 3
     * @bodyParam perfis[0].perfil string Nome do perfil. Example: parceiro
     * @bodyParam perfis[0].descricao string Descrição do perfil. Example: Igreja ou ONG.
     *
     * @responseFile 201 responses/UsuarioController/store.201.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 403 responses/Forbidden/forbidden.403.json
     * @responseFile 422 responses/UsuarioController/store.422.json
     * @responseFile 500 responses/UsuarioController/store.500.json
     *
     * @param CriarUsuarioRequest $request
     * @return JsonResponse
     */
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
     * @responseFile 200 responses/UsuarioController/show.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/UsuarioController/show.404.json
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $result = $this->usuarioService->findById($id);

        return (new UsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * Update
     *
     * Endpoint que atualiza os dados do usuário.
     *
     * @authenticated
     *
     * @urlParam usuario required ID do usuário. Example: 2
     * @bodyParam nome string Nome do novo usuário - (max. 255). Example: Fulano de Tal
     * @bodyParam email string Endereço de e-mail - (max. 255). Example: fulano@tal.com
     * @bodyParam endereco string Endereço residencial - (max. 255). Example: Rua Dom Pedro, S/N, Dom Pedro
     * @bodyParam estado string Estado - (tam. 2). Example: AM
     * @bodyParam tipo_pessoa string Tipo de Pessoa (PF ou PJ). Example: pf
     * @bodyParam cpf string Número do CPF do usuário. Example: 111.111.111-11
     * @bodyParam cnpj string Número do CNPJ da instituição. Example: 11.111.111/1111-11
     * @bodyParam perfis array Matriz de perfis.
     * @bodyParam perfis[0].id int ID do perfil. Example: 3
     * @bodyParam perfis[0].perfil string Nome do perfil. Example: parceiro
     * @bodyParam perfis[0].descricao string Descrição do perfil. Example: Igreja ou ONG.
     * @bodyParam status string Status de usuário (A, I ou B). Example: A
     *
     * @responseFile 200 responses/UsuarioController/update.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 403 responses/Forbidden/forbidden.403.json
     * @responseFile 404 responses/UsuarioController/update.404.json
     * @responseFile 422 responses/UsuarioController/update.422.json
     *
     * @param int $id
     * @param AtualizarUsuarioRequest $request
     * @return JsonResponse
     */
    public function update(int $id, AtualizarUsuarioRequest $request): JsonResponse
    {
        $result = $this->usuarioService->update($id, $request);

        return (new UsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * SetStatus
     *
     * Endpoint que atualiza o status do usuário.
     *
     * @authenticated
     *
     * @bodyParam status string Status de usuário (A, I ou B). Example: A
     *
     * @responseFile 200 responses/UsuarioController/setStatus.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 403 responses/Forbidden/forbidden.403.json
     * @responseFile 404 responses/UsuarioController/setStatus.404.json
     * @responseFile 422 responses/UsuarioController/setStatus.422.json
     *
     * @param int $id
     * @param AtualizarStatusUsuarioRequest $request
     * @return JsonResponse|object
     */
    public function setStatus(int $id, AtualizarStatusUsuarioRequest $request)
    {
        $result = $this->usuarioService->setStatus($id, $request);

        return (new AtualizarStatusUsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }

    /**
     * SetPassword
     *
     * Endpoint que define a senha do usuário.
     *
     * @urlParam usuario required ID do usuário. Example: 2
     * @bodyParam email string required Endereço de e-mail - (max. 255). Example: fulano@tal.com
     * @bodyParam token string required Token de validação - (max. 255). Example: BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y
     * @bodyParam senha string required Nova senha (min. 8). Example: 5&bnaC#f
     * @bodyParam senha_confirmation string required Confirmação de nova senha. Example: 5&bnaC#f
     *
     * @responseFile 200 responses/UsuarioController/setPassword.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 403 responses/Forbidden/forbidden.403.json
     * @responseFile 404 responses/UsuarioController/setPassword.404.json
     * @responseFile 422 responses/UsuarioController/setPassword.422.json
     *
     * @param int $id
     * @param DefinirSenhaUsuarioRequest $request
     * @return JsonResponse
     */
    public function setPassword(int $id, DefinirSenhaUsuarioRequest $request): JsonResponse
    {
        $result = $this->usuarioService->setPassword($id, $request);

        return (new DefinirSenhaUsuarioResource(
            $result['data'] ??= null, $result['success'], $result['message']
        ))
            ->response()
            ->setStatusCode($result['code']);
    }
}
