<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product ;
use App\Price_group ;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json(Product::all()) ;
    }

    public function store(Request $request)
    {
        $product = new Product ;
        $product->name = $request->input('name') ;
        $product->active = $request->input('active') ;
        $product->current_price = $request->input('currentPrice') ;
        $product->old_price = $request->input('oldPrice') ;
        $product->save() ;
        // new product with new price_group, just for testing Eloquent
        $price_group = new Price_group ;
        $price_group->store_id = $request->input('storeId') ;
        $res = $product->price_groups()->save($price_group) ;
        return response()->json([$res]) ;
    }

    public function show($id)
    {
        $product = Product::find($id) ;
        return response()->json([$product]) ;
    }

    public function update(Request $request, $id)
    {
        $newName = $request->input('newName') ;
        $product = Product::find($id);
        $product->name = $newName ;
        $product->save() ;
        return response()->json([$product]) ;
    }

    public function destroy($id)
    {
        $product = Product::where('id',$id)->delete() ;
        return response()->json(["product" => $product]) ;
    }
}
