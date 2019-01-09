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
    $router->post('/updateStatus', [
        'uses' => 'Backend\BookController@updateStatus',
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

//===========BACKEND==========

Route::prefix('admin/')->group(function () {

    //default
    Route::get('/', 'Backend\DashboardController@index');

    //Login routes
    Route::get('login', ['uses' => 'Backend\AuthController@login',     'as' => 'login']);
    Route::post('login', ['uses' => 'Backend\AuthController@postLogin', 'as' => 'postlogin']);
    Route::get('logout', ['uses' => 'Backend\AuthController@logout', 'as' => 'logout']);

    //Password reset routes
    Route::get('forgot-password', ['uses' => 'Backend\AuthController@showForgotForm', 'as' => 'passwordForgot']);
    Route::post('send-mail', ['uses' => 'Backend\AuthController@sendMail', 'as' => 'sendMail']);
    Route::get('password/reset/{token}', 'Backend\AuthController@showResetForm');
    Route::post('password/reset', 'Backend\AuthController@resetPassword');


    Route::resource('dashboard', 'Backend\DashboardController');
});

