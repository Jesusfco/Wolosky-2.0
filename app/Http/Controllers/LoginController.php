<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Wolosky\CashboxHistory;
use Wolosky\Product;
use Wolosky\User;
use Wolosky\Cash;
use JWTAuth;
use Auth;

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
        
        if($user->status != 1) {
            return response()->json([
                'error' => 'Usuario inactivo'
            ], 401);
        }

        return response()->json([
            'token' => $token,
            'user' => $user,
            'cash' => Cash::find(1)->amount,
            'cash_history_last' => CashboxHistory::latest()->with('creator')->first(),
            'products' => Product::orderBy('name', 'ASC')->get()

        ],200);
    }

    public function checkAuth(){

        $this->middleware('user1');

        $user = JWTAuth::parseToken()->authenticate();        
        
        return response()->json([
            'user' => $user,
            'cash' => Cash::find(1)->amount,
            'cash_history_last' => CashboxHistory::latest()->with('creator')->first(),
            'products' => Product::orderBy('name', 'ASC')->get()
        ]);

    }
}
