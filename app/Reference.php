<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'reference';
    protected $fillable = [
        'user_id',
        'relationship_id',
        'name',
        'phone',
        'phone2',
        'email',
        'work_place',
        'created_at',
        'updated_at'
        
    ];
}
