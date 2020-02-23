<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Reset extends Model
{
    protected $table = 'password_resets';

    protected $fillable = [
        'email', 'token'
    ];


    private $token_lenght = 50;

    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'token';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function makeToken(){

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $this->token_lenght; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    public function save2($email){
        $this->email = $email;
        $this->token = $this->makeToken();
        $this->save();
    }

}
