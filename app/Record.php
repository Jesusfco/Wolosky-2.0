<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {

    protected $fillable = [
        'checkIn',
        'checkOut',
        'time_worked',
        'time_extra',        
        'date', 
        'observation',
        'type',
        // 'confirmation',
        'user_id'
    ];

    protected $table = 'record';
    public $timestamps = false;
    
    public function user() {
        return $this->belongsTo('Wolosky\User')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }

}
