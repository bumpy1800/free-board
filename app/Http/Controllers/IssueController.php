<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Issue;

class IssueController extends Controller
{
    public function index()
    {
		return 0;
    }

    public function store(Request $request)
    {
        //trim() : 문자열의 앞뒤 공백을 없애준다.
        $keyword = trim($request->input('search-keyword'));

        if($keyword != null && $keyword != '') {
            $search_date =  date('Y-m-d');

            //키워드 배열화
            $keyword = explode(' ', $keyword);
            //DB에 저장될 키워드
            $saveKeyword = '';
            if(count($keyword) > 1) {
                $saveKeyword = $keyword[0] . ' ' . $keyword[1];
            } else {
                $saveKeyword = $keyword[0];
            }

            $issue = Issue::select('*')->where('keyword', $saveKeyword)->first();
            if($issue) {
                //키워드를 찾으면 카운트 값을 증가
                //날짜가 다르면 카운트와 날짜를 초기화
                if($issue->search_date == $search_date) {
                    Issue::where('id', $issue->id)->increment('count');
                } else {
                    Issue::where('id', $issue->id)->update([
                        'count' => 1,
                        'search_date' => $search_date
                    ]);
                }
            } else {
                //키워드를 못찾으면 DB에 값 생성
                Issue::create([
                  'keyword' => $saveKeyword,
                  'count' => 1,
                  'search_date' => $search_date,
                ]);
            }
        }
        return redirect(route('search.index'));
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
