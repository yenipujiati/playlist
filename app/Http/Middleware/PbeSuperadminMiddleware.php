<?php


namespace App\Http\Middleware;


use App\Exceptions\PbeNotAuthenticatedException;
use App\Exceptions\PbeNotAuthorizedException;
use Closure;

class PbeSuperadminMiddleware
{
    public function handle($request, Closure $next) {
        if ($request->user->role != 'superadmin'){
//            throw new PbeNotAuthorizedException();
            return response()->json([
                'status' => 'failed',
                'message' => 'Anda tidak memiliki hak akses ke end point ini',
            ],403);
        }
        return $next($request);
    }
}
