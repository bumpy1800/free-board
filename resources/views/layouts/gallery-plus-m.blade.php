<!DOCTYPE html>


<html lang="kr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		@yield('css')
		<link href="{{ asset('assets/css/gallery-plus.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallery-plus-m.css') }}" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<div class="etc">
				<a class="mb_menu" href="register">회원가입</a>
				<a class="mb_menu" href="login">로그인</a>
				<!-- 로그인 했을 때
				<a class="mb_menu" href="login">로그아웃</a>
				-->
			</div>
            @yield('header')
		<div class="container">
			<div class="cg-top">
				<div class="cg-all">
					<span class="btn"><b>{{ $category->name }} 관련 갤러리 전체목록</b></span>
					<b><color><i class="fas fa-check"></i> 인기순</color></b>
				</div>
				<div class="clear"></div>
			</div>
			<div class="category">
				<div class="game">
					<div class="top m-hide"><b>{{ $category->name }}</b><color> ({{ $gallerys->total() }})</color></div>
					<div class="top m-show mtop"><a href=""><b>{{ $category->name }}</b></a><color> ({{ $gallerys->total() }})</color></div>
					<table>
						<colgroup>
							<col width="50%" />
							<col width="50%" />
						</colgroup>
						<thead>
							<tr>
								<th></th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@php
								$i = 0;
								$j = 0;
							@endphp
							@forEach($gallerys as $gallery)
									@if($i % 20 == 0)
											<tr>
									@endif
									@if($j % 10 == 0)
											<td width="14.2%">
									@endif
											<h6><a href="{{ route('gallery.show', $gallery->link) }}">{{ $gallery->name }}</a></h6>
									@if($j % 10 == 9)
											</td>
									@endif
									@if($i % 20 == 19)
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
						</tbody>
					</table>
					<div id="page{{ $category->id }}" class="page" style="border-top-width: 1px;">
						{{ $gallerys->links('vendor.pagination.gallery-plus-m-pagination') }}
					</div>
				</div>
			</div>

            @yield('footer')
		</div>
	</body>
		<script>

		</script>
</html>
