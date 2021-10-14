<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $hidden = ['password'];

    public static function loginVerify($fullname, $password) {
        $user = self::where('fullname', '=', $fullname)->first();
        if ($user != NULL) {
            if(password_verify($password, $user->password)) {
                return$user;
            }
        }
        return false;
    }
}
