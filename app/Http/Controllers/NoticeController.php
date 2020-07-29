<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

use App\Notice;
use App\Comment;
use App\Post;
use App\Popup;

class NoticeController extends Controller
{
    public function index(Request $request)
    {
        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $showCnt = 30;
        if($request->input('showCnt')) {
            $showCnt = $request->input('showCnt');
        }

        $search_keyword = '';
        $showPost = '';
        if($request->input('search_keyword')) {
            $search_keyword = $request->input('search_keyword');
            $n_posts = Notice::select('*')
              ->where(function($query) use ($search_keyword) {
                  $query->where('title', 'like', '%'.$search_keyword.'%')
                        ->orWhere('contents', 'like', '%'.$search_keyword.'%');
              })
              ->orderby('id', 'desc')
              ->paginate($showCnt);
        } else {
            $n_posts = Notice::select('*')
                ->orderby('id', 'desc')
                ->paginate($showCnt);
        }

        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '갤러리 우측')
              ->inRandomOrder()
              ->first();
        if($popup) {
            $image = Storage::get($popup->image); //이미지 가져와서 text 변환
            $r_image = base64_encode($image); //base64로 인코딩
        } else {
            $r_image = '';
        }
        return view('gallery-notice', [
            'n_posts' => $n_posts,
            'showCnt' => $showCnt,
            'r_image' => $r_image
        ]);
    }

    public function show(Request $request, $id)
    {
        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $notice = Notice::findOrFail($id);
        notice::where('id', $id)->update([
            'view' => $notice->view + 1
        ]);

        $comments = Comment::join('notice', 'comment.notice_id', '=', 'notice.id')
                      ->select('comment.*')
                      ->where('comment.notice_id', '=', $id)
                      ->orderby('comment.id')
                      ->get();

        $showCnt = 30;
        $head = '';
        if($request->input('head')) {
          $head = $request->input('head');
        }
        $search_type = '';
        $search_keyword = '';
        $showPost = '';
        if($request->input('search_keyword')) {
          $search_type = $request->input('search_type');
          $search_keyword = $request->input('search_keyword');
          $showPost = $this->showSearchPost($showCnt, $search_type, $search_keyword);
        } else {
          $showPost = $this->showPost($showCnt, $head);
        }
        $n_posts = $showPost['n_posts'];
        $posts = $showPost['posts'];

        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '갤러리 우측')
              ->inRandomOrder()
              ->first();
        if($popup) {
            $image = Storage::get($popup->image); //이미지 가져와서 text 변환
            $r_image = base64_encode($image); //base64로 인코딩
        } else {
            $r_image = '';
        }

        return view('gallery-post-notice', [
            'select_head' => $head,
            'search_type' => $search_type,
            'recentGallerys' => $recentGallerys,
            'notice' => $notice,
            'comments' => $comments,
            'n_posts' => $n_posts,
            'posts' => $posts,
            'r_image' => $r_image,
        ]);
    }

    public function showSearchPost($showCnt, $search_type, $search_keyword) {
        $n_posts = [];
        $posts = [];

        $n_posts = $this->showNoticePost();
        $limit = $showCnt - count($n_posts);

        if($search_type == 'search_all') {
            $posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                ->join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where(function($query) use ($search_keyword) {
                    $query->where('post.title', 'like', '%'.$search_keyword.'%')
                          ->orWhere('post.contents', 'like', '%'.$search_keyword.'%')
                          ->orWhere('user.nick', 'like', '%'.$search_keyword.'%');
                })
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_subject') {
            $posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                ->join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.title', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_memo') {
            $posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                ->join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.contents', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_name') {
            $posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                ->join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('user.nick', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_subject_memo') {
            $posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                ->join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.title', 'like', '%'.$search_keyword.'%')
                ->where('post.contents', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        }
        return [
            'n_posts' => $n_posts,
            'posts' => $posts
        ];
    }

    public function showNoticePost() {
        $n_posts = [];
        $n_posts = Notice::select('*')
            ->orderby('id', 'desc')
            ->get();
        return $n_posts;
    }

    public function showPost($showCnt, $head) {
        $n_posts = [];
        $posts = [];
        $n_posts = $this->showNoticePost();
        $limit = $showCnt - count($n_posts);
        if($head != '공지') {
            if($head == '') {
                $posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                    ->join('user', 'post.user_id', '=', 'user.id')
                    ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
                    ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                    'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                    'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid', 'gallery.link as gallery_link')
                    ->orderby('post.id', 'desc')
                    ->paginate($limit);
            } else {
                $posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                    ->join('user', 'post.user_id', '=', 'user.id')
                    ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                    'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                    'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                    ->where('post.head', $head)
                    ->orderby('post.id', 'desc')
                    ->paginate($limit);
            }
            $posts->withPath('?showCnt='.$showCnt);
        }
        return [
            'n_posts' => $n_posts,
            'posts' => $posts
        ];
    }
}
