<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Schedule;
use Wolosky\Salary;
use Wolosky\Payment;

class UsersController extends Controller
{
    public function getUsers()
    {
        return User::all();
    }

    public function searchUser(Request $request)
    {

    }


    public function createUser(Request $request){

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

        //Pagos de trabajadores
        if($user->userTypeId == 1) {

            $salary = new Salary();

            $salary->amount = $request[3]['amount'];
            $salary->salaryTypeId = $request[3]['salaryTypeId'];
            $salary->description = $request[3]['description'];
            $salary->userId = $user->id;

            $salary->save();

        }//Fin if para Pagos Trabajadores


        //Asignar pagos a los gimnastas
        else if($user->userTypeId == 2) {

            $payment = new Payment();

            $payment->amount = $request[2]['amount'];
            $payment->date = $request[2]['date'];
            $payment->description = $request[2]['description'];
            $payment->userId = $user->id;

            $payment->save();

        }   //Fin else if de pagos a gimnastas

        //Asignar Contraseña
        else if($user->userTypeId == 3) {

        }//Fin else If Asignar Contraseña


        //Asignar Schedules
        if( $user->userTypeId < 3) {

            $day = 1;

            foreach($request[1] as $horario){

                if($horario['active'] == true) {

                    $schedule = new Schedule();

                    $schedule->checkIn = $horario['checkIn'];
                    $schedule->checkOut = $horario['checkOut'];
                    $schedule->userId = $user->id;
                    $schedule->day = $day;

                    $schedule->save();

                }

                $day++;

            }
        } //Fin de asignar Schedules

        return response()->json($user);

        return $request->user;
    }


}
