<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Session;

class CheckForPrice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
{
    $currentRoute = $request->route()->getName(); // ambil nama route

    if(in_array($currentRoute, ['hotel.pay', 'hotel.success'])) {
        if(!Session::has('price') || Session::get('price') <= 0) {
            return abort(403);
        }
    }

    return $next($request);
}

}
