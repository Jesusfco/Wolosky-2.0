<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class SaleDebt extends Model
{
    protected $table = 'sale_debt';
    protected $fillable = [
        'user_id', 'sale_id','status'
    ];
    
    public function user() {
        return $this->hasOne('Wolosky\User', 'id', 'user_id')->withDefault(function ($user) {
            $user->name = 'Usuario Inexistente';            
        });
    }

    public function sale() {
        return $this->belongsTo('Wolosky\Sale');
    }

    public function receipts()
    {
        return $this->hasMany('Wolosky\Receipt', 'sale_id', 'sale_id');
    }

    public function delete() {        
        $this->sale()->delete();
        $this->receipts()->delete();
        parent::delete();
    }
}
