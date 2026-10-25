@extends('layouts.app')

@section('content')
@php
    $heroBadge = page_section('hero', 'badge', 'LEGAL & TRANSPARENCY', 'privacy-policy');
    $heroTitle = page_section('hero', 'title', 'Privacy Policy', 'privacy-policy');
    $heroSubtitle = page_section('hero', 'subtitle', 'Understand how we collect, use, and protect your personal information when you explore Hudayriyat Island properties.', 'privacy-policy');
    $policyItems = page_section('policy_content', 'items', [], 'privacy-policy');
@endphp
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
                @foreach($policyItems as $index => $item)
                    <div class="privacyBlock legalBlock">
                        <div class="privacyBlockHeader legalBlockHeader">
                            <div class="privacyBlockNumber legalBlockNumber">{{ $index + 1 }}</div>
                            <h2 class="privacyBlockTitle legalBlockTitle">{{ $item['title'] ?? '' }}</h2>
                        </div>
                        <p class="privacyBlockText legalBlockText">
                            {!! nl2br(e($item['description'] ?? '')) !!}
                        </p>
                    </div>
                @endforeach

                <!-- Contact & Queries Block -->
                <div class="privacyContactBlock legalContactBlock">
                    <div class="privacyBlockHeader legalBlockHeader">
                        <div class="privacyBlockNumber legalBlockNumber">{{ count($policyItems) + 1 }}</div>
                        <h2 class="privacyBlockTitle legalBlockTitle">Contact &amp; Privacy Queries</h2>
                    </div>
                    <p class="privacyBlockText legalBlockText">
                        If you have questions, concerns, or requests regarding this Privacy Policy or how your personal information is handled, please contact our advisory desk directly.
                    </p>
                    <div class="privacyContactActionRow legalContactActionRow">
                        <a href="/contact-us" class="privacyContactBtn legalContactBtn">
                            <span>Go to Contact Page</span>
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="m9 18 6-6-6-6"/>
                            </svg>
                        </a>
                        <a href="mailto:info@hudayriyat-island.ae" class="privacyEmailLink legalEmailLink">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                            </svg>
                            <span>info@hudayriyat-island.ae</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection
