<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model {

    protected $fillable = [
        'amount',
        'description'
    ];

}
