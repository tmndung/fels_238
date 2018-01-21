<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminAuthenticate
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
        $response = $next($request);
        
        if (Auth::check()) {
            if (!Auth::user()->is_admin) {
                return redirect()->route('home');
            } else {
                return redirect()->route('admin.users.index');
            }
        }
        
        return $response;
    }
}
