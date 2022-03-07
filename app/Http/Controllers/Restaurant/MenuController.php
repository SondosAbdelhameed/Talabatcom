<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;
use App\Models\MenuCategory;


class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $menus = Menu::with('restaurant', 'category')->whereHas('restaurant', function($query) {
      $query->where('user_id', '=', Auth::id());
      })->paginate(10);
      return view('restaurant.menu', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $menuCategory = MenuCategory::all();
      return view('restaurant.addMenuForm', compact('menuCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $request->validate([
         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         'category' => 'required',
         'item_en' => 'required|max:50',
         'item_ar' => 'required|max:50',
         'ingredients_ar' => 'required|max:150',
         'ingredients_en' => 'required|max:150',
         'price' => 'required|numeric',
         'ave_time' => 'required|numeric',
       ],[
        'image.required' =>'logo limit is required',
        'image.mimes' =>'upload a valid image please',
        'image.max' =>'image is too large',
        'category.required' =>'category is required',
        'item_en.max' =>'item en must be max 50',
        'item_en.required' =>'item en is required',
        'item_ar.max' =>'item ar must be max 50',
        'item_ar.required' =>'item ar is required',
        'ingredients_en.max' =>'ingredients en must be max 150',
        'ingredients_en.required' =>'ingredients en is required',
        'ingredients_ar.max' =>'ingredients ar must be max 150',
        'ingredients_ar.required' =>'ingredients ar is required',
        'price.required' =>'price from is required',
        'ave_time.required' =>'ave_time to is required',
        'ave_time.required' =>'ave_time is out of range',

  ]);
      $menu = new Menu;

      $getRestaurant = Restaurant::where('user_id', '=', Auth::id())->first();

      $menu->restaurant_id = $getRestaurant->id;
      $menu->category_id = $request->category;
      $menu->item_ar = $request->item_ar;
      $menu->item_en = $request->item_en;
      $menu->ingredients_ar = $request->ingredients_ar;
      $menu->ingredients_en = $request->ingredients_en;
      $menu->price = $request->price;
      $menu->ave_time = $request->ave_time;
      $menu->save();
      if(!empty($request->image)){
      $imageName = $menu->restaurant_id.'_'.$menu->id.'_'
                    .(Carbon::now())->format('YmdHis').'.'.$request->image->extension();
      $request->image->move(public_path('data/restaurant/menu'), $imageName);
      $menu->image = $imageName;
      $menu->save();
      }

      return redirect()->route('restaurantMenu.index');
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
      $menuCategory = MenuCategory::all();

      $menu = Menu::with('restaurant', 'category')->find($id);

      return view('restaurant.editMenuForm', compact('menuCategory', 'menu'));
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
      $request->validate([
         'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         'category' => 'required',
         'item_en' => 'required|max:50',
         'item_ar' => 'required|max:50',
         'ingredients_ar' => 'required|max:150',
         'ingredients_en' => 'required|max:150',
         'price' => 'required|numeric',
         'ave_time' => 'required|numeric',
       ],[
        'image.mimes' =>'upload a valid image please',
        'image.max' =>'image is too large',
        'category.required' =>'category is required',
        'item_en.max' =>'item en must be max 50',
        'item_en.required' =>'item en is required',
        'item_ar.max' =>'item ar must be max 50',
        'item_ar.required' =>'item ar is required',
        'ingredients_en.max' =>'ingredients en must be max 150',
        'ingredients_en.required' =>'ingredients en is required',
        'ingredients_ar.max' =>'ingredients ar must be max 150',
        'ingredients_ar.required' =>'ingredients ar is required',
        'price.required' =>'price from is required',
        'ave_time.required' =>'ave_time to is required',
        'ave_time.required' =>'ave_time is out of range',

  ]);
      $menu = Menu::findOrFail($id);

      $menu->category_id = $request->category;
      $menu->item_ar = $request->item_ar;
      $menu->item_en = $request->item_en;
      $menu->ingredients_ar = $request->ingredients_ar;
      $menu->ingredients_en = $request->ingredients_en;
      $menu->price = $request->price;
      $menu->ave_time = $request->ave_time;
      if(!empty($request->image)){

      $imageName = time().'.'.$request->image->extension();
      $request->image->move(public_path('admin/images'), $imageName);
      $menu->image = $imageName;
      }
      $menu->save();

      return redirect()->route('restaurantMenu.index');
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
