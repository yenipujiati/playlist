<?php


namespace App\Http\Controllers;


use App\Model\Song;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    /**
     * Function untuk menampilkan semua data pada table songs
     * @return JsonResponse
     */
    public function getAll() {
        $songs = Song::all();
        return response()->json($songs);
    }

    /**
     * Function untuk mengambil satu data pada table songs berdasarkan primary key (id)
     * @param $id
     * @return JsonResponse
     */
    public function getById($id) {
        $song = Song::find($id);
        return response()->json($song);
    }

    /**
     * Function untuk menambah data pada tabale songs
     * @return JsonResponse
     */
    public function create() {
        $song = new Song();
        $song->title = request('title');
        $song->year = request('year');
        $song->artist = request('artist');
        $song->gendre = request('gendre');
        $song->duration = request('duration');
        $song->save();
        return response()->json($song,201);
    }

    /**
     *Function untuk mengubah data dari database berdasarkan primary key (id)
     * @param $id
     * @return JsonResponse
     */
    public function update($id) {
        $song = Song::find($id);
        $song->title = request('title');
        $song->year = request('year');
        $song->artist = request('artist');
        $song->gendre = request('gendre');
        $song->duration = request('duration');
        $song->save();
        return response()->json($song,201);
    }

    public function delete($id) {
        $song = Song::find($id);
        $song->delete();
        return response()->json("Sukses Dihapus");
    }
}
