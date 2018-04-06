<?php

namespace App\Http\Middleware;

use Closure;

class RedirectDestination
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
        /*
        |-------------------------------------------------------------------
        | * Middleware redirect after submit form
        |-------------------------------------------------------------------
        | neu co request->get('destination') thi redirect ve dia chi nay
        | @method POST PUT DELETE
        | @author tantan
        */
        $response = $next($request);
        if( $request->method() == 'GET' && $request->request->get('destination') != '' ){
            session(['destination' => $request->request->get('destination')]);
        }
        if( $request->method() == 'GET' && empty($request->request->get('destination')) ){
            session()->forget('destination');
        }

        if( in_array($request->method(), ['POST', 'PUT', "DELETE"]) ){
            // dd($request->session()->all());
            if( session()->has('destination') && !empty(session('destination')) && session()->get('redirect') ){
                $redirect = session('destination');
                session()->forget('destination');
                // dd($redirect);
                return redirect($redirect);
            }
        }
        return $response;
    }
}