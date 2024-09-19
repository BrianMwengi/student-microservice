<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateApi
{
    public function handle($request, Closure $next, ...$guards)
    {
        try {
            $this->authenticate($guards);
        } catch (AuthenticationException $e) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        return $next($request);
    }
    
    protected function authenticate(array $guards)
    {
        if (auth()->guard('api')->check()) {
            return auth()->shouldUse('api');
        }

        throw new AuthenticationException('Unauthenticated.');
    }
}