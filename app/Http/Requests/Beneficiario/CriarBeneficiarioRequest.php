<?php

declare(strict_types=1);

namespace App\Http\Requests\Beneficiario;

use App\Http\Resources\FormRequest\FailedResource;
use App\Rules\ValidarSeExisteSobrenome;
use App\Traits\FormRequest as FormRequestTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class CriarBeneficiarioRequest extends FormRequest
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
            'parceiro_id' => 'required|exists:parceiros,id',
            'nome' => ['required', 'string', 'min:2', new ValidarSeExisteSobrenome()],
            'cpf' => 'required|cpf|size:11|unique:beneficiarios,cpf|' .
                'unique:beneficiarios,cpf_conjuge',
            'email' => 'nullable|email',
            'data_nascimento' => 'required|date_format:Y-m-d',
            'trabalho' => 'nullable|min:2',
            'esta_desempregado' => 'nullable|boolean',
            'estado_civil_id' => 'nullable|exists:estados_civis,id',
            'nome_conjuge' => [
                'nullable',
                'required_with:cpf_conjuge',
                'string',
                'min:2',
                new ValidarSeExisteSobrenome(),
            ],
            'cpf_conjuge' => 'nullable|required_with:nome_conjuge|cpf|size:11|' .
                'unique:beneficiarios,cpf|unique:beneficiarios,cpf_conjuge|different:cpf',
            'total_residentes' => 'nullable|integer|min:0',
            'situacao_moradia' => "nullable|in:{$this->getHouseStatus()}",
            'renda_mensal' => 'nullable|numeric|min:0',
            'gostaria_montar_negocio' => 'nullable|boolean',
            'gostaria_participar_cursos' => 'nullable|boolean',
            'curso_id' => 'nullable|integer|exists:cursos,id',
            'tipo_curso' => 'nullable|string',
            'concorda_informacoes_verdadeiras' => 'required|boolean',
            'data_submissao' => 'nullable|date_format:Y-m-d H:i:s',
            'telefones' => 'nullable|array|min:1',
            'telefones.*.telefone' => 'required|numeric|min:10',
            'telefones.*.tipo' => 'required|in:Celular,Fixo',
            'enderecos' => 'required|array|min:1',
            'enderecos.*.endereco' => 'required|max:255',
            'enderecos.*.bairro_id' => 'required|exists:bairros,id',
            'enderecos.*.zona_id' => 'nullable|exists:zonas,id',
            'enderecos.*.cidade_id' => 'required|exists:cidades,id',
        ];
    }

    protected function getHouseStatus()
    {
        return 'Alugada,Cedido,Local de trabalho,Outros,Própria,Própria Financiada';
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            "array" => "O :attribute deve ser um array.",
            "boolean" => "O :attribute deve ser um tipo booleano (true ou false).",
            "cpf" => "O :attribute é inválido.",
            "date_format" => "A :attribute possui uma data em formato inválido.",
            "email" => "O :attribute deve ser um endereço de e-mail válido.",
            "exists" => "O :attribute é inválido.",
            "in" => "O :attribute é inválido (aceito: :values).",
            "integer" => "O :attribute deve ser um número inteiro.",
            "max" => "O :attribute não pode ter mais que :max caracteres.",
            "min" => "O :attribute não pode ter menos que :min caracteres.",
            "numeric" => "O :attribute deve ser um número.",
            "required" => "O :attribute é obrigatório.",
            "unique" => "O :attribute já existe no sistema.",
            "required_with" => "O nome e CPF do cônjuge precisam ser fornecidos juntos.",
            "different" => "O CPF do cônjuge deve ser diferente do CPF do beneficiário.",
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
            'parceiro_id' => 'ID do parceiro',
            'nome' => 'Nome',
            'cpf' => 'CPF',
            'email' => 'Email',
            'data_nascimento' => 'Data de Nascimento',
            'trabalho' => 'Trabalho',
            'esta_desempregado' => 'Está Desempregado',
            'estado_civil_id' => 'ID do estado civil',
            'nome_conjuge' => 'Nome do Cônjuge',
            'cpf_conjuge' => 'CPF do Cônjuge',
            'total_residentes' => 'Total de Residentes',
            'situacao_moradia' => 'Situação da Moradia',
            'renda_mensal' => 'Renda Mensal',
            'gostaria_montar_negocio' => 'Gostaria de Montar um Negócio',
            'gostaria_participar_cursos' => 'Gostaria de Participar de Cursos',
            'curso_id' => 'ID do curso que gostaria de participar',
            'tipo_curso' => 'Tipo do Curso',
            'concorda_informacoes_verdadeiras' => 'Concorda que Informações são Verdadeiras',
            'data_submissao' => 'Data de Submissão',
            'telefones' => 'Telefone',
            'telefones.*.telefone' => 'Número do Telefone',
            'telefones.*.tipo' => 'Tipo do Telefone',
            'enderecos' => 'Endereço',
            'enderecos.*.endereco' => 'Endereço',
            'enderecos.*.bairro_id' => 'ID do Bairro',
            'enderecos.*.zona_id' => 'ID da zona da cidade',
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
