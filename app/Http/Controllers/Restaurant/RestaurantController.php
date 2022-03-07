<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\City;
use App\Models\Category;
use App\Models\RestaurantImage;
use App\Models\RestaurantCategory;

use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $restaurant = Restaurant::with('area', 'categories', 'images')->where('user_id', Auth::id())->first();
      return view('restaurant.profile', compact('restaurant'));
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
        //
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
      $restaurant = Restaurant::find($id);
      $restaurantImages = RestaurantImage::where('restaurant_id', $id)->get();
      return view('restaurant.editRestaurantForm', compact('restaurant', 'restaurantImages'));
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
         'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         'table_count' => 'required|numeric',
         'people_limit' => 'required|numeric',
       ],[
        'table_count.required' =>'table count is required',
        'people_limit.required' =>'people limit is required',
        'images.mimes' =>'upload a valid images please',
        'images.max' =>'image is too large',
  ]);
      $restaurant = Restaurant::findOrFail($id);

      $restaurant->table_count = $request->table_count;
      $restaurant->people_limit = $request->people_limit;

      if(!empty($request->images)){
        foreach($request->file('images') as $imag){
          $restaurantImage = new RestaurantImage;
          $imagesName = time().rand(10,1000).'.'.$imag->extension();

          $imag->move('data/restaurant/background', $imagesName);
          $restaurantImage->image = $imagesName;
          $restaurantImage->restaurant_id = $id;
          $restaurantImage->save();
        }
      }

      $restaurant->save();

      return redirect()->route('restaurantProfile.index');
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
