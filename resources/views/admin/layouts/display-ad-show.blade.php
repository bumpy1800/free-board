<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('title')</title>
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/admin/dist/css/styles.css') }}" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<style>
    .contact-box {
        margin: 0px;
        width: 100%;
        max-width: none;
    }
    .contact-form-filebox {
        width: 85%;
    }
</style>


<body class="sb-nav-fixed">
    @yield('nav_header')
    <div id="layoutSidenav">
        @yield('sidenav_header')
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4">관리자님 환영합니다.</h1>
                    <div class="card mb-4">
                        <div class="card-header"><i class="fas fa-eye"></i></i> 광고 문의</div>
                        <div class="card-body">
                            <div class="contact-box">
                                <ul class="contact-form">
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">문의 유형<span class="red">*</span></div>
                                        <input name="co_name" type="text" value="{{ $displayad->category }}" class="contact-form-writespace"/ disabled>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">회사명<span class="red">*</span></div>
                                        <input name="co_name" type="text" value="{{ $displayad->co_name }}" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">담당자명<span class="red">*</span></div>
                                        <input name="director" type="text" value="{{ $displayad->director }}" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">연락처<span class="red">*</span></div>
                                        <input name="phone" type="text" value="{{ $displayad->phone }}" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">이메일<span class="red">*</span></div>
                                        <input name="email" type="text" value="{{ $displayad->email }}" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">업체 구분<span class="red">*</span></div>
                                        <input name="email" type="text" value="{{ $displayad->division }}" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">제안명<span class="red">*</span></div>
                                        <input name="title" type="text" value="{{ $displayad->title }}" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">광고기간<span class="red">*</span></div>
                                        <input name="term" type="text" value="{{ $displayad->term }}" placeholder="Ex) 1개월, 25일, 7일 or 12/27~12/31, 1/1~1/31 등" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">희망예산<span class="red">*</span></div>
                                        <input name="hopemoney" type="text" value="{{ $displayad->hopemoney }}" placeholder="Ex) 300만 원, 500만 원" class="contact-form-writespace" disabled/>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">내용<span class="red">*</span></div>
                                        <textarea name="contents" placeholder="Ex) 야구 게임 광고, 공무원 학원 광고 등" class="contact-form-textarea" disabled>{{ $displayad->contents }}</textarea>
                                    </li>
                                    <li class="contact-form-line">
                                        <div class="contact-form-sort">첨부파일<span class="red">*</span></div>
                                        <img src="data:image/png;base64,{{ $image }}" alt="title" />
                                    </li>
                                </ul>
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
