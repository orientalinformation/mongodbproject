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

    //Roles manager routes
    Route::prefix('roles/')->group(function () {
        Route::get('{roleId}/choosePermission', ['uses' => 'Backend\RolesController@viewChoosePermission',])->name('roles.choosePermission');
        Route::post('{roleId}/assignRole', ['uses' => 'Backend\RolesController@assignRole',])->name('roles.assignRole');
    });    
    Route::resource('roles', 'Backend\RolesController');

    //Permissions manager routes
    Route::resource('permissions', 'Backend\PermissionsController');

    //Users manager routes
    Route::prefix('users/')->group(function () {
        Route::put('updateProfile/{userId}', ['uses' => 'Backend\UsersController@updateProfile',])->name('users.updateProfile');
    });    
    Route::resource('users', 'Backend\UsersController');

    //====Book start=============
    Route::prefix('books/')->group(function () {
        Route::get('/delete', [
            'uses' => 'Backend\BookController@delete',
        ]);
        Route::get('/update', [
            'uses' => 'Backend\BookController@update',
        ]);
        Route::post('/update', [
            'uses' => 'Backend\BookController@update',
        ]);
        Route::post('/updateStatus', [
            'uses' => 'Backend\BookController@updateStatus',
        ]);
        Route::post('/getChildCat', [
            'uses' => 'Backend\BookController@getChildCat',
        ]);
    });

    Route::resource('books', 'Backend\BookController');

    //====Book end===============

    //====Category start=============
    Route::prefix('categories/')->group(function () {
        Route::get('/delete', [
            'uses' => 'Backend\CategoryController@delete',
        ]);
        Route::get('/update', [
            'uses' => 'Backend\CategoryController@update',
        ]);
        Route::post('/update', [
            'uses' => 'Backend\CategoryController@update',
        ]);
    });

    Route::resource('categories', 'Backend\CategoryController');

    //====Category end===============

    //====Pin start=============
    Route::prefix('pins/')->group(function () {
        Route::post('/create', [
            'uses' => 'Backend\PinController@create',
        ]);
    });

    Route::resource('pins', 'Backend\PinController');

    //====Pin end===============

    //====Library start=============
    Route::prefix('libraries/')->group(function () {
        Route::get('/delete', [
            'uses' => 'Backend\LibraryController@delete',
        ]);
        Route::get('/update', [
            'uses' => 'Backend\LibraryController@update',
        ]);
        Route::post('/update', [
            'uses' => 'Backend\LibraryController@update',
        ]);
        Route::post('/updateShare', [
            'uses' => 'Backend\LibraryController@updateShare',
        ]);
    });

    Route::resource('libraries', 'Backend\LibraryController');

    //====Library end===============

    //====Discussion start=============
    Route::prefix('discussions/')->group(function () {
        Route::get('/delete', [
            'uses' => 'Backend\DiscussionController@delete',
        ]);
        Route::get('/update', [
            'uses' => 'Backend\DiscussionController@update',
        ]);
        Route::post('/update', [
            'uses' => 'Backend\DiscussionController@update',
        ]);
        Route::post('/updateShare', [
            'uses' => 'Backend\DiscussionController@updateShare',
        ]);
    });

    Route::resource('discussions', 'Backend\DiscussionController');

    //====Discussion end===============
});
