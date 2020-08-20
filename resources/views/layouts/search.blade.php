<!DOCTYPE html>
<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/sjinside-icon-white.png') }}"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		@yield('css')
		<script defer src="{{ asset('assets/js/popup.js') }}"></script>
	</head>

	<body>
		@yield('header')
		<div class="container search">
			<div class="search-left">
				<div class="search-left-ad-box top">
					<div class="search-left-ad-text-lg">구매에서 설치까지 한번에 안전드림</div>
					<div class="search-left-ad-text-sm">교통, 주차, 건설, 아파트, 안전용품 판매 및 완벽 시공, 무료견적 환영</div>
					<div class="search-left-ad-text-link">www.nicenicenice.com</div>
				</div>
				<div class="search-left-ad-box">
					<div class="search-left-ad-text-lg">쇼핑의 모든 것, 롯태ON</div>
					<div class="search-left-ad-text-sm">교통, 주차, 건설, 아파트, 안전용품 판매 및 완벽 시공, 무료견적 환영</div>
					<div class="search-left-ad-text-link">www.nicenicenice.com</div>
				</div>
			</div>

			<div class="search-center">
				<div class="search-result-gallery-box">
					<div class="search-result-title">갤러리명 검색결과</div>
					<ul class="search-result-gallery">
						<li><a href="#">갤리리명 검색결과1</a></li>
						<li><a href="#">갤리리명 검색결과2</a></li>
						<li><a href="#">갤리리명 검색결과3</a></li>
					</ul>
					<button class="btn-more">갤러리명 더보기</button>
				</div>
				<div class="search-result-post-box">
					<div class="search-result-title">게시물 검색결과</div>
					<ul class="search-result-post">
						<li>
							<div class="search-post-sub"><a href="#">게시물 검색결과1</a></div>
								<div class="search-post-content">게시물 검색결과1 내용</div>
								<div>
									<span class="search-post-info-gal">게임</span>
									<span class="search-post-info-writeday">2020.08.20 17:50</span>
							</div>
						</li>
						<li>
							<div class="search-post-sub"><a href="#">게시물 검색결과1</a></div>
								<div class="search-post-content">게시물 검색결과1 내용</div>
								<div>
									<span class="search-post-info-gal">게임</span>
									<span class="search-post-info-writeday">2020.08.20 17:50</span>
							</div>
						</li>
						<li>
							<div class="search-post-sub"><a href="#">게시물 검색결과1</a></div>
								<div class="search-post-content">게시물 검색결과1 내용</div>
								<div>
									<span class="search-post-info-gal">게임</span>
									<span class="search-post-info-writeday">2020.08.20 17:50</span>
							</div>
						</li>
					</ul>
					<button class="btn-more">게시물 더보기</button>
				</div>
			</div>

			<div class="search-right">
				<div class="boxline boxline-issue">
					<div>
						<h6><strong>오늘의 이슈</strong></h6>
					</div>
					<hr class="dot-line">
						<div id="lg-dropdown" class="boxline-issue-box">
							<div class="issue-left">
								<a href="#">이슈1</a>
								<a href="#">이슈2</a>
								<a href="#">이슈3</a>
								<a href="#">이슈4</a>
								<a href="#">이슈5</a>
							</div>
							<div class="issue-right">
								<a href="#">이슈6</a>
								<a href="#">이슈7</a>
								<a href="#">이슈8</a>
								<a href="#">이슈9</a>
								<a href="#">이슈10</a>
							</div>
						</div>
				</div>

				<form class="boxline daum-search">
					<div class="daum-search-bar">
						<div class="daum-search-bar-input-box">
							<input type="text" />
							<i class="fas fa-search"></i>
						</div>
						<button class="btn-daum-search">다음 검색</button>
					</div>
					<div class="daum-search-menu">
						<a href="#">날씨</a>
						<a href="#">운세</a>
						<a href="#">환율</a>
					</div>
				</form>

				<div class="boxline liveRanking">
					<div>
						<h6><strong>실북갤</strong></h6>
					</div>
					<hr class="dot-line">
						<div id="lg-dropdown" class="ranking">
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">1</a>
									<a href="#">갤러리 왼쪽</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									<a href="#" class="badge badge-primary">6</a>
									<a href="#">갤러리 오른쪽</a>
								</h6>
							</div>
						</div>
				</div>

				<div class="ranking-more main-lg-next">
					<div id="ranking-more">
						<div class="live-pagination">
								<div id="live-pagination">
									페이지네이션
								</div>
								<div class="clear"></div>
						</div>
					</div>
				</div>

				<div class="boxline newGallery">
					<div>
						<h6><strong>신설갤</strong></h6>
					</div>
					<hr class="dot-line">
						<div class="list">
							<ul>
								<li><a href="#">이름</a></li>
							</ul>
						</div>
					<div class="clear"></div>
				</div>

				<div class="boxline boxline-hit">
					<div class="boxline-hit-top">
						<h6><strong>힛(HIT)</strong></h6>
						<div class="hit-btn-box">
							<span>1/3</span>
							<button class="btn-hit-left">◀</button>
							<button class="btn-hit-right">▶</button>
						</div>
					</div>
					<hr class="dot-line">
					<a href="#" class="boxline-hit-main">
						<img src="{{ asset('assets/img/iu.jpg') }}"/>
						<div class="boxline-hit-main-title">인생이 나이스입니다.</div>
						<div class="boxline-hit-main-writeday">작성일 2020-08-18</div>
					</a>
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="container searchft">
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
					Copyright &copy; 2020 - 2020 KSK&amp;KJS&amp;PCY. All rights reserved.
        	</div>
		</div>
	</body>
</html>
