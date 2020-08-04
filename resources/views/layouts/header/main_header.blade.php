<!DOCTYPE html>
<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
    	<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/sjinside-icon-white.png') }}"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@800&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
		<script src="{{ asset('assets/js/jquery-3.4.1.js') }}"></script>
		<script src="{{ asset('assets/js/visitor.js') }}"></script>
        <script defer src="{{ asset('assets/js/header.js') }}"></script>
		<script src="{{ asset('assets/js/main.js') }}"></script>
	</head>
	<body>
        <!--
        <div class="etc">
            <a class="mb_menu" href="register">회원가입</a>
            <a class="mb_menu" href="login">로그인</a>
            <a class="mb_menu" href="login">로그아웃</a>
        </div>
        -->
        <div class="header-container">
            <div class="main-header">
                <a href="/" class="logo"><img src="{{ asset('assets/img/sjinside-main-logo.png') }}" class="logo-img"></a>
                <div class="search-box">
                    <div class="todayIsue-box">
                        <div class="todayIsue">
                            <span class="todayIsue-title">오늘의 이슈</span>
                            <ul class="todayIsue-menu">
                                <li class="todayIsue-item">일본 화산</li>
                                <li class="todayIsue-bar">|</li>
                                <li class="todayIsue-item">오지환</li>
                                <li class="todayIsue-bar">|</li>
                                <li class="todayIsue-item">박상철</li>
                                <li class="todayIsue-bar">|</li>
                                <li class="todayIsue-item">이지현</li>
                            </ul>
                        </div>
                        <div class="todayIsue-btn-box">
                            <button class="btn-todayIsue-left">◀</button>
                            <button class="btn-todayIsue-right">▶</button>
                        </div>
                    </div>
                    <div class="search-line">
                        <input type="text" placeholder="갤러리 & 통합검색" class="search-space" />
                        <button class="btn-search"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-category-container">
            <div class="use-space">
                <ul class="header-menu">
                    <li class="header-menu-item">
                        <span class="btn-dropdown">카테고리 +</span>
                        <div class="header-dropdown-menu none">
                                <a class="header-dropdown-menu-item" href="{{ url('game-gallery') }}">게임</a>
                                <a class="header-dropdown-menu-item" href="{{ url('enter-gallery') }}">연예/방송</a>
                                <a class="header-dropdown-menu-item" href="{{ url('sports-gallery') }}">스포츠</a>
                                <a class="header-dropdown-menu-item" href="{{ url('edu-gallery') }}">교육/금융/IT</a>
                                <a class="header-dropdown-menu-item" href="{{ url('travel-gallery') }}">여행/음식/생물</a>
                                <a class="header-dropdown-menu-item" href="{{ url('hobby-gallery') }}">취미/생활</a>
                        </div>
                    </li>
                    <li class="header-menu-item"><a href="{{ route('gallery.index') }}">갤러리</a></li>
                    <li class="header-menu-item"><a href="gallog">갤로그</a></li>
                    <li class="header-menu-item"><a href="report">신고 / Q&A</a></li>
                </ul>
                <div class="header-yesterday-info">
                    <div class="yesterday-writing">어제<B class="yesterday-info-number yellow">889,521개</B>게시글 등록</div>
                    <div class="yesterday-comment down">어제<B class="yesterday-info-number blue">2,409,528개</B>댓글 등록</div>
                </div>
            </div>
        </div>


        <!--
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
                                <a class="dropdown-item" href="{{ url('game-gallery') }}">게임</a>
                                <a class="dropdown-item" href="{{ url('enter-gallery') }}">연예/방송</a>
                                <a class="dropdown-item" href="{{ url('sports-gallery') }}">스포츠</a>
                                <a class="dropdown-item" href="{{ url('edu-gallery') }}">교육/금융/IT</a>
                                <a class="dropdown-item" href="{{ url('travel-gallery') }}">여행/음식/생물</a>
                                <a class="dropdown-item" href="{{ url('hobby-gallery') }}">취미/생활</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('gallery.index') }}"><b>갤러리</b></a>
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
-->
