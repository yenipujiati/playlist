<?php

namespace App\Http\Middleware;

use App\Exceptions\PbeNotAuthenticatedException;
use Closure;

class PBEMiddleware
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
        if (empty($request->header('api_token'))) {
            return response()->json([
                'status' => 'failed',
                'message' => 'Anda tidak terautentikasi',
            ],401);
        }
        return $next($request);
    }
}
