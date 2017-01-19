<?php

namespace Leafr\Commerce\Http\Controllers;

use Leafr\Commerce\Product;
use Leafr\Commerce\ProductVariations;
use Illuminate\Http\Request;
use Leafr\Core\Http\Controllers\Controller as Controller;

class ProductVariationsController extends Controller
{
    public function index($productId)
    {

        $product = Product::findOrFail($productId);
        $variations = $product->variations->first();

        return view('leafr.commerce::products.variations.index', compact('product', 'variations'));
    }

    public function store($productId, Request $request)
    {
        $product = Product::findOrFail($productId);

        if( $request->has('variations') ) {

            for ($i = 1; count($request->get('variations')); $i++) {
                $product->createVariation($request->variations[$i]);
            }
        }

        if( $request->has('updateVariation') ) {
            foreach ($request->updateVariation as $variation) {
                if( $productVariation = ProductVariation::findOrFail($variation['id']) ) 
                {
                    $productVariation->update($variation);
                }
            }
        }

        return back();

    }

}
