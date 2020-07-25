<?php

namespace App\Http\Middleware;

use App\Http\Resources\Auth\MiddlewareResource;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\JsonResponse;

class Authenticate extends Middleware
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param array $guards
     * @return JsonResponse
     */
    protected function unauthenticated($request, array $guards): JsonResponse
    {
        return (new MiddlewareResource(null, false, 'Não autorizado.'))
            ->response()
            ->setStatusCode(401);
    }
}
