<?php


namespace App\Http\Middleware;


use Closure;

class PbeCekIdUserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (request()->user->id != request()->playlist->user_id) {
//            throw new PbeNotAuthorizedException();
            return response()->json([
                'status' => 'failed',
                'message' => 'Anda tidak memiliki hak akses ke end point ini',
            ],403);
        }
        return $next($request);
    }
}
