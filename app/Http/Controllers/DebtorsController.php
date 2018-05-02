<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Sale;
use Wolosky\SaleDescription;
use Wolosky\SaleDebt;

class DebtorsController extends Controller
{
    public function get(Request $request) {

        $debts = SaleDebt::where([
                            ['created_at', '>', $request->from . " 00:00:00"],
                            ['created_at', '<', $request->to . " 00:00:00"],
                            ['user_id', 'LIKE', "%" . $request->id],
                        ])->orderBy('created_at', 'DESC')
                        ->paginate($request->items);

        $users =  User::all();

        for($x = 0; $x < count($debts); $x++){

            for($y = 0; $y < count($users); $y++){
                
                if($debts[$x]->user_id == $users[$y]->id ){
                    $debts[$x]->user_name = $users[$y]->name;
                    break;
                }            
            }
        }    

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
            
            $sale->total = $debt->total;
            $sale->save();

            return response()->json($debt);

        } else {

            $debt->status = true;
            $debt->save();
            
            $sale->total = 0;
            $sale->save();

            return response()->json($debt);

        }

    }

    public function delete(Request $request) {

        $debt = SaleDebt::find($request->id);
        $sale = Sale::find($debt->sale_id);
        SaleDescription::where('sale_id', $sale->id)->delete();
        $sale->delete();
        $debt->delete();
        
        return response()->json(true);

    }
}
