<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use App\Http\Resources\Auth\LoginResource;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest
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
            'email' => "required|string|email|max:255|exists:users,email",
            'senha' => "required|string|min:8",
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
            "email" => "O :attribute deve ser um endereço de e-mail válido.",
            "max" => "O :attribute não pode ter mais que :max caracteres.",

            "senha.required" => "A :attribute é obrigatória.",
            "senha.string" => "A :attribute deve ser um texto.",
            "senha.min" => "A :attribute não pode ter menos de :min caracteres.",

            "email.exists" => "O :attribute :input é inválido.",
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
            "senha" => "Senha",
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
            (new LoginResource(null, false, "Existem campos inválidos.", $validator->errors()->unique()))
                ->response()
                ->setStatusCode(422)
        );
    }
}
