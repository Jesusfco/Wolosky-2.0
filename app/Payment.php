<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    protected $fillable = [
        'id',
        'userId',
        'paymentTypeId',
        'description',
        'amount',
        'date'
    ];

    protected $table = 'payment';

}
