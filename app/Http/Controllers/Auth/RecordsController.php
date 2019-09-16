<?php

namespace Wolosky\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Record;

class RecordsController extends Controller
{

    public function __construct() {  
        $this->middleware('admin'); 
    }

    public function list(Request $re) {
        
        $records = Record::whereBetween('date', [$re->from, $re->to])
        ->orderBy('date', 'DESC')->whereHas('user', function ($query) use ($re) {
            $query->where('name', 'LIKE', "%$re->name%");
        })->with(['user:name,id,user_type_id,status'])->paginate($re->items);
    

        return response()->json($records);
    }

    
    public function delete(Request $re) {
        
        Record::whereBetween('date', [$re->from, $re->to])
        ->whereHas('user', function ($query) use ($re) {
            $query->where('name', 'LIKE', "%$re->name%");            

            if($re->type == 1) //TRABAJADORES
                $query->whereBetween('user_type_id', [2,4]);

            if($re->type == 2) //GIMNASTAS
                $query->where('user_type_id', 1);
        })->delete();
    

        return response()->json(true);
        
    }
}
