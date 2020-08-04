<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Visitor;
use App\Post;
use App\Qna;
use App\Gallery;
use App\Singo;

class MainController extends Controller
{
    public function __construct()
    {
        //한국시간으로 설정
        date_default_timezone_set('Asia/Seoul');
    }

    public function index(Request $request)
    {
        //차트 그리는 것을 ajax로 요청한다
        //ajax 요청일 때
        if($request->ajax()) {
            return $this->drawVisitorChart();
        }
        $postCnt = 0;
        $visitorCnt = 0;
        $qnaCnt = 0;
        $singoCnt = 0;

        $today = date('Y-m-d');
        $fromDate = date($today.' '.'00-00-00', time());
        $toDate = date($today.' '.'23-59-59', time());

        $postCnt = Post::where('reg_date', $today)->count();
        $visitorCnt = Visitor::whereBetween('time', [$fromDate, $toDate])->count();
        $qnaCnt = Qna::where('reg_date', $today)->count();
        $singoCnt = Qna::where('reg_date', $today)->count();

        $singos = Qna::where('reg_date', $today)->get();
        $qnas = Qna::where('reg_date', $today)->get();

        return view('admin.index', [
            'postCnt' => $postCnt,
            'visitorCnt' => $visitorCnt,
            'qnaCnt' => $qnaCnt,
            'singoCnt' => $singoCnt,
            'singos' => $singos,
            'qnas' => $qnas,
        ]);
    }

    //방문자 차트 그리는 함수
    public function drawVisitorChart() {
        $today = date('Y-m-d');
        //일별 조회
        $data = $this->getVisitorCnt($today, 'd');
        $dLabel = $data[0];
        $dData = $data[1];
        $dMax = $data[2];
        //달별 조회
        $data = $this->getVisitorCnt($today, 'm');
        $mLabel = $data[0];
        $mData = $data[1];
        $mMax = $data[2];
        return response()->json([
          'dLabel'=>$dLabel,
          'dData'=>$dData,
          'dMax'=>$dMax,
          'mLabel'=>$mLabel,
          'mData'=>$mData,
          'mMax'=>$mMax,
        ]);
    }
    //방문자 카운트하는 함수
    public function getVisitorCnt($today, $date) {
        $label = [];
        $data = [];
        $max = 0;

        if($date == 'd') {
            $today = date('Y-m-d', strtotime($today.'-6Days'));
            //각 일에 대한 라벨과 개수 구하기
            for($i = 0; $i < 7; $i ++) {
                $label[$i] = date('d', strtotime($today)) . "일";
                $fromDate = date($today . ' '  .'00-00-00', time());
                $toDate = date($today . ' ' . '23-59-59', time());
                $data[$i] = Visitor::whereBetween('time', [$fromDate, $toDate])->count();
                $today = date('Y-m-d', strtotime($today.'+1Days'));
            }
        } elseif($date == 'm') {
            $today = date('Y-m-1', strtotime($today.'-5Month'));
            //각 달에 대한 라벨과 개수 구하기
            for($i = 0; $i < 6; $i ++) {
                $label[$i] = date('y', strtotime($today)) . "년" . " " . date('m', strtotime($today)) . "월";
                $fromDate = date($today . ' '  .'00-00-00', time());
                $today = date('Y-m-1', strtotime($today.'+1month'));
                $toDate = date($today . ' ' . '00-00-00', time());
                $data[$i] = Visitor::whereBetween('time', [$fromDate, $toDate])->count();
            }
        }
        $max = max($data);
        return [$label, $data, $max];
    }
}
