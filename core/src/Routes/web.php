<?php

Route::group([
    'namespace' => 'Leafr\Core\Http\Controllers\Auth',
    'middleware' => ['web']
    ],
    function () {

        // Authentication Routes...
        Route::get('backoffice/login', 'LoginController@showLoginForm')->name('core.login');
        Route::post('backoffice/login', 'LoginController@login');
        Route::get('backoffice/logout', 'LoginController@logout');
        Route::get('register', 'RegisterController@showRegistrationForm');
        Route::post('register', 'RegisterController@register');
    }
);



Route::group([
    'as' => 'core.',
    'prefix' => 'backoffice',
    'namespace' => 'Leafr\Core\Http\Controllers',
    'middleware' => ['web','auth']
    ],
    function () {

        Route::get('/', 'DashboardController@index');
        Route::get('dashboard', 'DashboardController@index')->name('core.index');

        Route::get('appearance', 'AppearanceController@index');
        Route::post('appearance', 'AppearanceController@update');

        Route::resource('pages', 'PagesController', ['except' => 'show']);
        Route::resource('categories', 'CategoriesController', ['except' => 'show']);

        Route::get('settings', 'SettingsController@index');
        Route::put('settings', 'SettingsController@update');

        // Media Routes
        Route::post('medias/reorder', 'MediaController@reorder');

        // Registration Routes...
        Route::get('register', 'Auth\RegisterController@showRegistrationForm');
        Route::post('register', 'Auth\RegisterController@register');

        // Password Reset Routes...
        Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
        Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
        Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
        Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    }
);
