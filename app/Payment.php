<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {

    protected $fillable = [        
        'user_id',
        'description',
        'amount',
        'payment_date',
        'status',
        'date_from',
        'date_to',
    ];

    protected $table = 'payment';

    public function user() {
        return $this->hasOne('Wolosky\User', 'id', 'user_id');
    }
}
