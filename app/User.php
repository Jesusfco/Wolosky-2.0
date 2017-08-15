<?php

namespace Wolosky;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    use Notifiable;

    protected $fillable = [
        'email', 'password', 'userDetailId'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userDetail() {
        return $this->hasOne('Wolosky\UserDetail', 'id', 'userDetailId');
    }

}
