<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Base\PbeBaseController;
use App\Model\Playlist;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PlaylistController extends PbeBaseController
{

    #membuat (post) playlist dari user yang sedang login
    public function create() {

        /*validasi*/
        $validate = Validator::make(request()->all(),[
            'name' => 'required'
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }

        $playlist = new Playlist();
        $playlist->name = request('name');
        $playlist->user_id = request()->user->id;
        $playlist->save();
        return $this->successResponse(['playlist' => $playlist],201);
    }
}
