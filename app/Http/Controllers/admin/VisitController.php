<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use App\Visitor;

class VisitController extends Controller
{
  public function visitor_stat_index(Request $request)
  {
      $nowMonth = date('Y-m', time());
      $nowMonthDayCount = date('t', strtotime($nowMonth));
      $keyword = $request->input('keyword');
      $date = $request->input('date');
      $logCnt = 0;

      $visitorTodayFrom = date($date.' '.'00-00-00', time()); //오늘날짜 범위
      $visitorTodayTo = date($date.' '.'23-59-59', time()); //오늘날짜 범위


      if($keyword && $date) {
          $visitors = Visitor::select('*')
                              ->whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])
                              ->where('ip', 'like', '%'.$keyword.'%')
                              ->orderby('time', 'desc')
                              ->paginate(15);
          $logCnt = Visitor::select('*')
                              ->whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])
                              ->where('ip', 'like', '%'.$keyword.'%')
                              ->count();
      } else if($keyword) {
          $visitors = Visitor::where('ip', 'like', '%'.$keyword.'%')->orderby('time', 'desc')->paginate(15);
          $logCnt = Visitor::where('ip', 'like', '%'.$keyword.'%')->count();
      } else if($date) {
          $visitors = Visitor::whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])->orderby('time', 'desc')->paginate(15);
          $logCnt = Visitor::whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])->count();
      } else {
          $visitors = Visitor::select('*')->orderby('time', 'desc')->paginate(15);
          $logCnt = Visitor::count();
      }
      $visitors->withPath('admin_visitor_stat?keyword='.$keyword.'&date='.$date); //페이지네이션 url 설정

      $visitorTotalCnt = Visitor::select('*')->count();
      $visitorTodayCnt = Visitor::whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])->count();

      $visitorLiveData = $request->session()->get('visitor'); //현재 방문자 수
      if($visitorLiveData == null) {
        $visitorLiveData = [];
      }
      $visitorLiveCnt = count($visitorLiveData);

      return view('admin.visitor-stat', [
        'nowMonth' => $nowMonth,
        'keyword' => $keyword,
        'logCnt' => $logCnt,
        'date' => $date,
        'visitors' => $visitors,
        'nowMonthDayCount' => $nowMonthDayCount,
        'visitorTotalCnt' => $visitorTotalCnt,
        'visitorTodayCnt' => $visitorTodayCnt,
        'visitorLiveCnt' => $visitorLiveCnt
      ]);
  }

  public function visitor_stat_change(Request $request)
  {
      $nowMonth = $request->input('nowMonth');
      $nowMonthDayCount = date('t', strtotime($nowMonth));

      $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount);
      $selectAreaChartLabel = $selectAreaChart[0];
      $selectAreaChartData = $selectAreaChart[1];
      $selectAreaChartMax = $selectAreaChart[2];

      return response()->json([
        'selectAreaChartLabel'=>$selectAreaChartLabel,
        'selectAreaChartData'=>$selectAreaChartData,
        'selectAreaChartMax'=>$selectAreaChartMax
      ]);
  }

  public function selectAreaChart($nowMonth, $nowMonthDayCount) {
    for($i = 0; $i < $nowMonthDayCount; $i ++) {
      $selectAreaChartLabel[$i] = $i+1 . "일";
      $day = $i+1;
      if($day < 10) {
        $day = '0' . $day;
      }
      $visitorTodayFrom = date($nowMonth.'-'.$day.' '.'00-00-00', time());
      $visitorTodayTo = date($nowMonth.'-'.$day.' '.'23-59-59', time());
      $selectAreaChartData[$i] = Visitor::whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])->count();
    }
    $selectAreaChartMax = max($selectAreaChartData);
    return [$selectAreaChartLabel, $selectAreaChartData, $selectAreaChartMax];
  }

  public function visitor_stat_search(Request $request)
  {
      $keyword = $request->input('keyword');
      /*$nowMonth = date('2020-05', time());
      $nowMonthDayCount = date('t', strtotime($nowMonth));

      $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount);
      $selectAreaChartLabel = $selectAreaChart[0];
      $selectAreaChartData = $selectAreaChart[1];
      $selectAreaChartMax = $selectAreaChart[2];*/
      $visitors = Visitor::select('*')->where('ip', 'like', '%'.$keyword.'%')->paginate(15);
      return view('admin.visitor-stat', [
        //'nowMonth' => $nowMonth,
        'visitors' => $visitors,
        /*'nowMonthDayCount' => $nowMonthDayCount,
        'visitorTotalCnt' => $visitorTotalCnt,
        'visitorTodayCnt' => $visitorTodayCnt,
        'visitorLiveCnt' => $visitorLiveCnt*/
      ]);
  }
}
