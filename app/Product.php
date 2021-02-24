<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\JWTAuth;

class Product extends Model
{
    //

    public function addProduct(JWTAuth $JWTAuth ,$req){
        $uploadd = $req->file('filetoUpload');
      //  dd($uploadd);


        $filename = $uploadd->getClientOriginalName('filetoUpload');
        $extension = $uploadd->getClientOriginalExtension('filetoUpload');
        $length = 6;
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $randomchars =  substr(str_shuffle($chars),0,$length);
        $newfilename = $randomchars.$filename;
        $path = public_path().'/products';
        $success = $uploadd->move($path,$newfilename);

       // dd($newfilename);

        $addproduct = \DB::table('products')->insertGetId
        ([
            'name'=>$req->title,
            'description'=>$req->description,
            'image'=>$newfilename,
            'price'=>$req->price,
            'discount_percent'=>$req->discountpercent,
            'status'=>1,
            'created_at'=>\Carbon\carbon::now(),
        ]);


        return $addproduct;





    }


    public function productlist($JwtAuth){


        $products = \DB::table('products')
            ->WhereNull('deleted_at')
           // ->where('status',1)
            ->orderBy('id','desc')
            ->get()

            ;

        return $products;


    }

    public function editproduct($req){

        $data = \DB::table('products')
            ->where('id',$req->id)
            ->first();

        if($data->image != null){
            $data->image = 'products/' . $data->image;
        }

        return $data;
    }

    public function updateproduct($req){

        $uploadd = $req->file('filetoUpload');

        if($uploadd != null){
            $filename = $uploadd->getClientOriginalName('filetoUpload');
            $extension = $uploadd->getClientOriginalExtension('filetoUpload');
            $length = 6;
            $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
            $randomchars =  substr(str_shuffle($chars),0,$length);
            $newfilename = $randomchars.$filename;
            $path = public_path().'/products';
            $success = $uploadd->move($path,$newfilename);

            $data = \DB::table('products')
                ->where('id',$req->id)
                ->update([
                    'image' => $newfilename,
                    'updated_at'=>\Carbon\carbon::now(),
                ]);

        }


        $data = \DB::table('products')
            ->where('id',$req->id)
            ->update([
                'name'=>$req->title,
                'description'=>$req->description,
                'price'=>$req->price,
                'discount_percent'=>$req->discountpercent,
                'status'=>1,
                'updated_at'=>\Carbon\carbon::now(),
            ]);



        return $data;

    }


    public function deleteproduct($req){

        $data = \DB::table('products')
            ->where('id',$req->id)
            ->update([

                'deleted_at'=>\Carbon\carbon::now(),
            ]);

        return $data;
    }


    public function disableproduct($req){

      //  dd($req->status);
        $data = \DB::table('products')
            ->where('id',$req->id)
            ->update([

                'status'=>$req->status,
            ]);

        return $data;

    }


    public function validateaddproduct($req){

        $validator = \Validator::make($req->all(),
            [
                'title' => 'required|unique:products,name,NULL,id,deleted_at,NULL',
                'filetoUpload' => 'required',
                'description' => 'required',
                'price' => 'required',
                'discountpercent' => 'required',
            ]
        );


        return $validator;

        }
}
