<?php

Route::group([
    'as' => 'commerce.',
    'prefix' => 'backoffice',
    'namespace' => 'Leafr\Commerce\Http\Controllers',
    'middleware' => ['web','auth']],
    function () {
        Route::resource('brands', 'BrandsController', ['only' => ['index', 'store']]);
        Route::resource('customers', 'CustomersController', ['only' => ['index', 'show']]);
        Route::resource('product-types', 'ProductTypesController', ['except' => 'show']);
        Route::resource('orders', 'OrdersController', ['only' => ['index', 'show', 'update']]);
        Route::resource('products', 'ProductsController', ['except' => 'show']);
        Route::resource('products.variations', 'ProductVariationsController', ['only' => ['index', 'store']]);
        Route::resource('products.categories', 'ProductCategoriesController', ['only' => ['index', 'store']]);
        Route::resource('products.inventory', 'ProductInventoryController', ['only' => ['index', 'create', 'destroy']]);

        Route::resource('inventory', 'InventoryController');

        Route::get('orders/{id}/gls', 'OrdersController@getGlsLabel')->name('orders.gls');
        Route::post('products/image', 'ProductsController@postProductImage')->name('productImage.store');
        Route::delete('products/image/{id}', 'ProductsController@destroyProductImage')->name('productImage.destroy');

        Route::resource('suppliers', 'SuppliersController', ['only' => ['index', 'store']]);
    }
);
