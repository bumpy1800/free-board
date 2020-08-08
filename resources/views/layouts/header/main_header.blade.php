        <!-- 모바일 화면
        <div class="etc">
            <a class="mb_menu" href="register">회원가입</a>
            <a class="mb_menu" href="login">로그인</a>
            <a class="mb_menu" href="login">로그아웃</a>
        </div>
        -->
        
        <div class="mobile-login-box">
            <span id="btn-mobile-login">Login</span>
        </div>
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
					@if(Auth::check())
						<li class="header-menu-item"><a href="{{ url('gallog') }}/{{ Auth::user()->nick }}">갤로그</a></li>
                    @else
						<li class="header-menu-item"><a id="noUser" href="/">갤로그</a></li>
                    @endif
                    <li class="header-menu-item"><a href="event">이벤트</a></li>
                    <li class="header-menu-item"><a href="report">신고 / Q&A</a></li>
                </ul>
                <div class="header-yesterday-info">
                    <div class="yesterday-writing">어제<B class="yesterday-info-number yellow">{{ number_format($yPostCnt) }}개</B>게시글 등록</div>
                    <div class="yesterday-comment down">어제<B class="yesterday-info-number blue">{{ number_format($yCommentCnt) }}개</B>댓글 등록</div>
                </div>
            </div>
        </div>
