@extends('layouts.app')

@section('content')
@php
    $heroBadge = page_section('hero', 'badge', 'LEGAL & DISCLOSURE', 'disclaimer');
    $heroTitle = page_section('hero', 'title', 'Disclaimer', 'disclaimer');
    $heroSubtitle = page_section('hero', 'subtitle', 'Please read our disclaimer carefully to understand the terms, limitations, and accuracy of property information and details shared on our website.', 'disclaimer');
    $disclaimerItems = page_section('disclaimer_content', 'items', [], 'disclaimer');
@endphp
<main class="disclaimerMainWrapper legalMainWrapper">
    <!-- Hero Header -->
    <section class="disclaimerHeroSection legalHeroSection">
        <div class="container">
            <div class="disclaimerHeroContent legalHeroContent">
                <span class="disclaimerBadge legalBadge">{{ $heroBadge }}</span>
                <h1 class="disclaimerHeroTitle legalHeroTitle">{{ $heroTitle }}</h1>
                <p class="disclaimerHeroSubtitle legalHeroSubtitle">
                    {{ $heroSubtitle }}
                </p>
            </div>
        </div>
    </section>

    <!-- Main Content Section -->
    <section class="disclaimerSection legalSection">
        <div class="container">
            <div class="disclaimerContainer legalContainer">
                @foreach($disclaimerItems as $index => $item)
                    <div class="disclaimerBlock legalBlock">
                        <div class="disclaimerBlockHeader legalBlockHeader">
                            <div class="disclaimerBlockNumber legalBlockNumber">{{ $index + 1 }}</div>
                            <h2 class="disclaimerBlockTitle legalBlockTitle">{{ $item['title'] ?? '' }}</h2>
                        </div>
                        <p class="disclaimerBlockText legalBlockText">
                            {!! nl2br(e($item['description'] ?? '')) !!}
                        </p>
                        @if($loop->last)
                            <div class="disclaimerSubNotice legalSubNotice">
                                See also our <a href="/terms-and-conditions">Terms &amp; Conditions</a> for further information regarding the use of this website and limitations of liability.
                            </div>
                            <div class="disclaimerActionRow legalActionRow">
                                <a href="/contact-us" class="disclaimerContactBtn legalContactBtn">
                                    <span>Contact Our Advisors</span>
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6"/>
                                    </svg>
                                </a>
                                <a href="/privacy-policy" class="disclaimerSecondaryLink legalSecondaryLink">
                                    Read our Privacy Policy &rarr;
                                </a>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
