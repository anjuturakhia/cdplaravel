<?php

namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Facades\JWTAuth;
class customer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       // dd(auth()->user()->id);

        $user = JWTAuth::parseToken()->authenticate();

        $rolecheck = \DB::table('assigned_roles')
            ->where('user_id',$user->id)
            //->where('role_id',2)
            ->value('role_id')

        ;

        if($rolecheck == 2 || $rolecheck == 1){
            return $next($request);
        }else{
            return response()->json(['status' => 'Invalid User']);
        }



    }
}
