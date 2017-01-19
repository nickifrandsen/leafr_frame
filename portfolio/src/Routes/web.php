<?php

Route::group([
    'as' => 'portfolio.',
    'prefix' => 'backoffice',
    'namespace' => 'Leafr\Portfolio\Http\Controllers',
    'middleware' => ['web','auth']
    ],
    function () {

        Route::resource('portfolio', 'PortfolioController', ['except' => 'show']);
        Route::post('portfolio/batch', 'PortfolioController@batchCreate');

    }
);
