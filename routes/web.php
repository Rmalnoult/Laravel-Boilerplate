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


Route::get('/', 'HomeController@index');
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

	Route::group(['middleware' => 'auth'], function () {
		Route::get('/dashboard', 'UserController@dashboard');
		Route::get('/admin/', 'UserController@dashboard');
		
		Route::get('/users/', 'UserController@index');
		Route::get('/users/{id}/update', 'UserController@update')->where('id', '[0-9]+');
		Route::put('/users/{id}/update', 'UserController@modify')->where('id', '[0-9]+');
		// Route::post('/users/{id}/delete', 'UserController@delete')->where('id', '[0-9]+');
	});

	// Route::get('/foo/', 'BarController@index');
	// Route::get('/foo/create', 'BarController@create');
	// Route::post('/foo/store', 'BarController@store');
	// Route::put('/foo/{id}/update', 'BarController@update')->where('id', '[0-9]+');
	// Route::get('/foo/{id}/delete', 'BarController@delete')->where('id', '[0-9]+');
});

Route::get('auth/google', 'Auth\GoogleAuthController@redirectToProvider');
Route::get('auth/google/callback', 'Auth\GoogleAuthController@handleProviderCallback');

Route::get('auth/facebook', 'Auth\FacebookAuthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\FacebookAuthController@handleProviderCallback');

