<div class="top">
  <div class="home">
    <a href="/">SJ인사이드 메인가기 ▶</a>
  </div>
  <div class="sub">
    <span><a href="{{ route('gallery.index') }}">갤러리</a></span>
    <span class="mLine">|</span>
    <span><a href="/">이벤트</a></span>
    <span><a class="btn" href="{{ url('auth/logout') }}">로그아웃</a></span>
  </div>
  <div class="clear"></div>

  <div class="top-box">
    <div class="who">
      <span><b class="id">{{ $user->nick }}({{ $user->uid }})</b> 님의 갤로그입니다.</span>
    </div>
    <div class="result">
      <div class="result-box">
        <span>Today <b>1</b></span>
        <span class="mLine">|</span>
        <span>Total <b>18218</b></span>
        <span class="mLine">|</span>
        <span><i class="far fa-calendar-alt"></i></span>
        <span class="mLine">|</span>
        <span><i class="fas fa-cog"></i></span>
      </div>
    </div>
    <div class="clear"></div>
  </div>
</div>

<div class="menus">
    @if($menu_active == 1)
        <a href="{{ url('gallog') }}/{{ $user->uid }}" id="gallog" class="btn active">갤로그 홈</a>
        <a href="{{ url('gallog-post') }}/{{ $user->uid }}" id="gallog2" class="btn">내 게시글</a>
        <a href="{{ url('gallog-comment') }}/{{ $user->uid }}" id="gallog3" class="btn">내 댓글</a>
        <a href="{{ url('gallog-scrap') }}/{{ $user->uid }}" id="gallog4"class="btn">스크랩</a>
        <a href="{{ url('gallog-guestbook') }}/{{ $user->uid }}" id="gallog5" class="btn">방명록</a>
    @elseif($menu_active == 2)
        <a href="{{ url('gallog') }}/{{ $user->uid }}" id="gallog" class="btn">갤로그 홈</a>
        <a href="{{ url('gallog-post') }}/{{ $user->uid }}" id="gallog2" class="btn active">내 게시글</a>
        <a href="{{ url('gallog-comment') }}/{{ $user->uid }}" id="gallog3" class="btn">내 댓글</a>
        <a href="{{ url('gallog-scrap') }}/{{ $user->uid }}" id="gallog4"class="btn">스크랩</a>
        <a href="{{ url('gallog-guestbook') }}/{{ $user->uid }}" id="gallog5" class="btn">방명록</a>
    @elseif($menu_active == 3)
        <a href="{{ url('gallog') }}/{{ $user->uid }}" id="gallog" class="btn">갤로그 홈</a>
        <a href="{{ url('gallog-post') }}/{{ $user->uid }}" id="gallog2" class="btn">내 게시글</a>
        <a href="{{ url('gallog-comment') }}/{{ $user->uid }}" id="gallog3" class="btn active">내 댓글</a>
        <a href="{{ url('gallog-scrap') }}/{{ $user->uid }}" id="gallog4"class="btn">스크랩</a>
        <a href="{{ url('gallog-guestbook') }}/{{ $user->uid }}" id="gallog5" class="btn">방명록</a>
    @elseif($menu_active == 4)
        <a href="{{ url('gallog') }}/{{ $user->uid }}" id="gallog" class="btn">갤로그 홈</a>
        <a href="{{ url('gallog-post') }}/{{ $user->uid }}" id="gallog2" class="btn">내 게시글</a>
        <a href="{{ url('gallog-comment') }}/{{ $user->uid }}" id="gallog3" class="btn">내 댓글</a>
        <a href="{{ url('gallog-scrap') }}/{{ $user->uid }}" id="gallog4"class="btn active">스크랩</a>
        <a href="{{ url('gallog-guestbook') }}/{{ $user->uid }}" id="gallog5" class="btn">방명록</a>
    @else
        <a href="{{ url('gallog') }}/{{ $user->uid }}" id="gallog" class="btn">갤로그 홈</a>
        <a href="{{ url('gallog-post') }}/{{ $user->uid }}" id="gallog2" class="btn">내 게시글</a>
        <a href="{{ url('gallog-comment') }}/{{ $user->uid }}" id="gallog3" class="btn">내 댓글</a>
        <a href="{{ url('gallog-scrap') }}/{{ $user->uid }}" id="gallog4"class="btn">스크랩</a>
        <a href="{{ url('gallog-guestbook') }}/{{ $user->uid }}" id="gallog5" class="btn active">방명록</a>
    @endif
</div>
