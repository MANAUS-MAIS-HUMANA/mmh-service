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
    "http://back.localhost/api/v1/auth/login"
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
    'http://back.localhost/api/v1/auth/login',
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

url = 'http://back.localhost/api/v1/auth/login'
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
    "http://back.localhost/api/v1/auth/login" \
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
    .then(response =&gt; response.json())
    .then(json =&gt; console.log(json));</code></pre>
<pre><code class="language-php">
$client = new \GuzzleHttp\Client();
$response = $client-&gt;post(
    'http://back.localhost/api/v1/auth/logout',
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

url = 'http://back.localhost/api/v1/auth/logout'
headers = {
  'Content-Type': 'application/json',
  'Accept': 'application/json'
}
response = requests.request('POST', url, headers=headers)
response.json()</code></pre>
<pre><code class="language-bash">curl -X POST \
    "http://back.localhost/api/v1/auth/logout" \
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
    "success": false,
    "url": "http:\/\/back.localhost\/api\/v1\/auth\/logout"
}</code></pre>
<h3>HTTP Request</h3>
<p><code>POST api/v1/auth/logout</code></p>
<!-- END_a68ff660ea3d08198e527df659b17963 -->
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