@extends('layouts.app')

@section('content')
    <!-- 1. Hero with Ken Burns zoom carousel and callback capture -->
    @include('partials.hero')

    <!-- 2. Project Highlights 6 Badges -->
    @include('partials.highlights')

    <!-- 3. Featured 10 Communities Showcase -->
    @include('partials.communities')

    <!-- 4. 2-Column Main Article with Table of Contents, Floor Plans, Milestone Financing & Sticky Appointment Sidebar -->
    @include('partials.article')

    <!-- 5. 8 Interactive Real Estate FAQs -->
    @include('partials.faq')

    <!-- 6. Latest News & Articles (Blogs) -->
    @include('partials.home-blogs')

    <!-- 7. Let's Connect / Callback Request Section -->
    @include('partials.contact')
@endsection