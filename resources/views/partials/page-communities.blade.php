@php
    $secHeading = page_section('communities', 'heading', 'Projects', $page->slug ?? null);
    $secSubtitle = page_section('communities', 'subtitle', 'Explore the premier waterfront residential communities on Hudayriyat Island', $page->slug ?? null);
    
    $dbProjects = \App\Models\Project::where('is_active', true)->with('page')->orderBy('order', 'asc')->get();
    $hasDbProjects = $dbProjects->isNotEmpty();

    $secCommunities = page_section('communities', 'items', null, $page->slug ?? null);
    if (!is_array($secCommunities) || empty($secCommunities)) {
        $secCommunities = [
            [
                'name' => 'Wadeem Gardens',
                'location' => 'Hudayriyat Island, Abu Dhabi',
                'price' => 'Launch Price: 8.7M AED',
                'delivery' => 'Delivery Date: Q2 2031',
                'developer' => 'MÖDON',
                'paymentPlan' => 'Flexible Payment Plan',
                'href' => '/wadeem-gardens',
                'image' => '/images/communities/wadeem-gardens.png',
            ],
            [
                'name' => 'Hudayriyat Golf Estates',
                'location' => 'Hudayriyat Island, Abu Dhabi',
                'price' => 'Launch Price: 4.3M AED',
                'delivery' => 'Delivery Date: Q3 2030',
                'developer' => 'MÖDON',
                'paymentPlan' => 'Flexible Payment Plan',
                'href' => '/hudayriyat-golf-estates',
                'image' => '/images/communities/golf-estates.jpg',
            ],
            [
                'name' => 'Al Naseem Villas',
                'location' => 'Hudayriyat Island, Abu Dhabi',
                'price' => 'Launch Price: 7.8M AED',
                'delivery' => 'Delivery Date: Q1 2031',
                'developer' => 'MÖDON',
                'paymentPlan' => 'Flexible Payment Plan',
                'href' => '/al-naseem-villas',
                'image' => '/images/communities/al-naseem.jpg',
            ],
        ];
    }
@endphp

<section id="communities" aria-label="Featured Residential Projects and Communities" class="communitiesSection" style="padding: 20px 0 60px 0; background: #ffffff;">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">
        <!-- Section Header -->
        <div class="section-header" style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-size: 32px; font-weight: 700; color: #111827; margin: 0 0 10px 0;">{{ $secHeading }}</h2>
            @if(!empty($secSubtitle))
                <p style="font-size: 15px; color: #6b7280; max-width: 700px; margin: 0 auto; line-height: 1.6;">{{ $secSubtitle }}</p>
            @endif
        </div>

        <!-- Communities Grid -->
        <div class="communitiesGrid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(320px, 1fr)); gap: 26px;">
            @if($hasDbProjects)
                @foreach($dbProjects as $index => $item)
                    @php
                        $imgSrc = $item->image_url;
                        $cardHref = $item->url;
                    @endphp
                    <a href="{{ $cardHref }}" class="cardCustom" style="text-decoration: none; cursor: pointer;" aria-label="{{ $item->title }} by {{ $item->developer ?? 'Modon Properties' }}">
                        <!-- Top-Left Launch Price & Delivery Badges -->
                        <div class="topTags">
                            @if(!empty($item->price))
                                <span class="badgeTag">{{ $item->price }}</span>
                            @endif
                            @if(!empty($item->delivery_date))
                                <span class="badgeTag">{{ $item->delivery_date }}</span>
                            @endif
                        </div>

                        <!-- Top-Right Sparkle Icon -->
                        <div class="sparkleBtn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/>
                            </svg>
                        </div>

                        <!-- Main Image -->
                        <div class="imgWrapper">
                            <img src="{{ $imgSrc }}" alt="{{ $item->title }} luxury property by Modon Properties" class="mainImage" loading="lazy">
                        </div>

                        <!-- Bottom Content Area -->
                        <div class="bottomContent">
                            <div class="modonBadge">
                                <span class="modonText">{{ $item->developer ?? 'MÖDON' }}</span>
                            </div>

                            <h3 class="cardTitle">{{ $item->title }}</h3>
                            <p class="cardLocation">{{ $item->location ?? 'Hudayriyat Island, Abu Dhabi' }}</p>

                            @if(!empty($item->payment_plan))
                                <div class="planBadge">{{ $item->payment_plan }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                @foreach($secCommunities as $index => $item)
                    @php
                        $imgSrc = $item['image'] ?? '/images/communities/wadeem-gardens.png';
                        $cardHref = $item['href'] ?? '#';
                    @endphp
                    <a href="{{ $cardHref }}" class="cardCustom" style="text-decoration: none; cursor: pointer;">
                        <!-- Top-Left Launch Price & Delivery Badges -->
                    <div class="topTags">
                        @if(!empty($item['price']))
                            <span class="badgeTag">{{ $item['price'] }}</span>
                        @endif
                        @if(!empty($item['delivery']))
                            <span class="badgeTag">{{ $item['delivery'] }}</span>
                        @endif
                    </div>

                    <!-- Top-Right Sparkle Icon -->
                    <div class="sparkleBtn">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/>
                        </svg>
                    </div>

                    <!-- Main Community Photo -->
                    <img src="{{ $imgSrc }}" alt="{{ $item['name'] ?? '' }}" class="mainImage">

                    <!-- Bottom Content Area -->
                    <div class="bottomContent">
                        <!-- Developer Modon Badge -->
                        <div class="modonBadge">
                            <span class="modonText">{{ $item['developer'] ?? 'MÖDON' }}</span>
                        </div>

                        <!-- Community Title -->
                        <h3 class="cardTitle">{{ $item['name'] ?? '' }}</h3>

                        <!-- Location -->
                        <p class="cardLocation">{{ $item['location'] ?? 'Hudayriyat Island, Abu Dhabi' }}</p>

                        <!-- Payment Plan Badge -->
                        @if(!empty($item['paymentPlan']) || !empty($item['payment_plan']))
                            <div class="planBadge">{{ $item['paymentPlan'] ?? $item['payment_plan'] }}</div>
                        @endif
                    </div>
                </a>
            @endforeach
            @endif
        </div>
    </div>
</section>

<style>
.cardCustom {
    position: relative;
    height: 460px;
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    cursor: pointer;
    transition: transform 0.35s cubic-bezier(0.165, 0.84, 0.44, 1), box-shadow 0.35s ease;
    background: #111111;
    display: block;
}

.cardCustom:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 42px rgba(0, 0, 0, 0.22);
}

.mainImage {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.6s ease;
}

.cardCustom:hover .mainImage {
    transform: scale(1.06);
}

.topTags {
    position: absolute;
    top: 14px;
    left: 14px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    z-index: 3;
}

.badgeTag {
    background: rgba(0, 0, 0, 0.55);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    color: #ffffff;
    font-size: 11.5px;
    font-weight: 600;
    padding: 5px 12px;
    border-radius: 999px;
    width: fit-content;
    letter-spacing: 0.2px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

.sparkleBtn {
    position: absolute;
    top: 14px;
    right: 14px;
    width: 38px;
    height: 38px;
    border-radius: 50%;
    background: #1a4731;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    box-shadow: 0 4px 14px rgba(26, 71, 49, 0.45);
    transition: transform 0.25s ease, background-color 0.25s ease;
}

.cardCustom:hover .sparkleBtn {
    transform: scale(1.08);
    background: #123322;
}

.bottomContent {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 35px 20px 22px;
    background: linear-gradient(
        to top,
        rgba(0, 0, 0, 0.94) 0%,
        rgba(0, 0, 0, 0.75) 50%,
        rgba(0, 0, 0, 0.3) 80%,
        transparent 100%
    );
    z-index: 2;
    display: flex;
    flex-direction: column;
    gap: 7px;
}

.modonBadge {
    background: #ffffff;
    padding: 5px 12px;
    border-radius: 5px;
    width: fit-content;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.18);
    margin-bottom: 4px;
}

.modonText {
    font-weight: 900;
    font-size: 13.5px;
    letter-spacing: 1.6px;
    color: #111111;
    text-transform: uppercase;
    font-family: inherit;
    line-height: 1.1;
}

.cardTitle {
    font-size: 21px;
    font-weight: 700;
    color: #ffffff;
    line-height: 1.22;
    margin: 0;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
}

.cardLocation {
    font-size: 13px;
    color: rgba(255, 255, 255, 0.88);
    margin: 0;
    line-height: 1.4;
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.5);
}

.planBadge {
    background: #ffffff;
    color: #1a1a1a;
    font-size: 12px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 999px;
    width: fit-content;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
    margin-top: 3px;
}

@media (max-width: 768px) {
    .communitiesGrid {
        grid-template-columns: 1fr !important;
    }
}
</style>
