<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiError;
use App\Helpers\HttpStatus;
use App\Models\Endereco;
use App\Models\Parceiro;
use App\Models\Telefone;
use App\Models\TipoPessoa;
use App\Services\EndercoService;
use App\Services\TelefoneService;

class ParceiroService
{
    const PARCEIROS_POR_PAGINA = 6;

    public function __construct(Parceiro $parceiro)
    {
        $this->parceiro = $parceiro;
    }

    public function get(Request $request): array
    {
        $limit = (int)$request->query('limit');

        if ($limit == 0) {
            $limit = self::PARCEIROS_POR_PAGINA;
        }

        try {
            $parceiros = $this->parceiro->paginate($limit);

            $resultado = [
                'success' => true,
                'data' => $parceiros,
                'message' => 'Parceiro obtido com sucesso!',
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

    public function find(string $parceiroId): array
    {
        $parceiro = Parceiro::find($parceiroId);
        if (is_null($parceiro)) {
            return [
                'success' => false,
                'message' => ApiError::parceiroNaoEncontrado($parceiroId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        return [
            'success' => true,
            'data' => $parceiro,
            'message' => 'Parceiro encontrado!',
            'code' => HttpStatus::OK,
        ];
    }

    public function create(Request $request): array
    {
        DB::beginTransaction();

        try {
            $tipoPessoa = $this->criarTipoPessoa($request);
            $parceiro = $this->criarParceiro($request, $tipoPessoa);
            $this->criarEndereco($request, $parceiro);
            $this->criarTelefone($request, $parceiro);

            DB::commit();

            return [
                'success' => true,
                'data' => ['id' => $parceiro->id],
                'message' => 'Parceiro criado com sucesso!',
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

    public function update(Request $request, string $parceiroId): array
    {
        $resultado = $this->find($parceiroId);
        if (!$resultado['success']) {
            return $resultado;
        }

        $parceiro = $resultado['data'];

        DB::beginTransaction();

        try {
            $this->removerEnderecos($parceiro);
            $this->removerTelefones($parceiro);
            $this->atualizarParceiro($request, $parceiro);
            $this->atualizarTipoPessoa($request, $parceiro->tipoPessoa);
            $this->criarEndereco($request, $parceiro);
            $this->criarTelefone($request, $parceiro);

            DB::commit();

            return [
                'success' => true,
                'data' => $parceiro,
                'message' => 'Parceiro atualizado com sucesso!',
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

    public function delete(Request $request, string $parceiroId): array
    {
        $resultado = $this->find($parceiroId);
        if (!$resultado['success']) {
            return $resultado;
        }

        $parceiro = $resultado['data'];
        DB::beginTransaction();

        try {
            $this->removerTelefones($parceiro);
            $this->removerEnderecos($parceiro);
            $tipoPessoaId = $parceiro->tipoPessoa->id;
            $this->removerParceiro($parceiro);
            $this->removerTipoPessoa($tipoPessoaId);

            DB::commit();

            return [
                'success' => true,
                'data' => null,
                'message' => 'Parceiro removido com sucesso!',
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

    private function criarParceiro(Request $request, TipoPessoa $tipoPessoa): Parceiro
    {
        $parceiro = Parceiro::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'tipo_pessoa_id' => $tipoPessoa->id,
        ]);

        throw_if(
            !$parceiro,
            Exception::class,
            [ApiError::falhaSalvarParceiro(), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $parceiro;
    }

    private function criarTipoPessoa(Request $request): TipoPessoa
    {
        $tipoPessoa = new TipoPessoa();
        $tipoPessoa->tipo_pessoa = $this->getTipoPessoa($request);
        $tipoPessoa->cpf_cnpj = $this->getCpfOrCnpj($request);
        $resultado = $tipoPessoa->save();

        throw_if(
            !$resultado,
            \Exception::class,
            ApiError::falhaSalvarTipoPessoa(), HttpStatus::INTERNAL_SERVER_ERROR,
        );

        return $tipoPessoa;
    }

    private function getTipoPessoa(Request $request): string
    {
        return $request->cnpj ? TipoPessoa::TIPO_PESSOA_PJ : TipoPessoa::TIPO_PESSOA_PF;
    }

    private function getCpfOrCnpj(Request $request): string
    {
        return $request->cnpj ??= $request->cpf;
    }

    private function criarEndereco(Request $request, Parceiro $parceiro)
    {
        $enderecos = $request->only('enderecos');
        foreach ($enderecos['enderecos'] as &$endereco) {
            $endereco['parceiro_id'] = $parceiro->id;
        }

        $resultado = $parceiro->enderecos()->createMany($enderecos['enderecos']);

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaSalvarEndereco(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    private function criarTelefone(Request $request, Parceiro $parceiro)
    {
        $telefones = $request->only('telefones');
        foreach ($telefones['telefones'] as &$telefone) {
            $telefone['parceiro_id'] = $parceiro->id;
            $telefone['tipo'] = Telefone::TIPO_TELEFONES[$telefone['tipo']];
        }

        $resultado = $parceiro->telefones()->createMany($telefones['telefones']);

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaSalvarTelefone(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    private function atualizarParceiro(Request $request, Parceiro $parceiro): Parceiro
    {
        $resultado = $parceiro->update([
            'nome' => $request->nome,
            'email' => $request->email,
            'tipo_pessoa_id' => $parceiro->tipoPessoa->id,
        ]);

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaAtualizarParceiro($parceiro->id), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $parceiro;
    }

    private function atualizarTipoPessoa(Request $request, TipoPessoa $tipoPessoa)
    {
        $tipoPessoa->tipo_pessoa = $this->getTipoPessoa($request);
        $tipoPessoa->cpf_cnpj = $this->getCpfOrCnpj($request);
        $resultado = $tipoPessoa->update();

        throw_if(
            !$resultado,
            Exception::class,
            [
                ApiError::falhaAtualizarTipoPessoa($tipoPessoa->id),
                HttpStatus::INTERNAL_SERVER_ERROR,
            ],
        );
    }

    private function removerParceiro(Parceiro $parceiro)
    {
        $resultado = $parceiro->delete();

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaRemoverParceiro(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    private function removerTipoPessoa(int $tipoPessoaId)
    {
        $resultado = TipoPessoa::where('id', '=', $tipoPessoaId)->delete();

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaRemoverTipoPessoa(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    private function removerEnderecos(Parceiro $parceiro)
    {
        $resultado = Endereco::where('parceiro_id', '=', $parceiro->id)->delete();

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaRemoverEndereco(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    private function removerTelefones(Parceiro $parceiro)
    {
        $resultado = Telefone::where('parceiro_id', '=', $parceiro->id)->delete();

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaRemoverTelefone(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }
}
