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
                    ['name', 'LIKE',"%$re->name%"],
                    ])->select('id', 'name', 'user_type_id')
                ->orderBy('name', 'ASC')->get();

        } else {

            $users = User::where('status', 1)->where('name', 'LIKE',"%$re->name%")
                    ->whereBetween('user_type_id', [2,4])
                    ->select('id', 'name', 'user_type_id')
                ->get();

        }
        

        $schedules = Schedule::whereHas('user', function ($query) use ($re) {
            $query->where('name', 'LIKE', "%$re->name%");
            $query->where('status', 1);
            if($re->type == 1) 
                $query->where('user_type_id', 1);                
            else 
                $query->whereBetween('user_type_id', [2,4]);            
        });
        
        if($re->from != NULL && $re->to != NULL) 
            $schedules = $schedules->where(function($query) use ($re) {
                $query->where([
                    ['check_out', '<=', $re->to],
                    ['check_out', '>', $re->from]
                ]);

                $query->orWhere([                    
                    ['check_in', '>=', $re->from],
                    ['check_in', '<', $re->to],
                ]);
            });
            //     ['check_in', '>=', $re->from],
            //     ['check_in', '<=', $re->to],
            //     ['check_out', '<=', $re->to],
            // ]);
            // $schedules = $schedules->where([
            //     ['check_in', '>=', $re->from],
            //     ['check_in', '<=', $re->to],
            //     ['check_out', '<=', $re->to],
            // ]);
        
        $schedules = $schedules->get();

        return response()->json(['users' => $users, 'schedules' => $schedules]);
    }
}
