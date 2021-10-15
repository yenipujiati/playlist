<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->post('api/v1/login', 'Auth\LoginController@verify');

$router->group(['prefix' => 'api/v1', 'middleware' => 'pbe.auth'], function ($router) {
//    $router->get('/songs','SongController@getAll');
//    $router->get('/songs/{id}','SongController@getById');
//    $router->post('/songs','SongController@create');
//    $router->put('/songs/{id}','SongController@update');
//    $router->delete('/songs/{id}','SongController@delete');

//    $router->get('/users','UserController@getAll');
//    $router->get('/users/{id}','UserController@getById');
//    $router->post('/users','UserController@create');


    #single route
//    $router->delete('/songs/{id}', [
//        'middleware' => 'pbe.superadmin',
//        'uses' => 'SongController@delete'
//    ]);

    #group route superadmin
    $router->group(['middleware' => 'pbe.superadmin'], function ($router) {

        #Songs Table
        $router->post('/songs','SongController@create');
        $router->put('/songs/{id}','SongController@update');
        $router->delete('/songs/{id}','SongController@delete');

        #Users Table
        $router->get('/users','UserController@getAll');
        $router->get('/users/{id}','UserController@getById');
        $router->post('/users','UserController@create');

        $router->group(['middleware' => 'pbe.id_user'], function ($router) {

            #Playlists Table
            #get playlist berdasarkan user id tertentu
            $router->get('/users/{id}/playlists','PlaylistController@getById');
            #get lagu dari playlists dengan id tertentu dari user dengan id tertentu
//          $router->get('/users/{id}/playlists/{playlistId}/songs','PlaylistController@');

        });
    });

    #group route user
    $router->group(['middleware' => 'pbe.user'], function ($router) {

        #Songs Table
        $router->get('/songs','SongController@getAll');
        $router->get('/songs/{id}','SongController@getById');

        #membuat (post) playlist dari user yang sedang login
        $router->post('/playlists','PlaylistController@create');

        $router->group(['middleware' => 'pbe.id_user'], function ($router) {

            #Playlists Table
            #get playlist yang dimiliki oleh user yang sedang login/dirinya sendiri
            $router->post('/playlists','PlaylistController@getAll');
            #get playlist hanya miliknya sendiri berdasrkan id ((validasi))
//          $router->post('/playlists/{id}','PlaylistController@');

            #PlaylistSongs Table
//          #menambah (post) lagu ke dalam playlist ((validasi pemilik playlist))
//          $router->post('/playlists/{id}/songs','PlaylistsongController@');
//          #get semua lagu yang ada di dalam playlist ((validasi pemilik playlist))
//          $router->post('/playlists/{id}/songs','PlaylistsongController@');
        });
    });
});
