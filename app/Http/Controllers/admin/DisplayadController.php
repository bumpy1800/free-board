<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

use File;
use App\Displayad;

class DisplayadController extends Controller
{
    public function index()
    {
        $displayads = Displayad::orderby('date', 'desc')->get();
        return view('admin.display-ad-list', ['displayads' => $displayads]);
    }

     public function create()
     {
         return view('display-ad-contact');
     }

    public function show($id)
    {
        $displayad = Displayad::findOrFail($id);
        $image = Storage::get($displayad->image); //이미지 가져와서 text 변환
        $image = base64_encode($image); //base64로 인코딩

        return view('admin.display-ad-show', ['displayad' => $displayad], ['image' => $image]);
    }

    public function edit($id)
    {
        return view('admin.post-edit-form');
    }

    public function update(Request $request, $id)
    {
        return redirect(route('admin_post.index'));
    }
}
