<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Policy;                     //ORM


class PolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = DB::table('User')->get();
        $Policy = Policy::all();
        return view('admin.policy-list', ['Policy' => $Policy]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.policy-add-form');
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
          'name.required'    => '정책명을 입력해주세요.',
          'name.max'    => '정책명은 20자를 넘을 수 없습니다.',
          'content.required'      => '내용을 입력해주세요.'
      ];
      $validator = Validator::make($request->all(), [
          'name' => 'required|max:20',
          'content' => 'required'
      ], $messages);
      if ($validator->fails()) {
          return redirect('admin/policy-add-form')
              ->withInput()
              ->withErrors($validator);
      }

      $name = $request->input('name');
      $content = $request->input('content');

      Policy::create([
          'name' => $name,
          'content' => $content
      ]);

      return redirect('admin/policy-list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.policy-show', ['Policy' => Policy::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.policy-edit-form', ['Policy' => Policy::findOrFail($id)]);
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
            'name.required'    => '정책명을 입력해주세요.',
            'name.max'    => '정책명은 20자를 넘을 수 없습니다.',
            'content.required'      => '내용을 입력해주세요.'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20',
            'content' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect('admin/policy-add-form')
                ->withInput()
                ->withErrors($validator);
        }

        $name = $request->input('name');
        $content = $request->input('content');

        Policy::where('id', $id)->update([
            'name' => $name,
            'content' => $content
        ]);

        return redirect('admin/policy-list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Policy::destroy($id);
        return redirect('admin/policy-list');
    }
}
