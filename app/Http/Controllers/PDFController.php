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
use PDF;

class PDFController extends Controller
{
    public function userResume(Request $request) {

        $user = User::find($request->id);
        $usere =  $this->setUserView($user);

        $schedules = Schedule::where('user_id', $user->id)->get();
        $schedules = $this->scheduleView($schedules);
        
        $status = RecordUserStatus::where('user_id', $user->id)->get();

        $references = Reference::where('user_id', $user->id)->get();
        $references = $this->setReferenceView($references);

        if($user->user_type_id == 1) {
            $monthly = MonthlyPayment::find($user->monthly_payment_id);

            $pdf = PDF::loadView('pdf.UserInformation', 
                                ['user' => $user, 
                                'schedules' => $schedules, 
                                'references' => $references, 
                                'monthly' => $monthly]);
            return $pdf->download('usuario_' . $user->name . '.pdf');

        } else if ($user->user_type_id <= 3) {
            $salary = Salary::find($user->salary_id);
        }

    }

    public function scheduleView($schedules) {
        
        for($i = 0; $i < count($schedules); $i++) {
            if($schedules[$i]->day_id == 1) $schedules[$i]->day_id = 'LUNES';
            else if($schedules[$i]->day_id == 2) $schedules[$i]->day_id = 'MARTES';
            else if($schedules[$i]->day_id == 3) $schedules[$i]->day_id = 'MIERCOLES';
            else if($schedules[$i]->day_id == 4) $schedules[$i]->day_id = 'JUEVES';
            else if($schedules[$i]->day_id == 5) $schedules[$i]->day_id = 'VIERNES';
            else if($schedules[$i]->day_id == 6) $schedules[$i]->day_id = 'SABADO';
            else if($schedules[$i]->day_id == 7) $schedules[$i]->day_id = 'DOMINGO';
        }

        return $schedules;

    }

    public function setReferenceView($references) {

        for($i = 0; $i < count($references); $i++) { 
           if($references[$i]->relationship_id == 1 ) $references[$i]->relationship_id = 'PADRE/MADRE';
           else if($references[$i]->relationship_id == 2 ) $references[$i]->relationship_id = 'Hermano/a';
           else if($references[$i]->relationship_id == 3 ) $references[$i]->relationship_id = 'Familiar';
           else if($references[$i]->relationship_id == 4 ) $references[$i]->relationship_id = 'Amigo/a';
           else if($references[$i]->relationship_id == 5 ) $references[$i]->relationship_id = 'Compañero de trabajo';
           else if($references[$i]->relationship_id == 6 ) $references[$i]->relationship_id = 'Otro';
        }

        return $references;

    }

    public function setUserView($user) {

        if($user->gender == 1) $user->gender = 'MASCULINO';
        else if($user->gender == 2) $user->gender = 'FEMENINO';

        return $user;
    }
}
