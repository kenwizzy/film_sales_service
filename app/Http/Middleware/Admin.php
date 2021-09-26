<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //check if the user is logged in
        if(Auth::check()){

            //check if the logged in user is an admin
            if(Auth::user()->role->name == "Admin"){

               return $next($request);

            }

        }
        return redirect()->back()->with('error', 'You are not authorized to access this page, Please contact Admin');
    }
}
