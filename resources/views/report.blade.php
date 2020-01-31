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
		<link href="{{ asset('assets/css/report.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>
	<body>
		<header class="header_bg">
			<div class="container">
				<div class="report_header">
					<div class="header_logo">
						<a href="http://doerksk.dothome.co.kr"><img src="https://nstatic.dcinside.com/dc/w/images/dcin_logo2.png"></a>
						<a href="http://doerksk.dothome.co.kr/register"><img src="https://nstatic.dcinside.com/dc/w/images/tit_report_a.png"></a>
					</div>
					<div class="header_nav">
						<span>갤러리</span>
						<span class="mLine">|</span>
						<span>m.갤러리</span>
						<span class="mLine">|</span>
						<span>갤로그</span>
						<span class="mLine">|</span>
						<span>뉴스</span>
						<span class="mLine">|</span>
						<span>이벤트</span>
						<span class="mLine">|</span>
						<span>만두몰</span>
					</div>
				</div>
			</div>
			<div class="clear"></div>
		</header>
		<div class="container">
			<div class="content">
				<div class="row boxline active">
					<div class="col-3">
						<img width="170px" src="/assets/img/report_content.png">
						<button class="btn mem">내 신고 처리 내역</button>
						<button class="btn nomem">비회원 신고 처리 내역</button>
					</div>
					<div class="col-9">
						<ul>
							<li><b class="f">아래 내용을 지켜주시면 보다 빠른 답변을 받으실 수 있습니다.</b></li>
						
							<li><p>게시물 신고는 게시물 주소(URL) 또는 작성자 ID, 해당 게시물의 제목, 신고 사유를 정확히 기재해 주셔야 합니다.</p></li>
							<li>
								<p>게시물 신고는 <b>1개의 게시물(URL)만</b> 등록할 수 있습니다.</p>
								<p class="r">[신고 사유]에 게시물(URL, 게시물번호)을 입력하는 경우 신고처리 되지 않습니다.</p>
							</li>
							<li>
								<p>신고 분류 선택이 추가되었습니다.</p>
								<p><b>정확한 신고 분류를 선택하여 신고</b>해 주시면 보다 빠른 답변을 받으실 수 있습니다.</p>
								<p class="r">정확한 분류에 의한 신고가 아닐 경우 허위 신고로 판단되어 서비스 이용에 제한을 받으실 수 있습니다.</p>
							</li>

							<li>
								<p>공지사항 요청은 <B>평일 09:30~18:30</b> 사이에 요청해 주셔야만 처리가 가능합니다.</p>
								<p class="r">공지사항 요청으로 게시물 신고 시, 허위 신고로 판단되어 서비스 이용에 제한을 받으실 수 있습니다.</p>
								<p>공지 신청 시에는 타사이트 링크 및 유도되는 단어, 파일 공유, 공동구매, 고정닉 리스트, 저작권 관련 동영상 게시물,욕설 및 비속어가 포함된 게시물 등은 공지로 올려드리지 않으니 참고해주시기 바랍니다.</p>
							</li>
							<hr class="dot-line">
							<li>
								<p><b>게시물 카테고리와 맞지 않는 허위 신고 시, <color class="r">게시판 이용에 제한</color>을 받을 수 있습니다.</b></p>
								<p>회원만 신고 가능한 분류 : <color class="r">도배, 욕설, 기타, HIT, 개념 추천수, 초개념, 만두, 만두몰, 매니저 위임, 갤로그 차단해제</color></p>
								<p>회원/비회원 신고 가능한 분류 : <color class="r">광고, 음란물, 개인정보침해, 저작권침해, 디시콘, 대문, 자동짤방, 공지</color></p>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<h6 class="title"><b>신고 분류 선택</b></h6>
			<hr class="line">
			<div class="select-report">
				<ul>
					<li><p>정확한 서비스 및 신고 분류를 선택해 주시길 바랍니다.</p></li>

					<li><p>저작권 침해(법인사업자)로 신고 시 사업자등록증을 필수로 첨부하셔야 합니다.</p></li>

					<li><p class="r">정확한 분류에 의한 신고가 아닐 경우 허위 신고로 판단되어 서비스 이용에 제한을 받으실 수 있습니다.</p></li>
				</ul>
				<div class="report-kinds">
					<div class="row">
						<div class="col-4">
							<div class="boxline">
								<div class="report-post">
									<b>게시물 신고</b>
									<img src="/assets/img/sp_report.png">
								</div>
								<div class="kinds">
									<p><a href="">광고</a></p>
									<p><a href="">도배</a></p>
									<p><a href="">음란물</a></p>
									<p><a href="">욕설</a></p>
									<p><a href="">개인정보침해</a></p>
									<p><a href="">저작권침해</a></p>
									<p><a href="">기타</a></p>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="boxline">
								<div class="report-service">
									<b>서비스 신고</b>
									<img src="/assets/img/sp_report2.png">
								</div>
								<div class="kinds">
									<p><a href="">HIT</a></p>
									<p><a href="">개념 추천수</a></p>
									<p><a href="">초개념</a></p>
									<p><a href="">만두</a></p>
									<p><a href="">디시콘</a></p>
									<p><a href="">만두몰</a></p>
								</div>
							</div>
						</div>
						<div class="col-4">
							<div class="boxline">
								<div class="apply-service">
									<b>서비스 신청</b>
									<img src="/assets/img/sp_report3.png">
								</div>
								<div class="kinds">
									<p><a href="">대문</a></p>
									<p><a href="">자동짤방</a></p>
									<p><a href="">공지</a></p>
									<p><a href="">매니저 위임</a></p>
									<p><a href="">갤로그 차단해제</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
				
		<hr class="line borST1">
		<div class="container">
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
  </body>
</html>
