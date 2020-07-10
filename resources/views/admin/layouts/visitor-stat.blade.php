<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
      table {text-align: center;}

      .pagination {
        justify-content: center!important;
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
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">{{ $visitorTotalCnt }}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white">누적 방문자 수</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">{{ $visitorTodayCnt }}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white">오늘 방문자 수</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">{{ $visitorLiveCnt }}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white">현재 방문자 수</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                          <i class="fas fa-chart-area mr-1"></i>최근 한 달간 방문자 수
                            <input type="hidden" class="nowMonthDayCount" value="{{ $nowMonthDayCount }}">
                            <input type="month" class="nowMonth" value="{{ $nowMonth }}" max="9999-12" style="float:right;">
                        </div>
                        <div class="card-body"><canvas id="gSelectAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                          <i class="fas fa-table mr-1"></i>방문자 로그 ({{ $logCnt }})
                            <div style="float:right;">
                                <form name="form" action="{{ url('admin_visitor_stat') }}" method="get">
                                    <input type="text" name="keyword" value="{{ $keyword }}" placeholder="IP 검색">
                                    <input type="date" name="date" value="{{ $date }}" max="9999-12-31">
                                    <input type="submit" value="검색"> &nbsp;&nbsp;
                                </form>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>IP</th>
                                        <th>접속시간</th>
                                        <th>접속경로</th>
                                        <th>브라우저</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                      <th>id</th>
                                      <th>IP</th>
                                      <th>접속시간</th>
                                      <th>접속경로</th>
                                      <th>브라우저</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @forEach($visitors as $visitor)
                                      <tr>
                                        <td>{{ $visitor->id }}</td>
                                        <td>{{ $visitor->ip }}</td>
                                        <td>{{ $visitor->time }}</td>
                                        <td>{{ $visitor->refer }}</td>
                                        <td>{{ $visitor->agent }}</td>
                                      </tr>
                                    @endforEach
                                </tbody>
                            </table>
                        </div>
                        {{ $visitors->links() }}
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
    <script src="{{ asset('assets/admin/dist/assets/demo/visitor-stat-chart.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/datatables-demo.js') }}"></script>

</body>

</html>
