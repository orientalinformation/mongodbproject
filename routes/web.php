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
use App\Http\Middleware\CheckAdminFrontend;

//===========FONTEND==========
include_once ('frontend.php');

//===========BACKEND==========
include_once ('backend.php');






