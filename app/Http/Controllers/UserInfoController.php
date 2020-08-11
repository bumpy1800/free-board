<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\User;                     //ORM


class UserInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //비밀번호 인증 페이지
        return view('user-info-chk');
    }

    public function show($id)
    {
        if($id == Auth::user()->id) {
            return view('user-info-normal', ['user' => User::findOrFail($id)]);
        }
        return view('user-info-chk');
    }

    public function edit($id)
    {
        return view('admin.user-edit-form', ['User' => User::findOrFail($id)]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect('admin/user-list');
    }

    public function showChangePw() {
        return view('user-info-changePw');
    }
    public function showSecurity() {
        return view('user-info-security');
    }
    public function showLeave() {
        return view('user-info-leave');
    }
}
