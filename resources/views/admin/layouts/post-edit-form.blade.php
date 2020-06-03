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
                        <div class="card-header"><i class="far fa-edit"></i>게시글 수정</div>
                        <div class="card-body">
                          <form name="content_form" action="{{ route('admin_post.update', $post->id) }}" method="post">
                            @method('PATCH')
                            @csrf
                          <div class="write_warp">
                              <fieldset>
                                  <div class="row">
                                    <div class="input_infobox input_infotxt col">
                                        <input id="txt" class="infotxt" type="text" maxlength="15" name="name" value="{{ $post->user_id }}" placeholder="닉네임">
                                    </div>
                                    <div class="input_infobox input_infotxt col">
                                        <input id="txt" class="infotxt" type="password" maxlength="20" name="password" value="{{ $post->password }}" placeholder="비밀번호">
                                    </div>
                                    <div class="input_infobox input_infotxt col">
                                        <input type="text" id="resultName" class="infotxt resultName" value="{{ $post->gallery_name }}" placeholder="갤러리 검색" disabled>
                                        <input type="hidden" name="idH" id="idH" value="{{ $post->gallery_id }}">
                                        <button type="button" class="gallerySearch" onclick="showFind();"><i class="fas fa-search"></i></button>
                                    </div>
                                    <script language="javascript">
                                      function showFind() {
                                        window.open("/admin/galleryFind", "galleryFind", "width=450, height=300, left=100, top=50");
                                      }
                                    </script>
                                  </div>
                                  <div class="write_sub">
                                      <strong class="tit">말머리</strong>

                                      <ul id="sub_list" class="sub_list">
                                        @php
                                          $headArr = explode("/", $post->gallery_heads);
                                        @endphp
                                        @if($post->head == "없음")
                                          <li id="sel0" class="sel" value="sel0" onclick="change('sel0');"><i id="head" class="fas fa-check"></i>없음</li>
                                        @else
                                          <li id="sel0" value="sel0" onclick="change('sel0');">없음</li>
                                        @endif
                                        @for($i = 0; $i < count($headArr) ; $i++)
                                          @if($post->head == $headArr[$i])
                                            <li id="sel{{ $i+1 }}" class="sel" value="sel{{ $i+1 }}" onclick="change('sel{{ $i+1 }}');"><i id="head" class="fas fa-check"></i>{{ $headArr[$i] }}</li>
                                          @else
                                            <li id="sel{{ $i+1 }}" value="sel{{ $i+1 }}" onclick="change('sel{{ $i+1 }}');">{{ $headArr[$i] }}</li>
                                          @endif
                                        @endfor
                                        <input id="sendHead" type="hidden" name="head" value="{{ $post->head }}">
                                      </ul>

                                      <!--<ul id="sub_list" class="sub_list">
                                          <li id="sel1" class="sel" value="sel1" onclick="change('sel1');"><i id="head" class="fas fa-check"></i>일반</li>
                                          <input id="sendHead" type="hidden" name="head" value="일반">
                                          <li id="sel2" value="sel2" onclick="change('sel2');">{{ $post->gallery_heads }}</li>
                                          <li id="sel3" value="sel3" onclick="change('sel3');">일반3</li>
                                          <li id="sel4" value="sel4" onclick="change('sel4');">일반4</li>
                                          <li id="sel5" value="sel5" onclick="change('sel5');">일반5</li>
                                      </ul>-->
                                      <script>
                                        function change(sel) {
                                          var head = document.getElementById(sel);
                                          $('#head').remove();
                                          $('.sub_list').children().attr('class', '');

                                          head.setAttribute('class', 'sel');
                                          $('#'+sel).prepend("<i id='head' class='fas fa-check'></i>");

                                          id = $('.sel').text();
                                          $('#sendHead').attr('value', id);
                                        }
                                      </script>
                                  </div>
                                  <div id="title" class="input_infobox input_tit">
                                      <!--<label id="tit" for="tit" class="txt_placeholder">제목을 작성해주세요</label>-->
                                      <input id="txt"class="infotxt" type="text" maxlength="40" name="tit" value="{{ $post->title }}" placeholder="제목을 입력해 주세요">
                                  </div>
                              </fieldset>
                              <div class="write_info">
                                  <p>※ 쉬운 비밀번호를 입력하면 타인의 수정, 삭제가 쉽습니다.</p>
                                  <p>※ 음란물, 차별, 비하, 혐오 및 초상권, 저작권 침해 게시물은 민, 형사상의 책임을 질 수 있습니다.</p>
                              </div>
                              <div class=""><!--에디터-->
                                <textarea name="content" style="width:100%; min-width:1px; height: 800px;" id="content">
                                    {!! $post->contents !!}
                                </textarea>
                                <script language="javascript">
                                  var oEditors = [];
                                  var sLang = "ko_KR"; // 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR
                                  // 추가 글꼴 목록
                                  //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];
                                  nhn.husky.EZCreator.createInIFrame({
                                   oAppRef: oEditors,
                                   elPlaceHolder: "content",
                                   sSkinURI: "../../assets/smarteditor2/SmartEditor2Skin.html",
                                   htParams : {
                                    bUseToolbar : true,    // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
                                    bUseVerticalResizer : true,  // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
                                    bUseModeChanger : true,   // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
                                    //bSkipXssFilter : true,  // client-side xss filter 무시 여부 (true:사용하지 않음 / 그외:사용)
                                    //aAdditionalFontList : aAdditionalFontSet,  // 추가 글꼴 목록
                                    fOnBeforeUnload : function(){
                                     //alert("완료!");
                                    },
                                    I18N_LOCALE : sLang
                                   }, //boolean
                                   fOnAppLoad : function(){
                                    //예제 코드
                                    //oEditors.getById["content"].exec("PASTE_HTML", ["로딩이 완료된 후에 본문에 삽입되는 text입니다."]);
                                   },
                                   fCreator: "createSEditor2"
                                  });

                                  /*function pasteHTML(filepath) {
                                    alert("pasteHTML");
                                  // var sHTML = "<span style='color:#FF0000;'>이미지도 같은 방식으로 삽입합니다.<\/span>";
                                   var sHTML = '<span style="color:#FF0000;"><img src="'+filepath+'"></span>';
                                   oEditors.getById["content"].exec("PASTE_HTML", [sHTML]);
                                  }

                                  function showHTML() {
                                    alert("showHTML실행");
                                   var sHTML = oEditors.getById["content"].getIR();
                                   alert(sHTML);
                                 }*/

                                  function submitContents(elClickedObj) {
                                     oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
                                     try {
                                       elClickedObj.form.submit();
                                     } catch(e) {alert(e);}
                                  }



                                  /*function setDefaultFont() {
                                    alert("setDefaultFont");
                                   var sDefaultFont = '궁서';
                                   var nFontSize = 24;
                                   oEditors.getById["content"].setDefaultFont(sDefaultFont, nFontSize);
                                  }


                                  function writeReset() {
                                    alert("writeReset");
                                   document.f.reset();
                                   oEditors.getById["content"].exec("SET_IR", [""]);
                                 }*/
                                  </script>
                                  <div class="btn_box right">
                                      <button class="btn_gray" type="button" name="button">취소</button>
                                      <button class="btn_blue" type="submit" name="button" onclick="submitContents(this)">등록</button>
                                  </div>
                              </div>
                          </div>
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
