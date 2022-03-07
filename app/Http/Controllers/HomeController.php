<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        if(auth()->user()->user_type_id == $this->admin_id){
            return redirect()->route('dashboard');
        }
        else if (auth()->user()->user_type_id == $this->restaurant_id) {
            return redirect()->route('restaurantDashboard');
        }
    }
}
