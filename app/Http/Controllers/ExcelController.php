<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Schedule;
use Wolosky\Receipt;
use Wolosky\Record;
use Wolosky\Sales;
use Wolosky\SaleDebt;
use Wolosky\Product;
use Wolosky\MonthlyPayment;
use Wolosky\Expense;
use Wolosky\Event;
use Wolosky\Util\DaySchedule;
use Illuminate\Support\Facades\DB;
use Excel;
use Carbon;

class ExcelController extends Controller
{

    public function __construct(){ 
        $this->middleware('adminCashier'); 
        // Please add the code before your file download code

        ob_end_clean();
        ob_start();
    }    

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
                $users->whereIn('user_type_id', [1,5,6]);
            else if(!$re->typeT && !$re->typeO)  
                $users->where('user_type_id', 1);
        } else {
            
            if($re->typeT && !$re->typeO)                 
                $users->whereIn('user_type_id', [2,3,4]);            
            else if(!$re->typeT && $re->typeO) 
                $users->whereIn('user_type_id', [5,6]);                    
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

        if($re->age1 != NULL && $re->age2 != NULL) {

            $from = Carbon::now();
            $to = ($from->year - $re->age1)."-$from->month-$from->day";
            $from = ($from->year - ($re->age2+1))."-$from->month-$from->day";                
            $users->whereBetween('birthday', [$from, $to ]);
        }

        if($re->hours1 != NULL && $re->hours2 != NULL)             
            $users->with('schedules');                

        $users =  $users->orderBy('status', 'ASC')->orderBy('name', 'ASC')->get();        
        
        if($re->hours1 != NULL && $re->hours2 != NULL)  {

            for($i=0; $i < count($users); $i++) 
                $users[$i]->setHours();                                                                    

            $users2 = [];

            foreach($users as $us) {                

                if($us->hours >= $re->hours1 && $us->hours <= $re->hours2) {
                    $users2[] = $us;
                }
            }

            $users = $users2;
            
        }

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

    private function organizeSchedulePerHour($data){
        for($i = 0; $i < count($data); $i++){

            $data[$i]['users'] = [];                
            
            foreach($data[$i]['schedules'] as $sche){                    

                foreach($sche['users'] as $user){
                    
                    $unique = true;
                    foreach($data[$i]['users'] as $u)
                        if($u['user_id'] == $user['user_id']) 
                            $unique = false;

                    if($unique)
                        $data[$i]['users'][] = $user;

                }
            }
        }
        return $data;
    }

    private function getSpecialArray($data) {
        $array = [];

        //Encontrar el valor maximo
        $max = 0;
        $counter = [];
        foreach($data as $d) {
            $count = count($d['users']);
            if($count > $max) $max = $count;            
            $counter[] = $count;
        }

        
        for($i = 0; $i < $max; $i++) {
            
            $element = [];

            if(isset($data[0]['users'][$i])) $element[] = $data[0]['users'][$i];
            else $element[] = NULL;

            if(isset($data[1]['users'][$i])) $element[] = $data[1]['users'][$i];
            else $element[] = NULL;

            if(isset($data[2]['users'][$i])) $element[] = $data[2]['users'][$i];
            else $element[] = NULL;

            if(isset($data[3]['users'][$i])) $element[] = $data[3]['users'][$i];
            else $element[] = NULL;

            if(isset($data[4]['users'][$i])) $element[] = $data[4]['users'][$i];
            else $element[] = NULL;

            if(isset($data[5]['users'][$i])) $element[] = $data[5]['users'][$i];
            else $element[] = NULL;

            $array[] = $element;
        }

        return $array;
    }

    public function schedules(Request $re) {

        $data = json_decode($re->data, TRUE);  
        
        if($re->from != NULL && $re->to != NULL) {
            
            $data = $this->organizeSchedulePerHour($data);
            $names = $this->getSpecialArray($data);
            // return $names;
            $send = ['data' => $data, 'from' => $re->from, 'to' => $re->to, 'names' => $names];

            Excel::create('Horarios', function($excel) use ($send){

                $excel->sheet('Horarios', function($sheet) use ($send){
    
                    $sheet->loadView('excel/schedulesFromTo')->with(['data' => $send]);
    
                });
    
            })->export('xls');

            return;

        }

        Excel::create('Horarios', function($excel) use ($data){

            $excel->sheet('Horarios', function($sheet) use ($data){

                $sheet->loadView('excel/schedules')->with(['data' => $data]);

            });

        })->export('xls');


       


    }

    public function receipt(Request $request){

        $receipts = Receipt::where([
                        ['created_at', '>', $request->from . " 00:00:00"],
                        ['created_at', '<', $request->to . " 00:00:00"],
                        ['user_id', 'LIKE', "%" . $request->id],
                        ])->with(['creator', 'user'])->orderBy('created_at', 'DESC')->get();                                   

        Excel::create('Recibos_'. $request->from . "_" . $request->to, function($excel) use ($receipts){
            $excel->sheet('hoja 1', function($sheet) use ($receipts){

                $sheet->loadView('excel/receipt')->with(['receipt' => $receipts]);

            });
        })->export('xls');

    }

    public function monthlyDebtor(Request $re) {

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

        $array = ['debtors' => $pendUsers, 'regular' => $regularUsers ];
        Excel::create('Mensualidades Pendientes_ Mes'. $re->month . "_Año" . $re->year, function($excel) use ($array){
            $excel->sheet('Alumnos Pendientes', function($sheet) use ($array) {
                $sheet->loadView('excel/monthlyDebtor1')->with(['users' => $array[ 'debtors']]);
            });
            $excel->sheet('Alumnos Regulares', function($sheet) use ($array) {
                $sheet->loadView('excel/monthlyDebtor2')->with(['users' => $array ['regular']]);
            });
        })->export('xls');
    }

    public function records(Request $re) {
        
        $records = Record::whereBetween('date', [$re->from, $re->to])
        ->orderBy('date', 'DESC')->whereHas('user', function ($query) use ($re) {

            $query->where('name', 'LIKE', "%$re->name%");

            if($re->type == 1) //TRABAJADORES
                $query->whereBetween('user_type_id', [2,4]);

            if($re->type == 2) //GIMNASTAS
                $query->where('user_type_id', 1);

        })->with(['user:name,id,user_type_id,status'])->get();

        Excel::create('Asistencias_'. $re->from . "_" . $re->to, function($excel) use ($records){
            $excel->sheet('hoja1', function($sheet) use ($records){
                $sheet->loadView('excel/records')->with(['records' => $records]);
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
                        ->orderBy('created_at', 'DESC')->with('description')
                        ->get();
        else {
            $sales = DB::table('sale')
                        ->where('created_at', 'LIKE', $request->from . "%")
                        ->orderBy('created_at', 'DESC')->with('description')
                        ->get();
        } 

        

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
    
    public function participantsEvent($id) {
        $event = Event::where('id', $id)->with('participants.user')->first();

        if($event == NULL) return 'Evento Inexistente';

        Excel::create('Participantes-Evento-' . $event->name , function($excel) use ($event){

            $excel->sheet('hoja 1', function($sheet) use ($event){

                $sheet->loadView('excel/participants')->with(['event' => $event]);

            });

        })->export('xls');


    }

    public function participantsInf($id) {
        $event = Event::where('id', $id)->with('participants.user')->first();

        if($event == NULL) return 'Evento Inexistente';

        $receipts = Receipt::where('event_id', $id)->get();

        for($y=0; $y < count($event->participants); $y++) {
            
            $event->participants[$y]->missing = 0;
            
            foreach($receipts as $re) {

                if($event->participants[$y]->user_id == $re->user_id) 
                    $event->participants[$y]->missing += $re->amount;
                
            }

        }

        
        Excel::create('Participantes-Evento-' . $event->name , function($excel) use ($event){

            $excel->sheet('hoja 1', function($sheet) use ($event){

                $sheet->loadView('excel/participantsInf')->with(['event' => $event]);

            });

        })->export('xls');
               
    }

    public function eventReceipts($id) {
        $event = Event::find($id);
        $receipts = Receipt::where('event_id', $id)->with(['user', 'creator'])->orderBy('id', 'DESC')->get();

        $object = [];
        $object['event'] = $event;
        $object['receipts'] = $receipts;

        Excel::create('Recibos-Evento-' . $event->name , function($excel) use ($object){

            $excel->sheet('hoja 1', function($sheet) use ($object){

                $sheet->loadView('excel/receiptsEvent')->with(['object' => $object]);

            });

        })->export('xls');
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
