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

    public function index(Request $request, $keyword) {
        if($request->input('rank') && $request->input('page')) {
            $result = $this->getLiveGalleryPageResult($request->input('rank'), $request->input('page'));
            return response()->json([
                'rank'=>$result['rank'],
                'page'=>$request->input('page'),
                'liveGallerys'=>$result['liveGallerys']
            ]);
        }

        $posts = Post::select(
                'post.id as post_id', 'post.title as post_title', 'post.contents as post_contents',
                'post.reg_date as post_reg_date',
                'gallery.name as gallery_name', 'gallery.link as gallery_link'
            )
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->where('post.title', 'like', '%'.$keyword.'%')
            ->orWhere('post.contents', 'like', '%'.$keyword.'%')
            ->limit(10)
            ->get();

        $gallerys = Gallery::where('name', 'like', '%'.$keyword.'%')
            ->limit(5)
            ->get();

        $todayIssues = Issue::select('keyword')->where('search_date', date('Y-m-d'))->orderby('count', 'desc')->limit(10)->get();

        //실북갤
        $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(50)
                            ->paginate(10);
        $liveGallerys->withPath('?rank=11');

        //신설갤
        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $newGallerys = Gallery::select('name', 'link')
                      ->whereBetween('agree_date', [$todayFrom, $todayTo])
                      ->get();

        //HIT게시글
        $hitPosts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                        ->select(
                            'post.id as post_id', 'post.title as post_title',
                            'post.reg_date as post_reg_date', 'post.thumbnail as post_thumbnail'
                        )
                        ->orderby('post.id', 'desc')
                        ->limit(3)
                        ->get();

        return view('search', [
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
            'issues' => $this->issues,

            'posts' => $posts,
            'gallerys' => $gallerys,
            'todayIssues' => $todayIssues,
            'keyword' => $keyword,
            'liveGallerys' => $liveGallerys,
            'newGallerys' => $newGallerys,
            'hitPosts' => $hitPosts,
        ]);
    }

    public function showMorePost(Request $request, $keyword) {
        if($request->input('rank') && $request->input('page')) {
            $result = $this->getLiveGalleryPageResult($request->input('rank'), $request->input('page'));
            return response()->json([
                'rank'=>$result['rank'],
                'page'=>$request->input('page'),
                'liveGallerys'=>$result['liveGallerys']
            ]);
        }

        $posts = Post::select(
                'post.id as post_id', 'post.title as post_title', 'post.contents as post_contents',
                'post.reg_date as post_reg_date',
                'gallery.name as gallery_name', 'gallery.link as gallery_link'
            )
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->where('post.title', 'like', '%'.$keyword.'%')
            ->orWhere('post.contents', 'like', '%'.$keyword.'%')
            ->limit(10)
            ->paginate(10, '[*]', 'postPage');

        $todayIssues = Issue::select('keyword')->where('search_date', date('Y-m-d'))->orderby('count', 'desc')->limit(10)->get();

        //실북갤
        $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(50)
                            ->paginate(10);
        $liveGallerys->withPath('?rank=11');

        //신설갤
        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $newGallerys = Gallery::select('name', 'link')
                      ->whereBetween('agree_date', [$todayFrom, $todayTo])
                      ->get();

        //HIT게시글
        $hitPosts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                        ->select(
                            'post.id as post_id', 'post.title as post_title',
                            'post.reg_date as post_reg_date', 'post.thumbnail as post_thumbnail'
                        )
                        ->orderby('post.id', 'desc')
                        ->limit(3)
                        ->get();

        return view('search-morePost', [
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
            'issues' => $this->issues,

            'posts' => $posts,
            'todayIssues' => $todayIssues,
            'keyword' => $keyword,
            'liveGallerys' => $liveGallerys,
            'newGallerys' => $newGallerys,
            'hitPosts' => $hitPosts,
        ]);
    }

    public function showMoreGallery(Request $request, $keyword) {
        if($request->input('rank') && $request->input('page')) {
            $result = $this->getLiveGalleryPageResult($request->input('rank'), $request->input('page'));
            return response()->json([
                'rank'=>$result['rank'],
                'page'=>$request->input('page'),
                'liveGallerys'=>$result['liveGallerys']
            ]);
        }

        $gallerys = Gallery::where('name', 'like', '%'.$keyword.'%')
            ->limit(5)
            ->paginate(10, '[*]', 'galleryPage');

        $todayIssues = Issue::select('keyword')->where('search_date', date('Y-m-d'))->orderby('count', 'desc')->limit(10)->get();

        //실북갤
        $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(50)
                            ->paginate(10);
        $liveGallerys->withPath('?rank=11');

        //신설갤
        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $newGallerys = Gallery::select('name', 'link')
                      ->whereBetween('agree_date', [$todayFrom, $todayTo])
                      ->get();

        //HIT게시글
        $hitPosts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
                        ->select(
                            'post.id as post_id', 'post.title as post_title',
                            'post.reg_date as post_reg_date', 'post.thumbnail as post_thumbnail'
                        )
                        ->orderby('post.id', 'desc')
                        ->limit(3)
                        ->get();

        return view('search-moreGallery', [
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
            'issues' => $this->issues,

            'gallerys' => $gallerys,
            'todayIssues' => $todayIssues,
            'keyword' => $keyword,
            'liveGallerys' => $liveGallerys,
            'newGallerys' => $newGallerys,
            'hitPosts' => $hitPosts,
        ]);
    }

    public function getLiveGalleryPageResult($rank) {
        $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(50)
                            ->paginate(10);
        $liveGallerys->withPath('?rank='.$rank);

        return ([
            'rank' => $rank,
            'liveGallerys' => $liveGallerys
        ]);
    }
}
