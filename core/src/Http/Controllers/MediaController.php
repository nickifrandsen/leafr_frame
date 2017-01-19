<?php

namespace Leafr\Core\Http\Controllers;

use Illuminate\Http\Request;
use Leafr\Commerce\Product;

class MediaController extends Controller
{

    public function store(Request $request)
    {
        $media = new Media;
    }

    public function destroy($id)
    {

    }

    public function reorder(Request $request)
    {

        if(!$request->medias)
        {
            return 'you need to define the media you want to sort.';
        }

        $order = 1;

        if ( $request->mediableType === 'Product' )
        {
            $mediableItem = Product::find($request->mediableId);
        }

        if ( $request->mediableType === 'Portfolio' )
        {
            $mediableItem = Portfolio::find($request->mediableId);
        }

        foreach($request->medias as $media)
        {
            $mediableItem->medias()->updateExistingPivot($media, ['order' => $order]);
            $order++;
        }

        return 'Media order updated';
    }

}
