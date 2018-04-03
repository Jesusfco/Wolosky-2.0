<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Receipt;
use Wolosky\User;
use Wolosky\MonthlyPayment;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReceiptController extends Controller
{   
    public function __construct(){ $this->middleware('adminCashier');}
        
    public function get(Request $request){
        
        $receipts = Receipt::where([
                                    ['created_at', '>', $request->from . " 00:00:00"],
                                    ['created_at', '<', $request->to . " 00:00:00"],
                                    ['user_id', 'LIKE', "%" . $request->id],
                                ])->get();

        $users =  User::where([                                
                                ['user_type_id', '=', 1],
                            ])->get();

        for($x = 0; $x < count($receipts); $x++){

            for($y = 0; $y < count($users); $y++){
                
                if($receipts[$x]->user_id == $users[$y]->id ){
                    $receipts[$x]->user_name = $users[$y]->name;
                    break;
                }            
            }
        }    

        return response()->json($receipts);                                
                
    }

    public function getAnalisis(){

        $notificacionCount = 0;
        $notificactionUser = Array();

        $user = User::where(['user_type_id' => 1, 'status' => 1])->get();
        $receipments =  Receipt::where([
                                ['created_at', '<', $this->nextMonth()],
                                ['created_at', '>', $this->thisMonth()],
                                ['type', '=', 1]
                            ])->get();
        
        for($x = 0; count($user) > $x; $x++){
            
            $user[$x]->receipt = false;

            for($y = 0; count($receipments) > $y; $y++){

                if($receipments[$y]->user_id == $user[$x]->id){

                    $user[$x]->receipt = true;
                    
                    break;

                }                                

            }

            if($user[$x]->receipt == false){
                $notificacionCount++;

                $us = new User();
                $us->id = $user[$x]->id;
                $us->name = $user[$x]->name;

                $notificactionUser[] = $us;
            }
        }

        return response()->json([
            'count' => $notificacionCount, 
            'users' => $notificactionUser
            ]);

    }//Final de fucntion

    public function sugestUser(Request $request){
        $users = User::where([
            ['name', 'LIKE', '%' . $request->search . '%'],
            ['user_type_id', '=', 1]
        ])->select('name', 'id')->get();

        return response()->json($users);
    }

    public function getMonthlyPayment(Request $request){
        $user = User::find($request->id);
        $monthly = MonthlyPayment::find($user->monthly_payment_id);
        return response()->json(['amount' => $monthly->amount, 'user' => $user]);
    } 
    
    public function create(Request $request){
        $creator = JWTAuth::parseToken()->authenticate();

        $receipt = new Receipt();
        $receipt->type = $request->type;
        $receipt->user_id =  $request->userId;
        $receipt->creator_id = $creator->id;
        $receipt->date = date('Y') . '/'. date('m') . '/01';
        
        if($request->type == 1){
            $receipt->amount = $request->monthlyAmount;
            $receipt->month = $request->month;
        }

        else if($request->type == 2){
            $receipt->amount = $request->amount;            
        }

        else if($request->type == 3){
            $receipt->amount = $request->amount;
            $receipt->days = $request->days;            
        }

        $receipt->save();

        return response()->json($receipt);

    }

    public function nextMonth(){
        return date('Y') . '-'. ( 1 + date('m')) . '-00 00:00:00';
    }

    public function thisMonth(){
        return date('Y') . '-'. date('m') . '-00 00:00:00';
    }

}
