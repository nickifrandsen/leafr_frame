<?php

namespace Leafr\Core\Http\Controllers;

use Leafr\Core\Setting;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();

        return view('leafr.core::settings.index', compact('settings'));
    }

    public function update(StorePage $request, $id)
    {
       
    }

}
