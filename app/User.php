<?php

namespace Wolosky;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

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


}
