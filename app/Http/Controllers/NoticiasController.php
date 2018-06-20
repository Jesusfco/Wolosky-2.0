<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Noticia;
use Wolosky\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\Facades\Image;
use File;


class NoticiasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $noticias = Noticia::search($request->name)
            ->orderBy('id','desc')
            ->paginate(15);
        return view('noticias/list')->with(['noticias'=> $noticias]);
    }

    public function create()
    {

        return view('noticias/create');
    }
   
    public function store(Request $request)
    {
        $this->validate($request, [
           'titulo' => 'required',
            'resumen' => 'required',
            'fecha' => 'required',
            'texto' => 'required',
            'youtube' => 'required',
            'imagen' => 'required|image'

        ]);

        ini_set('memory_limit','256M');
        //Se carga la imagen a la carpeta
        $img = $request->file('imagen');
        $file_route = time().'_'. $img->getClientOriginalName();


        $noticias = new \Wolosky\Noticia();
        $noticias->titulo = $request->titulo;
        $noticias->resumen = $request->resumen;
        $noticias->fecha= $request->fecha;
        $noticias->texto = $request->texto;
        $noticias->youtube = $request->youtube;
        $noticias->imagen = $file_route;
        $noticias->user_id = Auth::id();
        $noticias->save();

        File::makeDirectory('images/noticias/' . $noticia->id);

        Image::make($request->file('imagen'))
        ->fit(900,600)
        ->save("images/noticias/" . $noticia->id . '/' . $file_route);

        if($noticias->save()) { 
            return back()->with('msj', 'La noticia ha sido creada con exito');
        } else { 
            return back()->with('error', 'Los datos no de guardaron');
        }                                
    }
    
    public function show($id)
    {        
        $noticias = Noticia::find($id);
        $articulos = Noticia::limit(4)->select('titulo','id','imagen')->inRandomOrder()->get();
                
        return view('home/articulo')->with(['noticias'=> $noticias, 'not' => $articulos]);
    }
    
    public function edit($id)
    {
        $noticias = Noticia::find($id);          
        return view('noticias/edit')->with(['noticia'=> $noticias]);
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titulo' => 'required',
            'resumen' => 'required',
            'fecha' => 'required',
            'texto' => 'required',
            'youtube' => 'required',
        ]);

        $noticias = Noticia::find($id);

        //Si se modigica la imagen
        if($request->file('imagen')) {
            ini_set('memory_limit','256M');
            $img = $request->file('imagen');
            $file_route = time().'_'. $img->getClientOriginalName();



            Image::make($request->file('imagen'))
                  ->fit(600,400)
                  ->save("images/noticias/" . $file_route);


            Storage::disk('imgNoticias')->delete($noticias->imagen);
            $noticias->imagen = $file_route;

        }

        //Detectamos saltos de linea y automatizamos <br>
//        $texto = $request->texto;
//        $texto = rawurlencode($texto);
//        $texto = rawurldecode(str_replace("%0D%0A","<br>",$texto));

        $noticias->titulo = $request->titulo;
        $noticias->resumen = $request->resumen;
        $noticias->fecha= $request->fecha;
        $noticias->texto = $request->texto;;
        $noticias->youtube = $request->youtube;

        if($noticias->save()) {
            return back()->with('msj', 'La noticia ha sido modificada con exito');
        } else {
            return back()->with('error', 'Los datos no de guardaron');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id =  $request->id;
        $n = Noticia::find($id);
        Photos::where('noticia_id', $n->id)->delete();
        File::deleteDirectory('images/noticias/' . $n->id);
        Noticia::destroy($id);
        return 'true';
    }

    public function uploadPhotos($id) {
        $noticias = Noticia::find($id);          
        return view('noticias/uploadPhotos')->with(['noticia'=> $noticias]);
    }

    public function storePhoto(Request $request, $id) {
        return $id;
    }

    public function getPhotos($id) {
        return response()->json(Photo::where('noticia_id', $id)->get());
    }

    public function order() {
        
        $noticias = Noticia::all();

        foreach($noticias as $not) {
            File::makeDirectory('images/noticias/' . $not->id);
            File::move('images/noticias/' . $not->imagen, 'images/noticias/' . $not->id . '/' . $not->imagen);
        }

        return 'Directories oirganized';

    }
}
