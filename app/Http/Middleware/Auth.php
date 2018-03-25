<?php

namespace App\Http\Middleware;

use Closure;

class Auth {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (\App\Services\AuthService::isLogged()) {
            return $next($request);
        }
        return redirect()->action('Administrators\Authenticate\AuthController@getLogin');
    }
}
