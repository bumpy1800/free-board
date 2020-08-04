<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Gallery;                     //ORM
use App\Post;
use App\User;
use App\Comment;
use App\Guestbook;
use App\Scrap;

class GallogController extends Controller
{
    public function __construct()
    {
        //한국시간으로 설정
        date_default_timezone_set('Asia/Seoul');
    }

    public function index(Request $request, $uid)
    {
        $posts = [];
        $comments = [];
        $scraps = [];
        $guestbooks = [];
        //메뉴 active 효과를 구분하기 위해 사용
        $menu_active = 1;

        //유저정보
        $user = $this->getUser($uid);
        //해당 유저의 데이터를 가져옴
        $posts = $this->getPosts(3, $user->id);
        $comments = $this->getComments(3, $user->id);
        $scraps = $this->getScraps(3, $user->id);
        $guestbooks = $this->getGuestbooks(3, $user->id);

        //각 페이지의 Parameter들을 가져옴
        $post_page = '';
        $comment_page = '';
        $scrap_page = '';
        $guestbook_page = '';
        if($request->input('post_page')) {
            $post_page = $request->input('post_page');
        }
        if($request->input('comment_page')) {
            $comment_page = $request->input('comment_page');
        }
        if($request->input('scrap_page')) {
            $scrap_page = $request->input('scrap_page');
        }
        if($request->input('guestbook_page')) {
            $guestbook_page = $request->input('guestbook_page');
        }
        //페이지네이션 URL 설정
        $posts->withPath('?comment_page='.$comment_page.'&scrap_page='.$scrap_page.'&guestbook_page='.$guestbook_page);
        $comments->withPath('?post_page='.$post_page.'&scrap_page='.$scrap_page.'&guestbook_page='.$guestbook_page);
        $scraps->withPath('?post_page='.$post_page.'&comment_page='.$comment_page.'&guestbook_page='.$guestbook_page);
        $guestbooks->withPath('?post_page='.$post_page.'&comment_page='.$comment_page.'&scrap_page='.$scrap_page);

        return view('gallog', [
            'menu_active' => $menu_active,
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
            'scraps' => $scraps,
            'guestbooks' => $guestbooks,
        ]);
    }

    public function post_index(Request $request, $uid)
    {
        $posts = [];
        $menu_active = 2;

        $user = $this->getUser($uid);
        $posts = $this->getPosts(10, $user->id);

        return view('gallog2', [
            'menu_active' => $menu_active,
            'user' => $user,
            'posts' => $posts
        ]);
    }

    public function comment_index(Request $request, $uid)
    {
        $comments = [];
        $menu_active = 3;

        $user = $this->getUser($uid);
        $comments = $this->getComments(10, $user->id);

        return view('gallog3', [
            'menu_active' => $menu_active,
            'user' => $user,
            'comments' => $comments
        ]);
    }

    public function scrap_index(Request $request, $uid)
    {
        $scraps = [];
        $menu_active = 4;

        $user = $this->getUser($uid);
        $scraps = $this->getScraps(10, $user->id);

        return view('gallog4', [
            'menu_active' => $menu_active,
            'user' => $user,
            'scraps' => $scraps
        ]);
    }

    public function guestbook_index(Request $request, $uid)
    {
        $guestbooks = [];
        $menu_active = 5;

        $user = $this->getUser($uid);

        //GET형식으로 받은 year값에 따라 DB조회를 다르게 함
        //year값이 있으면 값을 넣어주고 없으면 공백상태
        $year = '';
        if($request->input('year')) {
            $year = $request->input('year');
        }

        $guestbooks = $this->getGuestbooks(10, $user->id, $year);

        //년도별로 조회하는 기능을 위해서 최소년도와 최대년도를 구함
        $max = Guestbook::where('user_id', '=', $user->id)
            ->max('reg_date');
        $min = Guestbook::where('user_id', '=', $user->id)
            ->min('reg_date');
        $max = date("Y", strtotime($max));
        $min = date("Y", strtotime($min));

        return view('gallog5', [
            'menu_active' => $menu_active,
            'user' => $user,
            'guestbooks' => $guestbooks,
            'max' => $max,
            'min' => $min,
            'select_year' => $year
        ]);
    }

    //방명록 글 저장
    public function guestbook_store(Request $request, $uid)
    {
        $guestbooks = [];

        $user = $this->getUser($uid);
        $guestbooks = $this->getGuestbooks(10, $user->id);
        $menu_active = 5;

        //등록
        $write_user_id = Auth::user()->id;
        $user_id = $user->id;
        $contents = $request->input('contents');
        $secret = 0;
        if($request->input('secret') == 1) {
            $secret = 1;
        }
        $reg_date = date('Y-m-d H:i:s');

        Guestbook::create([
            'write_user_id' => $write_user_id,
            'user_id' => $user_id,
            'contents' => $contents,
            'secret' => $secret,
            'reg_date' => $reg_date,
        ]);
        return redirect('gallog-guestbook/'. $uid);
    }

    //방명록 글 수정
    public function guestbook_update(Request $request, $uid)
    {
        //guestbook의 id값
        $id = $request->input('id');
        //geustbook 수정한 내용
        $contents = $request->input('contents');

        Guestbook::where('id', $id)->update([
          'contents' => $contents,
        ]);
        return response()->json([
            'guestbook_update' => true
        ]);
    }
    //방명록 글 삭제
    public function guestbook_destroy(Request $request, $uid)
    {
        $id = $request->input('id');

        Guestbook::destroy($id);
        return response()->json([
            'guestbook_destroy' => true
        ]);
    }

    //방명록 글 비공개
    public function guestbook_hidden(Request $request, $uid)
    {
        $id = $request->input('id');

        Guestbook::where('id', $id)->update([
          'secret' => 1,
        ]);
        return response()->json([
            'guestbook_hidden' => true
        ]);
    }
    //방명록 글 공개
    public function guestbook_open(Request $request, $uid)
    {
        $id = $request->input('id');

        Guestbook::where('id', $id)->update([
          'secret' => 0,
        ]);
        return response()->json([
            'guestbook_open' => true
        ]);
    }

    public function getUser($uid) {
        //유저 아이디
        if($uid) {
            $uid = $uid;
        } else {
            $uid = '';
        }
        //유저 정보
        $user = User::select('*')->where('uid', $uid)->first();
        return $user;
    }

    public function getPosts($page, $id) {
        return Post::join('user', 'post.user_id', '=', 'user.id')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->select('post.title as post_title', 'post.contents as post_contents',
            'post.reg_date as post_reg_date', 'post.id as post_id',
            'gallery.name as gallery_name', 'gallery.link as gallery_link')
            ->where('user.id', '=', $id)
            ->orderby('post.reg_date', 'desc')
            ->paginate($page, ["*"], "post_page");
    }

    public function getComments($page, $id) {
        $id = Auth::user()->id;
        return Comment::join('user', 'comment.user_id', '=', 'user.id')
            ->join('post', 'comment.post_id', '=', 'post.id')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->select('comment.contents as comment_contents',
            'comment.reg_date as comment_reg_date', 'comment.id as comment_id',
            'post.id as post_id', 'post.title as post_title',
            'gallery.name as gallery_name', 'gallery.link as gallery_link')
            ->where('user.id', '=', $id)
            ->orderby('comment.reg_date', 'desc')
            ->paginate($page, ["*"], "comment_page");
    }

    public function getScraps($page, $id) {
        return Scrap::join('post', 'scrap.post_id', '=', 'post.id')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->select('post.title as post_title', 'post.contents as post_contents',
            'post.reg_date as post_reg_date', 'post.id as post_id',
            'gallery.name as gallery_name', 'gallery.link as gallery_link')
            ->where('scrap.user_id', '=', $id)
            ->orderby('post.reg_date', 'desc')
            ->paginate($page, ["*"], "scrap_page");
    }

    public function getGuestbooks($page, $id, $year = null) {
        if($year == '' || $year == null) {
            return Guestbook::join('user', 'guestbook.write_user_id', '=', 'user.id')
                ->select('user.nick as user_nick', 'guestbook.contents as guestbook_contents',
                'guestbook.reg_date as guestbook_reg_date', 'guestbook.user_id as guestbook_user_id',
                'guestbook.write_user_id as guestbook_write_user_id', 'guestbook.secret as guestbook_secret',
                'guestbook.id as guestbook_id')
                ->where('guestbook.user_id', '=', $id)
                ->orderby('guestbook.reg_date', 'desc')
                ->paginate($page, ["*"], "guestbook_page");
        } else {
            $startFromDate = date($year.'-01-01 01:01:01');
            $startToDate = date($year.'-12-31 23:59:59');
            return Guestbook::join('user', 'guestbook.write_user_id', '=', 'user.id')
                ->select('user.nick as user_nick', 'guestbook.contents as guestbook_contents',
                'guestbook.reg_date as guestbook_reg_date', 'guestbook.user_id as guestbook_user_id',
                'guestbook.write_user_id as guestbook_write_user_id', 'guestbook.secret as guestbook_secret')
                ->where('guestbook.user_id', '=', $id)
                ->whereBetween('guestbook.reg_date', [$startFromDate, $startToDate])
                ->orderby('guestbook.reg_date', 'desc')
                ->paginate($page, ["*"], "guestbook_page");
        }
    }

}
