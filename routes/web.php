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

Route::group(['prefix' => '/admin'], function () {
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

Route::group(['namespace' => 'Elearning'], function () {
	Route::resource('/profile', 'ProfileController', [
		'as' => 'elearning'
	]);
	Route::post('/profile/editpassword', [
		'uses' => 'ProfileController@updatePassword',
		'as' => 'elearning.profile.updatepassword'
	]);
    Route::resource('/courses', 'CoursesController', [
        'as' => 'elearning',
    ]);
    Route::resource('courses.wordlist', 'WordListController', [
        'as' => 'elearning',
    ]);
    Route::post('/ajax/wordlist/filter', [
        'uses' => 'WordListController@ajaxFilterWordlist',
        'as' => 'filterWordlist',
    ]);
});

Route::group(['prefix' => '/profile'], function () {
	Route::post('/blockfollow', [
		'uses' => 'AjaxController@blockFollow',
		'as' => 'follow.blockfollow',
	]);
	Route::post('/unfollow', [
		'uses' => 'AjaxController@unFollow',
		'as' => 'follow.blockfollow',
	]);
});

Auth::routes();
