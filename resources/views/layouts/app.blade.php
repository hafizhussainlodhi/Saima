<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#1a4731">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@php
    $activePage = page_data();
    $pageMetaTitle = $activePage?->meta_title ?: 'Saima – Luxury Villas & Waterfront Living';
    $pageMetaDesc = $activePage?->meta_description ?: 'Discover Saima, a premier luxury waterfront community offering exclusive villas, apartments, mansions, and world-class amenities. Invest in your dream home today.';
    $pageMetaKeywords = $activePage?->meta_keywords ?: 'Saima, Saima Projects, Saima Group, Luxury villas, Waterfront living, Villas for sale, Saima apartments, Real estate investment';
    $pageOgImage = $activePage?->og_image ? (str_starts_with($activePage->og_image, 'http') ? $activePage->og_image : asset($activePage->og_image)) : asset('images/hero/slide-1.jpg');
@endphp
    <title>{{ $pageMetaTitle }}</title>
    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $pageMetaDesc }}">
    <meta name="keywords" content="{{ $pageMetaKeywords }}">
    <meta name="author" content="Saima Group">
    @if(is_indexing_enabled())
    <meta name="robots" content="index, follow, max-snippet:-1, max-video-preview:-1, max-image-preview:large">
    <meta name="googlebot" content="index, follow">
    @else
    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">
    @endif
    <meta name="geo.region" content="PK">
    <meta name="geo.placename" content="Pakistan">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <!-- Header Schemas: Organization, Dynamic FAQPage & RealEstateAgent (JSON-LD) -->
    {!! render_header_schemas($activePage ?? null, $blog ?? null) !!}

    @if($headerScripts = site_setting('header_scripts'))
    {!! $headerScripts !!}
    @endif

    <!-- OpenGraph -->
    <meta property="og:title" content="{{ $pageMetaTitle }}">
    <meta property="og:description" content="{{ $pageMetaDesc }}">
    <meta property="og:image" content="{{ $pageOgImage }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Saima">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageMetaTitle }}">
    <meta name="twitter:description" content="{{ $pageMetaDesc }}">
    <meta name="twitter:image" content="{{ $pageOgImage }}">

    <!-- Google Fonts: Playfair Display & Ubuntu -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}?v={{ file_exists(public_path('favicon.png')) ? filemtime(public_path('favicon.png')) : time() }}">
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}?v={{ file_exists(public_path('favicon.png')) ? filemtime(public_path('favicon.png')) : time() }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}?v={{ file_exists(public_path('favicon.png')) ? filemtime(public_path('favicon.png')) : time() }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/saima.css') }}?v={{ time() }}">

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
    .heroBookBtn,
    .heroBtnRow .heroBookBtn,
    #hero .heroBookBtn,
    section[id="hero"] .heroBookBtn,
    [class*="heroSection"] [class*="brochureBtn"],
    [class*="Hero"] [class*="brochureBtn"],
    [class*="__btnRow"] [class*="brochureBtn"],
    [class*="btnRow"] button {
        background-color: #d9232d !important;
        background: #d9232d !important;
        color: #ffffff !important;
        border: none !important;
        box-shadow: 0 4px 12px rgba(217, 35, 45, 0.35) !important;
    }
    .heroBookBtn:hover,
    .heroBtnRow .heroBookBtn:hover,
    #hero .heroBookBtn:hover,
    section[id="hero"] .heroBookBtn:hover,
    [class*="heroSection"] [class*="brochureBtn"]:hover,
    [class*="Hero"] [class*="brochureBtn"]:hover,
    [class*="__btnRow"] [class*="brochureBtn"]:hover,
    [class*="btnRow"] button:hover {
        background-color: #b71a23 !important;
        background: #b71a23 !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 6px 18px rgba(217, 35, 45, 0.5) !important;
    }
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
    .iconWrapper,
    [class*="__iconWrapper"] {
        position: relative !important;
        width: 44px !important;
        height: 44px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        flex-shrink: 0 !important;
    }
    .accentCircle,
    [class*="__accentCircle"] {
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
    .svgIcon,
    [class*="__svgIcon"] {
        position: relative !important;
        z-index: 2 !important;
        color: #ffffff !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        width: 100% !important;
        height: 100% !important;
    }
    .svgIcon img,
    [class*="__svgIcon"] img,
    .highlightCard img,
    [class*="__highlightCard"] img {
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
    .svgIcon svg,
    [class*="__svgIcon"] svg,
    .highlightCard svg,
    [class*="__highlightCard"] svg {
        width: 20px !important;
        height: 20px !important;
        max-width: 20px !important;
        max-height: 20px !important;
        stroke: #ffffff !important;
        color: #ffffff !important;
        display: block !important;
        margin: auto !important;
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

    <!-- Universal International Phone Selector (218 Countries Worldwide & Dynamic Validation) -->
    <script src="{{ asset('js/universal-phone-selector.js') }}?v={{ time() }}"></script>


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
            formData.append('source', 'Website');
            formData.append('sub_source', 'saima project');
            formData.append('page_url', window.location.href);
            formData.append('campaign_url', window.location.href);
            formData.append('utm_campaign', new URLSearchParams(window.location.search).get('utm_campaign') || '');
            formData.append('project', 'Saima Project');
            formData.append('developer', 'Saima Group');
            formData.append('community', 'Saima Project');
            formData.append('key_requirement', 'Property Listing Submission: ' + (formData.get('property_type') || ''));
            formData.append('activity_description', 'List Your Property Modal Submission');

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
