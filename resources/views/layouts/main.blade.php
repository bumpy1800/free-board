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
		@yield('header')
		
	<body>
		<div class="container">
			<div class="mainLeft">
				<div class="hit">
					<a href="{{ route('gallery-hit.index') }}"><h6 class="title "><b>HIT 갤러리</b></h6></a>
					<hr class="line">
					<div class="gallery-card-container">
						@foreach($hitPosts as $hitPost)
						<div class="gallery-card-box">
							<div class="gallery-card-img-box">
								@if($hitPost->post_thumbnail == '' || $hitPost->post_thumbnail == null)
								  		<img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="gallery-card-img" alt="...">
								@else
								<img src="{{ $hitPost->post_thumbnail }}" alt="..." class="gallery-card-img">
								@endif
							</div>
							<div class="gallery-card-info">
								<div class="gallery-card-info-title"><a href="{{ route('gallery-hit.show', $hitPost->post_id) }}">{{ $hitPost->post_title }}</a></div>
								<div class="gallery-card-info-gallery"><a href="{{ route('gallery.show', $hitPost->gallery_link) }}">{{ $hitPost->gallery_name }}</a></div>
								<div class="gallery-card-info-etc">
									<span class="comment"><b>댓글</b> {{ $hitPost->post_comments }}개</span>
									<span class="recomand"><b>추천</b> {{ $hitPost->post_good }}건</span>
								</div>
							</div>
						</div>
						@endforeach
					</div>
				</div>

				<div class="newPost">
					<h6 class="title "><b>최신글</b></h6>
					<hr class="line">
					<div class="gallery-card-container">
						@foreach($imgPosts as $imgPost)
						<div class="gallery-card-box">
							<div class="gallery-card-img-box">
								<img src="{{ $imgPost->thumbnail }}" alt="..." class="gallery-card-img">
							</div>
							<div class="gallery-card-info new">
								<div class="gallery-card-info-gallery new lc1"><a href="{{ route('gallery.show', $imgPost->gallery_link)}}"><b>[{{ $imgPost->gallery_s_name }}]</b></a></div>
								<div class="gallery-card-info-title new"><a href="{{ url('gallery-post/'.$imgPost->gallery_link.'/'.$imgPost->post_id) }}">{{ $imgPost->post_title }}</a></div>
							</div>
						</div>
						@endforeach
					</div>

					<hr class="dot-line">

					<div class="newPost-more">
						<div class="row">
							@php
								$i = 0;
								$posts_cnt = count($posts);
							@endphp
							@forEach($posts as $post)
								@if($i % 5 == 0)
										<div class="col-6">
										<p>
												<b><a href="{{ route('gallery.show', $post->gallery_link) }}" class="lc1">[{{ $post->gallery_s_name }}]</a></b>
												<a href="{{ url('gallery-post/'.$post->gallery_link.'/'.$post->post_id) }}">{{ $post->post_title }}</a>
										</p>
								@else
										<p>
												<b><a href="{{ route('gallery.show', $post->gallery_link) }}" class="lc1">[{{ $post->gallery_s_name }}]</a></b>
												<a href="{{ url('gallery-post/'.$post->gallery_link.'/'.$post->post_id) }}">{{ $post->post_title }}</a>
										</p>
								@endif

								@if($i % 5 == 4)
										</div>
								@else
										@if($i == $posts_cnt-1)
												</div>
										@endif
								@endif

								@php
										$i ++;
								@endphp
							@endforEach
						</div>
					</div>
				</div>
			</div>


			<div class="mainRight">
				<div class="boxline login">
					@if(!Auth::check())
						<form action="{{ url('auth/login') }}" method="post">
							@method('POST')
		  				  	@csrf
							<div class="row">
								<div class="col-8">
									<div class="input_box">
										<input name="user_id" class="input-id" placeholder="아이디" type="text" value="{{ Cookie::get('save_id') }}">
									</div>
									<div class="input_box">
										<input name="user_pw" class="input-pw" placeholder="비밀번호" type="password" value="">
									</div>
								</div>
								<div class="col-4 btn-box">
									<div class="service">
										<div>
											<input name="user_save" id="user_save" value="0" type="checkbox" hidden>
											<label style="text-align: center;" for="user_save" class="save"> ID 저장</label>
										</div>
										<div>
											<input name="user_security" id="user_security" value="0" type="checkbox" hidden>
											<label for="user_security" class="security"> 보안접속</label>
										</div>
										<div>
											<button type="submit" class="loginBtn btn"><b style="color: white;">로그인</b></button>
										</div>
									</div>
								</div>
							</div>
						</form>
						<hr class="dot-line">
						<div class="service">
							<div class="login-bottom">
									<a href="register"><b>회원가입</b></a>
									<span>|</span>
									<a href="/">아이디ㆍ비밀번호찾기</a>
									<span>|</span>
									<a href="/"><i class="fas fa-bell"></i></a>
							</div>
						</div>
					@else
						<form action="{{ url('auth/logout') }}" method="post">
							@method('POST')
							@csrf
							<div class="logout-box">
								<div class="user-box">
									<span><b>{{ Auth::user()->nick }}</b>님</span>
									<button type="submit" class="btn-logout"><b>로그아웃</b></button>
								</div>
								<span class="user-info">글 1 댓글 1 방명록 1</span>
							</div>
						</form>
						<hr class="dot-line">
						<div class="service">
							<div class="login-bottom">
									<a href="register"><b>최근방문</b></a>
									<span>|</span>
									<a href="/">MY갤로그</a>
									<span>|</span>
									<a href="{{ route('user-info.index') }}">회원정보</a>
							</div>
						</div>
					@endif
				</div>

				<div class="boxline liveRanking">
					<div>
						<h6><strong>실북갤</strong></h6>
					</div>
					<hr class="dot-line">
						<div id="lg-dropdown" class="ranking">
							@php
									$i = 1;
							@endphp
							@forEach($liveGallerys as $liveGallery)
								<div class="ranking-left">
									<h6>
										<a href="{{ url('gallery/'.$liveGallery->gallery_link) }}" class="badge badge-primary">{{ $i }}</a>
										<a href="{{ url('gallery/'.$liveGallery->gallery_link) }}">{{ $liveGallery->gallery_name }}</a>
									</h6>
								</div>
								<div class="clear"></div>
								@php
									$i ++;
								@endphp
							@endforEach
						</div>
					<div class="clear"></div>
				</div>

				<div class="ranking-more main-lg-next">
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
								@forEach($newGallerys as $newGallery)
									<li><a href="{{ route('gallery.show', $newGallery->link) }}">{{ $newGallery->name }}</a></li>
								@endforEach
							</ul>
						</div>
					<div class="clear"></div>
				</div>
			</div>

			<div class="clear"></div>

			@yield('footer')

		</div>
	</body>
</html>
