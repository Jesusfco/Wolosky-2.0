<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sale';
    protected $fillable = [
        'total', 'creator_id', 'type', 'created_at'
    ];

    public $timestamps = false;
}
