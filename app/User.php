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
        'phone',
        'street',
        'houseNumber',
        'colony',
        'city',
        'monthlyPaymentId',
        'userTypeId',
        'salaryId'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];


}
