<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Usuario\AtualizarUsuarioRequest;
use App\Http\Requests\Usuario\CriarUsuarioRequest;
use App\Http\Resources\Usuario\CriarUsuarioResource;
use App\Http\Resources\Usuario\UsuarioResource;
use App\Http\Resources\Usuario\UsuariosResource;
use App\Services\UsuarioService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * @responseFile 200 responses/UsuarioController/index.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/UsuarioController/index.404.json
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

    /**
     * Create
     *
     * Endpoint para criação de novo usuário.
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
     * @responseFile 404 responses/UsuarioController/update.404.json
     *
     * @param int $usuario
     * @param AtualizarUsuarioRequest $request
     * @return JsonResponse
     */
    public function update(int $usuario, AtualizarUsuarioRequest $request): JsonResponse
    {
        $result = $this->usuarioService->update($usuario, $request);

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
