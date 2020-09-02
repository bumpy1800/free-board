
        @if(Auth::check())
            <form action="{{ url('auth/logout') }}" method="post" class="mobile-login-box">
                @method('POST')
                @csrf
                <button type="submit" id="btn-mobile-logout">Logout</button>
            </form>
        @else
            <div class="mobile-login-box">
                <button id="btn-mobile-login">Login</button>
            </div>
        @endif

		<div class="back-cover">
			<form action="{{ url('auth/login') }}" method="post" class="mobile-login-form">
			@method('POST')
			@csrf
				<i class="fas fa-times"></i>
				<div class="mobile-login-title">sjinside 로그인</div>
				<div class="mobile-login-input">
					<input name="user_id" type="text" class="mobile-login-id" placeholder="아이디" value="{{ Cookie::get('save_id') }}"/>
					<input name="user_pw" type="text" class="mobile-login-pw" placeholder="비밀번호" value=""/>
				</div>
				<div class="mobile-login-save-box">
					<input type="checkbox" class="btn-mobile-idcheck">
					<span>아이디 저장</span>
				</div>
				<button type="submit" class="btn-mobile-login">로그인</button>
				<div class="mobile-login-etc">
					<button>아이디ㆍ비밀번호 찾기</button>
					<span>계정이 없으신가요?<button>회원가입</button></span>
				</div>
			</form>
		</div>

        <div class="header-container">
            <div class="main-header">
                <a href="/" class="logo"><img src="{{ asset('assets/img/sjinside-main-logo.png') }}" class="logo-img"></a>
                <div class="search-box">
                    <div class="todayIsue-box">
                        <div class="todayIsue">
                            <span class="todayIsue-title">오늘의 이슈</span>
                            <ul class="todayIsue-menu">
                                @php
                                    $i = 0;
                                @endphp
                                @foreach($issues as $issue)
                                    @if($i < 4)
                                        <li id="issue{{ $i }}" class="todayIsue-item fir-issue">{{ $issue->keyword }}</li>
                                        @if($i % 4 != 3)
                                            <li class="todayIsue-bar fir-issue">|</li>
                                        @endif
                                    @else
                                        <li id="issue{{ $i }}" class="todayIsue-item sec-issue">{{ $issue->keyword }}</li>
                                        @if($i % 4 != 3)
                                            <li class="todayIsue-bar sec-issue">|</li>
                                        @endif
                                    @endif
                                    @php
                                        $i ++;
                                    @endphp
                                @endforeach
                            </ul>
                        </div>
                        <div class="todayIsue-btn-box">
                            <button class="btn-todayIsue-left">◀</button>
                            <button class="btn-todayIsue-right">▶</button>
                        </div>
                    </div>
                    <form action="{{ route('issue.store') }}" method="post">
                        @method('POST')
                        @csrf
                        <div class="search-line">
                            <input type="text" placeholder="{{ isset($keyword) ? $keyword : '갤러리 & 통합검색' }}" name="search-keyword" class="search-space" />
                            <button class="btn-search"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
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
