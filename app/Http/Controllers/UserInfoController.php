<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

    public function sendEmail(Request $request) {
         try {
             $id = Auth::user()->id;
             $email = '';
             if($request->input('email')) {
                 $email = $request->input('email');
             } else {
                 $email = Auth::user()->email;
             }

             $email = array(
                 'email' => $email,
             );
             $code = array(
                 'code' => $this->getCode(6),
             );
             //이메일 전송
        	 Mail::send('vendor.email.change_email', $code, function($message) use ($email) {
        		 $message->from('doerksk@daum.net', 'SJInside');
        		 $message->to($email['email'])->subject('[SJ인사이드] 이메일 주소 인증을 완료해 주세요.');
        	 });

             User::where('id', $id)->update([
               'chk_email' => $code['code'],
             ]);

             return response()->json([
                 'status' => 1
             ]);
         } catch(Exception $e) {
             report($e);
             return response()->json([
                 'status' => 0
             ]);
         }
    }

    public function getCode($length) {
       $characters  = "0123456789";
       $characters .= "abcdefghijklmnopqrstuvwxyz";
       $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
       $characters .= "_";

       $string_generated = "";

       $nmr_loops = $length;
       while ($nmr_loops--)
       {
           $string_generated .= $characters[mt_rand(0, strlen($characters) - 1)];
       }
       return $string_generated;
    }

    public function checkCode(Request $request) {
       $id = Auth::user()->id;
       $code = $request->input('code');
       $last = $request->input('last');
       if($last != '') {
           $email = $request->input('email');
           User::where('id', $id)->update([
             'email' => $email,
           ]);
           return response()->json([
               'last' => 1
           ]);
       }
       $user = User::select('id', 'chk_email')->where('id', $id)->first();
       if($user->id) {
           if($user->chk_email == $code) {
               return response()->json([
                   'status' => 1
               ]);
           }
           else {
               return response()->json([
                   'status' => 0
               ]);
           }
       }
       return response()->json([
           'status' => 0
       ]);
    }
}
