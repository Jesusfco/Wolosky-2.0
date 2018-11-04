<?php

namespace Wolosky\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Record;

class RecordsController extends Controller
{

    public function __construct(){ $this->middleware('admin'); }

    public function list(Request $re) {
        $records = Record::whereBetween('date', [$re->from, $re->to])
        ->orderBy('date', 'DESC')
        ->with(['user:name,id,user_type_id,status'])->paginate($re->items);
    

        return response()->json($records);
    }
}
