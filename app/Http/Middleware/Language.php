<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Language
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
        $lang = Session::get('webLanguage', config('app.locale'));
        config(['app.locale' => $lang]);

        return $next($request);
    }
}
