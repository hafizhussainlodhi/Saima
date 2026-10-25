@extends('layouts.app')

@section('content')
@php
    $heroBadge = page_section('hero', 'badge', 'LEGAL & COMPLIANCE', 'terms-and-conditions');
    $heroTitle = page_section('hero', 'title', 'Terms & Conditions', 'terms-and-conditions');
    $heroSubtitle = page_section('hero', 'subtitle', 'Please read our Terms & Conditions carefully to understand the rules, responsibilities, and guidelines for using our website.', 'terms-and-conditions');
    $termsItems = page_section('terms_content', 'items', [], 'terms-and-conditions');
@endphp
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
                @foreach($termsItems as $index => $item)
                    <div class="termBlock legalBlock">
                        <div class="termsBlockHeader legalBlockHeader">
                            <div class="termsBlockNumber legalBlockNumber">{{ $index + 1 }}</div>
                            <h2 class="termsBlockTitle legalBlockTitle">{{ $item['title'] ?? '' }}</h2>
                        </div>
                        <p class="termsBlockText legalBlockText">
                            {!! nl2br(e($item['description'] ?? '')) !!}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection
