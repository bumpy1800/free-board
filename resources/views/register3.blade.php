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
					<div class="col-3 boxline active">
						<b>가입 인증</b>
					</div>
					<div class="col-3 boxline">
						<b>가입 완료</b>
					</div>
				</div>
			</div>
			<h6 class="title"><b>가입 확인을 위한 이메일 인증</b></h6>
			<hr class="line mgB0">
			<form class="email-check">
				<div class="boxline">
					<p class="point"><b>- 입력하신 메일 주소로 발송된 인증 메일을 확인하여 주시기 바랍니다.</b></p>
					<p>- 발송된 인증 메일은 개인 정보 보호를 위해 3시간 안에 확인해주셔야만 정상적으로 가입이 완료됩니다.</p>
					<p>- 인증 메일을 받지 못하신 경우 인증 메일 재발송을 통해 다시 한번 확인하여 주시기 바랍니다. <a href="">인증 메일 재발송</a></p>
					<p>- 이메일을 잘못 입력하셨다면 회원 가입을 처음부터 다시 진행해 주시기 바랍니다. <a href="">회원가입 다시하기</a></p>
					<div class="email-box">
						<p><b>발송된 인증 메일을 확인해 주세요</b></p>
						<p>(인증 유효 시간 : 2020.01.26 08:06 까지)</p>
						<p class="useremail"><b>qwe123@gmail.com</b></p>
						<p><button class="btn email-check-btn">인증 메일 확인하기</button></p>
					</div>
					<p>- 메일 제공 업체의 정책에 따라 발송된 메일이 스팸으로 분류될 수도 있으니 관련 메일함도 확인하여 주시기 바랍니다.</p>

					<p>- 메일에 따라 메일 수신이 일정 시간 지연될 수 있습니다.</p>
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
