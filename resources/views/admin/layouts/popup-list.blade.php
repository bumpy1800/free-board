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

      .menu_list {
        float: right;
      }
      #menu_list {
        padding-top: 0px; padding-bottom: 0px;
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
                        <div class="card-header"><i class="fas fa-table mr-1"></i>팝업 목록
                          <div class="menu_list">
                            <div style="float: left;">
                              <a id="menu_list"class="btn btn-warning" href="{{ route('admin_popup_category.index') }}">종류관리</a>
                            </div>
                            <div style="margin-left: 10px; float: left;">
                              <a id="menu_list"class="btn btn-warning" href="{{ route('admin_popup.create') }}">등록</a>
                            </div>
                          </div>
                          <div style="clear: both;"></div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                          <th>id</th>
                                          <th>종류</th>
                                          <th>팝업명</th>
                                          <th>등록일</th>
                                          <th>상태</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                          <th>id</th>
                                          <th>종류</th>
                                          <th>팝업명</th>
                                          <th>등록일</th>
                                          <th>상태</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($popups as $popup)
                                          <tr>
                                            <td>{{ $popup->id }}</td>
                                            <td><a href="{{ route('admin_popup_category.show', $popup->category) }}">{{ $popup->category }}</a></td>
                                            <td><a href="{{ route('admin_popup.show', $popup->id) }}">{{ $popup->name }}</a></td>
                                            <td>{{ $popup->reg_date }}</td>
                                            @if($popup->status == 0)
                                              <td style="color: red;">광고중지</td>
                                            @else
                                              <td>광고중</td>
                                            @endif
                                            <td><a id="edit" class="btn btn-warning" href="{{ route('admin_popup.edit', $popup->id) }}">수정</a></td>
                                            <td>
                                              <form action="{{ route('admin_popup.destroy', $popup->id) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button id="del" class="btn btn-danger">삭제</button>
                                              </form>
                                            </td>
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
