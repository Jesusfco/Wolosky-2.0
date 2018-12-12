<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\User;
use Wolosky\Schedule;

class SchedulesController extends Controller
{

    
    public function getStudents(Request $re) {

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
        

        $schedules = Schedule::all();

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

        return response()->json(['users' => $users, 'schedules' => $schedules]);
    }
}
