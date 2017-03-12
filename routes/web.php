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

Route::get('articles/cat/{cat_alias?}', ['uses'=>'ArticlesController@index','as'=>'articlesCat']);

Auth::routes();

Route::get('/home', 'HomeController@index');
