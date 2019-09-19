<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    protected $table = 'cashbox';
    
            
    protected $fillable = [
    'amount'
    ];
    
   public $timestamps = false;

   public static function add($amount){
       
        $cash = Cash::find(1);
        $cash->amount += $amount;
        $cash->save();

   }

   public static function substract($amount) {

        $cash = Cash::find(1);
        $cash->amount -= $amount;
        $cash->save();

   }

   public static function setAmount($amount) {

        $cash = Cash::find(1);
        $cash->amount = $amount;
        $cash->save();

   }
}
