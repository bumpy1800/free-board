<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Gallery;                     //ORM
use App\Category;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$gallerys = Gallery::all();
        $gallerys = Gallery::join('category', 'gallery.category_id', '=', 'category.id')
                            ->select('gallery.*', 'category.name as category_name')
                            ->get();
        return view('admin.gallery-list', ['gallerys' => $gallerys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorys = Category::all();
        return view('admin.gallery-add-form', ['categorys' => $categorys]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $messages = [
          's_name.required'    => '갤러리 약자를 입력해주세요.',
          'name.required'    => '갤러리 이름을 입력해주세요.',
          'category_id.required' => '카테고리를 선택해주세요.',
          'link.required'      => '주소를 입력해주세요.',
          'contents.required'      => '설명을 입력해주세요.',
          'reason.required'      => '사유를 입력해주세요.',
          'heads.required'      => '말머리를 입력해주세요.',
          'agree.required'      => '허가여부를 선택해주세요.',
          's_name.max'    => '갤러리 약자의 글자 수가 초과하였습니다.',
          'name.max'    => '갤러리 이름의 글자 수가 초과하였습니다.',
          'link.max'      => '주소의 글자 수가 초과하였습니다.',
          'contents.max'      => '설명의 글자 수가 초과하였습니다.',
          'reason.max'      => '사유의 글자 수가 초과하였습니다.',
          'heads.max'      => '말머리의 글자 수가 초과하였습니다.'
      ];
      $validator = Validator::make($request->all(), [
          's_name' => 'required|max:3',
          'name' => 'required|max:10',
          'category_id' => 'required',
          'link' => 'required|max:10',
          'contents' => 'required|max:10',
          'reason' => 'required|max:10',
          'heads' => 'required|max:20',
          'agree' => 'required|max:10'
      ], $messages);
      if ($validator->fails()) {
          return redirect('admin/gallery-add-form')
              ->withInput()
              ->withErrors($validator);
      }

      $s_name = $request->input('s_name');
      $name = $request->input('name');
      $category_id = $request->input('category_id');
      $link = $request->input('link');
      $contents = $request->input('contents');
      $reason = $request->input('reason');
      $heads = $request->input('heads');
      $agree = $request->input('agree');


      Gallery::create([
          's_name' => $s_name,
          'name' => $name,
          'category_id' => $category_id,
          'link' => $link,
          'contents' => $contents,
          'reason' => $reason,
          'heads' => $heads,
          'agree' => $agree,
      ]);

      return redirect('admin/gallery-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $gallery = Gallery::join('category', 'gallery.category_id', '=', 'category.id')
                            ->where('gallery.id', '=', $id)
                            ->select('gallery.*', 'category.name as category_name')
                            ->get();
        //exit($gallery);
        return view('admin.gallery-show', ['gallery' => $gallery]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.gallery-edit-form', ['gallery' => Gallery::findOrFail($id)], ['categorys' => Category::all()]);
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
          's_name.required'    => '갤러리 약자를 입력해주세요.',
          'name.required'    => '갤러리 이름을 입력해주세요.',
          'category_id.required' => '카테고리를 선택해주세요.',
          'link.required'      => '주소를 입력해주세요.',
          'contents.required'      => '설명을 입력해주세요.',
          'reason.required'      => '사유를 입력해주세요.',
          'agree.required'      => '허가여부를 선택해주세요.',
          's_name.max'    => '갤러리 약자의 글자 수가 초과하였습니다.',
          'name.max'    => '갤러리 이름의 글자 수가 초과하였습니다.',
          'link.max'      => '주소의 글자 수가 초과하였습니다.',
          'contents.max'      => '설명의 글자 수가 초과하였습니다.',
          'reason.max'      => '사유의 글자 수가 초과하였습니다.',
          'heads.max'      => '말머리의 글자 수가 초과하였습니다.'
        ];
        $validator = Validator::make($request->all(), [
            's_name' => 'required|max:3',
            'name' => 'required|max:10',
            'category_id' => 'required|max:10',
            'link' => 'required|max:10',
            'contents' => 'required|max:10',
            'reason' => 'required|max:10',
            'heads' => 'max:20',
            'agree' => 'required|max:10'
        ], $messages);
        if ($validator->fails()) {
            return redirect('admin/gallery-edit-form/' . $id)
                ->withInput()
                ->withErrors($validator);
        }

        $s_name = $request->input('s_name');
        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $link = $request->input('link');
        $contents = $request->input('contents');
        $reason = $request->input('reason');
        $heads = $request->input('heads');
        $agree = $request->input('agree');
        $agree_date = 0;
        if($agree == 1) {
          $agree_date = date('Y-m-d', time());
        }
        Gallery::where('id', $id)->update([
          's_name' => $s_name,
          'name' => $name,
          'category_id' => $category_id,
          'link' => $link,
          'contents' => $contents,
          'reason' => $reason,
          'heads' => $heads,
          'agree' => $agree,
          'agree_date' => $agree_date
      ]);
      return redirect('admin/gallery-show/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);
        return redirect('admin/gallery-list');
    }


    /* 갤러리 통계 */
    public function stat_index()
    {
        $nowMonth = date('Y-m', time());
        $nowMonthDayCount = date('t', strtotime($nowMonth));
        return view('admin.gallery-stat', ['nowMonth' => $nowMonth, 'nowMonthDayCount' => $nowMonthDayCount]);
    }

    public function stat_change(Request $request)
    {
        $statChangeBool = $request->input('statChangeBool');

        $nowMonth = $request->input('nowMonth');
        $nowMonthDayCount = date('t', strtotime($nowMonth));
        $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount);
        $selectAreaChartLabel = $selectAreaChart[0];
        $selectAreaChartData = $selectAreaChart[1];
        $selectAreaChartMax = $selectAreaChart[2];

        if($statChangeBool == 0) {
          $dayAreaChart = $this->dayAreaChart();
          $dayAreaChartLabel = $dayAreaChart[0];
          $dayAreaChartData = $dayAreaChart[1];
          $dayAreaChartMax = $dayAreaChart[2];

          $monthBarChart = $this->monthBarChart();
          $monthBarChartLabel = $monthBarChart[0];
          $monthBarChartData = $monthBarChart[1];
          $monthBarChartMax = $monthBarChart[2];

          return response()->json([
            'dayAreaChartLabel'=>$dayAreaChartLabel,
            'dayAreaChartData'=>$dayAreaChartData,
            'dayAreaChartMax'=>$dayAreaChartMax,
            'monthBarChartLabel'=>$monthBarChartLabel,
            'monthBarChartData'=>$monthBarChartData,
            'monthBarChartMax'=>$monthBarChartMax,
            'selectAreaChartLabel'=>$selectAreaChartLabel,
            'selectAreaChartData'=>$selectAreaChartData,
            'selectAreaChartMax'=>$selectAreaChartMax
          ]);
        }
        else {
          return response()->json([
            'selectAreaChartLabel'=>$selectAreaChartLabel,
            'selectAreaChartData'=>$selectAreaChartData,
            'selectAreaChartMax'=>$selectAreaChartMax
          ]);
      }
    }
    public function selectAreaChart($nowMonth, $nowMonthDayCount) {
      for($i = 0; $i < $nowMonthDayCount; $i ++) {
        $selectAreaChartLabel[$i] = $i+1 . "일";
        $day = $i+1;
        if($day < 10) {
          $day = '0' . $day;
        }
        $agree_date[$i] = date($nowMonth . '-' . $day);
        $selectAreaChartData[$i] = Gallery::where('agree_date', $agree_date[$i])->count();
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
        $agree_date[$i] = $startDay;
        $dayAreaChartData[$i] = Gallery::where('agree_date', $agree_date[$i])->count();

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
        $monthBarChartData[$i] = Gallery::whereBetween('agree_date', [$startFromDate, $startToDate])->count();
        $startFromDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
        $startFromDate_y = date('y', strtotime($startFromDate));
        $startFromDate_m = date('m', strtotime($startFromDate));
        $startToDate = date('Y-m-1', strtotime($startFromDate.'+1month'));
      }
      $monthBarChartMax = max($monthBarChartData);
      return [$monthBarChartLabel, $monthBarChartData, $monthBarChartMax];
    }
}
