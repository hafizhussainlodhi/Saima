@php
    $aboutTitle = page_section('about', 'title', $page->title . ', Hudayriyat Island', $page->slug);
    $aboutDesc = page_section('about', 'description', '', $page->slug);
    $aboutPoster = page_section('about', 'video_poster', '', $page->slug);
    $aboutVideo = page_section('about', 'video_src', '', $page->slug);
@endphp
@if(!empty(trim(strip_tags((string)$aboutDesc))) || !empty($aboutPoster))
<style>
.GolfAboutVideo-module__mC9tiq__description p {
    margin-top: 0 !important;
    margin-bottom: 20px !important;
    line-height: 1.8 !important;
    min-height: 1.25em !important;
    display: block !important;
}
.GolfAboutVideo-module__mC9tiq__description p:last-child {
    margin-bottom: 0 !important;
}
</style>
<section id="alt-services" class="GolfAboutVideo-module__mC9tiq__aboutSection">
    <div class="container">
        <div class="GolfAboutVideo-module__mC9tiq__aboutGrid">
            <div class="GolfAboutVideo-module__mC9tiq__leftCol">
                <h2 class="GolfAboutVideo-module__mC9tiq__title">{!! $aboutTitle !!}</h2>
                <div class="GolfAboutVideo-module__mC9tiq__description">
                    {!! $aboutDesc !!}
                </div>
            </div>
            @if(!empty($aboutPoster))
            <div class="GolfAboutVideo-module__mC9tiq__rightCol">
                <div class="GolfAboutVideo-module__mC9tiq__videoWrapper">
                    <div class="GolfAboutVideo-module__mC9tiq__brownBackdrop"></div>
                    <div class="GolfAboutVideo-module__mC9tiq__videoContainer">
                        <img src="{{ $aboutPoster }}" alt="{{ $page->title ?? 'About' }}" class="GolfAboutVideo-module__mC9tiq__videoPlayer" style="width: 100%; height: 100%; object-fit: cover; display: block; border-radius: inherit;">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endif
