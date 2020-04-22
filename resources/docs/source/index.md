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

Endpoint para criação de um novo usuário.

> Example request:

```javascript
const url = new URL(
    "http://back.localhost/api/v1/auth/create"
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
            "id": 1,
            "descricao": "Master"
        },
        {
            "id": 2
        }
    ],
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
    'http://back.localhost/api/v1/auth/create',
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
                    'id' => 1,
                    'descricao' => 'Master',
                ],
                [
                    'id' => 2,
                ],
            ],
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

url = 'http://back.localhost/api/v1/auth/create'
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
            "id": 1,
            "descricao": "Master"
        },
        {
            "id": 2
        }
    ],
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
    "http://back.localhost/api/v1/auth/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","endereco":"Rua Dom Pedro, S\/N, Dom Pedro","estado":"AM","tipo_pessoa":"pf","cpf":"111.111.111-11","cnpj":"11.111.111\/1111-11","perfis":[{"id":1,"descricao":"Master"},{"id":2}],"senha":"5&bnaC#f","senha_confirmation":"5&bnaC#f"}'

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
        "O Perfil de Usuário 'Master' é inválido.",
        "O Perfil de Usuário é inválido.",
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
        `endereco` | string |  required  | Endereço residencial - (max. 255).
        `estado` | string |  required  | Estado - (tam. 2).
        `tipo_pessoa` | string |  required  | Tipo de Pessoa (PF ou PJ).
        `cpf` | string |  optional  | Número do CPF do usuário (obrigatório se não houver CNPJ).
        `cnpj` | string |  optional  | Número do CNPJ da instituição (obrigatório se não houver CPF).
        `perfis` | array |  required  | Matriz de perfis
        `perfis[0].id` | integer |  required  | ID do perfil.
        `perfis[0].descricao` | string |  optional  | Descricao do perfil.
        `perfis[1].id` | integer |  required  | ID do perfil.
        `senha` | string |  required  | Senha de usuário (min. 8).
        `senha_confirmation` | string |  required  | Confirmação de senha de usuário.
    
<!-- END_a4a233f86d97c8deebe3bedaa936f967 -->

<!-- START_758d1bc327f18e2d4dbb9b0a22083976 -->
## Redefinir senha

Endpoint para solicitação de redefinição de senha do usuário.

> Example request:

```javascript
const url = new URL(
    "http://back.localhost/api/v1/auth/password-reset"
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
    'http://back.localhost/api/v1/auth/password-reset',
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

url = 'http://back.localhost/api/v1/auth/password-reset'
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
    "http://back.localhost/api/v1/auth/password-reset" \
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

