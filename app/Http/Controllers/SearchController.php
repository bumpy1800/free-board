<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Post;
use App\Gallery;
use App\Comment;
use App\Issue;

class SearchController extends Controller
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
        $this->issues = Issue::select('keyword')->where('search_date', date('Y-m-d'))->orderby('count', 'desc')->limit(8)->get();
    }

    public function index($keyword) {

        $posts = Post::select('post.title as post_title', 'post.contents as post_contents',
            'post.reg_date as post_reg_date',
            'gallery.name as gallery_name', 'gallery.link as gallery_link')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->where('post.title', 'like', '%'.$keyword.'%')
            ->orWhere('post.contents', 'like', '%'.$keyword.'%')
            ->get();
        $gallerys = Gallery::where('name', 'like', '%'.$keyword.'%')
            ->get();

        $todayIssues = Issue::select('keyword')->where('search_date', date('Y-m-d'))->orderby('count', 'desc')->limit(10)->get();

        return view('search', [
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
            'issues' => $this->issues,

            'posts' => $posts,
            'gallerys' => $gallerys,
            'todayIssues' => $todayIssues,
            'keyword' => $keyword,
        ]);
    }

}
