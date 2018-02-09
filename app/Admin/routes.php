<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UserController::class);
    $router->resource('/games',GameController::class);
    $router->resource('/customers',CustomerController::class);
//    $router->resource('/categories',CustomerController::class);

    $router->get('/getCategories','CategoryController@getCategories');

});

//Route::group([
//    'prefix' => 'admin',
//    'namespace'     => config('admin.route.namespace'),
//    'middleware'    => config('admin.route.middleware'),
//],function(Router $router){
//});

