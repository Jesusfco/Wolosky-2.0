<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    
            
    protected $fillable = [
    'name', 'code', 'cost_price','price','reorder','stock','department'
    ];
    
//    public $timestamps = false;
}
