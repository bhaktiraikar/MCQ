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
Route::get('/user_login', function () {
    return view('user_login');
})->name('user_login');
Route::post('/do_login', 'UserController@store');
Route::get('/questions', 'UserController@showQuestions' );
Route::post('/store_ans', 'UserController@storeDetails');
/* admin */
Route::get('/logout','AdminController@logout');
Route::get('/admin', 'AdminController@showLogin');
Route::post('/admin_sign_in', 'AdminController@doLogin');
Route::get('/users_list', function() {
	 return view('users_list');
});
Route::get('/get_user_list', 'UserController@getAll');
Route::get('/user_details', 'UserController@getUserDetails');
Route::get('/user_details/fetch_data', 'UserController@fetch_data');
