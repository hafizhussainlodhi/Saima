@extends('layouts.app')

@section('content')
@php
    $heroBadge = page_section('hero', 'badge', 'LEGAL & TRANSPARENCY', 'privacy-policy');
    $heroTitle = page_section('hero', 'title', 'Privacy Policy', 'privacy-policy');
    $heroSubtitle = page_section('hero', 'subtitle', 'Understand how we collect, use, and protect your personal information when you explore Hudayriyat Island properties.', 'privacy-policy');
    $policyContent = page_section('content', 'html', null, 'privacy-policy') ?: page_section('content', 'body', null, 'privacy-policy');
@endphp
<style>
.privacyPolicyRichContent {
    background: #ffffff;
    border: 1px solid #ebe5dd;
    border-radius: 12px;
    padding: 38px 40px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    font-size: 16px;
    line-height: 1.8;
    color: #4b5563;
}
.privacyPolicyRichContent h2 {
    font-size: 22px;
    font-weight: 700;
    color: #1a1a1a;
    margin: 32px 0 12px 0;
    line-height: 1.35;
    padding-bottom: 6px;
    border-bottom: 1px solid #f1f5f9;
}
.privacyPolicyRichContent h2:first-child {
    margin-top: 0;
}
.privacyPolicyRichContent h3 {
    font-size: 19px;
    font-weight: 700;
    color: #1f2937;
    margin: 24px 0 10px 0;
}
.privacyPolicyRichContent p {
    font-size: 16px;
    line-height: 1.8;
    color: #4b5563;
    margin-bottom: 16px;
}
.privacyPolicyRichContent p:last-child {
    margin-bottom: 0;
}
.privacyPolicyRichContent ul {
    list-style-type: disc !important;
    list-style-position: outside !important;
    margin: 14px 0 18px 0 !important;
    padding-left: 28px !important;
}
.privacyPolicyRichContent ol {
    list-style-type: decimal !important;
    list-style-position: outside !important;
    margin: 14px 0 18px 0 !important;
    padding-left: 28px !important;
}
.privacyPolicyRichContent li {
    display: list-item !important;
    margin-bottom: 8px !important;
    line-height: 1.75 !important;
    color: #374151 !important;
}
@media (max-width: 768px) {
    .privacyPolicyRichContent {
        padding: 24px 20px;
    }
    .privacyPolicyRichContent h2 {
        font-size: 19px;
    }
}
</style>
<main class="privacyMainWrapper legalMainWrapper">
    <!-- Hero Header -->
    <section class="privacyHeroSection legalHeroSection">
        <div class="container">
            <div class="privacyHeroContent legalHeroContent">
                <span class="privacyBadge legalBadge">{{ $heroBadge }}</span>
                <h1 class="privacyHeroTitle legalHeroTitle">{{ $heroTitle }}</h1>
                <p class="privacyHeroSubtitle legalHeroSubtitle">
                    {{ $heroSubtitle }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Policy Content Section -->
    <section class="privacySection legalSection">
        <div class="container">
            <div class="privacyContainer legalContainer">
                <div class="privacyPolicyRichContent">
                    {!! $policyContent !!}
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
