<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Post;
use App\Gallery;
use App\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //$posts = Post::all();
      $posts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                    /*->join('users', 'post.user_id', '=', 'user.id')
                    ->select('post.*', 'gallery.name as gallery_name', 'user.name as user_name')*/
                    ->select('post.*', 'gallery.name as gallery_name', 'gallery.link as gallery_link')
                    ->get();

      return view('admin.post-list', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create()
     {
         return view('admin.post-add-form');
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
       $user_id = 1;
       $reg_date = date("Y-m-d");
       $image = "1";
       $view = 0;
       $good = 0;
       $bad = 0;
       $comments = 0;
       $head = $request->input('head');
       $notice = 0;
       $gallery_id = $request->input('idH');
       $password = $request->input('password');

       Post::create([
           'title' => $title,
           'contents' => $contents,
           'user_id' => $user_id,
           'reg_date' => $reg_date,
           'image' => $image,
           'view' => $view,
           'good' => $good,
           'bad' => $bad,
           'comments' => $comments,
           'head' => $head,
           'notice' => $notice,
           'gallery_id' => $gallery_id,
           'password' => $password
       ]);

       return redirect(route('admin_post.index'));
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($link, $id)
    {
      $post = Post::findOrFail($id);

      Post::where('id', $id)->update([
          'view' => $post->view + 1
      ]);

      $post = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                    //->join('comment', 'post.id', '=', 'comment.post_id')
                    ->select('post.*', 'gallery.name as gallery_name', 'gallery.link as gallery_link')
                    ->where('gallery.link', '=', $link, 'and', 'post.id', '=', $id)
                    ->first();

      $comments = Comment::join('post', 'comment.post_id', '=', 'post.id')
                    ->select('comment.*')
                    ->orderby('comment.id')
                    ->get();

      return view('admin.post-show', ['post' => $post], ['comments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$post = Post::findOrFail($id);
        $post = Post::find($id)
                      ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
                      ->select('post.*' ,'gallery.id as gallery_id', 'gallery.name as gallery_name', 'gallery.heads as gallery_heads')
                      ->first();
        //exit($post);
        return view('admin.post-edit-form', ['post' => $post]);
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
        $user_id = 1;
        $reg_date = date("Y-m-d");
        $image = "1";
        $view = 0;
        $good = 0;
        $bad = 0;
        $comments = 0;
        $head = $request->input('head');
        $notice = 0;
        $gallery_id = $request->input('idH');
        $password = $request->input('password');

        Post::where('id', $id)->update([
          'title' => $title,
          'contents' => $contents,
          'user_id' => $user_id,
          'reg_date' => $reg_date,
          'image' => $image,
          'view' => $view,
          'good' => $good,
          'bad' => $bad,
          'comments' => $comments,
          'head' => $head,
          'notice' => $notice,
          'gallery_id' => $gallery_id,
          'password' => $password
      ]);

      return redirect(route('admin_post.index'));
        //return redirect(route('admin_post.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Post::destroy($id);
      return redirect(route('admin_post.index'));
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
