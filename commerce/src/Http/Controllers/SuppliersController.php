<?php

namespace Leafr\Commerce\Http\Controllers;

use Illuminate\Http\Request;
use Leafr\Http\Requests;
use Leafr\Commerce\Supplier;
use Leafr\Core\Http\Controllers\Controller as Controller;


/**
 * Class BOSuppliersController
 *
 * @Resource("back-office/suppliers")
 * @Middleware("auth")
 *
 * @package Leafr\Http\Controllers
 */
class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return view('leafr::store.suppliers.index', compact('suppliers'));
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
        if($supplier = Supplier::create($request->all())) {
            return response()->json([
                'heading'     => 'Yay...',
                'message'   => 'Leverandøren blev oprettet med success',
                'type'      => 'success',
                'callback'  => $supplier->id
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
