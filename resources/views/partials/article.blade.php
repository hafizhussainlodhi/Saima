<!-- Saima Mangrove Residences Editorial Section with Interactive TOC & Sticky Appointment Sidebar -->
<style>
.saimaArticleWrapper {
    width: 100%;
    background-color: #ffffff;
    padding: 40px 0 60px 0;
    font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #2b2b2b;
    line-height: 1.8;
}

.saimaContainer {
    max-width: 1240px;
    margin: 0 auto;
    padding: 0 20px;
}

.saimaMainGrid {
    display: grid;
    grid-template-columns: minmax(0, 1fr) 370px;
    gap: 40px;
    align-items: start;
}

.saimaReadMoreWrap {
    margin-top: 14px;
}

.saimaReadMoreBtn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: #2563eb;
    font-size: 14.5px;
    font-weight: 600;
    text-decoration: underline;
    cursor: pointer;
    transition: color 0.2s ease;
}

.saimaReadMoreBtn:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

.saimaReadMoreBtn svg {
    transition: transform 0.2s ease;
}

.saimaReadMoreBtn:hover svg {
    transform: translateY(2px);
}


/* Left Content Column */
.saimaContentCol {
    min-width: 0;
}

/* Table of Contents Box */
.saimaTocBox {
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    background-color: #ffffff;
    padding: 18px 24px;
    margin-bottom: 32px;
    box-shadow: 0 1px 4px rgba(0,0,0,0.03);
}

.saimaTocHeader {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 12px;
    border-bottom: 1px solid #eeeeee;
}

.saimaTocTitle {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 0;
    line-height: 1.3;
}

.saimaTocToggle {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 6px 14px;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    background: #f9fafb;
    cursor: pointer;
    color: #374151;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s ease;
    font-family: inherit;
}

.saimaTocToggle:hover {
    background-color: #f3f4f6;
    border-color: #9ca3af;
    color: #111827;
}

.saimaTocToggle svg {
    transition: transform 0.25s ease;
}

.saimaTocToggle.is-open svg {
    transform: rotate(180deg);
}

/* TOC Content: Collapsed by Default */
#saimaTocContent {
    display: none;
    margin-top: 16px;
}

.saimaTocList {
    list-style: none;
    margin: 0;
    padding: 0;
}

.saimaTocList > li {
    margin-bottom: 12px;
    font-size: 18px;
    line-height: 1.6;
}

.saimaTocList a {
    color: #222222 !important;
    text-decoration: none !important;
    font-weight: 500;
    display: inline-block;
    padding: 2px 0;
    transition: color 0.15s ease, transform 0.15s ease;
}

.saimaTocList a:hover {
    color: #1a4731 !important;
    text-decoration: underline !important;
    transform: translateX(3px);
}

.saimaTocList a.active {
    color: #1a4731 !important;
    font-weight: 700 !important;
    text-decoration: underline !important;
}

/* Headings in Article (Exact #1a4731 Gold/Brown from Image 3, Large Prominent Size matching Image 2) */
.saimaIntroP {
    font-size: 17px;
    color: #222222;
    margin-bottom: 24px;
    line-height: 1.8;
}

.saimaH2,
.saimaContentCol h2 {
    color: #1a4731 !important;
    font-size: 34px;
    font-weight: 700;
    margin-top: 48px;
    margin-bottom: 18px;
    line-height: 1.3;
    scroll-margin-top: 100px;
    letter-spacing: -0.3px;
}

.saimaH3,
.saimaContentCol h3 {
    color: #1a4731 !important;
    font-size: 26px;
    font-weight: 700;
    margin-top: 34px;
    margin-bottom: 16px;
    line-height: 1.35;
    scroll-margin-top: 100px;
}

.saimaP,
.saimaContentCol p {
    font-size: 17px;
    color: #111111;
    margin-bottom: 24px;
    line-height: 1.8;
}

.saimaContentCol img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    display: block;
    margin: 18px 0 24px 0;
    box-shadow: 0 4px 14px rgba(0,0,0,0.08);
}

.saimaP a,
.saimaContentCol a {
    color: #1a4731;
    text-decoration: underline;
    font-weight: 600;
}

.saimaP a:hover {
    color: #123322;
}

/* CMS / Article Content Lists (Bullet Circles & Numbers) */
.saimaContentCol ul:not(.saimaTocList),
.saimaDynamicArticleContent ul,
.saimaLongContentBody ul,
.saimaShortContent ul,
.saimaLongContentSection ul {
    list-style-type: disc !important;
    list-style-position: outside !important;
    margin: 16px 0 20px 0 !important;
    padding-left: 28px !important;
}

.saimaContentCol ol:not(.saimaTocList),
.saimaDynamicArticleContent ol,
.saimaLongContentBody ol,
.saimaShortContent ol,
.saimaLongContentSection ol {
    list-style-type: decimal !important;
    list-style-position: outside !important;
    margin: 16px 0 20px 0 !important;
    padding-left: 28px !important;
}

.saimaContentCol ul:not(.saimaTocList) li,
.saimaContentCol ol:not(.saimaTocList) li,
.saimaDynamicArticleContent li,
.saimaLongContentBody li,
.saimaShortContent li,
.saimaLongContentSection li {
    list-style: inherit !important;
    display: list-item !important;
    margin-bottom: 10px !important;
    font-size: 17px !important;
    line-height: 1.8 !important;
    color: #111111 !important;
}

.saimaContentCol ul ul,
.saimaDynamicArticleContent ul ul,
.saimaLongContentBody ul ul {
    list-style-type: circle !important;
    margin: 8px 0 8px 0 !important;
    padding-left: 24px !important;
}

.saimaContentCol ul ul ul,
.saimaDynamicArticleContent ul ul ul,
.saimaLongContentBody ul ul ul {
    list-style-type: square !important;
}

/* Ensure ALL body text (p, li, b, i, span) have the exact same dark black color, while h2 remains green */
.saimaContentCol p,
.saimaContentCol li,
.saimaContentCol ul,
.saimaContentCol ol,
.saimaContentCol b,
.saimaContentCol strong,
.saimaContentCol i,
.saimaContentCol em,
.saimaContentCol span:not(.saimaTocTitle):not(.badgeTag):not(.soldOutBadge):not(#saimaTocToggleText),
.saimaDynamicArticleContent,
.saimaDynamicArticleContent p,
.saimaDynamicArticleContent li,
.saimaDynamicArticleContent ul,
.saimaDynamicArticleContent ol,
.saimaDynamicArticleContent b,
.saimaDynamicArticleContent strong,
.saimaDynamicArticleContent i,
.saimaDynamicArticleContent em,
.saimaDynamicArticleContent span,
.saimaDynamicArticleContent div {
    color: #111111 !important;
}

.saimaContentCol p,
.saimaContentCol ul:not(.saimaTocList) li,
.saimaContentCol ol:not(.saimaTocList) li,
.saimaDynamicArticleContent p,
.saimaDynamicArticleContent ul:not(.saimaTocList) li,
.saimaDynamicArticleContent ol:not(.saimaTocList) li {
    font-size: 17px !important;
    line-height: 1.8 !important;
}

.saimaH2,
.saimaContentCol h2,
.saimaDynamicArticleContent h2 {
    color: #1a4731 !important;
}

.saimaContentCol ul:not(.saimaTocList) ul,
.saimaDynamicArticleContent ul ul {
    list-style-type: circle !important;
    margin: 6px 0 6px 0 !important;
    padding-left: 22px !important;
}

.saimaContentCol ul:not(.saimaTocList) ol,
.saimaDynamicArticleContent ul ol {
    list-style-type: decimal !important;
    margin: 6px 0 6px 0 !important;
    padding-left: 22px !important;
}

/* Images in Article */
.saimaImgWrapper {
    margin: 28px auto 32px auto;
    width: 100%;
    text-align: center;
}

.saimaImg {
    width: 100%;
    max-width: 100%;
    height: auto;
    display: block;
    margin: 0 auto;
    border-radius: 8px;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    border: 1px solid #e5e7eb;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.saimaImg:hover {
    box-shadow: 0 8px 24px rgba(0,0,0,0.12);
}

/* Right Sticky Sidebar */
.saimaSidebarCol {
    min-width: 0;
    height: 100%;
    align-self: stretch;
    position: relative;
}

.saimaStickySidebar {
    position: -webkit-sticky;
    position: sticky;
    top: 95px;
    max-height: calc(100vh - 110px);
    overflow-y: auto;
    overscroll-behavior: contain;
    scrollbar-width: thin;
    scrollbar-color: #cbd5e1 transparent;
    display: flex;
    flex-direction: column;
    gap: 24px;
    z-index: 20;
}

.saimaStickySidebar::-webkit-scrollbar {
    width: 4px;
}

.saimaStickySidebar::-webkit-scrollbar-track {
    background: transparent;
}

.saimaStickySidebar::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}

/* Book an Appointment Card */
.saimaApptCard {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 26px 22px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
}

.saimaApptTitle {
    font-size: 18px;
    font-weight: 700;
    text-align: center;
    color: #111827;
    margin: 0 0 18px 0;
    letter-spacing: 0.5px;
    text-transform: uppercase;
}

.saimaApptForm {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.saimaInput {
    width: 100%;
    box-sizing: border-box;
    padding: 13px 15px;
    font-size: 16px;
    color: #111827;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    outline: none;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    font-family: inherit;
}

.saimaInput:focus {
    border-color: #1a4731;
    box-shadow: 0 0 0 3px rgba(26, 71, 49, 0.15);
}

.saimaTextarea {
    width: 100%;
    box-sizing: border-box;
    padding: 13px 15px;
    font-size: 16px;
    color: #111827;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    outline: none;
    resize: vertical;
    min-height: 110px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    font-family: inherit;
}

.saimaTextarea:focus {
    border-color: #1a4731;
    box-shadow: 0 0 0 3px rgba(26, 71, 49, 0.15);
}

/* Submit Button: Exact #1a4731 Color from Image 3 */
.saimaSubmitBtn {
    background-color: #1a4731 !important;
    color: #ffffff !important;
    font-size: 16px;
    font-weight: 700;
    letter-spacing: 1px;
    padding: 15px 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    text-transform: uppercase;
    transition: all 0.25s ease;
    box-shadow: 0 4px 12px rgba(26, 71, 49, 0.25);
}

.saimaSubmitBtn:hover {
    background-color: #123322 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(26, 71, 49, 0.35);
}

.saimaSubmitBtn:active {
    transform: scale(0.99);
}

.saimaSuccessMsg {
    display: none;
    background: #ecfdf5;
    border: 1px solid #a7f3d0;
    color: #065f46;
    padding: 12px;
    border-radius: 6px;
    font-size: 14px;
    text-align: center;
    margin-top: 10px;
}

/* Latest Projects Card (Professional & Prominent Images LP1-LP5) */
.saimaProjectsWidget {
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 22px 20px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.04);
}

.saimaProjectsHeader {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 16px 0;
    padding-bottom: 10px;
    border-bottom: 2px solid #f3f4f6;
}

.saimaProjectList {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.saimaProjectItem {
    display: flex;
    gap: 14px;
    text-decoration: none;
    color: inherit;
    align-items: center;
    padding: 10px;
    border-radius: 7px;
    border: 1px solid #f3f4f6;
    background: #ffffff;
    transition: all 0.2s ease;
}

.saimaProjectItem:hover {
    border-color: #e5e7eb;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    transform: translateY(-2px);
}

.saimaProjectThumb {
    width: 95px;
    height: 80px;
    border-radius: 6px;
    object-fit: cover;
    flex-shrink: 0;
    border: 1px solid #e5e7eb;
    box-shadow: 0 2px 6px rgba(0,0,0,0.06);
    background-color: #f9fafb;
}

.saimaProjectMeta {
    display: flex;
    flex-direction: column;
    min-width: 0;
}

.saimaProjectItemTitle {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
    line-height: 1.35;
    margin-bottom: 4px;
}

.saimaProjectItemDesc {
    font-size: 12.5px;
    color: #6b7280;
    line-height: 1.45;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Responsive */
@media (max-width: 991px) {
    .saimaMainGrid {
        grid-template-columns: 1fr;
        gap: 36px;
    }
    .saimaSidebarCol {
        height: auto;
    }
    .saimaStickySidebar {
        position: static;
        top: auto;
        max-height: none;
        overflow-y: visible;
    }
}
</style>

@php
    $articleSlug = $slug ?? ($page->slug ?? request()->path());
    if ($articleSlug === '/' || empty($articleSlug)) {
        $articleSlug = '/';
    }
    $originalCommunities = [
        'wadeem-gardens', 'hudayriyat-golf-estates', 'bashayer-villas', 'bashayer-residences',
        'al-naseem-villas', 'nawayef-east-hills', 'masyaf-plots', 'nawayef-village',
        'wadeem-plots', 'nawayef-park-views'
    ];
    $cleanSlug = trim($articleSlug, '/');
    if ($cleanSlug === '' || $cleanSlug === '/') {
        $cleanSlug = 'home';
    }

    $isProperty = false;
    if (isset($page) && !empty($page->id)) {
        $isProperty = \App\Models\Project::where('page_id', $page->id)->exists();
    }
    if (!$isProperty) {
        $isProperty = in_array($cleanSlug, \App\Models\Page::projectSlugs(), true)
            || \App\Models\Project::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->exists();
    }

    $isCity = false;
    if (isset($page) && !empty($page->id)) {
        $isCity = \App\Models\City::where('page_id', $page->id)->exists();
    }
    if (!$isCity) {
        $isCity = \App\Models\City::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->exists();
    }
    $isCommunity = false;
    if (isset($page) && !empty($page->id)) {
        $isCommunity = \App\Models\Community::where('page_id', $page->id)->exists();
    }
    if (!$isCommunity) {
        $isCommunity = \App\Models\Community::where('slug', $cleanSlug)->orWhere('slug', '/' . $cleanSlug)->exists();
    }

    $isNewPage = !$isProperty && !$isCity && !$isCommunity && ((isset($isNewPage) && $isNewPage) || (isset($page) && $page->id) || request()->routeIs('pages.dynamic'));
    $shortContentHtml = page_section('content', 'intro', null, $articleSlug);
    $longContentHtml = (isset($page) && !empty($page->body)) ? $page->body : (page_section('content', 'html', null, $articleSlug) ?: page_section('content', 'body', null, $articleSlug));
@endphp

<section class="saimaArticleWrapper" id="saima-article-section" style="{{ $isNewPage ? 'padding: 35px 0 10px 0;' : '' }}">
    <div class="saimaContainer">
        <div class="saimaMainGrid">
            <!-- Left Column: Article Content -->
            <article class="saimaContentCol">
                @if($isNewPage)
                    @if(!empty($shortContentHtml))
                        <div class="saimaShortContent" style="font-size: 16.5px; line-height: 1.8; color: #2b2b2b;">
                            {!! $shortContentHtml !!}
                            <div class="saimaReadMoreWrap">
                                <a href="#pageLongContent" class="saimaReadMoreBtn" onclick="scrollToLongContent(event)">
                                    <span>Read more</span>
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 13l5 5 5-5M12 6v12"/></svg>
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Default Intro Paragraphs for New Page -->
                        <p class="saimaIntroP">
                            Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
                        </p>
                        <p class="saimaIntroP">
                            Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
                        </p>
                        <p class="saimaIntroP">
                            The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
                        </p>
                        <div class="saimaReadMoreWrap">
                            <a href="#pageLongContent" class="saimaReadMoreBtn" onclick="scrollToLongContent(event)">
                                <span>Read more</span>
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M7 13l5 5 5-5M12 6v12"/></svg>
                            </a>
                        </div>
                    @endif
                @else
                    <!-- PROPERTY PAGE: Classic Original Layout (Table of Contents + Full Content / TOC Sections) -->
                    <div class="saimaTocBox" id="saimaToc">
                        <div class="saimaTocHeader">
                            <span class="saimaTocTitle">Table of Contents</span>
                            <button type="button" class="saimaTocToggle" id="saimaTocToggleBtn" aria-label="Toggle Table of Contents" aria-expanded="false">
                                <span id="saimaTocToggleText">Show</span>
                                <svg id="saimaTocChevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m6 9 6 6 6-6"/>
                                </svg>
                            </button>
                        </div>

                        <div id="saimaTocContent">
                            <ol class="saimaTocList">
                                @forelse(toc_items() as $index => $item)
                                    <li>
                                        <a href="#{{ $item->target_id }}" class="saimaTocLink">{{ $index + 1 }}. {{ $item->title }}</a>
                                        @if(isset($item->children) && $item->children->isNotEmpty())
                                            <ul style="list-style:none; padding-left:18px; margin-top:4px;">
                                                @foreach($item->children as $cIdx => $child)
                                                    <li>
                                                        <a href="#{{ $child->target_id }}" class="saimaTocLink" style="font-size:14px; opacity:0.9;">
                                                            {{ $index + 1 }}.{{ $cIdx + 1 }} {{ $child->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @empty
                                    <li><a href="#about-the-developers" class="saimaTocLink">1. About the Developers</a></li>
                                    <li><a href="#saima-mangrove-residences-noc" class="saimaTocLink">2. Saima Mangrove Residences NOC</a></li>
                                    <li><a href="#saima-mangrove-residences-location" class="saimaTocLink">3. Saima Mangrove Residences Location</a></li>
                                    <li><a href="#saima-mangrove-residences-location-map" class="saimaTocLink">4. Saima Mangrove Residences Location Map</a></li>
                                    <li><a href="#saima-mangrove-residences-floor-plan" class="saimaTocLink">5. Saima Mangrove Residences Floor Plan</a></li>
                                    <li><a href="#saima-mangrove-residences-master-plan" class="saimaTocLink">6. Saima Mangrove Residences Master Plan</a></li>
                                    <li><a href="#saima-mangrove-residences-payment-plan" class="saimaTocLink">7. Saima Mangrove Residences Payment Plan</a></li>
                                    <li><a href="#saima-mangrove-residences-installation-plan" class="saimaTocLink">8. Saima Mangrove Residences Installation Plan</a></li>
                                    <li><a href="#apartments-for-sale-in-saima-mangrove-residences" class="saimaTocLink">9. Apartments for Sale in Saima Mangrove Residences</a></li>
                                    <li><a href="#facilities-and-amenities" class="saimaTocLink">10. Facilities and Amenities</a></li>
                                @endforelse
                            </ol>
                        </div>
                    </div>

                    @if(!empty(trim($longContentHtml ?? '')))
                        <div class="saimaDynamicContent" style="font-size: 17px; line-height: 1.8; color: #2b2b2b;">
                            {!! $longContentHtml !!}
                        </div>
                    @else
                        <!-- Intro Paragraphs (Enlarged & Comfortable line-height matching Image 2) -->
                        <p class="saimaIntroP">
                            Saima Mangrove Residences is a new benchmark for living in the city’s waterfront. The project is a blend of contemporary design and a tranquil coastal setting. Residents enjoy fresh sea breezes and access to major urban destinations.
                        </p>
                        <p class="saimaIntroP">
                            Saima Mangrove Residences Karachi is located on the banks of Korangi Creek Road and faces protected mangrove areas. The development offers a lifestyle for professionals, investors, and families inspired by a resort. Furthermore, the area has a peaceful atmosphere, which is away from the noise and hustle of the city center.
                        </p>
                        <p class="saimaIntroP">
                            The project is a blend of luxury, convenience, and investment value. Hence, buyers can purchase a high-value waterfront property in one of the upcoming coastal areas of Karachi.
                        </p>

                        <!-- 1. About the Developers (Color #1a4731 matching Image 3) -->
                        <h2 class="saimaH2" id="about-the-developers">{{ toc_title('about-the-developers', 'About the Developers') }}</h2>
                        {!! toc_content('about-the-developers', '
                        <p class="saimaP">
                            Saima Group has created this historic waterfront community. It has been providing residential and commercial projects in Karachi for decades now. As such, the investors know that the developer has built quality houses and delivered the project on time.
                        </p>
                        <p class="saimaP">
                            The developer is mainly interested in contemporary urban design and building design. In addition, <a href="https://theleadmarketing.com/" target="_blank" rel="noopener noreferrer">Lead Marketing</a> assists with the project’s sales and advisory services. The firm’s real estate background and investment expertise are applied in each client interaction.
                        </p>
                        ') !!}

                        <!-- 2. Saima Mangrove Residences NOC -->
                        <h2 class="saimaH2" id="saima-mangrove-residences-noc">{{ toc_title('saima-mangrove-residences-noc', 'Saima Mangrove Residences NOC') }}</h2>
                        {!! toc_content('saima-mangrove-residences-noc', '
                        <p class="saimaP">
                            Legal security is one of the key factors that property buyers take into consideration for an investment before they actually buy a property. Hence, the developer gathered all the clearances for the project.
                        </p>
                        <p class="saimaP">
                            Saima Mangrove Residences NOC is approved by the relevant development authorities. The project also meets environmental and construction requirements. Consequently, buyers can invest with increased confidence.
                        </p>
                        <p class="saimaP">
                            Approval of the documentation provides added security of ownership and future saleability. Also, there is no significant regulatory issue to consider with financial institutions assessing the project.
                        </p>
                        ') !!}

                        <!-- 3. Saima Mangrove Residences Location -->
                        <h2 class="saimaH2" id="saima-mangrove-residences-location">{{ toc_title('saima-mangrove-residences-location', 'Saima Mangrove Residences Location') }}</h2>
                        {!! toc_content('saima-mangrove-residences-location', '
                        <p class="saimaP">
                            The Saima Mangrove Residences Location is in one of the most sought-after waterfront areas in Karachi. The project is located on Korangi Creek Road with direct access to key urban destinations.
                        </p>
                        <p class="saimaP">
                            DHA Phase VIII is just a short drive from residents. Moreover, they can also easily reach the Korangi Industrial Area and the Institute of Business Management. So, it’s the perfect location for the working professional and growing family.
                        </p>
                        ') !!}

                        <!-- 4. Saima Mangrove Residences Location Map -->
                        <h2 class="saimaH2" id="saima-mangrove-residences-location-map">{{ toc_title('saima-mangrove-residences-location-map', 'Saima Mangrove Residences Location Map') }}</h2>
                        {!! toc_content('saima-mangrove-residences-location-map', '
                        <p class="saimaP">
                            The Saima Mangrove Residences location map shows the prime location of the project on Korangi Creek Road. The location map will give an idea of how easily you can get to important points across Karachi.
                        </p>
                        <p class="saimaP">
                            The project is located next to Creek Marina and DHA Phase VIII. It has access to major road networks, so going to the airport or city center will not be a problem.
                        </p>
                        ') !!}

                        <!-- 5. Saima Mangrove Residences Floor Plan -->
                        <h2 class="saimaH2" id="saima-mangrove-residences-floor-plan">{{ toc_title('saima-mangrove-residences-floor-plan', 'Saima Mangrove Residences Floor Plan') }}</h2>
                        {!! toc_content('saima-mangrove-residences-floor-plan', '
                        <p class="saimaP">
                            The Saima Mangrove Residences Floor Plan provides a wide variety of apartment sizes for various living styles and needs. These apartments have 3, 4, and 5-room layouts that give sufficient living space to growing families.
                        </p>
                        <p class="saimaP">
                            The plans maximize room efficiency, with separate living and dining spaces. In addition, wide balconies are integrated into the homes to provide residents with views of the mangroves and coastal areas.
                        </p>
                        ') !!}

                        <!-- 6. Saima Mangrove Residences Master Plan -->
                        <h2 class="saimaH2" id="saima-mangrove-residences-master-plan">{{ toc_title('saima-mangrove-residences-master-plan', 'Saima Mangrove Residences Master Plan') }}</h2>
                        {!! toc_content('saima-mangrove-residences-master-plan', '
                        <p class="saimaP">
                            The Saima Mangrove Residences Master Plan offers modern living with lots of green spaces and amenities. The master plan ensures that residential towers are strategically positioned to give every apartment clear views.
                        </p>
                        <p class="saimaP">
                            The master plan features dedicated vehicle access, secured entry points, and plenty of parking spaces. Landscaped walkways and podium gardens create spaces where residents can walk around without having to worry about road traffic.
                        </p>
                        ') !!}

                        <!-- 7. Saima Mangrove Residences Payment Plan -->
                        <h2 class="saimaH2" id="saima-mangrove-residences-payment-plan">{{ toc_title('saima-mangrove-residences-payment-plan', 'Saima Mangrove Residences Payment Plan') }}</h2>
                        {!! toc_content('saima-mangrove-residences-payment-plan', '
                        <p class="saimaP">
                            The developers have designed the Saima Mangrove Residences Payment Plan to be convenient for property buyers and investors. The flexible installment plan lets buyers spread payments across the construction duration.
                        </p>
                        <p class="saimaP">
                            Buyers can book an apartment with a reasonable down payment. The remaining balance is paid through manageable monthly and quarterly installments. This structured payment schedule helps investors manage their finances smoothly.
                        </p>
                        ') !!}

                        <!-- 8. Saima Mangrove Residences Installation Plan -->
                        <h2 class="saimaH2" id="saima-mangrove-residences-installation-plan">{{ toc_title('saima-mangrove-residences-installation-plan', 'Saima Mangrove Residences Installation Plan') }}</h2>
                        {!! toc_content('saima-mangrove-residences-installation-plan', '
                        <p class="saimaP">
                            The installment plan is structured so that payments align with project construction milestones. This milestone-linked payment structure gives buyers transparency and peace of mind as the building progresses.
                        </p>
                        <p class="saimaP">
                            Payments are divided into easy monthly installments and construction-linked stage payments. This ensures steady progress and makes owning a luxury waterfront home accessible.
                        </p>
                        ') !!}

                        <!-- 9. Apartments for Sale in Saima Mangrove Residences -->
                        <h2 class="saimaH2" id="apartments-for-sale-in-saima-mangrove-residences">{{ toc_title('apartments-for-sale-in-saima-mangrove-residences', 'Apartments for Sale in Saima Mangrove Residences') }}</h2>
                        {!! toc_content('apartments-for-sale-in-saima-mangrove-residences', '
                        <p class="saimaP">
                            Apartments for sale in Saima Mangrove Residences offer homes that cater to different family sizes and investment strategies. Buyers can choose from 3, 4, and 5-room luxury apartments, each designed with high-quality finishes and modern fittings.
                        </p>
                        <p class="saimaP">
                            The apartments feature expansive floor-to-ceiling windows that provide natural light and stunning waterfront views. High ceilings and spacious layouts ensure comfortable, upscale living.
                        </p>
                        ') !!}

                        <!-- 10. Facilities and Amenities -->
                        <h2 class="saimaH2" id="facilities-and-amenities">{{ toc_title('facilities-and-amenities', 'Facilities and Amenities') }}</h2>
                        {!! toc_content('facilities-and-amenities', '
                        <p class="saimaP">
                            Saima Mangrove Residences provides a wide range of world-class facilities and amenities for its residents. These include an infinity swimming pool, a fully equipped gym, a children’s play area, and high-speed elevators.
                        </p>
                        <p class="saimaP">
                            The project also offers 24/7 security with CCTV surveillance, standby power generators, and dedicated parking. Landscaped gardens and community recreation areas provide the ideal environment for families.
                        </p>
                        ') !!}

                        <!-- Additional / Custom TOC Sections -->
                        @php
                            $builtInTargets = [
                                'about-the-developers',
                                'saima-mangrove-residences-noc',
                                'saima-mangrove-residences-location',
                                'saima-mangrove-residences-location-map',
                                'saima-mangrove-residences-floor-plan',
                                'saima-mangrove-residences-master-plan',
                                'saima-mangrove-residences-payment-plan',
                                'saima-mangrove-residences-installation-plan',
                                'apartments-for-sale-in-saima-mangrove-residences',
                                'facilities-and-amenities',
                            ];
                        @endphp

                        @foreach(toc_items() as $extraItem)
                            @if(!in_array($extraItem->target_id, $builtInTargets))
                                <h2 class="saimaH2" id="{{ $extraItem->target_id }}">{{ $extraItem->title }}</h2>
                                @if(!empty($extraItem->image))
                                    <div class="saimaImgWrapper">
                                        <img src="{{ asset(ltrim($extraItem->image, '/')) }}" alt="{{ $extraItem->title }}" class="saimaImg">
                                    </div>
                                @endif
                                {!! !empty(trim($extraItem->content ?? '')) ? $extraItem->content : '<p class="saimaP">' . e($extraItem->title) . '</p>' !!}

                                @if(isset($extraItem->children) && $extraItem->children->isNotEmpty())
                                    @foreach($extraItem->children as $extraChild)
                                        @if(!in_array($extraChild->target_id, $builtInTargets))
                                            <h3 class="saimaH3" id="{{ $extraChild->target_id }}">{{ $extraChild->title }}</h3>
                                            @if(!empty($extraChild->image))
                                                <div class="saimaImgWrapper">
                                                    <img src="{{ asset(ltrim($extraChild->image, '/')) }}" alt="{{ $extraChild->title }}" class="saimaImg">
                                                </div>
                                            @endif
                                            {!! !empty(trim($extraChild->content ?? '')) ? $extraChild->content : '' !!}
                                        @endif
                                    @endforeach
                                @endif
                            @endif
                        @endforeach
                    @endif
                @endif
            </article>

            <!-- Right Column: Sticky Sidebar -->
            <aside class="saimaSidebarCol">
                <div class="saimaStickySidebar">
                    <!-- BOOK AN APPOINTMENT Form -->
                    <div class="saimaApptCard">
                        <h3 class="saimaApptTitle">BOOK AN APPOINTMENT</h3>
                        <form id="saimaAppointmentForm" class="saimaApptForm">
                            <input type="text" name="name" class="saimaInput" placeholder="Name" required>
                            <input type="tel" name="phone" class="saimaInput" placeholder="Phone" required>
                            <input type="email" name="email" class="saimaInput" placeholder="Email" required>
                            <textarea name="comment" class="saimaTextarea" placeholder="Leave a comment here"></textarea>
                            <button type="submit" class="saimaSubmitBtn">SUBMIT</button>
                            <div id="saimaFormSuccess" class="saimaSuccessMsg">
                                Thank you! Your appointment request has been submitted successfully.
                            </div>
                        </form>
                    </div>

                    @php
                        $sidebarProjects = \App\Models\Project::where('is_active', true)
                            ->where(function($q) {
                                $q->whereNull('status')->orWhere('status', '!=', 'draft');
                            })
                            ->whereDoesntHave('page', function($q) {
                                $q->where('status', 'draft')->orWhere('is_published', false);
                            })
                            ->orderBy('order', 'asc')
                            ->take(5)
                            ->get();
                    @endphp
                    @if(!$isNewPage && $sidebarProjects->isNotEmpty())
                    <!-- Latest Projects Card -->
                    <div class="saimaProjectsWidget">
                        <h4 class="saimaProjectsHeader">Latest Projects</h4>
                        <div class="saimaProjectList">
                            @foreach($sidebarProjects as $sProj)
                                <a href="{{ url(ltrim($sProj->slug, '/')) }}" class="saimaProjectItem">
                                    <img src="{{ $sProj->image_url ?: asset('LP1.png') }}" alt="{{ $sProj->title }}" class="saimaProjectThumb">
                                    <div class="saimaProjectMeta">
                                        <span class="saimaProjectItemTitle">{{ $sProj->title }}</span>
                                        <span class="saimaProjectItemDesc">{{ $sProj->location ?? 'Hudayriyat Island, Abu Dhabi' }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </aside>
        </div>
    </div>
</section>

@if($isNewPage)
    <!-- 2. Project Cards Section (Communities Grid) - Only for New Created Pages -->
    @include('partials.page-communities')
    @php $communitiesRendered = true; $GLOBALS['communitiesRenderedGlobal'] = true; @endphp

    <!-- 3. Long Content Section - Only for New Created Pages -->
    @if(!empty(trim($longContentHtml ?? '')))
        <section class="saimaLongContentSection" id="pageLongContent" style="padding: 45px 0 70px 0; background: #ffffff; border-top: 1px solid #ebdccb; scroll-margin-top: 85px;">
            <div class="saimaContainer">
                <div class="saimaLongContentBody" style="max-width: 960px; margin: 0 auto; font-size: 16.5px; line-height: 1.85; color: #2b2b2b;">
                    {!! $longContentHtml !!}
                </div>
            </div>
        </section>
    @endif
@endif
<script>
function scrollToLongContent(e) {
    if (e) e.preventDefault();
    const target = document.getElementById('pageLongContent');
    if (target) {
        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Helper to generate clean URL/ID slug from text
    function slugify(text) {
        return (text || '')
            .toString()
            .toLowerCase()
            .trim()
            .replace(/&/g, 'and')
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
    }

    // 1. Table of Contents Toggle Collapse/Expand
    const tocToggleBtn = document.getElementById('saimaTocToggleBtn');
    const tocContent = document.getElementById('saimaTocContent');
    const tocText = document.getElementById('saimaTocToggleText');
    
    if (tocToggleBtn && tocContent) {
        tocToggleBtn.addEventListener('click', function() {
            const isHidden = window.getComputedStyle(tocContent).display === 'none';
            if (isHidden) {
                tocContent.style.display = 'block';
                tocToggleBtn.classList.add('is-open');
                if (tocText) tocText.textContent = 'Hide';
                tocToggleBtn.setAttribute('aria-expanded', 'true');
            } else {
                tocContent.style.display = 'none';
                tocToggleBtn.classList.remove('is-open');
                if (tocText) tocText.textContent = 'Show';
                tocToggleBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // 2. Discover all article H2 headings & guarantee IDs
    const contentCol = document.querySelector('.saimaContentCol');
    let articleH2s = [];
    if (contentCol) {
        articleH2s = Array.from(contentCol.querySelectorAll('h2')).filter(function(h) {
            return !h.closest('.saimaTocBox') && !h.closest('.saimaProjectsWidget') && !h.closest('.saimaApptCard');
        });
    }

    // Ensure every H2 has a valid, unique id attribute
    const usedSlugs = {};
    articleH2s.forEach(function(h2, idx) {
        let currentId = (h2.getAttribute('id') || '').trim();
        if (!currentId) {
            currentId = slugify(h2.textContent) || ('heading-' + (idx + 1));
        } else {
            currentId = slugify(currentId) || ('heading-' + (idx + 1));
        }
        let uniqueId = currentId;
        let counter = 1;
        while (usedSlugs[uniqueId]) {
            uniqueId = currentId + '-' + (++counter);
        }
        usedSlugs[uniqueId] = true;
        h2.setAttribute('id', uniqueId);
    });

    // 3. Synchronize TOC list with current H2 headings
    const tocList = document.querySelector('.saimaTocList');
    if (tocList && articleH2s.length > 0) {
        tocList.innerHTML = '';
        articleH2s.forEach(function(h2, idx) {
            const li = document.createElement('li');
            const a = document.createElement('a');
            const targetId = h2.getAttribute('id');
            a.href = '#' + targetId;
            a.className = 'saimaTocLink';
            a.textContent = (idx + 1) + '. ' + h2.textContent.trim();
            li.appendChild(a);
            tocList.appendChild(li);
        });
    }

    // 4. Smooth Scrolling function with sticky navbar offset
    function scrollToTargetElement(targetEl) {
        if (!targetEl) return;
        const navOffset = 95; // Fixed navbar offset
        const rect = targetEl.getBoundingClientRect();
        const targetY = rect.top + window.pageYOffset - navOffset;
        window.scrollTo({
            top: Math.max(0, targetY),
            behavior: 'smooth'
        });
    }

    // 5. Delegated Click Handler for TOC and Anchor Links
    document.addEventListener('click', function(e) {
        const link = e.target.closest('.saimaTocLink, a[href^="#"]');
        if (!link) return;
        const href = link.getAttribute('href');
        if (!href || href === '#' || !href.startsWith('#')) return;

        const rawId = href.slice(1);
        let targetEl = document.getElementById(rawId);
        if (!targetEl) {
            try {
                targetEl = document.querySelector(href);
            } catch (err) {
                targetEl = null;
            }
        }

        // Fallback: match by slugified heading text
        if (!targetEl && articleH2s.length > 0) {
            targetEl = articleH2s.find(function(h) {
                return slugify(h.textContent) === rawId || h.getAttribute('id') === rawId;
            });
        }

        if (targetEl) {
            e.preventDefault();
            if (history.pushState) {
                history.pushState(null, null, href);
            } else {
                window.location.hash = href;
            }
            scrollToTargetElement(targetEl);

            document.querySelectorAll('.saimaTocLink').forEach(function(l) {
                l.classList.remove('active');
            });
            if (link.classList.contains('saimaTocLink')) {
                link.classList.add('active');
            }
        }
    });

    // 6. Handle Direct URL Hash on Initial Page Load (e.g. /wadeem-gardens#about-the-developers)
    if (window.location.hash && window.location.hash.length > 1) {
        const initialHash = window.location.hash;
        setTimeout(function() {
            const rawId = initialHash.slice(1);
            let targetEl = document.getElementById(rawId);
            if (!targetEl) {
                try {
                    targetEl = document.querySelector(initialHash);
                } catch (err) {
                    targetEl = null;
                }
            }
            if (!targetEl && articleH2s.length > 0) {
                targetEl = articleH2s.find(function(h) {
                    return slugify(h.textContent) === rawId || h.getAttribute('id') === rawId;
                });
            }
            if (targetEl) {
                scrollToTargetElement(targetEl);
                const activeLink = document.querySelector(`.saimaTocLink[href="${initialHash}"]`);
                if (activeLink) {
                    document.querySelectorAll('.saimaTocLink').forEach(function(l) { l.classList.remove('active'); });
                    activeLink.classList.add('active');
                }
            }
        }, 250);
    }

    // 7. Scroll Spy for TOC active link highlight
    window.addEventListener('scroll', function() {
        if (!articleH2s || articleH2s.length === 0) return;
        let currentId = '';
        const scrollPosition = window.pageYOffset + 120;
        articleH2s.forEach(function(heading) {
            if (heading.offsetTop <= scrollPosition) {
                currentId = heading.getAttribute('id');
            }
        });
        if (currentId) {
            document.querySelectorAll('.saimaTocLink').forEach(function(link) {
                if (link.getAttribute('href') === '#' + currentId) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });
        }
    }, { passive: true });

    // 4. Appointment Form AJAX Submission
    const apptForm = document.getElementById('saimaAppointmentForm');
    const successMsg = document.getElementById('saimaFormSuccess');
    if (apptForm) {
        apptForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const btn = apptForm.querySelector('button[type="submit"]');
            const originalText = btn.textContent;
            btn.textContent = 'SUBMITTING...';
            btn.disabled = true;

            const formData = {
                name: apptForm.querySelector('input[name="name"]').value,
                phone: apptForm.querySelector('input[name="phone"]').value,
                email: apptForm.querySelector('input[name="email"]').value,
                comment: apptForm.querySelector('textarea[name="comment"]').value,
                source: window.location.pathname
            };

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            fetch('/api/leads', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(formData)
            })
            .then(res => res.json())
            .then(data => {
                btn.textContent = originalText;
                btn.disabled = false;
                if (successMsg) {
                    successMsg.style.display = 'block';
                }
                apptForm.reset();
                setTimeout(() => {
                    if (successMsg) successMsg.style.display = 'none';
                }, 6000);
            })
            .catch(err => {
                console.log('Lead submission:', err);
                btn.textContent = originalText;
                btn.disabled = false;
                if (successMsg) {
                    successMsg.style.display = 'block';
                }
                apptForm.reset();
            });
        });
    }

    // 5. Sticky Navbar on Scroll (Universal for all pages)
    const pageHeader = document.querySelector('header');
    if (pageHeader) {
        const handleHeaderScroll = () => {
            if (window.scrollY > 40) {
                pageHeader.classList.add('sticky-header');
            } else {
                pageHeader.classList.remove('sticky-header');
            }
        };
        window.addEventListener('scroll', handleHeaderScroll, { passive: true });
        handleHeaderScroll();
    }
});
</script>