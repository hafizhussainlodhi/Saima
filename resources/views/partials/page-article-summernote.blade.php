@php
    $articleSummernote = page_section('content', 'html', page_section('content', 'body', $page->body, $page->slug ?? null), $page->slug ?? null);
    $articleHeading = page_section('content', 'title', $page->title . ' Overview & Detailed Insights', $page->slug ?? null);
@endphp

@if(!empty(trim($articleSummernote ?? '')))
<section id="summernoteExpandContainer" class="saimaSummernoteAfterProjects" style="display: block; padding: 60px 0 85px 0; background: #ffffff; border-top: 1px solid #ebdccb;">
    <div class="container" style="max-width: 1240px; margin: 0 auto; padding: 0 20px;">
        <div class="saimaSummernoteInner" style="max-width: 960px; margin: 0 auto;">
            
            <!-- Section Header -->
            <div style="margin-bottom: 25px; border-bottom: 1px solid #f0eae1; padding-bottom: 15px;">
                <span style="font-size: 11.5px; font-weight: 700; color: #1a4731; text-transform: uppercase; letter-spacing: 1px; display: block; margin-bottom: 6px;">
                    DETAILED OVERVIEW &amp; SPECIFICATIONS
                </span>
                <h3 style="font-size: 26px; font-weight: 700; color: #111827; margin: 0; line-height: 1.35;">
                    {{ $articleHeading }}
                </h3>
            </div>

            <!-- Summernote HTML Rich Content (Text, Headings, Photos, etc.) -->
            <div class="saimaSummernoteBodyContent" style="font-size: 16px; color: #374151; line-height: 1.85;">
                {!! $articleSummernote !!}
            </div>

            <!-- Action Bar: Scroll Back to Top -->
            <div style="margin-top: 40px; padding-top: 20px; border-top: 1px dashed #d1d5db; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <button type="button" onclick="scrollBackToIntro()" class="saimaReadMoreBtn" style="font-size: 14.5px; font-weight: 700; color: #1a4731; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; background: none; border: none; text-decoration: underline; text-underline-offset: 4px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transform: rotate(180deg);">
                        <polyline points="6 9 12 15 18 9"></polyline>
                    </svg>
                    <span>Scroll Back to Overview</span>
                </button>

                <a href="#article-booking-section" onclick="event.preventDefault(); scrollBackToIntro();" style="font-size: 13px; color: #6b7280; text-decoration: none;">
                    &uarr; Back to Booking &amp; Intro
                </a>
            </div>
        </div>
    </div>
</section>

<style>
.saimaSummernoteAfterProjects img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 18px 0;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
}
.saimaSummernoteAfterProjects h2, 
.saimaSummernoteAfterProjects h3, 
.saimaSummernoteAfterProjects h4 {
    color: #111827;
    font-weight: 700;
    margin: 28px 0 14px 0;
}
.saimaSummernoteAfterProjects p {
    margin: 0 0 16px 0;
}
</style>
@endif
