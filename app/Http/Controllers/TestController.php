<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
//use App\Users1;                     //ORM

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$this->insertTable();
        return view('test');
    }

	public function insertTable(){
		/*$a = 'Users1';                     //ORM
		$a->create(['name' => 'John']);*/

		/*$b = 'users1s';                    //쿼리빌더
		DB::table($b)->insert(
			['name' => 'John']
		);*/

		/*Schema::create('users1s', function (Blueprint $table) {
            $table->string('name');
		});*/

			/*$db_host = "localhost";
			$db_user = "doerksk";
			$db_passwd = "q1w2e3r4!";
			$db_name = "doerksk";
			$a = "123as";

			// MySQL - DB 접속.
			$conn = mysqli_connect($db_host,$db_user,$db_passwd,$db_name);
			if (mysqli_connect_errno()){
			echo "MySQL 연결 오류: " . mysqli_connect_error();
			exit;
			} else {
			echo "DB : \"$db_name\"에 접속 성공.<br/>";
			}

			// table 만들기
			$sql = "CREATE TABLE $a
			(
			PID bigint(20) unsigned not null auto_increment,
			Name CHAR(255),
			Address CHAR(255),
			Age INT,
			PRIMARY KEY(PID)
			) charset=utf8";

			if (mysqli_query($conn,$sql)){
			echo "성공적으로 테이블을 만들었습니다.<br/>";
			} else {
			echo "테이블 생성 오류 : " . mysqli_error($conn);
			exit;
			}*/
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
