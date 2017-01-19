<?php

namespace Leafr\Commerce\Http\Controllers;

use Leafr\Commerce\ProductVariationGroup;
use Leafr\Commerce\ProductVariation;
use Leafr\Commerce\Product;

use Leafr\Commerce\Http\Requests\StoreProduct;
use Leafr\Core\Http\Controllers\Controller as Controller;

/**
 * Class AdminProductsController
 * @package Leafr\Http\Controllers\BackOffice\Store
 *
 * @Resource("back-office/products")
 * @Middleware("auth")
 */
class ProductsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::take(30)->get();

        return view('leafr.commerce::products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('leafr.commerce::products.create', [
            'product' => new Product
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProduct $request)
    {

        $product = new Product;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->description = $request->description;
        $product->product_type_id = $request->product_type_id;
        $product->is_online = $request->is_online;
        $product->supplier_id = $request->supplier_id;
        $product->brand_id = $request->brand_id;

        $product->unit_price = $request->unit_price;
        $product->sale_price = $request->sale_price;
        $product->cost_price = $request->cost_price;


        if(!$request->has_variations)
        {
            $product->has_variations = 0;
            $product->sku = $request->sku;
            $product->weight = $request->weight;

            $product->save();

            $product->addSku([
                'product_id' => $product->id,
                'sku' => $product->sku,
                'unit_price' => $product->unit_price,
                'sale_price' => $product->sale_price,
                'cost_price' => $product->cost_price,
                'weight'    => $product->weight,
            ]);
        }

        $product->save();

        foreach($request->file('media') as $file) {
            $product->addMedia($file);
        }

        return redirect()->route('commerce.products.edit', $product->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);

        return view('leafr.commerce::products.edit' , compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProduct $request, $id)
    {

        $product = Product::find($id);

        if(!$product->update($request->all())) {
            return 'error';
        }

        /* foreach($request->file('media') as $file) { */
        /*     $product->addMedia($file); */
        /* } */

        flash('Congratulations! Your product has been updated successfully', 'success');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    function generateSlug($slug, $listOfSlugs = [], $append)
    {
        if(!in_array($slug, $listOfSlugs)) {
            return $slug;
        } else {
            if(is_numeric($slug[strlen($slug)-1])) {
                $slugNew = substr($slug, 0 , strlen($slug)-1) . $append;
            } else {
                $slugNew = $slug .'-'. $append;
            }

            return $this->generateSlug($slugNew, $listOfSlugs, $append + 1);
        }

    }

}
