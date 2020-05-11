<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\TipoPessoa;
use App\Services\TipoPessoaService;
use Illuminate\Http\Request;

trait Pessoa
{
    /**
     * @var TipoPessoaService
     */
    private TipoPessoaService $tipoPessoaService;

    /**
     * Pessoa constructor.
     * @param TipoPessoaService $tipoPessoaService
     */
    public function __construct(TipoPessoaService $tipoPessoaService)
    {
        $this->tipoPessoaService = $tipoPessoaService;
    }

    /**
     * Solicita a criação do tipo de pesssoa.
     *
     * @param Request $request
     * @return TipoPessoa
     * @throws \Throwable
     */
    protected function createTipoPessoa(Request $request): TipoPessoa
    {
        $tipoPessoa = $this->tipoPessoaService->create($request);

        throw_if(
            !$tipoPessoa['success'], \Exception::class, $tipoPessoa['message'], $tipoPessoa['code']
        );

        return data_get($tipoPessoa, 'data');
    }

    /**
     * Solicita a atualização do tipo de pessoa.
     *
     * @param int $id
     * @param Request $request
     * @return void
     * @throws \Throwable
     */
    protected function updateTipoPessoa(int $id, Request $request): void
    {
        $tipoPessoa = $this->tipoPessoaService->update($id, $request);

        throw_if(
            !$tipoPessoa['success'], \Exception::class, $tipoPessoa['message'], $tipoPessoa['code']
        );
    }
}
