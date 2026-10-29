@extends('layouts.app')

@section('title', 'Insights & Articles | Blog')
@section('meta_description', 'Explore the latest real estate updates, market insights, and lifestyle blogs.')

@section('content')
<style>
.blogsListingWrapper {
    width: 100%;
    background-color: #f8fafc;
    min-height: 80vh;
    padding-bottom: 80px;
    font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.blogsHero {
    background: linear-gradient(135deg, #102a1c 0%, #1a4731 100%);
    color: #ffffff;
    padding: 60px 0 50px 0;
    text-align: center;
}

.blogsHeroContainer {
    max-width: 900px;
    margin: 0 auto;
    padding: 0 20px;
}

.blogsHeroBadge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.16);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.25);
    padding: 5px 16px;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 14px;
}

.blogsHeroTitle {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 38px;
    font-weight: 800;
    color: #ffffff;
    margin: 0 0 12px 0;
    letter-spacing: -0.01em;
}

.blogsHeroSubtitle {
    font-size: 17px;
    color: #d1fae5;
    margin: 0;
    line-height: 1.6;
}

/* Blogs Grid */
.blogsGridContainer {
    max-width: 1240px;
    margin: -30px auto 0 auto;
    padding: 0 20px;
    position: relative;
    z-index: 3;
}

.blogsGrid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.blogCard {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    display: flex;
    flex-direction: column;
    transition: all 0.25s ease;
    text-decoration: none;
    color: inherit;
}

.blogCard:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.08);
    border-color: #cbd5e1;
}

.blogCardImageWrap {
    width: 100%;
    height: 220px;
    position: relative;
    overflow: hidden;
    background: #e2e8f0;
}

.blogCardImage {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.35s ease;
}

.blogCard:hover .blogCardImage {
    transform: scale(1.04);
}

.blogCardCategory {
    position: absolute;
    top: 14px;
    left: 14px;
    background: #1a4731;
    color: #ffffff;
    padding: 4px 12px;
    border-radius: 999px;
    font-size: 11.5px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
}

.blogCardBody {
    padding: 22px 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.blogCardDate {
    font-size: 12.5px;
    color: #94a3b8;
    margin-bottom: 8px;
    font-weight: 500;
}

.blogCardTitle {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 19px;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 10px 0;
    line-height: 1.4;
    transition: color 0.15s ease;
}

.blogCard:hover .blogCardTitle {
    color: #1a4731;
}

.blogCardExcerpt {
    font-size: 14.5px;
    color: #64748b;
    line-height: 1.65;
    margin: 0 0 18px 0;
    flex: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blogCardLink {
    font-size: 14px;
    font-weight: 700;
    color: #1a4731;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: auto;
}

.blogCardLink svg {
    transition: transform 0.2s ease;
}

.blogCard:hover .blogCardLink svg {
    transform: translateX(3px);
}

@media (max-width: 991px) {
    .blogsGrid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 600px) {
    .blogsGrid {
        grid-template-columns: 1fr;
    }
    .blogsHeroTitle {
        font-size: 28px;
    }
}
</style>

<div class="blogsListingWrapper">
    <!-- Hero Banner -->
    <section class="blogsHero">
        <div class="blogsHeroContainer">
            <span class="blogsHeroBadge">Editorial &amp; Insights</span>
            <h1 class="blogsHeroTitle">Latest Blogs &amp; Articles</h1>
            <p class="blogsHeroSubtitle">Stay informed with in-depth analysis, investment opportunities, and property guides.</p>
        </div>
    </section>

    <!-- Grid of Blogs -->
    <div class="blogsGridContainer">
        @if($blogs->isEmpty())
            <div style="background: #ffffff; border-radius: 16px; padding: 60px 20px; text-align: center; border: 1px solid #e2e8f0;">
                <p style="font-size: 16px; color: #64748b; margin: 0;">No articles published yet. Check back soon!</p>
            </div>
        @else
            <div class="blogsGrid">
                @foreach($blogs as $b)
                    <a href="{{ url('/blog/' . $b->slug) }}" class="blogCard">
                        <div class="blogCardImageWrap">
                            <img src="{{ asset($b->cover_image ?: '/images/Hudayriyat-Island---Marsana-East-Beach---Sign---Sunset-2.jpg') }}" alt="{{ $b->title }}" class="blogCardImage">
                            @if(!empty($b->category))
                                <span class="blogCardCategory">{{ $b->category }}</span>
                            @endif
                        </div>
                        <div class="blogCardBody">
                            <div class="blogCardDate">
                                {{ $b->created_at ? $b->created_at->format('M d, Y') : date('M d, Y') }}
                                @if(!empty($b->author)) &bull; {{ $b->author }} @endif
                            </div>
                            <h2 class="blogCardTitle">{{ $b->title }}</h2>
                            <p class="blogCardExcerpt">{{ $b->short_content ?: \Illuminate\Support\Str::limit(strip_tags($b->content), 120) }}</p>
                            <div class="blogCardLink">
                                <span>Read Full Article</span>
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
