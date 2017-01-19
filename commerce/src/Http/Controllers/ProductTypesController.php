<?php

namespace Leafr\Commerce\Http\Controllers;

use Illuminate\Http\Request;
use Leafr\Commerce\ProductType;
use Leafr\Core\Http\Controllers\Controller as Controller;

class ProductTypesController extends Controller
{

    public function index(Request $request)
    {

        $types = ProductType::all();

        return view('leafr.commerce::product-types.index', compact('types'));
    }

}
