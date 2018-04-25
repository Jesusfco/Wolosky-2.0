<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    
            
    protected $fillable = [
    'amount','creator_id', 'description', 'name'
    ];
    
   
}
