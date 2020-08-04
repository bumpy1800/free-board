<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/sjinside-icon-white.png') }}"/>
    <title>@yield('title', '없음')</title>
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <script defer src="{{ asset('assets/js/display-ad.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>
<body>
    <!-- Header Part Start -->
    <div class="display-ad-header">
        <a href="/" class="header-logo-a"><img src="{{ asset('assets/img/sjinside-white.png') }}" class="display-ad-header-logo"/></a>
        <a href="/" class="header-mobile-logo-a"><img src="{{ asset('assets/img/sjinside-icon-white.png') }}" class="display-ad-header-mobile-logo" /></a>
        <ul class="display-ad-header-menu">
            <li class="display-ad-header-menu-item active"><a href="/display-ad">광고 안내</a>
            <div class="menuline-active"></div></li>
            <li class="display-ad-header-menu-bar">|</li>
            <li class="display-ad-header-menu-item"><a href="/display-ad/contact">광고 문의</a>
            <div class="menuline"></div>
            </li>
        </ul>
        <!--<i class="dispay-ad-mobile-menu-icon fas fa-bars"></i>-->
    </div>

    <!-- Main Top Part Start -->
    <div class="display-ad-main-top-container">
        <div class="display-ad-main-textbox">
            <div class="display-ad-main-top-text-lg">디스플레이 광고</div>
            <div class="display-ad-main-top-text-sm">소비자 취향을 반영한 타겟팅 광고를 지금 시작하세요 !</div>
            <div class="display-ad-main-top-text-link"><a href="/display-ad/contact">광고 문의 하기 <i class="fas fa-caret-square-right"></i></a></div>
        </div>
        <img src="{{ asset('assets/img/display-main-img.png') }}" class="display-ad-main-tio-img"></img>
    </div>
    <!-- Main Top Part End -->

    <!-- Main Mid Part Start -->
    <div class="display-ad-main-mid-container">
        <div class="display-ad-main-mid">
            <sapn class="display-ad-main-mid-sub">#고효율 #추천광고</sapn>
            <div class="recombox-container">
                <div class="recombox">
                    <div class="recombox-imgbox">
                        <img src="{{ asset('assets/img/recom_img1.png') }}" class="recombox-img"></img>
                    </div>
                    <div class="recombox-textbox">
                        <span class="recombox-textbox-text-lg">갤러리 리스트 상단</span>
                        <span class="recombox-textbox-text-sm">게시글 진입 전 초입 주목도 높은 광고</span>
                    </div>
                </div>
                <div class="recombox">
                    <div class="recombox-imgbox">
                        <img src="{{ asset('assets/img/recom_img2.png') }}" class="recombox-img"></img>
                    </div>
                    <div class="recombox-textbox">
                        <span class="recombox-textbox-text-lg">갤러리 본문 자동 짤방</span>
                        <span class="recombox-textbox-text-sm">많은 트래픽이 발생하며 효율이 높은 광고</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="display-ad-main-mid">
            <sapn class="display-ad-main-mid-sub blue">#간편 #광고절차</sapn>
            <div class="display-ad-main-mid-process-container">
                <div class="display-ad-step-container">
                    <img src="{{ asset('assets/img/ad-contact.jpg') }}" alt="광고문의" class="display-ad-step-item">
                    <img src="{{ asset('assets/img/ad-contract.jpg') }}" alt="제안 및 계약" class="display-ad-step-item">
                    <img src="{{ asset('assets/img/ad-give.jpg') }}" alt="광고 소재 전달" class="display-ad-step-item">
                    <img src="{{ asset('assets/img/ad-report.jpg') }}" alt="집행 및 리포트" class="display-ad-step-item">
                </div>
            </div>
        </div>
    </div>
    <!-- Main Mid Part End -->

    <!-- Footer Part Start -->
    <div class="display-ad-footer">
        <ul class="display-ad-footer-menu">
            <li class="display-ad-footer-menu-item">회사소개</li>
            <li class="display-ad-footer-menu-bar">|</li>
            <li class="display-ad-footer-menu-item">인재채용</li>
            <li class="display-ad-footer-menu-bar">|</li>
            <li class="display-ad-footer-menu-item">제휴안내</li>
            <li class="display-ad-footer-menu-bar">|</li>
            <li class="display-ad-footer-menu-item">광고안내</li>
            <li class="display-ad-footer-menu-bar">|</li>
            <li class="display-ad-footer-menu-item">이용약관</li>
            <li class="display-ad-footer-menu-bar">|</li>
            <li class="display-ad-footer-menu-item">개인정보처리방침</li>
            <li class="display-ad-footer-menu-bar">|</li>
            <li class="display-ad-footer-menu-item">청소년보호정책</li>
        </ul>
        <span class="display-ad-footer-copyright">Copyright ⓒ 1999 - 2020 sjinside. All rights reserved.</span>
    </div>
    <!-- Footer Part End -->
</body>
</html>