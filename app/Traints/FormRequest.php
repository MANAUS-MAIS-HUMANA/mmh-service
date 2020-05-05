<?php

declare(strict_types=1);

namespace App\Traints;

use App\Models\TipoPessoa;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest as FormRequestBase;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

trait FormRequest
{
    /**
     * Substitui parãmetro de erro da mensagem de perfil
     *
     * @param Validator $validator
     * @param array $perfis
     * @return array
     */
    protected function replaceErroPerfis(Validator $validator, array $perfis): array
    {
        $errorsPerfis = collect();
        $perfis['perfis'] = $perfis;
        foreach ($validator->failed() as $key => $value) {
            if (Arr::has($perfis, $key) && Arr::has($validator->errors()->messages(), $key)) {
                $descricao = Arr::get($perfis, Str::replaceFirst('id', 'perfil', $key));

                if ($descricao) {
                    $message = Str::replaceFirst(
                        '?', $descricao, Arr::get($validator->errors()->messages(), $key)[0]
                    );
                } else {
                    $message = preg_replace(
                        '/\s+/', ' ',
                        Str::replaceFirst(
                            '\'?\'',null, Arr::get($validator->errors()->messages(), $key)[0]
                        )
                    );
                }

                $errorsPerfis->push($message);
            } else {
                $errorsPerfis->push(Arr::get($validator->errors()->messages(), $key)[0]);
            }
        }

        return $errorsPerfis->unique()->toArray();
    }

    /**
     * Substitui parãmetro de erro da mensagem do tipo de pessoa
     *
     * @param Validator $validator
     * @return array
     */
    protected function replaceErroTipoPessoa(Validator $validator): array
    {
        $errorsTipoPessoa = collect();
        foreach ($validator->failed() as $key => $value) {
            if (Arr::has($validator->errors()->messages(), 'tipo_pessoa') && Arr::has($value, 'In')) {
                $in = implode(', ', $value['In']);
                $message = Str::replaceFirst(
                    $in, collect(array_values(TipoPessoa::TIPO_PESSOA))->join(', ', ' ou '),
                    Arr::get($validator->errors()->messages(), $key)[0]
                );

                $errorsTipoPessoa->push($message);
            } else {
                $errorsTipoPessoa->push(Arr::get($validator->errors()->messages(), $key)[0]);
            }
        }

        return $errorsTipoPessoa->unique()->toArray();
    }

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
}
