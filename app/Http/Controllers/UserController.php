<?php


namespace App\Http\Controllers;


use App\Model\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    /**
     * Function untuk menampilkan semua data pada table songs
     * @return JsonResponse
     */
    public function getAll() {
        $users = User::all();
        return $this->successResponse(['songs' => $users]);
    }

    /**
     * Function untuk mengambil satu data pada table songs berdasarkan primary key (id)
     * @param $id
     * @return JsonResponse
     */
    public function getById($id) {
        $user = User::find($id);
        if ($user == NULL) {
            throw new NotFoundHttpException();
        }
        return $this->successResponse(['user' => $user]);
    }

    /**
     * Function untuk menambah data pada tabale songs
     * @return JsonResponse
     */
    public function create() {

        /*validasi*/
        $validate = Validator::make(request()->all(),[
            'email' => 'required',
            'password' => 'required|numeric',
            'role' => 'required',
            'fullname' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }

        $user = new User();
        $user->email = request('email');
        $user->password = request('password');
        $user->role = request('role');
        $user->fullname = request('fullname');
        $user->save();
        return $this->successResponse(['user' => $user],201);
    }
}
