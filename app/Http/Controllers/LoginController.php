<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;


class LoginController extends Controller
{
    //

    public function login(Request $request, JWTAuth $JWTAuth){


        // \Log::info(var_export($request->all(),true));
        // dd($request->all());

        $credentials = [];
        $credentials['email'] = strtolower($request->username);
        $credentials['password'] = $request->password;


        $token = $JWTAuth->attempt($credentials);

        if (!$token)
        {
            return response()
                ->json([
                    'status' => 'fail',
                    'token' => '',
                    'status_code' => 403,
                    'message' =>'Username or password invalid!',
                ]);



        }else{

            $details = \DB::table('users as u')
                ->join('assigned_roles as ar', 'u.id', '=', 'ar.user_id')
                ->select('ar.role_id')
                ->where('u.email', '=', $credentials['email'])
                ->first();


            if($details->role_id ==  $request->type){

                return response()
                    ->json([
                        'status' => 'success',
                        'token' => $token,
                        'status_code' => 200,
                        'message' =>'Logged in successfully!'

                    ]);

            }else{

                return response()
                    ->json([
                        'status' => 'failure',
                        'status_code' => 403,
                        'message' =>'Username or password incorrect or role did not match!!'

                    ]);

            }


        }


    }
}
