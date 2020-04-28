---
title: API Reference

language_tabs:
- javascript
- php
- python
- bash

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# API Manaus Mais Humana

Documentação dos endpoints da API Manaus Mais Humana.

<!-- END_INFO -->

#AuthController


Controller responsável pelo gerenciamento de Usuários
<!-- START_a4a233f86d97c8deebe3bedaa936f967 -->
## Criar usuário

Endpoint para autenticar o usuário.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "fulano@fulano.com",
    "senha": "5&bnaC#f"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/v1/auth/create',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'email' => 'fulano@fulano.com',
            'senha' => '5&bnaC#f',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/auth/create'
payload = {
    "email": "fulano@fulano.com",
    "senha": "5&bnaC#f"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X POST \
    "http://localhost/api/v1/auth/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"fulano@fulano.com","senha":"5&bnaC#f"}'

```


> Example response (202):

```json
{
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
        "token_type": "Bearer",
        "expires_in": 3600
    },
    "message": "Usuário logado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/login"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "A Senha é obrigatória.",
        "O E-mail é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/login"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "E-mail ou senha de usuário inválido!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/login"
}
```

### HTTP Request
`POST api/v1/auth/login`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | Endereço de e-mail.
        `senha` | string |  required  | Senha (min. 8).
    
<!-- END_2be1f0e022faf424f18f30275e61416e -->

<!-- START_758d1bc327f18e2d4dbb9b0a22083976 -->
## Redefinir senha

Endpoint para solicitação de redefinição de senha do usuário.
<p>
<strong>Obs.:</strong> Será enviado um link por e-mail para o usuário,
ao clicar no link, o mesmo será redirecionado para página de redefinição de senha
na aplicação frontend, no corpo do link, terá o <u>endereço
de e-mail e o token de autorização condificado em base64</u>.<br>
Para separação do e-mail e token, foi colocado <strong>&&</strong>.
 <p>
     <strong>Exemplos:</strong>
     <ul>
         <li><strong>Codificado</strong>: ZnVsYW5vQGZ1bGFuby5jb20mJkJGS1NkaGw2Q05TOUNaZk1O</li>
         <li><strong>Decodificado</strong>: fulano@fulano.com&&BFKSdhl6CNS9CZfMN</li>
     </ul>
 </p>
</p>

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/password-reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "fulano@fulano.com"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/v1/auth/password-reset',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'email' => 'fulano@fulano.com',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/auth/password-reset'
payload = {
    "email": "fulano@fulano.com"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X POST \
    "http://localhost/api/v1/auth/password-reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"fulano@fulano.com"}'

```


> Example response (200):

```json
{
    "data": {
        "email": "fulano@fulano.com",
        "nome": "Fulano da Silva",
        "token": "II35RthZxZ5hTRHsqzA84x0ztuXpXu6YLx89SBMTrLIyON6D8SAIWEMJ0Ixa",
        "validade": "2020-04-21T01:17:22.012273Z"
    },
    "message": "Recuperação de Senha solicitada com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/password-reset"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O E-mail é obrigatório.",
        "O E-mail deve ser um endereço de e-mail válido.",
        "O E-mail fulano@fulano.com é inválido.",
        "Já existe uma solicitação de redefinição de senha para o e-mail fulano@fulano.com."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/password-reset"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Não foi possível solicitador a recuperação da senha!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/password-reset"
}
```

### HTTP Request
`POST api/v1/auth/password-reset`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | Endereço de e-mail.
    
<!-- END_758d1bc327f18e2d4dbb9b0a22083976 -->

<!-- START_64744f99fcf3bece9ec84aee8c3b0cfc -->
## Confirmar redefinição de senha

Endpoint para confirmar a solicitação de redefinição de senha.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/confirm-password-reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
    "email": "fulano@fulano.com",
    "senha": "5&bnaC#f",
    "senha_confirmation": "5&bnaC#f"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/v1/auth/confirm-password-reset',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'token' => 'BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y',
            'email' => 'fulano@fulano.com',
            'senha' => '5&bnaC#f',
            'senha_confirmation' => '5&bnaC#f',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/auth/confirm-password-reset'
payload = {
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
    "email": "fulano@fulano.com",
    "senha": "5&bnaC#f",
    "senha_confirmation": "5&bnaC#f"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X POST \
    "http://localhost/api/v1/auth/confirm-password-reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y","email":"fulano@fulano.com","senha":"5&bnaC#f","senha_confirmation":"5&bnaC#f"}'

```


> Example response (200):

```json
{
    "data": {
        "id": 2,
        "nome": "Fulano de Tal",
        "email": "fulano@tal.com",
        "perfis": [
            "admin",
            "codese"
        ]
    },
    "message": "Senha de usuário redefinida com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/confirm-password-reset"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "A Senha é obrigatória.",
        "O E-mail é obrigatório.",
        "O Token é obrigatório.",
        "O Token de validação de redefinição de senha expirou ou está inválido."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/confirm-password-reset"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Não foi possível redefinir a senha do usuaŕio!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/confirm-password-reset"
}
```

### HTTP Request
`POST api/v1/auth/confirm-password-reset`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `token` | string |  required  | Token de validação.
        `email` | string |  required  | Endereço de e-mail.
        `senha` | string |  required  | Nova senha (min. 8).
        `senha_confirmation` | string |  required  | Confirmação de nova senha.
    
<!-- END_64744f99fcf3bece9ec84aee8c3b0cfc -->


