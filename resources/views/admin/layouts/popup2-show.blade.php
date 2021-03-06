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
                        <div class="card-header"><i class="fas fa-eye"></i></i>{{ $popup->name }} 팝업</div>
                        <div class="card-body">
                          <form name="form">
                            @csrf
                            <div class="form-group">
                              <label for="name">팝업명</label>
                              <input type="text" name="name" class="form-control" id="name" value="{{ $popup->name }}" disabled>
                            </div>
                            <div class="form-group">
                              <label for="image">파일</label>
                              <img src="data:image/png;base64,{{ $image }}" alt="title" />
                            </div>
                            <div class="form-group">
                              <div for="heads">상태여부</div>
                              @if($popup->status == 1)
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="agree" id="agree" value="1" checked disabled>
                                  <label class="form-check-label" for="agree">광고중</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="agree" id="noagree" value="0" disabled>
                                  <label class="form-check-label" for="noagree">광고중지</label>
                                </div>
                              @else
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="agree" id="agree" value="1" disabled>
                                  <label class="form-check-label" for="agree">광고중</label>
                                </div>
                                <div class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="agree" id="noagree" value="0" checked disabled>
                                  <label class="form-check-label" for="noagree">광고중지</label>
                                </div>
                              @endif
                            </div>
                            <a class="btn btn-warning" href="{{ route('admin_popup2.edit', $popup->id) }}">수정</a>
                            <form action="{{ route('admin_popup2.destroy', $popup->id) }}" method="POST">
                              @method('DELETE')
                              @csrf
                              <button id="del" class="btn btn-danger">삭제</button>
                            </form>
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
