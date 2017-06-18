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

Route::group(['prefix' => '/auth'], function() {

	//GET маршруты для модуля Auth
	Route::get('/register', function() {
		return view('auth_register');
	});
	Route::get('/login', function() {
		return view('auth_login');
	});

	//POST маршруты для модуля Auth
	Route::post('/register', 'Auth\\RegisterController@register');
	Route::post('/login', 'Auth\\LoginController@login');

	//Ajax маршруты для модуля Auth
	Route::post('/ajax/login', 'Auth\\ShortRequestsController@login');
	Route::post('/ajax/register', 'Auth\\ShortRequestsController@register');
});


Route::get('/profile/{id}', ['middleware' => 'auth', function() {
  return "You:".session('first_name').session('last_name');
}]);
