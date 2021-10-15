<?php

namespace App\Http\Middleware;

use App\Exceptions\PbeNotAuthenticatedException;
use App\Model\Playlist;
use App\User;
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

        $token = request()->header('api_token');
        $user = User::where('api_token', '=', $token)->first();
        if ($user == null) {
//            throw new PbeNotAuthenticatedException();
            return response()->json([
                'status' => 'failed',
                'message' => 'Anda tidak terautentikasi',
            ],401);
        }
        $request->user = $user;
        $request->playlist = $user;
        return $next($request);
    }
}
