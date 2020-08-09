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
					<div class="col-3 boxline active">
						<b>개인 정보 변경</b>
					</div>
					<div class="col-3 boxline">
						<b>비밀번호 변경</b>
					</div>
					<div class="col-3 boxline">
						<b>보안 센터</b>
					</div>
					<div class="col-3 boxline">
						<b>회원 탈퇴</b>
					</div>
				</div>
			</div>
			<h6 class="title"><b>기본 정보 변경</b></h6>
			<hr class="line mgB0">
			<div class="user_select">
				<div class="right">
					<div class="boxline">
						<h6><b>개인 정보 보호를 위해 비밀번호를 입력해주세요</b></h6>
						<div class="chk-form">
							<form action="{{ url('auth/chkUser') }}" method="post">
								@method('POST')
								@csrf
								<input name="user_pw" type="password" value="" placeholder="비밀번호">
								<button type="submit">확인</button>
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
