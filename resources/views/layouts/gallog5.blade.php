<!DOCTYPE html>


<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<script src="{{ asset('assets/js/jquery-3.4.1.js') }}"></script>
		<script src="{{ asset('assets/js/gallog.js') }}"></script>
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallog.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<body>
		<div class="container">
			@yield('header')
			<div class="middle">
				<div class="mybook">
					<span class="title"><b>- 방명록</b>({{ $guestbooks->total() }})</span>
					<span class="all">
						<select class="form-control year" id="select_year">
							<option value="" selected>전체</option>
							@for($i = $min; $i <= $max; $i ++)
								@if($i == $select_year)
									<option value="{{ $i }}" selected>{{ $i }}</option>
								@else
									<option value="{{ $i }}">{{ $i }}</option>
								@endif
							@endfor
						</select>
					</span>
					<div class="clear"></div>
					<form method="post" action="{{ url('gallog-guestbook/'.$user->uid.'/store') }}">
						@method('POST')
	  				  	@csrf
						<div class="write-mybook">
							<hr class="line">
							<div class="row">
								<div class="col-3">
									<p>{{ Auth::user()->nick }}</p>
								</div>
								<div class="col-9">
									<textarea class="form-control" name="contents" id="exampleFormControlTextarea1" rows="3"></textarea>
									<div class="form-check">
										  <input class="form-check-input" name="secret" type="checkbox" value="1" id="defaultCheck1">
										  <label class="form-check-label" for="defaultCheck1">
											비밀글 쓰기
										  </label>
									</div>
									<div class="submit">
										<button type="submit" class="btn">등록</button>
									</div>
								</div>
							</div>
							<hr class="line">
						</div>
					</form>
					@if(!empty($guestbooks->items()))
					<div class="have">
						<div class="row">
							@foreach($guestbooks as $guestbook)
								@if($guestbook->guestbook_secret == 0)
									<div class="user-title col-4" id="title{{ $guestbook->guestbook_id }}">
										<p><b>{{ $guestbook->user_nick }}</b></p>
									</div>
									<div class="user-content col-5" id="contents{{ $guestbook->guestbook_id }}">
										<p>{{ $guestbook->guestbook_contents }}</p>
									</div>
									<div class="user-writeday col-3" id="writeday{{ $guestbook->guestbook_id }}">
										<p>{{ $guestbook->guestbook_reg_date }}</p>
										@if($guestbook->guestbook_write_user_id == Auth::user()->id)
											<button id="{{ $guestbook->guestbook_id }}" class="btn small guestbook_edit">수정</button>
											<button style="display: none;" id="update{{ $guestbook->guestbook_id }}" class="btn small guestbook_update">저장</button>
											<button style="display: none;" id="close{{ $guestbook->guestbook_id }}" class="btn small guestbook_close">취소</button>
											<button id="{{ $guestbook->guestbook_id }}" class="btn small guestbook_destroy">삭제</button>
											<button id="{{ $guestbook->guestbook_id }}" class="btn small guestbook_hidden">비공개</button>
										@endif
									</div>
								@else
									<div class="user-title col-4" style="background-color: #eee;" id="title{{ $guestbook->guestbook_id }}">
										<p><b>{{ $guestbook->user_nick }} <i class="fas fa-lock"></i></b></p>
									</div>
									<div class="user-content col-5" style="background-color: #eee;" id="contents{{ $guestbook->guestbook_id }}">
										@if($guestbook->guestbook_write_user_id == Auth::user()->id || $guestbook->guestbook_user_id == Auth::user()->id)
											<p>{{ $guestbook->guestbook_contents }}</p>
										@else
											<p>비밀글입니다.</p>
										@endif
									</div>
									<div class="user-writeday col-3" style="background-color: #eee;" id="writeday{{ $guestbook->guestbook_id }}">
										<p>{{ $guestbook->guestbook_reg_date }}</p>
										@if($guestbook->guestbook_write_user_id == Auth::user()->id)
											<button id="{{ $guestbook->guestbook_id }}" class="btn small guestbook_edit">수정</button>
											<button style="display: none;" id="update{{ $guestbook->guestbook_id }}" class="btn small guestbook_update">저장</button>
											<button style="display: none;" id="close{{ $guestbook->guestbook_id }}" class="btn small guestbook_close">취소</button>
											<button id="{{ $guestbook->guestbook_id }}" class="btn small guestbook_destroy">삭제</button>
											<button id="{{ $guestbook->guestbook_id }}" class="btn small guestbook_open">공개</button>
										@endif
									</div>
								@endif
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
		</div>
	</body>
</html>
