<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Parceiro\AtualizarParceiroRequest;
use App\Http\Requests\Parceiro\CriarParceiroRequest;
use App\Http\Resources\Parceiro\ParceiroResource;
use App\Services\ParceiroService;

/**
 * @group ParceiroController
 *
 * Controller responsável pelo CRUD de instituições parceiras.
 */
class ParceiroController extends Controller
{
    /**
     * @var ParceiroService
     */
    private ParceiroService $parceiroService;

    /**
     * ParceiroController constructor.
     * @param ParceiroService $parceiroService
     */
    public function __construct(ParceiroService $parceiroService)
    {
        $this->middleware(['auth:api', 'validarToken']);

        $this->parceiroService = $parceiroService;
    }

    /**
     * Listar
     *
     * Endpoint para buscar uma lista de parceiros.
     *
     * @authenticated
     *
     * @queryParam page Número da página para retornar os dados. Example: "1"
     * @queryParam limit Total de elementos por página para retornar. Example: "6"
     *
     * @responseFile 200 responses/ParceiroController/get.200.json
     * @responseFile 500 responses/ParceiroController/internalServerError.500.json
     */
    public function get(Request $request): JsonResponse
    {
        $resultado = $this->parceiroService->get($request);

        $resource = new ParceiroResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Buscar
     *
     * Endpoint para obter os dados de um parceiro específico.
     *
     * @authenticated
     *
     * @urlParam parceiro required ID do parceiro. Example: 1
     *
     * @responseFile 200 responses/ParceiroController/show.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/ParceiroController/show.404.json
     * @responseFile 500 responses/ParceiroController/internalServerError.500.json
     */
    public function find(Request $request, string $id): JsonResponse
    {
        $resultado = $this->parceiroService->find($id);

        $resource = new ParceiroResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Criar
     *
     * Endpoint para inserir uma nova instituição parceira no sistema.
     *
     * @authenticated
     *
     * @bodyParam nome string required Nome do novo parceiro - (max. 255). Example: Manaus+Humana
     * @bodyParam email string required Endereço de e-mail do parceiro - (max. 255). Example: fulano@tal.com
     * @bodyParam cnpj string Número do CNPJ da instituição (obrigatório se não houver CPF). Example: 13245678901234
     * @bodyParam cpf string Número do CPF da instituição (obrigatório se não houver CNPJ). Example: 12345678901
     * @bodyParam telefones array required Lista de telefones.
     * @bodyParam telefones[0].telefone int required Número de telefone com DDD. Example: 92991234567
     * @bodyParam telefones[0].tipo string required Tipo do telefone: "Fixo" ou "Celular"
     * @bodyParam enderecos array required Lista de enderecos.
     * @bodyParam enderecos[0].endereco string required Nome da rua, com número e complemento. Example: Rua da paz, 150
     * @bodyParam enderecos[0].bairro_id int required ID do bairro. Example: 1
     * @bodyParam enderecos[0].cep string required CEP da rua. Example: "69061000"
     * @bodyParam enderecos[0].ponto_referencia string Ponto de referência. Example: "INPA"
     * @bodyParam enderecos[0].cidade_id int required ID da cidade. Example: 1
     *
     * @responseFile 201 responses/ParceiroController/store.201.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 422 responses/ParceiroController/store.422.json
     * @responseFile 500 responses/ParceiroController/internalServerError.500.json
     */
    public function store(CriarParceiroRequest $request): JsonResponse
    {
        $resultado = $this->parceiroService->create($request);

        $resource = new ParceiroResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Atualizar
     *
     * Endpoint para atualizar os dados de um parceiro.
     *
     * @authenticated
     *
     * @urlParam parceiro required ID do parceiro. Example: 1
     * @bodyParam nome string required Nome do novo parceiro - (max. 255). Example: Manaus+Humana
     * @bodyParam email string required Endereço de e-mail do parceiro - (max. 255). Example: fulano@tal.com
     * @bodyParam cnpj string Número do CNPJ da instituição (obrigatório se não houver CPF). Example: 13245678901234
     * @bodyParam cpf string Número do CPF da instituição (obrigatório se não houver CNPJ). Example: 12345678901
     * @bodyParam telefones array required Lista de telefones.
     * @bodyParam telefones[0].telefone int required Número de telefone com DDD. Example: 92991234567
     * @bodyParam telefones[0].tipo string required Tipo do telefone: "Fixo" ou "Celular"
     * @bodyParam enderecos array required Lista de enderecos
     * @bodyParam enderecos[0].endereco string required Nome da rua, com número e complemento. Example: Rua da paz, 150
     * @bodyParam enderecos[0].bairro_id int required ID do bairro. Example: 1
     * @bodyParam enderecos[0].cep string required CEP da rua. Example: "69061000"
     * @bodyParam enderecos[0].ponto_referencia string Ponto de referência. Example: "INPA"
     * @bodyParam enderecos[0].cidade_id int required ID da cidade. Example: 1
     *
     * @responseFile 200 responses/ParceiroController/update.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/ParceiroController/update.404.json
     * @responseFile 422 responses/ParceiroController/update.422.json
     * @responseFile 500 responses/ParceiroController/internalServerError.500.json
     */
    public function update(AtualizarParceiroRequest $request, string $id): JsonResponse
    {
        $resultado = $this->parceiroService->update($request, $id);

        $resource = new ParceiroResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Remover
     *
     * Endpoint para remover um parceiro do sistema.
     *
     * @authenticated
     *
     * @urlParam parceiro required ID do parceiro. Example: 1
     *
     * @responseFile 200 responses/ParceiroController/delete.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/ParceiroController/delete.404.json
     * @responseFile 500 responses/ParceiroController/internalServerError.500.json
     */
    public function delete(Request $request, string $id): JsonResponse
    {
        $resultado = $this->parceiroService->delete($request, $id);

        $resource = new ParceiroResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }
}
