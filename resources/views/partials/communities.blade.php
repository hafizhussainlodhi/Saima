@php
$dbHeading = page_section('communities', 'heading', 'Projects');
$dbProjects = \App\Models\Project::where('is_active', true)->with('page')->orderBy('order', 'asc')->get();

$hasDbProjects = $dbProjects->isNotEmpty();

$communitiesData = [
    [
        'name' => 'Wadeem Gardens',
        'image' => asset('images/communities/wadeem-gardens.png'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 8.7M AED',
        'delivery' => 'Delivery Date: Q2 2031',
        'developer' => 'Modon Properties',
        'paymentPlan' => 'Flexible Payment Plan',
        'href' => '/wadeem-gardens',
    ],
    [
        'name' => 'Hudayriyat Golf Estates',
        'image' => asset('images/communities/golf-estates.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 4.3M AED*',
        'delivery' => 'Delivery Date: Q3 2030',
        'developer' => 'Modon Properties',
        'paymentPlan' => '5/35/60 Payment Plan',
        'href' => '/hudayriyat-golf-estates',
    ],
    [
        'name' => 'Bashayer Residences',
        'image' => asset('images/communities/bashayer-residences.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 2.4M AED',
        'delivery' => 'Delivery Date: Q1 2030',
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/40/50 Payment Plan',
        'href' => '/bashayer-residences',
    ],
    [
        'name' => 'Nawayef East Hills',
        'image' => asset('images/communities/nawayef-east.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 6.6M AED',
        'delivery' => 'Delivery Date: Q1 2028',
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/30/60 Payment Plan',
        'href' => '/nawayef-east-hills',
    ],
    [
        'name' => 'Bashayer Villas',
        'image' => asset('images/communities/bashayer-villas.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 6M AED',
        'delivery' => 'Delivery Date: Q3 2028',
        'developer' => 'Modon Properties',
        'paymentPlan' => '20/30/50 Payment Plan',
        'href' => '/bashayer-villas',
    ],
    [
        'name' => 'Al Naseem Villas',
        'image' => asset('images/communities/al-naseem.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 7.8M AED',
        'delivery' => 'Delivery Date: Q4 2026',
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/30/60 Payment Plan',
        'href' => '/al-naseem-villas',
    ],
    [
        'name' => 'Masyaf Plots',
        'image' => asset('images/communities/masyaf-plots.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: Launch Soon',
        'delivery' => 'Delivery Date: Launch Soon',
        'developer' => 'Modon Properties',
        'paymentPlan' => 'Payment Plan: Launch Soon',
        'href' => '/masyaf-plots',
    ],
    [
        'name' => 'Nawayef Village',
        'image' => asset('images/communities/nawayef-village.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 4.1M AED',
        'delivery' => 'Delivery Date: Q1 2029',
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/40/50 Payment Plan',
        'href' => '/nawayef-village',
    ],
    [
        'name' => 'Wadeem Plots',
        'image' => asset('images/communities/wadeem-plots.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 3.7M AED',
        'delivery' => 'Delivery Date: Q4 2028',
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/40/50 Payment Plan',
        'href' => '/wadeem-plots',
    ],
    [
        'name' => 'Nawayef Park Views',
        'image' => asset('images/communities/nawayef-park-views.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'price' => 'Launch Price: 2.1M AED',
        'delivery' => 'Delivery Date: Q1 2028',
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/40/50 Payment Plan',
        'href' => '/nawayef-park-views',
    ],
];
@endphp

<section id="communities" aria-label="Featured Residential Projects and Communities" class="communitiesSection">
    <div class="container">
        <!-- Section Header -->
        <div class="section-header" style="padding-bottom: 40px;">
            <h2>{{ $dbHeading }}</h2>
        </div>

        <!-- Communities Grid -->
        <div class="communitiesGrid">
            @if($hasDbProjects)
                @foreach($dbProjects as $index => $item)
                    @php
                        $targetUrl = $item->url;
                        $imgSrc = $item->image_url;
                    @endphp
                    <a href="{{ $targetUrl }}" class="cardCustom {{ $index === 8 ? 'centeredRowStart' : '' }}" style="text-decoration: none; cursor: pointer;" aria-label="{{ $item->title }} by {{ $item->developer ?? 'Modon Properties' }}">
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

                        <!-- Main Community Photo -->
                        <img src="{{ $imgSrc }}" alt="{{ $item->title }} luxury property by Modon Properties at Hudayriyat Island Abu Dhabi" class="mainImage">

                        <!-- Bottom Content Area -->
                        <div class="bottomContent">
                            <!-- Developer Modon Badge -->
                            <div class="modonBadge">
                                <span class="modonText">{{ $item->developer ?? 'MÖDON' }}</span>
                            </div>

                            <!-- Community Title -->
                            <h3 class="cardTitle">{{ $item->title }}</h3>

                            <!-- Location -->
                            <p class="cardLocation">{{ $item->location ?? 'Hudayriyat Island, Abu Dhabi' }}</p>

                            <!-- Payment Plan Badge -->
                            @if(!empty($item->payment_plan))
                                <div class="planBadge">{{ $item->payment_plan }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            @else
                @foreach($communitiesData as $index => $item)
                    @php
                        $imgSrc = $item['image'] ?? '';
                        if ($imgSrc && !str_starts_with($imgSrc, 'http') && !str_starts_with($imgSrc, '/')) {
                            $imgSrc = asset($imgSrc);
                        }
                    @endphp
                    <a href="{{ $item['href'] ?? '#' }}" class="cardCustom {{ $index === 8 ? 'centeredRowStart' : '' }}" style="text-decoration: none; cursor: pointer;" aria-label="{{ $item['name'] }} by Modon Properties">
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
                        <img src="{{ $imgSrc }}" alt="{{ $item['name'] ?? '' }} luxury property by Modon Properties at Hudayriyat Island Abu Dhabi" class="mainImage">

                        <!-- Bottom Content Area -->
                        <div class="bottomContent">
                            <!-- Developer Modon Badge -->
                            <div class="modonBadge">
                                <span class="modonText">{{ $item['developer'] ?? 'MÖDON' }}</span>
                            </div>

                            <!-- Community Title -->
                            <h3 class="cardTitle">{{ $item['name'] ?? '' }}</h3>

                            <!-- Location -->
                            <p class="cardLocation">{{ $item['location'] ?? '' }}</p>

                            <!-- Payment Plan Badge -->
                            @if(!empty($item['paymentPlan']))
                                <div class="planBadge">{{ $item['paymentPlan'] }}</div>
                            @endif
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</section>
