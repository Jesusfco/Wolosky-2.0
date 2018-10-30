<?php

namespace Wolosky\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Payment;
use Wolosky\Record;
// use

class PaymentsController extends Controller
{
    public function list(Request $request) {
        return response()->json(Payment::orderBy('date_to', 'DESC')
                        ->paginate($request->items));
    }

    public function dataToProcess(Request $request) {

    }


}
