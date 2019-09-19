<?php

namespace Wolosky\Http\Controllers\App;

use Wolosky\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Wolosky\Cash;
use Wolosky\CashboxHistory;
use Wolosky\Receipt;
use Wolosky\Expense;

class CashController extends Controller
{
    public function __construct(){ $this->middleware('admin'); }

    public function update(Request $request)
    {
        $cash = Cash::find(1);
        $cash->amount = $request->cash;
        $cash->save();

        return response()->json($cash);
    }

    public function cutout()
    {                 

        $history = CashboxHistory::latest()->with('creator')->first();
        if($history == NULL) return response()->json(false);
            
        
        // return response()->json($history);
        $from = $history->created_at;
        $receipts = Receipt::where('created_at', '>', $from)
                            ->orderBy('created_at', 'DESC')
                            ->get();                 

        $expenses = Expense::where([
                                ['created_at', '>', $from],                
                            ])->orderBy('created_at', 'DESC')->with('creator')
                            ->get();        

        $totalReceipt = 0;
        $totalExpense = 0;
        
        foreach($receipts as $r){
            if(!$r->payment_type)
                $totalReceipt += $r->amount;
        }

        foreach($expenses as $r){
            if(!$r->payment_type)
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

    public function today(){
        $date = getdate()['year'] . '-';

        if(getdate()['mon'] < 10) 
            $date .= '0' . getdate()['mon'] . '-';
        else { $date .= getdate()['mon'] . '-'; } 

        if(getdate()['mday'] < 10 )
            $date .= '0' . getdate()['mday'];
        else { $date .= getdate()['mday']; }

        return $date;

    }
}
