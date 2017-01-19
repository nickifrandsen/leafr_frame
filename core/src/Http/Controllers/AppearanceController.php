<?php

namespace Leafr\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AppearanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->block == 'product_card')
        {
            $title = 'Product Card';
            $path = resource_path('views/products/card.blade.php');
        }

        if ($request->block == 'article_card')
        {
            $title = 'Article Card';
            $path = resource_path('views/posts/card.blade.php');
        }

        $contents = File::get($path);

        return view('leafr.core::appearance.index', compact('contents', 'title'));
    }

    public function update(Request $request)
    {

        if ($request->block == 'product_card')
        {
            $title = 'Product Card';
            $path = resource_path('views/products/card.blade.php');
        }

        File::put($path, $request->content);

        return back();
    }

}
