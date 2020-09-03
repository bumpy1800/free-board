<!DOCTYPE html>
<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/sjinside-icon-white.png') }}"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		@yield('css')
		<script defer src="{{ asset('assets/js/search.js') }}"></script>
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
						@foreach($gallerys as $gallery)
							<li><a href="{{ url('gallery/'.$gallery->link) }}">{{ $gallery->name }}</a></li>
						@endforeach
					</ul>
					<button class="btn-more">갤러리명 더보기</button>
				</div>
				<div class="search-result-post-box">
					<div class="search-result-title">게시물 검색결과</div>
					<ul class="search-result-post">
						@foreach($posts as $post)
							<li>
								<div class="search-post-sub"><a href="#">{{ $post->post_title }}</a></div>
									<div class="search-post-content">{!! preg_replace('/<img[^>]+\>/i', '사진', $post->post_contents) !!}</div>
									<div>
										<span class="search-post-info-gal">
											<a href="{{ url('gallery/'.$post->gallery_link)}}">
												{{ $post->gallery_name }}
											</a>
										</span>
										<span class="search-post-info-writeday">{{ $post->post_reg_date }}</span>
								</div>
							</li>
						@endforeach
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
						<div class="boxline-issue-box">
							@php
								$i = 0;
							@endphp
							@foreach($todayIssues as $todayIssue)
								@if($i < 5)
									@if($i % 5 == 0)
										<div class="issue-left">
									@endif
									<a href="{{ url('search/'.$todayIssue->keyword) }}">{{ $todayIssue->keyword }}</a>
									@if($i % 5 == 4)
										</div>
									@endif
								@endif
								@if($i > 4)
									@if($i % 5 == 0)
										<div class="issue-right">
									@endif
									<a href="{{ url('search/'.$todayIssue->keyword) }}">{{ $todayIssue->keyword }}</a>
									@if($i % 5 == 4)
										</div>
									@endif
								@endif
								@php
									$i ++;
								@endphp
							@endforeach
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
						<a target="_blank" href="https://search.daum.net/search?&w=tot&DA=DIK&q=날씨">날씨</a>
						<a target="_blank" href="https://search.daum.net/search?&w=tot&DA=DIK&q=운세">운세</a>
						<a target="_blank" href="https://search.daum.net/search?&w=tot&DA=DIK&q=환율">환율</a>
					</div>
				</form>

				<div class="boxline liveRanking">
					<div>
						<h6><strong>실북갤</strong></h6>
					</div>
					<hr class="dot-line">
					<div id="lg-dropdown" class="ranking">
						@php
							$i = 0;
						@endphp
						@foreach($liveGallerys as $liveGallery)
							@if($i < 5)
								@if($i % 5 == 0)
									<div class="ranking-left">
								@endif
								<h6>
									<a href="{{ url('gallery/'.$liveGallery->gallery_id) }}" class="badge badge-primary">{{ $i+1 }}</a>
									<a href="{{ url('gallery/'.$liveGallery->gallery_id) }}">{{ $liveGallery->gallery_name }}</a>
								</h6>
								@if($i % 5 == 4)
									</div>
								@endif
							@endif

							@if($i > 4)
								@if($i % 5 == 0)
									<div class="ranking-right">
								@endif
								<h6>
									<a href="{{ url('gallery/'.$liveGallery->gallery_id) }}" class="badge badge-primary">6</a>
									<a href="{{ url('gallery/'.$liveGallery->gallery_id) }}">{{ $liveGallery->gallery_name }}</a>
								</h6>
								@if($i % 5 == 4)
									</div>
								@endif
							@endif

							@php
								$i ++;
							@endphp
						@endforeach
					</div>
				</div>

				<div class="ranking-more">
					<div id="ranking-more">
						<div class="live-pagination">
								<div id="live-pagination">
									{{ $liveGallerys->links('vendor.pagination.gallery-plus-pagination2') }}
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
		</div>
	</body>
</html>
