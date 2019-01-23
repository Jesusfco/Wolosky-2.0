<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
             
    protected $fillable = [
        'user_id','creator_id', 'check_in','check_out','date_entry','amount','status'
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
}
