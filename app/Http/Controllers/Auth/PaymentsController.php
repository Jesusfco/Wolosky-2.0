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
        return response()->json(Payment::orderBy('date_to', 'DESC')
                        ->paginate($request->items));
    }

    public function dataToProcess(Request $request) {

        $records = Record::whereBetween('date', [$request->from, $request->to])->get();
        $users = User::whereBetween('user_type_id',[2,5])->where('status', 1)->with(['salary', 'schedules'])->get();

        return response()->json(['users' => $users, 'records' => $records ]);

    }

    public function insertRecords() {

        for($i = 0; $i < 15; $i++) {

            $record = new Record();
            $record->user_id = 137;
            $record->date = "2018-10-" . ($i + 1);
            $record->checkIn = "01:00:00";
            $record->checkOut = "23:00:00";
            $record->save();
            
        }

        for($i = 0; $i < 15; $i++) {

            $record = new Record();
            $record->user_id = 136;
            $record->date = "2018-10-" . ($i + 1);
            $record->checkIn = "01:00:00";
            $record->checkOut = "23:00:00";
            $record->save();

        }
    }


}
