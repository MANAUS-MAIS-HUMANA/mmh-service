<?php

declare(strict_types=1);

namespace App\Http\Requests\Parceiro;

use App\Http\Resources\FormRequest\FailedResource;
use App\Traits\FormRequest as FormRequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AtualizarParceiroRequest extends FormRequest
{
    use FormRequestTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'nome' => 'required|min:2',
            'email' => "required|email|unique:parceiros,email,{$this->id},id",
            'cpf' => 'required_without:cnpj|cpf|size:11',
            'cnpj' => 'required_without:cpf|cnpj|size:14',
            'telefones' => 'required|array|min:1',
            'telefones.*.telefone' => "required|numeric|min:10|unique:telefones," .
                "telefone,{$this->id},parceiro_id",
            'telefones.*.tipo' => 'required|in:Celular,Fixo',
            'enderecos' => 'required|array|min:1',
            'enderecos.*.endereco' => 'required|max:255',
            'enderecos.*.bairro_id' => 'required|exists:bairros,id',
            'enderecos.*.cidade_id' => 'required|exists:cidades,id',
        ];

        return $rules;
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
            "min" => "O :attribute não pode ter menos que :min caracteres.",
            "max" => "O :attribute não pode ter mais que :max caracteres.",
            "email" => "O :attribute deve ser um endereço de e-mail válido.",
            "in" => "O :attribute é inválido (aceito: :values).",
            "cpf" => "O :attribute é inválido.",
            "cnpj" => "O :attribute é inválido.",
            "array" => "O :attribute deve ser um array.",
            "numeric" => "O :attribute deve ser um numérico.",
            "exists" => "O :attribute é inválido.",
            "digits" => "O :attribute deve possuir somente números.",
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
            'nome' => 'Nome',
            'email' => 'Email',
            'cpf' => 'CPF',
            'cnpj' => 'CNPJ',
            'telefones' => 'Telefone',
            'telefones.*.telefone' => 'Número do Telefone',
            'telefones.*.tipo' => 'Tipo do Telefone',
            'enderecos' => 'Endereço',
            'enderecos.*.endereco' => 'Endereço',
            'enderecos.*.bairro_id' => 'ID do Bairro',
            'enderecos.*.ponto_referencia' => 'Ponto de Referência',
            'enderecos.*.cep' => 'CEP',
            'enderecos.*.cidade_id' => 'ID da Cidade',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->mergeExistsCpfOrCnpj($this);
        $this->sanitizarNomes($this);
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
        $failedResource = new FailedResource(
            null,
            false,
            "Existem campos inválidos.",
            $validator->errors()->unique(),
        );

        throw new HttpResponseException($failedResource->response()->setStatusCode(422));
    }

    /**
     * Handle a failed authorization attempt.
     *
     * @return void
     */
    public function failedAuthorization(): void
    {
        $failedResource = new FailedResource(null, false, "Está ação não é autorizada.");

        throw new HttpResponseException($failedResource->response()->setStatusCode(403));
    }
}
