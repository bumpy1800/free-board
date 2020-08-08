<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="/">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Home
                </a>
                <div class="sb-sidenav-menu-heading">기본설정</div>
                <a class="nav-link" href="{{ route('admin_notice.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-bookmark"></i></div>
                    &nbsp;공지사항
                </a>
                <a class="nav-link" href="{{ route('admin_popup.index') }}">
                    <div class="sb-nav-link-icon"><i class="far fa-image"></i></div>
                    팝업관리
                </a>
                <a class="nav-link" href="{{ route('admin_popup2.index') }}">
                    <div class="sb-nav-link-icon"><i class="far fa-image"></i></div>
                    팝업2관리
                </a>
                <a class="nav-link" href="{{ route('admin_display-ad.index') }}">
                    <div class="sb-nav-link-icon"><i class="far fa-image"></i></div>
                    광고문의
                </a>
                <a class="nav-link" href="{{ route('admin_logo.index') }}">
                    <div class="sb-nav-link-icon"><i class="far fa-image"></i></i></div>
                    로고관리
                </a>
                <div class="sb-sidenav-menu-heading">게시판관리</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#board" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    게시판관리
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="board" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{ route('admin_category.index') }}">카테고리관리</a>
                      <a class="nav-link" href="/admin/gallery-list">갤러리관리</a>
                      <a class="nav-link" href="{{ url('admin_gallery_stat') }}">갤러리통계</a>
                      <a class="nav-link" href="{{ route('admin_post.index') }}">게시물통합관리</a>
                      <a class="nav-link" href="{{ url('admin_post_stat') }}">게시물통계</a>
                      <a class="nav-link" href="{{ route('admin_comment.index') }}">코멘트통합관리</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">회원관리</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#member" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    회원관리
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="member" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ route('user.index') }}">회원목록 </a>
                        <a class="nav-link" href="{{ route('user_wait.index') }}">인증대기회원</a>
                        <a class="nav-link" href="layout-sidenav-light.php">회원통계</a>
                        <a class="nav-link" href="{{ route('policy.index') }}">가입약관 및 개인정보 보호정책</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">접속통계</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#visit" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    접속통계
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="visit" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{ url('admin_visitor_stat') }}">접속자분석 </a>
                      <a class="nav-link" href="{{ url('admin_refer_stat') }}">접속경로분석</a>
                      <a class="nav-link" href="{{ url('admin_browser_stat') }}">브라우저</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">신고/QnA관리</div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#police" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    신고관리
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="police" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{ route('admin_singo.index') }}">신고목록</a>
                      <a class="nav-link" href="{{ route('admin_singo_wait.index') }}">보류목록</a>
                      <a class="nav-link" href="layout-static.php">신고통계</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#qna" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Q&A관리
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="qna" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                      <a class="nav-link" href="{{ route('admin_qna_category.index') }}">Q&A종류</a>
                      <a class="nav-link" href="{{ route('admin_qna.index') }}">Q&A목록</a>
                      <a class="nav-link" href="{{ url('admin_qna_stat') }}">Q&A통계</a>
                    </nav>
                </div>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">접속날짜 : </div>
            2020-04-22 21:34:59
        </div>
    </nav>
</div>
