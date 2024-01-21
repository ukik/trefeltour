<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Uasoft\Badaso\Helpers\ApiResponse;

class BadasoAuthenticate
{
    public function handle($request, Closure $next)
    {
        // If the URL contains a token parameter - attach it as the Authorization header
        if ($request->has('token') && !$request->headers->has('Authorization')) {
            $request->headers->set('Authorization', 'Bearer ' . $request->token);
        }
        // dd(\Auth::check(), \Auth::user());

        if (Auth::check()) {
            return $next($request);
        }

        return ApiResponse::unauthorized();
    }
}
