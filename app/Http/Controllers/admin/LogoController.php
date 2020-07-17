<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use File;
use App\Logo;                     //ORM


class LogoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = DB::table('User')->get();
        $Logo = Logo::all();
        return view('admin.logo-list', ['Logo' => $Logo]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.logo-add-form');
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
          'name.required'    => '로고명을 입력해주세요.',
          'name.max'    => '로고명은 20자를 넘을 수 없습니다.',
          'pic.required'      => '로고를 업로드해주세요.'
      ];
      $validator = Validator::make($request->all(), [
          'name' => 'required|max:20',
          'pic' => 'required'
      ], $messages);
      if ($validator->fails()) {
          return redirect('admin/logo-add-form')
              ->withInput()
              ->withErrors($validator);
      }

      $name = $request->input('name');
      $pic = $request->file('pic')->store('public/images');

      Logo::create([
          'name' => $name,
          'pic' => $pic
      ]);

      return redirect(route('admin_logo.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $logo = Logo::findOrFail($id);
        $pic = Storage::get($logo->pic); //이미지 가져와서 text 변환
        $pic = base64_encode($pic); //base64로 인코딩

        return view('admin.logo-show', ['Logo' => $logo], ['pic' => $pic]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.logo-edit-form', ['Logo' => Logo::findOrFail($id)]);
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
            'name.required'    => '로고명을 입력해주세요.',
            'name.max'    => '로고명은 20자를 넘을 수 없습니다.'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_logo.edit',$id))
                ->withInput()
                ->withErrors($validator);
        }

        $name = $request->input('name');
        $pic = $request->file('pic');

        $logo = Logo::findOrFail($id);
        if($pic != null) {
          Storage::delete($logo->pic);
          $pic = $request->file('pic')->store('public/images');
        } else {
          $pic = $logo->pic;
        }

        Logo::where('id', $id)->update([
            'name' => $name,
            'pic' => $pic
        ]);

        return redirect(route('admin_logo.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $logo = Logo::findOrFail($id);
        Storage::delete($logo->pic);

        Logo::destroy($id);
        return redirect(route('admin_logo.index'));
    }
}
