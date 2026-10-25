@php
    $aboutTitle = page_section('about', 'title', $page->title . ', Hudayriyat Island', $page->slug);
    $defaultAboutDesc = '<p><strong>' . e($page->title) . '</strong> is a premier residential community by Modon Properties on Abu Dhabi’s prestigious Hudayriyat Island. Surrounded by pristine coastlines and lush parklands, this community offers a refined island lifestyle that effortlessly blends contemporary sophistication with seaside serenity.</p><p style="margin-top:1rem">Featuring open layouts, expansive terraces, and curated modern architecture, each residence is designed to maximize natural light and panoramic views of the Arabian Gulf and Abu Dhabi skyline.</p><p style="margin-top:1rem">Handover is planned for Q3 2030, with freehold ownership available for all nationalities.</p>';
    $aboutDesc = page_section('about', 'description', $defaultAboutDesc, $page->slug);
    $aboutPoster = page_section('about', 'video_poster', '/images/golf-estates/video-poster.jpg', $page->slug);
    $aboutVideo = page_section('about', 'video_src', 'https://www.hudayriyat-island.com/storage/communities/project_description/3ZADXnXTmIbZMrVsBFEsCxAN4vYhHKSeRNLwsGdd.mp4', $page->slug);
@endphp
<section id="alt-services" class="GolfAboutVideo-module__mC9tiq__aboutSection">
    <div class="container">
        <div class="GolfAboutVideo-module__mC9tiq__aboutGrid">
            <div class="GolfAboutVideo-module__mC9tiq__leftCol">
                <h2 class="GolfAboutVideo-module__mC9tiq__title">{!! $aboutTitle !!}</h2>
                <div class="GolfAboutVideo-module__mC9tiq__description">
                    {!! $aboutDesc !!}
                </div>
            </div>
            <div class="GolfAboutVideo-module__mC9tiq__rightCol">
                <div class="GolfAboutVideo-module__mC9tiq__videoWrapper">
                    <div class="GolfAboutVideo-module__mC9tiq__brownBackdrop"></div>
                    <div class="GolfAboutVideo-module__mC9tiq__videoContainer">
                        <video poster="{{ $aboutPoster }}" class="GolfAboutVideo-module__mC9tiq__videoPlayer">
                            <source src="{{ $aboutVideo }}" type="video/mp4"/>
                        </video>
                        <button type="button" class="GolfAboutVideo-module__mC9tiq__playButton" aria-label="Play video">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="#ffffff" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-play" aria-hidden="true">
                                <path d="M5 5a2 2 0 0 1 3.008-1.728l11.997 6.998a2 2 0 0 1 .003 3.458l-12 7A2 2 0 0 1 5 19z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
