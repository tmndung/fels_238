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

Route::group(['prefix'=>'/admin'], function () {
	Route::resource('/users', 'UsersController', [
		'as' => 'admin'
	]);
	Route::resource('/wordlist', 'WordlistController', [
		'as' => 'admin'
	]);
	Route::resource('/category', 'CategoryController', [
		'as' => 'admin'
	]);
    Route::resource('/users', 'UsersController', [
        'as' => 'admin'
    ]);
    Route::resource('/courses', 'CoursesController', [
        'as' => 'admin'
    ]);
});

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();
