<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Database\Migrations\Migration;
//use Illuminate\Database\Schema\Blueprint;

use App\Visitor;
use App\Post;
use App\Post_hit;
use App\Gallery;
use App\Comment;
use App\Issue;
use App\Popup2;

class MainController extends Controller
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

    public function index(Request $request)
    {
        if($request->input('rank') && $request->input('page')) {
            $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                                ->groupBy('gallery_id')
                                ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                                ->orderby('total', 'desc')
                                ->limit(50)
                                ->paginate(10);
            $liveGallerys->withPath('?rank='.$request->input('rank'));

            return response()->json([
                'rank'=>$request->input('rank'),
                'page'=>$request->input('page'),
                'liveGallerys'=>$liveGallerys
            ]);
        }
        if($request->input('changeGallery') == 1) {
            $liveChanges = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                                ->groupBy('gallery_id')
                                ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                                ->orderby('total', 'desc')
                                ->limit(50)
                                ->paginate(50);
            return response()->json([
                'liveChanges'=>$liveChanges
            ]);
        }

        $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(50)
                            ->paginate(10);
        $liveGallerys->withPath('?rank=11');

        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $newGallerys = Gallery::select('name', 'link')
                      ->whereBetween('agree_date', [$todayFrom, $todayTo])
                      ->get();

        $visitorIp = $this->getUserIpAddr();
        $visitorArr = $request->session()->get('visitor');
        if($visitorArr == null) {
          $visitorArr = [];
        }
        if (!in_array($visitorIp, $visitorArr)) {
            $request->session()->push('visitor', $visitorIp);
        }

        $hitPosts = Post::join('post_hit', 'post.id', '=', 'post_hit.post_id')
            ->join('user', 'post.user_id', '=', 'user.id')
            ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
            'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
            'post.ip as post_ip',
            'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid',
            'gallery.name as gallery_name','gallery.link as gallery_link')
            ->orderby('post.id', 'desc')
            ->limit(4)
            ->get();

        $imgPosts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                          ->select('post.id as post_id', 'post.title as post_title', 'thumbnail',
                           'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                          ->where('post.contents', 'like', '%<img%')
                          ->orderby('post.id', 'desc')
                          ->limit(4)
                          ->get();
        $notIn = [];
        if(count($imgPosts) > 0) { //imgPosts 와 중복되지 않기 위함  ``
            $i = 0;
            foreach ($imgPosts as $imgPost) {
              $notIn[$i] = $imgPost->post_id;
              $i ++;
            }
        }
        $posts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                      ->select('post.id as post_id', 'post.title as post_title',
                       'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                      ->whereNotIn('post.id', $notIn) //포함하지 않는 것만 추출
                      ->orderby('post.id', 'desc')
                      ->limit(10)
                      ->get();

        return view('main', [
            'hitPosts' => $hitPosts,
            'imgPosts' => $imgPosts,
            'posts' => $posts,
            'liveGallerys' => $liveGallerys,
            'newGallerys' => $newGallerys,
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
            'issues' => $this->issues,
        ]);
    }

    public function visitor_save(Request $request)
    {
      date_default_timezone_set('Asia/Seoul');
      $visitorIp = $this->getUserIpAddr();
      $visitorTime = date('Y-m-d H:i:s');
      $visitorReferrer = $request->input('referrer');
      $visitorBrowser = $request->input('browser');

      $visied_cookie = Cookie::get('visited');
      if(!$visied_cookie) {
        Visitor::create([
            'ip' => $visitorIp,
            'time' => $visitorTime,
            'refer' => $visitorReferrer,
            'agent' => $visitorBrowser
        ]);
        Cookie::queue('visited', true, 60);
      }
      return response('ok');
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

    public function getPopupImage(){
        //메인화면 팝업 가져오기
        $popup2 = Popup2::select('image')
            ->where('status', 1)
            ->inRandomOrder()
            ->first();
        if($popup2) {
            $image = Storage::get($popup2->image); //이미지 가져와서 text 변환
            $image = base64_encode($image); //base64로 인코딩
        } else {
            $image = '';
        }
        return response()->json([
            'image'=>$image,
        ]);
    }
}
