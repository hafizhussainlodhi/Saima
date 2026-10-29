@php
    $homeBlogs = \App\Models\Blog::where('status', 'publish')
        ->orderBy('created_at', 'desc')
        ->orderBy('id', 'desc')
        ->take(4)
        ->get();
@endphp

@if($homeBlogs->isNotEmpty())
<style>
.homeBlogsSection {
    padding: 30px 0 75px 0;
    background-color: #ffffff;
}

.homeBlogsContainer {
    width: 100%;
    max-width: 1320px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
}

.homeBlogsGrid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
}

.homeBlogCard {
    position: relative;
    border-radius: 18px;
    overflow: hidden;
    height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 22px 20px;
    text-decoration: none;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease;
    box-sizing: border-box;
    cursor: pointer;
}

.homeBlogCard:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.22);
}

/* Dark Gradient Overlay for readability of title & description */
.homeBlogCard::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.08) 0%, rgba(0, 0, 0, 0.22) 40%, rgba(0, 0, 0, 0.88) 100%);
    transition: background 0.35s ease;
    z-index: 1;
}

.homeBlogCard:hover::before {
    background: linear-gradient(180deg, rgba(0, 0, 0, 0.05) 0%, rgba(0, 0, 0, 0.28) 35%, rgba(0, 0, 0, 0.94) 100%);
}

/* Category Badge (Top Left Pill matching user reference) */
.homeBlogCategoryBadge {
    position: relative;
    z-index: 2;
    align-self: flex-start;
    background: #ffffff;
    color: #1e293b;
    font-size: 11.5px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 999px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
    letter-spacing: 0.02em;
    text-transform: capitalize;
}

/* Bottom Content Container */
.homeBlogBottomContent {
    position: relative;
    z-index: 2;
    display: flex;
    flex-direction: column;
    gap: 8px;
}

.homeBlogTitle {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 17.5px;
    font-weight: 700;
    line-height: 1.35;
    color: #ffffff;
    margin: 0;
    letter-spacing: -0.01em;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.homeBlogExcerpt {
    font-size: 13px;
    line-height: 1.45;
    color: #e2e8f0;
    margin: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.8);
    opacity: 0.92;
}

@media (max-width: 1024px) {
    .homeBlogsGrid {
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }
    .homeBlogCard {
        height: 380px;
    }
}

@media (max-width: 640px) {
    .homeBlogsGrid {
        grid-template-columns: 1fr;
        gap: 18px;
    }
    .homeBlogCard {
        height: 360px;
    }
    .homeBlogsHeading {
        font-size: 28px;
    }
}
</style>

<section id="home-blogs" aria-label="Latest News & Articles" class="homeBlogsSection">
    <div class="homeBlogsContainer">


        <!-- 4 Cards Grid -->
        <div class="homeBlogsGrid">
            @foreach($homeBlogs as $b)
                @php
                    $coverSrc = $b->cover_image ? asset($b->cover_image) : asset('/images/Hudayriyat-Island---Marsana-East-Beach---Sign---Sunset-2.jpg');
                @endphp
                <a href="{{ url('/blog/' . $b->slug) }}" class="homeBlogCard" style="background-image: url('{{ $coverSrc }}');">
                    <!-- Category Badge (Top Left) -->
                    <span class="homeBlogCategoryBadge">{{ $b->category }}</span>

                    <!-- Bottom Content (Title + Short Content) -->
                    <div class="homeBlogBottomContent">
                        <h3 class="homeBlogTitle">{{ $b->title }}</h3>
                        @if(!empty($b->short_content))
                            <p class="homeBlogExcerpt">{{ \Illuminate\Support\Str::limit(strip_tags($b->short_content), 75) }}</p>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
