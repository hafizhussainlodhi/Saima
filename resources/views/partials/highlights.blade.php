@php
$rawItems = page_section('highlights', 'items', null);
$items = [];

if (is_array($rawItems)) {
    foreach ($rawItems as $highlight) {
        $label = trim((string)($highlight['label'] ?? ($highlight['title'] ?? '')));
        $value = trim((string)($highlight['value'] ?? ($highlight['description'] ?? '')));
        if ($label !== '' || $value !== '') {
            $items[] = $highlight;
        }
    }
}
@endphp

@if(!empty($items))
<section class="highlightsSection">
    <style>
    .highlightsSection .iconWrapper {
        position: relative !important;
        width: 44px !important;
        height: 44px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .highlightsSection .accentCircle {
        position: absolute !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        width: 38px !important;
        height: 38px !important;
        border-radius: 50% !important;
        background: #1a4731 !important;
        opacity: 1 !important;
        z-index: 1 !important;
    }
    .highlightsSection .svgIcon {
        position: relative !important;
        z-index: 2 !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
    }
    .highlightsSection .svgIcon img {
        width: 20px !important;
        height: 20px !important;
        max-width: 20px !important;
        max-height: 20px !important;
        object-fit: contain !important;
        filter: brightness(0) invert(1) !important;
        -webkit-filter: brightness(0) invert(1) !important;
        display: block !important;
        margin: auto !important;
    }
    .highlightsSection .svgIcon svg {
        width: 20px !important;
        height: 20px !important;
        max-width: 20px !important;
        max-height: 20px !important;
        stroke: #ffffff !important;
        color: #ffffff !important;
        display: block !important;
        margin: auto !important;
    }
    </style>
    <div class="container">
        <div class="highlightsGrid">
            @foreach($items as $highlight)
                @php
                    $hKey = strtolower($highlight['key'] ?? '');
                    $hLabel = $highlight['label'] ?? ($highlight['title'] ?? 'Highlight');
                    $hValue = $highlight['value'] ?? ($highlight['description'] ?? '');
                    $hIcon = $highlight['icon'] ?? '';
                    if (!empty($hIcon) || !empty($hLabel)) {
                        $matchedAmenity = \App\Models\Amenity::where('is_active', true)
                            ->where(function($q) use ($hIcon, $hLabel) {
                                if (!empty($hIcon)) $q->where('icon', $hIcon);
                                if (!empty($hLabel)) $q->orWhereRaw('LOWER(name) = ?', [strtolower(trim($hLabel))]);
                            })->first();
                        if ($matchedAmenity) {
                            $hLabel = $matchedAmenity->name;
                            if (!empty($matchedAmenity->icon)) $hIcon = $matchedAmenity->icon;
                        }
                    }
                @endphp
                <div class="highlightCard">
                    <div class="iconWrapper">
                        <div class="accentCircle"></div>
                        <div class="svgIcon">
                            @include('partials.highlight-icon', ['label' => $hLabel, 'icon' => $hIcon, 'index' => $loop->index, 'key' => $hKey])
                        </div>
                    </div>
                    <div class="highlightInfo">
                        <span class="highlightLabel">{{ $hLabel }}</span>
                        <span class="highlightValue">{{ $hValue }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif