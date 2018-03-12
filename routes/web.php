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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getCarouselGames','gameController@getCarouselGames');
Route::get('/getCardsGames','gameController@getCardsGames');

//Route::group(['middleware'=> config('admin.route.middleware')],function(){
//    Route::get('/api/getCategories', 'CategoryController@getCategories') ;
//});
