<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Qna_category;

class Qna_categoryController extends Controller
{
 public function index()
 {
     $qna_categorys = Qna_category::orderby('id')->get();
     return view('admin.qna_category-list', ['qna_categorys' => $qna_categorys]);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
     return view('admin.qna_category-add-form');
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
       'id.required'    => '카테고리 이름을 입력해주세요.',
       'id.max'    => '최대 글자 수는 10글자 입니다.'
   ];
   $validator = Validator::make($request->all(), [
       'id' => 'required|max:10'
   ], $messages);
   if ($validator->fails()) {
       return redirect(route('admin_qna_category.create'))
           ->withInput()
           ->withErrors($validator);
   }

   $id = $request->input('id');

   Qna_category::create([
       'id' => $id
   ]);

   return redirect(route('admin_qna_category.index'));
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
     return view('admin.qna_category-show', ['qna_category' => Qna_category::findOrFail($id)]);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {
     return view('admin.qna_category-edit-form', ['qna_category' => Qna_category::findOrFail($id)]);
 }

 /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function update(Request $request, $pri_id)
 {
   $messages = [
       'id.required'    => '카테고리 이름을 입력해주세요.',
       'id.max'    => '최대 글자 수는 10글자 입니다.'
   ];
   $validator = Validator::make($request->all(), [
       'id' => 'required|max:10'
   ], $messages);
   if ($validator->fails()) {
       return redirect(route('admin_qna_category.edit',$pri_id))
           ->withInput()
           ->withErrors($validator);
   }

   $id = $request->input('id');

     Qna_category::where('id', $pri_id)->update([
       'id' => $id
     ]);
     return redirect(route('admin_qna_category.show', $id));
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy($id)
 {
     Qna_category::destroy($id);
     return redirect(route('admin_qna_category.index'));
 }
}
