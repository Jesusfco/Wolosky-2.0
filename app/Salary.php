<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model {

    protected $table = "salary";
    protected $fillable = [
        'description',
        'amount',
        'bonus',
        'salary_type_id',        
    ];

}
