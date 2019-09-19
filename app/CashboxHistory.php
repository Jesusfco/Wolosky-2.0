<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class CashboxHistory extends Model
{
    // public $timestamps = false;

    protected $fillable = [
        'amount', 'creator_id', 'cashbox_id', 'allow', 'created_at'
        ];
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_at = $model->freshTimestamp();
        });
    }

    public function creator() {
        return $this->hasOne('Wolosky\User', 'id', 'creator_id')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }

    public function cashbox() {
        return $this->belongsTo('Wolosky\Cash', 'cashbox_id', 'id')->withDefault([
            'name' => 'Usuario Desconocido',
        ]);
    }
}
