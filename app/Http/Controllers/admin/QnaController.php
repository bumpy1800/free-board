<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Qna;
use App\Qna_category;

class QnaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$qnas = qna::all();
      $qnas = Qna::select('*')->orderby('category')->get();
      return view('admin.qna-list', ['qnas' => $qnas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         return view('/');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
       return redirect('/');
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $qna = Qna::findOrFail($id);
      return view('admin.qna-show', ['qna' => $qna]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $qna = Qna::findOrFail($id);
        $qna_categorys = Qna_category::orderby('id')->get();
        return view('admin.qna-edit-form', ['qna' => $qna], ['qna_categorys' => $qna_categorys]);
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
            'title.required'    => '값을 입력해주세요.',
            'contents.required'    => '값을 입력해주세요.',
            'category.required'    => '값을 입력해주세요.'
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'contents' => 'required',
            'category' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_qna.edit',$id))
                ->withInput()
                ->withErrors($validator);
        }

        $title = $request->input('title');
        $contents = $request->input('contents');
        $category = $request->input('category');
        $reg_date = date("Y-m-d");

        Qna::where('id', $id)->update([
          'title' => $title,
          'contents' => $contents,
          'category' => $category,
          'reg_date' => $reg_date
      ]);

      return redirect(route('admin_qna.index'));
        //return redirect(route('admin_qna.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      qna::destroy($id);
      return redirect(route('admin_qna.index'));
    }
}
