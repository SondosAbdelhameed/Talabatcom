<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use JWTAuth;

class OrderController extends Controller
{

    public function index(Request $request) {
       // return $request;
        $validator = Validator::make($request->all(), [
            'status' => 'required|numeric',
        ]);

        if($validator->fails()){
            $error = $validator->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }

      $data["orders"] = Order::with('restaurant')->where('status',$request->status)->where('user_id', auth()->user()->id)->get();
      //$data["orders"] = Order::with('restaurant')->where('user_id', auth()->user()->id)->get();

      return $this->toJson($this->code_success,$this->msg_success,$data);

  }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'restaurant_id' => 'required|numeric',
            'cost_before_tax' => 'required|numeric',
            'tax' => 'required|numeric',
            'delivered_time' => 'required',
            'notes' => 'string|max:100',
            'payment_type' => 'required|numeric',
        ]);

        if($validator->fails()){
            $error = $validator->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }

        $order = new Order();

        $order->user_id = auth()->user()->id;
        $order->restaurant_id = $request->restaurant_id;
        $order->order_number = Order::max('order_number') + 1;
        $order->cost_before_tax = $request->cost_before_tax;
        $order->tax = $request->tax;
        $order->delivered_time = $request->delivered_time;
        $order->notes = $request->notes;
        $order->payment_type = $request->payment_type;
        $order->status = 1;
        $order->save();

        foreach ($request->items as $item) {
            $orderItems = new OrderItem;
            $orderItems->order_id = $order->id;
            $orderItems->menu_item_id = $item['menu_item_id'];
            $orderItems->price = $item['price'];
            $orderItems->quantity = $item['quantity'];
            $orderItems->save();
        }

        return $this->toJson($this->code_success,$this->msg_success, null);

  }
}
