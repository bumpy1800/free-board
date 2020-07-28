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
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
		<script src="{{ asset('assets/js/jquery-3.4.1.js') }}"></script>
		<script src="{{ asset('assets/js/visitor.js') }}"></script>
	</head>
	<body>

		@yield('header')

		<div class="container">
			<div class="mainLeft">
				<div class="hit">
					<a href="{{ route('gallery-hit.index') }}"><h6 class="title "><b>HIT 갤러리</b></h6></a>
					<hr class="line">
					<div class="row">
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><a href="{{ route('gallery-hit.index') }}"><b>RX570 새척했다 ㅋㅋㅋㅋ</b></a></p>
								<p class="card-gallery">컴퓨터 본체</p>
								<p class="card-count"><b>댓글</b> 100개 <b>추천</b> 999개</p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>RX570 새척했다 ㅋㅋㅋㅋ</b></p>
								<p class="card-gallery">컴퓨터 본체</p>
								<p class="card-count"><b>댓글</b> 100개 <b>추천</b> 999개</p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>RX570 새척했다 ㅋㅋㅋㅋ</b></p>
								<p class="card-gallery">컴퓨터 본체</p>
								<p class="card-count"><b>댓글</b> 100개 <b>추천</b> 999개</p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>RX570 새척했다 ㅋㅋㅋㅋ</b></p>
								<p class="card-gallery">컴퓨터 본체</p>
								<p class="card-count"><b>댓글</b> 100개 <b>추천</b> 999개</p>
							  </div>
							</div>
						</div>
					</div>
				</div>

				<div class="newPost">
					<h6 class="title "><b>최신글</b></h6>
					<hr class="line">
					<div class="row">
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body">
								<p class="card-title"><b>[초갤]</b> <a href="">가나ddddddddddddd다라가나다라가나다라가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-3">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
					</div>
					<hr class="dot-line">
					<div class="newPost-more">
						<div class="row">
							<div class="col-6">
								<p><b>[초갤]</b> <a href="">가나다ㅏ라ddddddddddddddddddddddddddddd</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
							</div>
							<div class="col-6">
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
							</div>
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
						<div class="ranking">
							<div class="ranking-left">
								<h6>
									<a href="gallery-post" class="badge badge-primary">1</a>
									<a href="gallery-post">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">2</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">3</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">4</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">5</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">6</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">7</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">8</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">9</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>
							<div class="ranking-left">
								<h6>
									<a href="#" class="badge badge-primary">10</a>
									<a href="#">겨울왕국</a>
								</h6>
							</div>
							<div class="ranking-right">
								<h6>
									10
									<a href="#" class="badge badge-danger">▲</a>
								</h6>
							</div>
							<div class="clear"></div>

						</div>
					<div class="clear"></div>
				</div>

				<div class="ranking-more">
					<div id="ranking-more">
						<a href="/"><b>더보기</b></a>
					</div>
				</div>

				<div class="boxline newGallery">
					<div>
						<h6><strong>신설갤</strong></h6>
					</div>
					<hr class="dot-line">
						<div class="list">
							<ul>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
								<li>가나다</li>
							</ul>
						</div>
					<div class="clear"></div>
				</div>

				<div class="ranking-more">
					<div id="ranking-more">
						<a href="/"><b>더보기</b></a>
					</div>
				</div>
			</div>

			<div class="clear"></div>

			@yield('footer')

		</div>
	</body>
</html>
