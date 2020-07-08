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
       $messages = [
           'title.required'    => '제목을 입력해주세요.',
           'contents.required'    => '내용을 입력해주세요.',
           'gallery_id.required' => '갤러리를 선택해주세요.',
           'password.required'      => '암호를 입력해주세요.'
       ];
       $validator = Validator::make($request->all(), [
           'title' => 'required',
           'contents' => 'required',
           'gallery_id' => 'required',
           'password' => 'required'
       ], $messages);
       if ($validator->fails()) {
           return redirect('admin/post-add-form')
               ->withInput()
               ->withErrors($validator);
       }

       $title = $request->input('tit');
       $contents = $request->input('content');
       $user_id = 1;
       $reg_date = date("Y-m-d");
       $ip = $this->getUserIpAddr();
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
           'ip' => $ip,
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
                    ->select('post.*', 'post.ip as post_ip', 'gallery.name as gallery_name', 'gallery.link as gallery_link')
                    ->where('gallery.link', '=', $link)
                    ->where('post.id', '=', $id)
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
        $messages = [
            'title.required'    => '제목을 입력해주세요.',
            'contents.required'    => '내용을 입력해주세요.',
            'gallery_id.required' => '갤러리를 선택해주세요.',
            'password.required'      => '암호를 입력해주세요.'
        ];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'contents' => 'required',
            'gallery_id' => 'required',
            'password' => 'required'
        ], $messages);
        if ($validator->fails()) {
            return redirect(route('admin_post.edit', $id))
                ->withInput()
                ->withErrors($validator);
        }

        $title = $request->input('tit');
        $contents = $request->input('content');
        $user_id = 1;
        $reg_date = date("Y-m-d");
        $ip = $this->getUserIpAddr();
        $head = $request->input('head');
        $notice = 0;
        $gallery_id = $request->input('idH');
        $password = $request->input('password');

        Post::where('id', $id)->update([
          'title' => $title,
          'contents' => $contents,
          'user_id' => $user_id,
          'reg_date' => $reg_date,
          'ip' => $ip,
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
