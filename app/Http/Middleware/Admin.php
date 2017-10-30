<?php

namespace Wolosky\Http\Middleware;

use Closure;

class Admin
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
        if(! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['message' => 'User not found'], 404);
        }else if(! Auth::user()->active == 1) {
            return response()->json(['message' => 'User disable'], 403);
        }else if(Auth::user()->type >= 5) {
            return $next($request);
        }
        return response()->json(['message' => 'User dont have credentials'], 402);
    }
}
