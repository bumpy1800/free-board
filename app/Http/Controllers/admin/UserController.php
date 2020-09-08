<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\User;                     //ORM


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = DB::table('User')->get();
        $Users = User::where('status','!=','-1')->get();
        return view('admin.user-list', ['Users' => $Users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user-add-form');
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
          return redirect('admin/user-add-form')
              ->withInput()
              ->withErrors($validator);
      }

      $uid = $request->input('uid');
      $nick = $request->input('nick');
      $pwd = bcrypt($request->input('pwd')); //로그인 테스트를 위한 해시
      $name = $request->input('name');
      $email = $request->input('email');
      $chk_email = 0;
      $reg_date = date("Y-m-d", time());
      $status = 0;
      $gallery_id = 0;

      User::create([
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

      return redirect(route('user.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.user-show', ['User' => User::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.user-edit-form', ['User' => User::findOrFail($id)]);
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
            return redirect(route('user.edit',$id))
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

        User::where('id', $id)->update([
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

        return redirect(route('user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect(route('user.index'));
    }
    public function stat_index(Request $request)
    {
        $today = date('Y-m-d', time());
        $totalUser = User::count();
        $todayUser = User::where('reg_date',$today)->count();

        $nowMonth = date('Y-m', time());
        $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수

        return view('admin.user-stat',[
            'totalUser' => $totalUser,
            'todayUser' => $todayUser,
            'nowMonth' => $nowMonth
        ]);
    }

    public function chart_index(Request $request)
    {
        $chartKind = $request->input('chartKind');

        if($chartKind == 1)
        {
            $nowMonth = $request->input('nowMonth');
            $nowMonthDayCount = date('t', strtotime($nowMonth)); //해당 달의 일 수

            $selectAreaChart = $this->selectAreaChart($nowMonth, $nowMonthDayCount, 0);
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
            if($i<10)
            {
                $day = '0'.$day.'일';
            }
            else
            {
                $day = $day.'일';
            }

            $selectAreaChartLabel[$i] = $day;
            $reg_date[$i] = date($nowMonth . '-' . $day);

            $selectAreaChartData[$i] = User::where('reg_date',$reg_date[$i])->count();

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
            $dayAreaChartData[$i] = User::where('reg_date',$startday)->count();

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
            $monthBarChartData[$i] = User::whereBetween('reg_date',[$startday, $endday])->count();

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
        $userGroupCnt = User::groupBy('status')
                                    ->selectRaw('status, count(status) as cnt')
                                    ->get();
          $i = 0;
        foreach($userGroupCnt as $sGC) {

            if($sGC->status == '0')
                $pieChartLabel[$i] = '가입자';
            elseif($sGC->status == '-1')
                $pieChartLabel[$i] = '미승인가입자';

            $pieChartData[$i] = $sGC->cnt;
            $i ++;
        }
        return [$pieChartLabel, $pieChartData];
    }
}
