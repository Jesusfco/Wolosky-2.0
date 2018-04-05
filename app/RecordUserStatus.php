<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class RecordUserStatus extends Model
{
    protected $table = "record_user_status";
    protected $fillable = [        
        'user_id',
        'creator_id',        
        'status',        
        'description',
        'created_at'  
    ];

    public $timestamps = false;
}
