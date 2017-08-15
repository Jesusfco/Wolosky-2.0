<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model {

    protected $fillable = [
        'name', 'userTypeId'
    ];

}
