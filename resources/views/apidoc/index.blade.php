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
<p>Controller responsável pelo gerenciamento de Usuários</p>
<!-- START_a4a233f86d97c8deebe3bedaa936f967 -->
<h2>Criar usuário</h2>
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
<h2>Redefinir senha</h2>
<p>Endpoint para solicitação de redefinição de senha do usuário.</p>
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