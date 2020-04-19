<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Resources\AuthResource;
use App\Models\TipoPessoa;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class AuthRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            "nome" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email,{$this->getUserId()},id",
            "endereco" => "required|string|max:255",
            "estado" => "required|string|max:2",
            "tipo_pessoa" => "required|string|max:2|in:{$this->getTiposPessoa()}",
            "cpf" => "required_without:cnpj|cpf|size:11|unique:tipo_pessoas,cpf_cnpj,{$this->getUserId()},id",
            "cnpj" => "required_without:cpf|cnpj|size:14|unique:tipo_pessoas,cpf_cnpj,{$this->getUserId()},id",
            "perfis" => "required|array",
            "perfis.*.id" => "required|numeric|exists:perfis,id",
            "senha" => "required|string|min:8|confirmed",
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "required" => "O :attribute é obrigatório.",
            "required_without" => "O :attribute é obrigatório quando :values não foi informado.",
            "string" => "O :attribute deve ser um texto.",
            "max" => "O :attribute não pode ter mais que :max caracteres.",
            "size" => "O :attribute deve ter :size caracteres.",
            "email" => "O :attribute deve ser um endereço de e-mail válido.",
            "unique" => "O :attribute :input já foi utilizado.",
            "in" => "O :attribute é inválido (aceito: :values).",
            "cpf" => "O :attribute é inválido.",
            "cnpj" => "O :attribute é inválido.",
            "array" => "O :attribute deve ser uma matriz.",
            "numeric" => "O :attribute deve ser um numérico.",
            "exists" => "O :attribute '?' é inválido.",
            "confirmed" => "A confirmação da :attribute não corresponde.",
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            "nome" => "Nome",
            "email" => "E-mail",
            "endereco" => "Endereço",
            "estado" => "Estado",
            "tipo_pessoa" => "Tipo de Pessoa",
            "cpf" => "CPF",
            "cnpj" => "CNPJ",
            "perfis" => "Perfis de Usuário",
            "perfis.*.id" => "Perfil de Usuário",
            "senha" => "Senha",
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'cpf' => preg_replace('/[^0-9]/', '', $this->cpf),
            'cnpj' => preg_replace('/[^0-9]/', '', $this->cnpj),
        ]);
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     * @return void
     * @throws HttpResponseException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            (new AuthResource(null, false, "Existem campos inválidos.", $this->replaceErroPerfisAndTipoPessoa($validator)))
                ->response()
                ->setStatusCode(422)
        );
    }

    /**
     * Substitui parãmetro de erro da mensagem de perfil e tipo de pessoa
     *
     * @param Validator $validator
     * @return array
     */
    private function replaceErroPerfisAndTipoPessoa(Validator $validator): array
    {
        $errors = collect();
        $perfis['perfis'] = $this->perfis;
        foreach ($validator->failed() as $key => $value) {
            if (Arr::has($perfis, $key) && Arr::has($validator->errors()->messages(), $key)) {
                $descricao = Arr::get($perfis, Str::replaceFirst('id', 'descricao', $key));
                $message = Str::replaceFirst('?', $descricao, Arr::get($validator->errors()->messages(), $key)[0]);

                $errors->push($message);
            } elseif (Arr::has($validator->errors()->messages(), 'tipo_pessoa') && Arr::has($value, 'In')) {
                $in = implode(', ', $value['In']);
                $message = Str::replaceFirst($in, collect(array_values(TipoPessoa::TIPO_PESSOA))->join(', ', ' ou '), Arr::get($validator->errors()->messages(), $key)[0]);

                $errors->push($message);
            } else {
                $errors->push(Arr::get($validator->errors()->messages(), $key)[0]);
            }
        }

        return $errors->toArray();
    }

    /**
     * Retorna o Id do usuário logado ou nulo
     *
     * @return int|null
     */
    private function getUserId(): ?int
    {
        return $this->user()->id ?? null;
    }

    /**
     * Retorna os tipos de pessoa
     *
     * @return string
     */
    private function getTiposPessoa(): string
    {
        return implode(',', array_keys(TipoPessoa::TIPO_PESSOA));
    }
}
