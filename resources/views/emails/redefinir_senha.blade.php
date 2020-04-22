@component('mail::message')
# Redefinir Senha

Olá **{{ $user->pessoa->nome }}**, recebemos uma solicitação para redefinir a senha da sua conta.

Caso você tenha solicitado uma redefinição de senha para **{{ $redefinirSenha->email }}**, clique no botão abaixo. Se você não fez essa solicitação, ignore este e-mail.

@component('mail::button', ['url' => "http://front.localhost/confirm-password-reset/{$token}"])
Redefinir Senha
@endcomponent

Obrigado!<br>
**Manaus Mais Humana**
@endcomponent
