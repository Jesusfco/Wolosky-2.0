<?php

namespace Wolosky\Http\Controllers;
use Wolosky\Cash;

use Illuminate\Http\Request;

class CashController extends Controller
{
    public function __construct(){ $this->middleware('admin'); }

    public function update(Request $request)
    {
        $cash = Cash::find(1);
        $cash->amount = $request->cash;
        $cash->save();

        return response()->json($cash);
    }
}
