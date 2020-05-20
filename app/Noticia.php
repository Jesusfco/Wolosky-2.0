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

    public function getImgUrl() {
        $file = str_replace(' ', '%20', $this->imagen);
        return url('images/noticias/' . $this->id . '/' . $file);
        
    }

    public function getYoutubeFrame() {
        if( strpos($this->youtube, 'iframe') )
            return $this->youtube;
        
        $string = explode('v=', $this->youtube);
        $idYoutube = $string[1];
        $string = explode('&', $idYoutube);
        for($i = 0; $i < count($string); $i++) {
            if(!strpos($string[$i], '=') ) {
                $idYoutube = $string[$i];
                break;
            }            
        }
        return '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $idYoutube . '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';

    }
}
