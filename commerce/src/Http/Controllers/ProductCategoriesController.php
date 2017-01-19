<?php

namespace Leafr\Commerce\Http\Controllers;

use Illuminate\Http\Request;
use Leafr\Commerce\Product;
use Leafr\Core\Http\Controllers\Controller as Controller;

class ProductCategoriesController extends Controller
{


    public function index($productId)
    {

        $product = Product::find($productId);
        $categories = \Leafr\Core\Category::all();

        return view('leafr.commerce::products.categories.index', compact('product', 'categories'));
    }

   
    public function store($productId, Request $request)
    {

        $product = Product::find($productId);

        foreach($request->category as $key => $value) 
        {

            if ($value == 1 && ! $product->categories()->where('category_id', $key)->first() )
            {
                $product->categories()->attach($key);
            } 

            if ($value == 0)
            {
                $product->categories()->detach($key);
            } 
           
        }
            
        flash('Congratulations! You have succesfully updated the product categories', 'success');

        return redirect()->back();

    }


    public function destroy($id)
    {
        //
    }
}
