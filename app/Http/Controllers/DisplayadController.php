<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use File;
use App\Displayad;

class DisplayadController extends Controller
{
    public function index()
    {
        return view('display-ad');
    }

     public function create()
     {
         return view('display-ad-contact');
     }

     public function store(Request $request)
     {
       $messages = [
           'category.required'    => '제목을 입력해주세요.',
           'co_name.required'    => '제목을 입력해주세요.',
           'director.required'    => '내용을 입력해주세요.',
           'phone.required'    => '제목을 입력해주세요.',
           'email.required'    => '제목을 입력해주세요.',
           'division.required'    => '내용을 입력해주세요.',
           'title.required'    => '제목을 입력해주세요.',
           'term.required'    => '제목을 입력해주세요.',
           'hopemoney.required'    => '내용을 입력해주세요.',
           'contents.required'    => '제목을 입력해주세요.',
           'image.required'    => '제목을 입력해주세요.',
           'check1.required'    => '제목을 입력해주세요.',
           'check2.required'    => '제목을 입력해주세요.',
       ];
       $validator = Validator::make($request->all(), [
           'category' => 'required',
           'co_name' => 'required',
           'director' => 'required',
           'phone' => 'required',
           'email' => 'required',
           'division' => 'required',
           'title' => 'required',
           'term' => 'required',
           'hopemoney' => 'required',
           'contents' => 'required',
           'image' => 'required',
           'check1' => 'required',
           'check2' => 'required',
       ], $messages);
       if ($validator->fails()) {
           return redirect(route('display-ad.create'))
               ->withInput()
               ->withErrors($validator);
       }

       $category = $request->input('category');
       $co_name = $request->input('co_name');
       $director = $request->input('director');
       $phone = $request->input('phone');
       $email = $request->input('email');
       $division = $request->input('division');
       $title = $request->input('title');
       $term = $request->input('term');
       $hopemoney = $request->input('hopemoney');
       $contents = $request->input('contents');
       $image = $request->file('image')->store('public/images');
       $date = date('Y-m-d');

       Displayad::create([
           'category' => $category,
           'co_name' => $co_name,
           'director' => $director,
           'phone' => $phone,
           'email' => $email,
           'division' => $division,
           'title' => $title,
           'term' => $term,
           'hopemoney' => $hopemoney,
           'contents' => $contents,
           'image' => $image,
           'date' => $date,
       ]);
       return redirect(route('display-ad.index'));
     }

    public function show($link, $id)
    {

        return view('admin.post-show');
    }

    public function edit($id)
    {
        return view('admin.post-edit-form');
    }

    public function update(Request $request, $id)
    {
        return redirect(route('admin_post.index'));
    }
}
