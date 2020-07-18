<?php

namespace Wolosky\Http\Controllers\Web;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Team;
use File;
use Image;

class TeamController extends Controller
{
    public function index(Request $re) {        

        $array = Team::where('name', 'LIKE', $re->name)                    
                    ->paginate(30);
        return view('app/team/list')->with(['array'=> $array]);

    }    
 
    function create(Request $re) {        
    
        return view('app/team/create');

    }    

    function store(Request $re) {        
               
        $re->merge(['img'               => 'moment']);              

        $obj = Team::create($re->all());
      
        $this->updatePhoto($obj, $re);
        
        return redirect('admin/equipo')->with('msj', 'Integrante del equipo registrado');
        
    }   

    function edit($id) {        
        $obj = Team::find($id);
        return view('app/team/edit')->with('obj', $obj);

    }    

    public function update(Request $re, $id) {
                
        
        // $re->merge(['active'            => ParserRequest::stringToBoolean($re->active)]);        

        $obj = Team::find($id);        
        $obj->update( $re->all() );
        
        $this->updatePhoto($obj, $re);

        return back()->with('msj', 'Información actualizada');        

    }

    function destroy($id)
    {
        
        $obj = Team::find($id);
        File::delete(Team::$imgFolder . $obj->img);        
        $obj->delete();
        
        return response()->json(null);
        
    }

    private function updatePhoto($obj, $re) {
        
        if($re->hasFile('imgFile')) {

            if($obj->img != NULL) {
                File::delete(Team::$imgFolder . $obj->img);
            }

            $imgFile = $re->file('imgFile');
            $path = "$obj->id" . "_" . time() . "." . $imgFile->getClientOriginalExtension();

            $image = Image::make($imgFile->getRealPath());

            if ($image->width() > 1080 || $image->width() > 1920) { 
                $image->fit(1920, 1080);     
            }

            $image->save(Team::$imgFolder . $path);

            $obj->img = $path;
            $obj->save();

        }

    }
}
