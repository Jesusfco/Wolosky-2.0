<?php

namespace Wolosky\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Payment;
use Wolosky\Record;
use Wolosky\User;


class PaymentsController extends Controller
{
    public function list(Request $request) {
        return response()->json(Payment::orderBy('date_to', 'DESC')->with('user')
                        ->paginate($request->items));
    }

    public function dataToProcess(Request $request) {

        $records = Record::whereBetween('date', [$request->from, $request->to])->orderBy('date', 'ASC')->get();
        $users = User::whereBetween('user_type_id',[2,5])->where('status', 1)->with(['salary', 'schedules'])->get();

        return response()->json(['users' => $users, 'records' => $records ]);

    }

    public function show($id) {
        return response()->json(Payment::where('id', $id)->with('user')->first());
    }

    public function update(Request $request) {
        
        $payment = Payment::find($request->id);
        $payment->amount = $request->amount;
        $payment->status = $request->status;
        $payment->save();

        return response()->json($payment);

    }   

    public function destroy($id){
        Payment::find($id)->delete();
        return response()->json(true);
    }

    public function storePayment(Request $request) {

        $payment = new Payment();
        $payment->user_id = $request->user_id;
        $payment->amount = $request->amount;
        $payment->status = 1;
        if($payment->amount == 0)
            $payment->status = 2;
        $payment->date_from = $request->date_from;
        $payment->date_to = $request->date_to;
        $payment->save();

        $payment->user = User::find($payment->user_id);

        return response()->json($payment);

    }

    public function insertRecords() {

        for($i = 0; $i < 15; $i++) {

            $record = new Record();
            $record->user_id = 137;
            $record->date = "2018-11-" . ($i + 1);
            $record->checkIn = "01:00:00";
            $record->checkOut = "23:00:00";
            $record->save();

        }

        for($i = 0; $i < 15; $i++) {

            $record = new Record();
            $record->user_id = 136;
            $record->date = "2018-11-" . ($i + 1);
            $record->checkIn = "01:00:00";
            $record->checkOut = "23:00:00";
            $record->save();

        }

        for($i = 0; $i < 15; $i++) {

            $record = new Record();
            $record->user_id = 26;
            $record->date = "2018-11-" . ($i + 1);
            $record->checkIn = "01:00:00";
            $record->checkOut = "23:00:00";
            $record->save();

        }
    }


}
