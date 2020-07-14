<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Validator;
use App\Gallery;                     //ORM
use App\Category;                     //ORM
use App\Post;
use App\Popup;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categorys = Category::all();

        foreach($categorys as $category) {
            $gallerys[$category->id] = Gallery::select('link', 'name')->where('category_id', $category->id)->paginate(140);
            $gallerys[$category->id]->withPath('?id='.$category->id);
        }

        if($request->input('id') && $request->input('page')) {
            $gallerys[$request->input('id')] = Gallery::select('link', 'name')->where('category_id', $request->input('id'))->paginate(140);
            $gallerys[$request->input('id')]->withPath('?id='.$request->input('id'));
            return response()->json([
                'id'=>$request->input('id'),
                'page'=>$request->input('page'),
                'gallerys'=>$gallerys[$request->input('id')]
            ]);
        }

        $imgPosts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                          ->select('post.id as post_id', 'post.title as post_title', 'thumbnail', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                          ->where('post.contents', 'like', '%<img%')
                          ->orderby('post.id', 'desc')
                          ->limit(3)
                          ->get();
        $notIn = [];
        if(count($imgPosts) > 0) { //imgPosts 와 중복되지 않기 위함  ``
            $i = 0;
            foreach ($imgPosts as $imgPost) {
              $notIn[$i] = $imgPost->post_id;
              $i ++;
            }
        }
        $posts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                      ->select('post.id as post_id', 'post.title as post_title', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                      ->whereNotIn('post.id', $notIn) //포함하지 않는 것만 추출
                      ->orderby('post.id', 'desc')
                      ->limit(14)
                      ->get();

        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $weekGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                      ->groupby('post.gallery_id')
                      ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                      ->whereBetween('reg_date', [$todayFrom, $todayTo])
                      ->limit(20)
                      ->get();

        $newGallerys = Gallery::select('name', 'link')
                      ->whereBetween('agree_date', [$todayFrom, $todayTo])
                      ->get();

        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                              ->groupBy('gallery_id')
                              ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                              ->whereBetween('reg_date', [date('Y-m-d', strtotime(date('Y-m-d').'-6days')), date('Y-m-d')])
                              ->orderby('total', 'desc')
                              ->limit(50)
                              ->paginate(10);
        $liveGallerys->withPath('/rank');

        $popup = Popup::select('image')
                ->where('status', 1)
                ->where('category', '갤러리 우측')
                ->inRandomOrder()
                ->first();
        $image = Storage::get($popup->image); //이미지 가져와서 text 변환
        $image = base64_encode($image); //base64로 인코딩

        return view('gallery-plus', [
            'gallerys' => $gallerys,
            'categorys' => $categorys,
            'imgPosts' => $imgPosts,
            'weekGallerys' => $weekGallerys,
            'newGallerys' => $newGallerys,
            'recentGallerys' => $recentGallerys,
            'liveGallerys' => $liveGallerys,
            'image' => $image,
            'posts' => $posts
        ]);
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
        $list = Cookie::get('recentVisitGallery');
        $gallery = Gallery::select('name')->where('link', $id)->first();
        $list = $list . $gallery->name . '/';
        $listArr = explode('/', $list);

        if(count($listArr) > 6) {
            array_splice($listArr, 0, 1);
        }
        $list = implode('/', $listArr);
        Cookie::queue('recentVisitGallery', $list, 60);
        return view('gallery');
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

    public function cookieDelete($id)
    {
        $list = Cookie::get('recentVisitGallery');
        $listArr = explode('/', $list);
        array_splice($listArr, $id, 1);
        $list = implode('/', $listArr);
        Cookie::queue('recentVisitGallery', $list, 60);
        return response()->json([
            'list'=>$list,
        ]);
    }
}
