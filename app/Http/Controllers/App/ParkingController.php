<?php

namespace Wolosky\Http\Controllers\App;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Parking;
use JWTAuth;

class ParkingController extends Controller
{
    public function __construct(){ 
        $this->middleware('adminCashier'); 
        // $this->middleware('admin', ['only' => ['deleteUser', 'createSalary']]); 
    }

    public function get(Request $re) {
        $parkings = Parking::where([
            ['created_at', '>', $re->from . " 00:00:00"],
            ['created_at', '<', $re->to . " 29:59:59"],
            ['user_id', 'LIKE', "%" . $re->id],
        ])->orderBy('created_at', 'DESC')->with(['user:id,name', 'creator:id,name'])->get();
        // ->paginate($request->items);

        return response()->json($parkings);
    }

    public function show($id) {

        $parking = Parking::where('id',$id)->with(['user:id,name', 'creator:id,name'])->first(); 

        if($parking == null) 
            return response()->json(['message' => 'Parking No Found'], 401);                

        return response()->json($parking);

    }

    public function store(Request $re) {

        $creator = JWTAuth::parseToken()->authenticate();
        $parking = new Parking();
        $parking->user_id = $re->user_id;
        $parking->creator_id = $creator->id;
        $parking->check_in = $re->check_in;
        $parking->date_entry = $re->date_entry;                
        $parking->amount = $re->amount;
        $parking->check_out = $re->check_out;
        $parking->save();

        return response()->json($parking);

    }

    public function update(Request $re) {

        $parking = Parking::find($re->id);                
        $parking->check_in = $re->check_in;
        $parking->date_entry = $re->date_entry;        
        $parking->paid = $re->paid;

        $parking->amount = $re->amount;
        $parking->check_out = $re->check_out;
        $parking->save();

        return response()->json($parking);

    }

    public function delete($id) {
        Parking::destroy($id);
        return response()->json(true);
    }

}
