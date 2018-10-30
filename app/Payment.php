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
