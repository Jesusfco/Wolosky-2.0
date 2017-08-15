<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model {

    protected $fillable = [
        'name',
        'birthday',
        'phone',
        'street',
        'houseNumber',
        'colony',
        'city',
        'monthlyPaymentId',
        'userTypeId',
        'salaryId'
    ];

}
