<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\Beneficiario\CriarBeneficiarioRequest;
use App\Http\Requests\Beneficiario\AtualizarBeneficiarioRequest;
use App\Http\Resources\Beneficiario\BeneficiarioResource;
use App\Services\BeneficiarioService;

/**
 * @group BeneficiarioController
 *
 * Controller responsável pelo CRUD de beneficiários.
 */
class BeneficiarioController extends Controller
{
    /**
     * @var BeneficiarioService
     */
    private BeneficiarioService $beneficiarioService;

    /**
     * BeneficiarioController constructor.
     * @param BeneficiarioService $beneficiarioService
     */
    public function __construct(BeneficiarioService $beneficiarioService)
    {
        $this->middleware(['auth:api', 'validarToken']);

        $this->beneficiarioService = $beneficiarioService;
    }

    /**
     * Listar
     *
     * Endpoint para buscar uma lista de beneficiários.
     *
     * @authenticated
     *
     * @queryParam page Número da página para retornar os dados. Example: "1"
     * @queryParam limit Total de elementos por página para retornar. Example: "10"
     *
     * @responseFile 200 responses/BeneficiarioController/get.200.json
     * @responseFile 500 responses/BeneficiarioController/internalServerError.500.json
     */
    public function get(Request $request): JsonResponse
    {
        $resultado = $this->beneficiarioService->get($request);

        $resource = new BeneficiarioResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Buscar
     *
     * Endpoint para obter os dados de um beneficiário específico.
     *
     * @authenticated
     *
     * @urlParam beneficiario required ID do beneficiário. Example: 1
     *
     * @responseFile 200 responses/BeneficiarioController/show.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/BeneficiarioController/show.404.json
     * @responseFile 500 responses/BeneficiarioController/internalServerError.500.json
     */
    public function find(Request $request, string $id): JsonResponse
    {
        $resultado = $this->beneficiarioService->find($id);

        $resource = new BeneficiarioResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Criar
     *
     * Endpoint para inserir um novo beneficiário no sistema.
     *
     * @authenticated
     *
     * @bodyParam parceiro_id int required ID da instituição parceira. Example: 1
     * @bodyParam nome string required Nome do novo beneficiário - (max. 255). Example: Machado de Assis
     * @bodyParam cpf string Número do CPF do beneficiário. Example: 12345678901
     * @bodyParam email string Endereço de e-mail do beneficiário - (max. 255). Example: fulano@tal.com
     * @bodyParam data_nascimento string required Data de nascimento do beneficiário, no formato AAAA-MM-DD. Example: 1990-01-01
     * @bodyParam trabalho string Ocupação do beneficiário. Example: Trabalhador Autônomo
     * @bodyParam esta_desempregado boolean Indica se o beneficiário está desempregado ou não.
     * @bodyParam estado_civil_id int Estado civil do beneficiario.
     * @bodyParam nome_conjuge string Nome do cônjuge. Example: Carolina Novais.
     * @bodyParam cpf_conjuge string Número do CPF do cônjuge. Example: 10987654321
     * @bodyParam total_residentes int Total de pessoas na residência do beneficiario. Example: 4
     * @bodyParam situacao_moradia string Situação da moradia: Própria, Alugada, Cedida ou Própria Financiada
     * @bodyParam renda_mensal float Renda mensal do beneficiário. Example: 1000
     * @bodyParam gostaria_montar_negocio boolean Indica se o beneficiário tem intersse em montar um negócio.
     * @bodyParam gostaria_participar_cursos boolean Indica se o usuário tem interesse em participar de cursos.
     * @bodyParam tipo_curso string Tipo de curso que o beneficiário gostaria de fazer: Presencial, Online ou Ambos.
     * @bodyParam concorda_informacoes_verdadeiras boolean required Indica se o usuário concordou com os termos.
     * @bodyParam data_submissao string Data e hora de submissão do formulário, no formato AAAA-MM-DD HH:MM:SS. Example: 2020-05-01 10:11:12
     * @bodyParam telefones array Lista de telefones.
     * @bodyParam telefones[0].telefone int required Número de telefone com DDD. Example: 92991234567
     * @bodyParam telefones[0].tipo string required Tipo do telefone: "Fixo" ou "Celular"
     * @bodyParam enderecos array required Lista de enderecos.
     * @bodyParam enderecos[0].endereco string required Nome da rua, com número e complemento. Example: Rua da paz, 150
     * @bodyParam enderecos[0].bairro_id int required ID do bairro. Example: 1
     * @bodyParam enderecos[0].zona_id int required ID da zona da cidade. Example: 1
     * @bodyParam enderecos[0].cep string required CEP da rua. Example: "69061000"
     * @bodyParam enderecos[0].ponto_referencia string Ponto de referência. Example: "INPA"
     * @bodyParam enderecos[0].cidade_id int required ID da cidade. Example: 1
     *
     * @responseFile 201 responses/BeneficiarioController/store.201.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 422 responses/BeneficiarioController/store.422.json
     * @responseFile 500 responses/BeneficiarioController/internalServerError.500.json
     */
    public function store(CriarBeneficiarioRequest $request): JsonResponse
    {
        $resultado = $this->beneficiarioService->create($request);

        $resource = new BeneficiarioResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Atualizar
     *
     * Endpoint para atualizar os dados de um beneficiário.
     *
     * @authenticated
     *
     * @bodyParam parceiro_id int required ID da instituição parceira. Example: 1
     * @bodyParam nome string required Nome do novo beneficiário - (max. 255). Example: Machado de Assis
     * @bodyParam cpf string Número do CPF do beneficiário. Example: 12345678901
     * @bodyParam email string Endereço de e-mail do beneficiário - (max. 255). Example: fulano@tal.com
     * @bodyParam data_nascimento string required Data de nascimento do beneficiário, no formato AAAA-MM-DD. Example: 1990-01-01
     * @bodyParam trabalho string Ocupação do beneficiário. Example: Trabalhador Autônomo
     * @bodyParam esta_desempregado boolean Indica se o beneficiário está desempregado ou não.
     * @bodyParam estado_civil_id int Estado civil do beneficiario.
     * @bodyParam nome_conjuge string Nome do cônjuge. Example: Carolina Novais.
     * @bodyParam cpf_conjuge string Número do CPF do cônjuge. Example: 10987654321
     * @bodyParam total_residentes int Total de pessoas na residência do beneficiario. Example: 4
     * @bodyParam situacao_moradia string Situação da moradia: Própria, Alugada, Cedida ou Própria Financiada
     * @bodyParam renda_mensal float Renda mensal do beneficiário. Example: 1000
     * @bodyParam gostaria_montar_negocio boolean Indica se o beneficiário tem intersse em montar um negócio.
     * @bodyParam gostaria_participar_cursos boolean Indica se o usuário tem interesse em participar de cursos.
     * @bodyParam tipo_curso string Tipo de curso que o beneficiário gostaria de fazer: Presencial, Online ou Ambos.
     * @bodyParam concorda_informacoes_verdadeiras boolean required Indica se o usuário concordou com os termos.
     * @bodyParam data_submissao string Data e hora de submissão do formulário, no formato AAAA-MM-DD HH:MM:SS. Example: 2020-05-01 10:11:12
     * @bodyParam telefones array Lista de telefones.
     * @bodyParam telefones[0].telefone int required Número de telefone com DDD. Example: 92991234567
     * @bodyParam telefones[0].tipo string required Tipo do telefone: "Fixo" ou "Celular"
     * @bodyParam enderecos array required Lista de enderecos.
     * @bodyParam enderecos[0].endereco string required Nome da rua, com número e complemento. Example: Rua da paz, 150
     * @bodyParam enderecos[0].bairro_id int required ID do bairro. Example: 1
     * @bodyParam enderecos[0].zona_id int required ID da zona da cidade. Example: 1
     * @bodyParam enderecos[0].cep string required CEP da rua. Example: "69061000"
     * @bodyParam enderecos[0].ponto_referencia string Ponto de referência. Example: "INPA"
     * @bodyParam enderecos[0].cidade_id int required ID da cidade. Example: 1
     *
     * @responseFile 200 responses/BeneficiarioController/update.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/BeneficiarioController/update.404.json
     * @responseFile 422 responses/BeneficiarioController/update.422.json
     * @responseFile 500 responses/BeneficiarioController/internalServerError.500.json
     */
    public function update(AtualizarBeneficiarioRequest $request, string $id): JsonResponse
    {
        $resultado = $this->beneficiarioService->update($request, $id);

        $resource = new BeneficiarioResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }

    /**
     * Remover
     *
     * Endpoint para remover um beneficiário do sistema.
     *
     * @authenticated
     *
     * @urlParam beneficiario required ID do beneficiário. Example: 1
     *
     * @responseFile 200 responses/BeneficiarioController/delete.200.json
     * @responseFile 401 responses/Middleware/unauthorized.401.json
     * @responseFile 404 responses/BeneficiarioController/delete.404.json
     * @responseFile 500 responses/BeneficiarioController/internalServerError.500.json
     */
    public function delete(Request $request, string $id): JsonResponse
    {
        $resultado = $this->beneficiarioService->delete($request, $id);

        $resource = new BeneficiarioResource(
            $resultado['data'] ??= null,
            $resultado['success'],
            $resultado['message'],
        );

        return $resource->response()->setStatusCode($resultado['code']);
    }
}
