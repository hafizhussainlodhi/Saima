@extends('layouts.app')

@section('content')
@php
    $sections = collect();
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
            $contactPage = \App\Models\Page::where('slug', 'contact-us')->first();
            if ($contactPage && \Illuminate\Support\Facades\Schema::hasTable('page_sections')) {
                $sections = $contactPage->sections()->where('is_active', true)->orderBy('order')->get();
            }
        }
    } catch (\Throwable $e) {
        $sections = collect();
    }

    $defaultChannels = [
        [
            'title' => 'WhatsApp Us',
            'info' => 'Quick instant response',
            'action' => 'Connect on WhatsApp →',
            'url' => 'https://wa.me/971500000000',
            'icon' => 'whatsapp',
        ],
        [
            'title' => 'Direct Call',
            'info' => '+971 50 000 0000',
            'action' => 'Call an Advisor →',
            'url' => 'tel:+971500000000',
            'icon' => 'phone',
        ],
        [
            'title' => 'Email Inquiries',
            'info' => 'info@hudayriyat-island.ae',
            'action' => 'Send an Email →',
            'url' => 'mailto:info@hudayriyat-island.ae',
            'icon' => 'email',
        ],
        [
            'title' => 'Location',
            'info' => 'Hudayriyat Island, Abu Dhabi, UAE',
            'action' => 'Prime Island Location',
            'url' => '',
            'icon' => 'location',
        ],
    ];

    $defaultFeatures = [
        [
            'title' => 'Exclusive Island Living',
            'desc' => 'Mansions, villas, townhouses, and waterfront residential plots.',
            'icon' => 'building',
        ],
        [
            'title' => '100% Freehold Ownership',
            'desc' => 'Open to all nationalities with flexible developer payment plans.',
            'icon' => 'sparkles',
        ],
        [
            'title' => 'Prompt Advisory',
            'desc' => 'Personalized guidance without pressure or obligation.',
            'icon' => 'clock',
        ],
    ];
    if ($sections->isEmpty()) {
        $sections = collect(['hero', 'channels', 'info'])->map(fn($k) => (object)['section_key' => $k]);
    }
@endphp

<main class="contactMainWrapper">
    @foreach($sections as $sec)
        @switch($sec->section_key)
            @case('hero')
                <!-- Hero Header -->
                <section class="contactHeroSection">
                    <div class="container">
                        <div class="contactHeroContent">
                            <span class="contactBadge">{{ page_section('hero', 'badge', 'HUDAYRIYAT ISLAND • ABU DHABI', 'contact-us') }}</span>
                            <h1 class="contactHeroTitle">{{ page_section('hero', 'title', 'Contact Us', 'contact-us') }}</h1>
                            <p class="contactHeroSubtitle">
                                {{ page_section('hero', 'subtitle', 'Invest in Your Future. Discover your ideal property on Hudayriyat Island.', 'contact-us') }}
                            </p>
                        </div>
                    </div>
                </section>
                @break

            @case('channels')
                <!-- Direct Contact Channels Cards -->
                @php
                    $channelsList = page_section('channels', 'items', $defaultChannels, 'contact-us');
                    if (!is_array($channelsList) || empty($channelsList)) {
                        $channelsList = $defaultChannels;
                    }
                @endphp
                <section class="channelsSection">
                    <div class="container">
                        <div class="channelsGrid">
                            @foreach($channelsList as $ch)
                                @php
                                    $chIcon = $ch['icon'] ?? 'phone';
                                    $chTitle = $ch['title'] ?? '';
                                    $chInfo = $ch['info'] ?? '';
                                    $chAction = $ch['action'] ?? '';
                                    $chUrl = $ch['url'] ?? '';

                                    if (empty($chIcon) || $chIcon === 'phone') {
                                        $lowTitle = strtolower($chTitle);
                                        if (str_contains($lowTitle, 'whatsapp')) {
                                            $chIcon = 'whatsapp';
                                        } elseif (str_contains($lowTitle, 'email') || str_contains($lowTitle, 'mail')) {
                                            $chIcon = 'email';
                                        } elseif (str_contains($lowTitle, 'location') || str_contains($lowTitle, 'address')) {
                                            $chIcon = 'location';
                                        }
                                    }

                                    if (empty($chUrl)) {
                                        if ($chIcon === 'email' && !empty($chInfo) && filter_var(trim($chInfo), FILTER_VALIDATE_EMAIL)) {
                                            $chUrl = 'mailto:' . trim($chInfo);
                                        } elseif ($chIcon === 'phone' && !empty($chInfo) && preg_match('/^[+0-9\s\-()]+$/', trim($chInfo))) {
                                            $chUrl = 'tel:' . preg_replace('/[^\+0-9]/', '', trim($chInfo));
                                        }
                                    }

                                    $isLink = !empty(trim($chUrl));
                                @endphp

                                @if($isLink)
                                    <a href="{{ $chUrl }}" {{ str_starts_with($chUrl, 'http') ? 'target="_blank" rel="noopener noreferrer"' : '' }} class="channelCard">
                                        <div class="iconCircle">
                                            @if($chIcon === 'whatsapp')
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
                                                </svg>
                                            @elseif($chIcon === 'email')
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                                </svg>
                                            @elseif($chIcon === 'location')
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>
                                                </svg>
                                            @else
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <h3 class="channelTitle">{{ $chTitle }}</h3>
                                        <p class="channelInfo">{{ $chInfo }}</p>
                                        <span class="channelAction">{{ $chAction }}</span>
                                    </a>
                                @else
                                    <div class="channelCardStatic">
                                        <div class="iconCircle">
                                            @if($chIcon === 'whatsapp')
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"/>
                                                </svg>
                                            @elseif($chIcon === 'email')
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                                                </svg>
                                            @elseif($chIcon === 'location')
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"/><circle cx="12" cy="10" r="3"/>
                                                </svg>
                                            @else
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                                </svg>
                                            @endif
                                        </div>
                                        <h3 class="channelTitle">{{ $chTitle }}</h3>
                                        <p class="channelInfo">{{ $chInfo }}</p>
                                        <span class="channelBadge">{{ $chAction }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </section>
                @break

            @case('info')
                <!-- Get in Touch Form & Island Information Section -->
                @php
                    $featuresList = page_section('info', 'features', $defaultFeatures, 'contact-us');
                    if (!is_array($featuresList) || empty($featuresList)) {
                        $featuresList = $defaultFeatures;
                    }
                @endphp
                <section class="contactContentSection">
                    <div class="container">
                        <div class="contactContentGrid">
                            <!-- Left Column: Island Overview & Opportunities -->
                            <div class="contactInfoCol">
                                <span class="contactSectionTag">{{ page_section('info', 'tag', 'PREMIER OPPORTUNITY', 'contact-us') }}</span>
                                <h2 class="contactInfoHeading">
                                    {{ page_section('info', 'heading', 'Discover Emerging Properties on Hudayriyat Island', 'contact-us') }}
                                </h2>

                                <div class="contactInfoTextWrapper">
                                    <p class="contactLeadPara">
                                        {{ page_section('info', 'lead', 'Hudayriyat Island is emerging as a major destination in Abu Dhabi, offering a growing range of residential and investment opportunities. Explore carefully selected properties and discover the latest projects and developments across the island.', 'contact-us') }}
                                    </p>
                                    <p class="contactBodyPara">
                                        {{ page_section('info', 'body', 'Whether you are looking for a new home or an investment opportunity, you can explore available projects, locations, property types, and key details to find an option that suits your requirements.', 'contact-us') }}
                                    </p>
                                    <p class="contactHighlightPara">
                                        {{ page_section('info', 'highlight', 'Contact us today to learn more about properties and investment opportunities on Hudayriyat Island.', 'contact-us') }}
                                    </p>
                                </div>

                                <!-- Feature Highlights Badges -->
                                <div class="contactFeatureList">
                                    @foreach($featuresList as $feat)
                                        @php
                                            $fIcon = $feat['icon'] ?? 'building';
                                            $fTitle = $feat['title'] ?? '';
                                            $fDesc = $feat['desc'] ?? ($feat['description'] ?? '');
                                        @endphp
                                        <div class="contactFeatureItem">
                                            @if($fIcon === 'sparkles')
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="contactFeatureIcon">
                                                    <path d="m12 3-1.9 5.8a2 2 0 0 1-1.3 1.3L3 12l5.8 1.9a2 2 0 0 1 1.3 1.3L12 21l1.9-5.8a2 2 0 0 1 1.3-1.3L21 12l-5.8-1.9a2 2 0 0 1-1.3-1.3Z"/>
                                                </svg>
                                            @elseif($fIcon === 'clock')
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="contactFeatureIcon">
                                                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                                </svg>
                                            @else
                                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="contactFeatureIcon">
                                                    <rect width="16" height="20" x="4" y="2" rx="2" ry="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/>
                                                </svg>
                                            @endif
                                            <div>
                                                <h4 class="contactFeatureTitle">{{ $fTitle }}</h4>
                                                <p class="contactFeatureDesc">{{ $fDesc }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Right Column: Get in Touch Form Card -->
                            <div class="contactFormCol">
                                <div class="contactFormCard">
                                    <h3 class="contactFormTitle">{{ page_section('info', 'form_title', 'Get in Touch', 'contact-us') }}</h3>
                                    <p class="contactFormSubtitle">
                                        {{ page_section('info', 'form_subtitle', 'Enter your details and our team will contact you shortly to help you explore property opportunities on Hudayriyat Island.', 'contact-us') }}
                                    </p>

                                    <form id="contactPageForm" class="contactForm">
                                        <div class="contactInputGroup">
                                            <input type="text" name="name" placeholder="Full Name" required class="contactInputField">
                                        </div>

                                        <div class="contactInputGroup">
                                            <input type="email" name="email" placeholder="Email Address" required class="contactInputField">
                                        </div>

                                        <div class="contactInputGroup">
                                            <div class="phoneUnifiedContainer" style="height: 46px !important;">
                                                <div class="countryTriggerWrapper">
                                                    <button type="button" class="countryTriggerBtn" id="contactCountryBtn" aria-label="Country selector">
                                                        <span class="flagSlot" id="contactFlagSlot">
                                                            <svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg">
                                                                <rect width="24" height="5.33" fill="#00732f"/>
                                                                <rect y="5.33" width="24" height="5.33" fill="#ffffff"/>
                                                                <rect y="10.66" width="24" height="5.34" fill="#000000"/>
                                                                <rect width="6" height="16" fill="#fe0000"/>
                                                            </svg>
                                                        </span>
                                                        <span class="caretDown"></span>
                                                    </button>
                                                    <ul class="countryDropdownMenu" id="contactCountryDropdown" style="display: none;"></ul>
                                                </div>
                                                <input type="tel" name="phone" id="contactPhoneInput" class="phoneInputField" value="+971 " required>
                                            </div>
                                        </div>

                                        <div class="contactInputGroup">
                                            <textarea name="message" placeholder="Message or Specific Project Inquiry (Optional)" rows="3" class="contactTextareaField"></textarea>
                                        </div>

                                        <button type="submit" class="contactSubmitBtn">
                                            {{ page_section('info', 'submit_button', 'SUBMIT NOW', 'contact-us') }}
                                        </button>

                                        <p class="contactTermsNote">
                                            {{ page_section('info', 'terms_note', 'By submitting, you agree to our Terms & Privacy Policy.', 'contact-us') }}
                                        </p>
                                    </form>

                                    <div id="contactPageSuccessBox" class="contactSuccessMsg" style="display: none;">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#166534" stroke-width="2">
                                            <circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/>
                                        </svg>
                                        <div>
                                            <h4 class="contactSuccessHeading">Inquiry Received</h4>
                                            <p class="contactSuccessText">
                                                Thank you! Our property specialist will contact you shortly with comprehensive project details.
                                            </p>
                                        </div>
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
            setupPhoneSelector('contactCountryBtn', 'contactCountryDropdown', 'contactFlagSlot', 'contactPhoneInput');
        }
    });

    const contactForm = document.getElementById('contactPageForm');
    contactForm?.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(contactForm);
        const submitBtn = contactForm.querySelector('button[type="submit"]');
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
                    key_requirement: formData.get('message'),
                    project: 'Hudayriyat Island',
                    developer: 'Modon Properties',
                    activity_description: 'Contact Us Page Form Request'
                })
            });

            contactForm.style.display = 'none';
            document.getElementById('contactPageSuccessBox').style.display = 'flex';
        } catch (err) {
            console.error(err);
            contactForm.style.display = 'none';
            document.getElementById('contactPageSuccessBox').style.display = 'flex';
        }
    });
</script>
@endsection