<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Sale;
use Wolosky\SaleDescription;
use Wolosky\Product;
use Wolosky\Cash;
use Tymon\JWTAuth\Facades\JWTAuth;

class SaleController extends Controller
{
    public function __construct(){ $this->middleware('adminCashier'); }

    public function storeSale(Request $request){
        
        $user = JWTAuth::parseToken()->authenticate();        
        
        $sale = $this->newSale($request, $user);        
        $this->updateCash($sale);        
                
        foreach($request->description as $x){
            $this->newSaleDescription($x, $user, $sale);
            $this->decrementStock($x, $user);            
        }
                
        return response()->json($sale);
    }

    public function newSale($request, $user){
        $sale = new sale();        
        $sale->total = $request->total;
        $sale->creator_id = $user->id;
        $sale->created_at = $request->created_at;
        $sale->save();
        return $sale;
    }

    public function newSaleDescription($descriptionRequest, $user, $sale){
            $description = new SaleDescription();

            $description->sale_id = $sale->id;
            $description->product_id = $descriptionRequest['product_id'];
            $description->price = $descriptionRequest['price'];
            $description->quantity = $descriptionRequest['quantity'];
            $description->subtotal = $descriptionRequest['subtotal'];
            $description->save();
    }

    public function updateCash($sale){
        $cash = Cash::find(1);
        $cash->amount = $cash->amount + $sale->total;
        $cash->save();
    }

    public function decrementStock($x, $user){
        Product::find($x['product_id'])->decrement('stock', $x['quantity']);
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
         
                $this->newSaleDescription($x, $user, $sale);                
                $this->decrementStock($x, $user);

            }
            
        }
        return response()->json('sale description');
        
    }

    public function getSales(){
        
        $date = $this->today();
        
        $sales = Sale::where('created_at', 'LIKE', $date . "%")
                        ->orderBy('created_at', 'DESC')
                        ->get();

        if(!isset($sales[0]))
            return response()->json($sales);                        
        
        $sales = $this->pushDescription($sales);

        return response()->json($sales);
    }

    public function postSales(Request $request){
        
        $user = JWTAuth::parseToken()->authenticate(); 
        
        if(isset($request->to))
        $sales = Sale::whereBetween('created_at', [$request->from, $request->to . " 23:59:59"])
                        ->orderBy('created_at', 'DESC')
                        ->get();
        else {
            $sales = Sale::where('created_at', 'LIKE', $request->from . "%")
                            ->orderBy('created_at', 'DESC')
                            ->get();
        } 

        if(!isset($sales[0]))
            return response()->json($sales);

        $sales = $this->pushDescription($sales);
        
        return response()->json($sales);
    }

    public function pushDescription($sales){
        $z = count($sales);
        
        $description = SaleDescription::whereBetween('sale_id', [$sales[$z-1]->id, $sales[0]->id]);
        
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
}
