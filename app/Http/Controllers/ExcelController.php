<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Receipt;
use Wolosky\Sales;
use Wolosky\SaleDebt;
use Wolosky\Product;
use Wolosky\MonthlyPayment;
use Wolosky\Expense;
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
            if($receipts[$x]->type == 1)
                $receipts[$x]->type = "MENSUALIDAD";
            else if ($receipts[$x]->type == 2)
                $receipts[$x]->type = "INSCRIPCION";
            else if($receipts[$x]->type == 3)
                $receipts[$x]->type = "DIAS";
            else if($receipts[$x]->type == 4)
                $receipts[$x]->type = "UNIFORME";   
            else if($receipts[$x]->type == 5)
                $receipts[$x]->type = "EVENTO";   

            for($y = 0; $y < count($creators); $y++){

                if($receipts[$x]->creator_id == $creators[$y]->id ){
                $receipts[$x]->creator_id = $creators[$y]->name;
                break;
                }            
            }
        } 

        Excel::create('Recibos_'. $request->from . "_" . $request->to, function($excel) use ($receipts){
            $excel->sheet('hoja 1', function($sheet) use ($receipts){

                $sheet->loadView('excel/receipt')->with(['receipt' => $receipts]);

            });
        })->export('xls');

    }

    public function expenses(Request $request){

        $expenses = Expense::where([
                        ['created_at', '>', $request->from . " 00:00:00"],
                        ['created_at', '<', $request->to . " 00:00:00"]
                        
                        ])->orderBy('created_at', 'DESC')->get();
                
        $users =  User::where([                                
                        ['user_type_id', '>', 2],
                    ])->get();                    

        for($x = 0; $x < count($expenses); $x++){

            for($y = 0; $y < count($users); $y++){

                if($expenses[$x]->creator_id == $users[$y]->id ){
                $expenses[$x]->creator_id = $users[$y]->name;
                break;
                }            
            }
        }                                         

        Excel::create('Gastos_'. $request->from . "_" . $request->to, function($excel) use ($expenses){
            $excel->sheet('hoja 1', function($sheet) use ($expenses){

                $sheet->loadView('excel/expenses')->with(['expenses' => $expenses]);

            });
        })->export('xls');

    }

    public function debtors(Request $request) {

        $debts = SaleDebt::where([
                                ['created_at', '>', $request->from . " 00:00:00"],
                                ['created_at', '<', $request->to . " 00:00:00"],
                                ['user_id', 'LIKE', "%" . $request->id]
                            ])->orderBy('created_at', 'DESC')->get();
    
            $users = User::all();                   

            for($x = 0; $x < count($debts); $x++){

                for($y = 0; $y < count($users); $y++){

                    if($debts[$x]->user_id == $users[$y]->id ){
                    $debts[$x]->user_name = $users[$y]->name;
                    break;
                    }            
                }
            }                                         

            Excel::create('Deudores_'. $request->from . "_" . $request->to, function($excel) use ($debts){
                $excel->sheet('hoja 1', function($sheet) use ($debts){

                    $sheet->loadView('excel/debtors')->with(['debts' => $debts]);

                });
            })->export('xls');
    }
}
