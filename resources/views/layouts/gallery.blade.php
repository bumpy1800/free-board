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
		<link href="{{ asset('assets/css/gallery.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<body>

        @yield('header')

		<div class="container">
			<div class="mainLeft">
				<div class="gallery-top">
					<h4 class="title"><b>테스트갤러리</b></h4>
					<div class="sub">
						<span><a href="">연관 갤러리(0/5)</a></span>
						<span class="mLine">|</span>
						<span><a href="">갤주소 복사</a></span>
						<span class="mLine">|</span>
						<span><a href="">차단설정</a></span>
						<span class="mLine">|</span>
						<span><a href="">갤러리 이용안내</a></span>
					</div>
				</div>
				<div class="clear"></div>
				<hr class="line" style="margin-bottom:0px;">
				<div class="infomation"><!--제일 큰박스-->
					<div class="info-rank"><!--정보와 랭킹-->
						<div class="info"><!--정보-->
							<div class="img-info"><!--대표이미와 설명-->
								<img src="https://static.wixstatic.com/media/0410f9_31769bd99aed4496b8a99667f7425f06~mv2.jpg/v1/fill/w_1600,h_900,al_c,q_90/file.jpg" alt="대표이미지">
								<div class="txtbox">
									<p>이곳에 갤러리에대한 설명이 들어갑니다</p>
								</div>
							</div>
							<div class="m_list"><!--매니저 리스트-->
								<div class="member">
									<strong>매니저</strong>
									<p>
										<span>이름(아이디)</span>
									</p>
								</div>
								<div class="member">
									<strong>부매니저</strong>
									<p>
										<span>이름(아이디)</span>
										<span>이름(아이디)</span>
										<span>이름(아이디)</span>
										<span>이름(아이디)</span>
										<span>이름(아이디)</span>
										<span>이름(아이디)</span>
									</p>
								</div>
								<div class="member">
									<strong>개설일</strong>
									<p><span>날짜(1111-11-11)</span></p>
								</div>
							</div>
						</div>
						<div class="ranker"><!--랭킹-->
							<div class="rank">
								<h4><i class="fas fa-sun red"></i>대흥갤</h4>
							</div>
							<div class="num">
								<h3>n위</h3>
							</div>
							<a href="#" class="rankBtn">
								<img src="/assets/img/rank.png" alt="순위버튼">
							</a>
						</div>
					</div>
					<div class="top-ad"><!--상단광고-->
						<img src="https://nstatic.dcinside.com/ad/2020/banner/200212_AFKarena_84090.jpg" alt="광고">
					</div>
					<div class="record"><!--방문기록-->
						<h3 class="gal-record">최근 방문 갤러리</h3>
						<button type="button" class="hide prev">
							<i class="fas fa-caret-left"></i>
						</button>
						<ul class="visit-gal">
							<li>
								<a href="#">
									방문한 갤
								</a>
								<button type="button" class="hide del"><i class="fas fa-times grey"></i></button>
							</li>
							<li>
								<a href="#">
									방문한 갤
								</a>
								<button type="button" class="hide del"><i class="fas fa-times grey"></i></button>
							</li>
							<li>
								<a href="#">
									방문한 갤
								</a>
								<button type="button" class="hide del"><i class="fas fa-times grey"></i></button>
							</li>
							<li>
								<a href="#">
									방문한 갤
								</a>
								<button type="button" class="hide del"><i class="fas fa-times grey"></i></button>
							</li>
						</ul>
						<button type="button" class="hide next">
							<i class="fas fa-caret-right toggle"></i>
						</button>
					</div>
				</div>
				<div class="optionBar">
					<div class="leftBox">
						<button type="button" name="button" class="on">전체글</button>
						<button type="button" name="button" class="">개념글</button>
						<button type="button" name="button" class="">공지</button>
					</div>
					<div class="centerBox">
						<div class="inner">
							<ul>
								<li><a href="#" class="on">전체</a></li>
								<li><a href="#" class="">일반</a></li>
								<li><a href="#" class="">연재</a></li>
							</ul>
						</div>
					</div>
					<div class="rightBox">
						<div class="output">
							<div class="selectBox">
								<select class="" name="number">
									<option value="30">30개</option>
									<option value="50">50개</option>
									<option value="100">100개</option>
								</select>
								<!--<div class="selectArea">
									<a href="#" onclick="showLayer(this, 'listSizeLayer');return false;">50개
										<span class="blind">페이지당 게시물 노출 옵션</span>
										<i class="fas fa-caret-down"></i>
									</a>
								</div>
								<ul id="listSizeLayer" class="option_box" style="left: 0px; top: 20px; display: none;">
							  	  <li><a href="javascript:listDisp(30)">30개</a></li>
								  <li><a href="javascript:listDisp(50)">50개</a></li>
								  <li><a href="javascript:listDisp(100)">100개</a></li>
							  </ul>-->
							</div>
							<div class="switchBtn">
								<a href="#" class="writeBtn">
									<i class="fas fa-pencil-alt"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="post_listWarp">
					<table class="post_list">
						<thead>
							<tr>
								<th scope="col" class="tit-num">번호</th>
								<th scope="col" class="tit-mal">말머리</th>
								<th scope="col" class="tit-tit">제목</th>
								<th scope="col" class="tit-user">글쓴이</th>
								<th scope="col" class="tit-date">작성일</th>
								<th scope="col" class="tit-view">조회</th>
								<th scope="col" class="tit-good">추천</th>
							</tr>
						</thead>
						<tbody>
							<tr class="postArea">
								<td class="post_num">12131</td>
								<td class="post_head"><b>공지</b></td>
								<td class="post_title">
									<a href="post">
										<i class="fas fa-info-circle red"></i>
										<b>제목</b>
									</a>
									<a href="#" class="comment_count">[312]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피">범피</span>
									<a href="#" class="nickon">
										<i class="fas fa-crown gold"></i>
									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">12131</td>
								<td class="post_head"><b>공지</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-info-circle red"></i>
										<b>제목</b>
									</a>
									<a href="#" class="comment_count">[312]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피">범피</span>
									<a href="#" class="nickon">
										<i class="fas fa-crown gold"></i>
									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">12131</td>
								<td class="post_head"><b>공지</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-info-circle red"></i>
										<b>제목</b>
									</a>
									<a href="#" class="comment_count">[312]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피">범피</span>
									<a href="#" class="nickon">
										<i class="fas fa-crown gold"></i>
									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-image green"></i>
										제목(부매니저)
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피동생">범피동생</span>
									<a href="#" class="nickon">
										<i class="fas fa-crown gray"></i>
									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>
							<tr class="postArea">
								<td class="post_num">112331</td>
								<td class="post_head"><b>일반글</b></td>
								<td class="post_title">
									<a href="#">
										<i class="fas fa-comment-dots sliver"></i>
										제목
									</a>
									<a href="#" class="comment_count">[222]</a>
								</td>
								<td class="post_user">
									<span class="nickname" title="범피형">범피형</span>
									<a href="#" class="nickon">

									</a>
								</td>
								<td class="post_date">20.02.16</td>
								<td class="post_view">123213</td>
								<td class="post_good">32</td>
							</tr>

						</tbody>
					</table>
				</div>
				<div class="optionBar bot">
					<div class="leftBox">
						<button type="button" name="button" class="on">전체글</button>
						<button type="button" name="button" class="">개념글</button>
					</div>
					<div style="float:right;">
						<a href="write"><button type="button" name="button" class="on write">글쓰기</button></a>
					</div>
				</div>
				<div class="pagebox">
					<em>1</em>
					<a href="#">2</a>
					<a href="#">3</a>
					<a href="#">4</a>
					<a href="#">5</a>
					<a href="#">6</a>
					<a href="#">7</a>
					<a href="#">8</a>
					<a href="#">9</a>
					<a href="#">10</a>
					<a href="#">11</a>
					<a href="#">12</a>
					<a href="#">13</a>
					<a href="#">14</a>
					<a href="#">15</a>
					<a href="#">다음</a>
					<a href="#">끝</a>
				</div>
				<div class="bottom_search">
					<div class="bottom_select">
						<select id="search_type" name="search_type">
		    			  <option value="search_all">전체</option>
		    			  <option value="search_subject">제목</option>
		    			  <option value="search_memo">내용</option>
		    			  <option value="search_name">글쓴이</option>
		    			  <option value="search_subject_memo">제목+내용</option>
		    			</select>
					</div>
					<div class="search_content">
						<div class="inner_search">
							<input type="text" class="keyword" name="search_keyword" value="" title="검색어 입력">
						</div>
						<button type="button" class="searchBtn btn" name="button"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</div>
			<div class="mainRight">
				<div class="login_line login">
					<div class="user_box">
						<div class="login_box">
							<a href="login" id="login"><b>로그인을 해 주시기바랍니다</b></a>
						</div>
						<div class="help">
							<div class="row">
								<div class="col-sm-4">
									<a href="register"><b>갤로그</b></a>
								</div>
								<div class="col-sm-4 LR_line">
									<a href="/" class=""><b>즐겨찾기</b><i class="fas fa-caret-down" style="padding-left: 4px;"></i></a>
								</div>
								<div class="col-sm-4">
									<a href="/"><i class="fas fa-bell" style="padding-right: 4px;"></i><b>알림</b></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="right_ad">
					<img src="https://tpc.googlesyndication.com/simgad/12871765273756679647?sqp=4sqPyQQ7QjkqNxABHQAAtEIgASgBMAk4A0DwkwlYAWBfcAKAAQGIAQGdAQAAgD-oAQGwAYCt4gS4AV_FAS2ynT4&rs=AOga4qmFBbjMJZsu2LGHX2Wwb1VR_TOVrg" alt="우측광고">
				</div>
				<div class="boxline liveRanking concept">
					<div class="concept-left">
						<h6><a href="#"><strong>개념글</strong><sm>[소제목]</sm></a></h6>
					</div>
					<div class="concept-right">
						<page><strong>1</strong>/8</page><i class="fas fa-caret-square-left blue opacity"></i><i class="fas fa-caret-square-right blue"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<div class="ranking">
							<ul class="ranking-left">
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글1</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글2</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글3</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글4</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글5</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글6</a></li>
								</h6>
							</ul>
							<div class="clear"></div>
						</div>
					<div class="clear"></div>
				</div>
				<div class="boxline newGallery issu-zoom">
					<div class="concept-left">
						<h6><a href="#"><strong>이슈줌</strong></a></h6>
					</div>
					<span class="new_icon"><img src="/assets/img/new.png" alt="new"></span>
					<div class="concept-right">
						<page><strong>1</strong>/8</page><i class="fas fa-caret-square-left blue opacity"></i><i class="fas fa-caret-square-right blue"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<span class="img-box">
							<a href="#" class="box">
								<img src="https://wstatic.dcinside.com/main/main2011/2020/02/05/2950635147_25e093a1_Screenshot_20200205-101819_SamsungInternet.jpg_s" alt="이슈사진">
								<div class="issu">
									<strong>사진이름</strong>
								</div>
								<span class="issu-inner"></span>
							</a>
						</span>

					<div class="clear"></div>
				</div>
				<div class="boxline newGallery news">
					<div class="concept-left">
						<h6><a href="#"><strong>뉴스</strong></a></h6>
					</div>
					<span class="new_icon"><img src="/assets/img/new.png" alt="new"></span>
					<div class="concept-right">
						<page><strong>1</strong>/8</page><i class="fas fa-caret-square-left blue opacity"></i><i class="fas fa-caret-square-right blue"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<a href="#" class="box">
							<span class="img-box">
									<img src="https://pds.joins.com/news/component/htmlphoto_mmdata/202002/10/82f1d8e5-672e-41d6-9ed1-62f6a1ca0930.jpg.tn_350.jpg" alt="이슈사진">
							</span>
							<div class="news-title"><strong>기사제목</strong></div>
							<div class="news-content">기사내용</div>
						</a>
					<div class="clear"></div>
				</div>
				<div class="boxline newGallery cho">
					<div class="concept-left">
						<h6><a href="#"><strong>초개념</strong></a></h6>
					</div>
					<div class="concept-right">
						<i class="fas fa-plus"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<div class="cho-box">
							<div class="img">
								<div class="secimg-box">
									<a href="#">
										<span class="cho-img">
											<img src="https://wstatic.dcinside.com/main/main2011/2020/02/10/1889239287_d6ca7dd3_nike-air-zoom-alphafly-next-percent-original-1580936424.jpg_s" alt="test1">
										</span>
										<div class="cho-txt">
											<strong>[갤]게시글제목</strong>
										</div>
									</a>
								</div>
								<div class="secimg-box">
									<a href="#">
										<span class="cho-img">
											<img src="https://wstatic.dcinside.com/main/main2011/2020/02/10/gall_61001_20200210153828.jpg" alt="test1">
										</span>
										<div class="cho-txt">
											<strong>[갤]게시글제목</strong>
										</div>
									</a>
								</div>
							</div>
							<ul class="txt">
								<li>[갤]내용</li>
								<li>[갤]내용</li>
								<li>[갤]내용</li>
								<li>[갤]내용</li>
								<li>[갤]내용</li>
							</ul>
						</div>
					<div class="clear"></div>
				</div>
			</div>

			<div class="clear"></div>


		</div>
		<div class="container">
			@yield('footer')
		</div>
	</body>
</html>
