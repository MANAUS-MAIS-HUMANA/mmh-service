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
    private array $regrasValidacao = [
        'nome' => 'required|min:2',
        'email' => 'required|email',
        'cpf' => 'nullable|digits:11',
        'cnpj' => 'nullable|digits:14',
        'telefones' => 'required|array|min:1',
        'telefones.*.telefone' => 'required|numeric|min:10',
        'telefones.*.tipo' => 'required|in:Celular,Fixo',
        'enderecos' => 'required|array|min:1',
        'enderecos.*.endereco' => 'required|max:255',
        'enderecos.*.bairro_id' => 'required|exists:bairros,id',
        'enderecos.*.ponto_referencia' => 'nullable',
        'enderecos.*.cep' => 'required|digits:8',
        'enderecos.*.cidade_id' => 'required|exists:cidades,id',
    ];

    public function create(Request $request): array
    {
        $resultado = $this->validate($request);
        if (!$resultado[0]) {
            return [
                'success' => false,
                'message' => $resultado[1],
                'code' => HttpStatus::BAD_REQUEST,
            ];
        }

        $dados = $resultado[1];
        DB::beginTransaction();

        try {
            $tipoPessoa = $this->criarTipoPessoa($dados);
            $parceiro = $this->criarParceiro($dados, $tipoPessoa);
            $this->criarEndereco($dados, $parceiro);
            $this->criarTelefone($dados, $parceiro);

            DB::commit();

            return [
                'success' => true,
                'data' => $parceiro,
                'message' => 'Parceiro criada com sucesso!',
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
        $parceiro = Parceiro::find($parceiroId);
        if (is_null($parceiro)) {
            return [
                'success' => false,
                'message' => ApiError::parceiroNaoEncontrado($parceiroId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }
        $resultado = $this->validate($request);
        if (!$resultado[0]) {
            return [
                'success' => false,
                'message' => $resultado[1],
                'code' => HttpStatus::BAD_REQUEST,
            ];
        }

        $dados = $resultado[1];
        DB::beginTransaction();

        try {
            $this->removerEnderecos($parceiro);
            $this->removerTelefones($parceiro);
            $this->atualizarParceiro($dados, $parceiro);
            $this->atualizarTipoPessoa($dados, $parceiro->tipoPessoa);
            $this->criarEndereco($dados, $parceiro);
            $this->criarTelefone($dados, $parceiro);

            DB::commit();

            return [
                'success' => true,
                'data' => $parceiro,
                'message' => 'Parceiro criada com sucesso!',
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

    protected function validate(Request $request): array
    {
        $dadosValidados = $request->validate($this->regrasValidacao);

        if (!isset($dadosValidados['cpf']) && !isset($dadosValidados['cnpj'])) {
            return [false, ApiError::cpfCnpjNaoEncontrado()];
        }

        return [true, $dadosValidados];
    }

    private function criarParceiro(array $dados, TipoPessoa $tipoPessoa): Parceiro
    {
        $parceiro = Parceiro::create([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'tipo_pessoa_id' => $tipoPessoa->id,
        ]);

        throw_if(
            !$parceiro,
            Exception::class,
            [ApiError::falhaSalvarParceiro(), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $parceiro;
    }

    private function criarTipoPessoa(array $dados): TipoPessoa
    {
        $tipoPessoa = new TipoPessoa();
        $tipoPessoa->tipo_pessoa = $this->getTipoPessoa($dados);
        $tipoPessoa->cpf_cnpj = $this->getCpfOrCnpj($dados);
        $resultado = $tipoPessoa->save();

        throw_if(
            !$resultado,
            \Exception::class,
            ApiError::falhaSalvarTipoPessoa(), HttpStatus::INTERNAL_SERVER_ERROR,
        );

        return $tipoPessoa;
    }

    private function getTipoPessoa(array $dados): string
    {
        if (isset($dados['cnpj'])) {
            return TipoPessoa::TIPO_PESSOA_PJ;
        }

        return TipoPessoa::TIPO_PESSOA_PF;
    }

    private function getCpfOrCnpj(array $dados): string
    {
        if (isset($dados['cnpj'])) {
            return $dados['cnpj'];
        }

        return $dados['cpf'];
    }

    private function criarEndereco(array $dados, Parceiro $parceiro)
    {
        foreach($dados['enderecos'] as $endereco) {
            $endereco['parceiro_id'] = $parceiro->id;
            $novoEndereco = Endereco::create($endereco);

            throw_if(
                !$novoEndereco,
                Exception::class,
                [ApiError::falhaSalvarEndereco(), HttpStatus::INTERNAL_SERVER_ERROR],
            );
        }
    }

    private function criarTelefone(array $dados, Parceiro $parceiro)
    {
        foreach($dados['telefones'] as $telefone) {
            $telefone['parceiro_id'] = $parceiro->id;
            $telefone['tipo'] = Telefone::TIPO_TELEFONES[$telefone['tipo']];
            $novoTelefone = Telefone::create($telefone);

            throw_if(
                !$novoTelefone,
                Exception::class,
                [ApiError::falhaSalvarTelefone(), HttpStatus::INTERNAL_SERVER_ERROR],
            );
        }
    }

    private function atualizarParceiro(array $dados, Parceiro $parceiro): Parceiro
    {
        $resultado = $parceiro->update([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'tipo_pessoa_id' => $parceiro->tipoPessoa->id,
        ]);

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaAtualizarParceiro($parceiro->id), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $parceiro;
    }

    private function atualizarTipoPessoa(array $dados, TipoPessoa $tipoPessoa)
    {
        $tipoPessoa->tipo_pessoa = $this->getTipoPessoa($dados);
        $tipoPessoa->cpf_cnpj = $this->getCpfOrCnpj($dados);
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
