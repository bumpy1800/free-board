<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Visitor;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $visitorIp = $this->getUserIpAddr();
        $visitorArr = $request->session()->get('visitor');
        if($visitorArr == null) {
          $visitorArr = [];
        }
        if (in_array($visitorIp, $visitorArr)) {
          return view('main');
        } else {
          $request->session()->push('visitor', $visitorIp);
          return view('main');
        }
    }

    public function visitor_save(Request $request)
    {
      date_default_timezone_set('Asia/Seoul');
      $visitorIp = $this->getUserIpAddr();
      $visitorTime = date('Y-m-d H:i:s');
      $visitorReferrer = $request->input('referrer');
      $visitorBrowser = $request->input('browser');

      $visied_cookie = Cookie::get('visited');
      if(!$visied_cookie) {
        Visitor::create([
            'ip' => $visitorIp,
            'time' => $visitorTime,
            'refer' => $visitorReferrer,
            'agent' => $visitorBrowser
        ]);
        Cookie::queue('visited', true, 60);
      }
      return response('ok');
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
