<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckLoginDashboardBkpsdm
{
    {{--  public function handle(Request $request, Closure $next, ...$roles)
    {
        if($request->getRequestUri() == '/dashboard_bkpsdm_new')
        {
            return redirect()->route('dashboard_bkpsdm_login')->with('error', 'Unauthorized access');
        }
    }  --}}
}
