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
		<link href="{{ asset('assets/css/gallog.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<body>

		<div class="container">
			@yield('header')
			<div class="middle">
				<div class="mycomment">
					<span class="title"><b>- 내 댓글</b>(0)</span>
					<span class="all"><button class="btn">전체보기</button></span>
					<div class="clear"></div>
					<hr class="line">
					<div class="have">
						<div class="row">
							<div class="user-title col-4">
								<p><b>제목</b></p>
							</div>
							<div class="user-content col-5">
								<p>댓글내용</p>
							</div>
							<div class="user-writeday col-3">
								<p>
									<b>갤러리이름</b>
									<button class="btn">삭제</button>
								</p>
								<p>2020.01.27 16:50:42</p>
							</div>
							<div class="user-title col-4">
								<p><b>제목</b></p>
							</div>
							<div class="user-content col-5">
								<p>댓글내용</p>
							</div>
							<div class="user-writeday col-3">
								<p>
									<b>갤러리이름</b>
									<button class="btn">삭제</button>
								</p>
								<p>2020.01.27 16:50:42</p>
							</div>
							<div class="user-title col-4">
								<p><b>제목</b></p>
							</div>
							<div class="user-content col-5">
								<p>댓글내용</p>
							</div>
							<div class="user-writeday col-3">
								<p>
									<b>갤러리이름</b>
									<button class="btn">삭제</button>
								</p>
								<p>2020.01.27 16:50:42</p>
							</div>
						</div>
					</div>
					<!--<div class="none">
						<b>등록된 댓글이 없습니다.</b>
					</div>-->
					<hr class="hr1">
				</div>
			</div>

			@yield('footer')
		</div>
	</body>
</html>
