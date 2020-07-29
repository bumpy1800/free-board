<div class="mainFoot">
    <table class="table">
        <thead class="notice">
            <tr>
            <th scope="col" class="fir"><a class="" href="{{ route('notice.index') }}">공지사항</a></th>
            <th scope="col"></th>
            <th scope="col" class="las"></th>
            </tr>
        </thead>
        <tbody>
            <tr class="LRline">
                <th class="pdB6 Rline" scope="row"><b>갤러리</b></th>
                <th class="pdB6 Rline" scope="row"><b>인기갤러리</b></th>
                <th class="pdB6 Rline" scope="row"><b>주요서비스</b></th>
            </tr>
            <tr class="LRline">
                <td class="pdT0 pdB6 Rline">
                    <a href="{{ route('gallery-hit.index') }}">HIT 갤러리</a>
                    <a href="{{ route('notice.index') }}">공지사항</a>
                </td>
                <td class="pdT0 pdB6 Rline">
                    {{--@foreach($footer_gallerys as $footer_gallery)
                        <a href="{{ route('gallery.show', $footer_gallery->gallery_link) }}">{{ $footer_gallery->gallery_name }}</a>
                    @endforEach --}}
                </td>
                <td class="pdT0 pdB6 Rline">
                    <a href="">갤로그</a>
                    <a href="">신고</a>
                    <a href="">Q&A</a>
                    <a href="">이벤트</a>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="ad">
        <span class="ad-info"><a href="/"><b>광고 안내</b></a></span>
        <span class="ad-display"><a href="/">디스플레이광고</a></span>
        <span class="mLine">|</span>
        <span class="ad-promotion"><a href="/">프로모션</a></span>
        <span class="mLine">|</span>
        <span class="ad-question"><a href="/">광고문의</a></span>
    </div>

    <div class="biz">
        <span><a href="/">회사소개</a></span>
        <span class="mLine">|</span>
        <span><a href="/">인재채용</a></span>
        <span class="mLine">|</span>
        <span><a href="/">제휴안내</a></span>
        <span class="mLine">|</span>
        <span><a href="/">광고안내</a></span>
        <span class="mLine">|</span>
        <span><a href="/">이용약관</a></span>
        <span class="mLine">|</span>
        <span><a href="/"><b>개인정보처리방침</b></a></span>
        <span class="mLine">|</span>
        <span><a href="/">청소년보호정책</a></span>
        <div class="copy">
            Copyright &copy; 2020 - 2020 KSK&amp;KJS. All rights reserved.
        </div>
    </div>
</div>
