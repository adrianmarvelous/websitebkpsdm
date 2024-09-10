<?php

namespace App\Http\Middleware;

use Closure;

class CekLogin
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
       
        if (!$request->session()->exists('logged_in')) {
            \Session::put('pre_login_url', \URL::current());
            // user value cannot be found in session
            return redirect()->route('dashboard.login')->with([
                'message' => 'Sesi login Anda telah kadaluarsa',
                'color' => 'danger'
            ]);
        }
        return $next($request);
    }
}
