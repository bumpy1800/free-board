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
                        <div class="card-header">
                          <i class="fas fa-pencil-alt"></i>
                          공지사항 등록
                        </div>
                        <div class="card-body">
                          <form name="content_form" action="{{ route('admin_notice.store') }}" method="post">
                            @method('POST')
                            @csrf

                          <div class="write_warp">
                              <fieldset>
                                  <div id="title" class="input_infobox input_tit">
                                      <!--<label id="tit" for="tit" class="txt_placeholder">제목을 작성해주세요</label>-->
                                      <input id="txt"class="infotxt" type="text" maxlength="40" name="tit" value="" placeholder="제목을 입력해 주세요">
                                  </div>
                              </fieldset>
                              <div class="write_info">
                                  <p>※ 쉬운 비밀번호를 입력하면 타인의 수정, 삭제가 쉽습니다.</p>
                                  <p>※ 음란물, 차별, 비하, 혐오 및 초상권, 저작권 침해 게시물은 민, 형사상의 책임을 질 수 있습니다.</p>
                              </div>
                              <div class=""><!--에디터-->
                                <textarea name="content" style="width:100%; min-width:1px; height: 800px;" id="content"></textarea>
                                <script language="javascript">
                                  var oEditors = [];
                                  var sLang = "ko_KR"; // 언어 (ko_KR/ en_US/ ja_JP/ zh_CN/ zh_TW), default = ko_KR
                                  // 추가 글꼴 목록
                                  //var aAdditionalFontSet = [["MS UI Gothic", "MS UI Gothic"], ["Comic Sans MS", "Comic Sans MS"],["TEST","TEST"]];
                                  nhn.husky.EZCreator.createInIFrame({
                                   oAppRef: oEditors,
                                   elPlaceHolder: "content",
                                   sSkinURI: "../assets/smarteditor2/SmartEditor2Skin.html",
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
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/admin/dist/assets/demo/datatables-demo.js') }}"></script>
</body>
</html>
