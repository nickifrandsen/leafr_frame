<?php

namespace Leafr\Commerce\Http\Controllers;

use Illuminate\Http\Request;
use Leafr\Commerce\Product;
use Leafr\Commerce\Inventory;
use Leafr\Commerce\InventoryTransaction;
use Leafr\Core\Http\Controllers\Controller as Controller;

class ProductInventoryController extends Controller
{


    public function index($productId, Request $request)
    {

        $product = Product::find($productId);
        $transactions = Inventory::whereIn('sku' , $product->listSkus())->get();

        return view('leafr.commerce::products.inventory.index', compact('product', 'transactions', 'stock'));
    }

   
    public function store(Request $request)
    {

        foreach ($request->sku as $sku) {

            if( ! empty($request->amount[$sku]) AND $request->amount[$sku] != 0) {

                $product = \Leafr\Commerce\Sku::find($sku);

                (new InventoryTransaction)->transaction($request->amount[$sku])->price($request->price[$sku])->origin($request->origin[$sku])->make($product);

            }

        }

        flash('Congratulations! You have succesfully made an inventory transaction.', 'success');

        return redirect()->back();

    }


    public function destroy($id)
    {
        //
    }
}
