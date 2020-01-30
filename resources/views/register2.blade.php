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
					<div class="col-3 boxline active">
						<b>기본 정보 입력</b>
					</div>
					<div class="col-3 boxline">
						<b>가입 인증</b>
					</div>
					<div class="col-3 boxline">
						<b>가입 완료</b>
					</div>
				</div>
			</div>
			<h6 class="title"><b>기본 정보 입력</b></h6>
			<hr class="line mgB0">
			<form class="confirm">
				<div class="boxline">
					<div class="row">
						<div class="col-3">
							<b>아이디 입력</b>
						</div>
						<div class="col-9">
							<input name="asd" class="form-control" type="text" placeholder="사용할 아이디를 입력해 주세요">
							<div class="sub">
								5~20자 영문, 숫자로 입력해 주세요
							</div>
						</div>
						<div class="col-3">
							<b>닉네임 만들기</b>
						</div>
						<div class="col-9">
							<input name="asd" class="form-control" type="text" placeholder="사용할 닉네임을 입력해 주세요">
							<div class="sub">
								2~20자 닉네임을 입력해주세요.(띄어쓰기는 할 수 없습니다.)
							</div>
						</div>
						<div class="col-3">
							<b>비밀번호 입력</b>
						</div>
						<div class="col-9">
							<input name="asd" class="pw form-control" type="text" placeholder="사용할 비밀번호를 입력해 주세요">
							<input name="asd" class="repw form-control" type="text" placeholder="사용할 비밀번호를 재확인해 주세요">
							<div class="sub">
								영문, 숫자 조합 6-20자
							</div>
						</div>
						<div class="col-3">
							<b>이름</b>
						</div>
						<div class="col-9">
							<input name="asd" class="form-control" type="text" placeholder="이름을 입력해 주세요">
							<div class="sub">
								ID/PW 분실 시 가입 정보를 통해 찾을 수 있으므로 정확히 입력해 주시기 바랍니다.
							</div>
						</div>
						<div class="col-3">
							<b>가입 인증 이메일</b>
						</div>
						<div class="col-9 email">
							<div style="float: left" class="front">
								<input name="asd" class="form-control" type="text">
							</div>
							<div style="float: left" class="at">@</div>
							<div style="float: left" class="back">
								<input name="asd" class="form-control" type="text">
							</div>
							<div style="float: right" class="auto">
								<select class="form-control">
								  <option>이메일 선택</option>
								  <option>gmail.com</option>
								  <option>hanmail.net</option>
								  <option>daum.net</option>
								  <option>hotmail.com</option>
								  <option>naver.com</option>
								  <option>korea.com</option>
								  <option>yahoo.com</option>
								  <option>직접입력</option>
								</select>
								<input name="asd" class="form-control" type="text" value="여기에 이메일값" hidden>
							</div>
							<div class="clear"></div>
							<div class="sub">
								사용할 이메일을 입력해 주세요
							</div>
						</div>
					</div>
				</div>
			</form>
			<button type="submit" class="btn next-btn">다음</button>	
			<div class="clear"></div>
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
