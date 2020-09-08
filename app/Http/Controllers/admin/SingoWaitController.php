<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Singo;                     //ORM


class SingoWaitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = DB::table('User')->get();
        $Singos = Singo::join('singo_category', 'singo.category_id', '=', 'singo_category.id')
                            ->join('post', 'singo.post_id', '=', 'post.id')
                            ->join('user as user1', 'singo.reporter', '=', 'user1.id')
                            ->join('user as user2', 'singo.post_writer', '=', 'user2.id')
                            ->select('singo.*', 'singo_category.name as singo_category_name', 'post.title as post_title', 'user1.name as user_reporter', 'user2.name as writer')
                            ->where('singo.status', '-1')
                            ->get();
        return view('admin.singo_wait-list', ['Singos' => $Singos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.singo_wait-show', ['Singo' => Singo::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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

        Singo::where('id', $id)->update([

            'status' => 1

        ]);

        return redirect(route('admin_singo_wait.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Singo::destroy($id);
        return redirect(route('admin_singo_wait.index'));
    }
}
