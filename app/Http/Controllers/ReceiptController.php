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
    public function __construct(){ 
        $this->middleware('adminCashier');
        $this->middleware('admin', ['only' => ['update', 'delete']]); 
    }
        
    public function get(Request $re){
        
        $receipts = Receipt::where([

                                    // ['created_at', '<', $this->nextMonth()],
                                    // ['created_at', '>', $this->thisMonth()],
                                    ['created_at', '>', $re->from . " 00:00:00"],
                                    ['created_at', '<', $re->to . " 23:59:59"],
                                    // ['user_id', 'LIKE', "%" . $re->id],
                                ])->orderBy('created_at', 'DESC')->with(['user:id,name', 'creator:id,name'])
                                ->paginate($re->items)
                                ;
            // $receipts->enableQueryLog();
        return response()->json($receipts);                                
                
    }

    public function getAnalisis(){

        $notificacionCount = 0;
        $notificactionUser = Array();

        $user = User::where(['user_type_id' => 1, 'status' => 1])->get();
        $receipts =  Receipt::where([
                                ['created_at', '<', $this->nextMonth()],
                                ['created_at', '>', $this->thisMonth()],
                                ['type', '=', 1]
                            ])->get();

        $montly = MonthlyPayment::where('amount', 0)->get();
        
        for($x = 0; count($user) > $x; $x++){
            
            $user[$x]->receipt = false;            

            for($y = 0; count($receipts) > $y; $y++){

                if($receipts[$y]->user_id == $user[$x]->id){

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
    
    public function create(Request $request){
        $creator = JWTAuth::parseToken()->authenticate();

        $receipt = new Receipt();
        $receipt->type = $request->type;
        $receipt->user_id =  $request->user_id;
        $receipt->creator_id = $creator->id;
        // $receipt->date = date('Y') . '/'. date('m') . '/01';
        $receipt->amount = $request->amount;
        
        if($receipt->type == 1) {
            $receipt->amount = $request->monthlyAmount;
        }

        $receipt->year = $request->year;
        $receipt->payment_type = $request->payment_type;
        
        
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

        $receipt = Receipt::where('id', $id)->with(['user:id,name', 'creator:id,name', 'event'])->first();        

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
            ['user_id', $request->user_id],
            ['year', $request->year],
            ['month', $request->month],
            ['type', 1],
            ])->get();

            // return response()->json($receipt);

        if(isset($receipt[0])) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
