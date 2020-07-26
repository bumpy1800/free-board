<!DOCTYPE html>


<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>

		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallery.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/gallery-post.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/gallery-write.css') }}" rel="stylesheet">

		<!-- smart editor -->
		<script type="text/javascript" src="{{ asset('assets/smarteditor2/js/HuskyEZCreator.js') }}"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<style>
	  .btn_box {
		  margin-right: 0px;
	  }
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

	<body>
		<div class="container">
			<div class="etc">
				<a class="mb_menu" href="login">회원가입</a>
				<a class="mb_menu" href="/">로그인</a>
			</div>
		</div>
        @yield('header')
		<div class="container">
				<div class="gallery-top">
					<h4 class="title" id="{{ $gallery_link }}"><b>{{ $gallery_name }}</b></h4>
					<div class="sub">
						<span class="lf">
							<a type="button" id="link-gallery" data-container="body" data-toggle="popover" data-placement="bottom" data-original-title="연관 갤러리" data-content="">
							  연관 갤러리({{ $link_gallerys }}/5)
							</a>
						</span>
						<span class="mLine">|</span>
						<span><a href="" onclick="copy_trackback(this.href); return false;">갤주소 복사</a></span>
						<span class="mLine">|</span>
						<span class="lf"><a href="#" data-toggle="modal" data-target="#block" id="blockConfig">차단설정</a></span>
						<span class="mLine">|</span>
						<span><a href="#" data-toggle="modal" data-target="#infouse">갤러리 이용안내</a></span>
					</div>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="infouse" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				  <div class="modal-dialog modal-dialog-scrollable modal-xl">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="infouseLabel">갤러리 이용 안내</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="modal-body">
						@yield('infouse')
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
					  </div>
					</div>
				  </div>
				</div>

				<div class="modal fade" id="block" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
					<div class="modal-content">
					  <div class="modal-header">
						<h5 class="modal-title" id="blockLabel">차단설정</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
					  </div>
					  <div class="block-info">차단설정을 통해 게시물을 걸러서 볼 수 있습니다.</div>
					  <div class="modal-body">
						<ul class="nav nav-tabs">
						  <li class="nav-item">
							<a class="nav-link active" data-toggle="tab" href="#allblock">전체설정</a>
						  </li>
						  <li class="nav-item">
							<a class="nav-link" data-toggle="tab" href="#galleryblock">갤러리별 설정</a>
						  </li>
						</ul>
						<div class="tab-content">
							  <div class="tab-pane fade show active" id="allblock">
								  <div class="block-info">
									  <h6>[전체 갤러리]</h6>
									  차단 등록은 20자 이내, 최대 10개까지 가능합니다.
								  </div>
								  <form>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 단어</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-keyword">
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-keyword"><span>등록</span></button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="keyword-list list"></ul>
										<hr>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 ID</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-id">
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-id">등록</button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="id-list list"></ul>
										<hr>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 닉네임</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-nick">
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-nick">등록</button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="nick-list list"></ul>
										<hr>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 IP</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-ip">
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-ip">등록</button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="ip-list list"></ul>
								  </form>
							  </div>
							  <div class="tab-pane fade" id="galleryblock">
								  <div class="block-info">
									  <h6>설정된 갤러리</h6>
									  <ul id="cookie-gallery"></ul>
									  <ul style="display: none;" id="cookie-delete-gallery"></ul>
								  </div>
								  <form>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">갤러리 선택</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="gallery-name">
												</div>
												<div class="button">
													<button type="button" class="btn" id="gallery-select">검색</button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul id="gallery-list">

											<div class="clear"></div>
										</ul>
										<hr>
										<div class="block-info">
											<h6 id="gallery-select-name">[갤러리]</h6>
											전체 설정과는 별개 적용됩니다.
										</div>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 단어</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-keyword" disabled>
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-keyword"><span>등록</span></button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="keyword-list list"></ul>
										<hr>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 ID</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-id" disabled>
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-id">등록</button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="id-list list"></ul>
										<hr>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 닉네임</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-nick" disabled>
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-nick">등록</button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="nick-list list"></ul>
										<hr>
										<div class="form-group">
											<label for="recipient-name" class="col-form-label">차단 IP</label>
											<div>
												<div class="input">
													<input type="text" class="form-control" id="block-ip" disabled>
												</div>
												<div class="button">
													<button type="button" class="btn" id="block-ip">등록</button>
												</div>
												<div class="clear"></div>
											</div>
										</div>
										<ul class="ip-list list"></ul>
								  </form>
							  </div>
						</div>
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">닫기</button>
						<button id="block-save" type="button" class="btn btn-primary">저장</button>
					  </div>
					</div>
				  </div>
				</div>

				<div class="clear"></div>
				<hr class="line" style="margin-bottom:0px;">
				<div class="infomation"><!--제일 큰박스-->
					<div class="recently-visit">
						<div class="fir">
							<b>최근 방문 갤러리</b>
						</div>
						<div class="visitlist">
							<div class="row" id="visitlist">
									@for($i = count($recentGallerys)-1; $i >= 0; $i--)
											@if($j = $recentGallerys[$i]) {{-- 값 유무 확인 --}}
													@if($i != 0)
															<div class="col">
																<span>{{ $recentGallerys[$i] }}</span>
																<button id="{{ $i }}" class="delete"><i class="fas fa-times grey"></i></button>
															</div>
															<div class="clear"></div>
													@else
															<div class="col m-hide">
																<span>{{ $recentGallerys[$i] }}</span>
																<button id="{{ $i }}" class="delete"><i class="fas fa-times grey"></i></button>
															</div>
															<div class="clear"></div>
													@endif
											@endif
									@endfor
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<form name="content_form" action="{{ route('gallery-post.update', $post->id) }}" method="post">
				  @method('PATCH')
				  @csrf
				  	<input type="hidden" name="idH" id="idH" value="{{ $gallery_id }}">
					<input type="hidden" name="link" id="link" value="{{ $gallery_link }}">
	                <div class="write_warp">
						<fieldset>
							<div class="row">
							  <div class="input_infobox input_infotxt col">
								  <input id="txt" class="infotxt" type="text" maxlength="15" name="name" value="{{ $user->nick }}" placeholder="닉네임">
							  </div>
							  <div class="input_infobox input_infotxt col">
								  <input id="txt" class="infotxt" type="password" maxlength="20" name="password" value="{{ $post->password }}" placeholder="비밀번호">
							  </div>
							</div>
							<div class="write_sub">
								<strong class="tit">말머리</strong>
								<ul id="sub_list" class="sub_list">
									@if($post->head == '일반')
										<li id="sel1" class="sel" value="sel1" onclick="change('sel1');"><i id="head" class="fas fa-check"></i>일반</li>
									@else
										<li id="sel1" class="" value="sel1" onclick="change('sel1');"><i id="head" class="fas fa-check"></i>일반</li>
									@endif
									@php
										$i = 2;
									@endphp
									@forEach($heads as $head)
										@if($head == $post->head)
											<li id="sel{{ $i }}" class="sel" value="sel{{ $i }}" onclick="change('sel{{ $i }}');">{{ $head }}</li>
										@else
											<li id="sel{{ $i }}" class="" value="sel{{ $i }}" onclick="change('sel{{ $i }}');">{{ $head }}</li>
										@endif
										@php
											$i ++;
										@endphp
									@endforEach
									<input id="sendHead" type="hidden" name="head" value="일반">
								</ul>
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
	                    <div class="">
							<img width="100%" src="data:image/png;base64,{{ $image }}" alt="글작성시 광고">
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
							 }
							 function setDefaultFont() {
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

							  function submitContents(elClickedObj) {
								 oEditors.getById["content"].exec("UPDATE_CONTENTS_FIELD", []); // 에디터의 내용이 textarea에 적용됩니다.
								 try {
								   elClickedObj.form.submit();
								 } catch(e) {alert(e);}
							  }
							  </script>

	                    </div>
						<div class="btn_box right">
							<button class="btn_gray" type="button" name="button" onclick="">취소</button>
							<button class="btn_blue" type="submit" name="button" onclick="submitContents(this)">등록</button>
						</div>
	                </div>
				</form>
			<div class="clear"></div>
		</div>
		<div class="container">
            @yield('footer')
		</div>
	</body>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
	<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
	<script src="{{ asset('assets/js/gallery-post-write.js') }}"></script>
	<script src="{{ asset('assets/package/dist/js/service/HuskyEZCreator.js') }}" charset="utf-8"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</html>
