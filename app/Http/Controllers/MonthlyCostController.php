<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\MonthlyPrices;

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
}
