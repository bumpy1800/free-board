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
    'user' => 'admin\UserController',
    'user_wait' => 'admin\UserWaitController',
    'admin_logo' => 'admin\LogoController',
    'admin_singo' => 'admin\SingoController',
    'admin_singo_wait' => 'admin\SingoWaitController'
]);
Route::PATCH('admin/singo-wait/{id}', 'admin\SingoController@wait');

Route::get('admin/logo-add-form', 'admin\LogoController@create');
Route::get('admin/logo-edit-form/{id}', 'admin\LogoController@edit');
Route::get('admin/logo-destroy/{id}', 'admin\LogoController@destroy');
Route::get('admin/logo-show/{id}', 'admin\LogoController@show');

Route::get('admin/user-add-form', 'admin\UserController@create');
Route::get('admin/user-edit-form/{id}', 'admin\UserController@edit');
Route::get('admin/user-destroy/{id}', 'admin\UserController@destroy');
Route::get('admin/user-show/{id}', 'admin\UserController@show');

Route::resources([
    'policy' => 'admin\PolicyController',
    'admin/policy-list' => 'admin\PolicyController',
]);
Route::get('admin/policy-add-form', 'admin\PolicyController@create');
Route::get('admin/policy-edit-form/{id}', 'admin\PolicyController@edit');
Route::get('admin/policy-destroy/{id}', 'admin\PolicyController@destroy');
Route::get('admin/policy-show/{id}', 'admin\PolicyController@show');


Route::resources([
    'gallery' => 'GalleryController',
	'gallery-post' => 'PostController',
	'gallery-hit' => 'Post_hitController',
	'comment' => 'CommentController',
	'notice' => 'NoticeController',
    'admin_post' => 'admin\PostController',
    'admin_category' => 'admin\CategoryController',
    'admin_comment' => 'admin\CommentController',
    'admin_notice' => 'admin\NoticeController',
    'admin_popup' => 'admin\PopupController',
    'admin_popup_category' => 'admin\Popup_categoryController',
    'admin_qna' => 'admin\QnaController',
    'admin_qna_category' => 'admin\Qna_categoryController'
]);
Route::get('game-gallery', 'GalleryController@index');
Route::get('enter-gallery', 'GalleryController@index');
Route::get('sports-gallery', 'GalleryController@index');
Route::get('edu-gallery', 'GalleryController@index');
Route::get('travel-gallery', 'GalleryController@index');
Route::get('hobby-gallery', 'GalleryController@index');
Route::post('week-gallerys', 'GalleryController@week_gallerys');
Route::get('gallery-plus-m/{id}', 'GalleryController@m_gallery_index');
Route::get('gallery_cookiedelete/{id}', 'GalleryController@cookieDelete');
Route::get('gallery_search/{name}', 'GalleryController@gallery_search');
Route::any('gallery_link_gallery', 'GalleryController@link_gallery');

//Route::get('gallery-post/{link}/{id}', 'PostController@show');
Route::get('gallery-post/{link}/{id}', 'PostController@show');
Route::post('plusHitPoint', 'PostController@plusHitPoint');
Route::post('plusBadPoint', 'PostController@plusBadPoint');
Route::post('plusGoodPoint', 'PostController@plusGoodPoint');

Route::post('notice-comment', 'CommentController@notice_store');

Route::get('admin_post/{link}/{id}', 'admin\PostController@show');
Route::get('admin_post_stat', 'admin\PostController@stat_index');
Route::post('admin_post_stat', 'admin\PostController@stat_change');

Route::any('admin_qna_stat', 'admin\QnaController@stat_index');

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
Route::any('admin_refer_stat', 'admin\VisitController@refer_stat_index');
Route::any('admin_browser_stat', 'admin\VisitController@browser_stat_index');
