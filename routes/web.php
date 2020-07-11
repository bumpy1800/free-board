<?php
use Illuminate\Http\Request;
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

/*Route::get('/', function () {
    return view('main');
});*/
Route::get('/', 'MainController@index');
Route::post('visitor_save', 'MainController@visitor_save');

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
    'user' => 'UserController',
    'admin/user-list' => 'UserController',
    'user_wait' => 'UserWaitController',
    'admin/user_wait-list' => 'UserWaitController',
]);
Route::get('admin/user-add-form', 'UserController@create');
Route::get('admin/user-edit-form/{id}', 'UserController@edit');
Route::get('admin/user-destroy/{id}', 'UserController@destroy');
Route::get('admin/user-show/{id}', 'UserController@show');

Route::resources([
    'policy' => 'PolicyController',
    'admin/policy-list' => 'PolicyController',
]);
Route::get('admin/policy-add-form', 'PolicyController@create');
Route::get('admin/policy-edit-form/{id}', 'PolicyController@edit');
Route::get('admin/policy-destroy/{id}', 'PolicyController@destroy');
Route::get('admin/policy-show/{id}', 'PolicyController@show');

Route::resources([
    'gallery' => 'GalleryController',
    'admin_post' => 'admin\PostController',
    'admin_category' => 'admin\CategoryController',
    'admin_comment' => 'admin\CommentController',
    'admin_notice' => 'admin\NoticeController',
    'admin_popup' => 'admin\PopupController',
    'admin_popup_category' => 'admin\Popup_categoryController',
    'admin_qna' => 'admin\QnaController',
    'admin_qna_category' => 'admin\Qna_categoryController'
]);
Route::get('admin_post/{link}/{id}', 'admin\PostController@show');
Route::get('admin_post_stat', 'admin\PostController@stat_index');
Route::post('admin_post_stat', 'admin\PostController@stat_change');

Route::get('admin/galleryFind', 'admin\PostController@galleryFind');
Route::post('admin/galleryFind', 'admin\PostController@galleryFind');

Route::get('admin/gallery-list', 'admin\GalleryController@index');
Route::get('admin/gallery-add-form', 'admin\GalleryController@create');
Route::post('admin/gallery-add', 'admin\GalleryController@store');
Route::get('admin/gallery-edit-form/{id}', 'admin\GalleryController@edit');
Route::post('admin/gallery-edit/{id}', 'admin\GalleryController@update');
Route::get('admin/gallery-destroy/{id}', 'admin\GalleryController@destroy');
Route::get('admin/gallery-show/{id}', 'admin\GalleryController@show');

Route::get('admin_gallery_stat', 'admin\GalleryController@stat_index');
Route::post('admin_gallery_stat', 'admin\GalleryController@stat_change');

Route::get('admin_visitor_stat', 'admin\VisitController@visitor_stat_index');
Route::get('admin_visitor_stat/{keyword}/{date}', 'admin\VisitController@visitor_stat_index');
Route::post('admin_visitor_stat_change', 'admin\VisitController@visitor_stat_change');

Route::any('admin_visitor_refer_stat', 'admin\VisitController@visitor_refer_stat_index');

//Route::get('admin_keyword_stat', 'admin\VisitController@keyword_stat_index');
//Route::get('admin_browser_stat', 'admin\VisitController@browser_stat_index');
