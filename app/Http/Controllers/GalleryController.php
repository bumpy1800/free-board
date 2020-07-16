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
        if($request->input('id') && $request->input('page')) {
            $gallerys[$request->input('id')] = Gallery::select('link', 'name')->where('category_id', $request->input('id'))->paginate(140);
            $gallerys[$request->input('id')]->withPath('?id='.$request->input('id'));
            return response()->json([
                'id'=>$request->input('id'),
                'page'=>$request->input('page'),
                'gallerys'=>$gallerys[$request->input('id')]
            ]);
        }

        if($request->input('rank') && $request->input('page')) {
            $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                                ->groupBy('gallery_id')
                                ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                                ->orderby('total', 'desc')
                                ->limit(50)
                                ->paginate(10);
            $liveGallerys->withPath('?rank='.$request->input('rank'));

            return response()->json([
                'rank'=>$request->input('rank'),
                'page'=>$request->input('page'),
                'liveGallerys'=>$liveGallerys
            ]);
        }

        if($request->input('changeGallery') == 1) {
            $liveChanges = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                                ->groupBy('gallery_id')
                                ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                                ->orderby('total', 'desc')
                                ->limit(50)
                                ->paginate(50);
            return response()->json([
                'liveChanges'=>$liveChanges
            ]);
        }

        if (strpos($request->url(),"game-gallery")){
            $other_index = $this->other_index(['게임']);
            $view_page = 'gallery-plus-game';
        } elseif (strpos($request->url(),"enter-gallery")) {
            $other_index = $this->other_index(['연예', '방송']);
            $view_page = 'gallery-plus-enter';
        } elseif (strpos($request->url(),"sports-gallery")) {
            $other_index = $this->other_index(['스포츠']);
            $view_page = 'gallery-plus-sports';
        } elseif (strpos($request->url(),"edu-gallery")) {
            $other_index = $this->other_index(['교육', '금융', 'IT']);
            $view_page = 'gallery-plus-edu';
        } elseif (strpos($request->url(),"travel-gallery")) {
            $other_index = $this->other_index(['여행', '음식', '생물']);
            $view_page = 'gallery-plus-travel';
        } elseif (strpos($request->url(),"hobby-gallery")) {
            $other_index = $this->other_index(['취미', '생활']);
            $view_page = 'gallery-plus-hobby';
        } else {
            $other_index = $this->other_index([]);
            $view_page = 'gallery-plus';
        }
        $categorys = $other_index[0];
        $imgPosts = $other_index[1];
        $posts  = $other_index[2];
        $newGallerys = $other_index[3];

        foreach($categorys as $category) {
            $gallerys[$category->id] = Gallery::select('link', 'name')->where('category_id', $category->id)->paginate(140);
            $gallerys[$category->id]->withPath('?id='.$category->id);
        }

        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $weekGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                      ->groupby('post.gallery_id')
                      ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                      ->whereBetween('reg_date', [$todayFrom, $todayTo])
                      ->limit(20)
                      ->get();

        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $liveGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(50)
                            ->paginate(10);
        $liveGallerys->withPath('?rank=11');

        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '갤러리 우측')
              ->inRandomOrder()
              ->first();
        $image = Storage::get($popup->image); //이미지 가져와서 text 변환
        $image = base64_encode($image); //base64로 인코딩

        return view($view_page, [
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

    public function other_index($categoryNames) {

        $cnt = count($categoryNames);
        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));

        if($cnt == 0) {
            $categorys = Category::select('id', 'name')->get();

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

            $newGallerys = Gallery::select('name', 'link')
                          ->whereBetween('agree_date', [$todayFrom, $todayTo])
                          ->get();
            return [$categorys, $imgPosts, $posts, $newGallerys];
        }
        if($cnt == 1) {
            $categoryName = $categoryNames[0];
            $categorys = Category::select('id', 'name')->where('name', $categoryName)->get();

            $imgPosts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                              ->join('category', 'gallery.category_id', '=', 'category.id')
                              ->select('post.id as post_id', 'post.title as post_title', 'thumbnail', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                              ->where('category.name', $categoryName)
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
                          ->join('category', 'gallery.category_id', '=', 'category.id')
                          ->select('post.id as post_id', 'post.title as post_title', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                          ->where('category.name', $categoryName)
                          ->whereNotIn('post.id', $notIn) //포함하지 않는 것만 추출
                          ->orderby('post.id', 'desc')
                          ->limit(14)
                          ->get();

            $newGallerys = Gallery::join('category', 'gallery.category_id', '=', 'category.id')
                          ->select('gallery.name', 'gallery.link')
                          ->whereBetween('agree_date', [$todayFrom, $todayTo])
                          ->where('category.name', $categoryName)
                          ->get();
        } elseif($cnt == 2) {
            $categoryName = $categoryNames[0];
            $categoryName2 = $categoryNames[1];
            $categorys = Category::select('id', 'name')
                                ->where('name', $categoryName)
                                ->orWhere('name', $categoryName2)
                                ->get();

            $imgPosts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                              ->join('category', 'gallery.category_id', '=', 'category.id')
                              ->select('post.id as post_id', 'post.title as post_title', 'thumbnail', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                              ->where('category.name', $categoryName)
                              ->orWhere('category.name', $categoryName2)
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
                          ->join('category', 'gallery.category_id', '=', 'category.id')
                          ->select('post.id as post_id', 'post.title as post_title', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                          ->where('category.name', $categoryName)
                          ->orWhere('category.name', $categoryName2)
                          ->whereNotIn('post.id', $notIn) //포함하지 않는 것만 추출
                          ->orderby('post.id', 'desc')
                          ->limit(14)
                          ->get();

            $newGallerys = Gallery::join('category', 'gallery.category_id', '=', 'category.id')
                          ->select('gallery.name', 'gallery.link')
                          ->whereBetween('agree_date', [$todayFrom, $todayTo])
                          ->where('category.name', $categoryName)
                          ->orWhere('category.name', $categoryName2)
                          ->get();
        } elseif($cnt == 3) {
            $categoryName = $categoryNames[0];
            $categoryName2 = $categoryNames[1];
            $categoryName3 = $categoryNames[2];
            $categorys = Category::select('id', 'name')
                                ->where('name', $categoryName)
                                ->orWhere('name', $categoryName2)
                                ->orWhere('name', $categoryName3)
                                ->get();

            $imgPosts = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                              ->join('category', 'gallery.category_id', '=', 'category.id')
                              ->select('post.id as post_id', 'post.title as post_title', 'thumbnail', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                              ->where('category.name', $categoryName)
                              ->orWhere('category.name', $categoryName2)
                              ->orWhere('category.name', $categoryName3)
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
                          ->join('category', 'gallery.category_id', '=', 'category.id')
                          ->select('post.id as post_id', 'post.title as post_title', 'gallery.s_name as gallery_s_name', 'gallery.link as gallery_link')
                          ->where('category.name', $categoryName)
                          ->orWhere('category.name', $categoryName2)
                          ->orWhere('category.name', $categoryName3)
                          ->whereNotIn('post.id', $notIn) //포함하지 않는 것만 추출
                          ->orderby('post.id', 'desc')
                          ->limit(14)
                          ->get();

            $newGallerys = Gallery::join('category', 'gallery.category_id', '=', 'category.id')
                          ->select('gallery.name', 'gallery.link')
                          ->whereBetween('agree_date', [$todayFrom, $todayTo])
                          ->where('category.name', $categoryName)
                          ->orWhere('category.name', $categoryName2)
                          ->orWhere('category.name', $categoryName3)
                          ->get();
        }
        return [$categorys, $imgPosts, $posts, $newGallerys];
    }
    public function week_gallerys()
    {
        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $weekGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->groupby('post.gallery_id')
            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
            ->whereBetween('reg_date', [$todayFrom, $todayTo])
            ->orderby('total', 'desc')
            ->limit(100)
            ->get();

        return response()->json([
            'weekGallerys'=>$weekGallerys
        ]);
    }
}
