<?php

namespace Wolosky\Http\Controllers;

use Illuminate\Http\Request;
use Wolosky\Sale;
use Wolosky\SaleDescription;
use Wolosky\Product;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    public function __construct(){ 
        $this->middleware('adminCashier');
        $this->middleware('admin', ['only' => ['update', 'delete']]);     
    }

    public function getProducts(Request $request){
                
        $productos = Product::orderBy('name', 'ASC')->get();        
        return response()->json($productos);        

    }

    public function show($id){                
        $product = Product::find($id);
        return response()->json($product);
    }

    public function store(Request $request){
        
        $product = new Product();                

        $product->name = $request->name;
        $product->code = $request->code;
        $product->price_public = $request->price_public;
        $product->price_intern = $request->price_intern;
        $product->cost_price = $request->cost_price;
        $product->reorder = $request->reorder;
        $product->stock = $request->stock;
        $product->department =  $request->department;                
        $product->save();

        return response()->json($product);

    }

    public function update(Request $request){
        
        $product = Product::find($request->id);

        $product->name =  $request->name;
        $product->code = $request->code;
        $product->price_public = $request->price_public;
        $product->price_intern = $request->price_intern;
        $product->cost_price = $request->cost_price;
        $product->stock = $request->stock;
        $product->reorder = $request->reorder;
        $product->department = $request->department;

        $product->save();
                            
        return response()->json('product ' .$request->id . ' edited');
    }

    public function delete(Request $request, $id){
                        
        $descriptions = SaleDescription::where('product_id', $id)->get();
        
        foreach($descriptions as $x){
            $x->product_id = NULL;
            $x->product_name =  $request->name;
            $x->save();
        }

        Product::destroy($request->id);

        return response()->json('deleted');
    }
}
