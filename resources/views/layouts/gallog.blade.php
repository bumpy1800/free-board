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
				<div class="mypost">
					<span class="title"><b>- 내 게시글</b>({{ $posts->total() }})</span>
					<span class="all">
						<a href="{{ url('gallog-post') }}/{{ $user->uid }}">
							<button class="btn">전체보기</button>
						</a>
					</span>
					<div class="clear"></div>
					<hr class="line">
					<div>
						@if(!empty($posts->items()))
							<div class="have">
								<div class="row">
									@foreach($posts as $post)
										<div class="user-title col-4">
											<p><b>{{ $post->post_title }}</b></p>
										</div>
										<div class="test user-content col-5">
											<p>{{ strip_tags($post->post_contents) }}</p>
										</div>
										<div class="user-writeday col-3">
											<p><b>{{ $post->gallery_name }}</b></p>
											<p>{{ $post->post_reg_date }}</p>
										</div>
									@endforeach
								</div>
							</div>
						@else
							<div class="none">
								<b>등록된 게시글이 없습니다.</b>
							</div>
						@endif
					</div>
					<div class="pagination" style="justify-content: center;">
						{{ $posts->links('vendor.pagination.gallog-pagination') }}
					</div>
					<hr class="hr1">
				</div>
				<div class="mycomment">
					<span class="title"><b>- 내 댓글</b>({{ $comments->total() }})</span>
					<span class="all">
						<a href="{{ url('gallog-comment') }}/{{ $user->uid }}">
							<button class="btn">전체보기</button>
						</a>
					</span>
					<div class="clear"></div>
					<hr class="line">
					@if(!empty($comments->items()))
						<div class="have">
							<div class="row">
								@foreach($comments as $comment)
									<div class="user-title col-4">
										<p><b>{{ $comment->post_title }}</b></p>
									</div>
									<div class="test user-content col-5">
										<p>{{ $comment->comment_contents }}</p>
									</div>
									<div class="user-writeday col-3">
										<p><b>{{ $comment->gallery_name }}</b></p>
										<p>{{ $comment->comment_reg_date }}</p>
									</div>
								@endforeach
							</div>
						</div>
					@else
						<div class="none">
							<b>등록된 게시글이 없습니다.</b>
						</div>
					@endif
					<div class="pagination" style="justify-content: center;">
						{{ $comments->links('vendor.pagination.gallog-pagination') }}
					</div>
					<hr class="hr1">
				</div>
				<div class="myscrap">
					<span class="title"><b>- 스크랩</b>({{ $scraps->total() }})</span>
					<span class="all">
						<a href="{{ url('gallog-scrap') }}/{{ $user->uid }}">
							<button class="btn">전체보기</button>
						</a>
					</span>
					<div class="clear"></div>
					<hr class="line">
					@if(!empty($scraps->items()))
						<div class="have">
							<div class="row">
								@foreach($scraps as $scrap)
									<div class="user-title col-4">
										<p><b>{{ $scrap->post_title }}</b></p>
									</div>
									<div class="test user-content col-5">
										<p>{{ strip_tags($scrap->post_contents) }}</p>
									</div>
									<div class="user-writeday col-3">
										<p><b>{{ $scrap->gallery_name }}</b></p>
										<p>{{ $scrap->post_reg_date }}</p>
									</div>
								@endforeach
							</div>
						</div>
					@else
						<div class="none">
							<b>등록된 게시글이 없습니다.</b>
						</div>
					@endif
					<div class="pagination" style="justify-content: center;">
						{{ $scraps->links('vendor.pagination.gallog-pagination') }}
					</div>
					<hr class="hr1">
				</div>
				<div class="mybook">
					<span class="title"><b>- 방명록</b>({{ $guestbooks->total() }})</span>
					<span class="all">
						<a href="{{ url('gallog-guestbook') }}/{{ $user->uid }}">
							<button class="btn">전체보기</button>
						</a>
					</span>
					<div class="clear"></div>
					<hr class="line">
					@if(!empty($guestbooks->items()))
						<div class="have">
							<div class="row">
								@foreach($guestbooks as $guestbook)
									<div class="user-title col-4">
										<p><b>{{ $guestbook->user_nick }}</b></p>
									</div>
									<div class="user-content col-5">
										<p>{{ $guestbook->guestbook_contents }}</p>
									</div>
									<div class="user-writeday col-3">
										<p>{{ $guestbook->guestbook_reg_date }}</p>
									</div>
								@endforeach
							</div>
						</div>
					@else
						<div class="none">
							<b>등록된 방명록이 없습니다.</b>
						</div>
					@endif
					<div class="pagination" style="justify-content: center;">
						{{ $guestbooks->links('vendor.pagination.gallog-pagination') }}
					</div>
					<hr class="hr1">
				</div>
			</div>
			@yield('footer')
	</body>
</html>
