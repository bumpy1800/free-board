<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Singo;                     //ORM


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
        $Singos = Singo::where('status','!=','-1')->get();
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
        return view('admin.singo-edit-form', ['Singo' => Singo::findOrFail($id)]);
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
        $status = 1;

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
}
