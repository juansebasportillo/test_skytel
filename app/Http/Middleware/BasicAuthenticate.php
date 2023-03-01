<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class BasicAuthenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {  
        Log::info($request->getUser());
        if ( $request->getUser() == 'skytel_form' && $request->getPassword() == 'oDXAoC6cos7ErfnxXRuHeFbLVWDy') {
            return $next($request);
        }

        return response('You shall not pass!', 401, ['WWW-Authenticate' => 'Basic']);
    }
}
