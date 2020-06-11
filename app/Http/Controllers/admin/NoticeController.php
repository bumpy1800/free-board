<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
       /*$messages = [
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
       }*/
       $title = $request->input('tit');
       $contents = $request->input('content');
       $reg_date = date("Y-m-d");
       $view = 0;

       Notice::create([
           'title' => $title,
           'contents' => $contents,
           'reg_date' => $reg_date,
           'view' => $view
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
        /*$messages = [
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
        }*/

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

    public function getUserIpAddr(){
       $ipaddress = '';
       if (isset($_SERVER['HTTP_CLIENT_IP']))
           $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
       else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_X_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
       else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
           $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
       else if(isset($_SERVER['HTTP_FORWARDED']))
           $ipaddress = $_SERVER['HTTP_FORWARDED'];
       else if(isset($_SERVER['REMOTE_ADDR']))
           $ipaddress = $_SERVER['REMOTE_ADDR'];
       else
           $ipaddress = 'UNKNOWN';
       return $ipaddress;
    }
}
