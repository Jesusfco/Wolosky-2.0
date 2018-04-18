<?php

namespace Wolosky\Http\Controllers;
use Wolosky\Cash;
use Wolosky\Receipt;
use Wolosky\Sale;
use Wolosky\User;

use Illuminate\Http\Request;

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

    public function cutout(){
        $date = $this->today();
        
        $sales = Sale::where('created_at', 'LIKE', $date . "%")
                        ->orderBy('created_at', 'DESC')
                        ->get();

        $receipts = Receipt::where('created_at', 'LIKE', $date . "%")
                            ->orderBy('created_at', 'DESC')
                            ->get();         
        $users = User::where('user_type_id', 1)->get();


        //ASIGANAR NOMBRES A LOS RECIBOS
        for($x = 0; $x < count($receipts); $x++){
            for($y = 0; $y < count($users); $y++){                
                if($receipts[$x]->user_id == $users[$y]->id ){
                    $receipts[$x]->user_name = $users[$y]->name;
                    break;
                }            
            }
        }          

        $amount1 = 0;
        $amount2 = 0;
        
        foreach($sales as $s){
            $amount1 += $s->total;
        }

        foreach($receipts as $r){
            $amount2 += $r->amount;
        }

        return response()->json([
            'recibos' => $receipts,
            'receipts' => $amount2, 
            'inventory' => $amount1
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
