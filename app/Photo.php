<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'name',
        'noticia_id',
        'order',
    ];

    public $timestamps = false;
}
