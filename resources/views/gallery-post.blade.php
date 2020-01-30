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
		<link href="{{ asset('assets/css/my.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallery.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<body>
		<div class="container">
			<div class="etc">
				<a class="mb_menu" href="login">회원가입</a>
				<a class="mb_menu" href="/">로그인</a>
			</div>

			<div class="mainHead">
				<div class="logo">
					<a href="http://doerksk.dothome.co.kr"><img src="/assets/img/test.gif"></a>
				</div>
				<div class="searchBundle">
					<div class="todayIsue">
						<p><b>오늘의 이슈</b> | 테스트 | 테스트2 | 테스트3</p>
					</div>
					<div class="searchBar">
						<form>
							<div class="form-row">
								<div class="col-11">
									<input type="text" class="search form-control" placeholder="갤러리 & 통합검색">
								</div>
								<div class="col-1">
									 <button class="searchBtn btn" type="submit"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								갤러리+
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">m.갤러리</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">갤로그</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">신고센터</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Q&A</a>
						</li>
					<!--<li class="nav-item">
					<a class="nav-link" href="{{route('test.index')}}" tabindex="-1" aria-disabled="true">Disabled</a>
					</li>-->
					</ul>
					<span class="yesterday">
						어제 <B class="number">201,320,135개</B> 게시글 등록
					</span>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="gallery">
				<div class="gallery-top">
					<h4 class="title"><b>대출갤러리</b></h4>
					<div class="sub">
						<span><a href="">연관 갤러리(0/5)</a></span>
						<span class="mLine">|</span>
						<span><a href="">갤주소 복사</a></span>
						<span class="mLine">|</span>
						<span><a href="">차단설정</a></span>
						<span class="mLine">|</span>
						<span><a href="">갤러리 이용안내</a></span>
					</div>
				</div>
				<div class="clear"></div>
				<hr class="line">
			</div>

			
			<div class="clear"></div>

			<div class="mainFoot">
				<table class="table">
					<thead class="notice">
						<tr>
						<th scope="col" class="fir">공지사항</th>
						<th scope="col"></th>
						<th scope="col" class="las"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="LRline">
							<th class="pdB6 Rline" scope="row"><a href=""><b>갤러리</b></a></th>
							<th class="pdB6 Rline" scope="row"><a href=""><b>인기갤러리</b></a></th>
							<th class="pdB6 Rline" scope="row"><a href=""><b>주요서비스</b></a></th>
						</tr>
						<tr class="LRline">
							<td class="pdT0 pdB6 Rline"><a href="">HIT 갤러리</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">국내야구</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">갤로그</a></td>
						</tr>
						<tr class="LRline">
							<td class="pdT0 pdB6 Rline"><a href="">초개념 갤러리</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">편의점</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">디시위키</a></td>
						</tr>
						<tr class="LRline endline">
							<td class="pdT0 pdB6 Rline"><a href="">이슈줌 갤러리</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">리그 오브 레전드</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">이벤트</a></td>
						</tr>
					</tbody>
				</table>
				<div class="ad">
					<span class="ad-info"><a href="/"><b>광고 안내</b></a></span>
					<span class="ad-display"><a href="/">디스플레이광고</a></span>
					<span class="mLine">|</span>
					<span class="ad-promotion"><a href="/">프로모션</a></span>
					<span class="mLine">|</span>
					<span class="ad-question"><a href="/">광고문의</a></span>
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
		</div>
	</body>
</html>
