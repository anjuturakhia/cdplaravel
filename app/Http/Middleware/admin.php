<?php

namespace App\Http\Middleware;

use Closure;

use Tymon\JWTAuth\Facades\JWTAuth;
class admin
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
        $user = JWTAuth::parseToken()->authenticate();
      //  dd($user->id);
        $rolecheck = \DB::table('assigned_roles')
            ->where('user_id',$user->id)
            //->where('role_id',2)
            ->value('role_id')

        ;

      //  dd($rolecheck);
        if($rolecheck == 1){
            return $next($request);
        }else{
            return response()->json(['status' => 'Invalid User']);
        }


      //  return $next($request);
    }
}
