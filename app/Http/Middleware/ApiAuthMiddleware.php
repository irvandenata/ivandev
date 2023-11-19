<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next, ...$roles)
    {
        //check token bareer and user
        $token = $request->bearerToken();
        if(!$token){
            return response()->json(['message' => 'Token not found'], 401);
        }
        $user = Auth::user();
        dd($user);

        if(!$user){
            return response()->json(['message' => 'User not found'], 401);
        }
        dd($user);
        return $next($request);

    }
}
