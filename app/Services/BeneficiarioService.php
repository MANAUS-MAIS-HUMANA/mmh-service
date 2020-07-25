<?php

declare(strict_types=1);

namespace App\Services;

use DateTime;
use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiError;
use App\Helpers\HttpStatus;
use App\Models\Endereco;
use App\Models\Beneficiario;
use App\Models\Telefone;

class BeneficiarioService
{
    const BENEFICIARIOS_POR_PAGINA = 10;

    public function __construct(Beneficiario $beneficiario)
    {
        $this->beneficiario = $beneficiario;
    }

    public function get(Request $request): array
    {
        $limit = (int)$request->query('limit');

        if ($limit == 0) {
            $limit = self::BENEFICIARIOS_POR_PAGINA;
        }

        try {
            $beneficiarios = $this->beneficiario->with([ 'telefones', 'enderecos', 'estadoCivil'])->paginate($limit);

            $resultado = [
                'success' => true,
                'data' => $beneficiarios,
                'message' => 'Beneficiário obtido com sucesso!',
                'code' => HttpStatus::OK,
            ];
        } catch (Exception $e) {
            $resultado = [
                'success' => false,
                'message' => ApiError::erroInesperado($e->getMessage()),
                'code' => HttpStatus::INTERNAL_SERVER_ERROR,
            ];
        }

        return $resultado;
    }

    public function find(string $beneficiarioId): array
    {
        $beneficiario = Beneficiario::with([ 'telefones', 'enderecos', 'estadoCivil'])->find($beneficiarioId);
        if (is_null($beneficiario)) {
            return [
                'success' => false,
                'message' => ApiError::beneficiarioNaoEncontrado($beneficiarioId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        return [
            'success' => true,
            'data' => $beneficiario,
            'message' => 'Beneficiário encontrado!',
            'code' => HttpStatus::OK,
        ];
    }

    public function create(Request $request): array
    {
        DB::beginTransaction();

        try {
            $beneficiario = $this->criarBeneficiario($request);
            $this->criarEndereco($request, $beneficiario);
            $this->criarTelefone($request, $beneficiario);

            DB::commit();

            return [
                'success' => true,
                'data' => ['id' => $beneficiario->id],
                'message' => 'Beneficiário criado com sucesso!',
                'code' => HttpStatus::CREATED,
            ];
        } catch (Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    public function update(Request $request, string $beneficiarioId): array
    {
        $resultado = $this->find($beneficiarioId);
        if (!$resultado['success']) {
            return $resultado;
        }

        $beneficiario = $resultado['data'];

        DB::beginTransaction();

        try {
            $this->removerEnderecos($beneficiario);
            $this->removerTelefones($beneficiario);
            $this->atualizarBeneficiario($request, $beneficiario);
            $this->criarEndereco($request, $beneficiario);
            $this->criarTelefone($request, $beneficiario);

            DB::commit();

            return [
                'success' => true,
                'data' => null,
                'message' => 'Beneficiario atualizado com sucesso!',
                'code' => HttpStatus::OK,
            ];
        } catch (Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    public function delete(Request $request, string $beneficiarioId): array
    {
        $resultado = $this->find($beneficiarioId);
        if (!$resultado['success']) {
            return $resultado;
        }

        $beneficiario = $resultado['data'];
        DB::beginTransaction();

        try {
            $this->removerEnderecos($beneficiario);
            $this->removerTelefones($beneficiario);
            $this->removerBeneficiario($beneficiario);

            DB::commit();

            return [
                'success' => true,
                'data' => null,
                'message' => 'Beneficiario removido com sucesso!',
                'code' => HttpStatus::OK,
            ];
        } catch (Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    private function criarBeneficiario(Request $request): Beneficiario
    {
        $beneficiario = Beneficiario::create([
            'parceiro_id' => $request->parceiro_id,
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'data_nascimento' => $request->data_nascimento,
            'trabalho' => $request->trabalho,
            'esta_desempregado' => $request->esta_desempregado,
            'estado_civil_id' => $request->estado_civil_id,
            'nome_conjuge' => $request->nome_conjuge,
            'cpf_conjuge' => $request->cpf_conjuge,
            'total_residentes' => $request->total_residentes,
            'situacao_moradia'=> $request->situacao_moradia,
            'renda_mensal'=> $request->renda_mensal,
            'gostaria_montar_negocio'=> $request->gostaria_montar_negocio,
            'gostaria_participar_cursos'=> $request->gostaria_participar_cursos,
            'tipo_curso'=> $request->tipo_curso,
            'concorda_informacoes_verdadeiras'=> $request->concorda_informacoes_verdadeiras,
            'data_submissao' => $request->data_submissao,
        ]);

        throw_if(
            !$beneficiario,
            Exception::class,
            [ApiError::falhaSalvarBeneficiario(), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $beneficiario;
    }

    private function atualizarBeneficiario(Request $request,
        Beneficiario $beneficiario): Beneficiario
    {
        $resultado = $beneficiario->update([
            'parceiro_id' => $request->parceiro_id,
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'email' => $request->email,
            'data_nascimento' => $request->data_nascimento,
            'trabalho' => $request->trabalho,
            'esta_desempregado' => $request->esta_desempregado,
            'estado_civil_id' => $request->estado_civil_id,
            'nome_conjuge' => $request->nome_conjuge,
            'cpf_conjuge' => $request->cpf_conjuge,
            'total_residentes' => $request->total_residentes,
            'situacao_moradia'=> $request->situacao_moradia,
            'renda_mensal'=> $request->renda_mensal,
            'gostaria_montar_negocio'=> $request->gostaria_montar_negocio,
            'gostaria_participar_cursos'=> $request->gostaria_participar_cursos,
            'tipo_curso'=> $request->tipo_curso,
            'concorda_informacoes_verdadeiras'=> $request->concorda_informacoes_verdadeiras,
            'data_submissao' => $request->data_submissao,
        ]);

        throw_if(
            !$resultado,
            Exception::class,
            [
                ApiError::falhaAtualizarBeneficiario($beneficiario->id),
                HttpStatus::INTERNAL_SERVER_ERROR,
            ],
        );

        return $beneficiario;
    }

    private function removerBeneficiario(Beneficiario $beneficiario)
    {
        $resultado = $beneficiario->delete();

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaRemoverBeneficiario(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    private function criarEndereco(Request $request, Beneficiario $beneficiario)
    {
        $enderecos = $request->only('enderecos');
        if (!empty($enderecos)) {
            foreach ($enderecos['enderecos'] as &$endereco) {
                $endereco['beneficiario_id'] = $beneficiario->id;
            }

            $resultado = $beneficiario->enderecos()->createMany($enderecos['enderecos']);

            throw_if(
                !$resultado,
                Exception::class,
                [ApiError::falhaSalvarEndereco(), HttpStatus::INTERNAL_SERVER_ERROR],
            );
        }
    }

    private function criarTelefone(Request $request, Beneficiario $beneficiario)
    {
        $telefones = $request->only('telefones');
        if (!empty($telefones)) {
            foreach ($telefones['telefones'] as &$telefone) {
                $telefone['beneficiario_id'] = $beneficiario->id;
                $telefone['tipo'] = Telefone::TIPO_TELEFONES[$telefone['tipo']];
            }

            $resultado = $beneficiario->telefones()->createMany($telefones['telefones']);

            throw_if(
                !$resultado,
                Exception::class,
                [ApiError::falhaSalvarTelefone(), HttpStatus::INTERNAL_SERVER_ERROR],
            );
        }
    }

    private function removerEnderecos(Beneficiario $beneficiario)
    {
        $resultado = Endereco::where('beneficiario_id', '=', $beneficiario->id)->delete();
    }

    private function removerTelefones(Beneficiario $beneficiario)
    {
        $resultado = Telefone::where('beneficiario_id', '=', $beneficiario->id)->delete();
    }
}
