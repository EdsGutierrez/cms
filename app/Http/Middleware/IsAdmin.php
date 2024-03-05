<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class IsAdmin
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
        //condicional si el usuario tiene el mismo ROL
        if(Auth::user()->role == "1"):
            return $next($request);
        else:
            return redirect('/');
        endif;
            //
    }
}
