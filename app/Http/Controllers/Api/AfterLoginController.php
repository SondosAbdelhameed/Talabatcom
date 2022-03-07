<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;

use App\Models\Cms;
use App\Models\Faq;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Review;

class AfterLoginController extends Controller
{

    public function addFavorite(Request $request) {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|numeric',
        ]);

        if($validator->fails()){
            $error = $validator->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }

        $find = Favorite::where('restaurant_id',$request->restaurant_id)->first();
        if($find == ''){
            $favorite = new Favorite();
            $favorite->user_id = auth()->user()->id;
            $favorite->restaurant_id = $request->restaurant_id;
            $favorite->save();
        }else{
            Favorite::find($find->id)->delete(); 
        }
        return $this->toJson($this->code_success,$this->msg_success,null);
    }

    public function favorites() {
        $data["favorites"] = Favorite::with('restaurant')->where('user_id', auth()->user()->id)->get();
        return $this->toJson($this->code_success,$this->msg_success,$data);
    }

    public function addReview(Request $request) {
        $validator = Validator::make($request->all(), [
            'order_id' => 'required|numeric',
            'rate' => 'required|numeric',
            'review' => 'string|max:100',
        ]);

        if($validator->fails()){
            $error = $validator->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }

        $reviews = new Review();

        $reviews->order_id = $request->order_id;
        $reviews->user_id = auth()->user()->id;
        $reviews->rate = $request->rate;
        $reviews->review = $request->review;
        $reviews->save();

       return $this->toJson($this->code_success,$this->msg_success, null);

    }

}
