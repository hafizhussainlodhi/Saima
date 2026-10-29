@extends('layouts.app')

@section('content')
@php
    $sections = collect();
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
            $aboutPage = \App\Models\Page::where('slug', 'about-us')->first();
            if ($aboutPage && \Illuminate\Support\Facades\Schema::hasTable('page_sections')) {
                $sections = $aboutPage->sections()->where('is_active', true)->orderBy('order')->get();
            }
        }
    } catch (\Throwable $e) {
        $sections = collect();
    }

    $defaultServices = [
        ['icon' => 'compass', 'title' => 'Property Advisory', 'description' => 'Practical guidance to help you explore residential and investment opportunities based on your requirements.'],
        ['icon' => 'building', 'title' => 'Property Listings', 'description' => 'A selection of residential properties and new developments across Hudayriyat Island and surrounding areas of Abu Dhabi.'],
        ['icon' => 'trending-up', 'title' => 'Market Insights', 'description' => 'Clear information about new projects, locations, developments, and market trends to help you make informed property decisions.']
    ];

    $defaultPillars = [
        ['icon' => 'target', 'title' => 'Our Mission', 'description' => 'To provide reliable property information, honest guidance, and helpful support to buyers and investors exploring opportunities on Hudayriyat Island and across Abu Dhabi.'],
        ['icon' => 'eye', 'title' => 'Our Vision', 'description' => 'To become a trusted source for property buyers and investors by providing accurate information, clear guidance, and consistent support throughout their property journey.'],
        ['icon' => 'shield', 'title' => 'Our Values', 'description' => 'Accuracy, transparency, and responsible advice guide everything we do. We focus on providing clear property information and helping clients understand their options before making important decisions.']
    ];

    $defaultWhyUs = [
        ['icon' => 'map-pin', 'title' => 'Local Market Knowledge', 'description' => 'Useful information about Hudayriyat Island, Abu Dhabi communities, new developments, and property opportunities.'],
        ['icon' => 'heart', 'title' => 'Client-First Approach', 'description' => 'Clear communication and straightforward guidance without unnecessary pressure.'],
        ['icon' => 'search', 'title' => 'Simple Property Search', 'description' => 'An easier way to explore available properties, compare opportunities, and understand important project details.']
    ];

    $defaultBenefits = [
        ['text' => 'Free, no-obligation property consultation'],
        ['text' => 'Official brochure & floor plan access'],
        ['text' => 'Transparent payment plan advisory']
    ];
    if ($sections->isEmpty()) {
        $sections = collect(['hero', 'intro', 'services', 'pillars', 'why_us', 'cta'])->map(fn($k) => (object)['section_key' => $k]);
    }
@endphp

<main class="aboutMainWrapper">
    @foreach($sections as $sec)
        @switch($sec->section_key)
            @case('hero')
                <!-- Hero Header -->
                <section class="aboutHeroSection">
                    <div class="container">
                        <div class="aboutHeroContent">
                            @php
                                $heroBadge = trim(strip_tags((string)page_section('hero', 'badge', 'HUDAYRIYAT ISLAND • ABU DHABI', 'about-us')));
                            @endphp
                            @if(!empty($heroBadge))
                                <span class="aboutBadge">{{ $heroBadge }}</span>
                            @endif
                            <h1 class="aboutHeroTitle">{{ strip_tags((string)page_section('hero', 'title', 'About Us', 'about-us')) }}</h1>
                            <p class="aboutHeroSubtitle">
                                {{ strip_tags((string)page_section('hero', 'subtitle', 'Welcome to your trusted source for exploring property opportunities on Hudayriyat Island, Abu Dhabi.', 'about-us')) }}
                            </p>
                        </div>
                    </div>
                </section>
                @break

            @case('intro')
                <!-- Intro & Single Featured Image Section -->
                <section class="aboutIntroSection">
                    <div class="container">
                        <div class="aboutIntroText">
                            <p class="aboutLeadText">
                                {{ strip_tags((string)page_section('intro', 'lead', 'We make property discovery simple by providing clear information, useful market insights, and guidance throughout the buying process.', 'about-us')) }}
                            </p>
                            <p class="aboutBodyText">
                                {{ strip_tags((string)page_section('intro', 'body', 'Whether you are looking for a new home or an investment opportunity, we help you explore suitable properties on Hudayriyat Island and understand the key details before making a decision.', 'about-us')) }}
                            </p>
                        </div>

                        <!-- Single Container Image -->
                        @php
                            $introImg = page_section('intro', 'image', '/images/form image.jpg', 'about-us');
                            if ($introImg && !str_starts_with($introImg, 'http') && !str_starts_with($introImg, '/')) {
                                $introImg = asset($introImg);
                            }
                            $introAlt = page_section('intro', 'image_alt', 'Hudayriyat Island Waterfront Luxury Architecture', 'about-us');
                        @endphp
                        <div class="aboutImageContainer">
                            <img src="{{ $introImg }}" alt="{{ $introAlt }}" class="aboutFeaturedImage">
                        </div>
                    </div>
                </section>
                @break

            @case('services')
                <!-- Core Services Section -->
                @php
                    $servicesList = page_section('services', 'items', $defaultServices, 'about-us');
                    if (!is_array($servicesList) || empty($servicesList)) {
                        $servicesList = $defaultServices;
                    }
                @endphp
                <section class="aboutServicesSection">
                    <div class="container">
                        <div class="aboutSectionHeader">
                            <span class="aboutSectionTag">{{ page_section('services', 'tag', 'WHAT WE DO', 'about-us') }}</span>
                            <h2 class="aboutSectionTitle">{{ page_section('services', 'heading', 'Our Core Services', 'about-us') }}</h2>
                        </div>

                        <div class="aboutServicesGrid">
                            @foreach($servicesList as $srv)
                                @php
                                    $srvIcon = $srv['icon'] ?? 'compass';
                                    $srvTitle = $srv['title'] ?? '';
                                    $srvDesc = $srv['description'] ?? '';
                                @endphp
                                <div class="aboutServiceCard">
                                    <div class="aboutIconBox">
                                        @if($srvIcon === 'building')
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/>
                                            </svg>
                                        @elseif($srvIcon === 'trending-up')
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"/><polyline points="16 7 22 7 22 13"/>
                                            </svg>
                                        @else
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <circle cx="12" cy="12" r="10"/><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <h3 class="aboutCardTitle">{{ strip_tags((string)$srvTitle) }}</h3>
                                    <p class="aboutCardDesc">{{ strip_tags((string)$srvDesc) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                @break

            @case('pillars')
                <!-- Mission, Vision & Values Section -->
                @php
                    $pillarsList = page_section('pillars', 'items', $defaultPillars, 'about-us');
                    if (!is_array($pillarsList) || empty($pillarsList)) {
                        $pillarsList = $defaultPillars;
                    }
                @endphp
                <section class="aboutPillarsSection">
                    <div class="container">
                        <div class="aboutPillarsGrid">
                            @foreach($pillarsList as $pillar)
                                @php
                                    $pIcon = $pillar['icon'] ?? 'target';
                                    $pTitle = $pillar['title'] ?? '';
                                    $pDesc = $pillar['description'] ?? '';
                                @endphp
                                <div class="aboutPillarCard">
                                    <div class="aboutPillarHeader">
                                        @if($pIcon === 'eye')
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="aboutPillarIcon">
                                                <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"/><circle cx="12" cy="12" r="3"/>
                                            </svg>
                                        @elseif($pIcon === 'shield' || $pIcon === 'shield-check')
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="aboutPillarIcon">
                                                <path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/><path d="m9 12 2 2 4-4"/>
                                            </svg>
                                        @else
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="aboutPillarIcon">
                                                <circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/>
                                            </svg>
                                        @endif
                                        <h2 class="aboutPillarTitle">{{ strip_tags((string)$pTitle) }}</h2>
                                    </div>
                                    <p class="aboutPillarText">{{ strip_tags((string)$pDesc) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                @break

            @case('why_us')
                <!-- Why Choose Us Section -->
                @php
                    $whyList = page_section('why_us', 'items', $defaultWhyUs, 'about-us');
                    if (!is_array($whyList) || empty($whyList)) {
                        $whyList = $defaultWhyUs;
                    }
                @endphp
                <section class="aboutWhyUsSection">
                    <div class="container">
                        <div class="aboutSectionHeader">
                            <span class="aboutSectionTag">{{ page_section('why_us', 'tag', 'THE ADVANTAGE', 'about-us') }}</span>
                            <h2 class="aboutSectionTitle">{{ page_section('why_us', 'heading', 'Why Choose Us?', 'about-us') }}</h2>
                        </div>

                        <div class="aboutWhyUsGrid">
                            @foreach($whyList as $why)
                                @php
                                    $wIcon = $why['icon'] ?? 'map-pin';
                                    $wTitle = $why['title'] ?? '';
                                    $wDesc = $why['description'] ?? '';
                                @endphp
                                <div class="aboutWhyUsCard">
                                    <div class="aboutWhyUsIconBox">
                                        @if($wIcon === 'heart')
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                                            </svg>
                                        @elseif($wIcon === 'search')
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                                            </svg>
                                        @else
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>
                                            </svg>
                                        @endif
                                    </div>
                                    <h3 class="aboutWhyUsTitle">{{ strip_tags((string)$wTitle) }}</h3>
                                    <p class="aboutWhyUsDesc">{{ strip_tags((string)$wDesc) }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                @break

            @case('cta')
                <!-- CTA & Contact Form -->
                @php
                    $benefitsList = page_section('cta', 'benefits', $defaultBenefits, 'about-us');
                    if (!is_array($benefitsList) || empty($benefitsList)) {
                        $benefitsList = $defaultBenefits;
                    }
                @endphp
                <section id="contact" class="aboutCtaSection">
                    <div class="container">
                        <div class="aboutCtaGrid">
                            <!-- Left Column: Heading & Content -->
                            <div class="aboutCtaTextCol">
                                <span class="aboutSectionTag">{{ strip_tags((string)page_section('cta', 'tag', 'START YOUR JOURNEY', 'about-us')) }}</span>
                                <h2 class="aboutCtaHeading">{{ strip_tags((string)page_section('cta', 'heading', 'Looking for Your Dream Property?', 'about-us')) }}</h2>
                                <p class="aboutCtaBody">
                                    {{ strip_tags((string)page_section('cta', 'body', 'Explore property opportunities on Hudayriyat Island with clear information and professional guidance. Whether you are looking to buy a home or explore an investment, we are here to assist you throughout the process.', 'about-us')) }}
                                </p>
                                <div class="aboutBenefitsList">
                                    @foreach($benefitsList as $ben)
                                        @php
                                            $benText = is_array($ben) ? ($ben['text'] ?? '') : $ben;
                                        @endphp
                                        <div class="aboutBenefitItem">
                                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1a4731" stroke-width="2">
                                                <circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>
                                            </svg>
                                            <span>{{ strip_tags((string)$benText) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right Column: Contact Form Card -->
                            <div class="aboutFormCol">
                                <div class="aboutFormCard">
                                    <h3 class="aboutFormTitle">{{ strip_tags((string)page_section('cta', 'form_title', 'Get in Touch', 'about-us')) }}</h3>
                                    <p class="aboutFormSubtitle">
                                        {{ strip_tags((string)page_section('cta', 'form_subtitle', 'Enter your details and our team will contact you shortly.', 'about-us')) }}
                                    </p>

                                    <form id="aboutPageForm" class="aboutForm">
                                        <div class="aboutInputGroup">
                                            <input type="text" name="name" placeholder="Full Name" required class="aboutInputField">
                                        </div>

                                        <div class="aboutInputGroup">
                                            <input type="email" name="email" placeholder="Email Address" required class="aboutInputField">
                                        </div>

                                        <div class="aboutInputGroup">
                                            <div class="phoneUnifiedContainer" style="height: 46px !important;">
                                                <div class="countryTriggerWrapper">
                                                    <button type="button" class="countryTriggerBtn" id="aboutCountryBtn" aria-label="Country selector">
                                                        <span class="flagSlot" id="aboutFlagSlot">
                                                            <svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg">
                                                                <rect width="24" height="5.33" fill="#00732f"/>
                                                                <rect y="5.33" width="24" height="5.33" fill="#ffffff"/>
                                                                <rect y="10.66" width="24" height="5.34" fill="#000000"/>
                                                                <rect width="6" height="16" fill="#fe0000"/>
                                                            </svg>
                                                        </span>
                                                        <span class="caretDown"></span>
                                                    </button>
                                                    <ul class="countryDropdownMenu" id="aboutCountryDropdown" style="display: none;"></ul>
                                                </div>
                                                <input type="tel" name="phone" id="aboutPhoneInput" class="phoneInputField" value="+971 " required>
                                            </div>
                                        </div>

                                        <button type="submit" class="aboutSubmitBtn">
                                            {{ page_section('cta', 'submit_button', 'SUBMIT NOW', 'about-us') }}
                                        </button>

                                        <p class="aboutTermsNote">
                                            {{ page_section('cta', 'terms_note', 'By submitting, you agree to our Terms & Privacy Policy.', 'about-us') }}
                                        </p>
                                    </form>

                                    <div id="aboutPageSuccessBox" class="aboutSuccessMsg" style="display: none;">
                                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>
                                        </svg>
                                        <span>Thank you! Our advisory team will get in touch with you shortly.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @break
        @endswitch
    @endforeach
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof setupPhoneSelector === 'function') {
            setupPhoneSelector('aboutCountryBtn', 'aboutCountryDropdown', 'aboutFlagSlot', 'aboutPhoneInput');
        }
    });

    const aboutForm = document.getElementById('aboutPageForm');
    aboutForm?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(aboutForm);
        const submitBtn = aboutForm.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.textContent = 'SENDING...';

        try {
            await fetch('/api/leads', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({
                    name: formData.get('name'),
                    email: formData.get('email'),
                    phone: formData.get('phone'),
                    project: 'Hudayriyat Island',
                    developer: 'Modon Properties',
                    activity_description: 'About Us Page Form Request'
                })
            });

            aboutForm.style.display = 'none';
            document.getElementById('aboutPageSuccessBox').style.display = 'flex';
        } catch (err) {
            console.error(err);
            aboutForm.style.display = 'none';
            document.getElementById('aboutPageSuccessBox').style.display = 'flex';
        }
    });
</script>
@endsection