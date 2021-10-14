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
    $router->get('/songs','SongController@getAll');
    $router->get('/songs/{id}','SongController@getById');
    $router->post('/songs','SongController@create');
    $router->put('/songs/{id}','SongController@update');
    $router->delete('/songs/{id}','SongController@delete');
});
