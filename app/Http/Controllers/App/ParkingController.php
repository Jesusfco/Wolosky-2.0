<?php

namespace Wolosky\Http\Controllers\App;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Parking;

class ParkingController extends Controller
{
    public function __construct(){ 
        $this->middleware('adminCashier'); 
        // $this->middleware('admin', ['only' => ['deleteUser', 'createSalary']]); 
    }

    public function get(Request $re) {

    }

    public function show($id) {
        $parking = Parking::find($id); 
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
        $parking->status = $re->status;

        $parking->amount = $re->amount;
        $parking->check_out = $re->check_out;
        $parking->save();

        return response()->json($parking);

    }

    public function update(Request $re) {

        $parking = Parking::find($re->id);                
        $parking->check_in = $re->check_in;
        $parking->date_entry = $re->date_entry;        
        $parking->status = $re->status;

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
