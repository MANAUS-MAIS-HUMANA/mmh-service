<?php

declare(strict_types=1);

namespace App\Traits;

use App\Models\TipoPessoa;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest as FormRequestBase;
use Illuminate\Support\Str;

trait FormRequest
{
    /**
     * Retorna os tipos de pessoa
     *
     * @return string
     */
    protected function getTiposPessoa(): string
    {
        return implode(',', array_keys(TipoPessoa::TIPO_PESSOA));
    }

    /**
     * Retorna os tipos de status
     *
     * @return string
     */
    protected function getStatus(): string
    {
        return implode(',', array_keys(User::STATUS_USUARIO));
    }

    /**
     * Valida, remove caracteres e faz o merge do CPF ou CNPJ.
     *
     * @param FormRequestBase $formRequest
     */
    protected function mergeExistsCpfOrCnpj(FormRequestBase $formRequest): void
    {
        $attributes = [];
        if (isset($formRequest->cpf)) {
            $attributes['cpf'] = preg_replace('/[^0-9]/', '', $formRequest->cpf);
        }

        if (isset($formRequest->cnpj)) {
            $attributes['cnpj'] = preg_replace('/[^0-9]/', '', $formRequest->cnpj);
        }

        $formRequest->merge($attributes);
    }

    /**
     * Valida, transforma o caracter de maúscula e faz o merge no status.
     *
     * @param FormRequestBase $formRequest
     */
    protected function mergeExistsStatus(FormRequestBase $formRequest): void
    {
        if (isset($formRequest->status)) {
            $formRequest->merge([
                'status' => Str::upper($formRequest->status)
            ]);
        }
    }

    /**
     * Valida se o e-mail pertence ao Id.
     *
     * @param FormRequestBase $formRequest
     * @return bool
     */
    protected function validateEmailBelongsToId(FormRequestBase $formRequest): bool
    {
        $usuario = User::whereEmail($formRequest->email)
            ->find($formRequest->id);

        return $usuario->exists ?? false;
    }
}
