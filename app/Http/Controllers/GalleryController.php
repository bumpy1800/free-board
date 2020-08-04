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
use App\User;
use App\Popup;
use App\Link_gallery;
use App\Comment;

class GalleryController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Seoul');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->yPostCnt = Post::where('reg_date', $yesterday)->count();
        $this->yCommentCnt = Comment::where('reg_date', $yesterday)->count();
        $this->footer_gallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                            ->groupBy('gallery_id')
                            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                            ->orderby('total', 'desc')
                            ->limit(10)
                            ->get();
    }

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
            $gallerys[$category->category_id] = Gallery::select('link', 'name')->where('category_id', $category->category_id)->paginate(140);
            $gallerys[$category->category_id]->withPath('?id='.$category->category_id);
        }

        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $weekGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
                      ->groupby('post.gallery_id')
                      ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total')
                      ->whereBetween('reg_date', [$todayFrom, $todayTo])
                      ->orderby('total', 'desc')
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
            'posts' => $posts,
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
        ]);
    }


    public function create()
    {
        return view('admin.gallery-add-form');
    }


    public function store(Request $request)
    {
        return redirect('admin/gallery-list');
    }


    public function show(Request $request, $id)
    {
        $list = Cookie::get('recentVisitGallery');
        $gallery = Gallery::select('*')->where('link', $id)->first();

        if(strpos($list, $gallery->name . '/') === false) {
            $list = $list . $gallery->name . '/';
            $listArr = explode('/', $list);
            if(count($listArr) > 6) {
                array_splice($listArr, 0, 1);
            }
            $list = implode('/', $listArr);
        }
        Cookie::queue('recentVisitGallery', $list, 60);

        $todayTo = date('Y-m-d');
        $todayFrom = date('Y-m-d', strtotime($todayTo.'-7days'));
        $weekGallerys = Post::join('gallery', 'post.gallery_id', '=', 'gallery.id')
            ->groupby('post.gallery_id')
            ->selectRaw('gallery.name as gallery_name, gallery.link as gallery_link, count(*) as total, gallery.id as gallery_id')
            ->whereBetween('reg_date', [$todayFrom, $todayTo])
            ->orderby('total', 'desc')
            ->limit(10)
            ->get();

        $rank = 0;
        $i = 1;
        foreach($weekGallerys as $weekGallery) {
            if($weekGallery->gallery_id == $gallery->id) {
                $rank = $i;
                break;
            }
            $i ++;
        }
        $users = User::select('*')->where('gallery_id', $gallery->id)->orderby('status')->get();

        $link_gallerys = Link_gallery::where('gallery_id', $gallery->id)->count();

        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '갤러리 우측')
              ->inRandomOrder()
              ->first();
        if($popup) {
            $image = Storage::get($popup->image); //이미지 가져와서 text 변환
            $r_image = base64_encode($image); //base64로 인코딩
        } else {
            $r_image = '';
        }
        $popup = Popup::select('image')
              ->where('status', 1)
              ->where('category', '갤러리 중앙')
              ->inRandomOrder()
              ->first();
        if($popup) {
            $image = Storage::get($popup->image); //이미지 가져와서 text 변환
            $c_image = base64_encode($image); //base64로 인코딩
        } else {
            $c_image = '';
        }

        $list = Cookie::get('recentVisitGallery');
        $recentGallerys = explode('/', $list);

        $heads = explode('/', $gallery->heads);

        $showCnt = 30;
        if($request->input('showCnt')) {
            $showCnt = $request->input('showCnt');
        }
        $head = '';
        if($request->input('head')) {
            $head = $request->input('head');
        }
        $search_type = '';
        $search_keyword = '';
        $showPost = '';
        if($request->input('search_keyword')) {
            $search_type = $request->input('search_type');
            $search_keyword = $request->input('search_keyword');
            $showPost = $this->showSearchPost($gallery->id, $showCnt, $search_type, $search_keyword);
        } else {
            $showPost = $this->showPost($gallery->id, $showCnt, $head);
        }

        $n_posts = $showPost['n_posts'];
        $posts = $showPost['posts'];

        return view('gallery', [
            'gallery' => $gallery,
            'users' => $users,
            'rank' => $rank,
            'link_gallerys' => $link_gallerys,
            'r_image' => $r_image,
            'c_image' => $c_image,
            'recentGallerys' => $recentGallerys,
            'heads' => $heads,
            'select_head' => $head,
            'showCnt' => $showCnt,
            'n_posts' => $n_posts,
            'posts' => $posts,
            'search_type' => $search_type,
            'yPostCnt' => $this->yPostCnt,
            'yCommentCnt' => $this->yCommentCnt,
            'footer_gallerys' => $this->footer_gallerys,
        ]);
    }

    public function showSearchPost($gallery_id, $showCnt, $search_type, $search_keyword) {
        $n_posts = [];
        $posts = [];

        $n_posts = $this->showNoticePost($gallery_id);
        $limit = $showCnt - count($n_posts);

        if($search_type == 'search_all') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where(function($query) use ($gallery_id, $search_keyword) {
                    $query->where('post.title', 'like', '%'.$search_keyword.'%')
                          ->orWhere('post.contents', 'like', '%'.$search_keyword.'%')
                          ->orWhere('user.nick', 'like', '%'.$search_keyword.'%');
                })
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_subject') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where('post.title', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_memo') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where('post.contents', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_name') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where('user.nick', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        } else if($search_type == 'search_subject_memo') {
            $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                ->where('post.gallery_id', $gallery_id)
                ->where('post.title', 'like', '%'.$search_keyword.'%')
                ->where('post.contents', 'like', '%'.$search_keyword.'%')
                ->orderby('post.id', 'desc')
                ->paginate($limit);
        }
        return [
            'n_posts' => $n_posts,
            'posts' => $posts
        ];
    }

    public function showNoticePost($gallery_id) {
        $n_posts = [];
        $n_posts = Post::join('user', 'post.user_id', '=', 'user.id')
            ->select('post.id as post_id', 'post.title as post_title', 'post.comments as post_comments',
            'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good','user.nick as user_nick')
            ->where('post.gallery_id', $gallery_id)
            ->where('post.notice', 1)
            ->orderby('post.id', 'desc')
            ->get();
        return $n_posts;
    }

    public function showPost($gallery_id, $showCnt, $head) {
        $n_posts = [];
        $posts = [];
        $n_posts = $this->showNoticePost($gallery_id);
        $limit = $showCnt - count($n_posts);
        if($head != '공지') {
            if($head == '') {
                $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                    ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                    'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                    'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                    ->where('post.gallery_id', $gallery_id)
                    ->orderby('post.id', 'desc')
                    ->paginate($limit);
            } else {
                $posts = Post::join('user', 'post.user_id', '=', 'user.id')
                    ->select('post.id as post_id', 'post.head as post_head', 'post.title as post_title', 'post.comments as post_comments',
                    'post.reg_date as post_reg_date', 'post.view as post_view', 'post.good as post_good', 'post.thumbnail as post_thumbnail',
                    'post.ip as post_ip', 'user.nick as user_nick','user.status as user_status', 'user.uid as user_uid')
                    ->where('post.gallery_id', $gallery_id)
                    ->where('post.head', $head)
                    ->orderby('post.id', 'desc')
                    ->paginate($limit);
            }
            $posts->withPath('?showCnt='.$showCnt);
        }
        return [
            'n_posts' => $n_posts,
            'posts' => $posts
        ];
    }

    public function link_gallery(Request $request) {
        if($request->isMethod('get')) {
            $id = $request->input('id');
            $page = $request->input('page');
            $gallery = Gallery::select('id')->where('link', $id)->first();

            //연관 갤러리 추가 당한 것
            $add_link_gallerys = Link_gallery::join('gallery', 'link_gallery.gallery_id', '=', 'gallery.id')
                ->select('gallery.name as gallery_name')
                ->where('link_gallery.add_gallery_id', $gallery->id)
                ->paginate(10);
            $add_link_gallerys->withPath('?id='.$id);

            return response()->json([
                'add_link_gallerys' => $add_link_gallerys
            ]);
        }

        $id = $request->input('link');
        $gallery = Gallery::select('id')->where('link', $id)->first();

        //연관 갤러리 추가한 것
        $link_gallerys = Link_gallery::join('gallery', 'link_gallery.add_gallery_id', '=', 'gallery.id')
            ->select('gallery.name as gallery_name')
            ->where('link_gallery.gallery_id', $gallery->id)
            ->get();

        //연관 갤러리 추가 당한 것
        $add_link_gallerys = Link_gallery::join('gallery', 'link_gallery.gallery_id', '=', 'gallery.id')
            ->select('gallery.name as gallery_name')
            ->where('link_gallery.add_gallery_id', $gallery->id)
            ->paginate(10);
        $add_link_gallerys->withPath('?id='.$id);

        return response()->json([
            'link_gallerys' => $link_gallerys,
            'add_link_gallerys' => $add_link_gallerys
        ]);
    }


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
            $categorys = Category::join('gallery', 'category.id', '=', 'gallery.category_id')
                ->groupby('gallery.category_id')
                ->selectRaw('category.name as category_name, category.id as category_id, count(*) as total')
                ->orderby('total', 'desc')
                ->get();

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
            $categorys = Category::join('gallery', 'category.id', '=', 'gallery.category_id')
                ->groupby('gallery.category_id')
                ->selectRaw('category.name as category_name, category.id as category_id, count(*) as total')
                ->where('category.name', $categoryName)
                ->orderby('total', 'desc')
                ->get();

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
            $categorys = Category::join('gallery', 'category.id', '=', 'gallery.category_id')
                ->groupby('gallery.category_id')
                ->selectRaw('category.name as category_name, category.id as category_id, count(*) as total')
                ->where('category.name', $categoryName)
                ->orWhere('category.name', $categoryName2)
                ->orderby('total', 'desc')
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

            $categorys = Category::join('gallery', 'category.id', '=', 'gallery.category_id')
                ->groupby('gallery.category_id')
                ->selectRaw('category.name as category_name, category.id as category_id, count(*) as total')
                ->where('category.name', $categoryName)
                ->orWhere('category.name', $categoryName2)
                ->orWhere('category.name', $categoryName3)
                ->orderby('total', 'desc')
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

    public function m_gallery_index($id)
    {
        $category = Category::select('id', 'name')->where('id', $id)->first();
        $gallerys = Gallery::select('link', 'name')->where('category_id', $id)->paginate(40);
        $gallerys->withPath('?id='.$id);
        return view('gallery-plus-m', ['gallerys' => $gallerys, 'category' => $category]);
    }

    public function gallery_search($name)
    {
        $gallerys = Gallery::select('id', 'name')->where('name', 'like', '%'.$name.'%')->get();
        return response()->json([
            'gallerys'=>$gallerys,
        ]);
    }
}
