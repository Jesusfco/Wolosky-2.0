<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Expense;
use Wolosky\Cash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ExpensesController extends Controller
{
    public function __construct(){ $this->middleware('adminCashier');}

    public function get(Request $request){
        
        $receipts = Expense::where([
                                ['created_at', '>', $request->from . " 00:00:00"],
                                ['created_at', '<', $request->to . " 00:00:00"],                                    
                            ])->orderBy('created_at', 'DESC')
                            ->paginate($request->items);               

        return response()->json($receipts);                                
                
    }

    public function create(Request $request) {
        
        $creator = JWTAuth::parseToken()->authenticate();

        $expense = new Expense();
        $expense->creator_id = $creator->id;
        $expense->name = $request->name;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->save();

        return response()->json($expense);

    }

    public function show($id) {
        return response()->json(Expense::find($id));        
    }

    public function update(Request $request) {

        $expense = Expense::find($request->id);
        $expense->name = $request->name;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->save();

        return response()->json($expense);

    }

    public function delete($id) { 

        $expense = Expense::find($id);
        $expense->delete();
        return response()->json(true);

    }

}
