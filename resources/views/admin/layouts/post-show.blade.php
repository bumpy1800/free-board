<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="{{ asset('assets/admin/dist/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>

    <!-- smart editor -->
    <script type="text/javascript" src="{{ asset('assets/smarteditor2/js/HuskyEZCreator.js') }}"></script>
    <script>
    window.onload=function(){
        console.log("window onload ");
    }

    </script>

    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/gallery.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/gallery-post.css') }}" rel="stylesheet">

    <style>
      #rep_box {
        border: 0px;
      }
    </style>
</head>

<body class="sb-nav-fixed">
    @yield('nav_header')
    <div id="layoutSidenav">
        @yield('sidenav_header')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">관리자님 환영합니다.</h1>
                    <div class="card mb-4">
                        <div class="card-header"><i class="far fa-edit"></i>게시글 수정</div>
                        <div class="card-body">
                          <div class="gallery-top">
                  					<h4 class="title"><b>{{ $post->gallery_name }}</b></h4>
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

                                  <div class="post_view">
                                      <header>
                                          <div class="view_head">
                                              <h3 class="view_title">
                                                  <span class="view_headtext">[{{ $post->head }}]</span>
                                                  <span class="view_subtitle">{{ $post->title }}</span>
                                                  <span class="post_device">
                                                      <i class="fas fa-mobile-alt blue"></i>
                                                  </span>
                                              </h3>
                                              <div class="post_writer">
                                                  <div class="left">
                                                      <span class="post_nick">작성자</span>
                                                      <span class="ip">(IP)</span>
                                                      <span class="view_date">{{ $post->reg_date }}</span>
                                                  </div>
                                                  <div class="right pdL6">
                                                      <span class="view_count">조회 수 {{ $post->view }}</span>
                                                      <span class="view_good">추천 수 {{ $post->good }}</span>
                                                      <span class="view_comment">댓글 수 {{ $post->comments }}</span>
                                                  </div>
                                              </div>
                                          </div>
                                      </header>
                  					<div class="post_content">
                  						<div class="inner_content">
                  								<div class="view_content" style="overflow:hidden;">
                  									<div>
                  										<span>{!! $post->contents !!}</span>
                  									</div>
                  									<span>-모바일로 작성</span>
                  							</div>
                  							<div class="right"></div>
                  						</div>
                  						<div class="recommend_box clear">
                  							<div class="inner left">
                  								<div class="up_box">
                  									<p class="red">0</p>
                  								</div>
                  								<button class="up_btn" type="button" name="button"><img src="/assets/img/good.png" alt="추천"></button>
                  							</div>
                  							<div class="inner right">
                  								<button class="down_btn" type="button" name="button"><img src="/assets/img/bad.png" alt="비추"></button>
                  								<div class="down_box">
                  									<p>0</p>
                  								</div>
                  							</div>
                  							<div class="recom_bottom_box">
                  								<button class="hitgal" type="button" name="button"><i class="fas fa-crown gray pdR6 fa-lg"></i>힛추</button>
                  								<button class="share" type="button" name="button"><i class="fas fa-share-alt gray pdR6 fa-lg"></i>공유</button>
                  								<button class="report" type="button" name="button"><i class="fas fa-concierge-bell gray pdR6 fa-lg"></i>신고</button>
                  							</div>
                  						</div>
                  						<div class="clear"></div>
                  					</div>
                                  </div>
                  				<div class="cmt_box clear">
                  					<div class="comment_warp">
                  						<div class="comment_num">
                  							<div class="left num_box">
                  								전체 리플 <span class="red">{{ $post->comments }}</span> 개
                  								<select class="comment_sort" name="sort">
                  									<option value="1">등록순</option>
                  									<option value="2">최신순</option>
                  									<option value="3">답글순</option>
                  								</select>
                  							</div>
                  							<div class="right">
                  								<button class="btn_cmt_close" type="button" name="button">댓글닫기<i class="fas fa-caret-up pdL6"></i></button>
                  								<button class="btn_cmt_refresh" type="button" name="button">새고로침</button>
                  							</div>
                  						</div>
                  					</div>
                  					<div class="comment_box">
                  						<ul class="cmt_list">
                                @foreach($comments as $comment)
                                  @if($comment->id % 100 == 0)
                      							<li>
                      								<div class="cmt_info clear">
                      									<div class="cmt_nick">
                      										<span class="writer">
                      											<span class="cmt_nickname">
                      												{{ $comment->nouser_name }}
                      											</span>
                      											<span class="cmt_ip">(IP)</span>
                      										</span>
                      									</div>
                      									<div class="left">
                      										<p class="user_txt">
                      											<a onclick="rep_form({{ $comment->id }});">
                      												{{ $comment->contents }}
                      											</a>
                      										</p>
                      									</div>
                      									<div class="right">
                      										<span class="cmt_date">{{ $comment->reg_date }}</span>
                      									</div>
                      								</div>
                                    </li>
                                    <form method="post" action="{{ route('admin_comment.store') }}">
                                      @method('POST')
                                      @csrf
                                      <input type="hidden" name="post_gallery_link" value="{{ $post->gallery_link }}">
                                      <input type="hidden" name="postId" value="{{ $post->id }}">
                                      <input type="hidden" name="commentId" value="{{ $comment->id }}">
                                      <div class="reply_box" style="display:none;" id="{{ $comment->id }}"></div>
                                    </form>
                                    <script>
                                      function rep_form(id){
                                        $('#'+id).html("<div id='rep_box' class='cmt_write_box'> <div class='left'> <div class='user_info_input'> <input type='text' name='name' placeholder='닉네임' value='' maxlength='20'> </div> <div class='user_info_input'> <input type='password' name='password' placeholder='비밀번호' value='' maxlength='20'> </div> </div> <div class='cmt_txt right'> <div class='cmt_write'> <textarea name='content' maxlength='400' placeholder='타인의 권리를 침해하거나 명예를 훼손하는 댓글은 운영원칙 및 관련 법률에 제재를 받을 수 있습니다.&#13;&#10;Shift+Enter 키를 동시에 누르면 줄바꿈이 됩니다.'></textarea> </div> <div class='cmt_txt_bot'> <div class='right'> <button class='btn_save btn_blue' type='submit' name='button'>등록</button> </div> </div> </div> </div>");
                                        if($('#'+id).css("display") == "none") {
                                          $('#'+id).show();
                                        } else {
                                          $('#'+id).hide();
                                        }
                                      }
                                    </script>
                                  @else
                                    <li>
                      								<div class="reply show">
                      									<div class="reply_box">
                      										<ul class="reply_list">
                      											<li>
                      												<div class="reply_info">
                      													<div class="cmt_nikbox">
                      														<span class="writer">
                      															<span class="cmt_nickname">
                      																{{ $comment->nouser_name }}
                      															</span>
                      															<span class="cmt_ip">(IP)</span>
                      														</span>
                      													</div>
                      													<div class="left">
                      														<p class="user_txt">
                      															<a onclick="rep_form({{ $comment->id }});">
                      																<i class="fas fa-level-up-alt fa-rotate-90" style="width:15px;"></i>{{ $comment->contents }}
                      															</a>
                      														</p>
                      													</div>
                      													<div class="right">
                      														<span class="cmt_date">{{ $comment->reg_date }}</span>
                      													</div>
                      												</div>
                      											</li>
                      										</ul>
                      									</div>
                      								</div>
                      							</li>
                                    <li>
                                      <form method="post" action="{{ route('admin_comment.store') }}">
                                        @method('POST')
                                        @csrf
                                        <input type="hidden" name="post_gallery_link" value="{{ $post->gallery_link }}">
                                        <input type="hidden" name="postId" value="{{ $post->id }}">
                                        <input type="hidden" name="commentId" value="{{ $comment->id }}">
                                        <div class="reply_box" style="display:none;" id="{{ $comment->id }}"></div>
                                      </form>
                                    </li>
                                  @endif
                                @endforeach
                  						</ul>
                  					</div>
                            <form method="post" action="{{ route('admin_comment.store') }}">
                              @method('POST')
                              @csrf
                              <input type="hidden" name="post_gallery_link" value="{{ $post->gallery_link }}">
                              <input type="hidden" name="postId" value="{{ $post->id }}">
                    					<div class="cmt_write_box">
                    						<div class="left">
                    							<div class="user_info_input">
                    								<input type="text" name="name" placeholder="닉네임" value="" maxlength="20">
                    							</div>
                    							<div class="user_info_input">
                    								<input type="password" name="password" placeholder="비밀번호" value="" maxlength="20">
                    							</div>
                    						</div>
                    						<div class="cmt_txt right">
                    							<div class="cmt_write">
                    								<textarea name="content" maxlength="400" placeholder="타인의 권리를 침해하거나 명예를 훼손하는 댓글은 운영원칙 및 관련 법률에 제재를 받을 수 있습니다.&#13;&#10;Shift+Enter 키를 동시에 누르면 줄바꿈이 됩니다."></textarea>
                    							</div>
                    							<div class="cmt_txt_bot">
                    								<div class="right">
                    									<button class="btn_save btn_blue" type="submit" name="button">등록</button>
                    									<button class="btn_save_good btn_lightBlue" type="submit" name="button">등록+추천</button>
                    								</div>
                    							</div>
                    						</div>
                    					</div>
                            </form>
                  				</div>
                  				<div class="cmt_btnbox">

                  					<div class="right">
                  						<button class="btn_update btn_gray" type="button" name="button">수정</button>
                  						<button class="btn_delete btn_gray" type="button" name="button">삭제</button>
                  						<button class="btn_create btn_blue" type="button" name="button">글쓰기</button>
                  					</div>
                  				</div>
                        </div>
                    </div>
                </div>
            </main>
            @yield('footer')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/js/scripts.js') }}"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/chart-bar-demo.js') }}"></script>-->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/datatables-demo.js') }}"></script>
</body>

</html>
