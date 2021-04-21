<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use App\User;
use Auth;

class CheckApiToken  extends Middleware
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
//        dd($request->input('api_token'));
        if(!empty(trim($request->input('api_token')))){

            $is_exists = User::where('id' , Auth::guard('api')->id())->exists();
            if($is_exists){
                return $next($request);
            }
        }
        return response()->json('Invalid Token', 401);
    }
}
