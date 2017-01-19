<?php

namespace Leafr\Core\Http\Controllers;

use Leafr\Core\Category;
use Leafr\Core\Http\Requests\StoreCategory;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::getTopLevelCategories();

        return view('leafr.core::categories.index', compact('categories'));
    }

    public function create()
    {
        return view('leafr.core::categories.create', [
            'categories' => new Category
        ]);
    }

    public function store(StoreCategory $request)
    {
        if($page = Category::create($request->all())) {

            flash('Congratulations! Your category has been created successfully', 'success');

            return back();
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
