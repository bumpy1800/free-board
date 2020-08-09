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
					<div class="col-3 boxline active">
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
			<h6 class="title"><b>비밀번호 변경</b></h6>
			<hr class="line mgB0">
			<div class="user_select">
				<div class="right">
					<div class="boxline changePw">
						<ul>
							<li class="emphasis">비밀번호는 주기적으로 변경하여 주시기 바랍니다.</li>
							<li>회원님은 비밀번호를 변경한지 <b>[0일]</b> 되었습니다.
							<li>영문, 숫자, 특수문자 조합하여 8~20자로 설정해 주시기 바랍니다. (대소문자를 조합하시면 더욱 안전합니다.)</li>
							<li>영문, 숫자 동일 및 연속 3자리 또는 특수문자 동일 3자리 사용 불가합니다. 예) 123, 111, abc, aaa, !!!</li>
							<li>아이디, 닉네임과 동일한 비밀번호는 사용할 수 없습니다.</li>
						</ul>
						<div class="changePw-bg">
							<div class="changePw-form">
								<input type="text" value="" placeholder="현재 비밀번호">
								<input type="text" value="" placeholder="새 비밀번호">
							</div>

							<div id="must" class="must"><small><b>비밀번호 필수 조건</b></small></div>
							<div class="must"><small><i class="far fa-check-circle"></i> 영문, 숫자, 특수문자 조합입니다.</small></div>
							<div class="must"><small><i class="fas fa-check-circle"></i> 8~20자입니다.</small></div>

							<div id="must" class="must"><small><b>안전 정도</b></small></div>
							<div class="clear"></div>
							<div class="safe-box">
								<span class="bar"></span>
								<span class="bar"></span>
								<span class="bar"></span>
							</div>

							<div class="changePw-form">
								<input type="text" value="" placeholder="새 비밀번호 확인">
								<div class="must"><small>비밀번호를 다시 입력해 주세요.</small></div>
								<button type="submit">확인</button>
							</div>
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
