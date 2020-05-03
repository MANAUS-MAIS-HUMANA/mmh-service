<?php

namespace App\Helpers;

class ApiError
{
    const CODIGO_ERRO_CPF_CNPJ_NAO_ENCONTRADO = 100;
    const CODIGO_ERRO_SALVAR_PARCEIRO = 101;
    const CODIGO_ERRO_SALVAR_TIPO_PESSOA = 102;
    const CODIGO_ERRO_SALVAR_ENDERECO = 103;
    const CODIGO_ERRO_SALVAR_TELEFONE = 104;
    const CODIGO_ERRO_PARCEIRO_NAO_ENCONTRADO = 105;
    const CODIGO_ERRO_REMOVER_ENDERECO = 106;
    const CODIGO_ERRO_REMOVER_TELEFONE = 107;
    const CODIGO_ERRO_ATUALIZAR_PARCEIRO = 108;
    const CODIGO_ERRO_ATUALIZAR_TIPO_PESSOA = 109;
    const CODIGO_ERRO_REMOVER_PARCEIRO = 110;
    const CODIGO_ERRO_REMOVER_TIPO_PESSOA = 111;

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

    public static function parceiroNaoEncontrado($parceiroId)
    {
        return self::setMessageAndCode(
            'Parceiro ' . $parceiroId . ' não encontrado.',
            self::CODIGO_ERRO_PARCEIRO_NAO_ENCONTRADO,
        );
    }

    public static function falhaRemoverEndereco()
    {
        return self::setMessageAndCode(
            'Falha ao remover o endereco do parceiro',
            self::CODIGO_ERRO_REMOVER_ENDERECO,
        );
    }

    public static function falhaRemoverTelefone()
    {
        return self::setMessageAndCode(
            'Falha ao remover o telefone do parceiro',
            self::CODIGO_ERRO_REMOVER_TELEFONE,
        );
    }

    public static function falhaAtualizarParceiro($parceiroId)
    {
        return self::setMessageAndCode(
            'Falha ao atualizar o parceiro ' . $parceiroId,
            self::CODIGO_ERRO_ATUALIZAR_PARCEIRO,
        );
    }

    public static function falhaAtualizarTipoPessoa($tipoPessoaId)
    {
        return self::setMessageAndCode(
            'Falha ao atualizar o tipo_pessoa ' . $tipoPessoaId,
            self::CODIGO_ERRO_ATUALIZAR_TIPO_PESSOA,
        );
    }

    public static function falhaRemoverParceiro()
    {
        return self::setMessageAndCode(
            'Falha ao remover o endereco do parceiro',
            self::CODIGO_ERRO_REMOVER_PARCEIRO,
        );
    }

    public static function falhaRemoverTipoPessoa()
    {
        return self::setMessageAndCode(
            'Falha ao remover o endereco do parceiro',
            self::CODIGO_ERRO_REMOVER_TIPO_PESSOA,
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
