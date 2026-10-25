@php
$defaultHighlights = [
    [
        'key' => 'developer',
        'label' => 'Developer',
        'value' => page_section('highlights', 'developer', 'Modon Properties'),
        'icon' => 'developer',
    ],
    [
        'key' => 'price',
        'label' => 'Price',
        'value' => page_section('highlights', 'price', page_section('highlights', 'launch_price', 'AED 4,300,000*')),
        'icon' => 'price',
    ],
    [
        'key' => 'handover',
        'label' => 'Handover Date',
        'value' => page_section('highlights', 'handover', 'Q3 2030'),
        'icon' => 'handover',
    ],
    [
        'key' => 'property_type',
        'label' => 'Property Type',
        'value' => page_section('highlights', 'property_type', 'Villas & Apartments'),
        'icon' => 'property_type',
    ],
    [
        'key' => 'ownership',
        'label' => 'Ownership',
        'value' => page_section('highlights', 'ownership', 'Freehold'),
        'icon' => 'ownership',
    ],
];

$items = page_section('highlights', 'items', null);
if (!is_array($items) || empty($items)) {
    $items = $defaultHighlights;
}
@endphp

<section class="highlightsSection">
    <div class="container">
        <div class="highlightsGrid">
            @foreach($items as $highlight)
                @php
                    $hKey = strtolower($highlight['key'] ?? '');
                    $hLabel = $highlight['label'] ?? ($highlight['title'] ?? 'Highlight');
                    $hValue = $highlight['value'] ?? ($highlight['description'] ?? '');
                @endphp
                <div class="highlightCard">
                    <div class="iconWrapper">
                        <div class="accentCircle"></div>
                        <div class="svgIcon">
                            @if(str_contains($hKey, 'price') || str_contains($hKey, 'launch'))
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/>
                                </svg>
                            @elseif(str_contains($hKey, 'handover') || str_contains($hKey, 'date'))
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/>
                                </svg>
                            @elseif(str_contains($hKey, 'type') || str_contains($hKey, 'property'))
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/>
                                </svg>
                            @elseif(str_contains($hKey, 'ownership') || str_contains($hKey, 'freehold'))
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                            @elseif(str_contains($hKey, 'payment') || str_contains($hKey, 'plan'))
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/>
                                </svg>
                            @else
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9v.01"/><path d="M9 12v.01"/><path d="M9 15v.01"/><path d="M9 18v.01"/>
                                </svg>
                            @endif
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