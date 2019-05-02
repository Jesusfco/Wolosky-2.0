<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{    
    protected $table = 'sale';
    protected $fillable = [
         'creator_id', 'type', 'created_at'
    ];

    public $timestamps = false;

    public function creator()
    {
        return $this->hasOne('Wolosky\User', 'id', 'creator_id')->withDefault(function ($user) {
            $user->name = 'Usuario Inexistente';            
        });
    }

    public function receipts()
    {
        return $this->hasMany('Wolosky\Receipt', 'sale_id', 'id');
    }

    public function description()
    {
        return $this->hasMany('App\SaleDescription', 'sale_id', 'id');
    }

    public function getTotal() {
        $total =  0;

        foreach($this->description as $desc) {
            $total += $desc->quantity * $desc->price;
        }        

        return $total;

    }

    public function delete() {        
        $this->description()->delete();
        parent::delete();
    }

}
