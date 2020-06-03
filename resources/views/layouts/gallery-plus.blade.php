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
						<div class="col-4">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body">
								<p class="card-title"><b>[초갤]</b> <a href="">가나ddddddddddddd다라가나다라가나다라가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-4">
							<div class="card">
							  <img src="https://wstatic.dcinside.com/main/main2011/2020/01/17/gall_60616_20200117155638.jpg" class="card-img-top" alt="...">
							  <div class="card-body" style="">
								<p class="card-title"><b>[초갤]</b> <a href="">가나다라</a></p>
							  </div>
							</div>
						</div>
						<div class="col-4 m-hide">
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
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
							</div>
							<div class="col-6">
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
								<p><b>[초갤]</b> <a href="">가나다ㅏ라</a></p>
							</div>
						</div>
					</div>
				</div>
				<div class="recently-visit">
					<div class="fir">
						<b>최근 방문 갤러리</b>
					</div>
					<div class="visitlist">
						<div class="row">
							<div class="col">
								<span>겨울왕국</span>
								<button class="">X</button>
							</div>
							<div class="clear"></div>
							<div class="col">
								<span>aa</span>
								<button class="">X</button>
							</div>
							<div class="clear"></div>
							<div class="col">
								<span>aa</span>
								<button class="">X</button>
							</div>
							<div class="clear"></div>
							<div class="col">
								<span>aa</span>
								<button class="">X</button>
							</div>
							<div class="clear"></div>
							<div class="col m-hide">
								<span>aa</span>
								<button class="">X</button>
							</div>
							<div class="clear"></div>
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
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">1</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">2</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">3</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">4</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">5</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">6</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">7</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">8</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">9</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">10</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">11</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">12</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">13</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">14</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">15</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">16</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">17</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">18</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">19</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
								<div class="col-3">
									<a href="gallery-post" class="badge badge-danger">20</a>
									<a href="gallery-post">겨울왕국</a>
								</div>
							</div>
						</div>
					</div>
					<div class="right">
						<div class="mgL14">
							<div class="boxline">
								<div class="top">
									<h6 class="nobr"><b>게시판/강좌</b><color> (10)</color></h6>

									<a class="nav-link" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<span class="badge badge-mycolor">▼</span>
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<a class="dropdown-item" href="gallery">게임</a>
										<a class="dropdown-item" href="gallery">연예/방송</a>
										<a class="dropdown-item" href="gallery">스포츠</a>
										<a class="dropdown-item" href="gallery">교육/금융/IT</a>
										<a class="dropdown-item" href="gallery">여행/음식/생물</a>
										<a class="dropdown-item" href="gallery">취미/생활</a>
									</div>
									<div class="clear"></div>
								</div>
								<div class="edu-list">
									<div class="li">게시물 신고</div>
									<div class="li">공지사항</div>
								</div>
								<div class="top borST1">
									<h6 class="nobr"><b>신설 갤러리</b><color> (2)</color></h6>
								</div>
								<div class="ng-list">
									<div class="li">게시물 신고</div>
									<div class="li">공지사항</div>
									<div class="li">게시물 신고</div>
									<div class="li">공지사항</div>
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
					<img src="https://tpc.googlesyndication.com/daca_images/simgad/4912082819656302581">
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
					<span class="cg-live-name">리그 오브 레전드</span>
					<i class="fas fa-chevron-down"></i>
				</div>
				<div class="clear"></div>
			</div>
			<div class="category">
				<div class="special">
					<div class="top m-hide"><b>스페셜</b><color> (16)</color></div>
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
						<tr>
							<td width="14.2%">
								<h6><a href="">최신글</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
							</td>
							<td width="14.2%">
								<h6></h6>
							</td>
							<td width="14.2%">
								<h6></h6>
							</td>
							<td width="14.2%">
								<h6></h6>
							</td>
							<td width="14.2%">
								<h6></h6>
							</td>
							<td width="14.2%">
								<h6></h6>
							</td>
							<td width="14.2%">
								<h6></h6>
							</td>
						</tr>
					</table>
					<div class="page">
						1/7
					</div>
				</div>
				<div class="game">
					<div class="top m-hide"><b>게임</b><color> (140)</color></div>
					<div class="top m-show mtop"><a href="/gallery-plus-m"><b>게임</b></a><color> (140)</color></div>
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
						<tr>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
						</tr>
						<tr>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
							<td width="14.2%">
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
								<h6><a href="">게시물 신고</a></h6>
								<h6><a href="">공지사항</a></h6>
								<h6><a href="">게임</a></h6>
							</td>
						</tr>
					</table>
					<div class="page">
						1/7
					</div>
				</div>
				<div class="sports">
					<div class="top m-hide"><b>스포츠</b><color> (16)</color></div>
					<div class="top m-show mtop"><a href="/gallery-plus-m"><b>스포츠</b></a><color> (16)</color></div>
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

						@php
						    $galleryArr = [];
								$allcnt = count($gallerys);
								$row = 7;
								$col = ceil(count($gallerys)/70);
								$cnt = 0;
								$col_cnt = 0;
								$row_cnt = 0;
								$row_bool = 0;
						@endphp


						@foreach ($gallerys as $gallery)
							@php
								$galleryArr[$cnt] = $gallery->name;
								$cnt ++;
							@endphp
						@endforeach

						@for ($i = 0; $i < $col; $i++)
						<tr>
								@for ($j = 0; $j < $row; $j++)
									<td width="14.2%">
										@unless ($allcnt == 0)
											@for ($p = $col_cnt; $p < $cnt; $p++)
											<h6><a href="">{{ $galleryArr[$p] }}</a></h6>
												@php
													$allcnt --;
													$col_cnt ++;
												@endphp
												@if($col_cnt/10 >= 1 && $col_cnt%10 == 0)
													@break
												@endif
											@endfor
										@endunless
									</td>
								@endfor
						</tr>
						@endfor
					</table>
					<div class="page">
						1/7
					</div>
				</div>
			</div>
			@yield('footer')
		</div>
	</body>
		<script>

		</script>
</html>
