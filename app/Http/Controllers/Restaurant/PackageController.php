<?php

namespace App\Http\Controllers\Restaurant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $packages = Package::with('restaurant')->whereHas('restaurant', function($query) {
      $query->where('user_id', '=', Auth::id());
      })->paginate(10);
      return view('restaurant.packages', compact('packages'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('restaurant.addPackageForm');
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
         'title_en' => 'required|max:50',
         'title_ar' => 'required|max:50',
         'description_en' => 'required|max:150',
         'description_ar' => 'required|max:150',
         'price' => 'required|numeric',
       ],[
        'image.required' =>'image limit is required',
        'image.mimes' =>'upload a valid image please',
        'image.max' =>'image is too large',
        'title_en.max' =>'title en must be max 50',
        'title_en.required' =>'title en is required',
        'title_ar.max' =>'title ar must be max 50',
        'title_ar.required' =>'title ar is required',
        'description_en.max' =>'description en must be max 150',
        'description_en.required' =>'description en is required',
        'description_ar.max' =>'description ar must be max 150',
        'description_ar.required' =>'description ar is required',
        'price.required' =>'price from is required',

  ]);
      $package = new Package;

      $getRestaurant = Restaurant::where('user_id', '=', Auth::id())->first();

      $package->restaurant_id = $getRestaurant->id;
      $package->title_en = $request->title_en;
      $package->title_ar = $request->title_ar;
      $package->description_en = $request->description_en;
      $package->description_ar = $request->description_ar;
      $package->price = $request->price;

      if(!empty($request->image)){

      $imageName = time().'.'.$request->image->extension();
      $request->image->move(public_path('admin/images'), $imageName);
      $package->image = $imageName;
      }
      $package->save();

      return redirect()->route('restaurantPackages.index');
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
      $package = Package::findOrFail($id);

      return view('restaurant.editPackageForm', compact('package'));
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
         'title_en' => 'required|max:50',
         'title_ar' => 'required|max:50',
         'description_en' => 'required|max:150',
         'description_ar' => 'required|max:150',
         'price' => 'required|numeric',
       ],[

        'image.mimes' =>'upload a valid image please',
        'image.max' =>'image is too large',
        'title_en.max' =>'title en must be max 50',
        'title_en.required' =>'title en is required',
        'title_ar.max' =>'title ar must be max 50',
        'title_ar.required' =>'title ar is required',
        'description_en.max' =>'description en must be max 150',
        'description_en.required' =>'description en is required',
        'description_ar.max' =>'description ar must be max 150',
        'description_ar.required' =>'description ar is required',
        'price.required' =>'price from is required',

  ]);

      $package = Package::findOrFail($id);

      $package->title_en = $request->title_en;
      $package->title_ar = $request->title_ar;
      $package->description_en = $request->description_en;
      $package->description_ar = $request->description_ar;
      $package->price = $request->price;
      if(!empty($request->image)){

      $imageName = time().'.'.$request->image->extension();
      $request->image->move(public_path('admin/images'), $imageName);
      $package->image = $imageName;
      }
      $package->save();

      return redirect()->route('restaurantPackages.index');
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
