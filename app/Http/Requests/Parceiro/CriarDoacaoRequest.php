<?php

declare(strict_types=1);

namespace App\Http\Requests\Parceiro;

use App\Http\Resources\FormRequest\FailedResource;
use App\Traits\FormRequest as FormRequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CriarDoacaoRequest extends FormRequest
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
            'total_cestas' => 'required|integer|min:0',
            'data_doacao' => 'required|date',
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
            "date" => "O :attribute deve ser uma data válida.",
            "integer" => "O :attribute deve ser um número inteiro.",
            "min" => "O :attribute deve ser um número positivo.",
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
            'total_cestas' => 'Total de cestas',
            'data_doacao' => 'Data da doação',        ];
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
