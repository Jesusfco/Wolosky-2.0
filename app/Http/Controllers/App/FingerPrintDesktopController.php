<?php

namespace Wolosky\Http\Controllers\App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;
use Wolosky\Receipt;
use Wolosky\Record;
use Wolosky\Schedule;

class FingerPrintDesktopController extends Controller
{
    public function getInitData() 
    {
        
        $schedules = Schedule::whereHas('user', function($query){
            $query->where('status', 1);
        })->get();

        $records = Record::where('date', Carbon::now()->toDateString())->get();

        $receipts = Receipt::where([
            ['month', date('n')],
            ['year', date('Y')],
            ])->get();        

        return response()->json([ 
            // 'schedules' => $schedules
            // 'records' => $records
            'receipts' => $receipts
        ]);
    }

    public function putRecord(Request $request) 
    {

    }

}
