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
					<div class="col-3 boxline">
						<a href="{{ url('user-info-security') }}"><b>보안 센터</b></a>
					</div>
					<div class="col-3 boxline active">
						<a href="{{ url('user-info-leave') }}"><b>회원 탈퇴</b></a>
					</div>
				</div>
			</div>
			<h6 class="title"><b>회원 탈퇴</b></h6>
			<hr class="line mgB0">
			<div class="user_select">
				<div class="right">
					<div class="boxline changePw">
						<ul>
							<li class="emphasis">SJ인사이드 회원 탈퇴를 하시면, 아이디와 개인 정보는 즉시 삭제되고 복구가 불가능합니다.</li>
							<li class="emphasis">회원 탈퇴 시 회원 아이디로 작성된 게시물과 댓글은 자동으로 삭제되지 않습니다.</li>
							<li>탈퇴 처리된 아이디는 재사용이 불가능합니다.</li>
							<li>회원 탈퇴 후 7일 이내에는 인증받은 동일 이메일로는 회원 가입이 제한됩니다.</li>
						</ul>
						<div class="changePw-bg leave-bg">
							<div class="user-info">
								<span class="user">아이디</span>
								<span class="info"><b>{{ Auth::user()->uid }}({{ Auth::user()->name }})</b></span>
							</div>
							<div class="user-info">
								<span class="user">닉네임</span>
								<span class="info"><b>{{ Auth::user()->nick }}</b></span>
							</div>
							<div class="user-info">
								<span class="user">이메일</span>
								<span class="info"><b>{{ Auth::user()->email }}</b></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<div class="button">
				<button id="cancel" class="btn next-btn">취소</button>
				<button id="leave" class="btn next-btn">탈퇴</button>
			</div>
		</div>
		<div class="clear"></div>
		@yield('footer')
  </body>
</html>
