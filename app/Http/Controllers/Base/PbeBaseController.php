<?php


namespace App\Http\Controllers\Base;
use App\Exceptions\PbeNotAuthenticatedException;
use App\User;
use Laravel\Lumen\Routing\Controller as BaseController;

abstract class PbeBaseController extends BaseController
{
    public function __construct()
    {
        $token = request()->header('api_token');
        $user = User::where('api_token', '=', $token)->first();
        if ($user == NULL) {
            throw new PbeNotAuthenticatedException();
        }
    }

    protected function successResponse(array $data, int $httpCode = 200) {
        $response = [
            'status' => 'succeed',
            'message' => 'Permintaan berhasil diproses',
            'data' => $data
        ];
        return response()->json($response, $httpCode);
    }

    protected function failedResponse(array $data, $httpCode) {
        $response = [
            'status' => 'failed',
            'message' => 'Permintaan gagal diproses',
            'data' => $data
        ];
        return response()->json($response, $httpCode);
    }
}
