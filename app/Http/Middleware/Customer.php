<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Customer
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

            //check if the logged in user is an admin and author
            if(Auth::user()->role->name == "Customer"){

               return $next($request);

            }

        }
        return redirect()->back()->with('error', 'You are not authorize to access this page, Please login to continue');
    }
}
