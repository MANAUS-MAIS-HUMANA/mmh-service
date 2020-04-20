<?php

declare(strict_types=1);

namespace App\Http\Requests;

use App\Http\Resources\RedefinirSenhaResource;
use App\Rules\ValidateIfExistsPasswordReset;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RedefinirSenhaRequest extends FormRequest
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
            "email" => ["required", "string", "email", "max:255", "exists:users,email", new ValidateIfExistsPasswordReset()],
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
            "string" => "O :attribute deve ser um texto.",
            "max" => "O :attribute não pode ter mais que :max caracteres.",
            "email" => "O :attribute deve ser um endereço de e-mail válido.",
            "exists" => "O :attribute :input é inválido.",
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
            "email" => "E-mail",
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
        throw new HttpResponseException(
            (new RedefinirSenhaResource(null, false, "Existem campos inválidos.", $validator->errors()->unique()))
                ->response()
                ->setStatusCode(422)
        );
    }
}
