<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\HttpException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class Register extends Model
{
    //

    public function registration(JWTAuth $JWTAuth,$req){


        $user_id = \DB::table('users')
            ->insertGetId([
                'firstname'         =>  $req->firstname,
                'lastname'         =>  $req->lastname,
                'email'    =>  $req->email,
                'mobile'      =>  $req->mobile,
                'password'      =>  \Hash::make($req->password),
                'active'        =>  1,
                'created_at'    =>  \Carbon\Carbon::now()
            ]);


        $role = \DB::table('assigned_roles')
            ->insert([
                'user_id'         =>  $user_id,
                'role_id'         =>  $req->type,  //student
                'created_at'    =>  \Carbon\Carbon::now()
            ]);

//        $fourdigitrandom = rand(1000,9999);
//      //  echo $fourdigitrandom;
//
        $credentials = [];
        $credentials['email'] = strtolower($req->email);
        $credentials['password'] = $req->password;
        $credentials['active'] = 1;
        $credentials['deleted_at'] = NULL;



        try {

            $token = $JWTAuth->attempt($credentials);


            if (!$token)
            {

                return response()
                    ->json([
                        'status' => 'fail',
                        'token' => '',
                        'status_code' => 403,
                        'message' =>'Username or password invalid!'
                    ]);
            }
        }
        catch (JWTException $e)
        {
            throw new HttpException(500);
        }


        return $token;

    }

    public function validateRegister($req){

        if($req->type == 2){

            $validator = \Validator::make($req->all(),
                [
                    'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'mobile' => 'required|min:10|max:10',
                    'password' => 'required|min:6|max:10',
                ]
            );
        }else{


            $validator = \Validator::make($req->all(),
                [
                    'email' => 'required|unique:users,email,NULL,id,deleted_at,NULL',
                    'firstname' => 'required',
//                    'lastname' => 'required',
//                    'mobile' => 'required|min:10|max:10',
                    'password' => 'required|min:6|max:10',
                ]
            );
        }

        return $validator;

    }
}
