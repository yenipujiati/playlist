<?php


namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function verify() {
        $fullname = $_SERVER['PHP_AUTH_USER'];
        $paswword = $_SERVER['PHP_AUTH_PW'];
        $user = User::loginVerify($fullname, $paswword);
        if ($user != false) {
            $apiTotken = Str::random('100');
            $user->api_token = $apiTotken;
            $user->save();
            return $this->successResponse(['user' => $user]);
        }
        return $this->failedResponse([],401);
    }
}
