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
Route::get('test', function () {
	return view('test');
});

Route::get('/', function () {
    return view('main');
});

Route::get('login', function () {
	return view('login');
});

Route::get('gallog', function () {
	return view('gallog');
});
Route::get('gallog2', function () {
	return view('gallog2');
});
Route::get('gallog3', function () {
	return view('gallog3');
});
Route::get('gallog4', function () {
	return view('gallog4');
});
Route::get('gallog5', function () {
	return view('gallog5');
});

Route::get('report', function () {
	return view('report');
});

Route::get('register', function () {
	return view('register');
});

Route::get('register2', function () {
	return view('register2');
});

Route::get('register3', function () {
	return view('register3');
});
Route::get('register4', function () {
	return view('register4');
});
Route::get('gallog', function () {
	return view('gallog');
});
Route::get('gallery', function () {
	return view('gallery-post');
});

Route::resource('test', 'TestController');
