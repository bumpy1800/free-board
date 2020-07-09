<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Post;
use App\Gallery;
use App\Category;
use App\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$posts = Post::all();
      $posts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                    /*->join('users', 'post.user_id', '=', 'user.id')
                    ->select('post.*', 'gallery.name as gallery_name', 'user.name as user_name')*/
                    ->select('post.*', 'gallery.name as gallery_name', 'gallery.link as gallery_link')
                    ->get();

      return view('admin.post-list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         return view('admin.post-add-form');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
       /*$messages = [
           'title.required'    => '제목을 입력해주세요.',
           'contents.required'    => '내용을 입력해주세요.',
           'gallery_id.required' => '갤러리를 선택해주세요.',
           'password.required'      => '암호를 입력해주세요.'
       ];
       $validator = Validator::make($request->all(), [
           'title' => 'required',
           'contents' => 'required',
           'gallery_id' => 'required',
           'password' => 'required'
       ], $messages);
       if ($validator->fails()) {
           return redirect(route('admin_post.create'))
               ->withInput()
               ->withErrors($validator);
       }*/

       $title = $request->input('tit');
       $contents = $request->input('content');
       $user_id = 1;
       $reg_date = date("Y-m-d");
       $ip = $this->getUserIpAddr();
       $view = 0;
       $good = 0;
       $bad = 0;
       $comments = 0;
       $head = $request->input('head');
       $notice = 0;
       $gallery_id = $request->input('idH');
       $password = $request->input('password');

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
           'head' => $head,
           'notice' => $notice,
           'gallery_id' => $gallery_id,
           'password' => $password
       ]);
       return redirect(route('admin_post.index'));
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($link, $id)
    {
      $post = Post::findOrFail($id);

      Post::where('id', $id)->update([
          'view' => $post->view + 1
      ]);

      $post = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                    //->join('comment', 'post.id', '=', 'comment.post_id')
                    ->select('post.*', 'post.ip as post_ip', 'gallery.name as gallery_name', 'gallery.link as gallery_link')
                    ->where('gallery.link', '=', $link)
                    ->where('post.id', '=', $id)
                    ->first();

      $comments = Comment::join('post', 'comment.post_id', '=', 'post.id')
                    ->select('comment.*')
                    ->orderby('comment.id')
                    ->get();

      return view('admin.post-show', ['post' => $post], ['comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$post = Post::findOrFail($id);
        $post = Post::find($id)
                      ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
                      ->select('post.*' ,'gallery.id as gallery_id', 'gallery.name as gallery_name', 'gallery.heads as gallery_heads')
                      ->first();
        //exit($post);
        return view('admin.post-edit-form', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'title.required'    => '제목을 입력해주세요.',
            'contents.required'    => '내용을 입력해주세요.',
            'gallery_id.required' => '갤러리를 선택해주세요.',
            'password.required'      => '암호를 입력해주세요.'
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'contents' => 'required',
            'gallery_id' => 'required',
            'password' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_post.edit', $id))
                ->withInput()
                ->withErrors($validator);
        }

        $title = $request->input('tit');
        $contents = $request->input('content');
        $user_id = 1;
        $reg_date = date("Y-m-d");
        $ip = $this->getUserIpAddr();
        $head = $request->input('head');
        $notice = 0;
        $gallery_id = $request->input('idH');
        $password = $request->input('password');

        Post::where('id', $id)->update([
          'title' => $title,
          'contents' => $contents,
          'user_id' => $user_id,
          'reg_date' => $reg_date,
          'ip' => $ip,
          'head' => $head,
          'notice' => $notice,
          'gallery_id' => $gallery_id,
          'password' => $password
      ]);

      return redirect(route('admin_post.index'));
        //return redirect(route('admin_post.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Post::destroy($id);
      return redirect(route('admin_post.index'));
    }

    public function galleryFind(Request $request)
    {
      if($search = $request->input('search')) {
        $results = Gallery::where('name', 'like', '%'.$search.'%')->paginate(5);
      }
      else
        $results = Gallery::paginate(5);


      return view('find', ['results' => $results]);
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

    /* 게시글과 댓글 통계 */
    public function stat_index()
    {
        $nowMonth = date('Y-m', time());
        $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수

        $today = date('Y-m-d', time());
        $postTotalCnt = Post::count();
        $postTodayCnt = Post::where('reg_date', $today)->count();
        $commentTotalCnt = Comment::count();
        $commentTodayCnt = Comment::where('reg_date', $today)->count();

        $gallerys = Gallery::all();

        return view('admin.post-stat', [
          'nowMonth' => $nowMonth,
          'nowMonthDayCount' => $nowMonthDayCount,
          'postTotalCnt' => $postTotalCnt,
          'postTodayCnt' => $postTodayCnt,
          'commentTotalCnt' => $commentTotalCnt,
          'commentTodayCnt' => $commentTodayCnt,
          'gallerys' => $gallerys
        ]);
    }

    public function stat_change(Request $request)
    {
        $statChangeBool = $request->input('statChangeBool'); // 첫페이지 0
        $tabSelectBool = $request->input('tabSelectBool'); //첫페이지 0
        $nowMonth = $request->input('nowMonth');
        $nowMonthDayCount = date('t', strtotime($nowMonth));
        $gallery_id = 0; //갤러리id 값이 없을 때

        switch ($statChangeBool) {
          case 1: //날짜선택 차트
            switch ($tabSelectBool) {
              case 0:
                $selectAreaChart = $this->postSelect($nowMonth, $nowMonthDayCount);
                $selectAreaChartLabel = $selectAreaChart[0];
                $selectAreaChartData = $selectAreaChart[1];
                $selectAreaChartMax = $selectAreaChart[2];
                break;
              default:
                $selectAreaChart = $this->commentSelect($nowMonth, $nowMonthDayCount);
                $selectAreaChartLabel = $selectAreaChart[0];
                $selectAreaChartData = $selectAreaChart[1];
                $selectAreaChartMax = $selectAreaChart[2];
            }
            return response()->json([
              'selectAreaChartLabel'=>$selectAreaChartLabel,
              'selectAreaChartData'=>$selectAreaChartData,
              'selectAreaChartMax'=>$selectAreaChartMax
            ]);
            break;
          case 2: //게시글 파이차트
            $gallery_id = $request->input('gallery_id'); //카테고리 값 받음
            $galleryPieChart = $this->galleryPieChart($gallery_id);
            $galleryPieChartLabel = $galleryPieChart[0];
            $galleryPieChartData = $galleryPieChart[1];
            return response()->json([
              'galleryPieChartLabel'=>$galleryPieChartLabel,
              'galleryPieChartData'=>$galleryPieChartData
            ]);
            break;
          default: // 첫페이지
            $selectAreaChart = $this->postSelect($nowMonth, $nowMonthDayCount);
            $selectAreaChartLabel = $selectAreaChart[0];
            $selectAreaChartData = $selectAreaChart[1];
            $selectAreaChartMax = $selectAreaChart[2];

            $dayAreaChart = $this->dayAreaChart();
            $dayAreaChartLabel = $dayAreaChart[0];
            $dayAreaChartData = $dayAreaChart[1];
            $dayAreaChartMax = $dayAreaChart[2];

            $monthBarChart = $this->monthBarChart();
            $monthBarChartLabel = $monthBarChart[0];
            $monthBarChartData = $monthBarChart[1];
            $monthBarChartMax = $monthBarChart[2];

            $dayAreaChart = $this->cdayAreaChart();
            $cdayAreaChartLabel = $dayAreaChart[0];
            $cdayAreaChartData = $dayAreaChart[1];
            $cdayAreaChartMax = $dayAreaChart[2];

            $monthBarChart = $this->cmonthBarChart();
            $cmonthBarChartLabel = $monthBarChart[0];
            $cmonthBarChartData = $monthBarChart[1];
            $cmonthBarChartMax = $monthBarChart[2];

            $galleryPieChart = $this->galleryPieChart($gallery_id);
            $galleryPieChartLabel = $galleryPieChart[0];
            $galleryPieChartData = $galleryPieChart[1];

            return response()->json([
              'selectAreaChartLabel'=>$selectAreaChartLabel,
              'selectAreaChartData'=>$selectAreaChartData,
              'selectAreaChartMax'=>$selectAreaChartMax,
              'dayAreaChartLabel'=>$dayAreaChartLabel,
              'dayAreaChartData'=>$dayAreaChartData,
              'dayAreaChartMax'=>$dayAreaChartMax,
              'monthBarChartLabel'=>$monthBarChartLabel,
              'monthBarChartData'=>$monthBarChartData,
              'monthBarChartMax'=>$monthBarChartMax,
              'cdayAreaChartLabel'=>$cdayAreaChartLabel,
              'cdayAreaChartData'=>$cdayAreaChartData,
              'cdayAreaChartMax'=>$cdayAreaChartMax,
              'cmonthBarChartLabel'=>$cmonthBarChartLabel,
              'cmonthBarChartData'=>$cmonthBarChartData,
              'cmonthBarChartMax'=>$cmonthBarChartMax,
              'galleryPieChartLabel'=>$galleryPieChartLabel,
              'galleryPieChartData'=>$galleryPieChartData
            ]);
        }
    }

    public function postSelect($nowMonth, $nowMonthDayCount) {
      for($i = 0; $i < $nowMonthDayCount; $i ++) {
        $selectAreaChartLabel[$i] = $i+1 . "일";
        $day = $i+1;
        if($day < 10) {
          $day = '0' . $day;
        }
        $reg_date[$i] = date($nowMonth . '-' . $day);
        $selectAreaChartData[$i] = Post::where('reg_date', $reg_date[$i])->count();
      }
      $selectAreaChartMax = max($selectAreaChartData);
      return [$selectAreaChartLabel, $selectAreaChartData, $selectAreaChartMax];
    }

    public function commentSelect($nowMonth, $nowMonthDayCount) {
      for($i = 0; $i < $nowMonthDayCount; $i ++) {
        $selectAreaChartLabel[$i] = $i+1 . "일";
        $day = $i+1;
        if($day < 10) {
          $day = '0' . $day;
        }
        $reg_date[$i] = date($nowMonth . '-' . $day);
        $selectAreaChartData[$i] = Comment::where('reg_date', $reg_date[$i])->count();
      }
      $selectAreaChartMax = max($selectAreaChartData);
      return [$selectAreaChartLabel, $selectAreaChartData, $selectAreaChartMax];
    }

    public function dayAreaChart(){
      $endDay = date('Y-m-d', time());
      $startDay = date('Y-m-d', strtotime($endDay.'-6days'));
      $startDay_m = date('m', strtotime($startDay));
      $startDay_d = date('d', strtotime($startDay));

      for($i = 0; $i < 7; $i ++) {
        $dayAreaChartLabel[$i] = $startDay_m . "월" . $startDay_d . "일";
        $reg_date[$i] = $startDay;
        $dayAreaChartData[$i] = Post::where('reg_date', $reg_date[$i])->count();

        $startDay = date('Y-m-d', strtotime($startDay.'+1days'));
        $startDay_m = date('m', strtotime($startDay));
        $startDay_d = date('d', strtotime($startDay));
      }
      $dayAreaChartMax = max($dayAreaChartData);
      return [$dayAreaChartLabel,$dayAreaChartData,$dayAreaChartMax];
    }

    public function monthBarChart(){
      $endFromDate = date('Y-m-d', time());
      $endToDate = date('Y-m-d',strtotime($endFromDate.'+1month'));

      $startFromDate = date('Y-m-d', strtotime($endFromDate.'-5month'));
      $startFromDate_y = date('y', strtotime($startFromDate));
      $startFromDate_m = date('m', strtotime($startFromDate));
      $startToDate = date('Y-m-d', strtotime($startFromDate.'+1month'));

      for($i = 0; $i < 6; $i ++) {
        $monthBarChartLabel[$i] = $startFromDate_y . "년" . " " . $startFromDate_m . "월";
        $monthBarChartData[$i] = Post::whereBetween('reg_date', [$startFromDate, $startToDate])->count();
        $startFromDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
        $startFromDate_y = date('y', strtotime($startFromDate));
        $startFromDate_m = date('m', strtotime($startFromDate));
        $startToDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
      }
      $monthBarChartMax = max($monthBarChartData);
      return [$monthBarChartLabel, $monthBarChartData, $monthBarChartMax];
    }

    public function cdayAreaChart(){
      $endDay = date('Y-m-d', time());
      $startDay = date('Y-m-d', strtotime($endDay.'-6days'));
      $startDay_m = date('m', strtotime($startDay));
      $startDay_d = date('d', strtotime($startDay));

      for($i = 0; $i < 7; $i ++) {
        $dayAreaChartLabel[$i] = $startDay_m . "월" . $startDay_d . "일";
        $reg_date[$i] = $startDay;
        $dayAreaChartData[$i] = Comment::where('reg_date', $reg_date[$i])->count();

        $startDay = date('Y-m-d', strtotime($startDay.'+1days'));
        $startDay_m = date('m', strtotime($startDay));
        $startDay_d = date('d', strtotime($startDay));
      }
      $dayAreaChartMax = max($dayAreaChartData);
      return [$dayAreaChartLabel,$dayAreaChartData,$dayAreaChartMax];
    }

    public function cmonthBarChart(){
      $endFromDate = date('Y-m-d', time());
      $endToDate = date('Y-m-d',strtotime($endFromDate.'+1month'));

      $startFromDate = date('Y-m-d', strtotime($endFromDate.'-5month'));
      $startFromDate_y = date('y', strtotime($startFromDate));
      $startFromDate_m = date('m', strtotime($startFromDate));
      $startToDate = date('Y-m-d', strtotime($startFromDate.'+1month'));

      for($i = 0; $i < 6; $i ++) {
        $monthBarChartLabel[$i] = $startFromDate_y . "년" . " " . $startFromDate_m . "월";
        $monthBarChartData[$i] = Comment::whereBetween('reg_date', [$startFromDate, $startToDate])->count();
        $startFromDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
        $startFromDate_y = date('y', strtotime($startFromDate));
        $startFromDate_m = date('m', strtotime($startFromDate));
        $startToDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
      }
      $monthBarChartMax = max($monthBarChartData);
      return [$monthBarChartLabel, $monthBarChartData, $monthBarChartMax];
    }

    public function galleryPieChart($gallery_id) {
      $galleryPieChartLabel = [];
      $galleryPieChartData = [];

      if($gallery_id == 0) { // 카테고리값이 없을 경우
        $galleryGroupCnt = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                                    ->groupBy('gallery_id')
                                    ->selectRaw('gallery.name as gallery_name, count(*) as total')
                                    ->orderby('total', 'desc')
                                    ->limit(10)
                                    ->get();
        $i = 0;
        foreach($galleryGroupCnt as $gGC) {
          $galleryPieChartLabel[$i] = $gGC->gallery_name;
          $galleryPieChartData[$i] = $gGC->total;
          $i ++;
        }
      } else {
        $galleryName = Gallery::where('id', $gallery_id)->first();
        $galleryGroupCnt = Post::where('gallery_id', $gallery_id)->count();

        $galleryPieChartLabel[0] = $galleryName->name;
        $galleryPieChartData[0] = $galleryGroupCnt;
      }
      return [$galleryPieChartLabel, $galleryPieChartData];
    }
}
