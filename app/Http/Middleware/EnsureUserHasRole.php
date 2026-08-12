<?php

namespace App\Http\Middleware;

use App\Exceptions\ApiException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRole
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        if (! $user || ! $user->rol || ! in_array($user->rol->nombre, $roles, true)) {
            throw new ApiException('AUTH-1003', 'No tienes permiso para realizar esta acción', 403);
        }

        return $next($request);
    }
}
