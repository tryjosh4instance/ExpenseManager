<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next) //to prevent the user from accessing the admin's dashboard
    {
        if(Auth::user()->usertype == 'admin')
        {
            return $next($request); //redirect the admin to the admin panel
        }
        else
        {
            return redirect('/home')->with('status','You are not allowed in the Admin Dashboard');
        }
    }
}
