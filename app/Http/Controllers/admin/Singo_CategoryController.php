<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Singo_category;

class Singo_categoryController extends Controller
{
 public function index()
 {
     $singo_categorys = Singo_category::orderby('id')->get();
     return view('admin.singo_category-list', ['singo_categorys' => $singo_categorys]);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
     return view('admin.singo_category-add-form');
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
       'name.required'    => '카테고리 이름을 입력해주세요.',
       'name.max'    => '최대 글자 수는 20글자 입니다.'
   ];
   $validator = Validator::make($request->all(), [
       'name' => 'required|max:20'
   ], $messages);
   if ($validator->fails()) {
       return redirect(route('admin_singo_category.create'))
           ->withInput()
           ->withErrors($validator);
   }

   $name = $request->input('name');

   Singo_category::create([
       'name' => $name
   ]);

   return redirect(route('admin_singo_category.index'));
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
     //return view('admin.singo_category-show', ['singo_category' => Singo_category::findOrFail($id)]);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {
     return view('admin.singo_category-edit-form', ['singo_category' => Singo_category::findOrFail($id)]);
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
       'name.required'    => '카테고리 이름을 입력해주세요.',
       'name.max'    => '최대 글자 수는 20글자 입니다.'
   ];
   $validator = Validator::make($request->all(), [
       'name' => 'required|max:20'
   ], $messages);
   if ($validator->fails()) {
       return redirect(route('admin_singo_category.edit',$id))
           ->withInput()
           ->withErrors($validator);
   }

   $name = $request->input('name');

     Singo_category::where('id', $id)->update([
       'name' => $name
     ]);
     return redirect(route('admin_singo_category.index', $id));
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy($id)
 {
     Singo_category::destroy($id);
     return redirect(route('admin_singo_category.index'));
 }
}
