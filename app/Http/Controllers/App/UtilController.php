<?php

namespace Wolosky\Http\Controllers\App;

use Illuminate\Http\Request;
use Wolosky\Http\Controllers\Controller;

use Wolosky\User;
use Wolosky\Receipt;
use Wolosky\MonthlyPrices;
use Wolosky\Parking;

class UtilController extends Controller
{
    public function dashboard() {

        $users1 = User::whereColumn('created_at', '=', 'updated_at')->where('user_type_id', '<=', '4')->orderBy('created_at', 'DESC')->limit(15)->get();
        $users2 = User::whereColumn('created_at', '!=', 'updated_at')->where('user_type_id', '<=', '4')->orderBy('created_at', 'DESC')->limit(15)->get();
        $receipts = Receipt::with('user')->orderBy('created_at', 'DESC')->limit(15)->get();
        $parking = Parking::with('user')->orderBy('created_at', 'DESC')->limit(15)->get();
        $monthlyPrices = MonthlyPrices::orderBy('hours', 'DESC')->get();

        return response()->json([
            'usersLastCreated' => $users1,
            'usersLastUpdated' => $users2,
            'receipts' => $receipts,
            'parking' => $parking,
            'monthlyPrices' => $monthlyPrices,
        ]);

    }
}
