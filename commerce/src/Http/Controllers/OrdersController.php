<?php

namespace Leafr\Commerce\Http\Controllers;

use Leafr\Core\Settings;
use Leafr\Commerce\Order;
use Leafr\Core\Http\Controllers\Controller as Controller;

use Illuminate\Support\Facades\Response;



/**
 * Class BOOrdersController
 *
 * @Resource("back-office/orders", only={"index", "show", "edit", "update"})
 * @Middleware("auth")
 *
 * @package Leafr\Http\Controllers
 */
class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders =  Order::all();

        return view('leafr.commerce::orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order  = Order::find($id);

        return view('leafr.commerce::orders.show', compact('order'));
    }


    public function getGlsLabel($id) {
        $order  = Order::find($id);

        return $order->shippingLabel();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        
        if($order->updateStatus($request->get('status'))) {
            return redirect()->back();
        }
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
}
