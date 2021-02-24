<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class ProductController extends Controller
{
    //

    public function addproduct(JWTAuth $JWTAuth, Request $req){

//        dd(1);
        $product = new Product();

        $validate = $product->validateaddproduct($req);
        if($validate->fails())
        {
            return response()->json([
                'message'=>$validate->errors(),
                'status'=>'false',
                'status_code'=>403
            ]);
        }else{


            $data = $product->addProduct($JWTAuth,$req);



            if($data)
            {
                return response()->json([
                    'message'=>'Product created successfully!',
                    'status' => 'true',
                    'status_code' => 200
                ]);
            }
            else{
                return response()->json([
                    'status' => 'false',
                    'status_code' => 403
                ]);
            }


        }




    }

    public function productlist(JWTAuth $JWTAuth){

        $product = new Product();

        $data = $product->productlist($JWTAuth);


        if($data)
        {
            return response()->json([
                'message'=>'Product created successfully!',
                'status' => 'true',
                'data'=>$data,
                'status_code' => 200
            ]);
        }
        else{
            return response()->json([
                'status' => 'false',
                'status_code' => 403
            ]);
        }



    }

    public function editproduct(Request $req){
//        dd($req);

        $product = new Product();

        $data = $product->editproduct($req);


        if($data)
        {
            return response()->json([
                'message'=>'Product data given successfully!',
                'status' => 'true',
                'data'=>$data,
                'status_code' => 200
            ]);
        }
        else{
            return response()->json([
                'status' => 'false',
                'status_code' => 403
            ]);
        }


    }

    public function updateproduct(JWTAuth $JWTAuth, Request $req){

        $product = new Product();

        $data = $product->updateproduct($req);


        if($data)
        {
            return response()->json([
                'message'=>'Product updated successfully!',
                'status' => 'true',
                'data'=>$data,
                'status_code' => 200
            ]);
        }
        else{
            return response()->json([
                'status' => 'false',
                'status_code' => 403
            ]);
        }


    }

    public function deleteproduct(JWTAuth $JWTAuth, Request $req){

        $product = new Product();

        $data = $product->deleteproduct($req);


        if($data)
        {
            return response()->json([
                'message'=>'Product deleted successfully!',
                'status' => 'true',
                'data'=>$data,
                'status_code' => 200
            ]);
        }
        else{
            return response()->json([
                'status' => 'false',
                'status_code' => 403
            ]);
        }

    }

    public function disableproduct(JWTAuth $JWTAuth,Request $req){

        $product = new Product();

        $data = $product->disableproduct($req);


        if($data)
        {
            return response()->json([
                'message'=>'Product disabled successfully!',
                'status' => 'true',
                'data'=>$data,
                'status_code' => 200
            ]);
        }
        else{
            return response()->json([
                'status' => 'false',
                'status_code' => 403
            ]);
        }


    }

}
