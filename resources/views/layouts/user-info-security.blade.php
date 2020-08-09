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
		<link href="{{ asset('assets/css/user-info.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>
	<body>
		@yield('header')
		<div class="container">
			<div class="joinpath">
				<div class="row">
					<div class="col-3 boxline">
						<a href="{{ route('user-info.show', Auth::user()->id) }}"><b>개인 정보 변경</b></a>
					</div>
					<div class="col-3 boxline">
						<a href="{{ url('user-info-changePw') }}"><b>비밀번호 변경</b></a>
					</div>
					<div class="col-3 boxline active">
						<a href="{{ url('user-info-security') }}"><b>보안 센터</b></a>
					</div>
					<div class="col-3 boxline">
						<a href="{{ url('user-info-leave') }}"><b>회원 탈퇴</b></a>
					</div>
				</div>
			</div>
			<h6 class="title"><b>보안 센터</b></h6>
			<hr class="line mgB0">
			<h6 id="sub-title"><b>새로운 기기 로그인 알림</b></h6>
			<div class="user_select" id="user_select-security">
				<div class="right">
					<div class="boxline security">
						<div class="info">사용한 적이 없는 PC나 모바일 기기, 브라우저에서 로그인할 경우 회원정보에 등록된 이메일로 알려드립니다.</div>
						<div class="chk-form">
							<form action="{{ url('auth/chkUser') }}" method="post">
								@method('POST')
								@csrf
								로그인 알람 받기<i class="fas fa-toggle-off"></i>
								<button type="submit">알람 켜기</button>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		@yield('footer')
  </body>
</html>
