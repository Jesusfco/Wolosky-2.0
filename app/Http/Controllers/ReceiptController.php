<?php

namespace Wolosky\Http\Controllers;

use Carbon\Carbon;
// use Illuminate\Database\Eloquent\Builder;
// use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Wolosky\Receipt;
use Wolosky\User;
use Wolosky\MonthlyPayment;
use Wolosky\Cash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Wolosky\CashboxHistory;

class ReceiptController extends Controller
{   
    public function __construct(){ 
        $this->middleware('adminCashier');
        $this->middleware('admin', ['only' => ['update', 'delete']]); 
    }
        
    public function get(Request $re){
        
        $receipts = Receipt::where([                                    
                            ['created_at', '>', $re->from . " 00:00:00"],
                            ['created_at', '<', $re->to . " 23:59:59"],                                    
                        ])->orderBy('created_at', 'DESC')
                        ->with(['user:id,name', 'creator:id,name', 'event:id,name']);

        if($re->name != NULL)
            $receipts = $receipts->whereHas('user', function ($query) use ($re) {
                $query->where('name', 'LIKE', "%$re->name%");
            });

        $receipts = $receipts->paginate($re->items);
            
        return response()->json($receipts);                                
                
    }

    public function getDebtorsAnalisis(Request $re){        
        
        $pendUsers = User::where([
                    ['user_type_id','=', 1], 
                    ['status','=', 1]
                ])->with(['monthly_payment', 'receipts' => function($query) use ($re) {
                    $query->where('type',  1)->orderBy('created_at', 'DESC');                    
                }])->whereDoesntHave('receipts', function($query) use ($re){                    
                    $query->where([
                        ['type',  1],                                
                        ['year', '=', $re->year],
                        ['month',  '=',$re->month],
                    ]);        
                })->orderBy('name', 'ASC')
                ->select('id', 'user_type_id', 'name', 'birthday', 'monthly_payment_id')
                ->get();

        $regularUsers = User::where([
            ['user_type_id','=', 1], 
            ['status','=', 1]
        ])->with(['monthly_payment', 'receipts' => function($query) use ($re) {
            $query->where([
                ['type',  1],                                
                ['year', '=', $re->year],
                ['month',  '=',$re->month],
            ]);   
        }])->whereHas('receipts', function($query) use ($re){                    
            $query->where([
                ['type',  1],                                
                ['year', '=', $re->year],
                ['month',  '=',$re->month],
            ]);        
        })->orderBy('name', 'ASC')
        ->select('id', 'user_type_id', 'name', 'birthday', 'monthly_payment_id')
        ->get();

        
        return response()->json([            
            'pendUsers' => $pendUsers,
            'regularUsers' => $regularUsers,
            ]);

    }

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
        $receipt->description = $request->description;                    
                
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
        
        $receipt = Receipt::find($id);

        if($receipt != NULL) {

            $history = CashboxHistory::latest()->first();
        
            if(Carbon::parse($receipt->created_at)->gte(Carbon::parse($history->created_at)) &&
                $receipt->payment_type == 0){ 

                Cash::substract($receipt->amount);

            }
        }

        $receipt->delete();

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
