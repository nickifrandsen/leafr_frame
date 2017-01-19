<?php 

namespace Leafr\Portfolio\Http\Controllers;

use Leafr\Portfolio\PortfolioItem;
use Illuminate\Http\Request;
use Leafr\Core\Http\Controllers\Controller as Controller;

class PortfolioController extends Controller
{
	public function index()
	{

		$items = PortfolioItem::all();

		return view('leafr.portfolio::portfolio.index', compact('items'));
	}

	public function batchCreate(Request $request)
	{
		
		
		foreach($request->file('media') as $file) {

			$item = (new PortfolioItem)->create(['title' => 'untitled', 'content' => '...']);

            $item->addMedia($file);

        }

        flash('Congrats! You have successfully created a new batch of portfolio items.', 'success');

		return redirect()->route('portfolio.portfolio.index');
	}

	public function create()
    {
    
        $item = new PortfolioItem;
        $users = \Leafr\Core\User::all();

        return view('leafr.blogging::portfolio.create', compact('item', 'users'));
    }

    public function store(Request $request)
    {

        $item = (new PortfolioItem)->create($request->all());

        foreach($request->file('media') as $file) {
            $item->addMedia($file);
        }

        flash('Congrats! You have successfully created a new portfolio item.', 'success');

        return redirect()->route('portfolio.portfolio.edit', [ 'id' => $post->id ]);
    }

    public function edit($id)
    {
        $item = PortfolioItem::find($id);
        $users = \Leafr\Core\User::all();

        return view('leafr.portfolio::portfolio.edit', compact('item', 'users'));
    }

    public function update(StorePost $request, $id)
    {

        $post = Post::find($id);

        $post->update($request->all());

        if($request->has('media')) 
        {
            foreach($request->file('media') as $file) {
                $post->addMedia($file);
            }
        }
        

        flash('Congrats! You have successfully updated the post.', 'success');

        return redirect()->back();
    }
}