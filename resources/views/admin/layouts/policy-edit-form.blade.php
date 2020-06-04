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
                <div class="container-flname">
                    <h1 class="mt-4">관리자님 환영합니다.</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                          <i class="fas fa-pencil-alt"></i>
                          {{ $Policy->name }}님 정보수정
                        </div>
                        <div class="card-body">
                              <form name="form" action="{{ route('policy.update', $Policy->id) }}" method="post">
                                @METHOD('PATCH')
                                @csrf
                                <div class="form-group">
                                  <label for="name">정책명</label>
                                  <input type="text" name="name" class="form-control" id="name" value="{{ $Policy->name }}">
                                  @error('name')
                                      <small style="color: red!important;" id="danger" class="form-text text-muted">{{ $message }}</small>
                                  @enderror
                                </div>
                                <div class="form-group">
                                  <label for="content">정책 내용</label>
                                  <input type="text" name="content" class="form-control" id="content" value="{{ $Policy->content }}">
                                  @error('content')
                                      <small style="color: red!important;" id="danger" class="form-text text-muted">{{ $message }}</small>
                                  @enderror
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
