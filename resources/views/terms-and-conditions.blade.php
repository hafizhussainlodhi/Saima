@extends('layouts.app')

@section('content')
@php
    $heroBadge = page_section('hero', 'badge', 'LEGAL & COMPLIANCE', 'terms-and-conditions');
    $heroTitle = page_section('hero', 'title', 'Terms & Conditions', 'terms-and-conditions');
    $heroSubtitle = page_section('hero', 'subtitle', 'Please read our Terms & Conditions carefully to understand the rules, responsibilities, and guidelines for using our website.', 'terms-and-conditions');
    $termsContent = page_section('content', 'html', null, 'terms-and-conditions') ?: page_section('content', 'body', null, 'terms-and-conditions');
@endphp
<style>
.termsRichContent {
    background: #ffffff;
    border: 1px solid #ebe5dd;
    border-radius: 12px;
    padding: 38px 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    font-size: 16px;
    line-height: 1.8;
    color: #4b5563;
}
.termsRichContent h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 32px 0 12px 0;
    line-height: 1.35;
    padding-bottom: 6px;
    border-bottom: 1px solid #f1f5f9;
}
.termsRichContent h2:first-child {
    margin-top: 0;
}
.termsRichContent h3 {
    font-size: 19px;
    font-weight: 700;
    color: #1f2937;
    margin: 24px 0 10px 0;
}
.termsRichContent p {
    font-size: 16px;
    line-height: 1.8;
    color: #4b5563;
    margin-bottom: 16px;
}
.termsRichContent p:last-child {
    margin-bottom: 0;
}
.termsRichContent ul {
    list-style-type: disc !important;
    list-style-position: outside !important;
    margin: 14px 0 18px 0 !important;
    padding-left: 28px !important;
}
.termsRichContent ol {
    list-style-type: decimal !important;
    list-style-position: outside !important;
    margin: 14px 0 18px 0 !important;
    padding-left: 28px !important;
}
.termsRichContent li {
    display: list-item !important;
    margin-bottom: 8px !important;
    line-height: 1.75 !important;
    color: #374151 !important;
}
@media (max-width: 768px) {
    .termsRichContent {
        padding: 24px 20px;
    }
    .termsRichContent h2 {
        font-size: 19px;
    }
}
</style>
<main class="termsMainWrapper legalMainWrapper">
    <!-- Hero Header -->
    <section class="termsHeroSection legalHeroSection">
        <div class="container">
            <div class="termsHeroContent legalHeroContent">
                <span class="termsBadge legalBadge">{{ $heroBadge }}</span>
                <h1 class="termsHeroTitle legalHeroTitle">{{ $heroTitle }}</h1>
                <p class="termsHeroSubtitle legalHeroSubtitle">
                    {{ $heroSubtitle }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="termsSection legalSection">
        <div class="container">
            <div class="termsContainer legalContainer">
                <div class="termsRichContent">
                    {!! $termsContent !!}
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
