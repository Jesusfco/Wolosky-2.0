<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {

    protected $fillable = [
        'checkIn',
        'checkOut',
        'worked_hours',
        'extra_hours',        
        'date', 
        'observation',
        'status',
        'confirmation',
        'user_id'
    ];

    protected $table = 'record';
    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('Wolosky\User');
    }

}
