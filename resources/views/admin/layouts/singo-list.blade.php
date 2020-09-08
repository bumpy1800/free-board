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

    <style>
      #edit, #del {padding-top: 0px; padding-bottom: 0px;}
      table {text-align: center;}

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
                        <div class="card-header"><i class="fas fa-table mr-1"></i>신고 목록
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>분류</th>
                                            <th>게시글</th>
                                            <th>작성자</th>
                                            <th>신고자</th>
                                            <th>신고날짜</th>
                                            <th>제목</th>
                                            <th>신고내용</th>
                                            <th>답변</th>
                                            <th>상태</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>id</th>
                                            <th>분류</th>
                                            <th>게시글</th>
                                            <th>작성자</th>
                                            <th>신고자</th>
                                            <th>신고날짜</th>
                                            <th>제목</th>
                                            <th>신고내용</th>
                                            <th>답변</th>
                                            <th>상태</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($Singos as $singo)
                                          <tr>
                                            <td>{{ $singo->id }}</td>
                                            <td>{{ $singo->singo_category_name }}</td>
                                            <td><a href="{{ route('admin_singo.edit', $singo->id) }}">{{ $singo->post_title }}</a></td>
                                            <td>{{ $singo->writer }}</td>
                                            <td>{{ $singo->user_reporter }}</td>
                                            <td>{{ $singo->reg_date }}</td>
                                            <td>{{ $singo->title }}</td>
                                            <td>{{ $singo->content }}</td>
                                            <td>{{ $singo->solution }}</td>
                                            @if($singo->status == -1)
                                                <td>보류</td>
                                            @elseif($singo->status == 1)
                                                <td>답변대기중</td>
                                            @elseif($singo->status == 2)
                                                <td>답변완료</td>
                                            @else
                                                <td>에러</td>
                                            @endif
                                            <form name="form" action="/admin/singo-wait/{{ $singo->id }}" method="post">
                                              @METHOD('PATCH')
                                              @csrf
                                                <td><button id="edit" type="submit" class="btn btn-warning">보류</button></td>
                                            </form>
                                            <form class="" action="{{ route('admin_singo.destroy', $singo->id) }}" method="post">
                                                @METHOD('DELETE')
                                                @csrf
                                                <td><button type="submit" id="del" class="btn btn-danger">삭제</button></td>
                                            </form>
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
  <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/chart-bar-demo.js') }}"></script>-->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/datatables-demo.js') }}"></script>
</body>

</html>
