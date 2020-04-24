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


Controller responsável pela autenticação do usuário
<!-- START_2be1f0e022faf424f18f30275e61416e -->
## Login

Endpoint para autenticar o usuário.

> Example request:

```javascript
const url = new URL(
    "http://back.localhost/api/v1/auth/login"
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
    'http://back.localhost/api/v1/auth/login',
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

url = 'http://back.localhost/api/v1/auth/login'
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
    "http://back.localhost/api/v1/auth/login" \
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
    "http://back.localhost/api/v1/auth/logout"
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
    'http://back.localhost/api/v1/auth/logout',
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

url = 'http://back.localhost/api/v1/auth/logout'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers)
response.json()
```

```bash
curl -X POST \
    "http://back.localhost/api/v1/auth/logout" \
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
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/logout"
}
```

### HTTP Request
`POST api/v1/auth/logout`


<!-- END_a68ff660ea3d08198e527df659b17963 -->


