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
        'status'
    ];

    protected $hidden = [
        'password', 'remember_token', 'fingerprint'
    ];

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
