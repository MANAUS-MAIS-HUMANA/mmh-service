<?php

declare(strict_types=1);

namespace App\Http\Requests\Auth;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\FormRequest\FailedResource;
use App\Traits\FormRequest as FormRequestTrait;

class CriarUsuarioRequest extends FormRequest
{
    use FormRequestTrait;

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
            "senha" => "required|string|min:8|confirmed",
            "telefone" => "nullable|numeric|min:1000000000",
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
            "min" => "O :attribute deve ter menos 10 caracteres.",
            "email" => "O :attribute deve ser um endereço de e-mail válido.",
            "unique" => "O :attribute :input já foi utilizado.",
            "numeric" => "O :attribute deve conter somente números.",
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
            "senha" => "Senha",
            "telefone" => "Telefone",
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
        throw new HttpResponseException(
            (new FailedResource(null, false, "Está ação não é autorizada."))
                ->response()
                ->setStatusCode(403)
        );
    }
}
