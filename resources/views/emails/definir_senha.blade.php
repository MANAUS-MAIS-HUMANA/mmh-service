@component('mail::message')
# Definir Senha

Olá **{{ $user->nome }}**!

Este é um e-mail de confirmação para criação do seu login único.<br>
Para ativação e definição da senha do seu login único, clique no botão abaixo.

@component('mail::button', ['url' => config('app.front_url') . "/set-password/{$token}"])
Definir Senha
@endcomponent

Desconsidere esse e-mail caso tenha recebido indevidamente.

Obrigado!<br>
**{{ config('app.name') }}**
@endcomponent
