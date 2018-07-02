<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

    protected $table = "schedule";

    protected $fillable = [
        'description',
        'day_id',
        'check_in',
        'check_out',
        'user_id',        
        'active'
    ];

    // public $timestamps = true;

}
