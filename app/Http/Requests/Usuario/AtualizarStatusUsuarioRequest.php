<?php

declare(strict_types=1);

namespace App\Http\Requests\Usuario;

use App\Http\Resources\FormRequest\FailedResource;
use App\Traints\FormRequest as FormRequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AtualizarStatusUsuarioRequest extends FormRequest
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
            "status" => "required|string|in:{$this->getStatus()}",
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
            "in" => "O :attribute é inválido (aceito: :values).",
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
            "status" => "Status de Usuário",
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->mergeExistsStatus($this);
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
            (new FailedResource(null, false, "Existem campos inválidos.", $validator->errors()->unique()))
                ->response()
                ->setStatusCode(422)
        );
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
