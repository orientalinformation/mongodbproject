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

Route::get('/', function () {
    return view('welcome');
});

<<<<<<< HEAD
Route::resource('dashboard', 'Backend\DashboardController');
Route::resource('book', 'Backend\BookController');
=======
//====Dashboard start========
Route::resource('dashboard', 'Backend\DashboardController');

//====Dashboard end==========

//====Book start=============
Route::resource('books', 'Backend\BookController');


//====Book end===============
>>>>>>> 36363a472325dffb89fcd18150b2107d7cd103db
