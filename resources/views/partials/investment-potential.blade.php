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

$defaultFinancingHighlights = [
    'Secure a mortgage during construction to maximize leverage',
    'Combine developer payment plans with tailored bank financing',
    'Get pre-approved in as little as 3 days',
    'Conventional and Sharia-compliant financing available',
    'No hidden fees or added costs',
];

$investmentHighlights = page_section('investment', 'investment_highlights', null);
if (!is_array($investmentHighlights) || empty($investmentHighlights)) {
    $investmentHighlights = $defaultInvestmentHighlights;
}

$financingHighlights = page_section('investment', 'financing_highlights', null);
if (!is_array($financingHighlights) || empty($financingHighlights)) {
    $financingHighlights = $defaultFinancingHighlights;
}
@endphp

<section id="investment" aria-label="Investment Potential and Flexible Financing" class="investmentSection">
    <div class="container">
        <div class="investmentGrid">
            <!-- Left Column: Investment Potential -->
            <div class="investmentLeftCol">
                <h2 class="investmentMainTitle">{{ page_section('investment', 'heading', 'Investment Potential') }}</h2>
                <div class="investmentLocationBadge">{{ page_section('investment', 'location_badge', 'Hudayriyat Island, Abu Dhabi') }}</div>

                <p class="investmentDescription">
                    {{ page_section('investment', 'description', 'Hudayriyat Island offers attractive real estate investment opportunities through its premium villa communities, waterfront lifestyle, and developments by Modon Properties. With growing interest in luxury coastal living in Abu Dhabi, the island presents opportunities for investors seeking long-term capital appreciation and potential rental income.') }}
                </p>

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

            <!-- Right Column: Flexible Financing Options Card -->
            <div class="investmentRightCol">
                <div class="financingCard">
                    <h3 class="financingTitle">{{ page_section('investment', 'financing_title', 'Flexible Financing Options') }}</h3>

                    <p class="financingDesc">
                        {{ page_section('investment', 'financing_desc', 'Buying an off-plan property or a ready-to-move-in home? Maximise your buying power with competitive mortgage options tailored to your needs.') }}
                    </p>

                    <ul class="financingList">
                        @foreach($financingHighlights as $item)
                            @php $itemText = is_array($item) ? ($item['text'] ?? $item['title'] ?? '') : $item; @endphp
                            @if(!empty(trim($itemText)))
                                <li class="financingItem">
                                    <span class="checkIconGreen">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                    </span>
                                    <span class="investmentItemText">{{ $itemText }}</span>
                                </li>
                            @endif
                        @endforeach
                    </ul>

                    <div class="cardBtnWrapper">
                        <a href="#contact" class="investmentActionBtn" aria-label="{{ page_section('investment', 'financing_cta', 'Contact a Mortgage Specialist') }}">
                            {{ page_section('investment', 'financing_cta', 'Contact a Mortgage Specialist') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
