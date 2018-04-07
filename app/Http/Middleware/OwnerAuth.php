<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class OwnerAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next )
    {
        if( !Auth::check() ){
            return abort(403, 'Bạn không đủ phân quyền để truy cập.');
        }
        $curUser = Auth::user();
        $uid = $request->user;
        if( $curUser->id != $uid ){
            return abort(403, 'Bạn không đủ phân quyền để truy cập.');
        }
        return $next($request);
    }
}
