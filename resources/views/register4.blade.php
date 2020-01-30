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
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/register.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>
	<body>
		<header class="header_bg">
			<div class="container">
				<div class="register_header">
					<div class="header_logo">
						<a href="http://doerksk.dothome.co.kr"><img src="https://nstatic.dcinside.com/dc/w/images/dcin_logo2.png"></a>
						<a href="http://doerksk.dothome.co.kr/register"><img src="https://nstatic.dcinside.com/dc/w/images/tit_join.png"></a>
					</div>
					<div class="header_nav">
						<span>갤러리</span>
						<span class="mLine">|</span>
						<span>m.갤러리</span>
						<span class="mLine">|</span>
						<span>갤로그</span>
						<span class="mLine">|</span>
						<span>뉴스</span>
						<span class="mLine">|</span>
						<span>이벤트</span>
						<span class="mLine">|</span>
						<span>만두몰</span>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</header>
		<div class="container">
			<div class="joinpath">
				<div class="row">
					<div class="col-3 boxline">
						<b>약관 동의</b>
					</div>
					<div class="col-3 boxline">
						<b>기본 정보 입력</b>
					</div>
					<div class="col-3 boxline">
						<b>가입 인증</b>
					</div>
					<div class="col-3 boxline active">
						<b>가입 완료</b>
					</div>
				</div>
			</div>
			<h6 class="title"><b>가입 완료</b></h6>
			<hr class="line mgB0">
			<form class="email-check">
				<div class="boxline">
					<p class="point"><b>회원가입이 완료되었습니다.</b></p>
					<div class="email-box">
						<p><b>DCINSIDE 회원가입을 환영합니다</b></p>
						<p>(ID : test)</p>
						<p>(닉네임 : test)</p>
						<p>(이름 : 김선규)</p>
						<p>(가입일 : 2020.01.26 08:06)</p>
						<p>(이메일 : qwe123@gmail.com)</p>
						<p><a href="http://doerksk2.dothome.co.kr" class="btn email-check-btn">홈으로 이동</a></p>
					</div>
				</div>
			</form>
		</div>
				
		<hr class="line borST1">
		<div class="container">
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
  </body>
</html>
