@php
$dbHeading = page_section('communities', 'heading', 'Projects');

// Retrieve Home page or current page communities section data
$curPage = page_data('/') ?? (page_data('home') ?? page_data());
$commSec = $curPage ? $curPage->sections()->whereIn('section_key', ['communities', 'projects'])->first() : null;
$commSecData = $commSec ? ($commSec->content ?? []) : [];
$unselectedProjectIds = (array) ($commSecData['unselected_ids'] ?? []);
$selectedProjectIds = (array) ($commSecData['selected_ids'] ?? ($commSecData['project_ids'] ?? []));

$allDbProjects = \App\Models\Project::where('is_active', true)->with('page')->orderBy('order', 'asc')->get();

if (!empty($unselectedProjectIds) || !empty($selectedProjectIds)) {
    // Exclude projects explicitly unselected by mouse in CMS
    $unselectedInts = array_map('intval', $unselectedProjectIds);
    $filteredProjects = $allDbProjects->reject(function($p) use ($unselectedInts) {
        return in_array((int)$p->id, $unselectedInts, true);
    });

    // If custom order of selected cards was saved, preserve it; append new projects at the end
    if (!empty($selectedProjectIds)) {
        $idOrderMap = array_flip(array_map('intval', $selectedProjectIds));
        $dbProjects = $filteredProjects->sortBy(function($p) use ($idOrderMap) {
            return $idOrderMap[(int)$p->id] ?? -1;
        })->values();
    } else {
        $dbProjects = $filteredProjects->values();
    }
} else {
    // By default, show all active projects (any newly added project is included by default)
    $dbProjects = $allDbProjects;
}

$hasDbProjects = $dbProjects->isNotEmpty();

$communitiesData = [
    [
        'name' => 'Wadeem Gardens',
        'image' => asset('images/communities/wadeem-gardens.png'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Off plan'],
        'developer' => 'Modon Properties',
        'paymentPlan' => 'Flexible Payment Plan',
        'href' => '/wadeem-gardens',
    ],
    [
        'name' => 'Hudayriyat Golf Estates',
        'image' => asset('images/communities/golf-estates.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['New'],
        'developer' => 'Modon Properties',
        'paymentPlan' => '5/35/60 Payment Plan',
        'href' => '/hudayriyat-golf-estates',
    ],
    [
        'name' => 'Bashayer Residences',
        'image' => asset('images/communities/bashayer-residences.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Off plan'],
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/40/50 Payment Plan',
        'href' => '/bashayer-residences',
    ],
    [
        'name' => 'Nawayef East Hills',
        'image' => asset('images/communities/nawayef-east.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Offer'],
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/30/60 Payment Plan',
        'href' => '/nawayef-east-hills',
    ],
    [
        'name' => 'Bashayer Villas',
        'image' => asset('images/communities/bashayer-villas.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Off plan'],
        'developer' => 'Modon Properties',
        'paymentPlan' => '20/30/50 Payment Plan',
        'href' => '/bashayer-villas',
    ],
    [
        'name' => 'Al Naseem Villas',
        'image' => asset('images/communities/al-naseem.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Ready'],
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/30/60 Payment Plan',
        'href' => '/al-naseem-villas',
    ],
    [
        'name' => 'Masyaf Plots',
        'image' => asset('images/communities/masyaf-plots.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['New'],
        'developer' => 'Modon Properties',
        'paymentPlan' => 'Payment Plan: Launch Soon',
        'href' => '/masyaf-plots',
    ],
    [
        'name' => 'Nawayef Village',
        'image' => asset('images/communities/nawayef-village.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Off plan'],
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/40/50 Payment Plan',
        'href' => '/nawayef-village',
    ],
    [
        'name' => 'Wadeem Plots',
        'image' => asset('images/communities/wadeem-plots.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Off plan'],
        'developer' => 'Modon Properties',
        'paymentPlan' => '10/40/50 Payment Plan',
        'href' => '/wadeem-plots',
    ],
    [
        'name' => 'Nawayef Park Views',
        'image' => asset('images/communities/nawayef-park-views.jpg'),
        'location' => 'Hudayriyat Island, Abu Dhabi',
        'badges' => ['Off plan'],
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
                        $isSoldOut = ($item->status === 'sold_out') || ($item->page?->status === 'sold_out');
                    @endphp
                    <a href="{{ $targetUrl }}" class="cardCustom" style="text-decoration: none; cursor: pointer;" aria-label="{{ $item->title }}">
                        <!-- Top-Left Badges (New, Offer, Off plan, Ready) -->
                        <div class="topTags">
                            @if(!empty($item->badges) && is_array($item->badges))
                                @foreach($item->badges as $badge)
                                    <span class="badgeTag">{{ $badge }}</span>
                                @endforeach
                            @endif
                        </div>

                        <!-- Top-Right Sold out Badge -->
                        @if($isSoldOut)
                            <span class="soldOutBadge">Sold out</span>
                        @endif

                        <!-- Main Community Photo -->
                        <img src="{{ $imgSrc }}" alt="{{ $item->title }} luxury property" class="mainImage">

                        <!-- Bottom Content Area -->
                        <div class="bottomContent">
                            <!-- Community Title -->
                            <h3 class="cardTitle">{{ $item->title }}</h3>

                            <!-- Location -->
                            <p class="cardLocation">{{ $item->location ?? 'Hudayriyat Island, Abu Dhabi' }}</p>

                            <!-- Big Green Rounded BOOK NOW Button -->
                            <div class="cardBookBtn">BOOK NOW</div>
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
                        $isSoldOut = (isset($item['status']) && $item['status'] === 'sold_out');
                    @endphp
                    <a href="{{ $item['href'] ?? '#' }}" class="cardCustom" style="text-decoration: none; cursor: pointer;" aria-label="{{ $item['name'] }}">
                        <!-- Top-Left Badges (New, Offer, Off plan, Ready) -->
                        <div class="topTags">
                            @if(!empty($item['badges']) && is_array($item['badges']))
                                @foreach($item['badges'] as $badge)
                                    <span class="badgeTag">{{ $badge }}</span>
                                @endforeach
                            @endif
                        </div>

                        <!-- Top-Right Sold out Badge -->
                        @if($isSoldOut)
                            <span class="soldOutBadge">Sold out</span>
                        @endif

                        <!-- Main Community Photo -->
                        <img src="{{ $imgSrc }}" alt="{{ $item['name'] ?? '' }} luxury property" class="mainImage">

                        <!-- Bottom Content Area -->
                        <div class="bottomContent">
                            <!-- Community Title -->
                            <h3 class="cardTitle">{{ $item['name'] ?? '' }}</h3>

                            <!-- Location -->
                            <p class="cardLocation">{{ $item['location'] ?? '' }}</p>

                            <!-- Big Green Rounded BOOK NOW Button -->
                            <div class="cardBookBtn">BOOK NOW</div>
                        </div>
                    </a>
                @endforeach
            @endif
        </div>
    </div>
</section>
