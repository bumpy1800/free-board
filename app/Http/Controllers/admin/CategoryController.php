<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoryController extends Controller
{
 public function index()
 {
     //$users = DB::table('category')->get();
     $categorys = category::all();
     return view('admin.category-list', ['categorys' => $categorys]);
 }

 /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
 public function create()
 {
     return view('admin.category-add-form');
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
       'name.max'    => '최대 글자 수는 10글자 입니다.'
   ];
   $validator = Validator::make($request->all(), [
       'name' => 'required|max:10'
   ], $messages);
   if ($validator->fails()) {
       return redirect(route('admin_category.create'))
           ->withInput()
           ->withErrors($validator);
   }

   $name = $request->input('name');

   category::create([
       'name' => $name
   ]);

   return redirect(route('admin_category.index'));
 }

 /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function show($id)
 {
     return view('admin.category-show', ['category' => category::findOrFail($id)]);
 }

 /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function edit($id)
 {
     return view('admin.category-edit-form', ['category' => category::findOrFail($id)]);
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
       'name.max'    => '최대 글자 수는 10글자 입니다.'
   ];
   $validator = Validator::make($request->all(), [
       'name' => 'required|max:10'
   ], $messages);
   if ($validator->fails()) {
       return redirect(route('admin_category.edit',$id))
           ->withInput()
           ->withErrors($validator);
   }

   $name = $request->input('name');

     category::where('id', $id)->update([
       'name' => $name
     ]);
     return redirect(route('admin_category.show', $id));
 }

 /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
 public function destroy($id)
 {
     category::destroy($id);
     return redirect(route('admin_category.index'));
 }
}
