<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model {

    protected $fillable = [
        'description',
        'day',
        'checkIn',
        'checkOut',
        'userId'
    ];

}
