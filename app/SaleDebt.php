<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class SaleDebt extends Model
{
    protected $table = 'sale_debt';
    protected $fillable = [
        'user_id', 'sale_id','sta||tus', 'total'
    ];
    
    public function user() {
        return $this->hasOne('Wolosky\User', 'id', 'user_id');
    }
}
