<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

    protected $table = "schedules";

    protected $fillable = [
        'description',
        'day',
        'checkIn',
        'checkOut',
        'user_id',
        'type',
        'active'
    ];

    // public $timestamps = true;

}
