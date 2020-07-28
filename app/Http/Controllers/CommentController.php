<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use App\Comment;
use App\Post;
use App\Notice;

class CommentController extends Controller
{
    public function index()
    {
      //$comments = comment::all();
      $comments = comment::join('post', 'comment.post_id', '=', 'post.id')
                        ->join('gallery', 'post.gallery_id', '=', 'gallery.id')
                        //->select('comment.*', 'gallery.name as gallery_name', 'user.name as user_name')*/
                        ->select('comment.*', 'post.title as post_title', 'post.id as post_id', 'gallery.link as gallery_link')
                        ->get();
      return view('admin.comment-list', ['comments' => $comments]);
    }

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

       $post_gallery_link = '';
       if( $request->input('post_gallery_link')) {
           $post_gallery_link = $request->input('post_gallery_link');
       }

       $nouser_name = $request->input('name');
       $nouser_pw = $request->input('password');
       $contents = $request->input('content');
       $post_id = $request->input('postId');
       $reg_date = date("Y-m-d");
       $user_id = 1;
       $ip = $this->getUserIpAddr();

       $comment_id_rep = $request->input('commentId');

       $rep_co = Comment::select('id')
                          ->where('id', '=' , $comment_id_rep)
                          ->first();

       $comment = Comment::select('*')
                          ->where('post_id', '=' , $post_id)
                          ->get();

       $comment_id = 0;
       $max_id = 0;
       $min_id = 0;

       if(!$rep_co) {
         if(count($comment) <= 0)
            $comment_id = 100;
         else
            $max_id = Comment::where('post_id', '=' , $post_id)->max('id');
            $max_id = substr($max_id, -8, -2);
            //$comment_id = Comment::max('id') + 100;//$comment->id;
            $comment_id = ((int)$max_id + 1) * 100;
       }
       else {
          //  $max_id = Comment::where('', '', '')->max('id');
            $max_id = substr($rep_co->id, -8, -2);
            $min_id = ((int)$max_id) * 100;
            $max_id = $min_id + 100;

            $max = Comment::whereBetween('id', [$min_id+1, $max_id-1])->max('id');

            if($max)
              $comment_id = (int)$max + 1;
            else
              $comment_id = $min_id + 1;
       }

       try {
         Comment::create([
             'id' => $comment_id,
             'nouser_name' => $nouser_name,
             'nouser_pw' => $nouser_pw,
             'contents' => $contents,
             'post_id' => $post_id,
             'reg_date' => $reg_date,
             'user_id' => 1,
             'ip' => $this->getUserIpAddr()
         ]);

         if($request->input('type') == null) { // 등록+추천

             $list = Cookie::get('goodBadPointList');
             if(strpos($list, $post_id . '/') === false) {
                 $list = $list . $post_id . '/';
                 Post::where('id', $post_id)->increment('good');
                 Cookie::queue('goodBadPointList', $list, 1440);
             }
             Post::where('id', $post_id)->increment('comments');
         } else {   // 등록, type=register(GET)
             Post::where('id', $post_id)->increment('comments');
         }

         if($post_gallery_link != '') {
             return redirect('gallery-post/'.$post_gallery_link.'/'.$post_id);
         }
         else {
             return redirect('gallery-hit/'.$post_id);
         }
       } catch(Exception $e) {
         return redirect('error');
       }
    }

    public function notice_store(Request $request)
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
      $nouser_name = $request->input('name');
      $nouser_pw = $request->input('password');
      $contents = $request->input('content');
      $notice_id = $request->input('postId');
      $reg_date = date("Y-m-d");
      $user_id = 1;
      $ip = $this->getUserIpAddr();

      $comment_id_rep = $request->input('commentId');

      $rep_co = Comment::select('id')
                         ->where('id', '=' , $comment_id_rep)
                         ->first();

      $comment = Comment::select('*')
                         ->where('notice_id', '=' , $notice_id)
                         ->get();

      $comment_id = 0;
      $max_id = 0;
      $min_id = 0;

      if(!$rep_co) {
        if(count($comment) <= 0)
           $comment_id = 100;
        else
           $max_id = Comment::where('notice_id', '=' , $notice_id)->max('id');
           $max_id = substr($max_id, -8, -2);
           //$comment_id = Comment::max('id') + 100;//$comment->id;
           $comment_id = ((int)$max_id + 1) * 100;
      }
      else {
         //  $max_id = Comment::where('', '', '')->max('id');
           $max_id = substr($rep_co->id, -8, -2);
           $min_id = ((int)$max_id) * 100;
           $max_id = $min_id + 100;

           $max = Comment::whereBetween('id', [$min_id+1, $max_id-1])->max('id');

           if($max)
             $comment_id = (int)$max + 1;
           else
             $comment_id = $min_id + 1;
      }

      try {
        Comment::create([
            'id' => $comment_id,
            'nouser_name' => $nouser_name,
            'nouser_pw' => $nouser_pw,
            'contents' => $contents,
            'post_id' => 0,
            'notice_id' => $notice_id,
            'reg_date' => $reg_date,
            'user_id' => 1,
            'ip' => $this->getUserIpAddr()
        ]);
        Notice::where('id', $notice_id)->increment('comments');
        return redirect('notice/'.$notice_id);
      } catch(Exception $e) {
        return redirect('error');
      }
   }

    public function show($id)
    {
      return view('');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$comment = comment::findOrFail($id);
        $comment = comment::findOrFail($id);
        //exit($comment);
        return view('admin.comment-edit-form', ['comment' => $comment]);
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

        $nouser_name = $request->input('name');
        $contents = $request->input('content');
        $ip = $this->getUserIpAddr();

        comment::where('id', $id)->update([
          'nouser_name' => $nouser_name,
          'contents' => $contents,
          'ip' => $ip
        ]);

        return redirect(route('admin_comment.index'));
        //return redirect(route('admin_comment.show', $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $comment = Comment::select('post_id')
                         ->where('id', '=' , $id)
                         ->first();

      $post = Post::findOrFail($comment->post_id);
      Post::where('id', $comment->post_id)->update([
          'comments' => $post->comments - 1
      ]);

      comment::where('id',  '=', $id)->delete();

      return redirect(route('admin_comment.index'));
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
