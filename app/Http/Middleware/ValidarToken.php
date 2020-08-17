<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Resources\Auth\MiddlewareResource;
use Closure;
use Illuminate\Support\Str;

class ValidarToken
{
    protected $permissions = [
        '/api\/v1\/auth\/logout.*/' => ['admin', 'codese', 'parceiro'],
        '/api\/v1\/auth\/refresh.*/' => ['admin', 'codese', 'parceiro'],
        '/api\/v1\/usuario\/.+\/set-status/' => ['admin', 'codese'],
        '/api\/v1\/beneficiarios.*/' => ['admin', 'codese', 'parceiro'],
        '/api\/v1\/parceiros.*/' => ['admin', 'codese'],
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            throw_if(!Str::contains($request->headers, ['authorization', 'Authorization']), \Exception::class, 'Não autorizado', 401);

            $payload = auth()->setRequest($request)->getPayload();

            $perfis = explode(',', $payload['user']->perfis);
            $usuarioTemPermissao = $this->isAllowed($request->path(), $perfis);

            $naoTemPermissao = $payload['user']->status !== 'Ativo' || !$usuarioTemPermissao;

            throw_if($naoTemPermissao, \Exception::class, 'Não autorizado', 401);

            return $next($request);
        } catch (\Throwable $e) {
            return (new MiddlewareResource(null, false, 'Não autorizado'))
                ->response()
                ->setStatusCode(401);
        }
    }

    protected function isAllowed($endpointPath, $perfisUsuario)
    {
        foreach($this->permissions as $pattern => $perfis) {
            if (preg_match($pattern, $endpointPath)) {
                foreach ($perfisUsuario as $perfilUsuario) {
                    if (in_array($perfilUsuario, $perfis)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
