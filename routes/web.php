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

Route::get('show', 'ContactController@index')->name('show');

Route::get('index', 'ContactController@index')->name('index');

Route::get('create', 'ContactController@create')->name('create');

Route::get('edit', 'ContactController@edit')->name('edit');

Route::group(['prefix'=>'webapi'],function(){


  Route::post('store','ContactController@store')->name('store');

  Route::patch('update','ContactController@update')->name('update');

  Route::delete('destroy', 'ContactController@destroy')->name('delete');

});
