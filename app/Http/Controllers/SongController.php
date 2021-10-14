<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Base\PbeBaseController;
use App\Model\Song;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SongController extends PbeBaseController
{
    /**
     * Function untuk menampilkan semua data pada table songs
     * @return JsonResponse
     */
    public function getAll() {
        $songs = Song::all();
        return $this->successResponse(['songs' => $songs]);
    }

    /**
     * Function untuk mengambil satu data pada table songs berdasarkan primary key (id)
     * @param $id
     * @return JsonResponse
     */
    public function getById($id) {
        $song = Song::find($id);
        if ($song == NULL) {
            throw new NotFoundHttpException();
        }
        return $this->successResponse(['song' => $song]);
    }

    /**
     * Function untuk menambah data pada tabale songs
     * @return JsonResponse
     */
    public function create() {

        /*validasi*/
        $validate = Validator::make(request()->all(),[
           'title' => 'required',
           'year' => 'required|numeric',
            'artist' => 'required',
            'gendre' => 'required',
            'duration' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }

        $song = new Song();
        $song->title = request('title');
        $song->year = request('year');
        $song->artist = request('artist');
        $song->gendre = request('gendre');
        $song->duration = request('duration');
        $song->save();
        return $this->successResponse(['song' => $song],201);
    }

    /**
     *Function untuk mengubah data dari database berdasarkan primary key (id)
     * @param $id
     * @return JsonResponse
     */
    public function update($id) {
        $song = Song::find($id);
        if ($song == NULL) {
            throw new NotFoundHttpException();
        }

        $validate = Validator::make(request()->all(),[
            'title' => 'required',
            'year' => 'required|numeric',
            'artist' => 'required',
            'gendre' => 'required',
            'duration' => 'required',
        ]);
        if ($validate->fails()) {
            return $this->failedResponse($validate->errors()->getMessages(),400);
        }

        $song->title = request('title');
        $song->year = request('year');
        $song->artist = request('artist');
        $song->gendre = request('gendre');
        $song->duration = request('duration');
        $song->save();
        return $this->successResponse(['songs' => $song]);
    }

    public function delete($id) {
        $song = Song::find($id);
        if ($song == NULL) {
            throw new NotFoundHttpException();
        }

        $song->delete();
        return $this->successResponse(['songs' => 'Data berhasil dihapus']);
    }
}
