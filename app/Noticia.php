<?php

namespace Wolosky;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    
            
    protected $fillable = [
    'titulo','resumen', 'fecha','texto','youtube','image','user_id'
    ];
    
//    public $timestamps = false;
    
    public function scopeSearch($query, $name) 
    {
        $n = $query->where('titulo', 'LIKE', "%$name%")->get();
//        $m = $query->where('TEXTO', 'LIKE', "%$name%")->union($n)->get();
        return $query->where('titulo', 'LIKE', "%$name%");
    }
}
