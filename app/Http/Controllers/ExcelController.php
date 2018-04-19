<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Receipt;
use Wolosky\Sales;
use Wolosky\Product;
use Wolosky\MonthlyPayment;
use Excel;
// use Maatwebsite\Excel\Concerns\FromCollection;
// use Maatwebsite\Excel\Excel;

class ExcelController extends Controller
{
    

    public function receipt(Request $request){

        $receipts = Receipt::where([
                        ['created_at', '>', $request->from . " 00:00:00"],
                        ['created_at', '<', $request->to . " 00:00:00"],
                        ['user_id', 'LIKE', "%" . $request->id],
                        ])->orderBy('created_at', 'DESC')->get();
        
        $users =  User::where([                                
                        ['user_type_id', '=', 1],
                    ])->get();

        $creators =  User::where([                                
                        ['user_type_id', '>', 2],
                    ])->get();                    

        for($x = 0; $x < count($receipts); $x++){

            for($y = 0; $y < count($users); $y++){

                if($receipts[$x]->user_id == $users[$y]->id ){
                $receipts[$x]->user_id = $users[$y]->name;
                break;
                }            
            }
        }                     

        //Coloca nombres de a quiebnes pertenecen los recibos
        for($x = 0; $x < count($receipts); $x++){

            for($y = 0; $y < count($users); $y++){

                if($receipts[$x]->user_id == $users[$y]->id ){
                $receipts[$x]->user_id = $users[$y]->name;
                break;
                }            
            }
        } 
        
        for($x = 0; $x < count($receipts); $x++){

            for($y = 0; $y < count($creators); $y++){

                if($receipts[$x]->creator_id == $creators[$y]->id ){
                $receipts[$x]->creator_id = $creators[$y]->name;
                break;
                }            
            }
        } 

        Excel::create('Recibos_'. $request->from . "_" . $request->to, function($excel) use ($receipts){
            $excel->sheet('hoja 1', function($sheet) use ($receipts){

                $sheet->fromArray($receipts);

            });
        })->export('xls');

    }
}
