@extends('layouts.app')

@section('content')

@php
    $sections = collect();
    try {
        if (\Illuminate\Support\Facades\Schema::hasTable('pages')) {
            $homePage = \App\Models\Page::where('slug', '/')->first();
            if ($homePage && \Illuminate\Support\Facades\Schema::hasTable('page_sections')) {
                $sections = $homePage->sections()->where('is_active', true)->orderBy('order')->get();
            }
        }
    } catch (\Throwable $e) {
        $sections = collect();
    }
@endphp

@if($sections->isNotEmpty())
    @foreach($sections as $sec)
        @switch($sec->section_key)
            @case('hero')
                @include('partials.hero')
                @break
            @case('highlights')
                @include('partials.highlights')
                @break
            @case('communities')
                @include('partials.communities')
                @break
            @case('overview')
            @case('content')
                @include('partials.island-overview')
                @break
            @case('investment')
                @include('partials.investment-potential')
                @break
            @case('overview_location')
                @include('partials.overview-location')
                @break
            @case('faq')
                @include('partials.faq')
                @include('partials.home-blogs')
                @break
            @case('contact')
                @include('partials.contact')
                @break
        @endswitch
    @endforeach
@else
    <!-- Fallback if database sections not configured -->
    @include('partials.hero')
    @include('partials.highlights')
    @include('partials.communities')
    @include('partials.island-overview')
    @include('partials.investment-potential')
    @include('partials.overview-location')
    @include('partials.faq')
    @include('partials.home-blogs')
    @include('partials.contact')
@endif
@endsection