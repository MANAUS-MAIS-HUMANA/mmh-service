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
<p>Controller responsável pelo gerenciamento de Usuários do lado público.</p>
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
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","endereco":"Rua Dom Pedro, S\/N, Dom Pedro","estado":"AM","tipo_pessoa":"pf","cpf":"111.111.111-11","cnpj":"11.111.111\/1111-11","senha":"5&amp;bnaC#f","senha_confirmation":"5&amp;bnaC#f"}'
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
            "parceiro"
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
<!-- START_4b77551ffe3e806c992cdd1044012aa7 -->
<h2>Refresh Access token</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para fazer um refresh de um access token previamente gerado.
Após o refresh, o token antigo não poderá ser mais usado.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/auth/refresh',
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

url = 'http://localhost/api/v1/auth/refresh'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": {
        "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9",
        "token_type": "Bearer",
        "expires_in": 3600
    },
    "message": "Token atualizado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/refresh"
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
<p><code>GET api/v1/auth/refresh</code></p>
<!-- END_4b77551ffe3e806c992cdd1044012aa7 -->
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
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
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
            'token' =&gt; 'BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y',
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
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
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
    -d '{"token":"BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y","email":"fulano@fulano.com","senha":"5&amp;bnaC#f","senha_confirmation":"5&amp;bnaC#f"}'
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
<td>Token de validação.</td>
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
<h1>BeneficiarioController</h1>
<p>Controller responsável pelo CRUD de beneficiários.</p>
<!-- START_b66ddf7052986a20d72d938918504a7c -->
<h2>Listar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para buscar uma lista de beneficiários.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/beneficiarios"
);

let params = {
    "page": ""1"",
    "limit": ""10"",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/beneficiarios',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'page'=&gt; '"1"',
            'limit'=&gt; '"10"',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/beneficiarios?page=%221%22&amp;limit=%2210%22" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/beneficiarios</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>page</code></td>
<td>optional</td>
<td>Número da página para retornar os dados.</td>
</tr>
<tr>
<td><code>limit</code></td>
<td>optional</td>
<td>Total de elementos por página para retornar.</td>
</tr>
</tbody>
</table>
<!-- END_b66ddf7052986a20d72d938918504a7c -->
<!-- START_16c03d3a0496c95c245c0466712bd25d -->
<h2>Buscar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para obter os dados de um beneficiário específico.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/beneficiarios/1',
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

url = 'http://localhost/api/v1/beneficiarios/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/beneficiarios/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [
        {
            "id": 1
        }
    ],
    "message": "Beneficiario encontrado!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
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
    "message": "Erro #200: Beneficiario 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/beneficiarios/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>beneficiario</code></td>
<td>required</td>
<td>ID do beneficiário.</td>
</tr>
</tbody>
</table>
<!-- END_16c03d3a0496c95c245c0466712bd25d -->
<!-- START_2c241c85d2933fb7bf154de02f887721 -->
<h2>Criar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para inserir um novo beneficiário no sistema.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    "estado_civil_id": 9,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "maxime",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": true,
    "gostaria_participar_cursos": false,
    "tipo_curso": "animi",
    "concorda_informacoes_verdadeiras": false,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "non"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
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
    'http://localhost/api/v1/beneficiarios',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'parceiro_id' =&gt; 1,
            'nome' =&gt; 'Machado de Assis',
            'cpf' =&gt; '12345678901',
            'email' =&gt; 'fulano@tal.com',
            'data_nascimento' =&gt; '1990-01-01',
            'trabalho' =&gt; 'Trabalhador Autônomo',
            'esta_desempregado' =&gt; false,
            'estado_civil_id' =&gt; 9,
            'nome_conjuge' =&gt; 'Carolina Novais.',
            'cpf_conjuge' =&gt; '10987654321',
            'total_residentes' =&gt; 4,
            'situacao_moradia' =&gt; 'maxime',
            'renda_mensal' =&gt; 1000.0,
            'gostaria_montar_negocio' =&gt; true,
            'gostaria_participar_cursos' =&gt; false,
            'tipo_curso' =&gt; 'animi',
            'concorda_informacoes_verdadeiras' =&gt; false,
            'data_submissao' =&gt; '2020-05-01 10:11:12',
            'telefones' =&gt; [
                [
                    'telefone' =&gt; 92991234567,
                    'tipo' =&gt; 'non',
                ],
            ],
            'enderecos' =&gt; [
                [
                    'endereco' =&gt; 'Rua da paz, 150',
                    'bairro_id' =&gt; 1,
                    'zona_id' =&gt; 1,
                    'cep' =&gt; '"69061000"',
                    'ponto_referencia' =&gt; '"INPA"',
                    'cidade_id' =&gt; 1,
                ],
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
    "estado_civil_id": 9,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "maxime",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": true,
    "gostaria_participar_cursos": false,
    "tipo_curso": "animi",
    "concorda_informacoes_verdadeiras": false,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "non"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/beneficiarios" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"parceiro_id":1,"nome":"Machado de Assis","cpf":"12345678901","email":"fulano@tal.com","data_nascimento":"1990-01-01","trabalho":"Trabalhador Aut\u00f4nomo","esta_desempregado":false,"estado_civil_id":9,"nome_conjuge":"Carolina Novais.","cpf_conjuge":"10987654321","total_residentes":4,"situacao_moradia":"maxime","renda_mensal":1000,"gostaria_montar_negocio":true,"gostaria_participar_cursos":false,"tipo_curso":"animi","concorda_informacoes_verdadeiras":false,"data_submissao":"2020-05-01 10:11:12","telefones":[{"telefone":92991234567,"tipo":"non"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"zona_id":1,"cep":"\"69061000\"","ponto_referencia":"\"INPA\"","cidade_id":1}]}'
</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
    "data": {
        "id": 1
    },
    "message": "Beneficiário criado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
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
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "errors": [
        "O CPF já existe no sistema."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/beneficiarios</code></p>
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
<td><code>parceiro_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da instituição parceira.</td>
</tr>
<tr>
<td><code>nome</code></td>
<td>string</td>
<td>required</td>
<td>Nome do novo beneficiário - (max. 255).</td>
</tr>
<tr>
<td><code>cpf</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF do beneficiário.</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>optional</td>
<td>Endereço de e-mail do beneficiário - (max. 255).</td>
</tr>
<tr>
<td><code>data_nascimento</code></td>
<td>string</td>
<td>required</td>
<td>Data de nascimento do beneficiário, no formato AAAA-MM-DD.</td>
</tr>
<tr>
<td><code>trabalho</code></td>
<td>string</td>
<td>optional</td>
<td>Ocupação do beneficiário.</td>
</tr>
<tr>
<td><code>esta_desempregado</code></td>
<td>boolean</td>
<td>optional</td>
<td>Indica se o beneficiário está desempregado ou não.</td>
</tr>
<tr>
<td><code>estado_civil_id</code></td>
<td>integer</td>
<td>optional</td>
<td>Estado civil do beneficiario.</td>
</tr>
<tr>
<td><code>nome_conjuge</code></td>
<td>string</td>
<td>optional</td>
<td>Nome do cônjuge.</td>
</tr>
<tr>
<td><code>cpf_conjuge</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF do cônjuge.</td>
</tr>
<tr>
<td><code>total_residentes</code></td>
<td>integer</td>
<td>optional</td>
<td>Total de pessoas na residência do beneficiario.</td>
</tr>
<tr>
<td><code>situacao_moradia</code></td>
<td>string</td>
<td>optional</td>
<td>Situação da moradia: Própria, Alugada, Cedida ou Própria Financiada</td>
</tr>
<tr>
<td><code>renda_mensal</code></td>
<td>float</td>
<td>optional</td>
<td>Renda mensal do beneficiário.</td>
</tr>
<tr>
<td><code>gostaria_montar_negocio</code></td>
<td>boolean</td>
<td>optional</td>
<td>Indica se o beneficiário tem intersse em montar um negócio.</td>
</tr>
<tr>
<td><code>gostaria_participar_cursos</code></td>
<td>boolean</td>
<td>optional</td>
<td>Indica se o usuário tem interesse em participar de cursos.</td>
</tr>
<tr>
<td><code>tipo_curso</code></td>
<td>string</td>
<td>optional</td>
<td>Tipo de curso que o beneficiário gostaria de fazer: Presencial, Online ou Ambos.</td>
</tr>
<tr>
<td><code>concorda_informacoes_verdadeiras</code></td>
<td>boolean</td>
<td>required</td>
<td>Indica se o usuário concordou com os termos.</td>
</tr>
<tr>
<td><code>data_submissao</code></td>
<td>string</td>
<td>optional</td>
<td>Data e hora de submissão do formulário, no formato AAAA-MM-DD HH:MM:SS.</td>
</tr>
<tr>
<td><code>telefones</code></td>
<td>array</td>
<td>optional</td>
<td>Lista de telefones.</td>
</tr>
<tr>
<td><code>telefones[0].telefone</code></td>
<td>integer</td>
<td>required</td>
<td>Número de telefone com DDD.</td>
</tr>
<tr>
<td><code>telefones[0].tipo</code></td>
<td>string</td>
<td>required</td>
<td>Tipo do telefone: &quot;Fixo&quot; ou &quot;Celular&quot;</td>
</tr>
<tr>
<td><code>enderecos</code></td>
<td>array</td>
<td>required</td>
<td>Lista de enderecos.</td>
</tr>
<tr>
<td><code>enderecos[0].endereco</code></td>
<td>string</td>
<td>required</td>
<td>Nome da rua, com número e complemento.</td>
</tr>
<tr>
<td><code>enderecos[0].bairro_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID do bairro.</td>
</tr>
<tr>
<td><code>enderecos[0].zona_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da zona da cidade.</td>
</tr>
<tr>
<td><code>enderecos[0].cep</code></td>
<td>string</td>
<td>required</td>
<td>CEP da rua.</td>
</tr>
<tr>
<td><code>enderecos[0].ponto_referencia</code></td>
<td>string</td>
<td>optional</td>
<td>Ponto de referência.</td>
</tr>
<tr>
<td><code>enderecos[0].cidade_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da cidade.</td>
</tr>
</tbody>
</table>
<!-- END_2c241c85d2933fb7bf154de02f887721 -->
<!-- START_ac16fe552e87e418591297f9829ceb5d -->
<h2>Atualizar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para atualizar os dados de um beneficiário.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    "estado_civil_id": 8,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "architecto",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": false,
    "gostaria_participar_cursos": true,
    "tipo_curso": "repellendus",
    "concorda_informacoes_verdadeiras": false,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "porro"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost/api/v1/beneficiarios/1',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'parceiro_id' =&gt; 1,
            'nome' =&gt; 'Machado de Assis',
            'cpf' =&gt; '12345678901',
            'email' =&gt; 'fulano@tal.com',
            'data_nascimento' =&gt; '1990-01-01',
            'trabalho' =&gt; 'Trabalhador Autônomo',
            'esta_desempregado' =&gt; true,
            'estado_civil_id' =&gt; 8,
            'nome_conjuge' =&gt; 'Carolina Novais.',
            'cpf_conjuge' =&gt; '10987654321',
            'total_residentes' =&gt; 4,
            'situacao_moradia' =&gt; 'architecto',
            'renda_mensal' =&gt; 1000.0,
            'gostaria_montar_negocio' =&gt; false,
            'gostaria_participar_cursos' =&gt; true,
            'tipo_curso' =&gt; 'repellendus',
            'concorda_informacoes_verdadeiras' =&gt; false,
            'data_submissao' =&gt; '2020-05-01 10:11:12',
            'telefones' =&gt; [
                [
                    'telefone' =&gt; 92991234567,
                    'tipo' =&gt; 'porro',
                ],
            ],
            'enderecos' =&gt; [
                [
                    'endereco' =&gt; 'Rua da paz, 150',
                    'bairro_id' =&gt; 1,
                    'zona_id' =&gt; 1,
                    'cep' =&gt; '"69061000"',
                    'ponto_referencia' =&gt; '"INPA"',
                    'cidade_id' =&gt; 1,
                ],
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
    "estado_civil_id": 8,
    "nome_conjuge": "Carolina Novais.",
    "cpf_conjuge": "10987654321",
    "total_residentes": 4,
    "situacao_moradia": "architecto",
    "renda_mensal": 1000,
    "gostaria_montar_negocio": false,
    "gostaria_participar_cursos": true,
    "tipo_curso": "repellendus",
    "concorda_informacoes_verdadeiras": false,
    "data_submissao": "2020-05-01 10:11:12",
    "telefones": [
        {
            "telefone": 92991234567,
            "tipo": "porro"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "zona_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X PUT \
    "http://localhost/api/v1/beneficiarios/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"parceiro_id":1,"nome":"Machado de Assis","cpf":"12345678901","email":"fulano@tal.com","data_nascimento":"1990-01-01","trabalho":"Trabalhador Aut\u00f4nomo","esta_desempregado":true,"estado_civil_id":8,"nome_conjuge":"Carolina Novais.","cpf_conjuge":"10987654321","total_residentes":4,"situacao_moradia":"architecto","renda_mensal":1000,"gostaria_montar_negocio":false,"gostaria_participar_cursos":true,"tipo_curso":"repellendus","concorda_informacoes_verdadeiras":false,"data_submissao":"2020-05-01 10:11:12","telefones":[{"telefone":92991234567,"tipo":"porro"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"zona_id":1,"cep":"\"69061000\"","ponto_referencia":"\"INPA\"","cidade_id":1}]}'
</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Beneficiario atualizado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
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
    "message": "Erro #200: Beneficiario 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "errors": [
        "O ID do parceiro é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/beneficiarios/{id}</code></p>
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
<td><code>parceiro_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da instituição parceira.</td>
</tr>
<tr>
<td><code>nome</code></td>
<td>string</td>
<td>required</td>
<td>Nome do novo beneficiário - (max. 255).</td>
</tr>
<tr>
<td><code>cpf</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF do beneficiário.</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>optional</td>
<td>Endereço de e-mail do beneficiário - (max. 255).</td>
</tr>
<tr>
<td><code>data_nascimento</code></td>
<td>string</td>
<td>required</td>
<td>Data de nascimento do beneficiário, no formato AAAA-MM-DD.</td>
</tr>
<tr>
<td><code>trabalho</code></td>
<td>string</td>
<td>optional</td>
<td>Ocupação do beneficiário.</td>
</tr>
<tr>
<td><code>esta_desempregado</code></td>
<td>boolean</td>
<td>optional</td>
<td>Indica se o beneficiário está desempregado ou não.</td>
</tr>
<tr>
<td><code>estado_civil_id</code></td>
<td>integer</td>
<td>optional</td>
<td>Estado civil do beneficiario.</td>
</tr>
<tr>
<td><code>nome_conjuge</code></td>
<td>string</td>
<td>optional</td>
<td>Nome do cônjuge.</td>
</tr>
<tr>
<td><code>cpf_conjuge</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF do cônjuge.</td>
</tr>
<tr>
<td><code>total_residentes</code></td>
<td>integer</td>
<td>optional</td>
<td>Total de pessoas na residência do beneficiario.</td>
</tr>
<tr>
<td><code>situacao_moradia</code></td>
<td>string</td>
<td>optional</td>
<td>Situação da moradia: Própria, Alugada, Cedida ou Própria Financiada</td>
</tr>
<tr>
<td><code>renda_mensal</code></td>
<td>float</td>
<td>optional</td>
<td>Renda mensal do beneficiário.</td>
</tr>
<tr>
<td><code>gostaria_montar_negocio</code></td>
<td>boolean</td>
<td>optional</td>
<td>Indica se o beneficiário tem intersse em montar um negócio.</td>
</tr>
<tr>
<td><code>gostaria_participar_cursos</code></td>
<td>boolean</td>
<td>optional</td>
<td>Indica se o usuário tem interesse em participar de cursos.</td>
</tr>
<tr>
<td><code>tipo_curso</code></td>
<td>string</td>
<td>optional</td>
<td>Tipo de curso que o beneficiário gostaria de fazer: Presencial, Online ou Ambos.</td>
</tr>
<tr>
<td><code>concorda_informacoes_verdadeiras</code></td>
<td>boolean</td>
<td>required</td>
<td>Indica se o usuário concordou com os termos.</td>
</tr>
<tr>
<td><code>data_submissao</code></td>
<td>string</td>
<td>optional</td>
<td>Data e hora de submissão do formulário, no formato AAAA-MM-DD HH:MM:SS.</td>
</tr>
<tr>
<td><code>telefones</code></td>
<td>array</td>
<td>optional</td>
<td>Lista de telefones.</td>
</tr>
<tr>
<td><code>telefones[0].telefone</code></td>
<td>integer</td>
<td>required</td>
<td>Número de telefone com DDD.</td>
</tr>
<tr>
<td><code>telefones[0].tipo</code></td>
<td>string</td>
<td>required</td>
<td>Tipo do telefone: &quot;Fixo&quot; ou &quot;Celular&quot;</td>
</tr>
<tr>
<td><code>enderecos</code></td>
<td>array</td>
<td>required</td>
<td>Lista de enderecos.</td>
</tr>
<tr>
<td><code>enderecos[0].endereco</code></td>
<td>string</td>
<td>required</td>
<td>Nome da rua, com número e complemento.</td>
</tr>
<tr>
<td><code>enderecos[0].bairro_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID do bairro.</td>
</tr>
<tr>
<td><code>enderecos[0].zona_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da zona da cidade.</td>
</tr>
<tr>
<td><code>enderecos[0].cep</code></td>
<td>string</td>
<td>required</td>
<td>CEP da rua.</td>
</tr>
<tr>
<td><code>enderecos[0].ponto_referencia</code></td>
<td>string</td>
<td>optional</td>
<td>Ponto de referência.</td>
</tr>
<tr>
<td><code>enderecos[0].cidade_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da cidade.</td>
</tr>
</tbody>
</table>
<!-- END_ac16fe552e87e418591297f9829ceb5d -->
<!-- START_bf69b99e6bfae0dd82366f4a6beb22cd -->
<h2>Remover</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para remover um beneficiário do sistema.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost/api/v1/beneficiarios/1',
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

url = 'http://localhost/api/v1/beneficiarios/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X DELETE \
    "http://localhost/api/v1/beneficiarios/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Beneficiário removido com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
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
    "message": "Erro #200: Beneficiario 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios\/1"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/beneficiarios"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/beneficiarios/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>beneficiario</code></td>
<td>required</td>
<td>ID do beneficiário.</td>
</tr>
</tbody>
</table>
<!-- END_bf69b99e6bfae0dd82366f4a6beb22cd -->
<h1>DoadorController</h1>
<p>Controller responsável pelo CRUD de doadores.</p>
<!-- START_b3fba95f5e912d42c5fd681d1e2a21ec -->
<h2>Listar</h2>
<p>Endpoint para buscar doadores ordernados pela quantidade de cestas doadas</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/doadores/ranking"
);

let params = {
    "page": ""1"",
    "limit": ""6"",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/doadores/ranking',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'page'=&gt; '"1"',
            'limit'=&gt; '"6"',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/doadores/ranking?page=%221%22&amp;limit=%226%22" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/doadores/ranking</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>page</code></td>
<td>optional</td>
<td>Número da página para retornar os dados.</td>
</tr>
<tr>
<td><code>limit</code></td>
<td>optional</td>
<td>Total de elementos por página para retornar.</td>
</tr>
</tbody>
</table>
<!-- END_b3fba95f5e912d42c5fd681d1e2a21ec -->
<h1>ParceiroController</h1>
<p>Controller responsável pelo CRUD de instituições parceiras.</p>
<!-- START_0d4dfb28e77c127afb29ac9f5077f22f -->
<h2>Listar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para buscar uma lista de parceiros.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/parceiros"
);

let params = {
    "page": ""1"",
    "limit": ""6"",
};
Object.keys(params)
    .forEach(key =&gt; url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/parceiros',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'query' =&gt; [
            'page'=&gt; '"1"',
            'limit'=&gt; '"6"',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/parceiros?page=%221%22&amp;limit=%226%22" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/parceiros</code></p>
<h4>Query Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>page</code></td>
<td>optional</td>
<td>Número da página para retornar os dados.</td>
</tr>
<tr>
<td><code>limit</code></td>
<td>optional</td>
<td>Total de elementos por página para retornar.</td>
</tr>
</tbody>
</table>
<!-- END_0d4dfb28e77c127afb29ac9f5077f22f -->
<!-- START_5b7e578c57cc0e59c7b0a6653587ed4b -->
<h2>Listar Básico</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para buscar o ID e nome de todos os parceiros.
Essa rota será usada especialmente na página de Beneficiários, quando o usuário logado
for Admin ou Codese.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/parceiros/basico',
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

url = 'http://localhost/api/v1/parceiros/basico'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/parceiros/basico" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/parceiros/basico</code></p>
<!-- END_5b7e578c57cc0e59c7b0a6653587ed4b -->
<!-- START_a072594af821ade9e7ce15d71dbe9460 -->
<h2>Buscar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para obter os dados de um parceiro específico.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/parceiros/1',
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

url = 'http://localhost/api/v1/parceiros/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/parceiros/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
    "message": "Erro #105: Parceiro 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/parceiros/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>parceiro</code></td>
<td>required</td>
<td>ID do parceiro.</td>
</tr>
</tbody>
</table>
<!-- END_a072594af821ade9e7ce15d71dbe9460 -->
<!-- START_543d37f5ea560f7ea10b487b2b15671f -->
<h2>Criar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para inserir uma nova instituição parceira no sistema.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
            "tipo": "totam"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
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
    'http://localhost/api/v1/parceiros',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'nome' =&gt; 'Manaus+Humana',
            'email' =&gt; 'fulano@tal.com',
            'cnpj' =&gt; '13245678901234',
            'cpf' =&gt; '12345678901',
            'telefones' =&gt; [
                [
                    'telefone' =&gt; 92991234567,
                    'tipo' =&gt; 'totam',
                ],
            ],
            'enderecos' =&gt; [
                [
                    'endereco' =&gt; 'Rua da paz, 150',
                    'bairro_id' =&gt; 1,
                    'cep' =&gt; '"69061000"',
                    'ponto_referencia' =&gt; '"INPA"',
                    'cidade_id' =&gt; 1,
                ],
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
            "tipo": "totam"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/parceiros" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Manaus+Humana","email":"fulano@tal.com","cnpj":"13245678901234","cpf":"12345678901","telefones":[{"telefone":92991234567,"tipo":"totam"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"cep":"\"69061000\"","ponto_referencia":"\"INPA\"","cidade_id":1}]}'
</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
    "data": {
        "id": 2
    },
    "message": "Parceiro criado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
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
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "errors": [
        "O Nome é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/parceiros</code></p>
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
<td>Nome do novo parceiro - (max. 255).</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>Endereço de e-mail do parceiro - (max. 255).</td>
</tr>
<tr>
<td><code>cnpj</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CNPJ da instituição (obrigatório se não houver CPF).</td>
</tr>
<tr>
<td><code>cpf</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF da instituição (obrigatório se não houver CNPJ).</td>
</tr>
<tr>
<td><code>telefones</code></td>
<td>array</td>
<td>required</td>
<td>Lista de telefones.</td>
</tr>
<tr>
<td><code>telefones[0].telefone</code></td>
<td>integer</td>
<td>required</td>
<td>Número de telefone com DDD.</td>
</tr>
<tr>
<td><code>telefones[0].tipo</code></td>
<td>string</td>
<td>required</td>
<td>Tipo do telefone: &quot;Fixo&quot; ou &quot;Celular&quot;</td>
</tr>
<tr>
<td><code>enderecos</code></td>
<td>array</td>
<td>required</td>
<td>Lista de enderecos.</td>
</tr>
<tr>
<td><code>enderecos[0].endereco</code></td>
<td>string</td>
<td>required</td>
<td>Nome da rua, com número e complemento.</td>
</tr>
<tr>
<td><code>enderecos[0].bairro_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID do bairro.</td>
</tr>
<tr>
<td><code>enderecos[0].cep</code></td>
<td>string</td>
<td>required</td>
<td>CEP da rua.</td>
</tr>
<tr>
<td><code>enderecos[0].ponto_referencia</code></td>
<td>string</td>
<td>optional</td>
<td>Ponto de referência.</td>
</tr>
<tr>
<td><code>enderecos[0].cidade_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da cidade.</td>
</tr>
</tbody>
</table>
<!-- END_543d37f5ea560f7ea10b487b2b15671f -->
<!-- START_5aaa67f3f0225463d7c25473608a7464 -->
<h2>Atualizar</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para atualizar os dados de um parceiro.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
            "tipo": "placeat"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost/api/v1/parceiros/1',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'nome' =&gt; 'Manaus+Humana',
            'email' =&gt; 'fulano@tal.com',
            'cnpj' =&gt; '13245678901234',
            'cpf' =&gt; '12345678901',
            'telefones' =&gt; [
                [
                    'telefone' =&gt; 92991234567,
                    'tipo' =&gt; 'placeat',
                ],
            ],
            'enderecos' =&gt; [
                [
                    'endereco' =&gt; 'Rua da paz, 150',
                    'bairro_id' =&gt; 1,
                    'cep' =&gt; '"69061000"',
                    'ponto_referencia' =&gt; '"INPA"',
                    'cidade_id' =&gt; 1,
                ],
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
            "tipo": "placeat"
        }
    ],
    "enderecos": [
        {
            "endereco": "Rua da paz, 150",
            "bairro_id": 1,
            "cep": "\"69061000\"",
            "ponto_referencia": "\"INPA\"",
            "cidade_id": 1
        }
    ]
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X PUT \
    "http://localhost/api/v1/parceiros/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Manaus+Humana","email":"fulano@tal.com","cnpj":"13245678901234","cpf":"12345678901","telefones":[{"telefone":92991234567,"tipo":"placeat"}],"enderecos":[{"endereco":"Rua da paz, 150","bairro_id":1,"cep":"\"69061000\"","ponto_referencia":"\"INPA\"","cidade_id":1}]}'
</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
    "message": "Erro #105: Parceiro 2 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "errors": [
        "O Nome é obrigatório."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/parceiros/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>parceiro</code></td>
<td>required</td>
<td>ID do parceiro.</td>
</tr>
</tbody>
</table>
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
<td>Nome do novo parceiro - (max. 255).</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>required</td>
<td>Endereço de e-mail do parceiro - (max. 255).</td>
</tr>
<tr>
<td><code>cnpj</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CNPJ da instituição (obrigatório se não houver CPF).</td>
</tr>
<tr>
<td><code>cpf</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF da instituição (obrigatório se não houver CNPJ).</td>
</tr>
<tr>
<td><code>telefones</code></td>
<td>array</td>
<td>required</td>
<td>Lista de telefones.</td>
</tr>
<tr>
<td><code>telefones[0].telefone</code></td>
<td>integer</td>
<td>required</td>
<td>Número de telefone com DDD.</td>
</tr>
<tr>
<td><code>telefones[0].tipo</code></td>
<td>string</td>
<td>required</td>
<td>Tipo do telefone: &quot;Fixo&quot; ou &quot;Celular&quot;</td>
</tr>
<tr>
<td><code>enderecos</code></td>
<td>array</td>
<td>required</td>
<td>Lista de enderecos</td>
</tr>
<tr>
<td><code>enderecos[0].endereco</code></td>
<td>string</td>
<td>required</td>
<td>Nome da rua, com número e complemento.</td>
</tr>
<tr>
<td><code>enderecos[0].bairro_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID do bairro.</td>
</tr>
<tr>
<td><code>enderecos[0].cep</code></td>
<td>string</td>
<td>required</td>
<td>CEP da rua.</td>
</tr>
<tr>
<td><code>enderecos[0].ponto_referencia</code></td>
<td>string</td>
<td>optional</td>
<td>Ponto de referência.</td>
</tr>
<tr>
<td><code>enderecos[0].cidade_id</code></td>
<td>integer</td>
<td>required</td>
<td>ID da cidade.</td>
</tr>
</tbody>
</table>
<!-- END_5aaa67f3f0225463d7c25473608a7464 -->
<!-- START_ce8ca1fc55cd829a93844b4be19d491a -->
<h2>Remover</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para remover um parceiro do sistema.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost/api/v1/parceiros/1',
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

url = 'http://localhost/api/v1/parceiros/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X DELETE \
    "http://localhost/api/v1/parceiros/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Parceiro removido com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1"
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
    "message": "Erro #105: Parceiro 2 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2"
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/parceiros/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>parceiro</code></td>
<td>required</td>
<td>ID do parceiro.</td>
</tr>
</tbody>
</table>
<!-- END_ce8ca1fc55cd829a93844b4be19d491a -->
<!-- START_20264597d0b87ecbcbcfbb6ec4f1a603 -->
<h2>Criar Doação</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para doação dos parceiros para beneficiarios</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'total_cestas' =&gt; 1,
            'data_doacao' =&gt; '2020-06-01',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"total_cestas":1,"data_doacao":"2020-06-01"}'
</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
    "data": {
        "id": 1
    },
    "message": "Doação do beneficiario criado com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">[
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
]</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não autorizado",
    "success": false
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/parceiros/{id}/beneficiarios/{beneficiaryId}/doacoes</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>ID do parceiro.</td>
</tr>
<tr>
<td><code>beneficiaryId</code></td>
<td>required</td>
<td>ID do beneficiario.</td>
</tr>
</tbody>
</table>
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
<td><code>total_cestas</code></td>
<td>integer</td>
<td>required</td>
<td>Número de cestas doadas.</td>
</tr>
<tr>
<td><code>data_doacao</code></td>
<td>string</td>
<td>required</td>
<td>Data da doação das cestas.</td>
</tr>
</tbody>
</table>
<!-- END_20264597d0b87ecbcbcfbb6ec4f1a603 -->
<!-- START_fe27055586bbde39106c9bf28cc0b8d8 -->
<h2>Remove Doação</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para remoção das doações de um beneficiarios</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;delete(
    'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes/1',
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

url = 'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('DELETE', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X DELETE \
    "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Doação removido com sucesso!",
    "success": true,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes\/1"
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #204: Doação 1 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/1\/beneficiarios\/1\/doacoes\/1"
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
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>DELETE api/v1/parceiros/{id}/beneficiarios/{beneficiaryId}/doacoes/{donationId}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>ID do parceiro.</td>
</tr>
<tr>
<td><code>beneficiaryId</code></td>
<td>required</td>
<td>ID do beneficiario.</td>
</tr>
<tr>
<td><code>$donationId</code></td>
<td>required</td>
<td>ID da doação.</td>
</tr>
</tbody>
</table>
<!-- END_fe27055586bbde39106c9bf28cc0b8d8 -->
<!-- START_ba056cf31c9e6a89371fb04650977109 -->
<h2>Listar as doações</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint listar as doações de um beneficiário</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes',
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

url = 'http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/parceiros/1/beneficiarios/1/doacoes" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #200: Beneficiario 22 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/2\/beneficiarios\/22\/doacoes"
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
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/parceiros/{id}/beneficiarios/{beneficiaryId}/doacoes</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>ID do parceiro.</td>
</tr>
<tr>
<td><code>beneficiaryId</code></td>
<td>required</td>
<td>ID do beneficiario.</td>
</tr>
</tbody>
</table>
<!-- END_ba056cf31c9e6a89371fb04650977109 -->
<!-- START_8f0e2412d4364b7a50b608edea4b1a06 -->
<h2>Listar os beneficiários</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint listar os beneficiários de um parceiro</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/parceiros/1/beneficiarios',
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

url = 'http://localhost/api/v1/parceiros/1/beneficiarios'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/parceiros/1/beneficiarios" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #105: Parceiro 20 não encontrado.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros\/20\/beneficiarios"
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
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Erro #1: Um erro inesperado ocorreu.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/parceiros"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/parceiros/{id}/beneficiarios</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>id</code></td>
<td>required</td>
<td>ID do parceiro.</td>
</tr>
</tbody>
</table>
<!-- END_8f0e2412d4364b7a50b608edea4b1a06 -->
<h1>UsuarioController</h1>
<p>Controller responsável pelo gerenciamento de Usuários do lado privado.</p>
<!-- START_94b9e39c9179e6826963c4293a458c30 -->
<h2>Index</h2>
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
    method: "GET",
    headers: headers,
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
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
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/usuario" \
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
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
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
<p><code>GET api/v1/usuario</code></p>
<!-- END_94b9e39c9179e6826963c4293a458c30 -->
<!-- START_f4118dbd959bf0da643fc902f2d8ba1b -->
<h2>Store</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint para criação de novo usuário.</p>
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
                    'id' =&gt; 3,
                    'perfil' =&gt; 'parceiro',
                    'descricao' =&gt; 'Igreja ou ONG.',
                ],
            ],
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/usuario" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","endereco":"Rua Dom Pedro, S\/N, Dom Pedro","estado":"AM","tipo_pessoa":"pf","cpf":"111.111.111-11","cnpj":"11.111.111\/1111-11","perfis":[{"id":3,"perfil":"parceiro","descricao":"Igreja ou ONG."}]}'
</code></pre>
<blockquote>
<p>Example response (201):</p>
</blockquote>
<pre><code class="language-json">{
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
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<blockquote>
<p>Example response (500):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Não foi possível criar o usuário!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/usuario</code></p>
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
<td>Matriz de perfis.</td>
</tr>
<tr>
<td><code>perfis[0].id</code></td>
<td>integer</td>
<td>required</td>
<td>ID do perfil.</td>
</tr>
<tr>
<td><code>perfis[0].perfil</code></td>
<td>string</td>
<td>optional</td>
<td>Nome do perfil.</td>
</tr>
<tr>
<td><code>perfis[0].descricao</code></td>
<td>string</td>
<td>optional</td>
<td>Descrição do perfil.</td>
</tr>
</tbody>
</table>
<!-- END_f4118dbd959bf0da643fc902f2d8ba1b -->
<!-- START_33b204ea4b1df799847e39ea5600738b -->
<h2>Show</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que retorna o usuário pelo id.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;get(
    'http://localhost/api/v1/usuario/1',
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

url = 'http://localhost/api/v1/usuario/1'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('GET', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/usuario/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
    "message": "Usuário não encontrado!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/1"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>GET api/v1/usuario/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>usuario</code></td>
<td>required</td>
<td>ID do usuário.</td>
</tr>
</tbody>
</table>
<!-- END_33b204ea4b1df799847e39ea5600738b -->
<!-- START_6a759fafba79060dfb4b8762a07e4c23 -->
<h2>Update</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que atualiza os dados do usuário.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost/api/v1/usuario/1',
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
                    'id' =&gt; 3,
                    'perfil' =&gt; 'parceiro',
                    'descricao' =&gt; 'Igreja ou ONG.',
                ],
            ],
            'status' =&gt; 'A',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X PUT \
    "http://localhost/api/v1/usuario/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"nome":"Fulano de Tal","email":"fulano@tal.com","endereco":"Rua Dom Pedro, S\/N, Dom Pedro","estado":"AM","tipo_pessoa":"pf","cpf":"111.111.111-11","cnpj":"11.111.111\/1111-11","perfis":[{"id":3,"perfil":"parceiro","descricao":"Igreja ou ONG."}],"status":"A"}'
</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Usuário não encontrado!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
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
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/usuario/{id}</code></p>
<p><code>PATCH api/v1/usuario/{id}</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>usuario</code></td>
<td>required</td>
<td>ID do usuário.</td>
</tr>
</tbody>
</table>
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
<td>optional</td>
<td>Nome do novo usuário - (max. 255).</td>
</tr>
<tr>
<td><code>email</code></td>
<td>string</td>
<td>optional</td>
<td>Endereço de e-mail - (max. 255).</td>
</tr>
<tr>
<td><code>endereco</code></td>
<td>string</td>
<td>optional</td>
<td>Endereço residencial - (max. 255).</td>
</tr>
<tr>
<td><code>estado</code></td>
<td>string</td>
<td>optional</td>
<td>Estado - (tam. 2).</td>
</tr>
<tr>
<td><code>tipo_pessoa</code></td>
<td>string</td>
<td>optional</td>
<td>Tipo de Pessoa (PF ou PJ).</td>
</tr>
<tr>
<td><code>cpf</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CPF do usuário.</td>
</tr>
<tr>
<td><code>cnpj</code></td>
<td>string</td>
<td>optional</td>
<td>Número do CNPJ da instituição.</td>
</tr>
<tr>
<td><code>perfis</code></td>
<td>array</td>
<td>optional</td>
<td>Matriz de perfis.</td>
</tr>
<tr>
<td><code>perfis[0].id</code></td>
<td>integer</td>
<td>optional</td>
<td>ID do perfil.</td>
</tr>
<tr>
<td><code>perfis[0].perfil</code></td>
<td>string</td>
<td>optional</td>
<td>Nome do perfil.</td>
</tr>
<tr>
<td><code>perfis[0].descricao</code></td>
<td>string</td>
<td>optional</td>
<td>Descrição do perfil.</td>
</tr>
<tr>
<td><code>status</code></td>
<td>string</td>
<td>optional</td>
<td>Status de usuário (A, I ou B).</td>
</tr>
</tbody>
</table>
<!-- END_6a759fafba79060dfb4b8762a07e4c23 -->
<!-- START_c72d2f99606a3aefdfc00ac95b31d8d1 -->
<h2>SetStatus</h2>
<p><br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
Endpoint que atualiza o status do usuário.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost/api/v1/usuario/1/set-status',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'status' =&gt; 'A',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
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
response.json()</code></pre>
<pre><code class="language-bash">curl -X PUT \
    "http://localhost/api/v1/usuario/1/set-status" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"status":"A"}'
</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Usuário não encontrado!",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-status"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "errors": [
        "O Status de Usuário é inválido (aceito: A, I, B)."
    ],
    "message": "Existem campos inválidos.",
    "refreshToken": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9iYWNrLmxvY2FsaG9zd",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-status"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/usuario/{id}/set-status</code></p>
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
<td><code>status</code></td>
<td>string</td>
<td>optional</td>
<td>Status de usuário (A, I ou B).</td>
</tr>
</tbody>
</table>
<!-- END_c72d2f99606a3aefdfc00ac95b31d8d1 -->
<!-- START_af574b0c80b0d9c34cb32ac5d2367e41 -->
<h2>SetPassword</h2>
<p>Endpoint que define a senha do usuário.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/usuario/1/set-password"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "fulano@tal.com",
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
    "senha": "5&amp;bnaC#f",
    "senha_confirmation": "5&amp;bnaC#f"
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;put(
    'http://localhost/api/v1/usuario/1/set-password',
    [
        'headers' =&gt; [
            'Content-Type' =&gt; 'application/json',
            'Accept' =&gt; 'application/json',
        ],
        'json' =&gt; [
            'email' =&gt; 'fulano@tal.com',
            'token' =&gt; 'BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y',
            'senha' =&gt; '5&amp;bnaC#f',
            'senha_confirmation' =&gt; '5&amp;bnaC#f',
        ],
    ]
);
$body = $response-&gt;getBody();
print_r(json_decode((string) $body));</code></pre>
<pre><code class="language-python">import requests
import json

url = 'http://localhost/api/v1/usuario/1/set-password'
payload = {
    "email": "fulano@tal.com",
    "token": "BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y",
    "senha": "5&amp;bnaC#f",
    "senha_confirmation": "5&amp;bnaC#f"
}
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('PUT', url, headers=headers, json=payload)
response.json()</code></pre>
<pre><code class="language-bash">curl -X PUT \
    "http://localhost/api/v1/usuario/1/set-password" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"fulano@tal.com","token":"BFKSdhl6CNS9CZfMNxRei0C7KTa10e84AxeML1XzWBdRrF2Beug5e2nK2X3Y","senha":"5&amp;bnaC#f","senha_confirmation":"5&amp;bnaC#f"}'
</code></pre>
<blockquote>
<p>Example response (200):</p>
</blockquote>
<pre><code class="language-json">{
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
<p>Example response (403):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Está ação não é autorizada.",
    "success": false
}</code></pre>
<blockquote>
<p>Example response (404):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "message": "Usuário não encontrado!",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-password"
}</code></pre>
<blockquote>
<p>Example response (422):</p>
</blockquote>
<pre><code class="language-json">{
    "data": [],
    "errors": [
        "A confirmação da Senha não corresponde.",
        "O Token é inválido."
    ],
    "message": "Existem campos inválidos.",
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/usuario\/2\/set-password"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>PUT api/v1/usuario/{id}/set-password</code></p>
<h4>URL Parameters</h4>
<table>
<thead>
<tr>
<th>Parameter</th>
<th>Status</th>
<th>Description</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>usuario</code></td>
<td>required</td>
<td>ID do usuário.</td>
</tr>
</tbody>
</table>
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
<td>Endereço de e-mail - (max. 255).</td>
</tr>
<tr>
<td><code>token</code></td>
<td>string</td>
<td>required</td>
<td>Token de validação - (max. 255).</td>
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
<!-- END_af574b0c80b0d9c34cb32ac5d2367e41 -->
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