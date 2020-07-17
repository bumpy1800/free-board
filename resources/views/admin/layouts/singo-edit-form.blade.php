$Singo<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="{{ asset('assets/admin/dist/css/styles.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
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
                        <div class="card-header">
                          <i class="fas fa-pencil-alt"></i>
                          {{ $Singo->title }} 신고내용
                        </div>

                        <div class="card-body">
                          <form name="form" action="{{ route('admin_singo.update', $Singo->id) }}" method="post">
                            @METHOD('PATCH')
                            @csrf
                            <div class="row">
                                <div class="form-group col-6">
                                  <label for="title">신고 제목</label>
                                  <input type="text" name="title" class="form-control" id="title" value="{{ $Singo->title }}" disabled>
                                </div>
                                <div class="form-group col-3">
                                  <label for="category">분류</label>
                                  <input type="text" name="category" class="form-control" id="category" value="{{ $Singo->category_id }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-5">
                                  <label for="post">해당 게시글</label>
                                  <input type="text" name="post" class="form-control" id="post" value="{{ $Singo->post_id }}" disabled>
                                </div>
                                <div class="form-group col-2">
                                  <label for="writer">게시글 작성자</label>
                                  <input type="text" name="writer" class="form-control" id="writer" value="{{ $Singo->post_writer }}" disabled>
                                </div>
                                <div class="form-group col-2">
                                  <label for="reporter">신고자</label>
                                  <input type="text" name="reporter" class="form-control" id="reporter" value="{{ $Singo->reporter }}" disabled>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-9">
                                  <label for="content">신고 내용</label>
                                  <textarea class="form-control" id="content" name="content" disabled>{{ $Singo->content }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-9">
                                  <label for="solution">답변</label>
                                  <textarea class="form-control" id="solution" name="solution">{{ $Singo->solution }}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-3">
                                  <label for="status">처리 상태</label>
                                  <input type="text" name="status" class="form-control" id="status" value="{{ $Singo->status }}" disabled>
                                </div>
                            </div>
                        </form>
                        <button class="btn btn-warning left mLine" type="submit">답변완료</button>
                        <form name="form" action="/admin/singo-wait/{{ $Singo->id }}" method="post">
                          @METHOD('PATCH')
                          @csrf
                            <button class="btn btn-primary left mLine" type="submit">보류</button>
                        </form>
                        <form class="" action="{{ route('admin_singo.destroy', $Singo->id) }}" method="post">
                            @METHOD('DELETE')
                            @csrf
                            <button class="btn btn-danger left mLine" type="submit">삭제</button>
                        </form>
                            <button class="btn btn-warning mLine" type="button" onClick="history.go(-1)">이전</button>

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
