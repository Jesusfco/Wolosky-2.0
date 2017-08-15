<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model {

    protected $fillable = [
        'description',
        'amount',
        'salaryTypeId',
        'userId'
    ];

}
