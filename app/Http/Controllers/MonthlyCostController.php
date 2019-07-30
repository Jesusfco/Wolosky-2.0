<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\MonthlyPrices;
use Wolosky\MonthlyPayment;
use Wolosky\User;

class MonthlyCostController extends Controller
{
    public function __construct(){ 
        $this->middleware('adminCashier');
        $this->middleware('admin', ['only' => ['update', 'delete', 'store']]); 
    }

    public function get() {
        return response()->json(MonthlyPrices::orderBy('hours', 'ASC')->get());
    }

    public function store(Request $request) {
        

        $this->validate($request, [
            'hours' => 'required|unique:monthly_prices',
            'cost' => 'required'
        ]);

        $monthlyCost = new MonthlyPrices();

        $monthlyCost->hours = $request->hours;
        $monthlyCost->cost = $request->cost;

        $monthlyCost->save();

        return response()->json($monthlyCost);

    }

    public function update(Request $request) {        

        $this->validate($request, [
            'id' => 'required',
            'hours' => 'required',
            'cost' => 'required'
        ]);

        $monthlyCost = MonthlyPrices::find($request->id);

        $monthlyCost->hours = $request->hours;
        $monthlyCost->cost = $request->cost;

        $monthlyCost->save();

        return response()->json($monthlyCost);

    }

    public function delete($id) {

        $monthlyCost = MonthlyPrices::find($id);
        $monthlyCost->delete();

        return response()->json(true);

    }

    public function show($id) {
                
        return response()->json(MonthlyPrices::find($id));

    }

    public function getStudentsSchedules() {
        $users = User::where([
            ['user_type_id', 1],
            ['status', 1]
            ])->with(['schedules', 'monthlyPayment'])->get();
        return response()->json($users);
    }

    public function updateMonthlyPayment(Request $re) {
        foreach($re->array as $monthly) {
            MonthlyPayment::where('id', $monthly['id'])->update(['amount' => $monthly['amount'] ]);
        }

        return response()->json(true);
    }

}
