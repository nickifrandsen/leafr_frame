<?php

namespace Leafr\Core\Http\Controllers;

use Leafr\Core\Page;
use Leafr\Core\Http\Requests\StorePage;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Page::topLevel()->get();

        return view('leafr.core::pages.index', compact('pages'));
    }

    public function create()
    {
        return view('leafr.core::pages.create', [
            'page' => new Page
        ]);
    }

    public function store(StorePage $request)
    {
        if($page = Page::create($request->all())) {

            flash('Congratulations! Your page has been created successfully', 'success');

            return redirect()->route('core.pages.edit', $page->id);
        }


        flash('Oops! It looks like something went wrong while creating the page.', 'danger');

        return redirect()->back()->withErrors();
    }


    public function edit($id)
    {
        $page = Page::find($id);

        return view('leafr.core::pages.edit', compact('page'));
    }


    public function update(StorePage $request, $id)
    {
        $page = Page::find($id);

        if(!$page->update($request->all())) {
            flash('Oops! It looks like something went wrong while creating the page.', 'danger');

            return redirect()->back()->withErrors();
        }

        if($request->has('media')) {
            foreach($request->file('media') as $file) {
                $page->addMedia($file);
            }
        }

        flash('Congratulations! Your page has been updated.', 'success');

        return redirect()->back();
    }

    public function destroy()
    {

    }

}
