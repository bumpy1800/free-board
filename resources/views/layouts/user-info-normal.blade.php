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
						<a href="{{ route('user-info.show', Auth::user()->id) }}"><b>개인 정보 변경</b></a>
					</div>
					<div class="col-3 boxline">
						<a href="{{ url('user-info-changePw') }}"><b>비밀번호 변경</b></a>
					</div>
					<div class="col-3 boxline">
						<a href="{{ url('user-info-security') }}"><b>보안 센터</b></a>
					</div>
					<div class="col-3 boxline">
						<a href="{{ url('user-info-leave') }}"><b>회원 탈퇴</b></a>
					</div>
				</div>
			</div>
			<h6 class="title"><b>기본 정보 변경</b></h6>
			<hr class="line mgB0">
			<div class="user_select">
				<div class="right">
					<div class="boxline normal">
						<div class="form-group">
							<div class="label">아이디</div>
							<div class="normal-form">
								<input type="text" value="{{ $user->uid }}" disabled>
							</div>
						</div>
						<div class="form-group">
							<div class="label">닉네임</div>
							<div class="normal-form">
								<input type="text" value="{{ $user->nick }}">
							</div>
						</div>
						<div class="form-group">
							<div class="label"></div>
							<div class="normal-form">
								<small>2~20자 닉네임을 입력해 주세요.(띄어쓰기는 할 수 없습니다.)</small>
							</div>
						</div>
						<div class="form-group">
							<div class="label">이름</div>
							<div class="normal-form">
								<input type="text" value="{{ $user->name }}" disabled>
							</div>
						</div>
						<div class="form-group">
							<div class="label">가입 인증 이메일</div>
							<div class="normal-form">
								<input id="email" type="text" value="{{ $user->email }}" disabled>
								<button id="change-email"><b>인증 이메일 변경</b></button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="button">
				<button type="submit" class="btn next-btn">확인</button>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		@yield('footer')
  </body>
</html>
