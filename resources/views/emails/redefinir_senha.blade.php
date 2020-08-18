@component('mail::message')
# Redefinir Senha

Olá **{{ $user->nome }}**, recebemos uma solicitação para redefinir a senha da sua conta.

Caso você tenha solicitado uma redefinição de senha para **{{ $redefinirSenha->email }}**,<br>
clique no botão abaixo. Se você não fez essa solicitação, ignore este e-mail.

@component('mail::button', ['url' => config('app.front_url') . "/confirm-password-reset/{$token}"])
Redefinir Senha
@endcomponent

Obrigado!<br>
**Manaus Mais Humana**
@endcomponent
