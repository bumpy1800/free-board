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
		<div class="container">
			<div class="etc">
				<a class="mb_menu" href="register">회원가입</a>
				<a class="mb_menu" href="login">로그인</a>
				<!-- 로그인 했을 때 
				<a class="mb_menu" href="login">로그아웃</a>
				-->
			</div>

			<div class="mainHead">
				<div class="logo">
					<a href="/"><img src="https://nstatic.dcinside.com/dc/w/images/dcin_logo.png">
								<img src="https://nstatic.dcinside.com/dc/w/images/tit_gallery.png"></a>
				</div>
				<div class="searchBundle">
					<div class="searchBar">
						<form>
							<div class="form-row">
								<div class="col-11">
									<input type="text" class="search form-control" placeholder="갤러리 & 통합검색">
								</div>
								<div class="col-1">
									 <button class="searchBtn btn" type="submit"><i class="fas fa-search"></i></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<div class="container">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item dropdown">
							<a class="nav-link" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<b>카테고리+</b>
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="gallery">게임</a>
								<a class="dropdown-item" href="gallery">연예/방송</a>
								<a class="dropdown-item" href="gallery">스포츠</a>
								<a class="dropdown-item" href="gallery">교육/금융/IT</a>
								<a class="dropdown-item" href="gallery">여행/음식/생물</a>
								<a class="dropdown-item" href="gallery">취미/생활</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="gallery-plus"><b>갤러리</b></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="gallog"><b>갤로그</b></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="report"><b>신고/Q&amp;A</b></a>
						</li>
					</ul>
					<span class="yesterday">
						어제 <B class="number">201,320,135개</B> 게시글 등록
					</span>
				</div>
			</div>
		</nav>

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
						<tr>
							<td width="14.2%">
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠 스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
								<h6><a href="">스포츠</a></h6>
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
			</div>
	
			<div class="mainFoot">
				<table class="table">
					<thead class="notice">
						<tr>
						<th scope="col" class="fir">공지사항</th>
						<th scope="col"></th>
						<th scope="col" class="las"></th>
						</tr>
					</thead>
					<tbody>
						<tr class="LRline">
							<th class="pdB6 Rline" scope="row"><a href=""><b>갤러리</b></a></th>
							<th class="pdB6 Rline" scope="row"><a href=""><b>인기갤러리</b></a></th>
							<th class="pdB6 Rline" scope="row"><a href=""><b>주요서비스</b></a></th>
						</tr>
						<tr class="LRline">
							<td class="pdT0 pdB6 Rline"><a href="">HIT 갤러리</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">국내야구</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">갤로그</a></td>
						</tr>
						<tr class="LRline">
							<td class="pdT0 pdB6 Rline"><a href="">초개념 갤러리</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">편의점</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">디시위키</a></td>
						</tr>
						<tr class="LRline endline">
							<td class="pdT0 pdB6 Rline"><a href="">이슈줌 갤러리</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">리그 오브 레전드</a></td>
							<td class="pdT0 pdB6 Rline"><a href="">이벤트</a></td>
						</tr>
					</tbody>
				</table>
				<div class="ad">
					<span class="ad-info"><a href="/"><b>광고 안내</b></a></span>
					<span class="ad-display"><a href="/">디스플레이광고</a></span>
					<span class="mLine">|</span>
					<span class="ad-promotion"><a href="/">프로모션</a></span>
					<span class="mLine">|</span>
					<span class="ad-question"><a href="/">광고문의</a></span>
				</div>

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
						Copyright &copy; 2020 - 2020 KSK&amp;KJS. All rights reserved.
					</div>
				</div>
			</div>
		</div>
	</body>
		<script>
		
		</script>
</html>
