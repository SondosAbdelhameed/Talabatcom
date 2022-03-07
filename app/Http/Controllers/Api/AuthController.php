<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use JWTAuth;
use Password;
Use Hash;

class AuthController extends Controller
{

    public function __construct(){
        parent::__construct();
        $this->middleware('jwt', ['only' => ['profile','logout']]);

    }

    public function createApiregister(Request $request) {
        $data = null;
        $validator = Validator::make($request->all(), [
            'name_ar' => 'required|string|between:2,100',
            'name_en' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'phone' => 'required|string|max:15',
        ]);

        if($validator->fails()){
            $error = $validator->errors();

            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);

        }

        $user = new User();
        $user->name_en = $request->name_en;
        $user->name_ar = $request->name_ar;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->user_type_id = 3;
        $user->password = Hash::make($request->password);
        $user->save();
        $token = JWTAuth::fromUser($user);
        $user->token = $token;
        $data["user"] = $user;

        return $this->toJson($this->code_success,$this->msg_success, $data);
    }

    public function login(Request $request){
        $data = null;
        $valid = Validator::make($request->all(),[
            'email' => 'required',
            'password' => 'required'
        ]);

        if($valid->fails()){
            $error = $valid->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }else{
            $credentials = $request->only(['email', 'password']);

            if (! $token = JWTAuth::attempt($credentials)) {
                return $this->toJson(402,$this->msg_general_error,null);
            }else{
                $user = Auth::user();
                $user->token = $token;
                $user->token_type = 'bearer';
                $user->expires_in = auth('api')->factory()->getTTL() * 60;
                $data["user"] = $user;

                return $this->toJson($this->code_success,$this->msg_success,$data);
            }
		}

    }

    public function forget() {
        $credentials = request()->validate(['email' => 'required|email']);

        Password::sendResetLink($credentials);

        return $this->toJson($this->code_success,'Reset password link sent on your email id.',null);
    }

    public function reset() {
        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return $this->toJson(400,"Invalid token provided",null);
        }

        return $this->toJson($this->code_success,"Password has been successfully changed",null);
    }

    public function profile()
    {
        return $this->toJson($this->code_success,$this->msg_success,auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return $this->toJson($this->code_success,$this->msg_success,null);
    }

    public function edit_image(Request $request){
        $valid = Validator::make($request->all(),[
            'image' => 'required',
        ]);

        if($valid->fails()){
            $error = $valid->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }else{

            if(auth()->user()->profile_photo_path == null){
                $img = 'user_'.auth()->user()->id.'_'
                    .(Carbon::now())->format('YmdHis').'.'.$request->image->extension();
                auth()->user()->profile_photo_path = $img;
                auth()->user()->save();
            }

            $request->image->move('data/user/',auth()->user()->profile_photo_path);

            return $this->toJson($this->code_success,$this->msg_success,null);
        }
    }

    public function edit_phone(Request $request){


        $valid = Validator::make($request->all(),[
            'phone' => 'required',
        ]);

        if($valid->fails()){
            $error = $valid->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }else{

            auth()->user()->phone = $request->phone;
            auth()->user()->save();

            return $this->toJson($this->code_success,$this->msg_success,null);
        }
    }

    public function edit_password(Request $request){


        $valid = Validator::make($request->all(),[
            'old_password' => 'required',
            'new_password' => 'required',
        ]);

        if($valid->fails()){
            $error = $valid->errors();
            return $this->toJson($this->code_data_error,$this->msg_data_error,$error);
        }else{
            if(Hash::check($request->old_password, auth()->user()->password)){
                auth()->user()->password = Hash::make($request->new_password);
                auth()->user()->save();
                return $this->toJson($this->code_success,$this->msg_success,null);

            }else{
                return $this->toJson(402,"old password is wrong",null);
            }
            

        }
    }
}
