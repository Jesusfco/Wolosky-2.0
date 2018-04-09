<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $table = 'cash';
    
            
    protected $fillable = [
    'amount'
    ];
    
   public $timestamps = false;
}
