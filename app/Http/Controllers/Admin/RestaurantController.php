<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Area;
use App\Models\Category;
use App\Models\RestaurantCategory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $restaurants = Restaurant::with('area', 'categories', 'user')->paginate(10);
    return view('admin.restaurants', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    $areas = Area::all();
    $categories = Category::all();
    $users = User::where('user_type_id', 2)->get();
    return view('admin.addRestaurantForm', compact('areas', 'categories', 'users'));
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
       'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
       'username_en' => 'required|string|max:255',
       'username_ar' => 'required|string|max:255',
       'email' => 'required|string|email|unique:users|max:255',
       'name_en' => 'required|max:50',
       'name_ar' => 'required|max:50',
       'address' => 'required|max:150',
       'phone' => 'required|numeric',
       'category' => 'required',
       'area' => 'required',
       'table_count' => 'required|numeric',
       'people_limit' => 'required|numeric',
     ],[

      'username_en.required' =>'username is required',
      'username_ar.required' =>'username is required',
      'name_en.required' =>'name_en is required',
      'name_en.max' =>'name_en must be max 50',
      'name_ar.required' =>'name_ar is required',
      'name_ar.max' =>'title must be max 150',
      'address.required' =>'address is required',
      'address.max' =>'address must be max 150',
      'phone.required' =>'phone from is required',
      'category.required' =>'category to is required',
      'area.required' =>'area is required',
      'table_count.required' =>'table count is required',
      'people_limit.required' =>'people limit is required',
      'logo.required' =>'logo limit is required',
      'logo.mimes' =>'upload a valid image please',
      'logo.max' =>'image is too large',

]);

    $user = new User;
    $user->name_en = $request->username_en;
    $user->name_ar = $request->username_ar;
    $user->email = $request->email;
    $user->phone = $request->phone;
    $user->user_type_id = 3;
    $user->password = Hash::make($request->phone);
    $user->save();

    $restaurant = new Restaurant;
    $restaurant->user_id = $user->id;
    $restaurant->name_en = $request->name_en;
    $restaurant->name_ar = $request->name_ar;
    $restaurant->address = $request->address;
    $restaurant->phone = $request->phone;
    $restaurant->area_id = $request->area;
    $restaurant->table_count = $request->table_count;
    $restaurant->people_limit = $request->people_limit;

    $imageName = time().'.'.$request->logo->extension();

    $request->logo->move('data/restaurant/logo', $imageName);
    $restaurant->logo = $imageName;
    $restaurant->save();

    foreach($request->category as $categories)
{
    $restaurantCategory = new RestaurantCategory;
    $restaurantCategory->category_id = $categories;
    $restaurantCategory->restaurant_id = $restaurant->id;
    $restaurantCategory->save();

}
    return redirect()->route('restaurants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $restaurant = Restaurant::with('area', 'categories', 'user', 'menu')->where('id', $id)->first();
      return view('admin.restaurantDetails', compact('restaurant'));
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
