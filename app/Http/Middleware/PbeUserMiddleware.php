<?php


namespace App\Http\Middleware;


use Closure;

class PbeUserMiddleware
{
    public function handle($request, Closure $next) {
        if ($request->user->role != 'user') {
            return response()->json([
                'status' => 'failed',
                'message' => 'Anda tidak memiliki hak akses ke end point ini',
            ],403);
        }
        return $next($request);
    }
}
