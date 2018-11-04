<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Receipt;
use Wolosky\User;
use Wolosky\MonthlyPayment;
use Wolosky\Cash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ReceiptController extends Controller
{   
    public function __construct(){ $this->middleware('adminCashier');}
        
    public function get(Request $request){
        
        $receipts = Receipt::where([
                                    ['created_at', '>', $request->from . " 00:00:00"],
                                    ['created_at', '<', $request->to . " 00:00:00"],
                                    ['user_id', 'LIKE', "%" . $request->id],
                                ])->orderBy('created_at', 'DESC')->with(['user:id,name', 'creator:id,name'])
                                ->paginate($request->items);

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

        $montly = MonthlyPayment::where('amount', 0)->get();
        
        for($x = 0; count($user) > $x; $x++){
            
            $user[$x]->receipt = false;            

            for($y = 0; count($receipments) > $y; $y++){

                if($receipments[$y]->user_id == $user[$x]->id){

                    $user[$x]->receipt = true;
                    
                    break;

                }                                

            }

            if($user[$x]->receipt == false)
                foreach($montly as $w){
                    if($w->id == $user[$x]->monthly_payment_id){
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
            ['name', 'LIKE', "%$request->search%"],
            ['user_type_id', '=', 1]
        ])->select('name', 'id', 'monthly_payment_id')->with('monthly_payment')->limit(10)->get();

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
        $receipt->user_id =  $request->user_id;
        $receipt->creator_id = $creator->id;
        // $receipt->date = date('Y') . '/'. date('m') . '/01';
        $receipt->amount = $request->amount;
        $receipt->year = $request->year;
        $receipt->payment_type = $request->payment_type;
        
        $receipt->amount = $request->monthlyAmount;
        $receipt->month = $request->month;            
        $receipt->days = $request->days;                    
                
        if($request->payment_type == false){
            $cash = Cash::find(1);
            $cash->amount = $cash->amount + $receipt->amount;
            $cash->save();        
        }

        $receipt->save();

        $receipt->user = User::find($receipt->user_id);

        return response()->json($receipt);

    }

    public function update(Request $request) {

        $receipt = Receipt::find($request->id);
        $receipt->amount = $request->amount;
        $receipt->save();
        
        return response()->json($receipt);

    }

    public function delete($id){
        Receipt::find($id)->delete();
        return response()->json(true);
    }

    public function show($id){

        $receipt = Receipt::find($id);
        $receipt->user_id = User::find($receipt->user_id)->name;
        $receipt->creator_id = User::find($receipt->creator_id)->name;

        return response()->json($receipt);
    }
    
    public function nextMonth(){
        return date('Y') . '-'. ( 1 + date('m')) . '-00 00:00:00';
    }

    public function thisMonth(){
        return date('Y') . '-'. date('m') . '-00 00:00:00';
    }

    public function checkLastReceipt(Request $request) {
        $receipt = Receipt::where([
            ['user_id', '=', $request->user_id],
            ['year', $request->year],
            ['month', '=', $request->month],
            ])->get();

            // return response()->json($receipt);

        if(isset($receipt[0])) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
