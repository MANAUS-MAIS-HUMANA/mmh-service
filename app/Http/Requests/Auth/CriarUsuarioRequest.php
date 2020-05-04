<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Resources\Auth\CriarUsuarioResource;
use App\Models\TipoPessoa;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class CriarUsuarioRequest extends FormRequest
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
            "email" => "required|string|email|max:255|unique:users,email",
            "endereco" => "required|string|max:255",
            "estado" => "required|string|size:2",
            "tipo_pessoa" => "required|string|in:{$this->getTiposPessoa()}",
            "cpf" => "required_without:cnpj|cpf|size:11|unique:tipo_pessoas,cpf_cnpj",
            "cnpj" => "required_without:cpf|cnpj|size:14|unique:tipo_pessoas,cpf_cnpj",
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
            "exists" => "O :attribute '?' é inválido.",

            "senha.required" => "A :attribute é obrigatória.",
            "senha.string" => "A :attribute deve ser um texto.",
            "senha.min" => "A :attribute não pode ter menos de :min caracteres.",
            "senha.confirmed" => "A confirmação da :attribute não corresponde.",
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
            (new CriarUsuarioResource(null, false, "Existem campos inválidos.", $this->replaceErroPerfisAndTipoPessoa($validator)))
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
        foreach ($validator->failed() as $key => $value) {
            if (Arr::has($validator->errors()->messages(), 'tipo_pessoa') && Arr::has($value, 'In')) {
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
     * Retorna os tipos de pessoa
     *
     * @return string
     */
    private function getTiposPessoa(): string
    {
        return implode(',', array_keys(TipoPessoa::TIPO_PESSOA));
    }
}
