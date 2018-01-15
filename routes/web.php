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
Route::pattern('id', '[0-9]+');

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
        'as' => 'admin',
    ]);
    Route::resource('/wordlist', 'WordlistController', [
        'as' => 'admin',
    ]);
    Route::resource('/category', 'CategoryController', [
        'as' => 'admin',
    ]);
    Route::resource('/users', 'UsersController', [
        'as' => 'admin',
    ]);
    Route::resource('/courses', 'CoursesController', [
        'as' => 'admin',
    ]);
});

Route::get('/', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Elearning'], function () {
	Route::resource('/profile', 'ProfileController', [
		'as' => 'elearning',
	]);
	Route::post('/profile/editpassword', [
		'uses' => 'ProfileController@updatePassword',
		'as' => 'elearning.profile.updatepassword',
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
    Route::resource('/profile', 'ProfileController', [
        'as' => 'elearning',
    ]);
    Route::post('/profile/editpassword', [
        'uses' => 'ProfileController@updatePassword',
        'as' => 'elearning.profile.updatepassword',
    ]);
    Route::get('/test/{id}', [
        'uses' => 'TestController@index',
        'as' => 'elearning.test.index',
    ]);
    Route::get('/show/{id}', [
        'uses' => 'TestController@show',
        'as' => 'elearning.test.show',
    ]);
    Route::get('test/result/{id}', [
        'uses' => 'TestController@result',
        'as' => 'elearning.test.result',
    ]);
});

Route::group(['prefix' => '/profile'], function () {
    Route::post('/blockfollow', [
        'uses' => 'AjaxController@blockFollow',
        'as' => 'profile.follow.blockfollow',
    ]);
    Route::post('/unfollow', [
        'uses' => 'AjaxController@unFollow',
        'as' => 'profile.follow.unfollow',
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
Route::post('/answercorrect', [
    'uses' => 'AjaxController@answerCorrect',
    'as' => 'elearning.test.answercorrect',
]);

Auth::routes();
