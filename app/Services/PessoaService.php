<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Pessoa;
use App\Models\TipoPessoa;
use App\Traints\Pessoa as PessoaTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PessoaService
{
    use PessoaTrait;

    /**
     * @var TipoPessoaService
     */
    private TipoPessoaService $tipoPessoaService;

    /**
     * PessoaService constructor.
     * @param TipoPessoaService $tipoPessoaService
     */
    public function __construct(TipoPessoaService $tipoPessoaService)
    {
        $this->tipoPessoaService = $tipoPessoaService;
    }

    /**
     * Cria a pessoa
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request): array
    {
        DB::beginTransaction();

        try {
            $tipoPessoa = $this->createTipoPessoa($request);

            $pessoa = Pessoa::create([
                'nome' => $request->nome,
                'endereco' => $request->endereco,
                'estado' => $request->estado,
                'tipo_pessoa_id' => $tipoPessoa->id,
            ]);

            throw_if(
                !$pessoa, \Exception::class, 'Não foi possível criar a Pessoa!', 500
            );

            DB::commit();

            return [
                'success' => true,
                'data' => $pessoa,
                'message' => 'Pessoa criada com sucesso!',
                'code' => 201
            ];
        } catch (\Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }

    /**
     * Atualiza a pessoa.
     *
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function update(int $id, Request $request): array
    {
        DB::beginTransaction();

        try {
            $pessoa = Pessoa::find($id);

            throw_if(
                !$pessoa, \Exception::class, 'Pessoa não encontrada!', 404
            );

            $tipoPessoa = $pessoa->tipoPessoa;

            $this->updateTipoPessoa($tipoPessoa->id, $request);

            $pessoa = tap($pessoa)->update([
                'nome' => $request->nome,
                'endereco' => $request->endereco,
                'estado' => $request->estado
            ])->fresh();

            DB::commit();

            return [
                'success' => true,
                'data' => $pessoa,
                'message' => 'Pessoa atualizada com sucesso!',
                'code' => 200
            ];
        } catch (\Throwable $e) {
            DB::rollBack();

            return [
                'success' => false,
                'message' => $e->getMessage(),
                'code' => $e->getCode(),
            ];
        }
    }
}
