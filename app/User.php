<?php

namespace Wolosky;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        'email',
        'password',
        'fingerprint',
        'name',
        'img',
        'birthday',
        'gender',
        'insurance',
        'phone',
        'street',
        'houseNumber',
        'colony', 
        'city',
        'user_type_id',
        'creator_user_id',
        'monthly_payment_id',        
        'salary_id',
        'status',
        'curp'
    ];

    protected $hidden = [
        'password', 'remember_token', 'fingerprint'
    ];

    public function user_type() {
        if($this->user_type_id == 1) 
            return 'Alumno';
        else if($this->user_type_id == 2) 
            return 'Profesor';    
        else if($this->user_type_id == 3) 
            return 'Cajero';
        else if($this->user_type_id == 4) 
            return 'Contador';
        else if($this->user_type_id == 5) 
            return 'Mini Administrador';
        else if($this->user_type_id == 6) 
            return 'Administrador';
        else
            return 'Otro';
    }

    public function genderView() {
        if($this->gender == 1)
            return 'Masculino';
        else 
            return 'Femenino';
    }
    public function fullAddress() {
        return "$this->street #$this->houseNumber $this->colony $this->city";
    }

    public function statusView() {
        if($this->status == 1)
            return 'Alta';
        else if($this->status == 2)
            return 'Baja Temporal';
        else
            return 'Baja';
    }   

    public function monthlyPayment(){
        return $this->hasOne('Wolosky\MonthlyPayment', 'id', 'monthly_payment_id');
    }

    public function records(){
        return $this->hasMany('Wolosky\Record', 'user_id', 'id');
    }

    public function schedules() {
        return $this->hasMany('Wolosky\Schedule', 'user_id', 'id');
    }

    public function references() {
        return $this->hasMany('Wolosky\Reference', 'user_id', 'id');
    }

    public function salary() {
        return $this->hasOne('Wolosky\Salary', 'id', 'salary_id');
    }


    public function monthly_payment() {
        return $this->hasOne('Wolosky\MonthlyPayment', 'id', 'monthly_payment_id');
    }

    public function receipts() {
        return $this->hasMany('Wolosky\Receipt', 'user_id', 'id');
    }
                
    public function setHours() {

        $hours = 0;
        $minutes = 0;

        foreach($this->schedules as $sche) {
            
            $check_in = explode(":",$sche->check_in);
            $check_out = explode(":",$sche->check_out);

            $h1 = (int)$check_in[0];
            $m1 = (int)$check_in[1];
           
            $h2 = (int)$check_out[0];
            $m2 = (int)$check_out[1];

            $h = $h2 - $h1;
            $m = $m2 - $m1;

            

            if($m >= 0) {
                $hours += $h;
                $minutes += $m;
            } else {
                $hours += $h - 1;
                $minutes += ($m + 60);
            }

            

        }
        
        for($rr = 0; $rr < $minutes; $rr+=60){
            $hours ++;
        }
        
        $this->hours = $hours;
        

    }

}
