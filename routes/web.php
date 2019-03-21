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

//===========FONTEND==========
Route::namespace('Frontend')->group(function () {

    Route::get('/', 'HomeController@index');
    Route::get('/home-login', 'HomeController@index_login');

    Route::get('/book', 'BookController@index');

    Route::get('/check_liked', 'BookController@checkLiked');
    Route::get('/check_read', 'BookController@checkRead');
    Route::get('/check_list', 'BookController@getLibraryDetailbyUserID');
    Route::get('/update_list', 'BookController@updateLibraryDetail');
    Route::get('/create_list', 'BookController@createLibrary');
    Route::get('/check_share', 'BookController@checkShare');

    //register routes
    Route::get('register', 'AuthController@showRegistrationForm');
    Route::post('register', 'AuthController@register')->name('register');

    //Login routes
    Route::get('login', ['uses' => 'AuthController@login',     'as' => 'frontLogin']);
    Route::post('login', ['uses' => 'AuthController@postLogin', 'as' => 'frontPostLogin']);
    Route::get('logout', ['uses' => 'AuthController@logout', 'as' => 'frontLogout']);
   
    Route::get('auth/{driver}', ['as' => 'socialAuth', 'uses' => 'SocialController@redirectToProvider']);
    Route::get('auth/{driver}/callback', ['as' => 'socialAuthCallback', 'uses' => 'SocialController@handleProviderCallback']);

    //Password reset routes
    Route::get('forgot-password', ['uses' => 'AuthController@showForgotForm', 'as' => 'frontPasswordForgot']);
    Route::post('send-mail', ['uses' => 'AuthController@sendMail', 'as' => 'frontSendMail']);
    Route::get('password/reset/{token}', ['uses' => 'AuthController@showResetForm', 'as' => 'frontShowResetForm']);
    Route::post('password/reset', ['uses' => 'AuthController@resetPassword', 'as' => 'frontResetPassword']);

    // Bibliotheque routes
    Route::get('bibliotheque', ['uses' => 'BibliothequeController@index', 'as' => 'frontBibliotheque'])->middleware('auth');
    Route::get('bibliotheque_check_liked', 'BibliothequeController@checkLiked')->middleware('auth');

    // Ajax routes
    Route::post('search-advance', ['uses' => 'AjaxController@searchAdvance', 'as' => 'frontAjaxSearchAdvance'])->middleware('auth');

    // Product routes
    Route::get('product', ['uses' => 'ProductController@index', 'as' => 'frontProduct'])->middleware('auth');
    Route::prefix('product/')->group(function () {
        Route::get('/check_liked', [
            'uses' => 'ProductController@checkLiked',
        ]);
        Route::get('/check_read', [
            'uses' => 'ProductController@checkRead',
        ]);
        Route::get('/check_list', [
            'uses' => 'ProductController@getLibraryDetailbyUserID',
        ]);
        Route::get('/update_list', [
            'uses' => 'ProductController@updateLibraryDetail',
        ]);
        Route::get('/create_list', [
            'uses' => 'ProductController@createLibrary',
        ]);
        Route::get('/check_share', [
            'uses' => 'ProductController@checkShare',
        ]);
    });

    // Research routes
    Route::post('save-research', ['uses' => 'ResearchController@saveKeyword', 'as' => 'frontResearchSave'])->middleware('auth');
    Route::delete('delete-research', ['uses' => 'ResearchController@destroy', 'as' => 'frontResearchDestroy'])->middleware('auth');
    // Bibliotheque routes
    Route::get('bibliotheque', ['uses' => 'BibliothequeController@index', 'as' => 'frontBibliotheque'])->middleware('auth');

    //====Web start=============
    Route::resource('web', 'WebController');
    //====Web end===============
});

//===========BACKEND==========

Route::group(['prefix' => 'admin'], function () {

    //404
    Route::get('/404', 'Backend\NotFoundController@index');

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

    //Account Managers routes
    Route::resource('accounts', 'Backend\AccountManagersController');    

    //Partner Managers routes
    Route::resource('partners', 'Backend\PartnerManagersController');

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

    //====Rss start=============

    Route::get('rss/delete/{rss_id}', [
        'as' => 'rss.delete', 'uses' => 'Backend\RssController@delete'
    ]);

    Route::get('rss/user',[
        'as' => 'rss.user', 'uses' => 'Backend\RssController@rssUserIndex'
    ]);

    Route::resource('rss', 'Backend\RssController');

    //====Rss end===============

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

    //====Event start=============
    Route::prefix('events/')->group(function () {
        Route::get('/delete', [
            'uses' => 'Backend\EventController@delete',
        ]);
        Route::get('/update', [
            'uses' => 'Backend\EventController@update',
        ]);
        Route::post('/update', [
            'uses' => 'Backend\EventController@update',
        ]);
    });

    Route::resource('events', 'Backend\EventController');

    //====Event end===============

    //====Product start=============
    Route::prefix('products/')->group(function () {
        Route::get('/delete', [
            'uses' => 'Backend\ProductController@delete',
        ]);
        Route::get('/update', [
            'uses' => 'Backend\ProductController@update',
        ]);
        Route::post('/update', [
            'uses' => 'Backend\ProductController@update',
        ]);
    });

    Route::resource('products', 'Backend\ProductController');

    //====Product end===============

    //====Draft start=============
    Route::prefix('drafts/')->group(function () {
        Route::get('/delete', [
            'uses' => 'Backend\DraftController@delete',
        ]);
        Route::get('/update', [
            'uses' => 'Backend\DraftController@update',
        ]);
        Route::post('/update', [
            'uses' => 'Backend\DraftController@update',
        ]);
    });

    Route::resource('drafts', 'Backend\DraftController');

    //====Draft end===============

    //====Libraries API start=============
    Route::prefix('libraries_api/')->group(function () {
        Route::get('/index', [
            'uses' => 'Backend\NotFoundController@index',
        ]);
    });
    //====Libraries API end===============

    //====Web start=============
    Route::prefix('web/')->group(function () {
        Route::get('/index', [
            'uses' => 'Backend\NotFoundController@index',
        ]);
    });
    //====Web end===============

    //====QCM start=============
    Route::prefix('qcm/')->group(function () {
        Route::get('/index', [
            'uses' => 'Backend\NotFoundController@index',
        ]);
    });
    //====QCM end===============
});





