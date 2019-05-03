<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Sale;
use Wolosky\SaleDescription;
use Wolosky\SaleDebt;

class DebtorsController extends Controller
{

    public function __construct(){ 
        $this->middleware('adminCashier'); 
        $this->middleware('admin', ['only' => ['update', 'delete']]); 
    }

    public function get(Request $request) {

        $debts = SaleDebt::where([
                            ['created_at', '>', $request->from . " 00:00:00"],
                            ['created_at', '<', $request->to . " 00:00:00"],
                            ['user_id', 'LIKE', "%" . $request->id],
                        ])->orderBy('created_at', 'DESC')
                        ->with(['sale.description', 'user'])
                        ->paginate($request->items);

        return response()->json($debts);    

    }

    public function sugestUser(Request $request) {

        $users = User::where([
                        ['name', 'LIKE', '%' . $request->search . '%'],            
                    ])->select('name', 'id')->get();

        return response()->json($users);

    }

    public function update(Request $request){
        $debt = SaleDebt::find($request->id);
        $sale = Sale::find($debt->sale_id);
        
        if($debt->status == true){
            
            $debt->status = false;
            $debt->save();
            
            Receipt::where('sale_id', $sale->id)->delete();            

        } else {

            $debt->status = true;
            $debt->save();
            
            $receipt = new Receipt();
            $receipt->user_id = $debt->user_id;
            $receipt->sale_id = $debt->sale_id;
            $receipt->amount = $sale->getTotal();
            $receipt->payment_type = 1;
            $receipt->save();                        

        }

        return response()->json($debt);

    }

    public function delete(Request $request) {

        $debt = SaleDebt::find($request->id);        
        $debt->delete();
        
        return response()->json(true);

    }
}
