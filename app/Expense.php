<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $table = 'expense';
    
            
    protected $fillable = [
    'amount','creator_id', 'description', 'name', 'from_cashbox'
    ];

    public function creator() {
        return $this->hasOne('Wolosky\User', 'id', 'creator_id')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }
   
}
