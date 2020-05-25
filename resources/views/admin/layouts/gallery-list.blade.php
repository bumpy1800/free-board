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
                        <div class="card-header"><i class="fas fa-table mr-1"></i>갤러리 목록</div>
                        <a class="btn btn-warning" href="/admin/gallery-add-form">등록테스트</a>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>약자</th>
                                            <th>갤러리이름</th>
                                            <th>카테고리</th>
                                            <th>링크</th>
                                            <th>설명</th>
                                            <th>이유</th>
                                            <th>머리글</th>
                                            <th>허가</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>약자</th>
                                            <th>갤러리이름</th>
                                            <th>카테고리</th>
                                            <th>링크</th>
                                            <th>설명</th>
                                            <th>이유</th>
                                            <th>머리글</th>
                                            <th>허가</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($gallerys as $gallery)
                                          <tr>
                                            <td>{{ $gallery->id }}</td>
                                            <td><a href="/admin/gallery-show/{{ $gallery->id }}">{{ $gallery->s_name }}</a></td>
                                            <td>{{ $gallery->name }}</td>
                                            <td>{{ $gallery->category_id }}</td>
                                            <td>{{ $gallery->link }}</td>
                                            <td>{{ $gallery->contents }}</td>
                                            <td>{{ $gallery->reason }}</td>
                                            <td>{{ $gallery->heads }}</td>
                                            <td>{{ $gallery->agree }}</td>
                                            <td><a class="Btn" href="/admin/gallery-edit-form/{{ $gallery->id }}">수정</a></td>
                                            <td><a class="Btn" href="/admin/gallery-destroy/{{ $gallery->id }}">삭제</a></td>
                                          </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/chart-bar-demo.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/datatables-demo.js') }}"></script>
</body>

</html>
