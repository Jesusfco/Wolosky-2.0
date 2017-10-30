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
        return User::all();
    }

    public function searchUser(Request $request)
    {

    }


    public function create(Request $request){

        $newUser = $request->user;

        $user = new User();

        $user->name = $request[0]['name'];
        $user->email = $request[0]['email'];
        $user->birthday = $request[0]['birthday'];
        $user->gender = $request[0]['gender'];
//        $user->phone = $request[0]['phone'];
        $user->street = $request[0]['street'];
        $user->hauseNumber = $request[0]['hauseNumber'];
        $user->colony = $request[0]['colony'];
        $user->city = $request[0]['city'];
        $user->userTypeId = $request[0]['userTypeId'];


        $user->save();



        return $request->user;
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
