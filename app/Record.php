<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {

    protected $fillable = [
        'check_in',
        'check_Out',
        'worked_hours',
        'extra_hours',        
        'date', 
        'observation',
        'status',
        'confirmation'
    ];

}
