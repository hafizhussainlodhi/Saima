@php
$defaultInvestmentHighlights = [
    'Premium villa communities with exclusive residential options',
    'Developed by Modon Properties',
    'Strong appeal among luxury homebuyers and property investors',
    'Coastal location with access to beaches and recreational facilities',
    'Potential for long-term capital appreciation',
    'Attractive lifestyle destination for families and investors',
    'Growing residential and leisure destination in Abu Dhabi',
];

$investmentHighlights = page_section('investment', 'investment_highlights', null);
if (!is_array($investmentHighlights) || empty($investmentHighlights)) {
    $investmentHighlights = $defaultInvestmentHighlights;
}

$invImage = page_section('investment', 'image', '/images/3_3.jpg');
if ($invImage && !str_starts_with($invImage, 'http') && !str_starts_with($invImage, '/')) {
    $invImage = asset($invImage);
}
$invImageAlt = page_section('investment', 'image_alt', 'Hudayriyat Island Investment Potential');
@endphp

<section id="investment" aria-label="Investment Potential" class="investmentSection">
    <div class="container">
        <div class="investmentGrid">
            <!-- Left Column: Investment Potential -->
            <div class="investmentLeftCol">
                @php
                    $invHeading = page_section('investment', 'heading', 'Investment Potential');
                    $invDesc = page_section('investment', 'description', 'Hudayriyat Island offers attractive real estate investment opportunities through its premium villa communities, waterfront lifestyle, and developments by Modon Properties. With growing interest in luxury coastal living in Abu Dhabi, the island presents opportunities for investors seeking long-term capital appreciation and potential rental income.');
                @endphp

                @if(!empty(trim((string)$invHeading)))
                    <h2 class="investmentMainTitle">{{ $invHeading }}</h2>
                @endif

                @if(!empty(trim(strip_tags((string)$invDesc))) || !empty(trim((string)$invDesc)))
                    <div class="investmentDescription">
                        {!! $invDesc !!}
                    </div>
                @endif

                <h3 class="investmentHighlightsHeading">
                    {{ page_section('investment', 'highlights_heading', 'Key Investment Highlights:') }}
                </h3>

                <ul class="investmentHighlightsList">
                    @foreach($investmentHighlights as $item)
                        @php $itemText = is_array($item) ? ($item['text'] ?? $item['title'] ?? '') : $item; @endphp
                        @if(!empty(trim($itemText)))
                            <li class="investmentHighlightItem">
                                <span class="checkIconGrey">
                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"/>
                                    </svg>
                                </span>
                                <span class="investmentItemText">{{ $itemText }}</span>
                            </li>
                        @endif
                    @endforeach
                </ul>

                <div class="investmentBtnWrapper">
                    <a href="#contact" class="investmentActionBtn" aria-label="{{ page_section('investment', 'cta', 'Contact a Property Investment Consultant') }}">
                        {{ page_section('investment', 'cta', 'Contact a Property Investment Consultant') }}
                    </a>
                </div>
            </div>

            <!-- Right Column: Investment Featured Image (Replaces Flexible Financing Card) -->
            <div class="investmentRightCol">
                <div class="investmentImageCard">
                    <img src="{{ $invImage }}" alt="{{ $invImageAlt }}" width="720" height="520" class="investmentImage" loading="lazy">
                </div>
            </div>
        </div>
    </div>
</section>
