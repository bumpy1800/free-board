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
//Route::any('/', 'UserInfoController@sendEmail');
//메인
Route::get('/', 'MainController@index');
Route::post('visitor_save', 'MainController@visitor_save');
Route::post('getPopupImage', 'MainController@getPopupImage');

//로그인 인증
Route::post('auth/chkUser', 'Auth\LoginController@chkUserPw');
Route::post('auth/login', 'Auth\LoginController@login');
Route::any('auth/logout', 'Auth\LoginController@logout');

Route::get('login', function () {
	return view('login');
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

//어드민
Route::any('admin', 'admin\MainController@index');
Route::get('/admin/find', function () {
	return view('find');
});

//디스플레이 광고
Route::resources([
    'display-ad' => 'DisplayadController',
]);

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
	'issue' => 'IssueController',

    'admin_post' => 'admin\PostController',
    'admin_category' => 'admin\CategoryController',
    'admin_comment' => 'admin\CommentController',
    'admin_notice' => 'admin\NoticeController',
    'admin_popup' => 'admin\PopupController',
    'admin_popup_category' => 'admin\Popup_categoryController',
	'admin_popup2' => 'admin\Popup2Controller',
	'admin_display-ad' => 'admin\DisplayadController',
    'admin_qna' => 'admin\QnaController',
    'admin_qna_category' => 'admin\Qna_categoryController'
]);

//로그인이 필요한 경로들
Route::middleware(['guest'])->group(function() {
	Route::get('gallog/{uid}', 'GallogController@index');
	Route::get('gallog-post/{uid}', 'GallogController@post_index');
	Route::get('gallog-comment/{uid}', 'GallogController@comment_index');
	Route::get('gallog-scrap/{uid}', 'GallogController@scrap_index');
	Route::get('gallog-guestbook/{uid}', 'GallogController@guestbook_index');
	Route::post('gallog-guestbook/{uid}/store', 'GallogController@guestbook_store');
	Route::post('gallog-guestbook/{uid}/update', 'GallogController@guestbook_update');
	Route::post('gallog-guestbook/{uid}/destroy', 'GallogController@guestbook_destroy');
	Route::post('gallog-guestbook/{uid}/hidden', 'GallogController@guestbook_hidden');
	Route::post('gallog-guestbook/{uid}/open', 'GallogController@guestbook_open');

	Route::resources([
	    'user-info' => 'UserInfoController',
	]);
	Route::get('user-info-changePw', 'UserInfoController@showChangePw');
	Route::get('user-info-security', 'UserInfoController@showSecurity');
	Route::get('user-info-leave', 'UserInfoController@showLeave');
	Route::post('user-info-sendEmail', 'UserInfoController@sendEmail');
	Route::post('user-info-checkCode', 'UserInfoController@checkCode');
});

//카테고리 관련
Route::get('game-gallery', 'GalleryController@index');
Route::get('enter-gallery', 'GalleryController@index');
Route::get('sports-gallery', 'GalleryController@index');
Route::get('edu-gallery', 'GalleryController@index');
Route::get('travel-gallery', 'GalleryController@index');
Route::get('hobby-gallery', 'GalleryController@index');
//갤러리 관련
Route::post('week-gallerys', 'GalleryController@week_gallerys');
Route::get('gallery-plus-m/{id}', 'GalleryController@m_gallery_index');
Route::get('gallery_cookiedelete/{id}', 'GalleryController@cookieDelete');
Route::get('gallery_search/{name}', 'GalleryController@gallery_search');
Route::any('gallery_link_gallery', 'GalleryController@link_gallery');
//게시글 관련
Route::get('gallery-post/{link}/{id}', 'PostController@show');
Route::post('plusHitPoint', 'PostController@plusHitPoint');
Route::post('plusBadPoint', 'PostController@plusBadPoint');
Route::post('plusGoodPoint', 'PostController@plusGoodPoint');
Route::post('saveScrap', 'PostController@saveScrap');
//공지사항 댓글
Route::post('notice-comment', 'CommentController@notice_store');
//관리자
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
