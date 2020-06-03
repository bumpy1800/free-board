<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Gallery;                     //ORM


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = DB::table('Gallery')->get();
        $gallerys = Gallery::all();
        return view('gallery-plus', ['gallerys' => $gallerys]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery-add-form');
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
          's_name.required'    => '갤러리 약자를 입력해주세요.',
          'name.required'    => '갤러리 이름을 입력해주세요.',
          'category_id.required' => '카테고리를 선택해주세요.',
          'link.required'      => '주소를 입력해주세요.',
          'contents.required'      => '설명을 입력해주세요.',
          'reason.required'      => '사유를 입력해주세요.',
          'heads.required'      => '말머리를 입력해주세요.',
          'agree.required'      => '허가여부를 선택해주세요.',
          's_name.max'    => '갤러리 약자의 글자 수가 초과하였습니다.',
          'name.max'    => '갤러리 이름의 글자 수가 초과하였습니다.',
          'link.max'      => '주소의 글자 수가 초과하였습니다.',
          'contents.max'      => '설명의 글자 수가 초과하였습니다.',
          'reason.max'      => '사유의 글자 수가 초과하였습니다.',
          'heads.max'      => '말머리의 글자 수가 초과하였습니다.'
      ];
      $validator = Validator::make($request->all(), [
          's_name' => 'required|max:3',
          'name' => 'required|max:10',
          'category_id' => 'required',
          'link' => 'required|max:10',
          'contents' => 'required|max:10',
          'reason' => 'required|max:10',
          'heads' => 'required|max:10',
          'agree' => 'required|max:10'
      ], $messages);
      if ($validator->fails()) {
          return redirect('admin/gallery-add-form')
              ->withInput()
              ->withErrors($validator);
      }

      $s_name = $request->input('s_name');
      $name = $request->input('name');
      $category_id = $request->input('category_id');
      $link = $request->input('link');
      $contents = $request->input('contents');
      $reason = $request->input('reason');
      $heads = $request->input('heads');
      $agree = $request->input('agree');


      Gallery::create([
          's_name' => $s_name,
          'name' => $name,
          'category_id' => $category_id,
          'link' => $link,
          'contents' => $contents,
          'reason' => $reason,
          'heads' => $heads,
          'agree' => $agree,
      ]);

      return redirect('admin/gallery-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.gallery-show', ['gallery' => Gallery::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.gallery-edit-form', ['gallery' => Gallery::findOrFail($id)]);
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
          's_name.required'    => '갤러리 약자를 입력해주세요.',
          'name.required'    => '갤러리 이름을 입력해주세요.',
          'category_id.required' => '카테고리를 선택해주세요.',
          'link.required'      => '주소를 입력해주세요.',
          'contents.required'      => '설명을 입력해주세요.',
          'reason.required'      => '사유를 입력해주세요.',
          'heads.required'      => '말머리를 입력해주세요.',
          'agree.required'      => '허가여부를 선택해주세요.',
          's_name.max'    => '갤러리 약자의 글자 수가 초과하였습니다.',
          'name.max'    => '갤러리 이름의 글자 수가 초과하였습니다.',
          'link.max'      => '주소의 글자 수가 초과하였습니다.',
          'contents.max'      => '설명의 글자 수가 초과하였습니다.',
          'reason.max'      => '사유의 글자 수가 초과하였습니다.',
          'heads.max'      => '말머리의 글자 수가 초과하였습니다.'
        ];
        $validator = Validator::make($request->all(), [
            's_name' => 'required|max:3',
            'name' => 'required|max:10',
            'category_id' => 'required|max:10',
            'link' => 'required|max:10',
            'contents' => 'required|max:10',
            'reason' => 'required|max:10',
            'heads' => 'required|max:10',
            'agree' => 'required|max:10'
        ], $messages);
        if ($validator->fails()) {
            return redirect('admin/gallery-edit-form/' . $id)
                ->withInput()
                ->withErrors($validator);
        }

        $s_name = $request->input('s_name');
        $name = $request->input('name');
        $category_id = $request->input('category_id');
        $link = $request->input('link');
        $contents = $request->input('contents');
        $reason = $request->input('reason');
        $heads = $request->input('heads');
        $agree = $request->input('agree');

        Gallery::where('id', $id)->update([
          's_name' => $s_name,
          'name' => $name,
          'category_id' => $category_id,
          'link' => $link,
          'contents' => $contents,
          'reason' => $reason,
          'heads' => $heads,
          'agree' => $agree,
      ]);
      exit($id);
        return redirect('admin/gallery-show/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gallery::destroy($id);
        return redirect('admin/gallery-list');
    }
}
