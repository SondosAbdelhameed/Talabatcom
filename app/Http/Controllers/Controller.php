<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $admin_id;
    public $restaurant_id;

    public $msg_success;
    public $code_success;
    public $msg_data_error;
    public $code_data_error;
    public $msg_general_error;

    public function __construct(){


        $this->admin_id = 1;
        $this->restaurant_id = 2;

        $this->msg_success = "Success";
        $this->msg_data_error = "Missing Some Request Data";
        $this->code_success= 200;
        $this->code_data_error = 400;
        $this->msg_general_error = "There is an error";
    }

    
    public function toJson($code,$message,$data){
        $status['code'] = $code;
        $status['message'] = $message;
        $response['status'] = $status;
        if($data != null)
            $response['data'] = $data;
        return response()->json($response,200);
    }
}
