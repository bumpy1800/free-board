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
            <a href="/"><img src="/assets/img/test.gif"></a>
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
                    <a class="nav-link" href="/" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <b>카테고리+</b>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="game-gallery">게임</a>
                        <a class="dropdown-item" href="enter-gallery">연예/방송</a>
                        <a class="dropdown-item" href="sports-gallery">스포츠</a>
                        <a class="dropdown-item" href="edu-gallery">교육/금융/IT</a>
                        <a class="dropdown-item" href="travel-gallery">여행/음식/생물</a>
                        <a class="dropdown-item" href="hobby-gallery">취미/생활</a>
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
