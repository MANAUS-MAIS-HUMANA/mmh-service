<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\TipoPessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TipoPessoaService
{
    /**
     * Cria o tipo de pessoa
     *
     * @param Request $request
     * @return array
     */
    public function create(Request $request): array
    {
        DB::beginTransaction();

        try {
            $tipoPessoa = TipoPessoa::create([
                'tipo_pessoa' => $request->tipo_pessoa,
                'cpf_cnpj' => $request->cpf ?? $request->cnpj,
            ]);

            throw_if(!$tipoPessoa, \Exception::class, ['Não foi possível criar o Tipo de Pessoa!', 500]);

            DB::commit();

            return [
                'success' => true,
                'data' => $tipoPessoa,
                'message' => 'Tipo de Pessoa criado com sucesso!',
                'code' => 201,
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
