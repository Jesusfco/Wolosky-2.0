<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $table = "receipt";
    protected $fillable = [
        'user_id',
        'creator_id',
        'event_id',
        'amount',        
        'month',
        'days', 
        'description',
        'year',
        'type',   
        'payment_type',   
    ];

    public function user() {
        return $this->hasOne('Wolosky\User', 'id', 'user_id')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }

    public function creator() {
        return $this->hasOne('Wolosky\User', 'id', 'creator_id')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }

    public function event() {
        return $this->hasOne('Wolosky\Event', 'id', 'event_id')->withDefault([
            'name' => 'Evento Eliminado',
        ]);
    }
    public function typeView() {
        if($this->type == 1)
            return"MENSUALIDAD";
        else if ($this->type == 2)
            return"INSCRIPCION";
        else if($this->type == 3)
            return"DIAS";
        else if($this->type == 4)
            return"UNIFORME";   
        else if($this->type == 5)
            return"EVENTO";  
         else 
            return 'Otro';
    }
}
