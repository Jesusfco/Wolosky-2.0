<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\MonthlyPayment;
use Wolosky\User;
use Wolosky\Schedule;
use Wolosky\Salary;
use Wolosky\Payment;
use Wolosky\Reference;
use Wolosky\RecordUserStatus;
use Tymon\JWTAuth\Facades\JWTAuth;

class UsersController extends Controller
{
    public function __construct(){ $this->middleware('adminCashier'); }

    public function get(Request $request)
    {
        $creator = JWTAuth::parseToken()->authenticate();

        if($creator->user_type_id >= 6){
            
            $users = User::where('name', 'LIKE', '%'. $request->searchWord .'%')
                        ->select('id', 'name', 'phone', 'gender', 'user_type_id', 'status')
                        ->orderBy('name', 'ASC')
                        ->paginate($request->items);

        } else if($creator->user_type_id == 3){

            $users =  User::where([
                            ['name', 'LIKE', '%'. $request->searchWord .'%'],
                            ['user_type_id', '=', 1],
                            ])
                            ->select('id', 'name', 'phone', 'gender', 'user_type_id', 'status')
                            
                            ->orderBy('name', 'ASC')
                            // ->groupBy('status')
                            ->paginate($request->items);
        }

        return response()->json($users);
        
    }

    public function showUser($id){
        $user = User::find($id);
        $user->fingerprint = NULL;
        return response()->json($user);
    }

    public function searchUser(Request $request)
    {

    }

    public function createRecordStatus(){
        $user = User::all();
        for($x = 0; $x < count($user); $x++){
            $status = new RecordUserStatus();
            $status->user_id = $user[$x]->id;
            $status->creator_id = 3;
            $status->status = 1;
            $status->description = 'Usuario creado';
            $status->created_at = $user[$x]->created_at;
            $status->save();
        }

        return 'RECORDS CREATED';
    }

    public function create(Request $request){
        

        $creator = JWTAuth::parseToken()->authenticate();
        
        $newUser = $request->user;        

        $user = new User();

        $user->name = $newUser['name'];
        $user->email = $newUser['email'];
        $user->birthday = $newUser['birthday'];
        $user->gender = $newUser['gender'];
        $user->phone = $newUser['phone'];        
        $user->insurance = $newUser['insurance'];
        $user->curp = $newUser['curp'];
        $user->placeBirth = $newUser['placeBirth'];
        $user->street = $newUser['street'];
        $user->houseNumber = $newUser['houseNumber'];
        $user->colony = $newUser['colony'];
        $user->city = $newUser['city'];
        $user->user_type_id = $newUser['user_type_id'];
        $user->creator_user_id = $creator->id;

        if($newUser['password'] != NULL) 
            $user->password = bcrypt($newUser['password']);

        $user->save();

        if($user->user_type_id <= 3){
            $this->createSchedule($request->schedules, $user->id);
            $this->createReferences($request->references, $user->id);

            if($user->user_type_id == 1)
                $user->monthly_payment_id = $this->createMonthlyPayment($request->monthlyPayment); 

            else {
                $user->salary_id = $this->createSalary($request->salary);
            }
            
            $user->save();

        }        

        return response()->json($user);
    }

    public function createSchedule($schedules, $id){
        

        foreach($schedules as $x){
            $schedule = new Schedule();
            $schedule->user_id = $id;
            $schedule->check_in = $x['check_in'];
            $schedule->check_out =  $x['check_out'];
            // $schedule->description =  $x['description'];
            $schedule->day_id =  $x['day_id'];
            $schedule->type = 1;
            $schedule->active =  $x['active']; 
            $schedule->save();

        }
    }

    public function createSalary($salary){
        $newSalary = new Salary();
        $newSalary->amount =  $salary['amount'];
        $newSalary->bonus = $salary['bonus'];
        $newSalary->salary_type_id =  $salary['salary_type_id'];
        $newSalary->description = $salary['description'];
        $newSalary->save();
        return $newSalary->id;
    }

    public function createMonthlyPayment($payment){
        $monthlyPayment = new MonthlyPayment();
        $monthlyPayment->amount = $payment['amount'];
        $monthlyPayment->description = $payment['description'];
        $monthlyPayment->save();
        return $monthlyPayment->id;
    }

    public function createReferences($references, $id){

        foreach($references as $x){

            $reference =  new Reference();

            $reference->user_id =  $id;
            $reference->name = $x['name'];
            $reference->phone = $x['phone'];
            $reference->email = $x['email'];
            $reference->phone2 = $x['phone2'];
            $reference->work_place = $x['work_place'];
            $reference->relationship_id  = $x['relationship_id'];

            $reference->save();
        }
        
    } 

    public function updateUser(Request $request, $id){

        $user = User::find($id);
        
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->gender = $request->gender;
        $user->phone = $request->phone;        
        $user->insurance = $request->insurance;
        $user->curp = $request->curp;
        $user->placeBirth = $request->placeBirth;
        $user->street = $request->street;
        $user->houseNumber = $request->houseNumber;
        $user->colony = $request->colony;
        $user->city = $request->city;
        $user->user_type_id = $request->user_type_id;

        if($request->password != NULL) 
            $user->password = bcrypt($request->password);

        $user->save();
        $user->fingerprint = NULL;
        
        return response()->json($user);
    }

    public function getSchedules($id){
        $schedules = Schedule::where('user_id', $id)->get();
        return response()->json($schedules);
    }

    public function updateSchedules(Request $request, $id){

        foreach($request->schedules as $x){

            $schedule = Schedule::find($x['id']);

            $schedule->check_in = $x['check_in'];
            $schedule->check_out =  $x['check_out'];
            // $schedule->description =  $x['description'];
            // $schedule->day_id =  $x['day_id'];
            // $schedule->type = 1;
            $schedule->active =  $x['active']; 
            $schedule->save();
        }

        $user = User::find($request->user['id']);

        if($user->user_type_id == 1) {
            $monthlyPayment = MonthlyPayment::find($user->monthly_payment_id);
            $monthlyPayment->amount = $request->amount;
            $monthlyPayment->save();
        }

        return response()->json('success');
    }

    public function checkUniqueEmail(Request $request){
        $user =  User::where('email', $request->email)->first();
        if($user == NULL) return response()->json(true);
        else return response()->json(false);
    }

    public function checkUniqueName(Request $request){
        $user =  User::where('name', $request->name)->first();
        if($user == NULL) return response()->json(true);
        else return response()->json(false);
    }

    public function getStatus($id){
        $user = User::find($id);
        $status = RecordUserStatus::where('user_id', $id)->orderBy('id', 'desc')->get();

        return response()->json(['status' => $status, 'user' => $user]);

    }

    public function createStatus(Request $request){

        $user = User::find($request->user_id);

        $user->status = $request->status;

        $user->save();

        $creator = JWTAuth::parseToken()->authenticate();

        $record = new RecordUserStatus();
        $record->creator_id = $creator->id;
        $record->user_id = $user->id;
        $record->status = $request->status;
        $record->description = $request->description;
        $record->created_at = date_create();

        $record->save();

        $record = RecordUserStatus::find($record->id);

        return response()->json($record);

    }

    public function getMonthlyPayment($id) {
        return response()->json(MonthlyPayment::find($id));
    }

    public function getSalary($id) {
        return response()->json(Salary::find($id));
    }

    public function getReferences($id) {
        $references = Reference::where('user_id', $id)->get();
        return response()->json($references);
    }

    public function updateMonthlyPayment(Request $request){
        
        $monthly = MonthlyPayment::finde($request->id);

        $monthly->amount = $request->amount;
        $monthly->save();

        return response()->json($monthly);
    }

}
