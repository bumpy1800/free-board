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
                    <div class="row">
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">{{ $galleryTotalCnt }}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white">전체 갤러리 수</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">{{ $galleryTodayCnt }}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white">오늘 갤러리 생성 수</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body">{{ $galleryNoAgreeCnt }}</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <div class="small text-white">갤러리 승인대기 수</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                          <i class="fas fa-chart-area mr-1"></i>최근 한 달간 갤러리 생성 수
                            <input type="hidden" class="nowMonthDayCount" value="{{ $nowMonthDayCount }}">
                            <input type="month" class="nowMonth" value="{{ $nowMonth }}" max="9999-12" style="float:right;">
                        </div>
                        <div class="card-body"><canvas id="gSelectAreaChart" width="100%" height="40"></canvas></div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-chart-area mr-1"></i>최근 갤러리 생성 수</div>
                                <div class="card-body"><canvas id="gDayAreaChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-chart-bar mr-1"></i>한 달 갤러리 생성 수</div>
                                <div class="card-body"><canvas id="gMonthBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                          <i class="fas fa-chart-pie mr-1"></i>카테고리별 갤러리 수
                          <small>(갤러리 수가 가장 높은 순으로 10개만 보여집니다.)</small>
                          <select style="float: right;" class="category_id">
                            <option value="0">전체</option>
                            @foreach ($categorys as $category)
                              <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="card-body"><canvas id="pieChart" width="100%" height="40"></canvas></div>
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
    <script src="{{ asset('assets/admin/dist/assets/demo/gallery-stat-chart.js') }}"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/datatables-demo.js') }}"></script>

</body>

</html>
