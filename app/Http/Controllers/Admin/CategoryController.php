<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.pages.categories.index' , compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatdeData = $request->validate([
            'name' => 'required',
            'level' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg' 
        ]);
        $c = new ContentController();
        $image = $c->uploadImage($request , 'image');
        $validatdeData['image'] = $image;
        Category::create($validatdeData);
        return redirect(route('admin.category.index'))->with([
            'status' => 'success',
            'message' => 'مرحله اضافه شد'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('admin.pages.categories.edit' , ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validatdeData = $request->validate([
            'name' => 'required',
            'level' => 'required',
            'body' => 'required',
            'image' => 'mimes:jpeg,png,jpg'
        ]);
        $image = $category->image;
        if ($request->image) {
            $c = new ContentController();
            $image = $c->uploadImage($request, 'image');
        }
        $category->update([
            'name' => $validatdeData['name'],
	    'level' => $validatdeData['level'],
	    'body' => $validatdeData['body'],
            'image' => $image,
        ]);
        return redirect(route('admin.category.index'))->with([
            'status' => 'success',
            'message' => 'مرحله ویرایش شد'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect(route('admin.category.index'))->with([
            'status' => 'success',
            'message' => 'مرحله حدف شد'
        ]);
    }
}
