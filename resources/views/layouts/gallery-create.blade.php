<!DOCTYPE html>
<html lang="kr">
	<head>
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta charset="utf-8">
		<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/sjinside-icon-white.png') }}"/>
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>@yield('title', '없음')</title>
		@yield('css')
        <link href="{{ asset('assets/css/gallery-create.css') }}" rel="stylesheet">
		<script defer src="{{ asset('assets/js/gallery-create.js') }}"></script>
	</head>

	<body>
        <div class="back-screen">
            <div class="gallery-create-alert">
                <div class="gallery-create-alert-top">마이너 갤러리 승격 안내</div>
                <div class="gallery-create-alert-middle">마이너 갤러리는 심사 후 메인 갤러리로 승격됩니다.
                    승격 여부는 전적으로 회사에 의해 결정됩니다.
                    승격 시 매니저 권한은 회수될 수 있으며 개설자 이력은 보존됩니다.
                </div>
                <button class="gallery-create-alert-btn">확인</button>
            </div>
        </div>
        @yield('header')
		<div class="container">
            <div class="gallery-create-title">마이너 갤러리 만들기 <span>(만들기는 6개까지 가능합니다.)</span></div>
            <div class="gallery-create-info">
                <div class="gallery-create-info-top">
                    <div class="lt">마이너 갤러리는?</div>
                    <div class="st">누구나 개설할 수 있습니다. 갤러리의 의무 권한(및 의무)이 임시로 개설자에게 부여됩니다.</div>
                </div>
                <div class="gallery-create-description">
                    <img src="{{ asset('assets/img/gallery-create.jpg') }}"/>
                    <div class="gallery-create-description-contents">
                        <div class="mb">
                            <div class="lt">승격 안내</div>
                            <div class="st">활성화된 마이너 갤러리는 내부 심사 후 메인 갤러리로 승격됩니다.
                            <br>승격 시 매니저 권한은 디시인사이드로 회수될 수 있습니다.
                            <br>(개설자 이력은 보존됩니다.)</div>
                        </div>
                        <div>
                            <div class="lt">유의 사항</div>
                            <div class="st">메인 갤러리 승격을 위해서는 간결하고 정확한 단어형 이름을 입력하셔야 합니다.
                            <br>동일한 주제의 메인 갤러리가 있을 경우 승격이 불가능합니다. <button id="btnSeeMore">자세히보기</button>
                                <div class="gallery-create-seemore">
                                    <div class="gallery-create-seemore-top">승격 유의사항<i id="btnClose" class="fas fa-times"></i></div>
                                    <div class="gallery-create-seemore-midde">다음과 같은 마이너 갤러리는 승격이 어렵습니다.</div>
                                    <div class="gallery-create-seemore-bottom">1. 이름이 간결하지 않은 경우(서술형, 문장형 X)
                                        2. 동일한 주제의 메인 갤러리가 있을 경우
                                        3. 도배, 음란 등 부적절한 게시물이 많을 경우
                                        4. 주소가 복잡하고 이름과 맞지 않는 경우
                                        5. 이름에 맞지 않은 카테고리 선택 시
                                        ※ 승격 시에 이름, 주소, 카테고리는 변경될 수 있습니다.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<form action="{{ route('gallery.store') }}" method="post">
				  	@method('POST')
				  	@csrf
	                <div class="gallery-create-submit-form">
	                    <div class="gallery-create-form">
	                        <div class="gallery-create-form-contents">
	                            <div class="gallery-create-form-space">
	                                <div class="gallery-create-form-sub">이름<span>*</span></div>
	                                <div class="gallery-create-form-write">
	                                    <div class="gallery-create-form-name">
	                                        <input type="text" name="name" placeholder="마이너 갤러리의 이름을 간단히 넣어주세요."/>
	                                        <span>마이너 갤러리</span>
	                                    </div>
	                                    <div class="warn">※ 이름은 개설 후, 7일 내 1회만 수정할 수 있습니다.</div>
	                                    <div class="warn">※ 동일한 주제의 마이너 갤러리는 개설이 불가능합니다.</div>
	                                </div>
	                            </div>
	                            <div  class="gallery-create-form-space">
	                                <div class="gallery-create-form-sub">설명</div>
	                                <div class="gallery-create-form-write">
	                                    <textarea name="explain" placeholder="마이너 갤러리에 대한 설명을 넣어주세요."></textarea>
	                                </div>
	                            </div>
	                            <div  class="gallery-create-form-space">
	                                <div class="gallery-create-form-sub">주소<span>*</span></div>
	                                <div class="gallery-create-form-write">
	                                    <div class="gallery-create-form-url">
	                                        https://sjinside.com/
	                                        <input type="text" name="link" />
	                                    </div>
	                                    <div class="warn">※ 주소는 만들기 후 수정이 불가능합니다. 신중히 입력해주세요.</div>
	                                </div>
	                            </div>
	                            <div  class="gallery-create-form-space">
	                                <div class="gallery-create-form-sub">카테고리<span>*</span></div>
	                                <div class="gallery-create-form-write">
	                                    <select class="gallery-crate-form-category" name="gallery-category">
	                                        <option value="">카테고리를 선택해주세요.</option>
											@foreach ($categorys as $category)
		                                    	<option value="{{ $category->id }}">{{ $category->name }}</option>
		                                    @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                            <div  class="gallery-create-form-space">
	                                <div class="gallery-create-form-sub">개설이유<span>*</span></div>
	                                <div class="gallery-create-form-write">
	                                    <input name="reason" placeholder="운영자에게 전달되는 메세지입니다." type="text" class="gallery-crate-form-reason" />
	                                    <div class="warn">※ 마이너 갤러리 개설은 이름, 설명, 주소, 개설 이유에 따라 승인 또는 반려될 수 있습니다.</div>
	                                    <div class="warn">※ 개설 승인, 반려는 평일 정상근무 시간에 처리됩니다.</div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	                <div class="gallery-create-checkbox-container">
	                    <div class="gallery-create-checkbox-top">
	                        <div class="gallery-create-check1">
	                            <input type="checkbox" /> <span>마이너 갤러리 개인정보보호정책에 동의합니다.</span>
	                            <div class="agree-box">※ '마이너 갤러리 매니저'라 함은 마이너 갤러리 서비스 내 각 마이너 갤러리의 모든 운영권한을 갖는 '매니저'와 일부 운영권한을 갖는＇부매니저'를 말합니다.

	                                마이너 갤러리 매니저는 불필요한 개인정보를 수집하거나 처리하지 않도록 하며, 관련 법령 및 약관을 준수합니다.

	                                <b>1. 부정한 목적으로의 개인정보 처리 금지</b>
	                                금전적 이득 등을 위하여 부정한 목적으로 개인정보를 수집하거나 매매 등을 이용한 우회적인 개인정보 부정 판매 등이 적발될 경우, 디시인사이드는 관련 법령과 사이트 이용약관 및 마이너 갤러리 운영원칙 등에 따라 해당 마이너 갤러리에 대한 제재, 그리고 관련 법령에 따른 민형사상의 책임을 물을 수 있습니다.

	                                <b>2. 불필요한 개인정보에 대한 수집 및 이용 금지</b>
	                                불필요한 개인정보에 대한 수집, 이용을 해서는 안되며, 불가피하게 개인정보를 수집해야 하는 경우 최소한의 개인정보에 한해야 합니다. 또한, 관련 법령 및 이용약관, 운영원칙에 위배되지 않음을 합리적으로 증명할 수 있어야 합니다.

	                                <b>3. 개인정보의 수집 시 사전동의</b>
	                                개인정보를 수집하는 경우 반드시 사전에 '개인정보 항목, 수집목적, 보관기간, 개인정보의 수집을 거부할 권리 및 이로 인한 불이익'에 대해 명확히 고지하고, 정보주체(개인정보가 수집되는 다른 이용자)들의 개별 동의를 받아야 합니다.

	                                <b>4. 개인정보 제공의 금지</b>
	                                개인정보를 동의를 받아 수집한 경우라도 외부(수집한 사람을 제외한 모든 사람)에 제공하는 것은 원칙적으로 금지됩니다. 만약 외부에 제공하고자 하는 경우에는 정보주체에게 ‘제공받는 자, 제공하는 항목, 제공목적, 이용기간’을 명확히 고지하고 사전에 개별 동의를 받아야 합니다.

	                                <b>5. 주민등록번호 등 고유식별정보의 처리 금지</b>
	                                주민등록번호는 법령에 의하여 처리 근거가 있는 경우를 제외하고 어떤 목적으로도 처리할 수 없으며, 여권번호, 운전면허번호, 외국인 등록번호도 처리할 수 없습니다. 단, 불가피하게 처리가 필요한 경우에 한해 정보주체에게 사전에 개별 동의를 받아야 합니다.

	                                <b>6. 민감 정보의 처리 제한</b>
	                                사상/신념, 정치적 견해, 노동조합/정당의 가입/탈퇴, 건강 및 성생활 등에 관한 정보, 유전정보, 범죄경력’에 관한 정보는 법령에 의하여 처리 근거가 있는 경우를 제외하고 처리할 수 없습니다. 단, 불가피하게 처리가 필요한 경우, 정보 주체로부터 사전에 개인정보 활용 동의를 반드시 받은 후 처리를 할 수 있습니다.

	                                <b>7. 영리 목적의 개인정보 처리 금지</b>
	                                상품판매, 공동구매, 수강생 모집 등 여타의 영리 목적을 목적으로 개인정보를 처리하는 것은 어떠한 경우에도 금지됩니다.
	                                그 밖에 위에 기재하지 않은 사항은 디시인사이드 개인정보처리방침, 이용약관, 마이너 갤러리 서비스 운영원칙 등에서 정한 바에 의합니다.
	                            </div>
	                        </div>
	                        <div class="gallery-create-check2">
	                            <input type="checkbox" /> <span>마이너 갤러리 운영원칙에 동의합니다.</span>
	                            <div class="agree-box">마이너 갤러리 서비스는 이용자분들이 직접 만들고 운영하는 커뮤니티 공간으로 모든 이용자들은 아래 운영원칙을 준수해야 합니다.

	                            <b>[모든 이용자가 지켜야 하는 원칙]</b>
	                            모든 이용자는 마이너 갤러리 주제에 맞는 정상적인 활동을 해주셔야 합니다.
	                            마이너 갤러리 서비스에 등록하는 모든 콘텐츠의 저작권은 게시한 이용자 본인에게 있으며, 이로 인해 발생되는 문제에 대해서도 해당 게시물을 게시한 이용자에게 책임이 있습니다.
	                            모든 이용자는 이용약관 및 운영원칙을 준수해야 하며, 이를 지키지 않아 발생하는 문제에 대해 일체의 책임을 져야 합니다.

	                            <b>[매니저가 지켜야 하는 원칙]</b>
	                            '매니저'란 마이너 갤러리의 운영 권한을 갖는 이용자를 가리키는 단어입니다.
	                            매니저는 마이너 갤러리를 최초 개설하였거나, 이전 매니저로부터 마이너 갤러리를 위임받은 이용자로서 해당 마이너 갤러리를 대표하며, 마이너 갤러리를 관리할 수 있는 모든 권한과 책임을 갖고 있습니다.
	                            매니저는 이용약관, 운영원칙, 법령 등에 위배되는 게시물 또는 이용자의 행동을 방치한 경우 이에 대한 책임을 일차적으로 부담하게 됩니다. 단, 매니저는 이용 제한 사유에 해당하지 않는 글(매니저에 대한 비판글 포함)의 삭제, 이용자 차단, 금지어 설정 등으로 이용자들의 정상적인 활동을 제한해서는 안됩니다.
	                            매니저는 마이너 갤러리가 원활히 운영될 수 있도록 주기적으로 마이너 갤러리에 방문해 성실하고 공정한 관리를 다해야 합니다. 만약, 장기간(최소 10일 이상) 부재 시 다른 이용자에게 매니저의 책임과 권한이 이관될 수 있습니다.
	                            부매니저는 매니저가 임명하고 이를 수락한 이용자로 마이너 갤러리를 관리할 수 있는 일부 권한과 책임이 있습니다.

	                            <b>[이용제한 사유에 해당하는 금지 활동]</b>
	                            1. 음란물 유포
	                            외설적인 내용으로 성적 수치심과 혐오감을 유발하고 일반인의 성 관념에 위배되는 경우
	                            남녀의 성기, 음모, 항문을 묘사하거나 성행위 등을 표현하는 경우
	                            외설적인 내용으로 성적 수치심과 혐오감을 유발하고 일반인의 성 관념에 위배되는 경우
	                            윤락행위를 알선하거나 성관계를 목적으로 하는 만남 알선 내용

	                            2. 청소년 노출 부적합 게시물 유포
	                            일반적인 사람이 보기에 혐오스럽고 눈살이 찌푸려지는 사진 또는 내용을 작성 (인간/동물의 사체 또는 훼손된 모습, 방뇨/배설/살인/자살의 장면 등)
	                            차별/갈등 조장 활동
	                            스와핑, 동거 등 사회 윤리적으로 용납되지 않은 행위를 매개하는 경우
	                            존속에 대한 상해 폭행 살인 등 전통적인 가족윤리를 훼손할 우려가 있는 내용
	                            청소년 유해약물 등의 효능 및 제조방법 등을 구체적으로 기술하여 그 복용 제조 및 사용을 조장하거나 이를 매개하는 내용
	                            청소년에게 불건전한 교제를 조장할 우려가 있거나 이를 매개하는 내용

	                            3. 불법적 내용 유포
	                            범죄 관련 내용을 미화/권유/조장하는 내용
	                            범죄 행위를 청탁하거나 이를 권유, 유도 및 매개하는 내용
	                            타인을 협박, 위협하는 게시물
	                            여타의 범법 행위에 대한 동기 부여 및 실행에 도움이 되는 정보를 제공하는 내용
	                            불법제품, 통신판매가 금지된 품목에 대한 판매, 알선 행위
	                            해킹, 악성코드, 바이러스 유포하거나 타인의 권리를 침해할 수 있는 불법 자료를 유포하는 내용
	                            다단계 영업, 자살 권유, 불법 도박, 사행심 조장 등의 내용

	                            4. 도배, 스팸, 상업적 홍보 및 광고 활동
	                            동일한 내용을 반복적으로 등록하는 도배, 스팸 행위
	                            상업적 목적으로 마이너 갤러리를 운영하거나 게시물을 등록하는 행위

	                            5. 명예훼손 행위
	                            타인에게 수치심, 혐오감, 불쾌감을 일으키는 게시물
	                            타인의 사생활 침해, 명예훼손, 개인정보(이름, 주민번호, 연락처, 사진) 등을 게시한 경우
	                            욕설 또는 언어폭력 등의 저속한 표현으로 특정인의 인격을 모독하거나 불쾌감을 불러 일으키는 내용

	                            6. 저작권 침해 행위
	                            권리자의 동의 없이 자료를 불법 게시, 배포, 복제하는 경우
	                            저작권이 있는 소프트웨어 불법 다운로드 및 시리얼 넘버, 시디키 등를 공유하는 경우
	                            여타 타인의 지적재산권을 침해하는 행위

	                            7. 불법적 거래 행위
	                            타인에게 금전적 거래로 마이너 갤러리를 양도, 대여하거나 그에 준하는 행위
	                            타인을 기망하여 마이너 갤러리를 위임받거나 탈취하는 행위

	                            8. 기타 금지 행위
	                            마이너 갤러리의 주제와 동떨어진 내용과 상식에 어긋나는 내용으로 지속적으로 분란을 야기하는 경우
	                            특정 단어, 문구를 반복적으로 등록하는 행위
	                            홍보성 타 사이트 링크 포함 및 광고 게시물
	                            정상적인 활동으로 볼 수 없는 반복적인 마이너 갤러리 만들기, 폐쇄, 위임 등의 행위
	                            디시인사이드 회사 직원 또는 마이너 갤러리 서비스 운영진을 사칭하는 행위

	                            <b>[이용제한 내용]</b>
	                            1. 게시물 제한
	                            운영원칙에 어긋나는 게시물인 경우 타 이용자가 볼 수 없도록 노출이 제한됩니다.

	                            2. 이용자 이용 정지
	                            운영원칙에 어긋나는 행위를 한 이용자인 경우 게시물/댓글 등록 및 마이너 갤러리 개설 등의 활동을 할 수 없게 이용이 일시 또는 영구 정지됩니다.

	                            3. 매니저 해임
	                            매니저의 장기간 부재 또는 본 운영원칙에 위반되는 내용의 게시물의 방치 등 불성실한 운영 시 매니저를 해임할 수 있습니다.

	                            4. 마이너 갤러리 접근 제한
	                            운영원칙에 어긋나는 행위를 방치, 조장했거나 여타의 문제가 있는 경우 다른 이용자가 볼 수 없도록 마이너 갤러리 접근을 일시 또는 영구적으로 제한합니다.

	                            5. 마이너 갤러리 폐쇄
	                            중복된 주제의 개설, 개설 시와 무관한 주제로의 무단 변경, 운영원칙에 어긋나는 문제가 반복되거나 심대한 경우, 또는 수사기관의 요청, 불법적인 목적의 운영/개설 의도가 명확한 경우 해당 마이너 갤러리는 폐쇄 조치됩니다.
	                            </div>
	                        </div>
	                    </div>
	                        <div class="gallery-create-check3">
	                            <input type="checkbox" /> <span>메인 갤러리 승격에 동의합니다.</span>
	                            <div>신청하신 마이너 갤러리는 디시인사이드의 판단에 따라 메인 갤러리로 승격되고, 매니저 권한이 회수될 수 있습니다.</div>
	                        </div>
	                        <div class="gallery-create-notice">ㆍ게시물의 관리 의무와 권리는 매니저(개설자)에게 있으며, 운영원칙을 위반한 경우 폐쇄 또는 매니저 해임이 될 수 있습니다.(음란물, 불량 게시물, 상업적 게시물, 댓글의 방치 등)</div>
	                        <div class="gallery-btn-box">
	                            <button class="btn-gallery-cancel">취소</button>
	                            <button class="btn-gallery-submit">만들기</button>
	                        </div>
	                </div>
				</form>
            </div>
		</div>
	</body>
</html>
