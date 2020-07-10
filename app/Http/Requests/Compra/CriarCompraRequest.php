<?php

declare(strict_types=1);

namespace App\Http\Requests\Compra;

use App\Http\Resources\FormRequest\FailedResource;
use App\Traits\FormRequest as FormRequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CriarCompraRequest extends FormRequest
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
        return [
            'descricao_compra' => 'required|string',
            'quantidade_cestas' => 'required|integer|min:1',
            'valor_cesta' => 'required|numeric|min:0',
            'itens_cestas' => 'required|string',
            'justificativa_escolha' => 'required|string',
            'fornecedores' => 'required|array',
            'fornecedores.*.nome' => 'required|string',
            'fornecedores.*.contemplado' => 'required|boolean',
        ];
    }

    /**
     * Get purchase messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "array" => "O :attribute deve ser um array.",
            "boolean" => "O :attribute deve ser um tipo booleano (true ou false).",
            "integer" => "O :attribute deve ser um número inteiro.",
            "min" => "O :attribute não pode ter menos que :min caracteres.",
            "numeric" => "O :attribute deve ser um número.",
            "required" => "O :attribute é obrigatório.",
        ];
    }

    /**
     * Get purchase attributes for validator errors.
     *
     * @return array
     */
    public function attributes(): array
    {
        return [
            'descricao_compra' => 'Descrição da Compra',
            'quantidade_cestas' => 'Quantidade de cestas',
            'valor_cesta' => 'Valor unitário das cestas',
            'itens_cestas' => 'Itens das cestas',
            'justificativa_escolha' => 'Justificatiova de escolha do fornecedor',
            'fornecedores' => 'Fornecedor',
            'fornecedores.*.nome' => 'Nome do fornecedor',
            'fornecedores.*.contemplado' => 'Contemplado',
        ];
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
