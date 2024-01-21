<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Uasoft\Badaso\Helpers\ApiResponse;

/**
 * This middleware check if the request has _token key and adds this into the Authorization header to take advantage of
 * the sanctum middleware
 */
class CheckTokenAndAddToHeaderMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return Response|RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $all = $request->all();
        if (isset($all['token'])) {
            Log::debug('token from http param', [$all['token']]);
            $request->headers->set('Authorization', sprintf('%s %s', 'Bearer', $all['token']));
        }
        // dd(\Auth::check(), \Auth::user());
        // return $next($request);
        if (Auth::check()) {
            return $next($request);
        }

        return ApiResponse::unauthorized();
    }
}
