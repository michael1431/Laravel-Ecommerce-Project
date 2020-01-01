<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {

        switch ($guard) {
            case 'admin':
                
                if(Auth::guard($guard)->check()){
                    // jodi authenticate user hoi tahole redirect korbo
                    return redirect()->route('admin.index');
                }

                break;

             case 'web':
                
                if(Auth::guard($guard)->check()){
                    // jodi authenticate user hoi tahole redirect korbo
                    return redirect()->route('user.dashboard');
                }

                break;
            
        }

    
        return $next($request);
    
}

   /*  if (Auth::guard($guard)->check()) {

        if($guard == 'admin'){
          return redirect()->route('admin.index');
        }elseif($guard == 'web'){

          return redirect()->route('user.dashboard');
        }

       
    }

    return $next($request);*/
}
