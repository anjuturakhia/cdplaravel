<?php

namespace App\Http\Controllers;

use App\Register;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class RegisterController extends Controller
{
    //

    public function doregister(JWTAuth $JWTAuth,Request $req){

        $data = new Register();

        $validate = $data->validateRegister($req);
        if($validate->fails())
        {
            return response()->json([
                'message'=>$validate->errors(),
                'status'=>'false',
                'status_code'=>403
            ]);
        }else{

            $response = $data->registration($JWTAuth,$req);

            return response()->json([
                'status' => true,
                'token' => $response,
                'status_code' => 200,
                'message' => 'Customer created successfully!!!!'

            ]);


        }



    }


}
