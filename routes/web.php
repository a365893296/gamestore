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

//Auth::routes();
//注册登录部分
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::post('/logout', 'AuthController@logout');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/getCarouselGames','gameController@getCarouselGames');
Route::get('/getCardsGames','gameController@getCardsGames');


Route::post('/game/{id}','gameController@game');

Route::group(['middleware' =>'auth'],function(){
    Route::post('/getGameList','gameController@getGameList');
    Route::post('/getUserInfo' , 'UserController@getUserInfo');
    Route::post('/purchase' , 'UserGameController@purchase') ;
    Route::post('/getPurchased', 'UserGameController@getPurchased') ;
    Route::post('/getMyGameList', 'UserController@getMyGameList') ;
});



