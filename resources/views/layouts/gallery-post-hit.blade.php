<!DOCTYPE html>


<html lang="kr">
	<head>
		<meta property="og:title" content="{{ $post->title }}" />
		<meta name="og:url" property="og:url" content="" />
		<meta name="og:description" property="og:description" content="" />
		<meta property="og:image" content="{{ $post->thumbnail }}" />
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
		<script type="text/javascript" src="{{ asset('assets/js/jquery.cookie.js') }}"></script>
		<script type="text/JavaScript" src="https://developers.kakao.com/sdk/js/kakao.min.js"></script>
		<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
		<script src="{{ asset('assets/js/gallery-post-hit.js') }}"></script>

		<link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
		<link href="{{ asset('assets/css/gallery.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/css/gallery-post.css') }}" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
	</head>

	<body>
		@yield('header')
		<div class="container">
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
                <div class="post_view">
                    <header>
						<div class="view_head">
							<h3 class="view_title">
								<span class="view_headtext" id="{{ $post->id }}">[{{ $post->head }}]</span>
								<span class="view_subtitle">{{ $post->title }}</span>
								<!--<span class="post_device">
									<i class="fas fa-mobile-alt blue"></i>
								</span>-->
							</h3>
							<div class="post_writer">
								<div class="left">
									<span class="post_nick">{{ $post->user_nick }}</span>
									@php
										$pos = strpos($post->ip, '.');
										$pos = strpos($post->ip, '.', $pos+1);
										$ip = substr($post->ip, 0, $pos ) . '.*';
									@endphp
									<span class="ip">(  {{ $ip }}  )</span>
									<span class="view_date">{{ $post->reg_date }}</span>
								</div>
								<div class="right pdL6">
									<span class="view_count">조회 수 {{ $post->view }}</span>
									<span class="view_good">추천 수 {{ $post->good }}</span>
									<span class="view_comment">댓글 수 {{ $post->comments }}</span>
								</div>
							</div>
						</div>
                    </header>
					<div class="post_content">
						<div class="inner_content">
							<div class="view_content" style="overflow:hidden;">
								<div>
									<input type="hidden" id="thumbnail" value="{{ $post->thumbnail }}">
									<span id="view_content">{!! $post->contents !!}</span>
								</div>
								<!--<span>-모바일로 작성</span>-->
							</div>
							<div class="right"></div>
						</div>
						<div class="recommend_box clear">
							<div class="inner left">
								<div class="up_box">
									<p class="red">{{ $post->good }}</p>
								</div>
								<button class="up_btn" type="button" id="good-button"><img src="/assets/img/good.png" alt="추천"></button>
							</div>
							<div class="inner right">
								<button class="down_btn" type="button" id="bad-button"><img src="/assets/img/bad.png" alt="비추"></button>
								<div class="down_box">
									<p>{{ $post->bad }}</p>
								</div>
							</div>
							<div class="recom_bottom_box">
								<button class="hitgal" type="button" id="hit-button"><i class="fas fa-crown gray pdR6 fa-lg"></i>힛추</button>
								<button class="share" type="button" id="share-button" data-container="body" data-toggle="popover" data-placement="bottom" data-original-title="공유"
								data-content="
									<ul class='share_list'>
										<li>
											<a id='kakao-share-btn'>
												<img src='{{ asset('assets/img/kakaolink_btn_medium.png') }}'/>
											</a>
										</li>
										<li>
											<a target='_blank' id='fb-share-btn'>
												<img src='{{ asset('assets/img/facebook-square-color.png') }}'/>
											</a>
										</li>
										<li>
											<a id='twitter-share-btn'>
												<img src='{{ asset('assets/img/twitter.png') }}'/>
											</a>
										</li>
										<li>
											<a id='band-share-btn'>
												<img src='{{ asset('assets/img/band.png') }}'/>
											</a>
										</li>
										<div class='clear'></div>
									</ul>
									">
									<i class="fas fa-share-alt gray pdR6 fa-lg"></i>공유
								</button>
								<button class="report" type="button" id="police-button"><i class="fas fa-concierge-bell gray pdR6 fa-lg"></i>신고</button>
							</div>
						</div>
						<div class="clear"></div>
					</div>
                </div>
				<div class="cmt_box clear">
					<div class="comment_warp">
						<div class="comment_num">
							<div class="left num_box">
								전체 리플 <span class="red">{{ $post->comments }}</span> 개
								<!--<select class="comment_sort" name="sort">
									<option value="1">등록순</option>
									<option value="2">최신순</option>
									<option value="3">답글순</option>
								</select>-->
							</div>
							<div class="right">
								<button class="btn_cmt_close" type="button" name="button">댓글닫기<i class="fas fa-caret-up pdL6"></i></button>
								<button class="btn_cmt_refresh" type="button" name="button">새고로침</button>
							</div>
						</div>
					</div>
					<div class="comment_box">
						<ul class="cmt_list">
							@foreach($comments as $comment)
							  @if($comment->id % 100 == 0)
								<li>
									<div class="cmt_info clear">
										<div class="cmt_nick">
											<span class="writer">
												<span class="cmt_nickname">
													{{ $comment->nouser_name }}
												</span>
												@php
													$pos = strpos($comment->ip, '.');
													$pos = strpos($comment->ip, '.', $pos+1);
													$ip = substr($comment->ip, 0, $pos ) . '.*';
												@endphp
												<span class="cmt_ip">({{ $ip }})</span>
											</span>
										</div>
										<div class="left">
											<p class="user_txt">
												<a onclick="rep_form({{ $comment->id }});">
													{{ $comment->contents }}
												</a>
											</p>
										</div>
										<div class="right">
											<span class="cmt_date">{{ $comment->reg_date }}</span>
										</div>
									</div>
								</li>
								<form method="post" action="{{ route('comment.store') }}">
								  @method('POST')
								  @csrf
								  <input type="hidden" name="postId" value="{{ $post->id }}">
								  <input type="hidden" name="commentId" value="{{ $comment->id }}">
								  <div class="reply_box" style="display:none;" id="{{ $comment->id }}"></div>
								</form>
							  @else
								<li>
									<div class="reply show">
										<div class="reply_box">
											<ul class="reply_list">
												<li>
													<div class="reply_info">
														<div class="cmt_nikbox">
															<span class="writer">
																<span class="cmt_nickname">
																	{{ $comment->nouser_name }}
																</span>
																@php
																	$pos = strpos($comment->ip, '.');
																	$pos = strpos($comment->ip, '.', $pos+1);
																	$ip = substr($comment->ip, 0, $pos ) . '.*';
																@endphp
																<span class="cmt_ip">({{ $ip }})</span>
															</span>
														</div>
														<div class="left">
															<p class="user_txt">
																<a onclick="rep_form({{ $comment->id }});">
																	<i class="fas fa-level-up-alt fa-rotate-90" style="width:15px;"></i>{{ $comment->contents }}
																</a>
															</p>
														</div>
														<div class="right">
															<span class="cmt_date">{{ $comment->reg_date }}</span>
														</div>
													</div>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
								  <form method="post" action="{{ route('comment.store') }}">
									@method('POST')
									@csrf
									<input type="hidden" name="postId" value="{{ $post->id }}">
									<input type="hidden" name="commentId" value="{{ $comment->id }}">
									<div class="reply_box" style="display:none;" id="{{ $comment->id }}"></div>
								  </form>
								</li>
							  @endif
							@endforeach
						</ul>
					</div>
					<form method="post" action="{{ route('comment.store') }}">
					  @method('POST')
					  @csrf
					  <input type="hidden" name="postId" value="{{ $post->id }}">
						<div class="cmt_write_box">
							<div class="left">
								<div class="user_info_input">
									<input type="text" name="name" placeholder="닉네임" value="" maxlength="20">
								</div>
								<div class="user_info_input">
									<input type="password" name="password" placeholder="비밀번호" value="" maxlength="20">
								</div>
							</div>
							<div class="cmt_txt right">
								<div class="cmt_write">
									<textarea name="content" maxlength="400" placeholder="타인의 권리를 침해하거나 명예를 훼손하는 댓글은 운영원칙 및 관련 법률에 제재를 받을 수 있습니다.&#13;&#10;Shift+Enter 키를 동시에 누르면 줄바꿈이 됩니다."></textarea>
								</div>
								<div class="cmt_txt_bot">
									<div class="right">
										<button class="btn_save btn_blue" type="submit" onClick="this.form.action='{{ route('comment.store') }}?type=register';">등록</button>
										<button class="btn_save_good btn_lightBlue" type="submit">등록+추천</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="cmt_btnbox">
					<div class="leftBox">
						@if($select_head == '개념')
							<button type="button" id="all-post" name="button" class="">전체글</button>
							<button type="button" id="concept-post" name="button" class="on">개념글</button>
						@else
							<button type="button" id="all-post" name="button" class="on">전체글</button>
							<button type="button" id="concept-post" name="button" class="">개념글</button>
						@endif
					</div>
					@if(Auth::check())
						@if(Auth::user()->id == $post->user_id)
							<div class="right">
								<a href="{{ route('gallery-post.edit', $post->id) }}?link={{ $post->gallery_link }}" style="float:left;"><button class="btn_update btn_gray" type="button" name="button">수정</button></a>
								<form action="{{ route('gallery-post.destroy', $post->id) }}?link={{ $post->gallery_link }}" method="POST" style="float:left;">
									@method('DELETE')
									@csrf
									<button class="btn_delete btn_gray" type="submit" name="button">삭제</button>
								</form>
								<div class="clear"></div>
							</div>
						@endif
					@endif
					<div class="clear"></div>
				</div>
                <div class="mainLeft">
				<div class="post_listWarp">
					<table class="post_list">
						<thead>
							<tr>
								<th scope="col" class="tit-num">번호</th>
								<th scope="col" class="tit-tit">제목</th>
								<th scope="col" class="tit-user">글쓴이</th>
								<th scope="col" class="tit-date">작성일</th>
								<th scope="col" class="tit-view">조회</th>
								<th scope="col" class="tit-good">추천</th>
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
				<form action="?head={{ $select_head }}" method="get">
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
				<div class="right_ad">
					<img width="100%" src="data:image/png;base64,{{ $r_image }}" alt="우측광고">
				</div>
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
