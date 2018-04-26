<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class SaleDebt extends Model
{
    protected $table = 'sale_debt';
    protected $fillable = [
        'user_id', 'sale_id','status', 'total'
    ];
    
}
