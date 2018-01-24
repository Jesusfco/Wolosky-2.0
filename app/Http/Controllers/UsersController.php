<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\MonthlyPayment;
use Wolosky\User;
use Wolosky\Schedule;
use Wolosky\Salary;
use Wolosky\Payment;
use Wolosky\Reference;

class UsersController extends Controller
{
    public function __construct(){ $this->middleware('admin'); }

    public function get(Request $request)
    {
        $users =  User::where('name', 'LIKE', '%'. $request->search .'%')->get();

        return response()->json($users);
        return response()->json($request->search);
    }

    public function showUser($id){
        return response()->json(User::find($id));
    }

    public function searchUser(Request $request)
    {

    }


    public function create(Request $request){

        
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
            $reference->relationship_id  = $x['relationship_id'];

            $reference->save();
        }
        
    } 

    public function updateUser(Request $request){
        
        $newUser = $request->user;        

        $user =  User::find($newUser['id']);

        $user->name = $newUser['name'];
        $user->email = $newUser['email'];
        $user->birthday = $newUser['birthday'];
        $user->gender = $newUser['gender'];
        $user->phone = $newUser['phone'];
        $user->street = $newUser['street'];
        $user->hauseNumber = $newUser['hauseNumber'];
        $user->colony = $newUser['colony'];
        $user->city = $newUser['city'];
        $user->userTypeId = $newUser['userTypeId'];

        $user->save();
        return response()->json($user);
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


}
