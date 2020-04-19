<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Http\Resources\AuthResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function create(AuthRequest $request)
    {
        $result = $this->authService->create($request);

        return (new AuthResource($result['data'] ?? [], $result['success'], $result['message']))
            ->response()
            ->setStatusCode($result['code']);
    }
}
