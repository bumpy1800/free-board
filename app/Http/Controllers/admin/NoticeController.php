<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Notice;


class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$notices = notice::all();
      $notices = Notice::all();
      return view('admin.notice-list', ['notices' => $notices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         return view('admin.notice-add-form');
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
         'tit.required'    => '제목을 입력해주세요.',
         'content.required'    => '내용을 입력해주세요.'
       ];
       $validator = Validator::make($request->all(), [
           'tit' => 'required',
           'content' => 'required'
       ], $messages);
       if ($validator->fails()) {
           return redirect(route('admin_notice.create'))
               ->withInput()
               ->withErrors($validator);
       }
       elseif ($request->input('content') == "<p>&nbsp;</p>") { // 컨텐츠 유효성검사 해결하기
          return redirect(route('admin_notice.create'))->withInput()->withErrors($validator, 'content');
       }

       $title = $request->input('tit');

       $contents = $request->input('content');
       if ($contents == "<p>&nbsp;</p>") {
            return $validator->errors()->add('field', 'Something is wrong with this field!')>withInput()
            ->withErrors($validator);
       }


       $reg_date = date("Y-m-d");

       Notice::create([
           'title' => $title,
           'contents' => $contents,
           'reg_date' => $reg_date,
           'view' => 0,
           'comments' => 0,
       ]);
       return redirect(route('admin_notice.index'));
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $notice = Notice::findOrFail($id);
      notice::where('id', $id)->update([
          'view' => $notice->view + 1
      ]);

      return view('admin.notice-show', ['notice' => $notice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notice = Notice::find($id);
        return view('admin.notice-edit-form', ['notice' => $notice]);
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
            'tit.required'    => '제목을 입력해주세요.',
            'content.required'    => '내용을 입력해주세요.'
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'contents' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_noitce.edit', $id))
                ->withInput()
                ->withErrors($validator);
        }

        $title = $request->input('tit');
        $contents = $request->input('content');
        $reg_date = date("Y-m-d");

        notice::where('id', $id)->update([
          'title' => $title,
          'contents' => $contents,
          'reg_date' => $reg_date,
        ]);

        return redirect(route('admin_notice.index'));
        //return redirect(route('admin_notice.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Notice::destroy($id);
      return redirect(route('admin_notice.index'));
    }

    public function galleryFind(Request $request)
    {
      if($search = $request->input('search')) {
        $results = Gallery::where('name', 'like', '%'.$search.'%')->paginate(5);
      }
      else
        $results = Gallery::paginate(5);


      return view('find', ['results' => $results]);
    }
}
