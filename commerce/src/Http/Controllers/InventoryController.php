<?php

namespace Leafr\Commerce\Http\Controllers;

use Illuminate\Http\Request;
use Leafr\Commerce\Sku; 
use Leafr\Commerce\Inventory;
use Leafr\Core\Http\Controllers\Controller as Controller;

class InventoryController extends Controller
{

    public function index(Request $request)
    {

        if($request->has('q'))
        {
             $products = Sku::where('sku', 'like' , '%'. $request->q . '%');
             dd($products->get());
        }

        $transactions = Inventory::all();

        return view('leafr.commerce::inventory.index', compact('transactions'));
    }

}
