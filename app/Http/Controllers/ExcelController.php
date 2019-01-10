<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Schedule;
use Wolosky\Receipt;
use Wolosky\Sales;
use Wolosky\SaleDebt;
use Wolosky\Product;
use Wolosky\MonthlyPayment;
use Wolosky\Expense;
use Wolosky\Util\DaySchedule;
use Illuminate\Support\Facades\DB;
use Excel;

class ExcelController extends Controller
{

    public function __construct(){ $this->middleware('adminCashier'); }    

    public function users(Request $re) {        

        $users = User::whereNotNull('id');

        if($re->typeA == "true") $re->typeA = true; else $re->typeA = false;
        if($re->typeT == "true") $re->typeT = true; else $re->typeT = false;
        if($re->typeO == "true") $re->typeO = true; else $re->typeO = false;
        if($re->genderM == "true") $re->genderM = true; else $re->genderM = false;
        if($re->genderF == "true") $re->genderF = true; else $re->genderF = false;
        if($re->active == "true") $re->active = true; else $re->active = false;
        if($re->inactive == "true") $re->inactive = true; else $re->inactive = false;

        if($re->typeA)  {            
            if($re->typeT && $re->typeO)                
                $users->whereIn('user_type_id', [1,2,3,4]);                                            
            else if(!$re->typeT && $re->typeO)  
                $users->whereIn('user_type_id', [1,5,6,7]);
            else if(!$re->typeT && !$re->typeO)  
                $users->where('user_type_id', 1);
        } else {
            
            if($re->typeT && !$re->typeO)                 
                $users->whereIn('user_type_id', [2,3,4]);            
            else if(!$re->typeT && $re->typeO) 
                $users->whereIn('user_type_id', [5,6,7]);
            else 
                return back();            
        }               
                    
        if($re->genderM && !$re->genderF){            
            $users->where('gender', 1);  
        } else if(!$re->genderM && $re->genderF) {            
            $users->where('gender', 2);  
        }

        if($re->active && !$re->inactive) 
            $users->where('status', 1);  
        else if(!$re->active && $re->inactive)
            $users->where('status', 2);  

        $users =  $users->orderBy('status', 'ASC')->orderBy('name', 'ASC')->get();        

        Excel::create('Usuarios', function($excel) use ($users){

            $excel->sheet('Ventas', function($sheet) use ($users){

                $sheet->loadView('excel/users')->with(['users' => $users]);

            });           

        })->export('xls');
    }

    public function organizeSchedulePerDay($schedules, $users) {
        $dayScheduleArray = $this->generateScheduleArray();

        for($i = 0; $i < count($dayScheduleArray); $i++) {

            foreach($schedules as $s) {
      
                if(!isset($s->day_id)) continue;
                if($s->day_id != $dayScheduleArray[$i]->day) continue;
      
                
                $check_in = explode(':', $s->check_in);
                $check_out = explode(':', $s->check_out);
        
                $horario = [
                    'check_in' => (int)$check_in[0],
                    'check_out' => (int)$check_out[0],
                ];                
        
                //Asignamos horarios en los que se asiste de acuerdo a los horarios obtenidos AGRUPACION
                        
                $arrayPosibleHorario = [];
        
                for($y = 0; ($y + $horario['check_in']) < $horario['check_out']; $y++ ) { 
        
                    $arrayPosibleHorario[] = ($y + $horario['check_in']);
        
                } 
        
                for($y = 0; $y < count($arrayPosibleHorario); $y++) {
                    
                    $verified = true;
      
                    foreach($dayScheduleArray[$i]->schedules as $object) {
        
                        if($object['check_in'] == $arrayPosibleHorario[$y]) {
        
                            $verified = false;
            
                        }  
                    }                          
                
                if($verified) {
              
                    $ho = [
                        'check_in' => $arrayPosibleHorario[$y],
                        'users' => []
                    ];
                    
                  
        
                    $dayScheduleArray[$i]->schedules[] = $ho;
        
                }
      
              }
      
              
      
              
      
            }
      
          }
      
        //   this.setNameVisualSchedule();
        //   this.sortDataOrder();
      
        return $dayScheduleArray;
    }

    public function schedules(Request $re) {

        $data = json_decode($re->data, TRUE);            

        Excel::create('Horarios', function($excel) use ($data){

            $excel->sheet('Horarios', function($sheet) use ($data){

                $sheet->loadView('excel/schedules')->with(['data' => $data]);

            });

        })->export('xls');


        return view('excel.schedules', [
            'data' => $data
        ]);

        if($re->type == 1) {

            $users = User::where([
                ['user_type_id', 1],
                ['status', 1],
                ])->select('id', 'name', 'user_type_id')
                ->orderBy('name', 'ASC')->get();

        } else {

            $users = User::where('status', 1)->whereBetween('user_type_id', [2,4])->select('id', 'name', 'user_type_id')
                ->get();

        }
        
        $schedules = Schedule::where('active', true)->get();

        for($i = 0; $i < count($schedules); $i++) {

            foreach($users as $u) {

                if($u->id == $schedules[$i]->user_id){
                    $schedules[$i]->verify = true;
                    break;
                }

            }

        }

        for($i = 0; $i < count($schedules); $i++) { 
            if(!isset($schedules[$i]->verify)) {
                $schedules[$i] = null;

                // unset($schedules[$i]);
            }
        }


        if($re->type == 1) 
            $tipo = 'ALUMNOS';
        else 
            $tipo = 'TRABAJADORES';

        $dataAnalisis = $this->organizeSchedulePerDay($schedules, $users);

        $i = 1;
        foreach($dayScheduleArray as $day){

            $day->
            $i++;
        }
        return $dataAnalisis;

        Excel::create('Horarios_'. $tipo, function($excel) use ($dataAnalisis){
            $excel->sheet('hoja 1', function($sheet) use ($dataAnalisis){

                $sheet->loadView('excel/schedules')->with(['dataAnalisis' => $dataAnalisis]);

            });
        })->export('xls');


    }

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

    public function getSales(Request $request) {


        if(isset($request->to))
        $sales = DB::table('sale')
                        ->whereBetween('created_at', [$request->from, $request->to . " 23:59:59"])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        else {
            $sales = DB::table('sale')
                        ->where('created_at', 'LIKE', $request->from . "%")
                        ->orderBy('created_at', 'DESC')
                        ->get();
        } 

        $sales = $this->pushDescription($sales);

        $users = User::where('user_type_id', '>', 2)->get();


        $productos = DB::table('product')->orderBy('name', 'ASC')->get();

        for($i = 0; $i < count($sales); $i++) {

            if($sales[$i]->type == 1) {
                $sales[$i]->type_name = "General";
            } else if($sales[$i]->type == 2) {
                $sales[$i]->type_name = "Interno"; 
            } else if($sales[$i]->type == 3) {
                $sales[$i]->type_name = "Quincena"; 
            }

            foreach($users as $user) {

                if($sales[$i]->creator_id == $user->id) {
                    $sales[$i]->user_name = $user->name;
                    
                    break;
                }

            }

            for($x = 0 ; $x < count($sales[$i]->description); $x++){
                
                foreach($productos as $pro) {
                    if($pro->id == $sales[$i]->description[$x]->product_id) {
                        $sales[$i]->description[$x]->product_name = $pro->name;
                        break;
                    }
                }
            }
        }

        Excel::create('VENTAS', function($excel) use ($sales){

            $excel->sheet('Ventas', function($sheet) use ($sales){

                $sheet->loadView('excel/sales')->with(['sales' => $sales]);

            });

            $excel->sheet('DescripcionDeVentas', function($sheet) use ($sales){

                $sheet->loadView('excel/salesDescription')->with(['sales' => $sales]);

            });

        })->export('xls');

    }

    public function pushDescription($sales){
        $z = count($sales);
        
        $description = DB::table('sale_description')
                                    ->whereBetween('sale_id', [$sales[$z-1]->id, $sales[0]->id])                                    
                                    ->get();
        
        for($x = 0; $x < count($sales); $x++){
            $sales[$x]->description = [];
            foreach($description as $desc){

                if( $sales[$x]->id == $desc->sale_id){
                    $sales[$x]->description[] = $desc;
                }

            }
        }

        return $sales;
    }

    public function getInventory(Request $request) {
        
        
        $products = Product::orderBy('name', 'ASC')->get();

        Excel::create('Inventario', function($excel) use ($products){

            $excel->sheet('inventario', function($sheet) use ($products){

                $sheet->loadView('excel/inventory')->with(['products' => $products]);

            });

        })->export('xls');


        return view('excel.inventory', [
            'products' => $products
        ]);
    }
    
    public function generateScheduleArray() {

        $array = [];

        for($i = 0; $i < 7 ;$i++) {

            $x = new DaySchedule();
            $x->day = $i + 1;
            $array[] = $x;

        }

        return $array;

    }

}
