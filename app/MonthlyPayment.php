<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class MonthlyPayment extends Model {

    protected $table = 'monthly_payment';
    protected $fillable = [
        'amount',
        'description'
    ];

}
