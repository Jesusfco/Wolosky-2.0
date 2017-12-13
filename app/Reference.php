<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $fillable = [
        'user_id',
        'relationship',
        'name',
        'phone',
        'email',
        'created_at',
        'updated_at'
        
    ];
}
