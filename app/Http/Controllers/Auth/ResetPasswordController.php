<?php

namespace Wolosky\Http\Controllers\Auth;

use Wolosky\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Wolosky\User;
use Wolosky\Reset;
use Wolosky\Mail\ResetMail;
use Mail;
use Illuminate\Http\Request;


class ResetPasswordController extends Controller
{
   public function reset(Request $re) {

        $user = User::where('email', 'LIKE', $re->email)->first();

       if($user == NULL) {
           return response()->json(false);           
       }

       $this->deleteTokenWithEmail($re->email);
       $token = New Reset();       
       $token->save2($user->email);

       $data = [];
       $data['user'] = $user;
       $data['token'] = $token;

       Mail::send(new ResetMail($data));

       return response()->json(true);

   }

   private function deleteTokenWithEmail($email) {
    Reset::where('email', 'LIKE', $email)->delete();
   }

   public function checkToken(Request $re) {
        $t = Reset::find($re->token);
        if($t == NULL) return response()->json(false);

        return response()->json(true);
   }

   public function changePassword(Request $re) {

        $t = Reset::find($re->token);

        if($t == NULL) return response()->json(false);

        $this->deleteTokenWithEmail($t->email);

        $user = User::where('email', 'LIKE', $t->email)->first();        
        $user->password = bcrypt($re->password);
        $user->save();
        
        return response()->json(true);
    }
}