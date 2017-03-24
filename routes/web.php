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

// группа маршрутов, для построеня REST-запросов
Route::resource('/', 'IndexController', [
                                            'only'=>['index'], // какие методы использовать
                                            'names'=>[
                                                'index'=>'home' // псевдонимы для методов
                                            ]
                                        ]);

Route::resource('portfolios','PortfolioController',[
    'parameters' => [
        'portfolios' => 'alias'
    ]
]);

Route::resource('articles','ArticlesController',[
    'parametres'=>[
        'articles' => 'alias'
    ]
]);

Route::resource('comment', 'CommentController', ['only' => ['store']]);

Route::match(['get','post'],'/contacts',['uses'=>'ContactsController@index','as'=>'contacts']);

Route::get('login','Auth\LoginController@showLoginForm');
Route::post('login','Auth\LoginController@login');
Route::get('logout','Auth\LoginController@logout');

//admin
Route::group(['prefix' => 'admin','middleware'=> 'auth'],function() {
    //admin
    Route::get('/',['uses' => 'Admin\IndexController@index','as' => 'adminIndex']);
    Route::resource('/articles','Admin\ArticlesController');

});

Route::get('articles/cat/{cat_alias?}', ['uses'=>'ArticlesController@index','as'=>'articlesCat']);

Auth::routes();

Route::get('/home', 'HomeController@index');
