<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->get('categories/create', 'CategoriesController@create');
    $router->post('categories', 'CategoriesController@store');
    $router->get('categories', 'CategoriesController@index');
    $router->get('categories/{id}/edit', 'CategoriesController@edit');
    $router->put('categories/{id}', 'CategoriesController@update');
    $router->get('api/categories', 'CategoriesController@apiIndex');

    $router->resource('items', ItemsController::class);
});
