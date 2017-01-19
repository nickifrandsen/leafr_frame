<?php

namespace Leafr\Core\Http\Controllers;

use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leafr.core::dashboard.index', compact('stats'));
    }

}
