<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use File;
use App\Popup2;
use App\Popup2_category;

class Popup2Controller extends Controller
{
    public function index()
    {
      $popups = Popup2::select('*')->orderby('id')->get();
      return view('admin.popup2-list', ['popups' => $popups]);
    }

     public function create()
     {
        return view('admin.popup2-add-form');
     }

     public function store(Request $request)
     {
       $messages = [
           'image.required'    => '파일을 선택해주세요.',
           'name.required'    => '팝업명을 입력해주세요.',
           'agree.required'      => '상태여부를 선택해주세요.',
       ];
       $validator = Validator::make($request->all(), [
           'name' => 'required',
           'image' => 'required',
           'agree' => 'required'
       ], $messages);
       if ($validator->fails()) {
           return redirect('admin/popup2-add-form')
               ->withInput()
               ->withErrors($validator);
       }

       $name = $request->input('name');
       $image = $request->file('image')->store('public/images');
       $reg_date = date("Y-m-d");
       $status = $request->input('agree');

       Popup2::create([
           'name' => $name,
           'image' => $image,
           'reg_date' => $reg_date,
           'status' => $status
       ]);
       return redirect(route('admin_popup2.index'));
     }

    public function show($id)
    {
      $popup = Popup2::findOrFail($id);
      $image = Storage::get($popup->image); //이미지 가져와서 text 변환
      $image = base64_encode($image); //base64로 인코딩

      return view('admin.popup2-show', ['popup' => $popup], ['image' => $image]);
    }

    public function edit($id)
    {
        $popup = Popup2::findOrFail($id);
        return view('admin.popup2-edit-form', ['popup' => $popup]);
    }

    public function update(Request $request, $id)
    {
        $messages = [
            'name.required'    => '팝업명을 입력해주세요.',
            'agree.required'      => '상태여부를 선택해주세요.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'agree' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_popup2.edit', $id))
                ->withInput()
                ->withErrors($validator);
        }

        $name = $request->input('name');
        $image = $request->file('image');

        $popup = Popup2::findOrFail($id);
        if($image != null) {
          Storage::delete($popup->image);
          $image = $request->file('image')->store('public/images');
        } else {
          $image = $popup->image;
        }
        $status = $request->input('agree');


        Popup2::where('id', $id)->update([
          'name' => $name,
          'image' => $image,
          'status' => $status
        ]);
        return redirect(route('admin_popup2.show', $id));
    }

    public function destroy($id)
    {
      $popup = Popup2::findOrFail($id);
      Storage::delete($popup->image);

      Popup2::destroy($id);
      return redirect(route('admin_popup2.index'));
    }
}
