<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    static  $imgFolder = 'images/equipo/';

    protected $appends = ['img_path',];

    protected $fillable = [
        'name',
        'sentence',
        'img',
        'active',        
    ];

    public function getImgPathAttribute(){           
        return url(Team::$imgFolder . $this->img);
    }

    public function activeView() {
        if($this->active) return "Activo";
        return "Inactivo";
    }
}
