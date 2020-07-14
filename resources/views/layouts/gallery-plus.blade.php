<!DOCTYPE html>


<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
		<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<script src="{{ asset('assets/js/gallery-plus.js') }}"></script>

		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallery-plus.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<body>

		@yield('header')

		<div class="container">
			<div class="mainLeft">
				<div class="newPost">
					<h6 class="title "><b>최신글</b></h6>
					<hr class="line">
					<div class="row">
							@forEach($imgPosts as $imgPost)
									<div class="col-4">
											<div class="card">
													<img src="{{ $imgPost->thumbnail }}" class="card-img-top" alt="...">
													<div class="card-body">
															<p class="card-title"><b><a href="{{ route('gallery.show', $imgPost->gallery_link) }}">[{{ $imgPost->gallery_s_name }}]</a></b> <a href="">{{ $imgPost->post_title }}</a></p>
													</div>
											</div>
									</div>
							@endforEach
					</div>
					<hr class="dot-line">
					<div class="newPost-more">
						<div class="row">
								@php
										$i = 0;
								@endphp
								@forEach($posts as $post)
										@if($i % 7 == 0)
												<div class="col-6">
												<p><b><a href="{{ route('gallery.show', $post->gallery_link) }}">[{{ $post->gallery_s_name }}]</a></b> <a href="">{{ $post->post_title }}</a></p>
										@else
												<p><b><a href="{{ route('gallery.show', $post->gallery_link) }}">[{{ $post->gallery_s_name }}]</a></b> <a href="">{{ $post->post_title }}</a></p>
										@endif
										@if($i % 7 == 6)
												</div>
										@endif

										@php
												$i ++;
										@endphp
								@endforEach
						</div>
					</div>
				</div>
				<div class="recently-visit">
					<div class="fir">
						<b>최근 방문 갤러리</b>
					</div>
					<div class="visitlist">
						<div class="row" id="visitlist">
								@for($i = count($recentGallerys)-1; $i >= 0; $i--)
										@if($j = $recentGallerys[$i]) {{-- 값 유무 확인 --}}
												@if($i != 0)
														<div class="col">
															<span>{{ $recentGallerys[$i] }}</span>
															<button id="{{ $i }}" class="delete">X</button>
														</div>
														<div class="clear"></div>
												@else
														<div class="col m-hide">
															<span>{{ $recentGallerys[$i] }}</span>
															<button id="{{ $i }}" class="delete">X</button>
														</div>
														<div class="clear"></div>
												@endif
										@endif
								@endfor
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="week-gallery">
					<div class="left">
						<div class="top">
							<h6 class="nobr"><b><color>HOT </color>주간 흥한 갤러리</b></h6>
							<span><button class="btn allrank">전체순위</button></span>
							<div class="clear"></div>
						</div>
						<div class="gallery-list">
							<div class="row">
									@php
											$i = 1;
									@endphp
									@forEach($weekGallerys as $weekGallery)
											<div class="col-3">
												<a href="gallery-post" class="badge badge-danger">{{ $i }}</a>
												<a href="{{ route('gallery.show', $weekGallery->gallery_link) }}">{{ $weekGallery->gallery_name }}</a>
											</div>
											@php
													$i ++;
											@endphp
									@endforEach
							</div>
						</div>
					</div>
					<div class="right">
						<div class="mgL14">
							<div class="boxline">
								<div class="top">
										<h6 class="nobr"><b>공지사항/신고</b><color></color></h6>
										<a class="nav-link" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<span class="badge badge-mycolor">▼</span>
										</a>
										<div class="dropdown-menu" aria-labelledby="navbarDropdown">
												@forEach($categorys as $category)
														<a class="dropdown-item" href="gallery">{{ $category->name }}</a>
												@endforEach
										</div>
										<div class="clear"></div>
								</div>
								<div class="edu-list">
									<div class="li"><a href="">게시물 신고</a></div>
									<div class="li"><a href="">공지사항</a></div>
								</div>
								<div class="top borST1">
									<h6 class="nobr"><b>신설 갤러리</b><color> ({{ count($newGallerys) }})</color></h6>
								</div>
								<div style="height: 106px; overflow: auto;" class="ng-list">
										@forEach($newGallerys as $newGallery)
												<div class="li"><a href="{{ route('gallery.show', $newGallery->link) }}">{{ $newGallery->name }}</a></div>
										@endforEach
								</div>
							</div>
						</div>

					</div>
					<div class="clear"></div>
				</div>
			</div>

			<div class="mainRight">
				<div class="boxline login">
					<div class="nologin">
						<b>로그인을 해 주시기 바랍니다.</b>
					</div>
					<div class="nologin-service">
						<div class="row">
							<div class="col-4">
								<a href=""><b>갤로그</b></a>
							</div>
							<div class="col-4">
								<a href=""><b>즐겨찾기</b></a>
							</div>
							<div class="col-4">
								<a href=""><i class="fas fa-bell"></i><b> 알림</b></a>
							</div>
						</div>
					</div>
				</div>
				<div class="ad">
					<img src="data:image/png;base64,{{ $image }}">
				</div>
			</div>
			<div class="clear"></div>


			<div class="cg-top">
				<div class="cg-all">
					<span class="btn"><b>갤러리 전체목록</b></span>
					<b><color><i class="fas fa-check"></i> 인기순</color></b>
				</div>
				<div class="cg-live">
					<span class="btn"><b>실시간 북적 갤러리</b></span>
					<span class="badge badge-cg-live"><b>1</b></span>

					<a class="nav-link" style="display: inline;" href="/" id="liveGallery" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="cg-live-name">리그 오브 레전드</span>
							<i class="fas fa-chevron-down"></i>
					</a>
					<div class="dropdown-menu liveGallery" aria-labelledby="liveGallery">
							@php
									$i = 1;
							@endphp
							@forEach($liveGallerys as $liveGallery)
									<a class="dropdown-item badge-drop-a" href="{{ route('gallery.show', $liveGallery->gallery_link) }}">
											<span class="badge badge-cg-live badge-in">{{ $i }}</span>{{ $liveGallery->gallery_name }}
									</a>
									@php
											$i ++;
									@endphp
							@endforEach
							{{ $liveGallerys->links() }}
					</div>
				</div>
				<div class="clear"></div>
			</div>
			<div class="category">
				<div class="special">
					<div class="top m-hide"><b>스페셜</b><color> (3)</color></div>
					<div class="top m-show mtop"><a href="/gallery-plus-m"><b>스페셜</b></a><color> (16)</color></div>
					<table>
						<thead>
							<tr>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
								<tr>
									<td width="14.2%">
										<h6><a href="">최신글</a></h6>
										<h6><a href="">게시물 신고</a></h6>
										<h6><a href="">공지사항</a></h6>
									</td>
								</tr>
						</tbody>
					</table>
					<div class="page">

					</div>
				</div>
				@php
						$i = 0;
						$j = 0;
				@endphp

				@forEach($categorys as $category)
						<div class="special">
								<div class="top m-hide"><b>{{ $category->name }}</b><color> (3)</color></div>
								<div class="top m-show mtop"><a href="/gallery-plus-m"><b>스페셜</b></a><color> (16)</color></div>
								<table id="table{{ $category->id }}">
										<thead>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
										</thead>
										@forEach($gallerys[$category->id] as $gallery)
												@if($i % 70 == 0)
														<tr>
												@endif
												@if($j % 10 == 0)
														<td width="14.2%">
												@endif
														<h6><a href="{{ route('gallery.show', $gallery->link) }}">{{ $gallery->name }}</a></h6>
												@if($j % 10 == 9)
														</td>
												@endif
												@if($i % 70 == 69)
														</tr>
												@endif
												@php
														$i ++;
														$j ++;
												@endphp
										@endforEach
										@php
												$i = 0;
												$j = 0;
										@endphp
								</table>
								<div id="page{{ $category->id }}" class="page" style="border-top-width: 1px;">
											{{ $gallerys[$category->id]->links('vendor.pagination.simple-default') }}
								</div>
						</div>
				@endforEach
			</div>
			@yield('footer')
		</div>
	</body>
		<script>

		</script>
</html>
