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

    <link href="{{ asset('assets/css/gallery-post.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/gallery-write.css') }}" rel="stylesheet">

    <style>
      .sub_list {
        padding-left: 0px;
      }
      li {
        padding-right: 9px;
      }
      .write_sub {
        width: 100%;
        min-width: 1px;
      }
      .row .col {
        margin-right: 0px;
      }
      #title, #txt {
        width: 100%;
        min-width: 1px;
      }

      .resultName {
        float:left;
        width: 90%;
      }

      .gallerySearch {
        float:right;
        width: 10%;
        padding-top: 4px;
      }

      /*---------- 모바일 ----------*/
      @media(max-width: 672px) {
        .col {
          flex: 0 0 100%;
          max-width: 100%;
        }
        .write_sub {
          padding-right: 0px;
        }
        .write_sub .tit {
          width: 100%;
        }
        .sub_list li {
          width: 100%;
        }
        .write_warp {
          padding-left: 20px;
          padding-right: 20px;
        }
        .sub_list {
          margin-left: 0px;
          width: 100%;
          max-width: 100%;
        }
        .write_sub .sub_list li {
          margin-left: 0px;
          text-align: center;
          width: 100%;
          max-width: 100%;
        }
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
                      <div class="card-header"><i class="far fa-edit"></i>댓글 수정</div>
                      <div class="card-body">
                        <form name="form" action="{{ route('admin_comment.update', $comment->id) }}" method="post">
                          @method('PATCH')
                          @csrf
                          <div class="form-group">
                            <label for="name">댓글 내용</label>
                            <input type="text" name="content" class="form-control" id="name" value="{{ $comment->contents }}">
                            @error('name')
                                <small style="color: red!important;" id="danger" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                            <label for="name">작성자</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $comment->nouser_name }}">
                            @error('name')
                                <small style="color: red!important;" id="danger" class="form-text text-muted">{{ $message }}</small>
                            @enderror
                            <label for="name">작성일</label>
                            <input type="text" name="reg_date" class="form-control" id="name" value="{{ $comment->reg_date }}" disabled>
                          </div>
                          <button class="btn btn-warning"type="submit">수정</button>
                        </form>
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
