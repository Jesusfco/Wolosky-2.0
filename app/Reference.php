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
        'email',
        'created_at',
        'updated_at'
        
    ];
}
