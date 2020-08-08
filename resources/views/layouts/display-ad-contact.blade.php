<!DOCTYPE html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/sjinside-icon-white.png') }}"/>
    <title>@yield('title', '없음')</title>
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">
    <script defer src="{{ asset('assets/js/display-ad.js') }}"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1:wght@800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
</head>
<body>
    <!-- Header Part Start -->
    <div class="display-ad-header darker">
        <a href="/" class="header-logo-a"><img src="{{ asset('assets/img/sjinside-white.png') }}" class="display-ad-header-logo"/></a>
        <a href="/" class="header-mobile-logo-a"><img src="{{ asset('assets/img/sjinside-icon-white.png') }}" class="display-ad-header-mobile-logo" /></a>
        <ul class="display-ad-header-menu">
            <li class="display-ad-header-menu-item"><a href="{{ route('display-ad.index') }}">광고 안내</a>
            <div class="menuline"></div></li>
            <li class="display-ad-header-menu-bar">|</li>
            <li class="display-ad-header-menu-item active"><a href="{{ route('display-ad.create') }}">광고 문의</a>
            <div class="menuline-active"></div>
            </li>
        </ul>
    </div>
    <!-- Header Part End -->

    <!-- Main Contact Part Start -->
    <form action="{{ route('display-ad.store') }}" method="post" enctype="multipart/form-data">
        @method('POST')
        @csrf
        <div class="display-ad-contact-container">
            <div class="contact-title">광고문의</div>
            <div class="contact-box">
                <ul class="contact-form">
                    <li class="contact-form-line">
                        <div class="contact-form-sort">문의 유형<span class="red">*</span></div>
                        <select name="category" class="contact-form-select">
                            <option value="디스플레이 광고">디스플레이 광고</option>
                            <option value="팝업 광고">팝업 광고</option>
                            <option value="이벤트 문의">이벤트 문의</option>
                        </select>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">회사명<span class="red">*</span></div>
                        <input name="co_name" type="text" class="contact-form-writespace"/>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">담당자명<span class="red">*</span></div>
                        <input name="director" type="text" class="contact-form-writespace"/>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">연락처<span class="red">*</span></div>
                        <input name="phone" type="text" class="contact-form-writespace"/>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">이메일<span class="red">*</span></div>
                        <input name="email" type="text" class="contact-form-writespace"/>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">업체 구분<span class="red">*</span></div>
                        <select name="division" class="contact-form-select">
                            <option value="광고주">광고주</option>
                            <option value="대행사">대행사</option>
                            <option value="미디어랩">미디어랩</option>
                            <option value="기타">기타</option>
                        </select>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">제안명<span class="red">*</span></div>
                        <input name="title" type="text" class="contact-form-writespace"/>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">광고기간<span class="red">*</span></div>
                        <input name="term" type="text" placeholder="Ex) 1개월, 25일, 7일 or 12/27~12/31, 1/1~1/31 등" class="contact-form-writespace"/>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">희망예산<span class="red">*</span></div>
                        <input name="hopemoney" type="text" placeholder="Ex) 300만 원, 500만 원" class="contact-form-writespace"/>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">내용<span class="red">*</span></div>
                        <textarea name="contents" placeholder="Ex) 야구 게임 광고, 공무원 학원 광고 등" class="contact-form-textarea"></textarea>
                    </li>
                    <li class="contact-form-line">
                        <div class="contact-form-sort">첨부파일</div>
                        <div class="contact-form-filebox">
                            <input type="text" readonly class="input-filebox" placeholder="첨부 가능 최대 용량: 10MB" />
                            <div class="btn-filebox">
                                <label for="upload-file">파일 선택</label>
                                <input name="image" type="file" id="upload-file">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="contact-checkbox-container">
                <div class="contact-checkbox-sub">ㆍ개인정보 수집 및 이용에 대한 안내</div>
                <div class="contact-checkbox-info">SJ인사이드는 제휴를 희망하는 기업 및 개인을 대상으로 아래와 같이 개인정보를 수집하고 있습니다.
                1. 수집 개인정보 항목 : 회사명, 담당자명, 연락처, 이메일
                2. 개인정보의 수집 및 이용목적 : 제휴신청에 따른 본인확인 및 원활한 의사소통 경로 확보
                3. 개인정보의 이용기간 : 제휴제안 검토를 위해 정보를 수집하며, 3개월 이후 자동파기 됩니다.
                그 밖의 사항은 개인정보처리방침을 준수합니다.
                </div>
                <div class="contact-checkbox-confirm">
                    <input name="check1" type="checkbox"/>내용을 확인하였으며, 동의합니다.
                </div>
                <div class="dotline"></div>
                <div class="contact-checkbox-sub">ㆍ유의사항</div>
                <div class="contact-checkbox-info">SJ인사이드에서는 보내주신 제안을 소중하게 생각합니다. 제안해 주신 부분에 대해서는 채택되지 않을 수 있으며, 채택 시에는 연락을 드려 함께 진행할 수 있도록 하겠습니다. 기입하신 정보는 3개월 이후 자동파기 됩니다.
                </div>
                <div class="contact-checkbox-confirm">
                    <input name="check2" type="checkbox"/>내용을 확인하였으며, 동의합니다.
                </div>
                <div class="contat-btn-container">
                    <button class="btn-contact back">취소</button>
                    <button class="btn-contact">보내기</button>
                </div>
            </div>
        </div>
        <!-- Main Mid Part End -->

        <!-- Footer Part Start -->
        <div class="display-ad-footer">
            <ul class="display-ad-footer-menu">
                <li class="display-ad-footer-menu-item">회사소개</li>
                <li class="display-ad-footer-menu-bar">|</li>
                <li class="display-ad-footer-menu-item">인재채용</li>
                <li class="display-ad-footer-menu-bar">|</li>
                <li class="display-ad-footer-menu-item">제휴안내</li>
                <li class="display-ad-footer-menu-bar">|</li>
                <li class="display-ad-footer-menu-item">광고안내</li>
                <li class="display-ad-footer-menu-bar">|</li>
                <li class="display-ad-footer-menu-item">이용약관</li>
                <li class="display-ad-footer-menu-bar">|</li>
                <li class="display-ad-footer-menu-item">개인정보처리방침</li>
                <li class="display-ad-footer-menu-bar">|</li>
                <li class="display-ad-footer-menu-item">청소년보호정책</li>
            </ul>
            <span class="display-ad-footer-copyright">Copyright ⓒ 1999 - 2020 sjinside. All rights reserved.</span>
        </div>
    </form>
    <!-- Footer Part End -->
</body>
</html>
