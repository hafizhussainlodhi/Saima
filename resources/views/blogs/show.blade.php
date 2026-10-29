@extends('layouts.app')

@section('title', $blog->meta_title ?: $blog->title)
@section('meta_description', $blog->meta_description ?: ($blog->short_content ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 160)))

@section('content')
<style>
.blogDetailWrapper {
    width: 100%;
    background-color: #ffffff;
    font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    color: #2b2b2b;
    line-height: 1.8;
}

/* Hero Banner with Cover Image Background */
.blogDetailHero {
    position: relative;
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    color: #ffffff;
    padding: 135px 0 120px 0;
    min-height: 420px;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.blogDetailHero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, rgba(10, 26, 17, 0.70) 0%, rgba(10, 26, 17, 0.85) 100%);
    z-index: 1;
}

.blogDetailHeroContainer {
    max-width: 1200px;
    width: 100%;
    margin: 0 auto;
    padding: 0 24px;
    position: relative;
    z-index: 2;
}

.blogCategoryBadge {
    display: inline-flex;
    align-items: center;
    background: rgba(255, 255, 255, 0.18);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.35);
    padding: 6px 16px;
    border-radius: 999px;
    font-size: 12.5px;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    margin-bottom: 18px;
    backdrop-filter: blur(8px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
}

.blogDetailTitle {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 40px;
    font-weight: 800;
    line-height: 1.25;
    color: #ffffff;
    margin: 0;
    letter-spacing: -0.02em;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.35);
    max-width: 950px;
}

/* Main Body Section & 2-Column Grid (matching Project Details) */
.blogDetailBodySection {
    padding: 50px 0 80px 0;
}

.blogDetailContainer {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    box-sizing: border-box;
}

.blogMainGrid {
    display: grid;
    grid-template-columns: 1fr 340px;
    gap: 40px;
    align-items: start;
}

.blogContentCol {
    min-width: 0;
}

/* Short Content Lead Paragraphs (Above Long Content) */
.blogShortContentLead {
    font-size: 17.5px;
    line-height: 1.85;
    color: #1e293b;
    margin-top: 24px;
    margin-bottom: 6px;
    font-weight: 400;
}

.blogShortContentLead p {
    margin-bottom: 8px;
}

.blogShortContentLead p:last-child {
    margin-bottom: 0;
}

/* Table of Contents Box (Exact Project Style) */
.saimaTocBox {
    border: 1px solid #dcdcdc;
    border-radius: 6px;
    background-color: #ffffff;
    padding: 18px 24px;
    margin-bottom: 36px;
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
    font-size: 17px;
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

/* Rich Blog Article Content Styles */
.blogArticleContent {
    font-size: 17px;
    line-height: 1.85;
    color: #2b2b2b;
}

.blogArticleContent h1,
.blogArticleContent h2 {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 34px;
    font-weight: 700;
    color: #1a4731;
    margin: 36px 0 16px 0;
    line-height: 1.35;
    letter-spacing: -0.01em;
    scroll-margin-top: 100px;
}

/* Reduce gap before the first heading right under short content */
.blogArticleContent > h1:first-child,
.blogArticleContent > h2:first-child,
.blogArticleContent > h3:first-child,
.blogArticleContent > p:first-child:has(h1),
.blogArticleContent > p:first-child:has(h2),
.blogArticleContent > div:first-child:has(h2) {
    margin-top: 10px !important;
}

.blogArticleContent h3 {
    font-size: 22px;
    font-weight: 700;
    color: #1e293b;
    margin: 30px 0 14px 0;
    scroll-margin-top: 100px;
}

.blogArticleContent h4 {
    font-size: 19px;
    font-weight: 700;
    color: #334155;
    margin: 24px 0 10px 0;
    scroll-margin-top: 100px;
}

.blogArticleContent p {
    margin-bottom: 22px;
    color: #374151;
}

.blogArticleContent ul {
    list-style-type: disc !important;
    list-style-position: outside !important;
    margin: 16px 0 24px 0 !important;
    padding-left: 30px !important;
}

.blogArticleContent ol {
    list-style-type: decimal !important;
    list-style-position: outside !important;
    margin: 16px 0 24px 0 !important;
    padding-left: 30px !important;
}

.blogArticleContent li {
    display: list-item !important;
    margin-bottom: 10px !important;
    line-height: 1.8 !important;
    color: #374151 !important;
}

.blogArticleContent ul ul {
    list-style-type: circle !important;
    margin: 8px 0 8px 0 !important;
    padding-left: 24px !important;
}

.blogArticleContent img {
    max-width: 100%;
    border-radius: 12px;
    margin: 24px 0;
    box-shadow: 0 4px 14px rgba(0,0,0,0.06);
}

.blogArticleContent blockquote {
    border-left: 4px solid #1a4731;
    background: #f8fafc;
    padding: 16px 22px;
    margin: 24px 0;
    border-radius: 0 8px 8px 0;
    font-style: italic;
    color: #475569;
}



.blogFaqItem {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    margin-bottom: 14px;
    overflow: hidden;
    background: #ffffff;
    transition: all 0.2s ease;
}

.blogFaqItem:hover {
    border-color: #cbd5e1;
    box-shadow: 0 2px 8px rgba(0,0,0,0.03);
}

.blogFaqQuestion {
    padding: 18px 22px;
    font-size: 16.5px;
    font-weight: 700;
    color: #1e293b;
    cursor: pointer;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    user-select: none;
}

.blogFaqIcon {
    width: 20px;
    height: 20px;
    color: #1a4731;
    transition: transform 0.25s ease;
    flex-shrink: 0;
}

.blogFaqAnswer {
    padding: 0 22px 18px 22px;
    font-size: 15.5px;
    line-height: 1.75;
    color: #475569;
    display: none;
}

.blogFaqItem.active .blogFaqIcon {
    transform: rotate(180deg);
}

.blogFaqItem.active .blogFaqAnswer {
    display: block;
}

/* Right Sticky Sidebar (Exact Project Style) */
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
    font-size: 15.5px;
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
    font-size: 15.5px;
    color: #111827;
    background-color: #ffffff;
    border: 1px solid #d1d5db;
    border-radius: 5px;
    outline: none;
    resize: vertical;
    min-height: 105px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    font-family: inherit;
}

.saimaTextarea:focus {
    border-color: #1a4731;
    box-shadow: 0 0 0 3px rgba(26, 71, 49, 0.15);
}

.saimaSubmitBtn {
    background-color: #1a4731 !important;
    color: #ffffff !important;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 1px;
    padding: 14px 18px;
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

/* Latest Projects Card */
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
    width: 90px;
    height: 75px;
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
    font-size: 13.5px;
    font-weight: 700;
    color: #111827;
    line-height: 1.35;
    margin-bottom: 4px;
}

.saimaProjectItemDesc {
    font-size: 12px;
    color: #6b7280;
    line-height: 1.45;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* FAQ Accordion Section (Clean section below 2-column article grid) */
.blogFaqSection {
    margin-top: 60px;
    padding-top: 50px;
    border-top: 1px solid #e2e8f0;
    max-width: 960px;
    margin-left: auto;
    margin-right: auto;
}

.blogFaqHeading {
    font-family: var(--font-display, 'Outfit', sans-serif);
    font-size: 30px;
    font-weight: 800;
    color: #1a4731;
    margin: 0 0 24px 0;
    letter-spacing: -0.01em;
}

@media (max-width: 991px) {
    .blogMainGrid {
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

@media (max-width: 768px) {
    .blogDetailTitle {
        font-size: 30px;
    }
    .blogDetailHero {
        padding: 85px 0 75px 0;
        min-height: 290px;
    }
}
</style>

@php
    $coverImageSrc = $blog->cover_image ? asset($blog->cover_image) : asset('/images/Hudayriyat-Island---Marsana-East-Beach---Sign---Sunset-2.jpg');
@endphp

<div class="blogDetailWrapper">
    <!-- Hero Banner with Cover Image Background -->
    <section class="blogDetailHero" style="background-image: url('{{ $coverImageSrc }}');">
        <div class="blogDetailHeroContainer">
            <h1 class="blogDetailTitle">{{ $blog->title }}</h1>
        </div>
    </section>

    <!-- Main Content Section: 2-Column Grid (Article on Left, Sticky Sidebar on Right) -->
    <main class="blogDetailBodySection">
        <div class="blogDetailContainer">
            <div class="blogMainGrid">

                <!-- Left Column: Table of Contents, Short Content & Long Content -->
                <div class="blogContentCol">

                    <!-- 1. Table of Contents (Exact Project Page Style) -->
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
                            <ol class="saimaTocList" id="saimaTocList">
                                <!-- Dynamically populated by JS from article headings -->
                            </ol>
                        </div>
                    </div>

                    <!-- 2. Short Content (Placed directly above 'About the Developers' / Long Content) -->
                    @if(!empty($blog->short_content))
                        <div class="blogShortContentLead" style="margin-top: 24px; margin-bottom: 6px;">
                            {!! nl2br(e($blog->short_content)) !!}
                        </div>
                    @endif

                    <!-- 3. Long Content (Full Article) -->
                    <article class="blogArticleContent">
                        {!! $blog->content !!}
                    </article>

                </div>

                <!-- Right Column: Sticky Sidebar (Appointment Form & Latest Projects) -->
                <aside class="saimaSidebarCol">
                    <div class="saimaStickySidebar">

                        <!-- Form Card: Book an Appointment -->
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

                        <!-- Latest Projects Card -->
                        <div class="saimaProjectsWidget">
                            <h4 class="saimaProjectsHeader">Latest Projects</h4>
                            <div class="saimaProjectList">
                                <a href="/wadeem-gardens" class="saimaProjectItem">
                                    <img src="{{ asset('LP1.png') }}" alt="Lorévia Collection by DECA at Al Zorah, Ajman" class="saimaProjectThumb">
                                    <div class="saimaProjectMeta">
                                        <span class="saimaProjectItemTitle">Lorévia Collection by DECA at Al Zorah, Ajman</span>
                                        <span class="saimaProjectItemDesc">Lorévia Collection Apartments by DECA in Al Zorah, Ajman. From AED 1.2M...</span>
                                    </div>
                                </a>
                                <a href="/hudayriyat-golf-estates" class="saimaProjectItem">
                                    <img src="{{ asset('LP2.png') }}" alt="Samana South Haven 2 by Samana at Dubai Industrial City" class="saimaProjectThumb">
                                    <div class="saimaProjectMeta">
                                        <span class="saimaProjectItemTitle">Samana South Haven 2 by Samana at Dubai Industrial City</span>
                                        <span class="saimaProjectItemDesc">Samana South Haven 2 by Samana launches luxury homes in Dubai...</span>
                                    </div>
                                </a>
                                <a href="/bashayer-villas" class="saimaProjectItem">
                                    <img src="{{ asset('LP3.png') }}" alt="Lily Tower by Tiger Group in Al Jerf, Ajman" class="saimaProjectThumb">
                                    <div class="saimaProjectMeta">
                                        <span class="saimaProjectItemTitle">Lily Tower by Tiger Group in Al Jerf, Ajman</span>
                                        <span class="saimaProjectItemDesc">Lily Tower Ajman Apartments by Tiger Group is a new residential...</span>
                                    </div>
                                </a>
                                <a href="/al-naseem-villas" class="saimaProjectItem">
                                    <img src="{{ asset('LP4.png') }}" alt="Avana Residences by DECA Properties at JVC District 10" class="saimaProjectThumb">
                                    <div class="saimaProjectMeta">
                                        <span class="saimaProjectItemTitle">Avana Residences by DECA Properties at JVC District 10</span>
                                        <span class="saimaProjectItemDesc">Avana Residences Dubai Apartments by DECA Properties i...</span>
                                    </div>
                                </a>
                                <a href="/nawayef-east-hills" class="saimaProjectItem">
                                    <img src="{{ asset('LP5.png') }}" alt="Elan Tower by Alfulaiti" class="saimaProjectThumb">
                                    <div class="saimaProjectMeta">
                                        <span class="saimaProjectItemTitle">Elan Tower by Alfulaiti</span>
                                        <span class="saimaProjectItemDesc">Modern urban luxury residences in prime location...</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>
                </aside>

            </div>

            <!-- 4. Optional FAQs Accordion (Outside 2-column grid: side form will not appear beside it) -->
            @if(is_array($blog->faqs) && count($blog->faqs) > 0)
                <section class="blogFaqSection">
                    <h2 class="blogFaqHeading">Frequently Asked Questions</h2>
                    @foreach($blog->faqs as $fIndex => $faq)
                        @if(!empty($faq['question']))
                            <div class="blogFaqItem {{ $fIndex === 0 ? 'active' : '' }}" onclick="toggleBlogFaq(this)">
                                <div class="blogFaqQuestion">
                                    <span>{{ $faq['question'] }}</span>
                                    <svg class="blogFaqIcon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"/></svg>
                                </div>
                                <div class="blogFaqAnswer">
                                    {!! nl2br(e($faq['answer'] ?? '')) !!}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </section>
            @endif

        </div>
    </main>
</div>

<script>
// Toggle FAQs
function toggleBlogFaq(el) {
    el.classList.toggle('active');
}

document.addEventListener('DOMContentLoaded', function() {
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

    // 2. Discover all article Headings & populate TOC List dynamically
    const articleBody = document.querySelector('.blogArticleContent');
    const tocBox = document.getElementById('saimaToc');
    const tocList = document.getElementById('saimaTocList');

    if (articleBody && tocList && tocBox) {
        const headings = Array.from(articleBody.querySelectorAll('h1, h2, h3, h4'));
        if (headings.length > 0) {
            tocList.innerHTML = '';
            const usedIds = {};

            headings.forEach(function(h, idx) {
                let text = h.textContent.trim();
                if (!text) return;

                let id = h.getAttribute('id');
                if (!id) {
                    id = text.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .trim()
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    if (!id) id = 'heading-' + (idx + 1);
                }

                let uniqueId = id;
                let c = 1;
                while (usedIds[uniqueId]) {
                    uniqueId = id + '-' + (++c);
                }
                usedIds[uniqueId] = true;
                h.setAttribute('id', uniqueId);

                const li = document.createElement('li');
                const tag = h.tagName.toLowerCase();
                if (tag === 'h3' || tag === 'h4') {
                    li.style.paddingLeft = '18px';
                    li.style.fontSize = '15.5px';
                }

                const a = document.createElement('a');
                a.href = '#' + uniqueId;
                a.className = 'saimaTocLink';
                a.textContent = (idx + 1) + '. ' + text;

                a.addEventListener('click', function(e) {
                    e.preventDefault();
                    const targetEl = document.getElementById(uniqueId);
                    if (targetEl) {
                        targetEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                        try {
                            window.history.pushState(null, null, '#' + uniqueId);
                        } catch (err) {}
                    }
                });

                li.appendChild(a);
                tocList.appendChild(li);
            });
        } else {
            // If no headings inside full content, provide standard section jumps or keep default
            tocBox.style.display = 'none';
        }
    }

    // 3. Appointment Form AJAX Submission
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

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}';

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
                if (successMsg) successMsg.style.display = 'block';
                apptForm.reset();
                setTimeout(() => {
                    if (successMsg) successMsg.style.display = 'none';
                }, 6000);
            })
            .catch(err => {
                btn.textContent = originalText;
                btn.disabled = false;
                if (successMsg) successMsg.style.display = 'block';
                apptForm.reset();
            });
        });
    }
});
</script>
@endsection
