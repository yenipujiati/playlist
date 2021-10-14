<?php


namespace Database\Seeders;


use App\Model\Song;
use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    public function run() {
        $songs = factory(Song::class, 10)->create();
    }
}
