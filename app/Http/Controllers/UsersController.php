<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\MonthlyPayment;
use Wolosky\User;
use Wolosky\Schedule;
use Wolosky\Salary;
use Wolosky\Payment;

class UsersController extends Controller
{
    public function get()
    {
        return response()->json(User::all());
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
//        $user->phone = $newUser['phone'];
        $user->street = $newUser['street'];
        $user->hauseNumber = $newUser['hauseNumber'];
        $user->colony = $newUser['colony'];
        $user->city = $newUser['city'];
        $user->userTypeId = $newUser['userTypeId'];

        $user->save();

        return response()->json($request->user);
    }

    public function createSchedule($schedules, $id){
        

        foreach($schedules as $x){
            $schedule = new Schedule();
            $schedule->userId = $id;
            $schedule->checkIn = $x->checkIn;
            $schedule->checkOut =  $x->checkOut;
            $schedule->desccription =  $x->description;
            $schedule->day =  $x->day;
            $schedule->save();

        }
    }

    public function createSalary($salary){
        $newSalary = new Salary();
        $newSalary->amount =  $salary->amount;
        $newSalary->bonus = $salary->bonus;
        $newSalary->salaryTypeId =  $salary->type;
        $newSalary->description = $salary->description;
        $newSalary->save();
        return $newSalary->id;
    }

    public function createMonthlyPayment($payment){
        $monthlyPayment = new MonthlyPayment();
        $monthlyPayment->amount = $payment->amount;
        $monthlyPayment->description = $payment->description;
        $monthlyPayment->save();
        return $monthlyPayment->id;
    }


}
