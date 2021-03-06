<!DOCTYPE html>


<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		@yield('css')
		<script type="text/javascript" src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
		<script src="{{ asset('assets/js/gallery-hit.js') }}"></script>
		<link href="{{ asset('assets/css/gallery.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallery-hit.css') }}" rel="stylesheet">
	</head>

	<body>
        @yield('header')
		<div class="container">
			<div class="mainLeft">
				<div class="gallery-top">
					<h4 class="title" id="hit"><b>HIT 갤러리</b></h4>
					<div class="sub">
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
					<div class="info-rank"><!--정보와 랭킹-->
						<div class="info" style="width: 100%;"><!--정보-->
							<div class="img-info" style="width: 50%;"><!--대표이미와 설명-->
								<div class="txtbox">
									<ul>
										@foreach($top_posts as $top_post)
											<li><p><b>[{{ $top_post->gallery_s_name }}]</b> {{ $top_post->post_title }}</p></li>
										@endforeach
									</ul>
								</div>
							</div>
							<div class="m_list" style="width: 50%;"><!--매니저 리스트-->
								<div class="txtbox">
									@foreach($top_imgPosts as $top_imgPost)
										<img src="{{ $top_imgPost->thumbnail }}" alt="...">
										<ul>
											<li><p id="title"><a href=""><b>[{{ $top_imgPost->gallery_s_name }}] {{ $top_imgPost->post_title }}</b></a></p></li>
											<li><p id="contents">{{ strip_tags($top_imgPost->post_contents) }}</p></li>
											<li><b>작성자 : </b>{{ $top_imgPost->user_nick }}</p></li>
										</ul>
									@endforeach
								</div>
							</div>
						</div>
					</div>

					@if($c_image != '')
						<div class="top-ad"><!--상단광고-->
							<img src="data:image/png;base64,{{ $c_image }}" alt="광고">
						</div>
					@endif
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
				<div class="optionBar">
					<div class="leftBox">
						@if($select_head == '개념')
							<button type="button" id="all-post" name="button" class="">전체글</button>
							<button type="button" id="concept-post" name="button" class="on">개념글</button>
							<button type="button" id="notice" name="button" class="">공지</button>
						@elseif($select_head == '공지')
							<button type="button" id="all-post" name="button" class="">전체글</button>
							<button type="button" id="concept-post" name="button" class="">개념글</button>
							<button type="button" id="notice" name="button" class="on">공지</button>
						@else
							<button type="button" id="all-post" name="button" class="on">전체글</button>
							<button type="button" id="concept-post" name="button" class="">개념글</button>
							<button type="button" id="notice" name="button" class="">공지</button>
						@endif
					</div>
					<script>
						$(document).on("click", "#all-post", function(){
							location.href="?showCnt={{ $showCnt }}";
						});
						$(document).on("click", "#concept-post", function(){
							location.href="?showCnt={{ $showCnt }}&head=개념";
						});
						$(document).on("click", "#notice", function(){
							location.href="?showCnt={{ $showCnt }}&head=공지";
						});
					</script>
					<div class="clear"></div>
					<div class="m-hide heads">
						<div class="heads-list">
							<ul>
								<div class="clear"></div>
							</ul>
						</div>
						<div class="rightBox" style="padding-top: 0px;">
							<div class="output">
								<div class="selectBox">
									<select id="post_cnt" name="number" onchange="if(this.value) location.href='?showCnt='+(this.value);">
										@if($showCnt == 30)
											<option value="30" selected>30개</option>
											<option value="50">50개</option>
											<option value="100">100개</option>
										@elseif($showCnt == 50)
											<option value="30">30개</option>
											<option value="50" selected>50개</option>
											<option value="100">100개</option>
										@else
											<option value="30">30개</option>
											<option value="50">50개</option>
											<option value="100" selected>100개</option>
										@endif
									</select>
								</div>
								<div class="switchBtn">
									<a href="#" class="writeBtn">
										<i class="fas fa-pencil-alt"></i>
									</a>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="post_listWarp">
					<table class="post_list">
						<thead>
							<tr>
								<th scope="col" class="tit-num">번호</th>
								<th scope="col" class="tit-tit">제목</th>
								<th scope="col" class="tit-user">글쓴이</th>
								<th scope="col" class="tit-date">작성일</th>
								<th scope="col" class="tit-view m-hide">조회</th>
								<th scope="col" class="tit-good m-hide">추천</th>
							</tr>
						</thead>
						<tbody>
							@php $i=0; @endphp
							@forEach($n_posts as $n_post)
								<tr class="postArea" id="p{{ $i }}">
									<td class="post_head m-hide"><b>공지</b></td>
									<td class="post_title">
										<a href="{{ route('notice.show', $n_post->id) }}">
											<i class="fas fa-info-circle red"></i>
											<b>{{ $n_post->title }}</b>
										</a>
										<a href="#" class="comment_count">[{{ $n_post->comments }}]</a>
									</td>
									<td class="post_user">
										<span class="nickname"><b>운영자</b></span>
									</td>
									<td class="post_date">{{ date('y-m-d', strtotime($n_post->reg_date)) }}</td>
									<td class="post_view m-hide">{{ $n_post->view }}</td>
									<td class="post_good m-hide"></td>
								</tr>
								@php $i++; @endphp
							@endforEach
							@forEach($posts as $post)
								<tr class="postArea" id="p{{ $i }}">
									<td class="post_num">{{ $post->post_id }}</td>
									<td class="post_title">
										<a href="{{ route('gallery-hit.show', $post->post_id) }}" id="title">
											@if($post->post_thumbnail)
												<i class="fas fa-image green"></i>
											@else
												<i class="fas fa-comment-dots sliver"></i>
											@endif
											{{ $post->post_title }}
										</a>
										<a href="#" class="comment_count">[{{ $post->post_comments }}]</a>
									</td>
									<td class="post_user">
										<span class="uid" style="display:none;">{{ $post->user_uid }}"</span>
										<span class="nickname" title="">{{ $post->user_nick }}
										@php
											$pos = strpos($post->post_ip, '.');
											$pos = strpos($post->post_ip, '.', $pos+1);
											$ip = substr($post->post_ip, 0, $pos ) . '.*';
										@endphp
										<span class="ip">({{ $ip }})</span></span>
										@if($post->user_status == 1)
											<i class="fas fa-crown gold"></i>
										@elseif($post->user_status == 2)
											<i class="fas fa-crown gray"></i>
										@endif
									</td>
									<td class="post_date">{{ date('y-m-d', strtotime($post->post_reg_date)) }}</td>
									<td class="post_view m-hide">{{ $post->post_view }}</td>
									<td class="post_good m-hide">{{ $post->post_good }}</td>
								</tr>
								@php
								 	$i++;
								@endphp
							@endforEach
						</tbody>
					</table>
				</div>
				<div class="optionBar bot">
					<div class="leftBox">
						@if($select_head == '개념')
							<button type="button" id="all-post" name="button" class="">전체글</button>
							<button type="button" id="concept-post" name="button" class="on">개념글</button>
						@else
							<button type="button" id="all-post" name="button" class="on">전체글</button>
							<button type="button" id="concept-post" name="button" class="">개념글</button>
						@endif
					</div>
				</div>
				<div class="pagebox">
					@if($posts != null && $posts != '')
						{{ $posts->links('vendor/pagination/gallery-post-pagination') }}
					@endif
				</div>
				<form action="?showCnt={{ $showCnt }}&head={{ $select_head }}" method="get">
					<input type="hidden" name="showCnt" value="{{ $showCnt }}">
					<div class="bottom_search">
						<div class="bottom_select">
							<select id="search_type" name="search_type">
								@if($search_type == 'search_subject')
									<option value="search_all">전체</option>
								  	<option value="search_subject" selected>제목</option>
								  	<option value="search_memo">내용</option>
								  	<option value="search_name">글쓴이</option>
								  	<option value="search_subject_memo">제목+내용</option>
								@elseif($search_type == 'search_memo')
									<option value="search_all">전체</option>
									<option value="search_subject">제목</option>
									<option value="search_memo" selected>내용</option>
									<option value="search_name">글쓴이</option>
									<option value="search_subject_memo">제목+내용</option>
								@elseif($search_type == 'search_name')
									<option value="search_all">전체</option>
									<option value="search_subject">제목</option>
									<option value="search_memo" >내용</option>
									<option value="search_name" selected>글쓴이</option>
									<option value="search_subject_memo">제목+내용</option>
								@elseif($search_type == 'search_subject_memo')
									<option value="search_all">전체</option>
									<option value="search_subject">제목</option>
									<option value="search_memo">내용</option>
									<option value="search_name">글쓴이</option>
									<option value="search_subject_memo" selected>제목+내용</option>
								@else
									<option value="search_all" selected>전체</option>
									<option value="search_subject">제목</option>
									<option value="search_memo">내용</option>
									<option value="search_name">글쓴이</option>
									<option value="search_subject_memo">제목+내용</option>
							  	@endif
			    			</select>
						</div>
						<div class="search_content">
							<div class="inner_search">
								<input type="text" class="keyword" name="search_keyword" value="" title="검색어 입력">
								<button type="submit" class="searchBtn btn"><i class="fas fa-search"></i></button>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</form>
			</div>
			<div class="mainRight">
				<div class="login_line login">
					<div class="user_box">
						<div class="login_box">
							<a href="login" id="login"><b>로그인을 해 주시기바랍니다</b></a>
						</div>
						<div class="help">
							<div class="row">
								<div class="col-sm-4">
									<a href="register"><b>갤로그</b></a>
								</div>
								<div class="col-sm-4 LR_line">
									<a href="/" class=""><b>즐겨찾기</b><i class="fas fa-caret-down" style="padding-left: 4px;"></i></a>
								</div>
								<div class="col-sm-4">
									<a href="/"><i class="fas fa-bell" style="padding-right: 4px;"></i><b>알림</b></a>
								</div>
							</div>
						</div>
					</div>
				</div>
				@if($r_image != '')
					<div class="right_ad"><!--상단광고-->
						<img style="width: 100%" src="data:image/png;base64,{{ $r_image }}" alt="광고">
					</div>
				@endif
				<div class="boxline liveRanking concept">
					<div class="concept-left">
						<h6><a href="#"><strong>개념글</strong><sm>[소제목]</sm></a></h6>
					</div>
					<div class="concept-right">
						<page><strong>1</strong>/8</page><i class="fas fa-caret-square-left blue opacity"></i><i class="fas fa-caret-square-right blue"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<div class="ranking">
							<ul class="ranking-left">
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글1</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글2</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글3</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글4</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글5</a></li>
								</h6>
								<h6 class="mar-b-5">
									<li><a href="#" class="text-dot">개념글6</a></li>
								</h6>
							</ul>
							<div class="clear"></div>
						</div>
					<div class="clear"></div>
				</div>
				<div class="boxline newGallery issu-zoom">
					<div class="concept-left">
						<h6><a href="#"><strong>이슈줌</strong></a></h6>
					</div>
					<span class="new_icon"><img src="/assets/img/new.png" alt="new"></span>
					<div class="concept-right">
						<page><strong>1</strong>/8</page><i class="fas fa-caret-square-left blue opacity"></i><i class="fas fa-caret-square-right blue"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<span class="img-box">
							<a href="#" class="box">
								<img src="https://wstatic.dcinside.com/main/main2011/2020/02/05/2950635147_25e093a1_Screenshot_20200205-101819_SamsungInternet.jpg_s" alt="이슈사진">
								<div class="issu">
									<strong>사진이름</strong>
								</div>
								<span class="issu-inner"></span>
							</a>
						</span>

					<div class="clear"></div>
				</div>
				<div class="boxline newGallery news">
					<div class="concept-left">
						<h6><a href="#"><strong>뉴스</strong></a></h6>
					</div>
					<span class="new_icon"><img src="/assets/img/new.png" alt="new"></span>
					<div class="concept-right">
						<page><strong>1</strong>/8</page><i class="fas fa-caret-square-left blue opacity"></i><i class="fas fa-caret-square-right blue"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<a href="#" class="box">
							<span class="img-box">
									<img src="https://pds.joins.com/news/component/htmlphoto_mmdata/202002/10/82f1d8e5-672e-41d6-9ed1-62f6a1ca0930.jpg.tn_350.jpg" alt="이슈사진">
							</span>
							<div class="news-title"><strong>기사제목</strong></div>
							<div class="news-content">기사내용</div>
						</a>
					<div class="clear"></div>
				</div>
				<div class="boxline newGallery cho">
					<div class="concept-left">
						<h6><a href="#"><strong>초개념</strong></a></h6>
					</div>
					<div class="concept-right">
						<i class="fas fa-plus"></i>
					</div>
					<div class="clear"></div>
					<hr class="dash-line">
						<div class="cho-box">
							<div class="img">
								<div class="secimg-box">
									<a href="#">
										<span class="cho-img">
											<img src="https://wstatic.dcinside.com/main/main2011/2020/02/10/1889239287_d6ca7dd3_nike-air-zoom-alphafly-next-percent-original-1580936424.jpg_s" alt="test1">
										</span>
										<div class="cho-txt">
											<strong>[갤]게시글제목</strong>
										</div>
									</a>
								</div>
								<div class="secimg-box">
									<a href="#">
										<span class="cho-img">
											<img src="https://wstatic.dcinside.com/main/main2011/2020/02/10/gall_61001_20200210153828.jpg" alt="test1">
										</span>
										<div class="cho-txt">
											<strong>[갤]게시글제목</strong>
										</div>
									</a>
								</div>
							</div>
							<ul class="txt">
								<li>[갤]내용</li>
								<li>[갤]내용</li>
								<li>[갤]내용</li>
								<li>[갤]내용</li>
								<li>[갤]내용</li>
							</ul>
						</div>
					<div class="clear"></div>
				</div>
			</div>

			<div class="clear"></div>


		</div>
		<div class="container">
			@yield('footer')
		</div>
	</body>
</html>
