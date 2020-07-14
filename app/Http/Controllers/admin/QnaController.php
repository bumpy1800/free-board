<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Qna;
use App\Qna_category;

class QnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$qnas = qna::all();
      $qnas = Qna::select('*')->orderby('category')->get();
      return view('admin.qna-list', ['qnas' => $qnas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         return view('/');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
       return redirect('/');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $qna = Qna::findOrFail($id);
      return view('admin.qna-show', ['qna' => $qna]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qna = Qna::findOrFail($id);
        $qna_categorys = Qna_category::orderby('id')->get();
        return view('admin.qna-edit-form', ['qna' => $qna], ['qna_categorys' => $qna_categorys]);
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
            'title.required'    => '값을 입력해주세요.',
            'contents.required'    => '값을 입력해주세요.',
            'category.required'    => '값을 입력해주세요.'
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'contents' => 'required',
            'category' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_qna.edit',$id))
                ->withInput()
                ->withErrors($validator);
        }

        $title = $request->input('title');
        $contents = $request->input('contents');
        $category = $request->input('category');
        $reg_date = date("Y-m-d");

        Qna::where('id', $id)->update([
          'title' => $title,
          'contents' => $contents,
          'category' => $category,
          'reg_date' => $reg_date
      ]);

      return redirect(route('admin_qna.index'));
        //return redirect(route('admin_qna.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      qna::destroy($id);
      return redirect(route('admin_qna.index'));
    }

    public function stat_index(Request $request)
    {
        $nowMonth = date('Y-m', time());
        $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수

        $today = date('Y-m-d', time());
        $totalCnt = Qna::count();
        $todayCnt = Qna::where('reg_date', $today)->count();

        $qna_categorys = Qna_category::all();

        if($request->isMethod('get')) {
            return view('admin.qna-stat', [
              'nowMonth' => $nowMonth,
              'nowMonthDayCount' => $nowMonthDayCount,
              'totalCnt' => $totalCnt,
              'todayCnt' => $todayCnt,
              'qna_categorys' => $qna_categorys
            ]);
        } else {
            $chartKind = $request->input('chartKind');

            if($chartKind == 1){
                $nowMonth = $request->input('nowMonth');
                $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수
                $qna_category = $request->input('qna_category');

                $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount, $qna_category);
                $selectAreaChartLabel = $selectAreaChart[0];
                $selectAreaChartData = $selectAreaChart[1];
                $selectAreaChartMax = $selectAreaChart[2];

                return response()->json([
                  'selectAreaChartLabel'=>$selectAreaChartLabel,
                  'selectAreaChartData'=>$selectAreaChartData,
                  'selectAreaChartMax'=>$selectAreaChartMax,
                ]);
            }
            else if($chartKind == 2) {
                $category_id = $request->input('category_id');
                $pieChart = $this->pieChart($category_id);
                $pieChartLabel = $pieChart[0];
                $pieChartData = $pieChart[1];
                return response()->json([
                    'pieChartLabel'=>$pieChartLabel,
                    'pieChartData'=>$pieChartData
                ]);
            }
            else {
                $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount, '0');
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

                $pieChart = $this->pieChart(0);
                $pieChartLabel = $pieChart[0];
                $pieChartData = $pieChart[1];

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
                  'pieChartLabel'=>$pieChartLabel,
                  'pieChartData'=>$pieChartData
                ]);
            }
        }
    }

    public function selectAreaChart($nowMonth, $nowMonthDayCount, $qna_category) {
      for($i = 0; $i < $nowMonthDayCount; $i ++) {
        $selectAreaChartLabel[$i] = $i+1 . "일";
        $day = $i+1;
        if($day < 10) {
          $day = '0' . $day;
        }
        $reg_date[$i] = date($nowMonth . '-' . $day);
        if($qna_category == '0') {
            $selectAreaChartData[$i] = Qna::where('reg_date', $reg_date[$i])->count();
        } else {
            $selectAreaChartData[$i] = Qna::where('category', $qna_category)->where('reg_date', $reg_date[$i])->count();
        }
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
        $dayAreaChartData[$i] = Qna::where('reg_date', $reg_date[$i])->count();

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
        $monthBarChartData[$i] = Qna::whereBetween('reg_date', [$startFromDate, $startToDate])->count();
        $startFromDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
        $startFromDate_y = date('y', strtotime($startFromDate));
        $startFromDate_m = date('m', strtotime($startFromDate));
        $startToDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
      }
      $monthBarChartMax = max($monthBarChartData);
      return [$monthBarChartLabel, $monthBarChartData, $monthBarChartMax];
    }

    public function pieChart($category_id) {
      $pieChartLabel = [];
      $pieChartData = [];

      if($category_id == '0') { // 카테고리값이 없을 경우
          $categoryGroupCnt = Qna::join('qna_category', 'qna.category', '=', 'qna_category.id')
                                      ->groupBy('category')
                                      ->selectRaw('qna_category.id as qna_category_id, count(*) as total')
                                      ->orderby('total', 'desc')
                                      ->limit(10)
                                      ->get();
          $i = 0;
          foreach($categoryGroupCnt as $cGC) {
              $pieChartLabel[$i] = $cGC->qna_category_id;
              $pieChartData[$i] = $cGC->total;
              $i ++;
          }
      } else {
          $categoryName = Qna_category::where('id', $category_id)->first();
          $categoryGroupCnt = Qna::where('category', $category_id)->count();

          $pieChartLabel[0] = $categoryName->id;
          $pieChartData[0] = $categoryGroupCnt;
      }
      return [$pieChartLabel, $pieChartData];
    }
}
