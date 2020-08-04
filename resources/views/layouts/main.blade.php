		@yield('header')

		<div class="container">
			<div class="mainLeft">
				<div class="hit">
					<a href="{{ route('gallery-hit.index') }}"><h6 class="title "><b>HIT 갤러리</b></h6></a>
					<hr class="line">
					<div class="row">
						@foreach($hitPosts as $hitPost)
							<div class="col-3">
								<div class="card">
									@if($hitPost->post_thumbnail == '' || $hitPost->post_thumbnail == null)
								  		<img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
								  	@else
										<img src="{{ $hitPost->post_thumbnail }}" class="card-img-top" alt="...">
									@endif
									<div class="card-body">
										<p class="card-title"><a href="{{ route('gallery-hit.show', $hitPost->post_id) }}"><b>{{ $hitPost->post_title }}</b></a></p>
										<a href="{{ route('gallery.show', $hitPost->gallery_link) }}"><p class="card-gallery">{{ $hitPost->gallery_name }}</p></a>
										<p class="card-count"><b>댓글</b> {{ $hitPost->post_comments }}개 <b>추천</b> {{ $hitPost->post_good }}개</p>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>

				<div class="newPost">
					<h6 class="title "><b>최신글</b></h6>
					<hr class="line">
					<div class="row">
						@foreach($imgPosts as $imgPost)
						<div class="col-3">
							<div class="card">
							  <img src="{{ $imgPost->thumbnail }}" class="card-img-top" alt="...">
							  <div class="card-body">
								<p class="card-title">
									<a href="{{ route('gallery.show', $imgPost->gallery_link)}}"><b>[{{ $imgPost->gallery_s_name }}]</b> </a>
									<a href="{{ url('gallery-post/'.$imgPost->gallery_link.'/'.$imgPost->post_id) }}">{{ $imgPost->post_title }}</a>
								</p>
							  </div>
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
												<b><a href="{{ route('gallery.show', $post->gallery_link) }}">[{{ $post->gallery_s_name }}]</a></b>
												<a href="{{ url('gallery-post/'.$post->gallery_link.'/'.$post->post_id) }}">{{ $post->post_title }}</a>
										</p>
								@else
										<p>
												<b><a href="{{ route('gallery.show', $post->gallery_link) }}">[{{ $post->gallery_s_name }}]</a></b>
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
					<form>
						<div class="row">
							<div class="col-7">
								<div class="input_box">
									<input name="user_id" class="id form-control" type="text">
								</div>
								<div class="input_box">
									<input name="user_pw" class="pw form-control" type="password">
								</div>
							</div>
							<div class="col-5">
								<div class="service">
									<div>
										<input name="user_save" id="user_save" type="checkbox" hidden>
										<label style="text-align: center;" for="user_save" class="save"> ID 저장</label>
									</div>
									<div>
										<input name="user_security" id="user_security" type="checkbox" hidden>
										<label for="user_security" class="security"> 보안접속</label>
									</div>
									<div>
										<button type="submit" class="loginBtn btn"><b style="color: white;">로그인</b></button>
									</div>
								</div>
							</div>
						</div>
						<!-- 로그인 했을 때
							<b style="color: blue">범피</b>님
							<button style="background-color: blue; color: white;" class="btn">로그아웃</button>
							<br>
						글 1 댓글 1 방명록 1
						-->
					</form>
					<hr class="dot-line">
					<div class="service">
						<div class="row">
							<div class="col-sm-4">
								<a href="register"><b>회원가입</b></a>
							</div>
							<div class="col-sm-6">
								<a href="/">아이디/비밀번호찾기</a>
							</div>
							<div class="col-sm-2">
								<a href="/"><i class="fas fa-bell"></i></a>
							</div>
						</div>
					</div>
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
										<a href="gallery-post" class="badge badge-primary">{{ $i }}</a>
										<a href="gallery-post">{{ $liveGallery->gallery_name }}</a>
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
