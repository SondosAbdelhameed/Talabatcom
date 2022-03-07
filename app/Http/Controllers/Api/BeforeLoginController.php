<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Cms;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Restaurant;

use App\Models\MenuCategory;

class BeforeLoginController extends Controller
{

    public function about_us() {
        $data["about_us"] = Cms::find(1);
        return $this->toJson($this->code_success,$this->msg_success,$data);
    }

    public function terms() {
        $data["terms"] = Cms::find(2);
        return $this->toJson($this->code_success,$this->msg_success,$data);
    }

    public function faqs() {
        $data["faqs"] = Faq::all();
        return $this->toJson($this->code_success,$this->msg_success,$data);
    }

    public function categories() {
        $data["categories"] = Category::all();
        return $this->toJson($this->code_success,$this->msg_success,$data);
    }

    public function restaurants() {
        $data['restaurants'] = Restaurant::with('categories')->get();
        return $this->toJson($this->code_success,$this->msg_success,$data);
    }

    public function restaurant_details($id) {
        $data['restaurant_details'] = Restaurant::with('images', 'categories', 'area','reviews')->find($id);
        $menu_group = MenuCategory::whereHas('menu',function($q) use($id){
            $q->where('restaurant_id',$id);
        })->get(); 
        $menu = $menu_group->load(['menu'=>function($q) use($id){
            $q->where('restaurant_id',$id);
        }]);
        $data['restaurant_details']->menu_group = $menu;
       
        return $this->toJson($this->code_success,$this->msg_success,$data);
    }


}
