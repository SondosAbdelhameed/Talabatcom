<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $categories = Category::paginate(10);
      return view('admin.category', compact('categories'));
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
      $category = new Category;
      $category->name_en = $request->name_en;
      $category->name_ar = $request->name_ar;

      $request->validate([
         'name_en' => 'required|max:50',
         'name_ar' => 'required|max:50',
         'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       ],[

        'name_en.required' =>'name_en is required',
        'name_en.max' =>'name_en must be max 50',
        'name_ar.required' =>'name_ar is required',
        'name_ar.max' =>'title must be max 150',
        'icon.required' =>'icon limit is required',
        'icon.mimes' =>'upload a valid icon please',
        'icon.max' =>'icon is too large',
     ]);

     $iconName = time().'.'.$request->icon->extension();

     $request->icon->move(public_path('data/category'), $iconName);
     $category->icon = $iconName;
     $category->save();

     return redirect()->back()->with('message', 'Added successfully');

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
