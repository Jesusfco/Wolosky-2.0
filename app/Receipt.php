<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = "receipt";
    protected $fillable = [
        'user_id',
        'creator_id',
        'amount',        
        'month',
        'days', 
        'description',
        'year',
        'type',   
        'payment_type',   
    ];

    public function user() {
        return $this->hasOne('Wolosky\User', 'id', 'user_id');
    }
}
