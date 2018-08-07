<?php

namespace Wolosky\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class adminCashierMiddleware
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
        }else if(! Auth::user()->status == 1) {
            return response()->json(['message' => 'User disable'], 403);
        }else if(Auth::user()->user_type_id >= 3 ) {
            return $next($request);
        }
        return response()->json(['message' => 'User dont have credentials'], 402);
    }
}
