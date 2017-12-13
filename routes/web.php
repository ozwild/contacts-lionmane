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


/**
 * Contact routes
 */
Route::group(['prefix'=>'contacts'], function(){

    Route::get('show/{contact}', 'ContactController@show')->name('show');

    Route::get('index', 'ContactController@index')->name('index');

    Route::get('create', 'ContactController@create')->name('create');

    Route::get('edit/{contact}', 'ContactController@edit')->name('edit');

    Route::group(['prefix'=>'webapi'],function(){


        Route::post('store','ContactController@store')->name('store');

        Route::patch('update/{contact}','ContactController@update')->name('update');

        Route::delete('destroy/{contact}', 'ContactController@destroy')->name('delete');

    });

});

/**
 * Attribute routes
 */
Route::group(['prefix'=>'attributes'], function(){

    Route::get('create', 'AttributeController@create')->name('attribute-create');

});