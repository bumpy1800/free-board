<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Singo;                     //ORM
use App\Singo_Category;


class SingoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = DB::table('User')->get();
        $Singos = Singo::join('singo_category', 'singo.category_id', '=', 'singo_category.id')
                            ->join('post', 'singo.post_id', '=', 'post.id')
                            ->join('user as user1', 'singo.reporter', '=', 'user1.id')
                            ->join('user as user2', 'singo.post_writer', '=', 'user2.id')
                            ->select('singo.*', 'singo_category.name as singo_category_name', 'post.title as post_title', 'user1.name as user_reporter', 'user2.name as writer')
                            ->where('singo.status', '!=', '-1')
                            ->get();

        return view('admin.singo-list', ['Singos' => $Singos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.singo-add-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    /*
      $messages = [
          'uid.required'    => '아이디를 입력해주세요.',
          'uid.max'    => '아이디는 최대15자입니다.',
          'nick.required' => '닉네임을 입력해주세요.',
          'nick.max' => '닉네임은 최대8자입니다.',
          'pwd.required'      => '패스워드를 입력해주세요.',
          'pwd.max'      => '패스워드는 최대20자입니다.',
          'name.required'      => '이름을 입력해주세요.',
          'name.max'      => '이름은 최대5자입니다.',
          'email.email'      => '이메일 형식을 맞춰주세요.',
          'email.required'      => '이메일을 입력해주세요.'
      ];
      $validator = Validator::make($request->all(), [
          'uid' => 'required|max:15',
          'nick' => 'required|max:8',
          'pwd' => 'required|max:20',
          'name' => 'required|max:5',
          'email' => 'required|email'
      ], $messages);
      if ($validator->fails()) {
          return redirect('admin/singo-add-form')
              ->withInput()
              ->withErrors($validator);
      }

      $uid = $request->input('uid');
      $nick = $request->input('nick');
      $pwd = $request->input('pwd');
      $name = $request->input('name');
      $email = $request->input('email');
      $chk_email = 0;
      $reg_date = date("Y-m-d", time());
      $status = 0;
      $gallery_id = 0;

      Singo::create([
          'uid' => $uid,
          'nick' => $nick,
          'pwd' => $pwd,
          'name' => $name,
          'email' => $email,
          'chk_email' => $chk_email,
          'reg_date' => $reg_date,
          'status' => $status,
          'gallery_id' => $gallery_id
      ]);

      return redirect('admin/singo-list');
      */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return view('admin.singo-show', ['Singo' => Singo::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $Singos = Singo::join('singo_category', 'singo.category_id', '=', 'singo_category.id')
                            ->join('post', 'singo.post_id', '=', 'post.id')
                            ->join('user as user1', 'singo.reporter', '=', 'user1.id')
                            ->join('user as user2', 'singo.post_writer', '=', 'user2.id')
                            ->select('singo.*', 'singo_category.name as singo_category_name', 'post.title as post_title', 'user1.name as user_reporter', 'user2.name as writer')
                            ->where('singo.id', $id)
                            ->first();
        return view('admin.singo-edit-form', ['Singo' => $Singos]);
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
        /*
        $messages = [
            'uid.required'    => '아이디를 입력해주세요.',
            'uid.max'    => '아이디는 최대15자입니다.',
            'nick.required' => '닉네임을 입력해주세요.',
            'nick.max' => '닉네임은 최대8자입니다.',
            'pwd.required'      => '패스워드를 입력해주세요.',
            'pwd.max'      => '패스워드는 최대20자입니다.',
            'name.required'      => '이름을 입력해주세요.',
            'name.max'      => '이름은 최대5자입니다.',
            'email.email'      => '이메일 형식을 맞춰주세요.',
            'email.required'      => '이메일을 입력해주세요.'
        ];
        $validator = Validator::make($request->all(), [
            'uid' => 'required|max:15',
            'nick' => 'required|max:8',
            'pwd' => 'required|max:20',
            'name' => 'required|max:5',
            'email' => 'required|email'
        ], $messages);
        if ($validator->fails()) {
            return redirect('admin/singo-add-form')
                ->withInput()
                ->withErrors($validator);
        }
        */
        $solution = $request->input('solution');
        $status = 2;

        Singo::where('id', $id)->update([
            'solution' => $solution,
            'status' => $status
        ]);

        return redirect(route('admin_singo.index'));
    }

    public function wait(Request $request, $id)
    {

        Singo::where('id', $id)->update([
            'status' => -1
        ]);

        return redirect(route('admin_singo.index'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Singo::destroy($id);
        return redirect(route('admin_singo.index'));
    }

    public function stat_index(Request $request)
    {
        $today = date('Y-m-d', time());
        $totalSingo = Singo::count();
        $todaySingo = Singo::where('reg_date',$today)->count();

        $nowMonth = date('Y-m', time());
        $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수

        $singo_categorys = Singo_Category::all();

        return view('admin.singo-stat',[
            'totalSingo' => $totalSingo,
            'todaySingo' => $todaySingo,
            'singo_categorys' => $singo_categorys,
            'nowMonth' => $nowMonth
        ]);
    }

    public function chart_index(Request $request)
    {


        $chartKind = $request->input('chartKind');

        if($chartKind == 1)
        {
            $singo_category = $request->input('singo_category');
            $nowMonth = $request->input('nowMonth');
            $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수

            $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount, $singo_category);
            $selectAreaChartLabel = $selectAreaChart[0];
            $selectAreaChartData = $selectAreaChart[1];
            $selectAreaChartMax = $selectAreaChart[2];

            return response()->json([
                'selectAreaChartLabel'=>$selectAreaChartLabel,
                'selectAreaChartData'=>$selectAreaChartData,
                'selectAreaChartMax'=>$selectAreaChartMax
            ]);
        }
        else
        {
            $nowMonth = date('Y-m', time());
            $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수

            $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount, 0);
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

            $pieChart = $this->pieChart();
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

    public function selectAreaChart($nowMonth, $nowMonthDayCount, $singo_category){

        for($i = 0; $i < $nowMonthDayCount; $i++)
        {
            $day = $i+1;
            if($i<9)
            {
                $day = '0'.$day.'일';
            }
            else
            {
                $day = $day.'일';
            }

            $selectAreaChartLabel[$i] = $day;
            $reg_date[$i] = date($nowMonth . '-' . $day);

            if($singo_category=='0')
            {
                $selectAreaChartData[$i] = Singo::where('reg_date',$reg_date[$i])->count();
            }
            else
            {
                $selectAreaChartData[$i] = Singo::where('category_id',$singo_category)->where('reg_date',$reg_date[$i])->count();
            }
        }
        $selectAreaChartMax = max($selectAreaChartData);
        return [$selectAreaChartLabel, $selectAreaChartData, $selectAreaChartMax];
    }

    public function dayAreaChart()
    {
        $endday = date('Y-m-d', time());
        $startday = date('Y-m-d', strtotime($endday.'-1 week'));
        $startday_m = date('m', strtotime($startday));
        $startday_d = date('d', strtotime($startday));

        for($i=0; $i<7; $i++)
        {
            $dayAreaChartLabel[$i] = $startday_m.'월'.$startday_d.'일';
            $dayAreaChartData[$i] = Singo::where('reg_date',$startday)->count();

            $startday = date('Y-m-d', strtotime($startday.'+1 days'));
            $startday_m = date('m', strtotime($startday));
            $startday_d = date('d', strtotime($startday));
        }
        $dayAreaChartMax = max($dayAreaChartData);
        return [$dayAreaChartLabel, $dayAreaChartData, $dayAreaChartMax];
    }

    public function monthBarChart()
    {
        $nowday = date('Y-m-d', time());
        $startday = date('Y-m-1', strtotime($nowday.'-5 month'));
        $startday_y = date('y', strtotime($startday));
        $startday_m = date('m', strtotime($startday));
        $endday = date('Y-m-1', strtotime($startday.'+1 month'));

        for($i=0; $i<6; $i++)
        {
            $monthBarChartLabel[$i] = $startday_y.'년 '.$startday_m.'월';
            $monthBarChartData[$i] = Singo::whereBetween('reg_date',[$startday, $endday])->count();

            $startday = date('Y-m-d', strtotime($startday.'+1 month'));
            $startday_m = date('m', strtotime($startday));
            $startday_d = date('d', strtotime($startday));
            $endday = date('Y-m-d', strtotime($startday.'+1 month'));
        }
        $monthBarChartMax = max($monthBarChartData);
        return [$monthBarChartLabel, $monthBarChartData, $monthBarChartMax];
    }

    public function pieChart()
    {
        $singoGroupCnt = Singo::join('singo_category', 'singo.category_id', '=', 'singo_category.id')
                                    ->groupBy('singo_category_name')
                                    ->selectRaw('singo_category.name as singo_category_name, count(*) as total')
                                    ->orderby('total', 'desc')
                                    ->limit(10)
                                    ->get();
          $i = 0;
        foreach($singoGroupCnt as $sGC) {
            $pieChartLabel[$i] = $sGC->singo_category_name;
            $pieChartData[$i] = $sGC->total;
            $i ++;
        }

        return [$pieChartLabel, $pieChartData];
    }
}
