<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\City;
use App\Models\Category;
use App\Models\Restaurant;

class ApiController extends Controller
{
    public function __construct(){
        parent::__construct();
       // $this->middleware('jwt');
    }

    public function get_cities(){
        $data['cities'] = City::where('country_id',1)->get();
        return $this->toJson(200,"Success",$data);  
    }

    public function get_categories(){
        $data['categories'] = Category::all();
        return $this->toJson(200,"Success",$data);  
    }

    public function get_restaurants($category_id){
        $data['restaurants'] = Category::find($category_id)->restaurants;
    //    $data['restaurants'] = Category::with('restaurants')->find($category_id);
        return $this->toJson(200,"Success",$data);  
    }


}
