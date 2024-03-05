<?php

namespace App\Http\Middleware;

use Closure, Route, Auth;
use Illuminate\Http\Request;

class Permissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

     //=====TE SACA DEL APAGINA SI INGRESAS POR URL
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role == "1" && kvfj(Auth::user()->permissions, Route::currentRouteName()) == true):
        return $next($request);
        else:
            return redirect('/');
        endif;
    }
}
