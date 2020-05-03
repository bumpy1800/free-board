<!DOCTYPE html>


<html lang="kr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<script src="{{ asset('assets/package/dist/js/service/HuskyEZCreator.js') }}" charset="utf-8"></script>
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallery.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/gallery-post.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/gallery-write.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<body>
		<div class="container">
			<div class="etc">
				<a class="mb_menu" href="login">회원가입</a>
				<a class="mb_menu" href="/">로그인</a>
			</div>

			<div class="mainHead">
				<div class="logo">
					<a href="http://doerksk.dothome.co.kr"><img src="/assets/img/test.gif"></a>
				</div>
				<div class="searchBundle">
					<div class="todayIsue">
						<p><b>오늘의 이슈</b> | 테스트 | 테스트2 | 테스트3</p>
					</div>
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
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								갤러리+
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="#">Action</a>
								<a class="dropdown-item" href="#">Another action</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="#">Something else here</a>
							</div>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="gallery">m.갤러리</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="gallog">갤로그</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">신고센터</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">Q&A</a>
						</li>
					<!--<li class="nav-item">
					<a class="nav-link" href="{{route('test.index')}}" tabindex="-1" aria-disabled="true">Disabled</a>
					</li>-->
					</ul>
					<span class="yesterday">
						어제 <B class="number">201,320,135개</B> 게시글 등록
					</span>
				</div>
			</div>
		</nav>

		<div class="container">
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
                <div class="write_warp">
                    <fieldset>
                        <div class="input_infobox input_infotxt">
                            <!--<label id="name" for="name" class="txt_placeholder">닉네임</label>-->
                            <input class="infotxt" type="text" maxlength="15" name="name" value="" placeholder="닉네임">
                        </div>
                        <div class="input_infobox input_infotxt">
                            <!--<label for="password" class="txt_placeholder">비밀번호</label>-->
                            <input class="infotxt" type="password" maxlength="20" name="password" value="" placeholder="비밀번호">
                        </div>
                        <div class="write_sub">
                            <strong class="tit">말머리</strong>
                            <ul class="sub_list">
                                <li class="sel"><i class="fas fa-check"></i>일반</li>
                                <li>일반2</li>
                            </ul>
                        </div>
                        <div class="input_infobox input_tit">
                            <!--<label id="tit" for="tit" class="txt_placeholder">제목을 작성해주세요</label>-->
                            <input class="infotxt" type="text" maxlength="40" name="tit" value="" placeholder="제목을 입력해 주세요">
                        </div>
                    </fieldset>
                    <div class="write_info">
                        <p>※ 쉬운 비밀번호를 입력하면 타인의 수정, 삭제가 쉽습니다.</p>
                        <p>※ 음란물, 차별, 비하, 혐오 및 초상권, 저작권 침해 게시물은 민, 형사상의 책임을 질 수 있습니다.</p>
                    </div>
                    <div class="" style="height:90px;">
                        <img src="https://t1.daumcdn.net/b2/creative/79155/69ab8cd0fccdae3fdd20b129cf539020.jpg" alt="글작성시 광고">
                    </div>
                    <div class=""><!--에디터-->
						<textarea name="ir1" id="ir1" rows="10" cols="100">
							에디터에 기본으로 삽입할 글(수정 모드)이 없다면 이 value 값을 지정하지 않으시면 됩니다.
						</textarea>
                    </div>
                    <div class="btn_box right">
                        <button class="btn_gray" type="button" name="button">취소</button>
                        <button class="btn_blue" type="button" name="button">등록</button>
                    </div>
                </div>
			<div class="clear"></div>
		</div>
		<div class="container">
			<div class="mainFoot">
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
	<script type="text/javascript">
		var oEditors = [];
		nhn.husky.EZCreator.createInIFrame({
		oAppRef: oEditors,
		elPlaceHolder: "ir1",
		sSkinURI: "../assets/package/dist/SmartEditor2Skin.html",
		fCreator: "createSEditor2"
		});
	</script>
</html>
