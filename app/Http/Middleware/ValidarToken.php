<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Http\Resources\Auth\MiddlewareResource;
use Closure;
use Illuminate\Support\Str;

class ValidarToken
{
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
            throw_if(!$request->header('Authorization'), \Exception::class, 'Não autorizado', 401);

            $token = Str::replaceFirst('Bearer ', '', $request->header('Authorization'));

            $payload = auth()->setToken($token)->getPayload();

            throw_if($payload['user']->status !== 'Ativo', \Exception::class, 'Não autorizado', 401);

            return $next($request);
        } catch (\Throwable $e) {
            return (new MiddlewareResource(null, false, $e->getMessage()))
                ->response()
                ->setStatusCode($e->getCode());
        }
    }
}
