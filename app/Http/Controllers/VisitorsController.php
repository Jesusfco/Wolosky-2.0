<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Noticia;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Wolosky\RecordUserStatus;
use Wolosky\User;

class VisitorsController extends Controller
{

    public function migration(){
        // 

        return 'SIN MIGRACIONES';
    }

    public function records(){
        // $users =  User::all();
        
        // foreach($users as $user){
        //     $record =  new RecordUserStatus();

        //     $record->user_id =  $user->id;
        //     $record->creator_id = 3;
        //     $record->description = 'REGISTRADO';
        //     $record->status = 1;
        //     $record->created_at = $user->created_at;

        //     if($user->user_type_id == 3)

        //         $record->creator_id = 2;

        //     // } else if($user->user_type_id >= 6){
        //     //     break;
        //     // }

        //     $record->save();

        // }

        // return 'Registro de cambio de status creados';
    }
    public function index() {
        $noticias = Noticia::orderBy('fecha','desc')->limit(3)->get();
        return view('home/home')->with(['noticias'=> $noticias]);
    }
    public function noticias() {
        $noticias = Noticia::orderBy('fecha','desc')
            ->paginate(9)
            ->withPath('noticias');
        return view('home/noticias')->with(['noticias'=> $noticias]);
    }
    public function articulo($id)
    {
        $noticias = Noticia::find($id);
        $articulos = Noticia::limit(4)->select('titulo','id','imagen')->inRandomOrder()->get();

        return view('home/articulo')->with(['noticias'=> $noticias, 'not' => $articulos]);
    }


    public function mail(Request $request)
    {
        $_message = $request->mensaje;
        $_email = $request->correo;
        $_name = $request->nombre;
        echo $_email;
        $_toSend = "Nombre: " . $_name . "\nE-mail: " . $_email . "\n\nMensaje:\n" . $_message;
        $to = "gimnasiawolosky@gmail.com";
        $subject = "Nuevo contacto: " . $_name . " - " . $_email;
        $headers = "From: $_email" . "\r\n" .
            "CC: " . $_email;

        if (mail($to, $subject, $_toSend, $headers)) {
            return back()->with('msj', 'La noticia ha sido creada con exito');
        } else {
            return back()->with('error', 'Los datos no de guardaron');
        }
    }
}
