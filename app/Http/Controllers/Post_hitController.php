<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Gallery;
use App\Category;
use App\Comment;
use App\Popup;
use App\User;
use App\Post_hit;
use App\Notice;
use App\Issue;

class Post_hitController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Seoul');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->yPostCnt = Post::where('reg_date', $yesterday)->count();
        $this->yCommentCnt = Comment::where('reg_date', $yesterday)->count();
        $this->footer_gallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(10)
                            ->get();
        $this->issues = Issue::select('keyword')->orderby('count', 'desc')->limit(8)->get();
    }

    public function index(Request $request)
    {
        $list = Cookie::get('recentVisitGallery');

        if(strpos($list, 'HIT' . '/') === false) {
            $list = $list . 'HIT' . '/';
            $listArr = explode('/', $list);
            if(count($listArr) > 6) {
                array_splice($listArr, 0, 1);
            }
            $list = implode('/', $listArr);
        }
        Cookie::queue('recentVisitGallery', $list, 60);

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
        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '갤러리 중앙')
              ->inRandomOrder()
              ->first();
        if($popup) {
            $image = Storage::get($popup->image); //이미지 가져와서 text 변환
            $c_image = base64_encode($image); //base64로 인코딩
        } else {
            $c_image = '';
        }

        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $showCnt = 30;
        if($request->input('showCnt')) {
            $showCnt = $request->input('showCnt');
        }
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

        $top_imgPosts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->join('user', 'post.user_id', '=', 'user.id')
            ->select('post.id as post_id', 'post.title as post_title', 'post.contents as post_contents', 'thumbnail',
            'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link', 'user.nick as user_nick')
            ->where('post.contents', 'like', '%<img%')
            ->orderby('post.id', 'desc')
            ->limit(1)
            ->get();
        $notIn = [];
        if(count($top_imgPosts) > 0) { //imgPosts 와 중복되지 않기 위함  ``
            $i = 0;
            foreach ($top_imgPosts as $imgPost) {
              $notIn[$i] = $imgPost->post_id;
              $i ++;
            }
        }
        $top_posts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->select('post.id as post_id', 'post.title as post_title',
            'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
            ->whereNotIn('post.id', $notIn) //포함하지 않는 것만 추출
            ->orderby('post.id', 'desc')
            ->limit(5)
            ->get();

        return view('gallery-hit', [
            'r_image' => $r_image,
            'c_image' => $c_image,
            'recentGallerys' => $recentGallerys,
            'select_head' => $head,
            'showCnt' => $showCnt,
            'n_posts' => $n_posts,
            'posts' => $posts,
            'search_type' => $search_type,
            'top_imgPosts' => $top_imgPosts,
            'top_posts' => $top_posts,
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
            'issues' => $this->issues,
        ]);
    }

    public function show(Request $request, $id)
    {
        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $post = Post::findOrFail($id);

        Post::where('id', $id)->update([
            'view' => $post->view + 1
        ]);

        $post = Post::join('user', 'post.user_id', '=', 'user.id')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->select('post.*', 'post.ip as post_ip', 'user.nick as user_nick', 'user.id as user_id', 'gallery.link as gallery_link')
            ->where('post.id', '=', $id)
            ->first();

        $comments = Comment::join('post', 'comment.post_id', '=', 'post.id')
                      ->select('comment.*')
                      ->where('comment.post_id', '=', $id)
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

        return view('gallery-post-hit', [
            'select_head' => $head,
            'search_type' => $search_type,
            'recentGallerys' => $recentGallerys,
            'post' => $post,
            'comments' => $comments,
            'n_posts' => $n_posts,
            'posts' => $posts,
            'r_image' => $r_image,
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
            'issues' => $this->issues,
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
                    ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                    'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                    'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
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
