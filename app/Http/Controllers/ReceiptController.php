<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Receipt;
use Wolosky\User;

class ReceiptController extends Controller
{
    public function getAnalisis(){

        $notificacionCount = 0;
        $notificactionUserId = Array();

        $user = User::where(['user_type_id' => 1, 'status' => 1])->get();
        $receipments =  Receipt::where([
                                ['created_at', '<', $this->nextMonth()],
                                ['created_at', '>', $this->thisMonth()],
                                ['type', '=', 1]
                            ])->get();
        
        for($x = 0; count($user) > $x; $x++){
            
            $user[$x]->receipt = false;

            for($y = 0; count($receipments) > $y; $y++){

                if($receipments[$y]->user_id == $user[$x]->id){

                    $user[$x]->receipt = true;
                    $notificactionUserId[] = $user[$x]->id;
                    break;

                }
                

            }

            if($user[$x]->receipt == false)
                $notificacionCount++;

        }

        return response()->json([
            'count' => $notificacionCount, 
            'users' => $notificactionUserId
            ]);

    }//Final de fucntion

    public function nextMonth(){
        return date('Y') . '-'. ( 1 + date('m')) . '-00 00:00:00';
    }

    public function thisMonth(){
        return date('Y') . '-'. date('m') . '-00 00:00:00';
    }

}
