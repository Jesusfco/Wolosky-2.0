<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'event';
    protected $fillable = [
         'creator_id', 'name', 'description', 'cost', 'date', 'date_to'
        ];

    public function creator() {
        return $this->hasOne('Wolosky\User', 'id', 'creator_id');
    }

    public function participants() {
        return $this->hasMany('Wolosky\EventParticipant', 'event_id', 'id');
    }
}
