<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Compra\CriarCompraRequest;
use App\Http\Resources\Compra\CompraResource;
use App\Services\CompraService;

/**
 * @group CompraController
 *
 * Controller responsável pelo CRUD de prestação de contas.
 */
class CompraController extends Controller
{
    /**
     * @var CompraService
     */
     private CompraService $compraService;

    /**
     * CompraController constructor.
     * @param CompraService $compraService
     */
    public function __construct(CompraService $compraService)
    {
        $this->middleware(['auth:api', 'validarToken']);
        $this->compraService = $compraService;
    }

    /**
     * Criar
     *
     * Endpoint para criar uma compra.
     *
     * @authenticated
     *
     * @urlParam compra_id required ID da compra. Example: 1
     *
     * @bodyParam descricao_compra int required Descrição da compra - (max. 255). Example: Compra realizado por Fulano e Sicrano para instituição x
     * @bodyParam quantidade_cestas int required Números de cestas comprasdas. Exemplo: 150
     * @bodyParam valor_cesta float Valor unitário da cesta básica. Example: 59.87
     * @bodyParam itens_cestas string Descrição dos itens da cesta básica - (max. 255). Example: Arroz, Feijão, Farinha
     * @bodyParam justificativa_escolha string Justificativa da escolha do fornecedor, (max. 255). Example: Foi escolhido o fornecedor 1 por ter os melhores preços
     * @bodyParam fornecedores array Lista de fornecedores.
     * @bodyParam forncedores[0].nome int required Nome do Forncedor. Example: Distribuidora Donation
     * @bodyParam forncedores[0].contemplado boolean required Indica se o forncedor foi contemplado para a compra
     *
     * @responseFile 201 responses/CompraController/store.201.json
     * @responseFile 401 responses/CompraController/unauthorized.401.json
     * @responseFile 422 responses/CompraController/store.422.json
     * @responseFile 500 responses/CompraController/internalServerError.500.json
     */
    public function store(CriarCompraRequest $request): JsonResponse
    {
        $resultado = $this->compraService->create($request);
        $resource = new CompraResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Listar
     *
     * Endpoint para buscar uma lista de compras.
     *
     * @authenticated
     *
     * @queryParam page Número da página para retornar os dados. Example: "1"
     * @queryParam limit Total de elementos por página para retornar. Example: "10"
     *
     * @responseFile 401 responses/CompraController/unauthorized.401.json
     * @responseFile 200 responses/CompraController/get.200.json
     * @responseFile 500 responses/CompraController/internalServerError.500.json
     */
    public function get(Request $request)
    {
        $resultado = $this->compraService->get($request);

        $resource = new CompraResource(
          $resultado['data'] ??= null,
          $resultado['success'],
          $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Buscar
     *
     * Endpoint para obter os dados de uma compra específico.
     *
     * @authenticated
     *
     * @urlParam compra_id required ID da compra. Example: 1
     *
     * @responseFile 200 responses/CompraController/find.200.json
     * @responseFile 401 responses/CompraController/unauthorizedWithId.401.json
     * @responseFile 404 responses/CompraController/find.404.json
     * @responseFile 500 responses/CompraController/internalServerError.500.json
     */
    public function find(Request $request, string $id): JsonResponse
    {
        $resultado = $this->compraService->find($id);

        $resource = new CompraResource(
          $resultado['data'] ??= null,
          $resultado['success'],
          $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }


    /**
     * Atualizar
     *
     * Endpoint para atualizar os dados de uma compra.
     *
     * @authenticated
     *
     * @bodyParam descricao_compra int required Descrição da compra - (max. 255). Example: Compra realizado por Fulano e Sicrano para instituição x
     * @bodyParam quantidade_cestas int required Números de cestas comprasdas. Exemplo: 150
     * @bodyParam valor_cesta float Valor unitário da cesta básica. Example: 59.87
     * @bodyParam itens_cestas string Descrição dos itens da cesta básica - (max. 255). Example: Arroz, Feijão, Farinha
     * @bodyParam justificativa_escolha string Justificativa da escolha do fornecedor, (max. 255). Example: Foi escolhido o fornecedor 1 por ter os melhores preços
     * @bodyParam fornecedores array Lista de fornecedores.
     * @bodyParam forncedores[0].nome int required Nome do Forncedor. Example: Distribuidora Donation
     * @bodyParam forncedores[0].contemplado boolean required Indica se o forncedor foi contemplado para a compra
     *
     * @responseFile 200 responses/CompraController/update.200.json
     * @responseFile 401 responses/CompraController/unauthorizedWithId.401.json
     * @responseFile 404 responses/CompraController/update.404.json
     * @responseFile 422 responses/CompraController/update.422.json
     * @responseFile 500 responses/CompraController/internalServerError.500.json
     */
    public function update(CriarCompraRequest $request, string $id)
    {
        $resultado = $this->compraService->update($request, $id);

        $resource = new CompraResource(
          $resultado['data'] ??= null,
          $resultado['success'],
          $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }


    /**
     * Remover
     *
     * Endpoint para remover uma compra do sistema.
     *
     * @authenticated
     *
     * @urlParam compra required ID da compra. Example: 1
     *
     * @responseFile 200 responses/CompraController/delete.200.json
     * @responseFile 401 responses/CompraController/unauthorizedWithId.401.json
     * @responseFile 404 responses/CompraController/delete.404.json
     * @responseFile 500 responses/CompraController/internalServerError.500.json
     */
    public function delete(Request $request, string $id)
    {
        $resultado = $this->compraService->delete($request, $id);
        $resource = new CompraResource(
          $resultado['data'] ??= null,
          $resultado['success'],
          $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

}
