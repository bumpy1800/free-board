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

		<script type="text/javascript">
			function select1() {
				var x = document.getElementById("select1");
				var y = document.getElementById("select2");
				x.setAttribute('src', '/assets/img/checkicon3.png');
				y.setAttribute('src', '/assets/img/checkicon2.png');
			}
			function select2() {
				var x = document.getElementById("select1");
				var y = document.getElementById("select2");
				y.setAttribute('src', '/assets/img/checkicon3.png');
				x.setAttribute('src', '/assets/img/checkicon2.png');
			}
		</script>
	</head>
	<body>
		@yield('header')
		<div class="container">
			<div class="joinpath">
				<div class="row">
					<div class="col-3 boxline active">
						<b>약관 동의</b>
					</div>
					<div class="col-3 boxline">
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
			<h6 class="title"><b>회원 분류 선택</b></h6>
			<hr class="line mgB0">
			<div class="user_select">
				<div class="left pdR11">
					<div class="boxline">
						<div class="select">
							<h3 class="nobr mgB0"><b>일반회원</b></h3>(만 14세 이상)
						</div>
						<div class="select-icon">
							<input type="radio" name="us" id="normal" checked hidden>
							<label for="normal">
								<img class="checkicon" id="select1" src="/assets/img/checkicon3.png" value="normal" onclick="select1()">
							</label>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="right pdL11">
					<div class="boxline">
						<div class="select">
							<h3 class="nobr"><b>어린이 회원</b></h3>(만 14세 미만)
						</div>
						<div class="select-icon">
							<input type="radio" name="us" id="child" hidden>
							<label for="child">
								<img class="checkicon" id="select2" src="/assets/img/checkicon2.png" value="child" onclick="select2()">
							</label>
						</div>
						<div class="clear"></div>
					</div>
				</div>
			</div>
			<div class="clear"></div>
			<form action="testestest" method="post">
				<h6 class="title pdT35"><b>약관 동의</b></h6>
				<hr class="line">
				<h6 class="ts-title"><b>* 서비스 이용약관</b></h6>
				<div class="boxline ts-boxline">
					<div class="ts">
						@include('ts.ts1')
					</div>
				</div>
				<div class="agree">
					<input type="checkbox" id="agree">
					<label for="agree">내용을 확인하였으며, 동의합니다.</label>
				</div>
				<div class="clear"></div>
				<hr class="ts-line">

				<h6 class="ts-title"><b>* 개인정보처리방침</b></h6>
				<div class="boxline ts-boxline">
					<div class="ts">
						@include('ts.ts2')
					</div>
				</div>
				<div class="agree">
					<input type="checkbox" id="agree2">
					<label for="agree2">내용을 확인하였으며, 동의합니다.</label>
				</div>
				<div class="clear"></div>
				<button type="submit" class="btn next-btn">다음</button>
				<div class="clear"></div>
			</form>
		</div>
		<div class="clear"></div>
		@yield('footer')
  </body>
</html>
