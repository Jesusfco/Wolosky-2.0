<?php

namespace Wolosky\Http\Controllers\App;

use Wolosky\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wolosky\Cash;
use Wolosky\CashboxHistory;
use Wolosky\Receipt;
use Wolosky\Expense;
use JWTAuth;

class CashController extends Controller
{
    public function __construct(){ $this->middleware('admin'); }

    public function update(Request $request)
    {
        $cash = Cash::find(1);

        $history = new CashboxHistory();
        $history->creator_id = JWTAuth::parseToken()->authenticate()->id;
        $history->amount = $cash->amount;
        $history->allow = $request->cash;
        $history->cashbox_id = 1;
        $history->save();

        $cash->amount = $request->cash;
        $cash->save();

        return response()->json([
            'cash' => $cash,
            'history' => $history
        ]);
    }

    public function cutout()
    {                 

        $history = CashboxHistory::latest()->with('creator')->first();
        if($history == NULL) return response()->json(false);

        $from = $history->created_at;

        $receipts = Receipt::where([
                ['created_at', '>', $from],
                ['payment_type', 0]
            ])->orderBy('created_at', 'DESC')->with('user:id,name')->get();                 

        $expenses = Expense::where([
                        ['created_at', '>', $from],                
                        ['from_cashbox', true],                
                    ])->orderBy('created_at', 'DESC')->with('creator:id,name')
                    ->get();        

        $totalReceipt = 0;
        $totalExpense = 0;
        
        foreach($receipts as $r) {            
            $totalReceipt += $r->amount;
        }

        foreach($expenses as $r) {         
            $totalExpense += $r->amount;
        }

        return response()->json([
            'receipts' => $receipts,
            'receipts_total' => $totalReceipt, 
            'expenses' => $expenses,
            'expenses_total' => $totalExpense,
            'last_cut' => $history
            ]);
    }

}
