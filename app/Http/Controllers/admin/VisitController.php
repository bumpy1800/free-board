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
      $visitorTodayFrom = date($date.' '.'00-00-00', time());
      $visitorTodayTo = date($date.' '.'23-59-59', time());

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

      $visitorTodayFrom = date('Y-m-d'.' '.'00-00-00', time()); //오늘날짜 범위
      $visitorTodayTo = date('Y-m-d'.' '.'23-59-59', time()); //오늘날짜 범위
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

  public function refer_stat_index(Request $request)
  {
      $nowMonth = null;
      if($request->input('nowMonth')) {
        $nowMonth = date($request->input('nowMonth'), time());
      }
      else {
        $nowMonth = date('Y-m', time());
      }
      $nowMonthDayCount = date('t', strtotime($nowMonth));

      if($request->isMethod('get')) {
        return view('admin.visitor-refer-stat', [
          'nowMonth' => $nowMonth,
          'nowMonthDayCount' => $nowMonthDayCount
        ]);
      } else {
        $selectPieChart = $this->selectReferPieChart($nowMonth, $nowMonthDayCount);
        $chartLabel = $selectPieChart[0];
        $chartData = $selectPieChart[1];

        return response()->json([
          'chartLabel'=>$chartLabel,
          'chartData'=>$chartData
        ]);
      }
  }

  public function selectReferPieChart($nowMonth, $nowMonthDayCount)
  {
    $referData = array(
      'Naver' => 0,
      'Daum' => 0,
      'Google' => 0,
      'Yahoo' => 0,
      'Zum' => 0,
      'MSbing' => 0,
      'Etc' => 0,
      'Kakao' => 0,
      'N/A' => 0
    );

    $visitorTodayFrom = date($nowMonth.'-1'.' '.'00-00-00', time());
    $visitorTodayTo = date($nowMonth.'-'.$nowMonthDayCount.' '.'23-59-59', time());
    $visitors = Visitor::select('refer')->whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])->get();

    foreach($visitors as $visitor) {
        if(strpos($visitor->refer, 'naver')) {
            $referData['Naver'] ++;
        } else if(strpos($visitor->refer, 'daum')) {
            $referData['Daum'] ++;
        } else if(strpos($visitor->refer, 'google')) {
            $referData['Google'] ++;
        } else if(strpos($visitor->refer, 'yahoo')) {
            $referData['Yahoo'] ++;
        } else if(strpos($visitor->refer, 'zum')) {
            $referData['Zum'] ++;
        } else if(strpos($visitor->refer, 'bing')) {
            $referData['MSbing'] ++;
        } else if(strpos($visitor->refer, 'kakao')) {
            $referData['Kakao'] ++;
        } else if($visitor->refer) {
            $referData['Etc'] ++;
        } else {
            $referData['N/A'] ++;
        }
    }
    arsort($referData);

    $i = 0;
    foreach ($referData as $key=>$value) {
        $chartLabel[$i] = $key;
        $chartData[$i] = $value;
        $i ++;
    }
    return [$chartLabel, $chartData];
  }

  public function browser_stat_index(Request $request)
  {
      $nowMonth = null;
      if($request->input('nowMonth')) {
        $nowMonth = date($request->input('nowMonth'), time());
      }
      else {
        $nowMonth = date('Y-m', time());
      }
      $nowMonthDayCount = date('t', strtotime($nowMonth));

      if($request->isMethod('get')) {
        return view('admin.visitor-browser-stat', [
          'nowMonth' => $nowMonth,
          'nowMonthDayCount' => $nowMonthDayCount
        ]);
      } else {
        $selectPieChart = $this->selectBrowserPieChart($nowMonth, $nowMonthDayCount);
        $chartLabel = $selectPieChart[0];
        $chartData = $selectPieChart[1];

        return response()->json([
          'chartLabel'=>$chartLabel,
          'chartData'=>$chartData
        ]);
      }
  }

  public function selectBrowserPieChart($nowMonth, $nowMonthDayCount)
  {
      $data = array(
        'Chrome' => 0,
        'IEedge' => 0,
        'IE' => 0,
        'Whale' => 0,
        'Firefox' => 0,
        'Safari' => 0
      );

      $visitorTodayFrom = date($nowMonth.'-1'.' '.'00-00-00', time());
      $visitorTodayTo = date($nowMonth.'-'.$nowMonthDayCount.' '.'23-59-59', time());
      $visitors = Visitor::select('agent')->whereBetween('time', [$visitorTodayFrom, $visitorTodayTo])->get();

      foreach($visitors as $visitor) {
          if($visitor->agent == 'Chrome') {
              $data['Chrome'] ++;
          } else if($visitor->agent == 'IEedge') {
              $data['IEedge'] ++;
          } else if($visitor->agent == 'IE') {
              $data['IE'] ++;
          } else if($visitor->agent == 'Whale') {
              $data['Whale'] ++;
          } else if($visitor->agent == 'Firefox') {
              $data['Firefox'] ++;
          } else {
              $data['Safari'] ++;
          }
      }
      arsort($data);

      $i = 0;
      foreach ($data as $key=>$value) {
          $chartLabel[$i] = $key;
          $chartData[$i] = $value;
          $i ++;
      }
      return [$chartLabel, $chartData];
  }
}
