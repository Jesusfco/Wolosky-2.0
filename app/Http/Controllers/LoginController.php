<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Cash;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
//use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginController extends Controller
{
    public function signin(Request $request)
    {        

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json([
                    'error' => 'Credenciales Invalidas'
                ], 401);
            }
        } catch (JWTException $e) {
            return response()->json([
                'error' => 'Could not create token!'
            ], 500);
        }        

        $user = Auth::user();
        $user->fingerprint = NULL;
        
        return response()->json([

            'token' => $token,
            'user' => $user,
            'cash' => Cash::find(1)->amount,

        ],200);
    }

    public function checkAuth(){

        $this->middleware('user1');

        $user = JWTAuth::parseToken()->authenticate();
        $user->fingerprint = NULL;
        
        return response()->json([
            'user' => $user,
            'cash' => Cash::find(1)->amount,
        ]);

    }
}
