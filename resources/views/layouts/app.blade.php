<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#1a4731">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $activePage = page_data();
    $pageMetaTitle = $activePage?->meta_title ?: 'Hudayriyat Island – Luxury Villas & Waterfront Living in Abu Dhabi';
    $pageMetaDesc = $activePage?->meta_description ?: 'Discover Hudayriyat Island, a premier luxury waterfront community in Abu Dhabi offering exclusive villas, mansions, and world-class amenities. Enjoy serene beaches, cultural heritage, and modern living in a secure and vibrant environment. Invest in your dream home today.';
    $pageMetaKeywords = $activePage?->meta_keywords ?: 'Hudayriyat Island, Luxury villas Abu Dhabi, Waterfront living Abu Dhabi, Villas for sale Abu Dhabi, Hudayriyat Island villas, Modon Properties, Modon Abu Dhabi, Wadeem Gardens, Hudayriyat Golf Estates, Bashayer Residences, Nawayef East Hills, Bashayer Villas, Al Naseem Villas, Masyaf Plots, Nawayef Village, Wadeem Plots, Nawayef Park Views, Abu Dhabi real estate investment, Freehold villas Abu Dhabi';
    $pageOgImage = $activePage?->og_image ? (str_starts_with($activePage->og_image, 'http') ? $activePage->og_image : asset($activePage->og_image)) : asset('images/hero/slide-1.jpg');
@endphp
    <title>{{ $pageMetaTitle }}</title>
    <meta name="description" content="{{ $pageMetaDesc }}">
    <meta name="keywords" content="{{ $pageMetaKeywords }}">
    <meta name="author" content="Modon Properties">
    @if(is_indexing_enabled())
    <meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <meta name="googlebot" content="index, follow">
    @else
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    @endif
    <meta name="geo.region" content="AE-AZ">
    <meta name="geo.placename" content="Abu Dhabi, UAE">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    @if($headerScripts = site_setting('header_scripts'))
    {!! $headerScripts !!}
    @endif

    <!-- OpenGraph -->
    <meta property="og:title" content="{{ $pageMetaTitle }}">
    <meta property="og:description" content="{{ $pageMetaDesc }}">
    <meta property="og:image" content="{{ $pageOgImage }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Hudayriyat Island">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Hudayriyat Island – Luxury Villas & Waterfront Living in Abu Dhabi">
    <meta name="twitter:description" content="Exclusive waterfront community in Abu Dhabi by Modon Properties with luxury villas, mansions, and world-class leisure amenities.">
    <meta name="twitter:image" content="{{ asset('images/hero/slide-1.jpg') }}">

    <!-- Google Fonts: Playfair Display & Ubuntu -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('hudayriyat logo-01.svg') }}">
    <link rel="shortcut icon" href="{{ asset('hudayriyat logo-01.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('hudayriyat logo-01.svg') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/hudayriyat.css') }}?v={{ time() }}">

    <!-- Sitewide Green Theme (All current and new pages) -->
    <style id="sitewide-green-theme">
    :root {
        --color-primary: #1a4731 !important;
        --color-primary-hover: #123322 !important;
    }

    /* 1. Header & Navigation */
    .btn-get-started,
    .header .btn-get-started,
    .mobileNavList .btn-get-started {
        background: #1a4731 !important;
        border-color: #1a4731 !important;
    }
    .btn-get-started:hover,
    .header .btn-get-started:hover,
    .mobileNavList .btn-get-started:hover {
        background: #123322 !important;
        box-shadow: 0 4px 12px rgba(26, 71, 49, 0.4) !important;
    }
    .navLink::after {
        background-color: #1a4731 !important;
    }
    .dropdownItem:hover {
        background: rgba(26, 71, 49, 0.08) !important;
        color: #1a4731 !important;
    }

    /* 2. Hero Section & Callbacks */
    .heroCard .submitBtn,
    .submitBtn,
    .saimaSubmitBtn {
        background: #1a4731 !important;
        box-shadow: 0 2px 8px rgba(26, 71, 49, 0.3) !important;
    }
    .heroCard .submitBtn:hover,
    .submitBtn:hover,
    .saimaSubmitBtn:hover {
        background: #123322 !important;
        box-shadow: 0 4px 14px rgba(26, 71, 49, 0.45) !important;
    }
    .phoneUnifiedContainer:focus-within,
    .inputField:focus,
    .textareaField:focus,
    .contactInputField:focus,
    .contactTextareaField:focus,
    .saimaFormInput:focus {
        border-color: #1a4731 !important;
        box-shadow: 0 0 0 3px rgba(26, 71, 49, 0.18) !important;
    }

    /* 3. Highlights & Metrics Section */
    .accentCircle {
        background: #1a4731 !important;
    }

    /* 4. Featured Communities / Projects */
    .sparkleBtn {
        background: #1a4731 !important;
        box-shadow: 0 4px 14px rgba(26, 71, 49, 0.45) !important;
    }
    .cardCustom:hover .sparkleBtn {
        background: #123322 !important;
    }
    .planBadge {
        color: #1a4731 !important;
    }

    /* 5. Section Headers */
    .section-header h2::before,
    .section-header h2::after {
        background: #1a4731 !important;
    }

    /* 6. Investment Potential Section */
    .investmentLocationBadge {
        color: #1a4731 !important;
    }
    .investmentActionBtn {
        background-color: #1a4731 !important;
        box-shadow: 0 2px 8px rgba(26, 71, 49, 0.25) !important;
    }
    .investmentActionBtn:hover {
        background-color: #123322 !important;
        box-shadow: 0 4px 14px rgba(26, 71, 49, 0.35) !important;
    }
    .checkIconGreen {
        background: rgba(26, 71, 49, 0.14) !important;
        color: #1a4731 !important;
    }

    /* 7. FAQ Section */
    .faqItemOpen {
        border-color: #1a4731 !important;
        box-shadow: 0 4px 15px rgba(26, 71, 49, 0.12) !important;
    }
    .faqItemOpen .faqQuestion {
        color: #1a4731 !important;
    }
    .faqItemOpen .faqIcon {
        background: #1a4731 !important;
    }

    /* 8. Contact Section & Channels */
    .contactTitleSmall,
    .contactSectionTag,
    .sectionTag,
    .channelAction,
    .highlightPara,
    .contactHighlightPara,
    .channelBadge,
    .saimaProjectTag,
    .saimaReadMoreBtn {
        color: #1a4731 !important;
    }
    .channelBadge {
        background: rgba(26, 71, 49, 0.08) !important;
    }
    .formCard,
    .contactFormCard,
    .saimaSidebarCard {
        border-color: #1a4731 !important;
    }
    .channelCard:hover {
        border-color: #1a4731 !important;
        box-shadow: 0 10px 25px rgba(26, 71, 49, 0.15) !important;
    }
    .channelCard:hover .iconCircle {
        background: #1a4731 !important;
    }
    .iconCircle {
        color: #1a4731 !important;
        background: rgba(26, 71, 49, 0.1) !important;
    }

    /* 9. Article & Dynamic Pages (TOC, Sticky Sidebar, Headings) */
    .saimaHighlightHead,
    .saimaArticleContent h2,
    .saimaArticleContent h3 {
        color: #1a4731 !important;
    }
    .saimaReadMoreBtn:hover {
        color: #123322 !important;
    }

    /* 10. Scroll To Top & Modals */
    .scrollTopBtn {
        background: #1a4731 !important;
    }
    .scrollTopBtn:hover {
        background: #123322 !important;
        box-shadow: 0 6px 20px rgba(26, 71, 49, 0.45) !important;
    }
    .modalInputField:focus,
    .modalSelectField:focus,
    .modalTextareaField:focus {
        border-color: #1a4731 !important;
    }
    .modalSubmitBtn {
        background: #1a4731 !important;
    }
    .modalSubmitBtn:hover {
        background: #123322 !important;
    }

    /* 11. Footer Elements */
    .footer form button[type="submit"],
    .brandCol form button[type="submit"] {
        background: #1a4731 !important;
    }
    .footer form button[type="submit"]:hover,
    .brandCol form button[type="submit"]:hover {
        background: #123322 !important;
    }
    .linkItem:hover,
    .contactLink:hover {
        color: #1a4731 !important;
    }
    </style>

    <!-- JSON-LD Schema -->
    <script type="application/ld+json">
    {!! json_encode([
      '@context' => 'https://schema.org',
      '@graph' => [
        [
          '@type' => 'WebSite',
          '@id' => 'https://hudayriyat-island.ae/#website',
          'url' => 'https://hudayriyat-island.ae/',
          'name' => 'Hudayriyat Island',
          'description' => 'Luxury Villas & Waterfront Living in Abu Dhabi by Modon Properties',
          'inLanguage' => 'en-US'
        ],
        [
          '@type' => 'RealEstateAgent',
          '@id' => 'https://hudayriyat-island.ae/#organization',
          'name' => 'Hudayriyat Island - Modon Properties',
          'url' => 'https://hudayriyat-island.ae/',
          'logo' => asset('hudayriyat logo-01.svg'),
          'image' => asset('images/hero/slide-1.jpg'),
          'description' => 'Hudayriyat Island offers a range of sophisticated residential communities in Abu Dhabi, each designed to provide an exclusive and high-end lifestyle.',
          'address' => [
            '@type' => 'PostalAddress',
            'addressLocality' => 'Abu Dhabi',
            'addressRegion' => 'Abu Dhabi',
            'addressCountry' => 'AE'
          ],
          'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => 24.4539,
            'longitude' => 54.3773
          ]
        ]
      ]
    ], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
</head>
<body>

    <!-- Sticky Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scroll-To-Top Button -->
    <button type="button" id="scrollTopBtn" class="scrollTopBtn" aria-label="Scroll to top of page">
        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="19" x2="12" y2="5"></line>
            <polyline points="5 12 12 5 19 12"></polyline>
        </svg>
    </button>

    <!-- Fixed Floating WhatsApp Widget (Image 1 Exact Style) -->
    <div id="floatingWhatsappWidget" class="floating-whatsapp-widget" style="position: fixed; bottom: 25px; left: 25px; z-index: 99999; display: flex; align-items: center; gap: 10px; font-family: 'Ubuntu', -apple-system, BlinkMacSystemFont, sans-serif;">
        <a href="https://wa.me/971500000000?text=Hello%2C%20I%20would%20like%20more%20information%20about%20Hudayriyat%20Island" target="_blank" rel="noopener noreferrer" style="display: flex; align-items: center; gap: 10px; text-decoration: none; user-select: none;" title="Chat with us on WhatsApp" aria-label="Chat on WhatsApp">
            <!-- Green Circular Icon with Red Badge -->
            <div class="whatsapp-circle" style="position: relative; width: 56px; height: 56px; border-radius: 50%; background: #25D366; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 18px rgba(37, 211, 102, 0.45); transition: transform 0.25s ease, box-shadow 0.25s ease; flex-shrink: 0;">
                <!-- Red Badge 1 -->
                <span style="position: absolute; top: -2px; right: -2px; background: #ef4444; color: #ffffff; font-size: 11px; font-weight: 700; width: 20px; height: 20px; border-radius: 50%; display: flex; align-items: center; justify-content: center; border: 2px solid #ffffff; box-shadow: 0 2px 4px rgba(0,0,0,0.2);">1</span>
                
                <!-- WhatsApp SVG -->
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M16 3C8.82 3 3 8.82 3 16c0 2.47.69 4.86 2 6.96L3 29l6.23-1.94A12.93 12.93 0 0016 29c7.18 0 13-5.82 13-13S23.18 3 16 3zm6.98 16.65c-.29.82-1.44 1.5-2.33 1.69-.6.13-1.4.23-4.06-.87-3.41-1.41-5.6-4.86-5.77-5.09-.17-.23-1.38-1.84-1.38-3.52 0-1.67.87-2.5 1.19-2.84.31-.34.68-.43.91-.43.23 0 .45 0 .65.01.21.01.5-.08.77.59.29.7 1 2.42 1.08 2.59.09.17.14.38.03.6-.11.23-.17.37-.34.57-.17.2-.36.44-.51.59-.17.17-.35.35-.15.7.2.34.88 1.46 1.9 2.36 1.3 1.16 2.4 1.52 2.74 1.69.34.17.54.14.74-.09.2-.23.85-.99 1.08-1.33.23-.34.45-.28.77-.17.31.11 1.98.94 2.32 1.11.34.17.57.26.65.4.09.14.09.82-.2 1.64z" fill="#ffffff"/>
                </svg>
            </div>

            <!-- "Contact us for details" White Pill -->
            <div class="whatsapp-pill" style="background: #ffffff; color: #1e293b; padding: 8px 16px; border-radius: 20px; font-size: 13px; font-weight: 600; box-shadow: 0 4px 14px rgba(0,0,0,0.12); border: 1px solid #e2e8f0; white-space: nowrap; transition: background 0.2s ease, transform 0.2s ease;">
                Contact us for details
            </div>
        </a>
    </div>

    <style>
    .floating-whatsapp-widget .whatsapp-circle:hover {
        transform: scale(1.08);
        box-shadow: 0 6px 22px rgba(37, 211, 102, 0.6) !important;
    }
    .floating-whatsapp-widget:hover .whatsapp-pill {
        background: #f8fafc !important;
        transform: translateX(2px);
    }
    @media (max-width: 640px) {
        .floating-whatsapp-widget {
            bottom: 18px !important;
            left: 15px !important;
        }
        .floating-whatsapp-widget .whatsapp-pill {
            display: none !important;
        }
    }
    </style>

    <!-- List Your Property Modal -->
    <div id="listPropertyModal" class="modalOverlay" style="display: none;">
        <div class="modalContent">
            <div class="modalHeader">
                <h2 class="modalTitle">LIST YOUR PROPERTY</h2>
                <button type="button" id="modalCloseBtn" class="modalCloseBtn" aria-label="Close modal">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>

            <form id="modalLeadForm" class="modalFormGrid">
                <div>
                    <label class="modalLabel">Name *</label>
                    <input type="text" name="name" required placeholder="Your Name" class="modalInputField">
                </div>

                <div>
                    <label class="modalLabel">Email *</label>
                    <input type="email" name="email" required placeholder="your.email@example.com" class="modalInputField">
                </div>

                <div>
                    <label class="modalLabel">Phone *</label>
                    <div class="phoneUnifiedContainer" style="height: 44px !important;">
                        <div class="countryTriggerWrapper">
                            <button type="button" class="countryTriggerBtn" id="modalCountryBtn" aria-label="Country selector">
                                <span class="flagSlot" id="modalFlagSlot">
                                    <svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg">
                                        <rect width="24" height="5.33" fill="#00732f"/>
                                        <rect y="5.33" width="24" height="5.33" fill="#ffffff"/>
                                        <rect y="10.66" width="24" height="5.34" fill="#000000"/>
                                        <rect width="6" height="16" fill="#fe0000"/>
                                    </svg>
                                </span>
                                <span class="caretDown"></span>
                            </button>
                            <ul class="countryDropdownMenu" id="modalCountryDropdown" style="display: none;"></ul>
                        </div>
                        <input type="tel" name="phone" id="modalPhoneInput" class="phoneInputField" value="+971 " required>
                    </div>
                </div>

                <div>
                    <label class="modalLabel">Property Type *</label>
                    <select name="property_type" class="modalSelectField">
                        <option value="Villa" selected>Villa</option>
                        <option value="Apartment">Apartment</option>
                        <option value="Penthouse">Penthouse</option>
                        <option value="Compound">Compound</option>
                        <option value="Plot">Plot</option>
                        <option value="Showroom">Showroom</option>
                    </select>
                </div>

                <div class="modalFullWidth">
                    <label class="modalLabel">Attachment (Optional)</label>
                    <input type="file" name="attachment" accept="image/*,.pdf" class="modalInputField">
                    <p class="modalFileNote">
                        Upload floor plans, photos, or deed documents (Max 10MB).
                    </p>
                </div>

                <div class="modalFullWidth">
                    <label class="modalLabel">Comments / Specifications</label>
                    <textarea name="comment" rows="3" placeholder="Tell us about the property (bedrooms, plot size, community, expected price)..." class="modalTextareaField"></textarea>
                </div>

                <div class="modalFullWidth">
                    <button type="submit" class="modalSubmitBtn">
                        SUBMIT PROPERTY
                    </button>
                </div>
            </form>

            <div id="modalSuccessBox" class="modalSuccessMessage" style="display: none;">
                ✓ Thank you! Your property listing inquiry has been received. Our luxury portfolio manager will reach out shortly.
            </div>
        </div>
    </div>

    <!-- Universal International Phone Dropdown Setup -->
    <script>
    window.phoneCountries = window.phoneCountries || [
        { code: 'ae', dial: '+971', name: 'United Arab Emirates', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="5.33" fill="#00732f"/><rect y="5.33" width="24" height="5.33" fill="#ffffff"/><rect y="10.66" width="24" height="5.34" fill="#000000"/><rect width="6" height="16" fill="#fe0000"/></svg>' },
        { code: 'pk', dial: '+92', name: 'Pakistan', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="16" fill="#01411c"/><rect width="6" height="16" fill="#ffffff"/><circle cx="15" cy="8" r="4.2" fill="#ffffff"/><circle cx="16.2" cy="7.5" r="3.9" fill="#01411c"/><polygon points="16,5 16.5,6.5 18,6.5 16.8,7.3 17.2,8.8 16,7.8 14.8,8.8 15.2,7.3 14,6.5 15.5,6.5" fill="#ffffff"/></svg>' },
        { code: 'sa', dial: '+966', name: 'Saudi Arabia', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="16" fill="#006c35"/><rect x="6" y="11" width="12" height="1.5" fill="#ffffff"/><circle cx="12" cy="7" r="2.5" fill="#ffffff"/></svg>' },
        { code: 'in', dial: '+91', name: 'India', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="5.33" fill="#ff9933"/><rect y="5.33" width="24" height="5.33" fill="#ffffff"/><rect y="10.66" width="24" height="5.34" fill="#138808"/><circle cx="12" cy="8" r="2.2" fill="none" stroke="#000080" stroke-width="0.7"/></svg>' },
        { code: 'qa', dial: '+974', name: 'Qatar', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="16" fill="#8d1b3d"/><rect width="7" height="16" fill="#ffffff"/><polygon points="7,0 9,2 7,4 9,6 7,8 9,10 7,12 9,14 7,16" fill="#ffffff"/></svg>' },
        { code: 'kw', dial: '+965', name: 'Kuwait', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="5.33" fill="#007a3d"/><rect y="5.33" width="24" height="5.33" fill="#ffffff"/><rect y="10.66" width="24" height="5.34" fill="#ce1126"/><polygon points="0,0 6,5.33 6,10.66 0,16" fill="#000000"/></svg>' },
        { code: 'om', dial: '+968', name: 'Oman', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="5.33" fill="#ffffff"/><rect y="5.33" width="24" height="5.33" fill="#db161e"/><rect y="10.66" width="24" height="5.34" fill="#008000"/><rect width="6" height="16" fill="#db161e"/></svg>' },
        { code: 'bh', dial: '+973', name: 'Bahrain', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="16" fill="#ce1126"/><rect width="6" height="16" fill="#ffffff"/><polygon points="6,0 8.5,2 6,4 8.5,6 6,8 8.5,10 6,12 8.5,14 6,16" fill="#ffffff"/></svg>' },
        { code: 'gb', dial: '+44', name: 'United Kingdom', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="16" fill="#012169"/><path d="M0,0 L24,16 M24,0 L0,16" stroke="#ffffff" stroke-width="2.5"/><path d="M0,0 L24,16 M24,0 L0,16" stroke="#c8102e" stroke-width="1.2"/><path d="M12,0 L12,16 M0,8 L24,8" stroke="#ffffff" stroke-width="4.5"/><path d="M12,0 L12,16 M0,8 L24,8" stroke="#c8102e" stroke-width="2.5"/></svg>' },
        { code: 'us', dial: '+1', name: 'United States', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="16" fill="#bf0a30"/><rect y="1.23" width="24" height="1.23" fill="#ffffff"/><rect y="3.69" width="24" height="1.23" fill="#ffffff"/><rect y="6.15" width="24" height="1.23" fill="#ffffff"/><rect y="8.61" width="24" height="1.23" fill="#ffffff"/><rect y="11.07" width="24" height="1.23" fill="#ffffff"/><rect y="13.53" width="24" height="1.23" fill="#ffffff"/><rect width="10" height="8.6" fill="#002868"/></svg>' },
        { code: 'ca', dial: '+1', name: 'Canada', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="6" height="16" fill="#ff0000"/><rect x="6" width="12" height="16" fill="#ffffff"/><rect x="18" width="6" height="16" fill="#ff0000"/><polygon points="12,4 13,7 15,6 14,8 16,9 13.5,10 14,12 12,11 10,12 10.5,10 8,9 10,8 9,6 11,7" fill="#ff0000"/></svg>' },
        { code: 'de', dial: '+49', name: 'Germany', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="5.33" fill="#000000"/><rect y="5.33" width="24" height="5.33" fill="#dd0000"/><rect y="10.66" width="24" height="5.34" fill="#ffce00"/></svg>' },
        { code: 'fr', dial: '+33', name: 'France', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="8" height="16" fill="#002395"/><rect x="8" width="8" height="16" fill="#ffffff"/><rect x="16" width="8" height="16" fill="#ed2939"/></svg>' },
        { code: 'tr', dial: '+90', name: 'Turkey', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="16" fill="#e30a17"/><circle cx="10" cy="8" r="4.2" fill="#ffffff"/><circle cx="11.2" cy="8" r="3.4" fill="#e30a17"/><polygon points="14.5,8 16,6.8 15.4,8.5 16.8,9.5 15,9.5" fill="#ffffff"/></svg>' },
        { code: 'eg', dial: '+20', name: 'Egypt', svg: '<svg width="22" height="15" viewBox="0 0 24 16" class="flagSvg"><rect width="24" height="5.33" fill="#ce1126"/><rect y="5.33" width="24" height="5.33" fill="#ffffff"/><rect y="10.66" width="24" height="5.34" fill="#000000"/><circle cx="12" cy="8" r="1.5" fill="#c09300"/></svg>' }
    ];

    window._registeredPhoneSelectors = window._registeredPhoneSelectors || [];
    window._detectedUserCountry = window._detectedUserCountry || null;

    function detectUserCountry(onFound) {
        if (window._detectedUserCountry) {
            onFound(window._detectedUserCountry);
            return;
        }

        let detected = 'ae';
        try {
            const tz = (Intl.DateTimeFormat().resolvedOptions().timeZone || '').toLowerCase();
            if (tz.includes('karachi') || tz.includes('pakistan')) detected = 'pk';
            else if (tz.includes('dubai') || tz.includes('abu_dhabi')) detected = 'ae';
            else if (tz.includes('riyadh')) detected = 'sa';
            else if (tz.includes('kolkata') || tz.includes('calcutta') || tz.includes('delhi')) detected = 'in';
            else if (tz.includes('london')) detected = 'gb';
            else if (tz.includes('new_york') || tz.includes('chicago') || tz.includes('los_angeles') || tz.includes('america')) detected = 'us';
            else if (tz.includes('qatar') || tz.includes('doha')) detected = 'qa';
            else if (tz.includes('kuwait')) detected = 'kw';
            else if (tz.includes('muscat')) detected = 'om';
            else if (tz.includes('bahrain')) detected = 'bh';
            else if (tz.includes('toronto') || tz.includes('vancouver')) detected = 'ca';
            else if (tz.includes('berlin') || tz.includes('frankfurt')) detected = 'de';
            else if (tz.includes('paris')) detected = 'fr';
            else if (tz.includes('istanbul')) detected = 'tr';
            else if (tz.includes('cairo')) detected = 'eg';
        } catch(e) {}

        window._detectedUserCountry = detected;
        onFound(detected);

        fetch('https://api.country.is')
            .then(res => res.json())
            .then(data => {
                if (data && data.country) {
                    const ipCode = data.country.toLowerCase();
                    window._detectedUserCountry = ipCode;
                    onFound(ipCode);
                }
            })
            .catch(() => {});
    }

    function applyCountryToField(item, country) {
        const flagSlot = document.getElementById(item.flagSlotId);
        const input = document.getElementById(item.inputId);
        if (flagSlot) {
            flagSlot.innerHTML = country.svg;
        }
        if (input) {
            const val = input.value.trim();
            if (!val || /^\+\d+\s*$/.test(val) || val === '+971') {
                input.value = country.dial + ' ';
            }
        }
    }

    window.setUniversalCountry = function(code) {
        const country = window.phoneCountries.find(c => c.code === code.toLowerCase()) || window.phoneCountries[0];
        window._activeCountry = country;
        window._registeredPhoneSelectors.forEach(item => {
            applyCountryToField(item, country);
        });
    };

    detectUserCountry(function(code) {
        window.setUniversalCountry(code);
    });

    window.setupPhoneSelector = function(btnId, dropdownId, flagSlotId, inputId) {
        const btn = document.getElementById(btnId);
        const dropdown = document.getElementById(dropdownId);
        const flagSlot = document.getElementById(flagSlotId);
        const input = document.getElementById(inputId);

        if (!btn || !dropdown || !flagSlot || !input) return;

        const entry = { btnId, dropdownId, flagSlotId, inputId };
        if (!window._registeredPhoneSelectors.some(x => x.btnId === btnId)) {
            window._registeredPhoneSelectors.push(entry);
        }

        if (window._activeCountry) {
            applyCountryToField(entry, window._activeCountry);
        } else if (window._detectedUserCountry) {
            const c = window.phoneCountries.find(x => x.code === window._detectedUserCountry) || window.phoneCountries[0];
            applyCountryToField(entry, c);
        }

        dropdown.innerHTML = window.phoneCountries.map(c => `
            <li class="countryDropdownItem" data-dial="${c.dial}" data-code="${c.code}">
                <div style="display:flex;align-items:center;gap:10px;width:100%;">
                    ${c.svg}
                    <span style="flex:1;font-size:13.5px;color:#222;font-weight:500;">${c.name}</span>
                    <span style="font-size:13px;color:#777;font-weight:600;">${c.dial}</span>
                </div>
            </li>
        `).join('');

        btn.onclick = function(e) {
            e.preventDefault();
            e.stopPropagation();
            const isOpen = dropdown.style.display === 'block';
            dropdown.style.display = isOpen ? 'none' : 'block';
        };

        dropdown.onclick = function(e) {
            e.stopPropagation();
            const item = e.target.closest('.countryDropdownItem');
            if (item) {
                const dial = item.getAttribute('data-dial');
                const code = item.getAttribute('data-code');
                const selected = window.phoneCountries.find(c => c.code === code);
                if (selected) {
                    flagSlot.innerHTML = selected.svg;
                    const currentVal = input.value.trim();
                    const restOfNumber = currentVal.replace(/^\+\d+\s*/, '');
                    input.value = `${dial} ${restOfNumber}`.trim() + ' ';
                    input.focus();
                }
                dropdown.style.display = 'none';
            }
        };

        document.addEventListener('click', () => {
            dropdown.style.display = 'none';
        });
    };
    </script>

    <!-- Global App Scripts -->
    <script>
    window.openListModal = function() {
        const listModal = document.getElementById("listPropertyModal");
        if (listModal) {
            listModal.style.display = "flex";
            document.body.style.overflow = "hidden";
            if (typeof window.setupPhoneSelector === "function") {
                window.setupPhoneSelector("modalCountryBtn", "modalCountryDropdown", "modalFlagSlot", "modalPhoneInput");
            }
        }
    };

    window.closeListModal = function() {
        const listModal = document.getElementById("listPropertyModal");
        if (listModal) {
            listModal.style.display = "none";
            document.body.style.overflow = "";
        }
    };

    document.addEventListener("DOMContentLoaded", function() {
        // Sticky Header & Scroll Top Button
        window.addEventListener('scroll', () => {
            const header = document.getElementById('siteHeader');
            if (header) {
                if (window.scrollY > 40) {
                    header.classList.add('sticky-header');
                } else {
                    header.classList.remove('sticky-header');
                }
            }

            const scrollBtn = document.getElementById('scrollTopBtn');
            if (scrollBtn) {
                if (window.scrollY > 300) {
                    scrollBtn.classList.add('scrollTopVisible');
                } else {
                    scrollBtn.classList.remove('scrollTopVisible');
                }
            }
        });

        // Scroll to Top action
        document.getElementById('scrollTopBtn')?.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Modal Controls
        const listModal = document.getElementById("listPropertyModal");
        const closeModalBtn = document.getElementById("modalCloseBtn");

        document.querySelectorAll(".open-list-modal").forEach(btn => {
            btn.addEventListener("click", function(e) {
                e.preventDefault();
                window.openListModal();
            });
        });

        closeModalBtn?.addEventListener("click", window.closeListModal);

        listModal?.addEventListener("click", function(e) {
            if (e.target === listModal) {
                window.closeListModal();
            }
        });

        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                window.closeListModal();
            }
        });

        // Modal Form Submit
        const modalLeadForm = document.getElementById("modalLeadForm");
        modalLeadForm?.addEventListener("submit", async function(e) {
            e.preventDefault();
            const formData = new FormData(modalLeadForm);
            const submitBtn = modalLeadForm.querySelector("button[type='submit']");
            submitBtn.disabled = true;
            submitBtn.textContent = "SUBMITTING...";

            try {
                await fetch("/api/leads", {
                    method: "POST",
                    headers: {
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || ""
                    },
                    body: formData
                });

                modalLeadForm.style.display = "none";
                document.getElementById("modalSuccessBox").style.display = "block";

                setTimeout(() => {
                    window.closeListModal();
                    modalLeadForm.reset();
                    modalLeadForm.style.display = "grid";
                    document.getElementById("modalSuccessBox").style.display = "none";
                    submitBtn.disabled = false;
                    submitBtn.textContent = "SUBMIT PROPERTY";
                }, 3000);
            } catch (err) {
                console.error(err);
                modalLeadForm.style.display = "none";
                document.getElementById("modalSuccessBox").style.display = "block";
            }
        });
    });
    </script>
    @if($footerScripts = site_setting('footer_scripts'))
    {!! $footerScripts !!}
    @endif
</body>
</html>
