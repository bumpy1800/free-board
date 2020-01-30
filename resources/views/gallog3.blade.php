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
			<div class="top">
				<div class="home">
					<a href="/">디시인사이드 메인가기 ▶</a>
				</div>
				<div class="sub">
					<span><a href="/">갤러리</a></span>
					<span class="mLine">|</span>
					<span><a href="/">m.갤러리</a></span>
					<span class="mLine">|</span>
					<span><a href="/">뉴스</a></span>
					<span class="mLine">|</span>
					<span><a href="/">만두몰</a></span>
					<span class="mLine">|</span>
					<span><a href="/">이벤트</a></span>
					<span><a class="btn" href="/">로그아웃</a></span>
				</div>
				<div class="clear"></div>
				
				<div class="top-box">
					<div class="who">
						<span><b class="id">범피(wwwf001)</b> 님의 갤로그입니다.</span>
					</div>
					<div class="result">
						<div class="result-box">
							<span>Today <b>1</b></span>
							<span class="mLine">|</span>
							<span>Total <b>18218</b></span>
							<span class="mLine">|</span>
							<span><i class="far fa-calendar-alt"></i></span>
							<span class="mLine">|</span>
							<span><i class="fas fa-cog"></i></span>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="menus">
				<a href="gallog" class="btn">갤로그 홈</a>
				<a href="gallog2" class="btn">내 게시글</a>
				<a href="gallog3" class="btn active">내 댓글</a>
				<a href="gallog4" class="btn">스크랩</a>
				<a href="gallog5" class="btn">방명록</a>
			</div>
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
