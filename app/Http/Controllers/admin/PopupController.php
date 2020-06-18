<?php

namespace App\Http\Controllers\admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use File;
use App\Popup;
use App\Popup_category;

class PopupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$popups = popup::all();
      $popups = Popup::select('*')->orderby('category')->get();
      return view('admin.popup-list', ['popups' => $popups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
        $popup_categorys = Popup_category::orderby('id')->get();
        return view('admin.popup-add-form',  ['popup_categorys' => $popup_categorys]);
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
           'image.required'    => '파일을 선택해주세요.',
           'name.required'    => '팝업명을 입력해주세요.',
           'category.required' => '종류를 선택해주세요.',
           'agree.required'      => '상태여부를 선택해주세요.',
       ];
       $validator = Validator::make($request->all(), [
           'name' => 'required',
           'category' => 'required',
           'image' => 'required',
           'agree' => 'required'
       ], $messages);
       if ($validator->fails()) {
           return redirect('admin/popup-add-form')
               ->withInput()
               ->withErrors($validator);
       }

       $name = $request->input('name');
       $category = $request->input('category');
       $image = $request->file('image')->store('public/images');
       $reg_date = date("Y-m-d");
       $status = $request->input('agree');

       Popup::create([
           'name' => $name,
           'category' => $category,
           'image' => $image,
           'reg_date' => $reg_date,
           'status' => $status
       ]);
       return redirect(route('admin_popup.index'));
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $popup = popup::findOrFail($id);
      $image = Storage::get($popup->image); //이미지 가져와서 text 변환
      $image = base64_encode($image); //base64로 인코딩

      return view('admin.popup-show', ['popup' => $popup], ['image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$popup = popup::findOrFail($id);
        $popup = Popup::findOrFail($id);
        $popup_categorys = Popup_category::orderby('id')->get();
        //exit($popup);
        return view('admin.popup-edit-form', ['popup' => $popup], ['popup_categorys' => $popup_categorys]);
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
            'name.required'    => '팝업명을 입력해주세요.',
            'category.required' => '종류를 선택해주세요.',
            'agree.required'      => '상태여부를 선택해주세요.',
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category' => 'required',
            'agree' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_popup.edit', $id))
                ->withInput()
                ->withErrors($validator);
        }


        $name = $request->input('name');
        $category = $request->input('category');
        $image = $request->file('image');

        $popup = Popup::findOrFail($id);
        if($image != null) {
          Storage::delete($popup->image);
          $image = $request->file('image')->store('public/images');
        } else {
          $image = $popup->image;
        }

        $reg_date = date("Y-m-d");
        $status = $request->input('agree');


        Popup::where('id', $id)->update([
          'name' => $name,
          'category' => $category,
          'image' => $image,
          'reg_date' => $reg_date,
          'status' => $status
        ]);
        return redirect(route('admin_popup.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $popup = Popup::findOrFail($id);
      Storage::delete($popup->image);

      Popup::destroy($id);
      return redirect(route('admin_popup.index'));
    }
}
