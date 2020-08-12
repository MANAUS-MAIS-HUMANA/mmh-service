<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiError;
use App\Helpers\HttpStatus;
use App\Models\Beneficiario;
use App\Models\BeneficiarioDoacao;
use App\Models\Endereco;
use App\Models\Parceiro;
use App\Models\Telefone;
use App\Models\TipoPessoa;

class ParceiroService
{
    const PARCEIROS_POR_PAGINA = 6;
    const BENEFICIARIO_POR_PAGINA = 6;
    const DOACAO_POR_PAGINA = 6;

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

    public function basic(Request $request): array
    {
        try {
            $parceiros = $this->parceiro->get(['id', 'nome']);

            $resultado = [
                'success' => true,
                'data' => $parceiros->makeHidden(['telefones', 'enderecos']),
                'message' => 'Parceiros obtidos com sucesso!',
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

    public function getParceiroByCpfOrCnpj(string $cpfOrCnpj)
    {
        return Parceiro::where('cpf_cnpj', '=', $cpfOrCnpj)->first();
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
            $parceiro = $this->criarParceiro($request);
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
            $this->removerParceiro($parceiro);

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

    private function criarParceiro(Request $request): Parceiro
    {
        $parceiro = Parceiro::create([
            'nome' => $request->nome,
            'email' => $request->email,
            'tipo_pessoa' => $this->getTipoPessoa($request),
            'cpf_cnpj' => $this->getCpfOrCnpj($request),
        ]);

        throw_if(
            !$parceiro,
            Exception::class,
            [ApiError::falhaSalvarParceiro(), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $parceiro;
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
            'tipo_pessoa' => $this->getTipoPessoa($request),
            'cpf_cnpj' => $this->getCpfOrCnpj($request),
        ]);

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaAtualizarParceiro($parceiro->id), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $parceiro;
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

    public function createDonation(Request $request, string $parceiroId, string $beneficiaryId): array
    {
        $parceiro = Parceiro::find($parceiroId);
        if (is_null($parceiro)) {
            return [
                'success' => false,
                'message' => ApiError::parceiroNaoEncontrado($parceiroId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        $beneficiario = Beneficiario::find($beneficiaryId);
        if (is_null($beneficiario)) {
            return [
                'success' => false,
                'message' => ApiError::beneficiarioNaoEncontrado($beneficiaryId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        DB::beginTransaction();

        try {
            $beneficiarioDoacao = new BeneficiarioDoacao();
            $beneficiarioDoacao->total_cestas = $request->total_cestas;
            $beneficiarioDoacao->data_doacao = $request->data_doacao;
            $beneficiarioDoacao->parceiro_id = $parceiro->id;
            $beneficiarioDoacao->beneficiario_id = $beneficiario->id;
            $beneficiarioDoacao->save();

            DB::commit();

            return [
                'success' => true,
                'data' => ['id' => $beneficiarioDoacao->id],
                'message' => 'Doação do beneficiario criado com sucesso!',
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

    private function removerDoacao(BeneficiarioDoacao $doacao)
    {
        $resultado = $doacao->delete();

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaRemoverDoacaoBeneficiario(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    public function findDonation(string $donationId): array
    {
        $doacao = BeneficiarioDoacao::find($donationId);

        if (is_null($doacao)) {
            return [
                'success' => false,
                'message' => ApiError::doacaoNaoEncontrado($donationId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        return [
            'success' => true,
            'data' => $doacao,
            'message' => 'Doação encontrado!',
            'code' => HttpStatus::OK,
        ];
    }

    public function deleteDonation(string $parceiroId, string $beneficiarioId, string $doacaoId): array
    {
        $resultado = $this->findDonation($doacaoId);

        if (!$resultado['success']) {
            return $resultado;
        }

        if ($resultado['data']['parceiro_id'] != $parceiroId) {
            return [
                'success' => false,
                'message' => ApiError::doacaoPossuiOutroParceiro($doacaoId, $parceiroId),
                'code' => HttpStatus::BAD_REQUEST,
            ];
        }

        if ($resultado['data']['beneficiario_id'] != $beneficiarioId) {
            return [
                'success' => false,
                'message' => ApiError::doacaoPossuiOutroBeneficiario($doacaoId, $beneficiarioId),
                'code' => HttpStatus::BAD_REQUEST,
            ];
        }


        DB::beginTransaction();

        try {
            $this->removerDoacao($resultado['data']);

            DB::commit();

            return [
                'success' => true,
                'data' => null,
                'message' => 'Doação removido com sucesso!',
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

    public function getDonations(Request $request, string $parceiroId, string $beneficiaryId): array
    {
        $limit = (int)$request->query('limit');

        if ($limit == 0) {
            $limit = self::DOACAO_POR_PAGINA;
        }

        $parceiro = Parceiro::find($parceiroId);
        if (!$parceiro) {
            return [
                'success' => false,
                'message' => ApiError::parceiroNaoEncontrado($beneficiaryId),
                'code' => HttpStatus::BAD_REQUEST,
            ];
        }

        $beneficiario = Beneficiario::find($beneficiaryId);
        if (is_null($beneficiario)) {
            return [
                'success' => false,
                'message' => ApiError::beneficiarioNaoEncontrado($beneficiaryId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        try {
            $doacoes = BeneficiarioDoacao::where([
                        ['parceiro_id', '=', $parceiroId],
                        ['beneficiario_id', '=', $beneficiaryId],
                    ])->paginate($limit);

            $resultado = [
                'success' => true,
                'data' => $doacoes,
                'message' => 'Doações obtidos com sucesso!',
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

    public function getBeneficiaries(Request $request, string $parceiroId): array
    {
        $parceiro = Parceiro::find($parceiroId);
        if (is_null($parceiro)) {
            return [
                'success' => false,
                'message' => ApiError::parceiroNaoEncontrado($parceiroId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        $limit = (int)$request->query('limit');

        if ($limit == 0) {
            $limit = self::BENEFICIARIO_POR_PAGINA;
        }

        try {
            $beneficiarios = Beneficiario::select(
                'id',
                'nome',
                'cpf',
                'ativo'
            )
            ->where('parceiro_id', '=', $parceiroId)
            ->paginate($limit);

            $resultado = [
                'success' => true,
                'data' => $beneficiarios,
                'message' => 'Beneficiarios obtidos com sucesso!',
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
}
