<?php

namespace App\Helpers;

class ApiError
{
    const CODIGO_ERRO_CPF_CNPJ_NAO_ENCONTRADO = 100;
    const CODIGO_ERRO_SALVAR_PARCEIRO = 101;
    const CODIGO_ERRO_SALVAR_TIPO_PESSOA = 102;
    const CODIGO_ERRO_SALVAR_ENDERECO = 103;
    const CODIGO_ERRO_SALVAR_TELEFONE = 104;

    public static function cpfCnpjNaoEncontrado()
    {
        return self::setMessageAndCode(
            'CPF ou CNPJ devem ser fornecidos',
            self::CODIGO_ERRO_CPF_CNPJ_NAO_ENCONTRADO,
        );
    }

    public static function falhaSalvarParceiro()
    {
        return self::setMessageAndCode(
            'Não foi possível criar o parceiro',
            self::CODIGO_ERRO_SALVAR_PARCEIRO,
        );
    }

    public static function falhaSalvarTipoPessoa()
    {
        return self::setMessageAndCode(
            'Não foi possível criar o tipo pessoa',
            self::CODIGO_ERRO_SALVAR_TIPO_PESSOA,
        );
    }

    public static function falhaSalvarEndereco()
    {
        return self::setMessageAndCode(
            'Não foi possível criar o endereco',
            self::CODIGO_ERRO_SALVAR_ENDERECO,
        );
    }

    public static function falhaSalvarTelefone()
    {
        return self::setMessageAndCode(
            'Não foi possível criar o telefone',
            self::CODIGO_ERRO_SALVAR_TELEFONE,
        );
    }

    private static function setMessageAndCode($message, $code)
    {
        return [
            'error' => [
                'message' => $message,
                'code' => $code,
            ],
        ];
    }
}
