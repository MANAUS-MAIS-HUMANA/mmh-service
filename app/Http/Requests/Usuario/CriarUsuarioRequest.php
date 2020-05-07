<?php

declare(strict_types=1);

namespace App\Http\Requests\Usuario;

use App\Http\Resources\FormRequest\FailedResource;
use App\Traints\FormRequest as FormRequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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
            "nome" => "required|string|max:255",
            "email" => "required|string|email|max:255|unique:users,email",
            "endereco" => "required|string|max:255",
            "estado" => "required|string|size:2",
            "tipo_pessoa" => "required|string|in:{$this->getTiposPessoa()}",
            "cpf" => "required_without:cnpj|cpf|size:11|unique:tipos_pessoa,cpf_cnpj",
            "cnpj" => "required_without:cpf|cnpj|size:14|unique:tipos_pessoa,cpf_cnpj",
            "perfis" => "required|array",
            "perfis.*.id" => "required|numeric|exists:perfis,id",
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
            "exists" => "O :attribute é inválido.",
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
            "perfis" => "Perfil de Usuário",
            "perfis.*.id" => "ID do Perfil de Usuário",
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
