<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Routing\Router;

Route::get('/', function () {
    return view('welcome');
});

//====Dashboard start========
Route::resource('dashboard', 'Backend\DashboardController');

//====Dashboard end==========

//====Book start=============
$router->group(['prefix' =>'/books'], function (Router $router) {
    $router->get('/delete', [
        'uses' => 'Backend\BookController@delete',
    ]);
    $router->get('/update', [
        'uses' => 'Backend\BookController@update',
    ]);
    $router->post('/update', [
        'uses' => 'Backend\BookController@update',
    ]);
});

Route::resource('books', 'Backend\BookController');

//====Book end===============

//====Category start=============
$router->group(['prefix' =>'/categories'], function (Router $router) {
    $router->get('/delete', [
        'uses' => 'Backend\CategoryController@delete',
    ]);
    $router->get('/update', [
        'uses' => 'Backend\CategoryController@update',
    ]);
    $router->post('/update', [
        'uses' => 'Backend\CategoryController@update',
    ]);
});

Route::resource('categories', 'Backend\CategoryController');

//====Category end===============

//====Pin start=============
$router->group(['prefix' =>'/pins'], function (Router $router) {
    $router->post('/create', [
        'uses' => 'Backend\PinController@create',
    ]);
});

Route::resource('pins', 'Backend\PinController');

//====Pin end===============
