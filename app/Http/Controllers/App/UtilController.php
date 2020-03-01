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

        $users1 = User::where('user_type_id', '<=', '4')->orderBy('created_at', 'DESC')->limit(15)->get();
        $users2 = User::whereColumn('created_at', '!=', 'updated_at')->where('user_type_id', '<=', '4')->orderBy('created_at', 'DESC')->limit(15)->get();
        $receipts = Receipt::with('user')->orderBy('created_at', 'DESC')->limit(15)->get();
        $parking = Parking::with('user')->orderBy('created_at', 'DESC')->limit(15)->get();
        $monthlyPrices = MonthlyPrices::orderBy('hours', 'DESC')->get();

        $pendUsers = User::where([
            ['user_type_id','=', 1], 
            ['status','=', 1]
        ])->with(['monthly_payment', 'receipts' => function($query) {
            $query->where('type',  1)->orderBy('created_at', 'DESC');                    
        }])->whereDoesntHave('receipts', function($query){                    
            $query->where([                                            
                ['type',  1],                                
                ['year', '=', date('Y')],
                ['month',  '=', date('n')],
            ]);        
        })->orderBy('name', 'ASC')
        ->select('id', 'user_type_id', 'name', 'birthday', 'monthly_payment_id')
        ->get();

        $regularUsers = User::where([
            ['user_type_id','=', 1], 
            ['status','=', 1]
        ])->with(['monthly_payment', 'receipts' => function($query){
            $query->where([
                                            
                ['type',  1],                                
                ['year', '=', date('Y')],
                ['month',  '=', date('n')],
            ]);   
        }])->whereHas('receipts', function($query) {                    
            $query->where([
                ['type',  1],                                
                ['year', '=', date('Y')],
                ['month',  '=', date('n')],
            ]);        
        })->orderBy('name', 'ASC')
        ->select('id', 'user_type_id', 'name', 'birthday', 'monthly_payment_id')
        ->get();

        return response()->json([
            'usersLastCreated' => $users1,
            'usersLastUpdated' => $users2,
            'receipts' => $receipts,
            'parking' => $parking,
            'monthlyPrices' => $monthlyPrices,
            'pendUsers' => $pendUsers,
            'regularUsers' => $regularUsers,
        ]);

    }

    public function dashboardDetails(Request $re) {

        $array = [];

        if($re->selection == 'usersLastCreated')

            $array = User::where('user_type_id', '<=', '4')->orderBy('created_at', 'DESC')->paginate(15);

        else if($re->selection == 'usersLastUpdated')

            $array = User::whereColumn('created_at', '!=', 'updated_at')->where('user_type_id', '<=', '4')->orderBy('created_at', 'DESC')->paginate(15);
        
        else if($re->selection == 'receipts')
        
            $array = Receipt::with('user')->orderBy('created_at', 'DESC')->paginate(15);
        
        else if($re->selection == 'parking')

            $array = Parking::with('user')->orderBy('created_at', 'DESC')->paginate(15);
        
        // else if($re->selection == 'usersLastCreated')

        //     $array = User::whereColumn('created_at', '!=', 'updated_at')->where('user_type_id', '<=', '4')->orderBy('created_at', 'DESC')->paginate(15);
        
        return response()->json($array);
    }
}
