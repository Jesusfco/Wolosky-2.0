<?php

namespace Wolosky\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Wolosky\Sale;
use Wolosky\SaleDescription;
use Wolosky\Product;
use Wolosky\Cash;
use Wolosky\SaleDebt;
use Wolosky\User;
use Wolosky\Receipt;

use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\DB;
use Wolosky\CashboxHistory;

class SaleController extends Controller
{
    public function __construct(){ $this->middleware('adminCashier'); }

    public function storeSale(Request $request) {
        
        $user = JWTAuth::parseToken()->authenticate();        
        
        $sale = $this->newSale($request, $user);                     
                
        $array = [];
        foreach($request->description as $description){
            
            $description['sale_id'] = $sale->id;            
            unset($description['product']);
            unset($description['modify']);
            $array[] = $description;            
            $this->decrementStock($description);            

        }    

        SaleDescription::insert($array);
        
        if($sale->type == 3) {            
            $debt = new SaleDebt();
            $debt->user_id =  $request->saleDebt['user_id'];
            $debt->sale_id = $sale->id;            
            $debt->status = 1;        
            $debt->save();  
        } else {
            Cash::add($sale->getTotal());

            $receipt = new Receipt();
            $re = (object) $request->receipts[0];

            $receipt->creator_id = $user->id;
            $receipt->sale_id = $sale->id;
            $receipt->payment = $re->payment;
            $receipt->amount = $re->amount;
            $receipt->type = 0;
            $receipt->save();
            $sale->receipt = $receipt;
        }
                
        return response()->json($sale);

    }    

    public function newSale($request, $user){
        $sale = new sale();                
        $sale->creator_id = $user->id;
        $sale->created_at = $request->created_at;
        $sale->type = $request->type;       
        $sale->save();
        return $sale;
    }     

    public function decrementStock($description){        
        Product::find($description['product_id'])->decrement('stock', $description['quantity']);
    }

    public function storeSaleOutService(Request $request){
        $user = JWTAuth::parseToken()->authenticate(); 
        
        foreach($request->sales as $sale){

            $sale = (object) $sale;

            $re = new Request();
            $re->created_at = $sale->created_at;
            $re->description = $sale->description;
            $re->receipts = $sale->receipts;
            if(isset($sale->saleDebt))
                $re->saleDebt = $sale->saleDebt;
            $re->type = $sale->type;
            
            $this->storeSale($re);            
        }        

        return response()->json(true);
        
    }    

    public function getSales(){
        
        $date = $this->today();
        
        $sales = Sale::where('created_at', 'LIKE', $date . "%")
                        ->orderBy('created_at', 'DESC')
                        ->with('description')
                        ->get();                 
        
        $sales = $this->pushDescription($sales);

        return response()->json($sales);

    }

    public function postSales(Request $request){
        
        $user = JWTAuth::parseToken()->authenticate(); 
        
        
        $sales = Sale::whereBetween('created_at', [$request->from . " 00:00:00", $request->to . " 23:59:59"])
                        ->orderBy('created_at', 'DESC')
                        ->with('description:price,quantity,sale_id')
                        ->paginate($request->per_page);                
        
        return response()->json($sales);
    }

   
    public function showSale($id){
        
        
        $sale = Sale::where('id', $id)->with(['description.product', 'creator', 'receipts.creator', 'saleDebt'])->first();                                

        return response()->json($sale);
    }
    
    public function delete(Request $re) {
        $sale = Sale::find($re->id);

        if($re->type == 1) {
            
            $history = CashboxHistory::latest()->with('creator')->first();

            $receipt = Receipt::where('sale_id', $sale->id)->get()->first();

            if(Carbon::parse($sale->created_at)->gte(Carbon::parse($history->created_at)) &&
                $receipt->payment_type == 0){
                Cash::substract($sale->getTotal());
            }

            

        }
            
        
        // $sale->delete();

        return response()->json(true);

    }

    public function sugestDebt(Request $request) {
        $users = User::where('name', 'LIKE', '%'. $request->keyword .'%')->select('id','name')->get();
        return response()->json($users);
    }
}
