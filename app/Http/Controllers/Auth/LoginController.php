<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/asd';
    protected $guard = 'admin';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except(['logout', 'login']);
    }

    public function login(Request $request)
    {
        $credentials = [
            'uid' => $request->input('user_id'),
            'pwd' => $request->input('user_pw')
        ];

        $user_save = $request->input('user_save');
        $user_security = $request->input('user_security');
        //ID 저장을 위한 쿠키생성
        if($user_save == 1) {
            Cookie::queue('save_id', $request->input('user_id'), 1440);
        } else {
            //체크 해제하면 쿠키 삭제
            Cookie::queue('save_id', '');
        }

        //유저 로그인을 위한 정보 검색
        //id, pw를 비교한다
        //pw는 해시로 변경하여 서로 값을 비교 후 찾으면 true 못찾으면 false를 반환한다
        //true이면 세션을 자동으로 생성한다
        if(Auth::attempt($credentials)) {
            return redirect()->intended();
        }
        return redirect('login');
    }

    public function logout(Request $request)
    {
        //로그아웃, 세션을 삭제한다
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
    }
}
