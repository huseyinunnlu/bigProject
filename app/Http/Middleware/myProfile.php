<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class myProfile
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
        if($request->id != Auth::user()->id){
            return redirect()->back();
        }else{
        return $next($request);
        }
    }
}
