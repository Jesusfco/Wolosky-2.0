<?php

namespace Wolosky\Http\Controllers;

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
        
        if($sale->type == 3) {            
            $debt = new SaleDebt();
            $debt->user_id =  $saleDebt->user_id;
            $debt->sale_id = $saleDebt->sale_id;
            $debt->total = $saleDebt->total;
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
        }
                
        return response()->json($sale);

    }

    public function storeSaleDebt(Request $request) {

        $user = JWTAuth::parseToken()->authenticate();     

        $saleRequest =   json_decode(json_encode($request->sale), FALSE);            
        $saleDebt =   json_decode(json_encode($request->saleDebt), FALSE);

        $saleRequest->total = 0;
        $sale = $this->newSale($saleRequest, $user);   

        $saleDebt->sale_id = $sale->id;
        $this->createDebt($saleDebt);        

        $array = [];
        foreach($request->sale['description'] as $description){
            
            $description['sale_id'] = $sale->id;            
            unset($description['product']);
            unset($description['modify']);
            $array[] = $description;
            
            $this->decrementStock($description);            

        }    
        
        return response()->json(true);

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

            $description = $sale['description'];
            $sale = json_decode(json_encode($sale), FALSE);
            $sale = $this->newSale($sale, $user);
            $this->updateCash($sale);
            // array_push($salesReturn, $sale);
            
            foreach($description as $x){
         
                $this->newSaleDescription($x, $sale);                
                $this->decrementStock($x);

            }
            
        }
        return response()->json('sale description');
        
    }    

    public function getSales(){
        
        $date = $this->today();
        
        $sales = DB::table('sale')->where('created_at', 'LIKE', $date . "%")
                        ->orderBy('created_at', 'DESC')
                        ->get();                 
        
        $sales = $this->pushDescription($sales);

        return response()->json($sales);

    }

    public function postSales(Request $request){
        
        $user = JWTAuth::parseToken()->authenticate(); 
        
        if(isset($request->to))
        $sales = DB::table('sale')->whereBetween('created_at', [$request->from . " 00:00:00", $request->to . " 23:59:59"])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        else {
            $sales = DB::table('sale')->where('created_at', 'LIKE', $request->from . "%")
                            ->orderBy('created_at', 'DESC')
                            ->get();
        } 

        $sales = $this->pushDescription($sales);
        
        return response()->json($sales);
    }

    public function pushDescription($sales){

        $z = count($sales);
        
        $description = SaleDescription::whereBetween('sale_id', 
                                            [$sales[$z-1]->id, $sales[0]->id])
                                            ->get();

        for($x = 0; $x < count($sales); $x++){
            
            $sales[$x]->description = [];

            foreach($description as $desc){

                if( $sales[$x]->id == $desc->sale_id){
                    
                    $sales[$x]->description[] = $desc;

                }

            }

        }

        return $sales;
        
    }

    public function showSale($id){
        
        $sale = Sale::find($id);
        $sale->description = SaleDescription::where('sale_id', $id)->get();                                

        return response()->json($sale);
    }

    public function today(){
        $date = getdate()['year'] . '-';

        if(getdate()['mon'] < 10) 
            $date .= '0' . getdate()['mon'] . '-';
        else { $date .= getdate()['mon'] . '-'; } 

        if(getdate()['mday'] < 10 )
            $date .= '0' . getdate()['mday'];
        else { $date .= getdate()['mday']; }

        return $date;

    }

    public function sugestDebt(Request $request) {
        $users = User::where('name', 'LIKE', '%'. $request->keyword .'%')->select('id','name')->get();
        return response()->json($users);
    }
}
