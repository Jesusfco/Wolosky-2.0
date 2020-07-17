<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Noticia;
use Wolosky\Photo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;
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
            'imagen' => 'required|image'

        ]);

        ini_set('memory_limit','256M');
        //Se carga la imagen a la carpeta
        $img = $request->file('imagen');
        $file_route = 'principal.'. $img->getClientOriginalExtension();


        $noticias = new Noticia();
        $noticias->titulo = $request->titulo;
        $noticias->resumen = $request->resumen;
        $noticias->fecha= $request->fecha;
        $noticias->texto = $request->texto;
        $noticias->youtube = $request->youtube;
        $noticias->imagen = $file_route;
        $noticias->user_id = Auth::id();
        $noticias->save();

        File::makeDirectory('images/noticias/' . $noticias->id);

        Image::make($request->file('imagen'))
        ->fit(900,600)
        ->save("images/noticias/" . $noticias->id . '/' . $file_route);

        if($noticias->save()) { 
            return redirect('admin/noticias')->with('success', 'La noticia ha sido creada con exito');
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
        ]);

        $noticias = Noticia::find($id);

        //Si se modigica la imagen
        if($request->file('imagen')) {
            ini_set('memory_limit','256M');
            $img = $request->file('imagen');
            $file_route = 'principal.'. $img->getClientOriginalExtension();

            File::delete('images/noticias/' . $id . '/' .$noticias->imagen);

            Image::make($request->file('imagen'))
                  ->fit(900,600)
                  ->save('images/noticias/' . $id . '/' . $file_route);


            $noticias->imagen = $file_route;

        }        

        $noticias->titulo = $request->titulo;
        $noticias->resumen = $request->resumen;
        $noticias->fecha= $request->fecha;
        $noticias->texto = $request->texto;
        $noticias->youtube = $request->youtube;

        if($noticias->save()) {
            return back()->with('success', 'La noticia ha sido modificada con exito');
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
    public function destroy($id)
    {        
        $n = Noticia::find($id);
        Photo::where('noticia_id', $n->id)->delete();
        File::deleteDirectory('images/noticias/' . $n->id);
        $n->delete();
        return 'true';
    }

    public function uploadPhotos($id) {
        $noticias = Noticia::find($id);          
        return view('noticias/uploadPhotos')->with(['noticia'=> $noticias]);
    }

    public function storePhoto(Request $request, $id) {
        
        $this->validate($request, [
            'image' => 'required|image'
        ]);

        $img = $request->file('image');

        //Verify Process uNIQUE FOR ALBUM
        $verify = Photo::where([
                    ['name', $img->getClientOriginalName() ],
                    ['noticia_id', $id ]
                    ])->first();

        if(isset($verify->id))  return response()->json(['error' => 'File Duplicate'], 403);

        $file_route = $img->getClientOriginalName();
        $image = Image::make($request->file('image'));

        if ($image->width() >= $image->height() && $image->width() < 1200) {            

            $image->resize(1200, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            
            $image->save('images/noticias/' . $id .'/' . $file_route);

        } else  if ($image->width() < $image->height() && $image->height() < 1200) {

            $image->resize(null, 1200, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $image->save('images/noticias/' . $id .'/' . $file_route);

        } else { 
            $image->save('images/noticias/' . $id .'/' . $file_route);
        }

        $photo = new Photo();
        $photo->name = $file_route;
        $photo->noticia_id = $id;
        $photo->save();

        return response()->json($photo);

    }

    public function deletePhoto(Request $request, $id) {
        Photo::find($request->id)->delete();
        File::delete('images/noticias/' . $id . '/' . $request->name);
        return response()->json(true);
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
