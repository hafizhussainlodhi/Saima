@php
    $rawHighlights = page_section('highlights', 'items', [], $page->slug);
    $commHighlights = array_values(array_filter((array)$rawHighlights, fn($item) => is_array($item) && (!empty(trim($item['label'] ?? '')) || !empty(trim($item['value'] ?? '')))));
@endphp
@if(!empty($commHighlights))
<section class="GolfHighlights-module__mmSHGq__highlightsSection">
<style>
[class*="__iconWrapper"] {
    position: relative !important;
    width: 44px !important;
    height: 44px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    flex-shrink: 0 !important;
}
[class*="__accentCircle"], .accentCircle {
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
[class*="__svgIcon"], .svgIcon {
    position: relative !important;
    z-index: 2 !important;
    color: #ffffff !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    width: 100% !important;
    height: 100% !important;
}
[class*="__svgIcon"] img, .svgIcon img {
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
[class*="__svgIcon"] svg, .svgIcon svg {
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
<div class="container"><div class="GolfHighlights-module__mmSHGq__highlightsGrid">
@foreach($commHighlights as $hItem)
    @php
        $hLabel = $hItem['label'] ?? '';
        $hIcon = $hItem['icon'] ?? '';
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
    <div class="GolfHighlights-module__mmSHGq__highlightCard">
        @if(!empty($hIcon))
        <div class="GolfHighlights-module__mmSHGq__iconWrapper">
            <span class="GolfHighlights-module__mmSHGq__accentCircle"></span>
            <span class="GolfHighlights-module__mmSHGq__svgIcon">@include('partials.highlight-icon', ['label' => $hLabel, 'icon' => $hIcon, 'index' => $loop->index])</span>
        </div>
        @endif
        <div class="GolfHighlights-module__mmSHGq__highlightInfo">
            <span class="GolfHighlights-module__mmSHGq__highlightLabel">{{ $hLabel }}</span>
            <span class="GolfHighlights-module__mmSHGq__highlightValue">{{ $hItem['value'] ?? '' }}</span>
        </div>
    </div>
@endforeach
</div></div></section>
@endif