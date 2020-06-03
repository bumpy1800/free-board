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
/*Route::get('test', function () {
	return view('main');
});*/

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
	return view('gallery');
});
Route::get('post', function () {
	return view('gallery-post');
});
Route::get('write', function () {
	return view('gallery-post-write');
});
Route::get('gallery-plus', function () {
	return view('gallery-plus');
});
Route::get('gallery-plus-m', function () {
	return view('gallery-plus-m');
});
Route::get('admin', function () {
	return view('admin.index');
});









Route::get('/admin/find', function () {
	return view('find');
});

Route::resources([
    'gallery-plus' => 'GalleryController',
    'admin_post' => 'admin\PostController',
    'admin_category' => 'admin\CategoryController',
    'admin_comment' => 'admin\CommentController'
]);
Route::get('admin_post/{link}/{id}', 'admin\PostController@show');

Route::get('admin/galleryFind', 'admin\PostController@galleryFind');
Route::post('admin/galleryFind', 'admin\PostController@galleryFind');

Route::get('admin/gallery-list', 'admin\GalleryController@index');
Route::get('admin/gallery-add-form', 'admin\GalleryController@create');
Route::post('admin/gallery-add', 'admin\GalleryController@store');
Route::get('admin/gallery-edit-form/{id}', 'admin\GalleryController@edit');
Route::post('admin/gallery-edit/{id}', 'admin\GalleryController@update');
Route::get('admin/gallery-destroy/{id}', 'admin\GalleryController@destroy');
Route::get('admin/gallery-show/{id}', 'admin\GalleryController@show');

//Route::resource('test', 'TestController');
