<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    protected $fillable = [
        'id',
        'user_id',
        'payment_type_id',
        'description',
        'amount',
        'date'
    ];

    protected $table = 'payment';

}
