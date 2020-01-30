<!DOCTYPE html>
<html lang="kr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>
	<body>

		<header class="header_bg">
			<div class="login_header">
				<div class="header_logo">
					<a href="http://doerksk.dothome.co.kr"><img src="https://nstatic.dcinside.com/dc/w/images/dcin_logo2.png" alt="free-board"></a>
					<a href="http://doerksk.dothome.co.kr/login"><img src="https://nstatic.dcinside.com/dc/w/images/tit_login.png" alt="로그인"></a>
				</div>
			</div>
		</header>
		<div class="loginbox">
			<div class="login">
				<div class="input_box">
					<div class="input_login">
						<input type="text" name="user_id" id="user_id" value="" placeholder="아이디">
						<input type="password" name="user_pw" id="user_pw" value="" placeholder="비밀번호">
						<button type="submit" name="login" id="login" class="btn btn_blue">로그인</button>
					</div>
					<div class="input_check">
						<input name="user_save" id="user_save" type="checkbox" hidden>
						<label style="text-align: center;" for="user_save" class="save left"> ID 저장</label>
						<input name="user_security" id="user_security" type="checkbox" hidden>
						<label for="user_security" class="security right"> 보안접속</label>
					</div>
					<div class="help_box">
						<a href="#" class="">아이디 찾기</a>
						<a href="#" class="middle">비밀번호 찾기</a>
						<a href="#" class="sign_up">회원가입</a>
					</div>
				</div>
				<div class="ad_box">
					<img src="https://t1.daumcdn.net/b2/creative/50392/7ca769e0abf642681af8dc0c7117dea5.jpg" alt="광고">
				</div>
			</div>
		</div>
		<div class="biz">
			<span><a href="/">회사소개</a></span>
			<span class="mLine">|</span>
			<span><a href="/">인재채용</a></span>
			<span class="mLine">|</span>
			<span><a href="/">제휴안내</a></span>
			<span class="mLine">|</span>
			<span><a href="/">광고안내</a></span>
			<span class="mLine">|</span>
			<span><a href="/">이용약관</a></span>
			<span class="mLine">|</span>
			<span><a href="/"><b>개인정보처리방침</b></a></span>
			<span class="mLine">|</span>
			<span><a href="/">청소년보호정책</a></span>
			<div class="copy">
				Copyright &copy; 2020 - 2020 KSK&amp;KJS. All rights reserved.
			</div>
		</div>
		</div>
		</div>
  </body>
</html>
