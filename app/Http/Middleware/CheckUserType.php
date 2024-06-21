<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[] $types
     * @return mixed
     */
    public function handle($request, Closure $next, ...$types)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$user || !in_array($user->type->name, $types)) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return $next($request);
    }
}
