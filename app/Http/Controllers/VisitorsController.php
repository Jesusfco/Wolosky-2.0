<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Noticia;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Wolosky\RecordUserStatus;
use Wolosky\User;
use Wolosky\Receipt;
use Wolosky\Photo;
use Wolosky\Schedule;
use Wolosky\Record;
use Mail;
use Wolosky\Mail\ContactMail;
use Wolosky\Team;

class VisitorsController extends Controller
{

     

    public function migration(){
        // 

        return 'SIN MIGRACIONES';
    }

    public function setYear() {
        Receipt::where('year', null)->update(['year' => 2018]);
        return 'holi';
    }

    public function getPhotos($id) {
        return response()->json(Photo::where('noticia_id', $id)->get());
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
        $articulo = Noticia::find($id);
        $noticias = Noticia::limit(4)->select('titulo','id','imagen')->inRandomOrder()->get();

        return view('home/articulo')->with(['articulo'=> $articulo, 'noticias' => $noticias]);
    }


    public function mail(Request $request)
    {
        
        $data = (object) NULL;
        $data->email = $request->correo;
        $data->name = $request->nombre;
        $data->message = $request->mensaje;
                       
        Mail::send(new ContactMail($data));
                
        return back()->with('msj', 'Mensaje enviado, en breve se le contestara');
        
    }

    function team(){

        $array = Team::where('active', true)->get();
        return view('home/equipo')->with('team', $array);

    }

    public function test() {

        
        $fp = fopen('results.json', 'w');
        fwrite($fp, json_encode("hola"));
        fclose($fp);
        return json_encode("hola");

    }

}
