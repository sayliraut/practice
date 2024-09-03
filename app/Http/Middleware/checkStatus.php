<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checkStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $admin = auth()->guard('admin')->user();

        if ($admin && $admin->is_active == 1 && ($admin->principal_type_xid == 1)) {
            return $next($request);
        } else {
            return redirect('/')->with('error_msg', 'You must be logged in..');
        }    }
}
