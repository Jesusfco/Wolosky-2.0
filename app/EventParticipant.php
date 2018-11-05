<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    protected $table = 'event_participant';
    protected $fillable = [
        'user_id', 'creator_id', 'event_id', 'status', 'cost', 'created_at'
        ];

    public $timestamps = false;

    public function user() {
        return $this->hasOne('Wolosky\User', 'id', 'user_id');
    }

    public function creator() {
        return $this->hasOne('Wolosky\User', 'id', 'creator_id');
    }

    public function event() {
        return $this->belongsTo ('Wolosky\Event', 'event_id');
    }
}
