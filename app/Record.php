<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Record extends Model {

    protected $fillable = [
        'checkIn',
        'checkOut',
        'workedHours',
        'extraHours',
        'scheduleId',
        'date',
        'observation',
        'status',
        'confirmation'
    ];

}
