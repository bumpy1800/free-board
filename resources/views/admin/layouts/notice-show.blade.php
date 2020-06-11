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

      .cmt_btnbox #btn {
        padding-left: 0px!important;
        padding-right: 0px!important;
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
                        <div class="card-header"><i class="far fa-edit"></i>공지사항 수정</div>
                        <div class="card-body">
                          <div class="gallery-top">
                  					<h4 class="title"><b>{{ $notice->gallery_name }}</b></h4>
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
                                          <span class="view_subtitle">{{ $notice->title }}</span>
                                          <span class="post_device">
                                              <i class="fas fa-mobile-alt blue"></i>
                                          </span>
                                      </h3>
                                      <div class="post_writer">
                                          <div class="left">
                                              <span class="post_nick">관리자</span>
                                              <span class="view_date">{{ $notice->reg_date }}</span>
                                          </div>
                                          <div class="right pdL6">
                                              <span class="view_count">조회 수 {{ $notice->view }}</span>
                                          </div>
                                      </div>
                                  </div>
                              </header>
                    					<div class="post_content">
                    						<div class="inner_content">
                    								<div class="view_content" style="overflow:hidden;">
                    									<div>
                    										<span>{!! $notice->contents !!}</span>
                    									</div>
                    							</div>
                    							<div class="right"></div>
                    						</div>
                    						<div class="clear"></div>
                    					</div>
                          </div>
                  				<div class="cmt_btnbox">
                  					<div class="right">
                  						<button class="btn_update btn_gray" id="btn" type="button" name="button">수정</button>
                  						<button class="btn_delete btn_gray" id="btn" type="button" name="button">삭제</button>
                  						<button class="btn_create btn_blue" id="btn" type="button" name="button">글쓰기</button>
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
