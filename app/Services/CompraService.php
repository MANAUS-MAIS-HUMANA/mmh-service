<?php

declare(strict_types=1);

namespace App\Services;

use Exception;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\ApiError;
use App\Helpers\HttpStatus;
use App\Models\Compra;
use App\Models\Fornecedor;

class CompraService
{
    const COMPRAS_POR_PAGINA = 6;

    public function __construct(Compra $compra)
    {
        $this->compra = $compra;
    }

    public function get(Request $request): array
    {
        $limit = (int)$request->query('limit');

        if ($limit == 0) {
            $limit = self::COMPRAS_POR_PAGINA;
        }

        try {
            $compras = $this->compra->paginate($limit);

            $resultado = [
                'success' => true,
                'data' => $compras,
                'message' => 'Compras obtido com sucesso!',
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

    public function find(string $compraId): array
    {
        $compra = Compra::find($compraId);

        if (is_null($compra)) {
            return [
                'success' => false,
                'message' => ApiError::CompraNaoEncontrado($compraId),
                'code' => HttpStatus::NOT_FOUND,
            ];
        }

        return [
            'success' => true,
            'data' => $compra,
            'message' => 'Compra encontrada!',
            'code' => HttpStatus::OK,
        ];
    }

    public function create(Request $request): array
    {
        DB::beginTransaction();

        try {
            $compra = $this->criarCompra($request);
            $this->criarFornecedores($request, $compra);

            DB::commit();

            return [
                'success' => true,
                'data' => ['id' => $compra->id],
                'message' => 'Compra criado com sucesso!',
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

    public function update(Request $request, string $compraId): array
    {
        $resultado = $this->find($compraId);
        if (!$resultado['success']) {
            return $resultado;
        }

        $compra = $resultado['data'];

        DB::beginTransaction();

        try {
            $this->removerFornecedores($compra);
            $this->atualizarCompra($request, $compra);
            $this->criarFornecedores($request, $compra);

            DB::commit();

            return [
                'success' => true,
                'data' => null,
                'message' => 'Compra atualizada com sucesso!',
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

    public function delete(Request $request, string $compraId)
    {
        $resultado = $this->find($compraId);

        if (!$resultado['success']) {
            return $resultado;
        }

        $compra = $resultado['data'];

        DB::beginTransaction();

        try {
            $this->removerFornecedores($compra);
            $this->removerCompra($compra);

            DB::commit();

            return [
                'success' => true,
                'data' => null,
                'message' => 'Compra removida com sucesso!',
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

    private function criarCompra(Request $request): Compra
    {
        $compra = Compra::create([
            'descricao_compra' => $request->descricao_compra,
            'quantidade_cestas' => $request->quantidade_cestas,
            'valor_cesta' => $request->valor_cesta,
            'itens_cestas' => $request->itens_cestas,
            'justificativa_escolha' => $request->justificativa_escolha,
        ]);

        throw_if(
            !$compra,
            Exception::class,
            [ApiError::falhaSalvarCompra(), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $compra;
    }

    private function atualizarCompra(Request $request, Compra $compra): Compra
    {

        $resultado = $compra->update([
            'descricao_compra' => $request->descricao_compra,
            'quantidade_cestas' => $request->quantidade_cestas,
            'valor_cesta' => $request->valor_cesta,
            'itens_cestas' => $request->itens_cestas,
            'justificativa_escolha' => $request->justificativa_escolha,
        ]);

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaAtualizarCompra($compra->id), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $compra;
    }

    private function criarFornecedores(Request $request, Compra $compra): array
    {

        $fornecedores = [];

        foreach ($request->fornecedores as $fornecedorInfo) {
            $fornecedor = Fornecedor::create([
                'nome' => $fornecedorInfo['nome'],
                'contemplado' => $fornecedorInfo['contemplado'],
                'compra_id' => $compra->id,
            ]);

            array_push($fornecedores, $fornecedor);
        }

        throw_if(
            empty($fornecedores),
            Exception::class,
            [ApiError::falhaSalvarfornecedores(), HttpStatus::INTERNAL_SERVER_ERROR],
        );

        return $fornecedores;
    }

    private function removerFornecedores($compra)
    {
        $resultado = Fornecedor::where('compra_id', '=', $compra->id)->delete();

        throw_if(
            !$resultado && $resultado != 0,
            Exception::class,
            [ApiError::falhaRemoverFornecedores(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }

    private function removerCompra($compra)
    {
        $resultado = $compra->delete();

        throw_if(
            !$resultado,
            Exception::class,
            [ApiError::falhaRemoverCompra(), HttpStatus::INTERNAL_SERVER_ERROR],
        );
    }
}
