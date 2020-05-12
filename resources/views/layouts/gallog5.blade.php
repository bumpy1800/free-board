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
				<div class="mybook">
					<span class="title"><b>- 방명록</b>(0)</span>
					<span class="all">
						<select class="form-control year">
							<option>2020</option>
							<option>2019</option>
							<option>2018</option>
							<option>2017</option>
							<option>2016</option>
						</select>
					</span>
					<div class="clear"></div>
					<form>
						<div class="write-mybook">
							<hr class="line">
							<div class="row">
								<div class="col-3">
									<p>범피</p>
								</div>
								<div class="col-9">
									<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
									<div class="form-check">
										  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
										  <label class="form-check-label" for="defaultCheck1">
											비밀글 쓰기
										  </label>
									</div>
									<div class="submit">
										<button class="btn">등록</button>
									</div>
								</div>
							</div>
							<hr class="line">
						</div>
					</form>
					<div class="have">
						<div class="row">
							<div class="user-title col-4">
								<p><b>제목</b></p>
							</div>
							<div class="user-content col-5">
								<p>방명록내용</p>
							</div>
							<div class="user-writeday col-3">
								<p>2020.01.27 16:50:42</p>
								<button class="btn small">댓글</button>
								<button class="btn small">수정</button>
								<button class="btn small">삭제</button>
								<button class="btn small">비공개</button>
							</div>
							<div class="user-title col-4">
								<p><b>제목</b></p>
							</div>
							<div class="user-content col-5">
								<p>방명록내용</p>
							</div>
							<div class="user-writeday col-3">
								<p>2020.01.27 16:50:42</p>
								<button class="btn small">댓글</button>
								<button class="btn small">수정</button>
								<button class="btn small">삭제</button>
								<button class="btn small">비공개</button>
							</div>
							<div class="user-title col-4">
								<p><b>제목</b></p>
							</div>
							<div class="user-content col-5">
								<p>방명록내용</p>
							</div>
							<div class="user-writeday col-3">
								<p>2020.01.27 16:50:42</p>
								<button class="btn small">댓글</button>
								<button class="btn small">수정</button>
								<button class="btn small">삭제</button>
								<button class="btn small">비공개</button>
							</div>
						</div>
					</div>
					<!--<div class="none">
						<b>등록된 방명록이 없습니다.</b>
					</div>-->
					<hr class="hr1">
				</div>
			</div>

			@yield('footer')
		</div>
	</body>
</html>
