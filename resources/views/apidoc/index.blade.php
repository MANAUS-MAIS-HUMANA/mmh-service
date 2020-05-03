<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>API Reference</title>

    <link rel="stylesheet" href="{{ asset('/docs/css/style.css') }}" />
    <script src="{{ asset('/docs/js/all.js') }}"></script>


          <script>
        $(function() {
            setupLanguages(["javascript","php","python","bash"]);
        });
      </script>
      </head>

  <body class="">
    <a href="#" id="nav-button">
      <span>
        NAV
        <img src="/docs/images/navbar.png" />
      </span>
    </a>
    <div class="tocify-wrapper">
        <img src="/docs/images/logo.png" />
                    <div class="lang-selector">
                                  <a href="#" data-language-name="javascript">javascript</a>
                                  <a href="#" data-language-name="php">php</a>
                                  <a href="#" data-language-name="python">python</a>
                                  <a href="#" data-language-name="bash">bash</a>
                            </div>
                            <div class="search">
              <input type="text" class="search" id="input-search" placeholder="Search">
            </div>
            <ul class="search-results"></ul>
              <div id="toc">
      </div>
                    <ul class="toc-footer">
                                  <li><a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a></li>
                            </ul>
            </div>
    <div class="page-wrapper">
      <div class="dark-box"></div>
      <div class="content">
          <!-- START_INFO -->
<h1>API Manaus Mais Humana</h1>
<p>Documentação dos endpoints da API Manaus Mais Humana.</p>
<!-- END_INFO -->
<h1>AuthController</h1>
<p>Controller responsável pela autenticação do usuário</p>
<!-- START_2be1f0e022faf424f18f30275e61416e -->
<h2>Login</h2>
<p>Endpoint para autenticar o usuário.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "fulano@fulano.com",
    "senha": "5&amp;bnaC#f"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/auth/login',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'fulano@fulano.com',
            'senha' =&gt; '5&amp;bnaC#f',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
import json

url = 'http://localhost/api/v1/auth/login'
payload = {
    "email": "fulano@fulano.com",
    "senha": "5&amp;bnaC#f"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"fulano@fulano.com","senha":"5&amp;bnaC#f"}'
</code></pre>
<blockquote>
<p>Example response (202):</p>
</blockquote>
<pre><code class="language-json">{
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
        "token_type": "Bearer",
        "expires_in": 3600
    },
    "message": "Usuário logado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/login"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "errors": [
        "A Senha é obrigatória.",
        "O E-mail é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/login"
}</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "E-mail ou senha de usuário inválido!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/login"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/auth/login</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>Endereço de e-mail.</td>
</tr>
<tr>
<td><code>senha</code></td>
<td>string</td>
<td>required</td>
<td>Senha (min. 8).</td>
</tr>
</tbody>
</table>
<!-- END_2be1f0e022faf424f18f30275e61416e -->
<!-- START_a68ff660ea3d08198e527df659b17963 -->
<h2>Logout</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para deslogar o usuário.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/auth/logout',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
import json

url = 'http://localhost/api/v1/auth/logout'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Usuário deslogado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/logout"
}</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não autorizado",
    "success": false
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/auth/logout</code></p>
<!-- END_a68ff660ea3d08198e527df659b17963 -->
<!-- START_a4a233f86d97c8deebe3bedaa936f967 -->
<h2>Create</h2>
<p>Endpoint para criação de um novo usuário.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/create"
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
    "senha": "5&amp;bnaC#f",
    "senha_confirmation": "5&amp;bnaC#f"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/auth/create',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'nome' =&gt; 'Fulano de Tal',
            'email' =&gt; 'fulano@tal.com',
            'endereco' =&gt; 'Rua Dom Pedro, S/N, Dom Pedro',
            'estado' =&gt; 'AM',
            'tipo_pessoa' =&gt; 'pf',
            'cpf' =&gt; '111.111.111-11',
            'cnpj' =&gt; '11.111.111/1111-11',
            'perfis' =&gt; [
                [
                    'id' =&gt; 1,
                    'descricao' =&gt; 'Master',
                ],
                [
                    'id' =&gt; 2,
                ],
            ],
            'senha' =&gt; '5&amp;bnaC#f',
            'senha_confirmation' =&gt; '5&amp;bnaC#f',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
import json

url = 'http://localhost/api/v1/auth/create'
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
    "senha": "5&amp;bnaC#f",
    "senha_confirmation": "5&amp;bnaC#f"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/auth/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","endereco":"Rua Dom Pedro, S\/N, Dom Pedro","estado":"AM","tipo_pessoa":"pf","cpf":"111.111.111-11","cnpj":"11.111.111\/1111-11","perfis":[{"id":1,"descricao":"Master"},{"id":2}],"senha":"5&amp;bnaC#f","senha_confirmation":"5&amp;bnaC#f"}'
</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não foi possível criar o usuaŕio!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/create"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/auth/create</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>nome</code></td>
<td>string</td>
<td>required</td>
<td>Nome do novo usuário - (max. 255).</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>Endereço de e-mail - (max. 255).</td>
</tr>
<tr>
<td><code>endereco</code></td>
<td>string</td>
<td>required</td>
<td>Endereço residencial - (max. 255).</td>
</tr>
<tr>
<td><code>estado</code></td>
<td>string</td>
<td>required</td>
<td>Estado - (tam. 2).</td>
</tr>
<tr>
<td><code>tipo_pessoa</code></td>
<td>string</td>
<td>required</td>
<td>Tipo de Pessoa (PF ou PJ).</td>
</tr>
<tr>
<td><code>cpf</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF do usuário (obrigatório se não houver CNPJ).</td>
</tr>
<tr>
<td><code>cnpj</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CNPJ da instituição (obrigatório se não houver CPF).</td>
</tr>
<tr>
<td><code>perfis</code></td>
<td>array</td>
<td>required</td>
<td>Matriz de perfis</td>
</tr>
<tr>
<td><code>perfis[0].id</code></td>
<td>integer</td>
<td>required</td>
<td>ID do perfil.</td>
</tr>
<tr>
<td><code>perfis[0].descricao</code></td>
<td>string</td>
<td>optional</td>
<td>Descricao do perfil.</td>
</tr>
<tr>
<td><code>perfis[1].id</code></td>
<td>integer</td>
<td>required</td>
<td>ID do perfil.</td>
</tr>
<tr>
<td><code>senha</code></td>
<td>string</td>
<td>required</td>
<td>Senha de usuário (min. 8).</td>
</tr>
<tr>
<td><code>senha_confirmation</code></td>
<td>string</td>
<td>required</td>
<td>Confirmação de senha de usuário.</td>
</tr>
</tbody>
</table>
<!-- END_a4a233f86d97c8deebe3bedaa936f967 -->
<!-- START_758d1bc327f18e2d4dbb9b0a22083976 -->
<h2>Password Reset</h2>
<p>Endpoint para solicitação de redefinição de senha do usuário.</p>
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
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/auth/password-reset',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'fulano@fulano.com',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/auth/password-reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"fulano@fulano.com"}'
</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": {
        "email": "fulano@fulano.com",
        "nome": "Fulano da Silva",
        "token": "II35RthZxZ5hTRHsqzA84x0ztuXpXu6YLx89SBMTrLIyON6D8SAIWEMJ0Ixa",
        "validade": "2020-04-21T01:17:22.012273Z"
    },
    "message": "Recuperação de Senha solicitada com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/password-reset"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não foi possível solicitador a recuperação da senha!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/password-reset"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/auth/password-reset</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>Endereço de e-mail.</td>
</tr>
</tbody>
</table>
<!-- END_758d1bc327f18e2d4dbb9b0a22083976 -->
<!-- START_64744f99fcf3bece9ec84aee8c3b0cfc -->
<h2>Confirm Password Reset</h2>
<p>Endpoint para confirmar a solicitação de redefinição de senha.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/auth/confirm-password-reset"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": "libero",
    "email": "fulano@fulano.com",
    "senha": "5&amp;bnaC#f",
    "senha_confirmation": "5&amp;bnaC#f"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/auth/confirm-password-reset',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'token' =&gt; 'libero',
            'email' =&gt; 'fulano@fulano.com',
            'senha' =&gt; '5&amp;bnaC#f',
            'senha_confirmation' =&gt; '5&amp;bnaC#f',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
import json

url = 'http://localhost/api/v1/auth/confirm-password-reset'
payload = {
    "token": "libero",
    "email": "fulano@fulano.com",
    "senha": "5&amp;bnaC#f",
    "senha_confirmation": "5&amp;bnaC#f"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/auth/confirm-password-reset" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":"libero","email":"fulano@fulano.com","senha":"5&amp;bnaC#f","senha_confirmation":"5&amp;bnaC#f"}'
</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não foi possível redefinir a senha do usuaŕio!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/confirm-password-reset"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/auth/confirm-password-reset</code></p>
<h4>Body Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Type</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>token</code></td>
<td>string</td>
<td>required</td>
<td>Token de validação. Example:</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>Endereço de e-mail.</td>
</tr>
<tr>
<td><code>senha</code></td>
<td>string</td>
<td>required</td>
<td>Nova senha (min. 8).</td>
</tr>
<tr>
<td><code>senha_confirmation</code></td>
<td>string</td>
<td>required</td>
<td>Confirmação de nova senha.</td>
</tr>
</tbody>
</table>
<!-- END_64744f99fcf3bece9ec84aee8c3b0cfc -->
<h1>UsuarioController</h1>
<p>Controller responsável pelo gerenciamento de Usuários</p>
<!-- START_f4118dbd959bf0da643fc902f2d8ba1b -->
<h2>GetAll</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que retorna todos os usuários.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/usuario"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/usuario',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
import json

url = 'http://localhost/api/v1/usuario'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/usuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não autorizado",
    "success": false
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não foram encontrados usuários!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/usuario</code></p>
<!-- END_f4118dbd959bf0da643fc902f2d8ba1b -->
      </div>
      <div class="dark-box">
                        <div class="lang-selector">
                                    <a href="#" data-language-name="javascript">javascript</a>
                                    <a href="#" data-language-name="php">php</a>
                                    <a href="#" data-language-name="python">python</a>
                                    <a href="#" data-language-name="bash">bash</a>
                              </div>
                </div>
    </div>
  </body>
</html>