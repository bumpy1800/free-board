<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;

use App\Post;
use App\Gallery;
use App\Link_gallery;
use App\Category;
use App\Comment;
use App\Popup;
use App\User;
use App\Post_hit;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $gallery_link = $request->input('link');
        $gallery = Gallery::select('id','link','heads', 'name')
            ->where('link', $gallery_link)
            ->first();

        $link_gallerys = Link_gallery::where('gallery_id', $gallery->id)->count();

        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $heads = explode('/', $gallery->heads);

        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '글쓰기 중앙')
              ->inRandomOrder()
              ->first();
        if($popup) {
            $image = Storage::get($popup->image); //이미지 가져와서 text 변환
            $image = base64_encode($image); //base64로 인코딩
        } else {
            $image = '';
        }

        return view('gallery-post-write', [
            'gallery_name' => $gallery->name,
            'gallery_id' => $gallery->id,
            'gallery_link' => $gallery->link,
            'heads' => $heads,
            'image' => $image,
            'link_gallerys' => $link_gallerys,
            'recentGallerys' => $recentGallerys,
        ]);
    }

    public function store(Request $request)
    {
        $title = $request->input('tit');
        $contents = $request->input('content');
        $user_id = 1;
        $reg_date = date("Y-m-d");
        $ip = $this->getUserIpAddr();
        $view = 0;
        $good = 0;
        $bad = 0;
        $comments = 0;
        $hits = 0;
        $head = $request->input('head');
        $notice = 0;
        $gallery_id = $request->input('idH');
        $password = $request->input('password');
        $thumbnail = '';

        $gallery_link = $request->input('link');

        $startPos = strpos($contents, '<img src="');
        if($startPos !== false) {
            $startPos = $startPos + 10;
            $endPos = strpos($contents, '"', $startPos);
            $thumbnail = substr($contents, $startPos, $endPos-$startPos);
        }

        Post::create([
            'title' => $title,
            'contents' => $contents,
            'user_id' => $user_id,
            'reg_date' => $reg_date,
            'ip' => $ip,
            'view' => $view,
            'good' => $good,
            'bad' => $bad,
            'comments' => $comments,
            'hits' => $hits,
            'head' => $head,
            'notice' => $notice,
            'gallery_id' => $gallery_id,
            'password' => $password,
            'thumbnail' => $thumbnail
        ]);
        return redirect(route('gallery.show', $gallery_link));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $link, $id)
    {
        $gallery = Gallery::select('*')->where('link', $link)->first();
        $link_gallerys = Link_gallery::where('gallery_id', $gallery->id)->count();

        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $post = Post::findOrFail($id);

        Post::where('id', $id)->update([
            'view' => $post->view + 1
        ]);

        $post = Post::join('user', 'post.user_id', '=', 'user.id')
                      ->select('post.*', 'post.ip as post_ip', 'user.nick as user_nick')
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
          $showPost = $this->showSearchPost($gallery->id, $showCnt, $search_type, $search_keyword);
        } else {
          $showPost = $this->showPost($gallery->id, $showCnt, $head);
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

        return view('gallery-post', [
            'select_head' => $head,
            'search_type' => $search_type,
            'link_gallerys' => $link_gallerys,
            'recentGallerys' => $recentGallerys,
            'gallery' => $gallery,
            'post' => $post,
            'comments' => $comments,
            'n_posts' => $n_posts,
            'posts' => $posts,
            'r_image' => $r_image,
        ]);
    }

    public function showSearchPost($gallery_id, $showCnt, $search_type, $search_keyword) {
        $n_posts = [];
        $posts = [];

        $n_posts = $this->showNoticePost($gallery_id);
        $limit = $showCnt - count($n_posts);

        if($search_type == 'search_all') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where(function($query) use ($gallery_id, $search_keyword) {
                    $query->where('post.title', 'like', '%'.$search_keyword.'%')
                          ->orWhere('post.contents', 'like', '%'.$search_keyword.'%')
                          ->orWhere('user.nick', 'like', '%'.$search_keyword.'%');
                })
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_subject') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where('post.title', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_memo') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where('post.contents', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_name') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where('user.nick', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_subject_memo') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
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

    public function showNoticePost($gallery_id) {
        $n_posts = [];
        $n_posts = Post::join('user', 'post.user_id', '=', 'user.id')
            ->select('post.id as post_id', 'post.title as post_title', 'post.comments as post_comments',
            'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good','user.nick as user_nick')
            ->where('post.gallery_id', $gallery_id)
            ->where('post.notice', 1)
            ->orderby('post.id', 'desc')
            ->get();
        return $n_posts;
    }

    public function showPost($gallery_id, $showCnt, $head) {
        $n_posts = [];
        $posts = [];
        $n_posts = $this->showNoticePost($gallery_id);
        $limit = $showCnt - count($n_posts);
        if($head != '공지') {
            if($head == '') {
                $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                    ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                    'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                    'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                    ->where('post.gallery_id', $gallery_id)
                    ->orderby('post.id', 'desc')
                    ->paginate($limit);

            } else {
                $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                    ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                    'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                    'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                    ->where('post.gallery_id', $gallery_id)
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


    public function edit(Request $request, $id)
    {
        //$post = Post::findOrFail($id);
        $gallery_link = $request->input('link');
        $gallery = Gallery::select('id','link','heads', 'name')
            ->where('link', $gallery_link)
            ->first();

        $link_gallerys = Link_gallery::where('gallery_id', $gallery->id)->count();

        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $heads = explode('/', $gallery->heads);

        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '글쓰기 중앙')
              ->inRandomOrder()
              ->first();
        if($popup) {
            $image = Storage::get($popup->image); //이미지 가져와서 text 변환
            $image = base64_encode($image); //base64로 인코딩
        } else {
            $image = '';
        }

        $post = Post::select('*')
                      ->where('post.id', $id)
                      ->first();
        $user = User::select('*')
            ->where('id', $post->user_id)
            ->first();
        return view('gallery-post-edit', [
            'gallery_name' => $gallery->name,
            'gallery_id' => $gallery->id,
            'gallery_link' => $gallery->link,
            'heads' => $heads,
            'image' => $image,
            'link_gallerys' => $link_gallerys,
            'recentGallerys' => $recentGallerys,
            'post' => $post,
            'user' => $user,
        ]);
    }


    public function update(Request $request, $id)
    {
        $title = $request->input('tit');
        $contents = $request->input('content');
        $user_id = 1;
        $ip = $this->getUserIpAddr();
        $head = $request->input('head');
        $notice = 0;
        $gallery_id = $request->input('idH');
        $password = $request->input('password');
        $thumbnail = '';

        $gallery_link = $request->input('link');

        $startPos = strpos($contents, '<img src="');
        if($startPos !== false) {
            $startPos = $startPos + 10;
            $endPos = strpos($contents, '"', $startPos);
            $thumbnail = substr($contents, $startPos, $endPos-$startPos);
        }

        Post::where('id', $id)->update([
          'title' => $title,
          'contents' => $contents,
          'user_id' => $user_id,
          'ip' => $ip,
          'head' => $head,
          'notice' => $notice,
          'gallery_id' => $gallery_id,
          'password' => $password,
          'thumbnail' => $thumbnail
      ]);
      return redirect(url('gallery-post/'.$gallery_link.'/'.$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        Post_hit::where('post_id', $id)->delete();
        Post::destroy($id);
        Comment::where('post_id', $id)->delete();
        $gallery_link = $request->input('link');
        return redirect(route('gallery.show', $gallery_link));
    }

    public function plusHitPoint(Request $request) {
        $post_id = $request->input('id');
        $list = Cookie::get('hitPointList');

        if(strpos($list, $post_id . '/') === false) {
            $list = $list . $post_id . '/';
            $post = Post::select('hits')->where('id', $post_id)->first();

            if($post->hits >= 5) {
                $post_hit = Post_hit::select('post_id')->where('post_id', $post_id)->first();
                if($post_hit == null) {
                    Post_hit::create([
                      'post_id' => $post_id,
                    ]);
                }
            }

            Post::where('id', $post_id)->increment('hits');
            Cookie::queue('hitPointList', $list, 1440);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function plusGoodPoint(Request $request) {
        $post_id = $request->input('id');
        $list = Cookie::get('goodBadPointList');

        if(strpos($list, $post_id . '/') === false) {
            $list = $list . $post_id . '/';
            Post::where('id', $post_id)->increment('good');
            Cookie::queue('goodBadPointList', $list, 1440);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function plusBadPoint(Request $request) {
        $post_id = $request->input('id');
        $list = Cookie::get('goodBadPointList');

        if(strpos($list, $post_id . '/') === false) {
            $list = $list . $post_id . '/';
            Post::where('id', $post_id)->increment('bad');
            Cookie::queue('goodBadPointList', $list, 1440);
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false
            ]);
        }
    }

    public function getUserIpAddr(){
       $ipaddress = '';
       if (isset($_SERVER['HTTP_CLIENT_IP']))
           $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
       else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_X_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
       else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_FORWARDED'];
       else if(isset($_SERVER['REMOTE_ADDR']))
           $ipaddress = $_SERVER['REMOTE_ADDR'];
       else
           $ipaddress = 'UNKNOWN';
       return $ipaddress;
    }
}
