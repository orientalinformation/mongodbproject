<?php

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
    Route::get('/check_pin', 'BookController@checkPin');
    Route::get('/library_checked_list', 'BookController@libraryCheckedList');

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
    Route::get('bibliotheque', ['uses' => 'LibraryController@index', 'as' => 'frontBibliotheque'])->middleware('auth');

    Route::prefix('bibliotheque/')->group(function () {
        Route::get('/check_liked', [
            'uses' => 'LibraryController@checkLiked',
        ]);
        Route::get('/check_read', [
            'uses' => 'LibraryController@checkRead',
        ]);
        Route::get('/check_list', [
            'uses' => 'LibraryController@getLibraryDetailbyUserID',
        ]);

        Route::get('/check_share', [
            'uses' => 'LibraryController@checkShare',
        ]);
        Route::get('/check_pin', [
            'uses' => 'LibraryController@checkPin',
        ]);
    });
    // Ajax routes
    Route::post('ajax/search-advance', ['uses' => 'AjaxController@searchAdvance', 'as' => 'frontAjaxSearchAdvance'])->middleware(CheckAdminFrontend::class);
    Route::post('ajax/getObjectDataDetail', ['uses' => 'AjaxController@getObjectDataDetail', 'as' => 'frontAjaxGetObjectDataDetail'])->middleware(CheckAdminFrontend::class);
    Route::post('ajax/setObjectDataDetail', ['uses' => 'AjaxController@setObjectDataDetail', 'as' => 'frontAjaxSetObjectDataDetail'])->middleware(CheckAdminFrontend::class);

    // Product routes
    Route::get('product', ['uses' => 'ProductController@index', 'as' => 'frontProduct'])->middleware(CheckAdminFrontend::class);
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
    Route::post('save-research', ['uses' => 'ResearchController@saveKeyword', 'as' => 'frontResearchSave'])->middleware(CheckAdminFrontend::class);
    Route::delete('delete-research', ['uses' => 'ResearchController@destroy', 'as' => 'frontResearchDestroy'])->middleware(CheckAdminFrontend::class);
    // Bibliotheque routes
    // Route::get('bibliotheque', ['uses' => 'LibraryController@index', 'as' => 'frontBibliotheque'])->middleware(CheckAdminFrontend::class);

    //====Web start=============
    Route::resource('web', 'WebController');
    //====Web end===============
});