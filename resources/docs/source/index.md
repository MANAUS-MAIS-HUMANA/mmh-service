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


Controller responsável pelo gerenciamento de Usuários do lado público.
<!-- START_2be1f0e022faf424f18f30275e61416e -->
## Login

Endpoint para autenticar o usuário.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/login"
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
    'http://localhost/api/v1/auth/login',
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

url = 'http://localhost/api/v1/auth/login'
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
    "http://localhost/api/v1/auth/login" \
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

<!-- START_a68ff660ea3d08198e527df659b17963 -->
## Logout

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para deslogar o usuário.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->post(
    'http://localhost/api/v1/auth/logout',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/auth/logout'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers)
response.json()
```

```bash
curl -X POST \
    "http://localhost/api/v1/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": [],
    "message": "Usuário deslogado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/logout"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```

### HTTP Request
`POST api/v1/auth/logout`


<!-- END_a68ff660ea3d08198e527df659b17963 -->

<!-- START_a4a233f86d97c8deebe3bedaa936f967 -->
## Create

Endpoint para criação de um novo usuário.

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
    "nome": "Fulano de Tal",
    "email": "fulano@tal.com",
    "senha": "5&bnaC#f",
    "senha_confirmation": "5&bnaC#f",
    "telefone": "92991234567"
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
            'nome' => 'Fulano de Tal',
            'email' => 'fulano@tal.com',
            'senha' => '5&bnaC#f',
            'senha_confirmation' => '5&bnaC#f',
            'telefone' => '92991234567',
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
    "nome": "Fulano de Tal",
    "email": "fulano@tal.com",
    "senha": "5&bnaC#f",
    "senha_confirmation": "5&bnaC#f",
    "telefone": "92991234567"
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
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","senha":"5&bnaC#f","senha_confirmation":"5&bnaC#f","telefone":"92991234567"}'

```


> Example response (201):

```json
{
    "data": {
        "id": 2,
        "nome": "Fulano de Tal",
        "email": "fulano@tal.com",
        "perfis": [
            "parceiro"
        ]
    },
    "message": "Usuário criado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/create"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "A confirmação da Senha não corresponde.",
        "O CNPJ é obrigatório quando CPF não foi informado.",
        "O CPF é obrigatório quando CNPJ não foi informado.",
        "O E-mail é obrigatório.",
        "O Endereço é obrigatório.",
        "O Estado é obrigatório.",
        "O Nome é obrigatório.",
        "O Tipo de Pessoa é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/create"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Não foi possível criar o usuaŕio!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/create"
}
```

### HTTP Request
`POST api/v1/auth/create`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nome` | string |  required  | Nome do novo usuário - (max. 255).
        `email` | string |  required  | Endereço de e-mail - (max. 255).
        `senha` | string |  required  | Senha de usuário (min. 8).
        `senha_confirmation` | string |  required  | Confirmação de senha de usuário.
        `telefone` | string |  optional  | Telefone do usuário (min. 10).
    
<!-- END_a4a233f86d97c8deebe3bedaa936f967 -->

<!-- START_4b77551ffe3e806c992cdd1044012aa7 -->
## Refresh Access token

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para fazer um refresh de um access token previamente gerado.
Após o refresh, o token antigo não poderá ser mais usado.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/auth/refresh',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/auth/refresh'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9",
        "token_type": "Bearer",
        "expires_in": 3600
    },
    "message": "Token atualizado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/refresh"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```

### HTTP Request
`GET api/v1/auth/refresh`


<!-- END_4b77551ffe3e806c992cdd1044012aa7 -->

<!-- START_758d1bc327f18e2d4dbb9b0a22083976 -->
## Password Reset

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
         <li><strong>Codificado</strong>:
ZnVsYW5vQGZ1bGFuby5jb20mJkJGS1NkaGw2Q05TOUNaZk1O</li>
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
## Confirm Password Reset

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

#BeneficiarioController


Controller responsável pelo CRUD de beneficiários.
<!-- START_b66ddf7052986a20d72d938918504a7c -->
## Listar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para buscar uma lista de beneficiários.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/beneficiarios"
);

let params = {
    "page": ""1"",
    "limit": ""10"",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/beneficiarios',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'page'=> '"1"',
            'limit'=> '"10"',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/beneficiarios'
params = {
  'page': '"1"',
  'limit': '"10"',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/beneficiarios?page=%221%22&limit=%2210%22" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1
        }
    ],
    "first_page_url": "http:\/\/back.localhost\/api\/v1\/beneficiarios",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/back.localhost\/api\/v1\/beneficiarios",
    "next_page_url": null,
    "path": "http:\/\/back.localhost\/api\/v1\/beneficiarios",
    "per_page": 10,
    "prev_page_url": "http:\/\/back.localhost\/api\/v1\/beneficiarios",
    "to": null,
    "total": 0,
    "message": "Beneficiario obtido com sucesso!",
    "success": true
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}
```

### HTTP Request
`GET api/v1/beneficiarios`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | Número da página para retornar os dados.
    `limit` |  optional  | Total de elementos por página para retornar.

<!-- END_b66ddf7052986a20d72d938918504a7c -->

<!-- START_16c03d3a0496c95c245c0466712bd25d -->
## Buscar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para obter os dados de um beneficiário específico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/beneficiarios/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/beneficiarios/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/beneficiarios/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/beneficiarios/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1
        }
    ],
    "message": "Beneficiario encontrado!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #200: Beneficiario 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}
```

### HTTP Request
`GET api/v1/beneficiarios/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `beneficiario` |  required  | ID do beneficiário.

<!-- END_16c03d3a0496c95c245c0466712bd25d -->

<!-- START_2c241c85d2933fb7bf154de02f887721 -->
## Criar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para inserir um novo beneficiário no sistema.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/beneficiarios"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "parceiro_id": 1,
    "nome": "Machado de Assis",
    "cpf": "12345678901",
    "email": "fulano@tal.com",
    "data_nascimento": "1990-01-01",
    "trabalho": "Trabalhador Aut\u00f4nomo",
    "esta_desempregado": false,
    "estado_civil_id": 15,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "ducimus",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": true,
    "gostaria_participar_cursos": true,
    "tipo_curso": "voluptatibus",
    "concorda_informacoes_verdadeiras": true,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "dicta"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
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
    'http://localhost/api/v1/beneficiarios',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'parceiro_id' => 1,
            'nome' => 'Machado de Assis',
            'cpf' => '12345678901',
            'email' => 'fulano@tal.com',
            'data_nascimento' => '1990-01-01',
            'trabalho' => 'Trabalhador Autônomo',
            'esta_desempregado' => false,
            'estado_civil_id' => 15,
            'nome_conjuge' => 'Carolina Novais.',
            'cpf_conjuge' => '10987654321',
            'total_residentes' => 4,
            'situacao_moradia' => 'ducimus',
            'renda_mensal' => 1000.0,
            'gostaria_montar_negocio' => true,
            'gostaria_participar_cursos' => true,
            'tipo_curso' => 'voluptatibus',
            'concorda_informacoes_verdadeiras' => true,
            'data_submissao' => '2020-05-01 10:11:12',
            'telefones' => [
                [
                    'telefone' => 92991234567,
                    'tipo' => 'dicta',
                ],
            ],
            'enderecos' => [
                [
                    'endereco' => 'Rua da paz, 150',
                    'bairro_id' => 1,
                    'zona_id' => 1,
                    'cidade_id' => 1,
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/beneficiarios'
payload = {
    "parceiro_id": 1,
    "nome": "Machado de Assis",
    "cpf": "12345678901",
    "email": "fulano@tal.com",
    "data_nascimento": "1990-01-01",
    "trabalho": "Trabalhador Aut\u00f4nomo",
    "esta_desempregado": false,
    "estado_civil_id": 15,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "ducimus",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": true,
    "gostaria_participar_cursos": true,
    "tipo_curso": "voluptatibus",
    "concorda_informacoes_verdadeiras": true,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "dicta"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
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
    "http://localhost/api/v1/beneficiarios" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"parceiro_id":1,"nome":"Machado de Assis","cpf":"12345678901","email":"fulano@tal.com","data_nascimento":"1990-01-01","trabalho":"Trabalhador Aut\u00f4nomo","esta_desempregado":false,"estado_civil_id":15,"nome_conjuge":"Carolina Novais.","cpf_conjuge":"10987654321","total_residentes":4,"situacao_moradia":"ducimus","renda_mensal":1000,"gostaria_montar_negocio":true,"gostaria_participar_cursos":true,"tipo_curso":"voluptatibus","concorda_informacoes_verdadeiras":true,"data_submissao":"2020-05-01 10:11:12","telefones":[{"telefone":92991234567,"tipo":"dicta"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"zona_id":1,"cidade_id":1}]}'

```


> Example response (201):

```json
{
    "data": {
        "id": 1
    },
    "message": "Beneficiário criado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O CPF já existe no sistema."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}
```

### HTTP Request
`POST api/v1/beneficiarios`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `parceiro_id` | integer |  required  | ID da instituição parceira.
        `nome` | string |  required  | Nome do novo beneficiário - (max. 255).
        `cpf` | string |  optional  | Número do CPF do beneficiário.
        `email` | string |  optional  | Endereço de e-mail do beneficiário - (max. 255).
        `data_nascimento` | string |  required  | Data de nascimento do beneficiário, no formato AAAA-MM-DD.
        `trabalho` | string |  optional  | Ocupação do beneficiário.
        `esta_desempregado` | boolean |  optional  | Indica se o beneficiário está desempregado ou não.
        `estado_civil_id` | integer |  optional  | Estado civil do beneficiario.
        `nome_conjuge` | string |  optional  | Nome do cônjuge.
        `cpf_conjuge` | string |  optional  | Número do CPF do cônjuge.
        `total_residentes` | integer |  optional  | Total de pessoas na residência do beneficiario.
        `situacao_moradia` | string |  optional  | Situação da moradia: Própria, Alugada, Cedida ou Própria Financiada
        `renda_mensal` | float |  optional  | Renda mensal do beneficiário.
        `gostaria_montar_negocio` | boolean |  optional  | Indica se o beneficiário tem intersse em montar um negócio.
        `gostaria_participar_cursos` | boolean |  optional  | Indica se o usuário tem interesse em participar de cursos.
        `tipo_curso` | string |  optional  | Tipo de curso que o beneficiário gostaria de fazer: Presencial, Online ou Ambos.
        `concorda_informacoes_verdadeiras` | boolean |  required  | Indica se o usuário concordou com os termos.
        `data_submissao` | string |  optional  | Data e hora de submissão do formulário, no formato AAAA-MM-DD HH:MM:SS.
        `telefones` | array |  optional  | Lista de telefones.
        `telefones[0].telefone` | integer |  required  | Número de telefone com DDD.
        `telefones[0].tipo` | string |  required  | Tipo do telefone: "Fixo" ou "Celular"
        `enderecos` | array |  required  | Lista de enderecos.
        `enderecos[0].endereco` | string |  required  | Nome da rua, com número e complemento.
        `enderecos[0].bairro_id` | integer |  required  | ID do bairro.
        `enderecos[0].zona_id` | integer |  required  | ID da zona da cidade.
        `enderecos[0].cidade_id` | integer |  required  | ID da cidade.
    
<!-- END_2c241c85d2933fb7bf154de02f887721 -->

<!-- START_ac16fe552e87e418591297f9829ceb5d -->
## Atualizar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para atualizar os dados de um beneficiário.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/beneficiarios/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "parceiro_id": 1,
    "nome": "Machado de Assis",
    "cpf": "12345678901",
    "email": "fulano@tal.com",
    "data_nascimento": "1990-01-01",
    "trabalho": "Trabalhador Aut\u00f4nomo",
    "esta_desempregado": true,
    "estado_civil_id": 17,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "quae",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": true,
    "gostaria_participar_cursos": true,
    "tipo_curso": "earum",
    "concorda_informacoes_verdadeiras": true,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "sit"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/v1/beneficiarios/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'parceiro_id' => 1,
            'nome' => 'Machado de Assis',
            'cpf' => '12345678901',
            'email' => 'fulano@tal.com',
            'data_nascimento' => '1990-01-01',
            'trabalho' => 'Trabalhador Autônomo',
            'esta_desempregado' => true,
            'estado_civil_id' => 17,
            'nome_conjuge' => 'Carolina Novais.',
            'cpf_conjuge' => '10987654321',
            'total_residentes' => 4,
            'situacao_moradia' => 'quae',
            'renda_mensal' => 1000.0,
            'gostaria_montar_negocio' => true,
            'gostaria_participar_cursos' => true,
            'tipo_curso' => 'earum',
            'concorda_informacoes_verdadeiras' => true,
            'data_submissao' => '2020-05-01 10:11:12',
            'telefones' => [
                [
                    'telefone' => 92991234567,
                    'tipo' => 'sit',
                ],
            ],
            'enderecos' => [
                [
                    'endereco' => 'Rua da paz, 150',
                    'bairro_id' => 1,
                    'zona_id' => 1,
                    'cidade_id' => 1,
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/beneficiarios/1'
payload = {
    "parceiro_id": 1,
    "nome": "Machado de Assis",
    "cpf": "12345678901",
    "email": "fulano@tal.com",
    "data_nascimento": "1990-01-01",
    "trabalho": "Trabalhador Aut\u00f4nomo",
    "esta_desempregado": true,
    "estado_civil_id": 17,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "quae",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": true,
    "gostaria_participar_cursos": true,
    "tipo_curso": "earum",
    "concorda_informacoes_verdadeiras": true,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "sit"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X PUT \
    "http://localhost/api/v1/beneficiarios/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"parceiro_id":1,"nome":"Machado de Assis","cpf":"12345678901","email":"fulano@tal.com","data_nascimento":"1990-01-01","trabalho":"Trabalhador Aut\u00f4nomo","esta_desempregado":true,"estado_civil_id":17,"nome_conjuge":"Carolina Novais.","cpf_conjuge":"10987654321","total_residentes":4,"situacao_moradia":"quae","renda_mensal":1000,"gostaria_montar_negocio":true,"gostaria_participar_cursos":true,"tipo_curso":"earum","concorda_informacoes_verdadeiras":true,"data_submissao":"2020-05-01 10:11:12","telefones":[{"telefone":92991234567,"tipo":"sit"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"zona_id":1,"cidade_id":1}]}'

```


> Example response (200):

```json
{
    "data": [],
    "message": "Beneficiario atualizado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #200: Beneficiario 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O ID do parceiro é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}
```

### HTTP Request
`PUT api/v1/beneficiarios/{id}`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `parceiro_id` | integer |  required  | ID da instituição parceira.
        `nome` | string |  required  | Nome do novo beneficiário - (max. 255).
        `cpf` | string |  optional  | Número do CPF do beneficiário.
        `email` | string |  optional  | Endereço de e-mail do beneficiário - (max. 255).
        `data_nascimento` | string |  required  | Data de nascimento do beneficiário, no formato AAAA-MM-DD.
        `trabalho` | string |  optional  | Ocupação do beneficiário.
        `esta_desempregado` | boolean |  optional  | Indica se o beneficiário está desempregado ou não.
        `estado_civil_id` | integer |  optional  | Estado civil do beneficiario.
        `nome_conjuge` | string |  optional  | Nome do cônjuge.
        `cpf_conjuge` | string |  optional  | Número do CPF do cônjuge.
        `total_residentes` | integer |  optional  | Total de pessoas na residência do beneficiario.
        `situacao_moradia` | string |  optional  | Situação da moradia: Própria, Alugada, Cedida ou Própria Financiada
        `renda_mensal` | float |  optional  | Renda mensal do beneficiário.
        `gostaria_montar_negocio` | boolean |  optional  | Indica se o beneficiário tem intersse em montar um negócio.
        `gostaria_participar_cursos` | boolean |  optional  | Indica se o usuário tem interesse em participar de cursos.
        `tipo_curso` | string |  optional  | Tipo de curso que o beneficiário gostaria de fazer: Presencial, Online ou Ambos.
        `concorda_informacoes_verdadeiras` | boolean |  required  | Indica se o usuário concordou com os termos.
        `data_submissao` | string |  optional  | Data e hora de submissão do formulário, no formato AAAA-MM-DD HH:MM:SS.
        `telefones` | array |  optional  | Lista de telefones.
        `telefones[0].telefone` | integer |  required  | Número de telefone com DDD.
        `telefones[0].tipo` | string |  required  | Tipo do telefone: "Fixo" ou "Celular"
        `enderecos` | array |  required  | Lista de enderecos.
        `enderecos[0].endereco` | string |  required  | Nome da rua, com número e complemento.
        `enderecos[0].bairro_id` | integer |  required  | ID do bairro.
        `enderecos[0].zona_id` | integer |  required  | ID da zona da cidade.
        `enderecos[0].cidade_id` | integer |  required  | ID da cidade.
    
<!-- END_ac16fe552e87e418591297f9829ceb5d -->

<!-- START_bf69b99e6bfae0dd82366f4a6beb22cd -->
## Remover

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para remover um beneficiário do sistema.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/beneficiarios/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://localhost/api/v1/beneficiarios/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/beneficiarios/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```

```bash
curl -X DELETE \
    "http://localhost/api/v1/beneficiarios/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": [],
    "message": "Beneficiário removido com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #200: Beneficiario 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}
```

### HTTP Request
`DELETE api/v1/beneficiarios/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `beneficiario` |  required  | ID do beneficiário.

<!-- END_bf69b99e6bfae0dd82366f4a6beb22cd -->

#DoadorController


Controller responsável pelo CRUD de doadores.
<!-- START_b3fba95f5e912d42c5fd681d1e2a21ec -->
## Listar

Endpoint para buscar doadores ordernados pela quantidade de cestas doadas

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/doadores/ranking"
);

let params = {
    "page": ""1"",
    "limit": ""6"",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/doadores/ranking',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'page'=> '"1"',
            'limit'=> '"6"',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/doadores/ranking'
params = {
  'page': '"1"',
  'limit': '"6"',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/doadores/ranking?page=%221%22&limit=%226%22" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "nome": "Teste 7",
            "logo_url": null,
            "total_cestas_basicas": 100
        },
        {
            "nome": "Teste 2",
            "logo_url": null,
            "total_cestas_basicas": 40
        },
        {
            "nome": "Teste 4",
            "logo_url": null,
            "total_cestas_basicas": 20
        },
        {
            "nome": "Teste 3",
            "logo_url": null,
            "total_cestas_basicas": 15
        },
        {
            "nome": "Teste 5",
            "logo_url": null,
            "total_cestas_basicas": 10
        },
        {
            "nome": "Teste 6",
            "logo_url": null,
            "total_cestas_basicas": 9
        }
    ],
    "first_page_url": "http:\/\/back.localhost\/api\/v1\/doadores\/ranking?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http:\/\/back.localhost\/api\/v1\/doadores\/ranking?page=2",
    "next_page_url": "http:\/\/back.localhost\/api\/v1\/doadores\/ranking?page=2",
    "path": "http:\/\/back.localhost\/api\/v1\/doadores\/ranking",
    "per_page": 6,
    "prev_page_url": null,
    "to": 6,
    "total": 7,
    "message": "Raqueamento dos doadores obtidos com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/doadores\/ranking"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`GET api/v1/doadores/ranking`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | Número da página para retornar os dados.
    `limit` |  optional  | Total de elementos por página para retornar.

<!-- END_b3fba95f5e912d42c5fd681d1e2a21ec -->

#ParceiroController


Controller responsável pelo CRUD de instituições parceiras.
<!-- START_0d4dfb28e77c127afb29ac9f5077f22f -->
## Listar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para buscar uma lista de parceiros.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros"
);

let params = {
    "page": ""1"",
    "limit": ""6"",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/parceiros',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'query' => [
            'page'=> '"1"',
            'limit'=> '"6"',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros'
params = {
  'page': '"1"',
  'limit': '"6"',
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers, params=params)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/parceiros?page=%221%22&limit=%226%22" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 8,
            "nome": "Boa Ação",
            "email": "contato@boacao.com.br",
            "tipo_pessoa": {
                "id": 9,
                "tipo_pessoa": "pj",
                "cpf_cnpj": "38797937000102"
            },
            "telefones": [
                {
                    "id": 1,
                    "telefone": "9236445874",
                    "tipo": 2
                }
            ],
            "enderecos": [
                {
                    "id": 3,
                    "endereco": "Rua Açaí",
                    "ponto_referencia": null,
                    "cep": "69068447",
                    "cidade": {
                        "nome": "Manaus",
                        "estado": {
                            "uf": "AM",
                            "nome": "Amazonas"
                        }
                    },
                    "bairro": {
                        "nome": "Raiz"
                    }
                }
            ]
        }
    ],
    "first_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "next_page_url": null,
    "path": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "per_page": 6,
    "prev_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "to": null,
    "total": 0,
    "message": "Parceiro obtido com sucesso!",
    "success": true
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`GET api/v1/parceiros`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `page` |  optional  | Número da página para retornar os dados.
    `limit` |  optional  | Total de elementos por página para retornar.

<!-- END_0d4dfb28e77c127afb29ac9f5077f22f -->

<!-- START_5b7e578c57cc0e59c7b0a6653587ed4b -->
## Listar Básico

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para buscar o ID e nome de todos os parceiros.
Essa rota será usada especialmente na página de Beneficiários, quando o usuário logado
for Admin ou Codese.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/basico"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/parceiros/basico',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/basico'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/parceiros/basico" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 8,
            "nome": "Boa Ação",
            "email": "contato@boacao.com.br",
            "tipo_pessoa": {
                "id": 9,
                "tipo_pessoa": "pj",
                "cpf_cnpj": "38797937000102"
            },
            "telefones": [
                {
                    "id": 1,
                    "telefone": "9236445874",
                    "tipo": 2
                }
            ],
            "enderecos": [
                {
                    "id": 3,
                    "endereco": "Rua Açaí",
                    "ponto_referencia": null,
                    "cep": "69068447",
                    "cidade": {
                        "nome": "Manaus",
                        "estado": {
                            "uf": "AM",
                            "nome": "Amazonas"
                        }
                    },
                    "bairro": {
                        "nome": "Raiz"
                    }
                }
            ]
        }
    ],
    "first_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "from": null,
    "last_page": 1,
    "last_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "next_page_url": null,
    "path": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "per_page": 6,
    "prev_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros",
    "to": null,
    "total": 0,
    "message": "Parceiro obtido com sucesso!",
    "success": true
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`GET api/v1/parceiros/basico`


<!-- END_5b7e578c57cc0e59c7b0a6653587ed4b -->

<!-- START_a072594af821ade9e7ce15d71dbe9460 -->
## Buscar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para obter os dados de um parceiro específico.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/parceiros/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/parceiros/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "nome": "Boa Ação",
            "email": "contato@boacao.com.br",
            "tipo_pessoa": {
                "id": 9,
                "tipo_pessoa": "pj",
                "cpf_cnpj": "38797937000102"
            },
            "telefones": [
                {
                    "id": 1,
                    "telefone": "9236445874",
                    "tipo": 2
                }
            ],
            "enderecos": [
                {
                    "id": 3,
                    "endereco": "Rua Açaí",
                    "ponto_referencia": null,
                    "cep": "69068447",
                    "cidade": {
                        "nome": "Manaus",
                        "estado": {
                            "uf": "AM",
                            "nome": "Amazonas"
                        }
                    },
                    "bairro": {
                        "nome": "Raiz"
                    }
                }
            ]
        }
    ],
    "message": "Parceiro encontrado!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #105: Parceiro 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`GET api/v1/parceiros/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `parceiro` |  required  | ID do parceiro.

<!-- END_a072594af821ade9e7ce15d71dbe9460 -->

<!-- START_543d37f5ea560f7ea10b487b2b15671f -->
## Criar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para inserir uma nova instituição parceira no sistema.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nome": "Manaus+Humana",
    "email": "fulano@tal.com",
    "cnpj": "13245678901234",
    "cpf": "12345678901",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "esse"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
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
    'http://localhost/api/v1/parceiros',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'nome' => 'Manaus+Humana',
            'email' => 'fulano@tal.com',
            'cnpj' => '13245678901234',
            'cpf' => '12345678901',
            'telefones' => [
                [
                    'telefone' => 92991234567,
                    'tipo' => 'esse',
                ],
            ],
            'enderecos' => [
                [
                    'endereco' => 'Rua da paz, 150',
                    'bairro_id' => 1,
                    'zona_id' => 1,
                    'cidade_id' => 1,
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros'
payload = {
    "nome": "Manaus+Humana",
    "email": "fulano@tal.com",
    "cnpj": "13245678901234",
    "cpf": "12345678901",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "esse"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
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
    "http://localhost/api/v1/parceiros" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Manaus+Humana","email":"fulano@tal.com","cnpj":"13245678901234","cpf":"12345678901","telefones":[{"telefone":92991234567,"tipo":"esse"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"zona_id":1,"cidade_id":1}]}'

```


> Example response (201):

```json
{
    "data": {
        "id": 2
    },
    "message": "Parceiro criado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O Nome é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`POST api/v1/parceiros`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nome` | string |  required  | Nome do novo parceiro - (max. 255).
        `email` | string |  required  | Endereço de e-mail do parceiro - (max. 255).
        `cnpj` | string |  optional  | Número do CNPJ da instituição (obrigatório se não houver CPF).
        `cpf` | string |  optional  | Número do CPF da instituição (obrigatório se não houver CNPJ).
        `telefones` | array |  required  | Lista de telefones.
        `telefones[0].telefone` | integer |  required  | Número de telefone com DDD.
        `telefones[0].tipo` | string |  required  | Tipo do telefone: "Fixo" ou "Celular"
        `enderecos` | array |  required  | Lista de enderecos.
        `enderecos[0].endereco` | string |  required  | Nome da rua, com número e complemento.
        `enderecos[0].bairro_id` | integer |  required  | ID do bairro.
        `enderecos[0].zona_id` | integer |  optional  | ID da zona da cidade.
        `enderecos[0].cidade_id` | integer |  required  | ID da cidade.
    
<!-- END_543d37f5ea560f7ea10b487b2b15671f -->

<!-- START_5aaa67f3f0225463d7c25473608a7464 -->
## Atualizar

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para atualizar os dados de um parceiro.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nome": "Manaus+Humana",
    "email": "fulano@tal.com",
    "cnpj": "13245678901234",
    "cpf": "12345678901",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "est"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/v1/parceiros/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'nome' => 'Manaus+Humana',
            'email' => 'fulano@tal.com',
            'cnpj' => '13245678901234',
            'cpf' => '12345678901',
            'telefones' => [
                [
                    'telefone' => 92991234567,
                    'tipo' => 'est',
                ],
            ],
            'enderecos' => [
                [
                    'endereco' => 'Rua da paz, 150',
                    'bairro_id' => 1,
                    'zona_id' => 1,
                    'cidade_id' => 1,
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/1'
payload = {
    "nome": "Manaus+Humana",
    "email": "fulano@tal.com",
    "cnpj": "13245678901234",
    "cpf": "12345678901",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "est"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cidade_id": 1
        }
    ]
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X PUT \
    "http://localhost/api/v1/parceiros/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Manaus+Humana","email":"fulano@tal.com","cnpj":"13245678901234","cpf":"12345678901","telefones":[{"telefone":92991234567,"tipo":"est"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"zona_id":1,"cidade_id":1}]}'

```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "nome": "Ação de Graças",
        "email": "contato@gracas.com.br",
        "tipo_pessoa": {
            "id": 9,
            "tipo_pessoa": "pj",
            "cpf_cnpj": "09627659000147"
        },
        "telefones": [
            {
                "id": 9,
                "telefone": "92991475871",
                "tipo": 1
            }
        ],
        "enderecos": [
            {
                "id": 11,
                "endereco": "Rua da Onça",
                "ponto_referencia": null,
                "cep": "69068748",
                "cidade": {
                    "nome": "Manaus",
                    "estado": {
                        "uf": "AM",
                        "nome": "Amazonas"
                    }
                },
                "bairro": {
                    "nome": "Raiz"
                }
            }
        ]
    },
    "message": "Parceiro atualizado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #105: Parceiro 2 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O Nome é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`PUT api/v1/parceiros/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `parceiro` |  required  | ID do parceiro.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nome` | string |  required  | Nome do novo parceiro - (max. 255).
        `email` | string |  required  | Endereço de e-mail do parceiro - (max. 255).
        `cnpj` | string |  optional  | Número do CNPJ da instituição (obrigatório se não houver CPF).
        `cpf` | string |  optional  | Número do CPF da instituição (obrigatório se não houver CNPJ).
        `telefones` | array |  required  | Lista de telefones.
        `telefones[0].telefone` | integer |  required  | Número de telefone com DDD.
        `telefones[0].tipo` | string |  required  | Tipo do telefone: "Fixo" ou "Celular"
        `enderecos` | array |  required  | Lista de enderecos
        `enderecos[0].endereco` | string |  required  | Nome da rua, com número e complemento.
        `enderecos[0].bairro_id` | integer |  required  | ID do bairro.
        `enderecos[0].zona_id` | integer |  optional  | ID da zona da cidade.
        `enderecos[0].cidade_id` | integer |  required  | ID da cidade.
    
<!-- END_5aaa67f3f0225463d7c25473608a7464 -->

<!-- START_ce8ca1fc55cd829a93844b4be19d491a -->
## Remover

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para remover um parceiro do sistema.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://localhost/api/v1/parceiros/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```

```bash
curl -X DELETE \
    "http://localhost/api/v1/parceiros/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": [],
    "message": "Parceiro removido com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #105: Parceiro 2 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`DELETE api/v1/parceiros/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `parceiro` |  required  | ID do parceiro.

<!-- END_ce8ca1fc55cd829a93844b4be19d491a -->

<!-- START_20264597d0b87ecbcbcfbb6ec4f1a603 -->
## Criar Doação

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para doação dos parceiros para beneficiarios

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "total_cestas": 1,
    "data_doacao": "2020-06-01"
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
    'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'total_cestas' => 1,
            'data_doacao' => '2020-06-01',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes'
payload = {
    "total_cestas": 1,
    "data_doacao": "2020-06-01"
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
    "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"total_cestas":1,"data_doacao":"2020-06-01"}'

```


> Example response (201):

```json
{
    "data": {
        "id": 1
    },
    "message": "Doação do beneficiario criado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes"
}
```
> Example response (404):

```json
[
    {
        "data": [],
        "message": "Erro #200: Beneficiario 1 não encontrado.",
        "success": false,
        "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes"
    },
    {
        "data": [],
        "message": "Erro #105: Parceiro 22 não encontrado.",
        "success": false,
        "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes"
    }
]
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`POST api/v1/parceiros/{id}/beneficiarios/{beneficiaryId}/doacoes`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | ID do parceiro.
    `beneficiaryId` |  required  | ID do beneficiario.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `total_cestas` | integer |  required  | Número de cestas doadas.
        `data_doacao` | string |  required  | Data da doação das cestas.
    
<!-- END_20264597d0b87ecbcbcfbb6ec4f1a603 -->

<!-- START_fe27055586bbde39106c9bf28cc0b8d8 -->
## Remove Doação

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para remoção das doações de um beneficiarios

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->delete(
    'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()
```

```bash
curl -X DELETE \
    "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": [],
    "message": "Doação removido com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes\/1"
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #204: Doação 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`DELETE api/v1/parceiros/{id}/beneficiarios/{beneficiaryId}/doacoes/{donationId}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | ID do parceiro.
    `beneficiaryId` |  required  | ID do beneficiario.
    `$donationId` |  required  | ID da doação.

<!-- END_fe27055586bbde39106c9bf28cc0b8d8 -->

<!-- START_ba056cf31c9e6a89371fb04650977109 -->
## Listar as doações

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint listar as doações de um beneficiário

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 3,
            "beneficiario_id": 2,
            "parceiro_id": 2,
            "total_cestas": 1,
            "data_doacao": "2020-06-01 00:00:00"
        },
        {
            "id": 8,
            "beneficiario_id": 2,
            "parceiro_id": 2,
            "total_cestas": 1,
            "data_doacao": "2020-06-01 00:00:00"
        },
        {
            "id": 9,
            "beneficiario_id": 2,
            "parceiro_id": 2,
            "total_cestas": 1,
            "data_doacao": "2020-06-01 00:00:00"
        },
        {
            "id": 10,
            "beneficiario_id": 2,
            "parceiro_id": 2,
            "total_cestas": 1,
            "data_doacao": "2020-06-01 00:00:00"
        }
    ],
    "first_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios\/2\/doacoes?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios\/2\/doacoes?page=1",
    "next_page_url": null,
    "path": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios\/2\/doacoes",
    "per_page": 6,
    "prev_page_url": null,
    "to": 4,
    "total": 4,
    "message": "Doações obtidos com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios\/2\/doacoes"
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #200: Beneficiario 22 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios\/22\/doacoes"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`GET api/v1/parceiros/{id}/beneficiarios/{beneficiaryId}/doacoes`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | ID do parceiro.
    `beneficiaryId` |  required  | ID do beneficiario.

<!-- END_ba056cf31c9e6a89371fb04650977109 -->

<!-- START_8f0e2412d4364b7a50b608edea4b1a06 -->
## Listar os beneficiários

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint listar os beneficiários de um parceiro

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/parceiros/1/beneficiarios"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/parceiros/1/beneficiarios',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/parceiros/1/beneficiarios'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/parceiros/1/beneficiarios" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "nome": "Bene Teste",
            "cpf": "42282879481",
            "ativo": 1
        },
        {
            "id": 2,
            "nome": "Ficio Teste",
            "cpf": "12345678900",
            "ativo": 1
        }
    ],
    "first_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios?page=1",
    "next_page_url": null,
    "path": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios",
    "per_page": 6,
    "prev_page_url": null,
    "to": 2,
    "total": 2,
    "message": "Beneficiarios obtidos com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios"
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Erro #105: Parceiro 20 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/20\/beneficiarios"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}
```

### HTTP Request
`GET api/v1/parceiros/{id}/beneficiarios`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | ID do parceiro.

<!-- END_8f0e2412d4364b7a50b608edea4b1a06 -->

#UsuarioController


Controller responsável pelo gerenciamento de Usuários do lado privado.
<!-- START_94b9e39c9179e6826963c4293a458c30 -->
## Index

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que retorna todos os usuários.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/usuario"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/usuario',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/usuario'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/usuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": [
        {
            "id": 1,
            "nome": "Manaus Mais Humana",
            "email": "mmh@gmail.com",
            "status": "Ativo",
            "perfis": [
                "admin"
            ]
        },
        {
            "id": 2,
            "nome": "Fulano de Tal",
            "email": "fulano@tal.com",
            "status": "Inativo",
            "perfis": [
                "admin",
                "codese"
            ]
        },
        {
            "id": 3,
            "nome": "Cicrano de Tal",
            "email": "cicrano@tal.com",
            "status": "Bloqueado",
            "perfis": [
                "parceiro"
            ]
        }
    ],
    "message": "Usuários encontrados!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Não foram encontrados usuários!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}
```

### HTTP Request
`GET api/v1/usuario`


<!-- END_94b9e39c9179e6826963c4293a458c30 -->

<!-- START_f4118dbd959bf0da643fc902f2d8ba1b -->
## Store

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para criação de novo usuário.
<p>
<strong>Obs.:</strong> Será enviado um link por e-mail para o usuário,
ao clicar no link, o mesmo será redirecionado para página de definição de senha
na aplicação frontend, no corpo do link, terá o <u>ID de usuário, endereço
de e-mail e o token condificado em base64</u>.<br>
Para separação do e-mail e token, foi colocado <strong>&&</strong>.
 <p>
     <strong>Exemplos:</strong>
     <ul>
         <li><strong>Codificado</strong>: ZnVsYW5vQGZ1bGFuby5jb20mJkJGS1NkaGw2Q05TOUNaZk1O</li>
         <li><strong>Decodificado</strong>: 2&&fulano@fulano.com&&BFKSdhl6CNS9CZfMN</li>
     </ul>
 </p>
</p>

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/usuario"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nome": "Fulano de Tal",
    "email": "fulano@tal.com",
    "endereco": "Rua Dom Pedro, S\/N, Dom Pedro",
    "estado": "AM",
    "tipo_pessoa": "pf",
    "cpf": "111.111.111-11",
    "cnpj": "11.111.111\/1111-11",
    "perfis": [
        {
            "id": 3,
            "perfil": "parceiro",
            "descricao": "Igreja ou ONG."
        }
    ]
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
    'http://localhost/api/v1/usuario',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'nome' => 'Fulano de Tal',
            'email' => 'fulano@tal.com',
            'endereco' => 'Rua Dom Pedro, S/N, Dom Pedro',
            'estado' => 'AM',
            'tipo_pessoa' => 'pf',
            'cpf' => '111.111.111-11',
            'cnpj' => '11.111.111/1111-11',
            'perfis' => [
                [
                    'id' => 3,
                    'perfil' => 'parceiro',
                    'descricao' => 'Igreja ou ONG.',
                ],
            ],
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/usuario'
payload = {
    "nome": "Fulano de Tal",
    "email": "fulano@tal.com",
    "endereco": "Rua Dom Pedro, S\/N, Dom Pedro",
    "estado": "AM",
    "tipo_pessoa": "pf",
    "cpf": "111.111.111-11",
    "cnpj": "11.111.111\/1111-11",
    "perfis": [
        {
            "id": 3,
            "perfil": "parceiro",
            "descricao": "Igreja ou ONG."
        }
    ]
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
    "http://localhost/api/v1/usuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","endereco":"Rua Dom Pedro, S\/N, Dom Pedro","estado":"AM","tipo_pessoa":"pf","cpf":"111.111.111-11","cnpj":"11.111.111\/1111-11","perfis":[{"id":3,"perfil":"parceiro","descricao":"Igreja ou ONG."}]}'

```


> Example response (201):

```json
{
    "data": {
        "id": 2,
        "nome": "Fulano de Tal",
        "email": "fulano@tal.com",
        "status": "Inativo",
        "perfis": [
            "admin",
            "codese",
            "parceiro"
        ]
    },
    "message": "Usuário criado com sucesso!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (403):

```json
{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O CNPJ é obrigatório quando CPF não foi informado.",
        "O CPF é obrigatório quando CNPJ não foi informado.",
        "O E-mail é obrigatório.",
        "O Endereço é obrigatório.",
        "O Estado é obrigatório.",
        "O Nome é obrigatório.",
        "O Perfil de Usuário é obrigatório.",
        "O Tipo de Pessoa é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}
```
> Example response (500):

```json
{
    "data": [],
    "message": "Não foi possível criar o usuário!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}
```

### HTTP Request
`POST api/v1/usuario`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nome` | string |  required  | Nome do novo usuário - (max. 255).
        `email` | string |  required  | Endereço de e-mail - (max. 255).
        `endereco` | string |  required  | Endereço residencial - (max. 255).
        `estado` | string |  required  | Estado - (tam. 2).
        `tipo_pessoa` | string |  required  | Tipo de Pessoa (PF ou PJ).
        `cpf` | string |  optional  | Número do CPF do usuário (obrigatório se não houver CNPJ).
        `cnpj` | string |  optional  | Número do CNPJ da instituição (obrigatório se não houver CPF).
        `perfis` | array |  required  | Matriz de perfis.
        `perfis[0].id` | integer |  required  | ID do perfil.
        `perfis[0].perfil` | string |  optional  | Nome do perfil.
        `perfis[0].descricao` | string |  optional  | Descrição do perfil.
    
<!-- END_f4118dbd959bf0da643fc902f2d8ba1b -->

<!-- START_33b204ea4b1df799847e39ea5600738b -->
## Show

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que retorna o usuário pelo id.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/usuario/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->get(
    'http://localhost/api/v1/usuario/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/usuario/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()
```

```bash
curl -X GET \
    -G "http://localhost/api/v1/usuario/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```


> Example response (200):

```json
{
    "data": {
        "id": 1,
        "nome": "Manaus Mais Humana",
        "email": "mmh@gmail.com",
        "status": "Ativo",
        "perfis": [
            "admin"
        ]
    },
    "message": "Usuário encontrado!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/1"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Usuário não encontrado!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/1"
}
```

### HTTP Request
`GET api/v1/usuario/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `usuario` |  required  | ID do usuário.

<!-- END_33b204ea4b1df799847e39ea5600738b -->

<!-- START_6a759fafba79060dfb4b8762a07e4c23 -->
## Update

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que atualiza os dados do usuário.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/usuario/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nome": "Fulano de Tal",
    "email": "fulano@tal.com",
    "endereco": "Rua Dom Pedro, S\/N, Dom Pedro",
    "estado": "AM",
    "tipo_pessoa": "pf",
    "cpf": "111.111.111-11",
    "cnpj": "11.111.111\/1111-11",
    "perfis": [
        {
            "id": 3,
            "perfil": "parceiro",
            "descricao": "Igreja ou ONG."
        }
    ],
    "status": "A"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/v1/usuario/1',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'nome' => 'Fulano de Tal',
            'email' => 'fulano@tal.com',
            'endereco' => 'Rua Dom Pedro, S/N, Dom Pedro',
            'estado' => 'AM',
            'tipo_pessoa' => 'pf',
            'cpf' => '111.111.111-11',
            'cnpj' => '11.111.111/1111-11',
            'perfis' => [
                [
                    'id' => 3,
                    'perfil' => 'parceiro',
                    'descricao' => 'Igreja ou ONG.',
                ],
            ],
            'status' => 'A',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/usuario/1'
payload = {
    "nome": "Fulano de Tal",
    "email": "fulano@tal.com",
    "endereco": "Rua Dom Pedro, S\/N, Dom Pedro",
    "estado": "AM",
    "tipo_pessoa": "pf",
    "cpf": "111.111.111-11",
    "cnpj": "11.111.111\/1111-11",
    "perfis": [
        {
            "id": 3,
            "perfil": "parceiro",
            "descricao": "Igreja ou ONG."
        }
    ],
    "status": "A"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X PUT \
    "http://localhost/api/v1/usuario/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","endereco":"Rua Dom Pedro, S\/N, Dom Pedro","estado":"AM","tipo_pessoa":"pf","cpf":"111.111.111-11","cnpj":"11.111.111\/1111-11","perfis":[{"id":3,"perfil":"parceiro","descricao":"Igreja ou ONG."}],"status":"A"}'

```


> Example response (200):

```json
{
    "data": {
        "id": 2,
        "nome": "Fulano de Tal",
        "email": "fulano@tal.com",
        "status": "Ativo",
        "perfis": [
            "parceiro"
        ]
    },
    "message": "Usuário atualizado com sucesso!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (403):

```json
{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Usuário não encontrado!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O CPF deve ter 11 caracteres.",
        "O CPF é inválido.",
        "O ID do Perfil de Usuário é inválido.",
        "O Nome deve ser um texto.",
        "O Tipo de Pessoa é inválido (aceito: pf, pj)."
    ],
    "message": "Existem campos inválidos.",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2"
}
```

### HTTP Request
`PUT api/v1/usuario/{id}`

`PATCH api/v1/usuario/{id}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `usuario` |  required  | ID do usuário.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `nome` | string |  optional  | Nome do novo usuário - (max. 255).
        `email` | string |  optional  | Endereço de e-mail - (max. 255).
        `endereco` | string |  optional  | Endereço residencial - (max. 255).
        `estado` | string |  optional  | Estado - (tam. 2).
        `tipo_pessoa` | string |  optional  | Tipo de Pessoa (PF ou PJ).
        `cpf` | string |  optional  | Número do CPF do usuário.
        `cnpj` | string |  optional  | Número do CNPJ da instituição.
        `perfis` | array |  optional  | Matriz de perfis.
        `perfis[0].id` | integer |  optional  | ID do perfil.
        `perfis[0].perfil` | string |  optional  | Nome do perfil.
        `perfis[0].descricao` | string |  optional  | Descrição do perfil.
        `status` | string |  optional  | Status de usuário (A, I ou B).
    
<!-- END_6a759fafba79060dfb4b8762a07e4c23 -->

<!-- START_c72d2f99606a3aefdfc00ac95b31d8d1 -->
## SetStatus

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que atualiza o status do usuário.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/usuario/1/set-status"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "status": "A"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/v1/usuario/1/set-status',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'status' => 'A',
        ],
    ]
);
$body = $response->getBody();
print_r(json_decode((string) $body));
```

```python
import requests
import json

url = 'http://localhost/api/v1/usuario/1/set-status'
payload = {
    "status": "A"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X PUT \
    "http://localhost/api/v1/usuario/1/set-status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"status":"A"}'

```


> Example response (200):

```json
{
    "data": {
        "id": 2,
        "nome": "Fulano de Tal",
        "email": "fulano@tal.com",
        "status": "Ativo",
        "perfis": [
            "parceiro"
        ]
    },
    "message": "Status de usuário atualizado com sucesso!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-status"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (403):

```json
{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Usuário não encontrado!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-status"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "O Status de Usuário é inválido (aceito: A, I, B)."
    ],
    "message": "Existem campos inválidos.",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-status"
}
```

### HTTP Request
`PUT api/v1/usuario/{id}/set-status`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `status` | string |  optional  | Status de usuário (A, I ou B).
    
<!-- END_c72d2f99606a3aefdfc00ac95b31d8d1 -->

<!-- START_af574b0c80b0d9c34cb32ac5d2367e41 -->
## SetPassword

Endpoint que define a senha do usuário.

> Example request:

```javascript
const url = new URL(
    "http://localhost/api/v1/usuario/1/set-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "fulano@tal.com",
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
    "senha": "5&bnaC#f",
    "senha_confirmation": "5&bnaC#f"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

```php

$client = new \GuzzleHttp\Client();
$response = $client->put(
    'http://localhost/api/v1/usuario/1/set-password',
    [
        'headers' => [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ],
        'json' => [
            'email' => 'fulano@tal.com',
            'token' => 'BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y',
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

url = 'http://localhost/api/v1/usuario/1/set-password'
payload = {
    "email": "fulano@tal.com",
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
    "senha": "5&bnaC#f",
    "senha_confirmation": "5&bnaC#f"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()
```

```bash
curl -X PUT \
    "http://localhost/api/v1/usuario/1/set-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"fulano@tal.com","token":"BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y","senha":"5&bnaC#f","senha_confirmation":"5&bnaC#f"}'

```


> Example response (200):

```json
{
    "data": {
        "id": 2,
        "nome": "Fulano de Tal",
        "email": "fulano@tal.com",
        "status": "Ativo",
        "perfis": [
            "parceiro"
        ]
    },
    "message": "Senha de usuário definida com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-password"
}
```
> Example response (401):

```json
{
    "data": [],
    "message": "Não autorizado",
    "success": false
}
```
> Example response (403):

```json
{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}
```
> Example response (404):

```json
{
    "data": [],
    "message": "Usuário não encontrado!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-password"
}
```
> Example response (422):

```json
{
    "data": [],
    "errors": [
        "A confirmação da Senha não corresponde.",
        "O Token é inválido."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-password"
}
```

### HTTP Request
`PUT api/v1/usuario/{id}/set-password`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `usuario` |  required  | ID do usuário.
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `email` | string |  required  | Endereço de e-mail - (max. 255).
        `token` | string |  required  | Token de validação - (max. 255).
        `senha` | string |  required  | Nova senha (min. 8).
        `senha_confirmation` | string |  required  | Confirmação de nova senha.
    
<!-- END_af574b0c80b0d9c34cb32ac5d2367e41 -->


