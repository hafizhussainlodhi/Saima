@extends('admin.layouts.app')

@section('title', 'Manage ' . $page->title)

@push('styles')
<style>
    /* Hide old bulky topbar on edit page */
    .adm-topbar { display: none !important; }

    /* Screenshot 2 Clean Edit Layout Container */
    .adm-edit-layout {
        display: flex;
        align-items: flex-start;
        gap: 32px;
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #f1f5f9;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        padding: 28px 32px 36px;
    }

    /* Left Sidebar Tabs (Screenshot 2 Clean Vertical Style) */
    .adm-edit-layout > #pageSectionTabs {
        flex: 0 0 240px !important;
        width: 240px !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 4px !important;
        margin: 0 !important;
        position: sticky !important;
        top: 20px !important;
        height: auto !important;
        max-height: calc(100vh - 140px) !important;
        overflow-y: auto !important;
    }

    .adm-edit-layout > #pageSectionTabs .adm-tab {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        border-radius: 10px !important;
        padding: 12px 16px !important;
        font-size: 14px !important;
        font-weight: 500 !important;
        color: #475569 !important;
        display: flex !important;
        align-items: center !important;
        gap: 12px !important;
        width: 100% !important;
        text-align: left !important;
        cursor: pointer !important;
        transition: all 0.18s ease !important;
        position: relative !important;
    }

    .adm-edit-layout > #pageSectionTabs .adm-tab svg {
        width: 17px !important;
        height: 17px !important;
        stroke: #94a3b8 !important;
        flex-shrink: 0 !important;
        transition: stroke 0.18s ease !important;
    }

    .adm-edit-layout > #pageSectionTabs .adm-tab:hover {
        background: #f8fafc !important;
        color: #1e293b !important;
        transform: none !important;
    }

    .adm-edit-layout > #pageSectionTabs .adm-tab:hover svg {
        stroke: #64748b !important;
    }

    /* Active Tab (Screenshot 2 Style: soft light blue / cyan pill with right indicator arrow) */
    .adm-edit-layout > #pageSectionTabs .adm-tab.is-active {
        background: #f0f9ff !important;
        color: #0284c7 !important;
        font-weight: 600 !important;
        box-shadow: none !important;
        border-radius: 10px !important;
    }

    .adm-edit-layout > #pageSectionTabs .adm-tab.is-active svg {
        stroke: #0284c7 !important;
    }

    .adm-edit-layout > #pageSectionTabs .adm-tab.is-active::after {
        content: '';
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 6px;
        height: 6px;
        border-top: 2px solid #0284c7;
        border-right: 2px solid #0284c7;
        transform: translateY(-50%) rotate(45deg);
    }

    .adm-tab-drag-handle {
        display: none !important;
    }

    .adm-tab-draggable {
        cursor: pointer !important;
    }

    /* Right Form Area */
    .adm-edit-layout > #pageEditForm {
        flex: 1 1 0 !important;
        min-width: 0 !important;
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 0 20px 0 !important;
        height: auto !important;
        max-height: calc(100vh - 140px) !important;
        overflow-y: auto !important;
    }

    /* Simplified Content Cards */
    .adm-edit-layout .adm-card {
        background: transparent !important;
        border: none !important;
        box-shadow: none !important;
        padding: 0 !important;
    }

    .adm-edit-layout .adm-card-head {
        background: transparent !important;
        border-bottom: 1px solid #f1f5f9 !important;
        padding: 0 0 16px 0 !important;
        margin-bottom: 24px !important;
    }

    .adm-edit-layout .adm-card-head h2 {
        font-size: 17px !important;
        font-weight: 700 !important;
        color: #1e293b !important;
        margin: 0 0 4px 0 !important;
    }

    .adm-edit-layout .adm-card-head p {
        font-size: 13px !important;
        color: #8c9ba5 !important;
        margin: 0 !important;
    }

    .adm-edit-layout .adm-card-body {
        padding: 0 !important;
    }

    /* Clean Input Fields matching Screenshot 2 */
    .adm-edit-layout .adm-input,
    .adm-edit-layout .adm-textarea,
    .adm-edit-layout .adm-select {
        background: #f8fafc !important;
        border: 1px solid #f1f5f9 !important;
        border-radius: 8px !important;
        padding: 10px 14px !important;
        font-size: 14px !important;
        color: #1e293b !important;
        transition: all 0.2s ease !important;
        box-shadow: none !important;
    }

    .adm-edit-layout .adm-input:focus,
    .adm-edit-layout .adm-textarea:focus,
    .adm-edit-layout .adm-select:focus {
        background: #ffffff !important;
        border-color: #0284c7 !important;
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1) !important;
    }

    .adm-edit-layout .adm-label {
        font-size: 13.5px !important;
        font-weight: 500 !important;
        color: #334155 !important;
        margin-bottom: 6px !important;
    }

    .adm-edit-layout .adm-help {
        font-size: 12px !important;
        color: #94a3b8 !important;
        margin-top: 4px !important;
    }

    /* Save Changes Button Bar */
    .adm-edit-layout .adm-sticky-save {
        background: #f8fafc !important;
        border: 1px solid #f1f5f9 !important;
        border-radius: 12px !important;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04) !important;
        padding: 14px 20px !important;
        margin-top: 24px !important;
    }

    .adm-edit-layout .adm-btn-primary {
        background: #1a4731 !important;
        border-radius: 8px !important;
        padding: 10px 24px !important;
        font-weight: 600 !important;
        font-size: 13.5px !important;
        box-shadow: 0 2px 6px rgba(26, 71, 49, 0.2) !important;
    }
</style>
@endpush

@section('content')
<!-- Screenshot 2 Pattern: Breadcrumbs & Page Heading -->
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:14px;">
    <div>
        <h1 style="font-size:20px; font-weight:700; color:#1e293b; margin:0 0 4px 0; font-family:var(--font-display, 'Outfit', sans-serif); letter-spacing:-0.01em;">
            Manage {{ $page->title }}
        </h1>
        <div style="font-size:13px; color:#8c9ba5; font-weight:400;">
            Home &ndash; Pages &ndash; Manage {{ $page->title }}
        </div>
    </div>
    <div style="display:flex; gap:10px; align-items:center;">
        <a href="{{ route('admin.pages.index') }}" class="adm-btn" style="background:#ffffff; border:1px solid #e2e8f0; color:#475569; font-size:13px; font-weight:600; padding:8px 16px; border-radius:8px; display:inline-flex; align-items:center; gap:6px; text-decoration:none;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
            Back to Pages
        </a>
        <a href="{{ url($page->slug === '/' ? '' : $page->slug) }}" target="_blank" rel="noopener" class="adm-btn" style="background:#ffffff; border:1px solid #e2e8f0; color:#475569; font-size:13px; font-weight:600; padding:8px 16px; border-radius:8px; display:inline-flex; align-items:center; gap:6px; text-decoration:none;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
            View Live Page
        </a>
    </div>
</div>

<!-- Screenshot 2 Pattern: Page URL Card Banner -->
<div style="background:#ffffff; border-radius:14px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.03); padding:14px 20px; margin-bottom:22px; display:flex; align-items:center; gap:12px; font-size:14px;">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
    </svg>
    <span style="font-weight:600; color:#475569;">Page URL:</span>
    <a href="{{ url($page->slug === '/' ? '' : $page->slug) }}" target="_blank" rel="noopener" style="color:#0284c7; text-decoration:none; font-weight:500; word-break:break-all;">
        {{ url($page->slug === '/' ? '' : $page->slug) }}
    </a>
</div>

@php
    $currentTab = request('tab', 'general');
    $allSections = $page->sections->sortBy('order');
    $heroSection = $page->section('hero');
    $otherSections = $allSections->reject(fn($s) => $s->section_key === 'hero');
@endphp

<div class="adm-edit-layout">
<!-- Navigation Tabs for Page Sections (Draggable Reorderable) -->
<div class="adm-tabs" id="pageSectionTabs" role="tablist">
    <button type="button" class="adm-tab {{ $currentTab === 'general' ? 'is-active' : '' }}" onclick="switchTab('general')" data-tab-id="general">
        @include('admin.partials.icon', ['name' => 'grid'])
        <span>General Settings</span>
    </button>

    <div class="adm-draggable-tabs-group" id="draggableTabsContainer">
        @foreach($allSections as $sec)
            @php
                $iconName = match($sec->section_key) {
                    'hero'              => 'spark',
                    'highlights'        => 'trend',
                    'communities'       => 'grid',
                    'overview', 'content' => 'edit',
                    'investment'        => 'shield',
                    'overview_location' => 'globe',
                    'payment_methods'   => 'lock',
                    'floor_plans'       => 'grid',
                    'payment_plan'      => 'trend',
                    'gallery'           => 'spark',
                    'master_plan'       => 'globe',
                    'location'          => 'globe',
                    'about'             => 'book',
                    'amenities'         => 'spark',
                    'faq'               => 'list',
                    'contact'           => 'mail',
                    default             => 'edit'
                };
            @endphp
            <button type="button"
                    class="adm-tab adm-tab-draggable {{ $currentTab === $sec->section_key ? 'is-active' : '' }}"
                    onclick="handleTabClick(event, '{{ $sec->section_key }}')"
                    data-tab-id="{{ $sec->section_key }}"
                    data-section-key="{{ $sec->section_key }}"
                    draggable="true"
                    title="Drag to reorder this section on the page">
                <span class="adm-tab-drag-handle" title="Drag to reorder">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                </span>
                @include('admin.partials.icon', ['name' => $iconName])
                <span>{{ $sec->section_name }}</span>
            </button>
        @endforeach
    </div>

    <button type="button" class="adm-tab {{ $currentTab === 'seo' ? 'is-active' : '' }}" onclick="switchTab('seo')" data-tab-id="seo">
        @include('admin.partials.icon', ['name' => 'search'])
        <span>SEO &amp; Meta</span>
    </button>

    <span id="tabReorderToast" class="adm-tab-toast" style="display:none;">
        ✓ Section order updated
    </span>
</div>

<!-- Main Edit Form -->
<form method="POST" action="{{ route('admin.pages.update', $page) }}" id="pageEditForm" enctype="multipart/form-data" novalidate>
    @csrf
    @method('PUT')
    <input type="hidden" name="active_tab" id="activeTabInput" value="{{ $currentTab }}">
    <div id="sectionOrderInputs">
        @foreach($allSections as $sec)
            <input type="hidden" name="section_order[]" value="{{ $sec->section_key }}" id="so_{{ $sec->section_key }}">
        @endforeach
    </div>

    <!-- 1. GENERAL TAB -->
    <div id="tab-general" class="tab-pane {{ $currentTab === 'general' ? 'active' : '' }}">
        <div class="adm-card">
            <div class="adm-card-head">
                <div>
                    <h2>General Configuration</h2>
                    <p>Configure page title, URL routing slug, navbar visibility, and publish state.</p>
                </div>
            </div>
            <div class="adm-card-body">
                <div class="adm-form-row">
                    <div class="adm-field">
                        <label class="adm-label" for="pageTitle">Page Title</label>
                        <input type="text" id="pageTitle" name="title" value="{{ old('title', $page->title) }}" required class="adm-input">
                        <div class="adm-help">Display name used throughout the admin and browser titles.</div>
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="pageSlug">Route Slug</label>
                        <input type="text" id="pageSlug" name="slug" value="{{ old('slug', $page->slug) }}" required class="adm-input">
                        <div class="adm-help">URL path (e.g. <code>/</code> for homepage, <code>about-us</code>, <code>wadeem-gardens</code>).</div>
                    </div>
                </div>

                <div class="adm-form-row">
                    <div class="adm-field">
                        <label class="adm-label" for="navbarOrder">Navbar Order Position</label>
                        <input type="number" id="navbarOrder" name="navbar_order" value="{{ old('navbar_order', $page->navbar_order) }}" class="adm-input" min="0">
                        <div class="adm-help">Sorting sequence when displayed in menus (lower numbers first).</div>
                    </div>

                    <div class="adm-field" style="display:flex; flex-direction:column; justify-content:center; gap:12px; margin-top:10px;">
                        <label class="adm-check">
                            <input type="checkbox" name="in_navbar" value="1" {{ old('in_navbar', $page->in_navbar) ? 'checked' : '' }}>
                            <strong>Show in Navigation Menu</strong>
                        </label>
                        <label class="adm-check">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $page->is_published) ? 'checked' : '' }}>
                            <strong>Published (Publicly accessible)</strong>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. HERO SECTION TAB -->
    @if($heroSection)
        @php $hContent = $heroSection->content ?? []; @endphp
        <div id="tab-hero" class="tab-pane {{ $currentTab === 'hero' ? 'active' : '' }}">
            <div class="adm-card">
                <div class="adm-card-head">
                    <div>
                        <h2>Hero Banner Content</h2>
                        <p>Manage the large header visual, main heading, badge, and callback card.</p>
                    </div>
                    <span class="adm-chip">hero section</span>
                </div>
                <div class="adm-card-body">
                    <div class="adm-field">
                        <label class="adm-label">Hero Background Image (Change Photo / Upload)</label>
                        @php
                            $heroBgImg = $hContent['bg_image'] ?? '/images/hero/slide-1.jpg';
                            if ($heroBgImg && !str_starts_with($heroBgImg, 'http') && !str_starts_with($heroBgImg, '/')) {
                                $heroBgImg = asset($heroBgImg);
                            }
                        @endphp
                        <div class="adm-img-box">
                            <img src="{{ $heroBgImg }}" class="adm-img-thumb-lg" alt="{{ $hContent['bg_image_alt'] ?? ($hContent['image_alt'] ?? 'Hero Background Preview') }}">
                            <div class="adm-img-controls">
                                <div class="adm-file-row">
                                    <input type="file" name="section_files[hero][bg_image]" accept="image/*" class="adm-file-input" onchange="previewItemImage(this)">
                                </div>
                                <input type="text" name="sections[hero][bg_image]" value="{{ $hContent['bg_image'] ?? '/images/hero/slide-1.jpg' }}" class="adm-input" placeholder="Or enter image path / URL (e.g. /images/hero/slide-1.jpg)">
                                <div class="adm-help">Upload a new hero background photo from your computer or specify a file path / URL.</div>
                            </div>
                        </div>
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="heroBgImageAlt">Hero Image Alt Text (SEO)</label>
                        <input type="text" id="heroBgImageAlt" name="sections[hero][bg_image_alt]" value="{{ $hContent['bg_image_alt'] ?? ($hContent['image_alt'] ?? '') }}" class="adm-input" placeholder="e.g. Hudayriyat Island Waterfront Sanctuary">
                        <div class="adm-help">Descriptive alternative text rendered inside the hero &lt;img alt="..."&gt; tag for search engine optimization (SEO) and accessibility.</div>
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="heroBadge">Badge / Pretitle</label>
                        <input type="text" id="heroBadge" name="sections[hero][badge]" value="{{ $hContent['badge'] ?? '' }}" class="adm-input" placeholder="e.g. Freehold for All Nationalities">
                    </div>

                    <div class="adm-form-row">
                        <div class="adm-field">
                            <label class="adm-label" for="heroTitle">Main Heading (H1)</label>
                            <textarea id="heroTitle" name="sections[hero][title]" class="adm-textarea" rows="2" placeholder="Hudayriyat&#10;Island" oninput="syncHeroTitleToAlt(this.value)">{{ $hContent['title'] ?? '' }}</textarea>
                            <div class="adm-help">Line breaks render as visual breaks on the frontend.</div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="heroSubtitle">Subtitle / Tagline</label>
                            <textarea id="heroSubtitle" name="sections[hero][subtitle]" class="adm-textarea" rows="2" placeholder="Abu Dhabi’s Most Exclusive Coastal Lifestyle Destination">{{ $hContent['subtitle'] ?? '' }}</textarea>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    @endif

    <!-- 3. OTHER SECTION TABS -->
    @foreach($otherSections as $sec)
        @php $sContent = $sec->content ?? []; @endphp

        @if($sec->section_key === 'highlights')
            <!-- PROJECT HIGHLIGHTS TAB (DRAG & DROP REORDERABLE) -->
            <div id="tab-highlights" class="tab-pane {{ $currentTab === 'highlights' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Project Highlights</h2>
                            <p>Configure and reorder the key highlight cards. Drag any card up or down with the ⇅ handle.</p>
                        </div>
                        <span class="adm-chip">highlights</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[highlights][_has_items]" value="1">
                        @php
                            $hlItems = $sContent['items'] ?? [
                                ['key' => 'developer', 'label' => 'Developer', 'value' => $sContent['developer'] ?? 'Modon Properties'],
                                ['key' => 'price', 'label' => 'Price', 'value' => $sContent['price'] ?? ($sContent['launch_price'] ?? 'AED 4,300,000*')],
                                ['key' => 'handover', 'label' => 'Handover Date', 'value' => $sContent['handover'] ?? 'Q3 2030'],
                                ['key' => 'property_type', 'label' => 'Property Type', 'value' => $sContent['property_type'] ?? 'Villas & Apartments'],
                                ['key' => 'ownership', 'label' => 'Ownership', 'value' => $sContent['ownership'] ?? 'Freehold'],
                            ];

                            $metricPresets = [
                                ['label' => 'Developer', 'key' => 'developer', 'icon' => 'building', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9v.01"/><path d="M9 12v.01"/><path d="M9 15v.01"/><path d="M9 18v.01"/></svg>'],
                                ['label' => 'Price', 'key' => 'price', 'icon' => 'price', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>'],
                                ['label' => 'Price From', 'key' => 'price', 'icon' => 'price', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>'],
                                ['label' => 'Handover Date', 'key' => 'handover', 'icon' => 'date', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>'],
                                ['label' => 'Property Type', 'key' => 'property_type', 'icon' => 'property_type', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>'],
                                ['label' => 'Ownership', 'key' => 'ownership', 'icon' => 'shield', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                                ['label' => 'Bedrooms', 'key' => 'bedrooms', 'icon' => 'bed', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>'],
                                ['label' => 'Location', 'key' => 'location', 'icon' => 'map-pin', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>'],
                                ['label' => 'Plot Size', 'key' => 'plot_size', 'icon' => 'plot_size', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>'],
                                ['label' => 'Down Payment', 'key' => 'down_payment', 'icon' => 'down_payment', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>'],
                                ['label' => 'Featured Highlight', 'key' => 'featured', 'icon' => 'star', 'svg' => '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>'],
                            ];
                        @endphp

                        <div class="adm-repeater-wrap">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Highlight Cards (<span id="repeaterCount_highlights">{{ count($hlItems) }}</span>)</h3>
                                    <p>Drag any highlight up or down using the ⇅ handle to change the order.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addHighlightItem()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Highlight Item
                                </button>
                            </div>

                            <div class="adm-repeater-toolbar">
                                <div class="adm-collapse-links">
                                    <button type="button" class="adm-link-btn" onclick="toggleCollapseAll(this, 'repeater_highlights_items')">Collapse all</button>
                                    <span>|</span>
                                    <button type="button" class="adm-link-btn" onclick="toggleExpandAll(this, 'repeater_highlights_items')">Expand all</button>
                                </div>
                            </div>

                            <div class="adm-repeater-list" id="repeater_highlights_items">
                                @foreach($hlItems as $idx => $hl)
                                    <div class="adm-repeater-item" id="hl_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $hl['label'] ?? ('Highlight ' . ($idx + 1)) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'highlights')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <input type="hidden" name="sections[highlights][items][{{ $idx }}][key]" value="{{ $hl['key'] ?? ('highlight_' . $idx) }}">
                                            <input type="hidden" class="adm-hl-icon-input" name="sections[highlights][items][{{ $idx }}][icon]" value="{{ $hl['icon'] ?? '' }}">
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field">
                                                    <label class="adm-label">Highlight Label / Metric Name</label>
                                                    @php
                                                        $curLabel = $hl['label'] ?? '';
                                                        $matchedSvg = $metricPresets[0]['svg'];
                                                        $lowLabel = strtolower(trim($curLabel));
                                                        foreach ($metricPresets as $p) {
                                                            $pLow = strtolower($p['label']);
                                                            if ($lowLabel !== '' && (str_contains($lowLabel, $pLow) || str_contains($pLow, $lowLabel))) {
                                                                $matchedSvg = $p['svg'];
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <div class="adm-metric-input-wrap">
                                                        <div class="adm-metric-input-group">
                                                            <span class="adm-metric-prefix-icon" title="Metric Icon">
                                                                {!! $matchedSvg !!}
                                                            </span>
                                                            <input type="text" name="sections[highlights][items][{{ $idx }}][label]" value="{{ $curLabel }}" class="adm-input adm-metric-input" oninput="onMetricInputChange(this)" placeholder="e.g. Developer, Price, Handover...">
                                                            <button type="button" class="adm-metric-dropdown-btn" onclick="toggleMetricDropdown(this)" title="Choose Metric Name">
                                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                                    <polyline points="6 9 12 15 18 9"></polyline>
                                                                </svg>
                                                            </button>
                                                        </div>
                                                        <div class="adm-metric-menu">
                                                            <div class="adm-metric-menu-header">Select Predefined Metric</div>
                                                            @foreach($metricPresets as $preset)
                                                                <div class="adm-metric-menu-item" onclick="selectMetricOption(this, '{{ $preset['label'] }}', '{{ $preset['key'] }}', '{{ $preset['icon'] }}')">
                                                                    <span class="adm-metric-menu-item-icon">{!! $preset['svg'] !!}</span>
                                                                    <span class="adm-metric-menu-item-label">{{ $preset['label'] }}</span>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="adm-field">
                                                    <label class="adm-label">Highlight Value / Content</label>
                                                    <input type="text" name="sections[highlights][items][{{ $idx }}][value]" value="{{ $hl['value'] ?? '' }}" class="adm-input" placeholder="e.g. Modon Properties" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addHighlightItem()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Highlight
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'communities')
            <!-- COMMUNITIES SHOWCASE TAB -->
            <div id="tab-communities" class="tab-pane {{ $currentTab === 'communities' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Featured Projects (Communities Showcase)</h2>
                            <p>Configure the section heading for property cards displayed on the home page.</p>
                        </div>
                        <span class="adm-chip">communities</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label" for="sec_communities_heading">
                                <span>Section Title</span>
                                <span class="adm-chip">heading</span>
                            </label>
                            <input type="text" id="sec_communities_heading" name="sections[communities][heading]" value="{{ $sContent['heading'] ?? 'Projects' }}" class="adm-input">
                        </div>

                        <!-- Dedicated Property Cards Manager Notification -->
                        <div style="background: linear-gradient(135deg, #f0f7ff 0%, #f7fbfd 100%); border: 1.5px solid #bfdbfe; border-radius: 12px; padding: 24px; margin-top: 20px; display: flex; align-items: flex-start; gap: 18px; box-shadow: 0 2px 8px rgba(37,99,235,0.06);">
                            <div style="width: 46px; height: 46px; border-radius: 10px; background: #2563eb; color: #fff; display: flex; align-items: center; justify-content: center; flex-shrink: 0; box-shadow: 0 4px 12px rgba(37,99,235,0.3);">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="3" y1="9" x2="21" y2="9"/>
                                    <line x1="9" y1="21" x2="9" y2="9"/>
                                </svg>
                            </div>
                            <div style="flex: 1;">
                                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 6px;">
                                    <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: #1e3a8a;">
                                        Centralized Property Cards Manager
                                    </h3>
                                    <span style="background: #dbeafe; color: #1d4ed8; font-size: 11px; font-weight: 700; padding: 2px 8px; border-radius: 20px;">
                                        Dedicated Module
                                    </span>
                                </div>
                                <p style="margin: 0 0 16px 0; font-size: 13px; color: #334155; line-height: 1.55;">
                                    Featured property cards are now centrally managed in the dedicated <strong>Projects</strong> module. You can add new property cards, update prices, delivery dates, developer badges, upload card images, and attach cards directly to any detail page using dynamic dropdowns.
                                </p>
                                <div style="display: flex; align-items: center; gap: 12px; flex-wrap: wrap;">
                                    <a href="{{ route('admin.projects.index') }}" class="adm-btn adm-btn-primary" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; padding: 10px 20px; font-weight: 600; font-size: 13px; border-radius: 8px; box-shadow: 0 3px 10px rgba(37,99,235,0.25);">
                                        <span>Open Property Cards Manager</span>
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                            <polyline points="12 5 19 12 12 19"></polyline>
                                        </svg>
                                    </a>
                                    <span style="font-size: 12px; color: #64748b;">All updates made in Projects reflect immediately on the Home page.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        @elseif($sec->section_key === 'content' || $sec->section_key === 'overview')
            <!-- CONTENT TAB (SINGLE UNIFIED SUMMERNOTE WYSIWYG) -->
            <div id="tab-{{ $sec->section_key }}" class="tab-pane {{ (in_array($currentTab, ['content', 'overview']) && ($currentTab === $sec->section_key || $currentTab === 'content' || $currentTab === 'overview')) ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>{{ $sec->section_name ?: 'Content' }} Editor</h2>
                            <p>Single visual WYSIWYG editor containing complete page article, H1/H2/H3 headings, paragraphs, and embedded photos.</p>
                        </div>
                        <span class="adm-chip">content section</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label" for="content_wysiwyg_{{ $sec->id }}">Page Content (Headings, Paragraphs, Images)</label>
                            <textarea id="content_wysiwyg_{{ $sec->id }}"
                                      name="sections[{{ $sec->section_key }}][html]"
                                      class="adm-textarea adm-summernote"
                                      data-height="650"
                                      rows="30">{{ old('sections.' . $sec->section_key . '.html', $sContent['html'] ?? '') }}</textarea>
                            <div class="adm-help">All headings (H1, H2, H3), descriptive paragraphs, image diagrams, and lists for this page are editable here in this single editor. Headings can be selected and modified from the style dropdown above. Changes save directly to the live website.</div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'investment')
            <!-- INVESTMENT & FINANCING TAB (FULL CRUD & DRAG & DROP) -->
            <div id="tab-investment" class="tab-pane {{ $currentTab === 'investment' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Investment Potential &amp; Flexible Financing</h2>
                            <p>Configure investment highlights, key metrics, descriptions, CTA buttons, and flexible financing card options.</p>
                        </div>
                        <span class="adm-chip">investment</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[investment][_has_investment_highlights]" value="1">
                        <input type="hidden" name="sections[investment][_has_financing_highlights]" value="1">

                        <!-- Left Column: Investment Potential Fields -->
                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="sec_inv_heading">Main Heading</label>
                                <input type="text" id="sec_inv_heading" name="sections[investment][heading]" value="{{ $sContent['heading'] ?? 'Investment Potential' }}" class="adm-input" required>
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="sec_inv_badge">Location Badge</label>
                                <input type="text" id="sec_inv_badge" name="sections[investment][location_badge]" value="{{ $sContent['location_badge'] ?? 'Hudayriyat Island, Abu Dhabi' }}" class="adm-input">
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="sec_inv_desc">Description</label>
                            <textarea id="sec_inv_desc" name="sections[investment][description]" class="adm-textarea adm-summernote" rows="3">{{ $sContent['description'] ?? '' }}</textarea>
                        </div>

                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="sec_inv_hl_heading">Highlights Subheading</label>
                                <input type="text" id="sec_inv_hl_heading" name="sections[investment][highlights_heading]" value="{{ $sContent['highlights_heading'] ?? 'Key Investment Highlights:' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="sec_inv_cta">Left Column CTA Button</label>
                                <input type="text" id="sec_inv_cta" name="sections[investment][cta]" value="{{ $sContent['cta'] ?? 'Contact a Property Investment Consultant' }}" class="adm-input">
                            </div>
                        </div>

                        <!-- 1. Key Investment Highlights Repeater (Drag & Drop) -->
                        <div class="adm-repeater-wrap" style="margin-bottom: 28px;">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Key Investment Highlights (<span id="repeaterCount_inv_hl">{{ count($sContent['investment_highlights'] ?? []) }}</span>)</h3>
                                    <p>Drag any highlight bullet using the ⇅ handle to change the order. Add, edit or delete bullet points.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addInvestmentHighlight()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Highlight Bullet
                                </button>
                            </div>

                            <div class="adm-repeater-toolbar">
                                <div class="adm-collapse-links">
                                    <button type="button" class="adm-link-btn" onclick="toggleCollapseAll(this, 'repeater_inv_hl_items')">Collapse all</button>
                                    <span>|</span>
                                    <button type="button" class="adm-link-btn" onclick="toggleExpandAll(this, 'repeater_inv_hl_items')">Expand all</button>
                                </div>
                            </div>

                            <div class="adm-repeater-list" id="repeater_inv_hl_items">
                                @foreach(($sContent['investment_highlights'] ?? []) as $idx => $hl)
                                    @php $hlText = is_array($hl) ? ($hl['text'] ?? $hl['title'] ?? '') : $hl; @endphp
                                    <div class="adm-repeater-item" id="inv_hl_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $hlText ?: 'Highlight ' . ($idx + 1) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'inv_hl')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">Bullet Point Text</label>
                                                <input type="text" name="sections[investment][investment_highlights][{{ $idx }}][text]" value="{{ $hlText }}" class="adm-input" oninput="updateCardHeading(this)">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addInvestmentHighlight()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Highlight Bullet
                                </button>
                            </div>
                        </div>

                        <!-- Right Column: Flexible Financing Options Card -->
                        <div style="border-top: 1px solid var(--adm-border-subtle, #332d27); padding-top: 24px; margin-top: 10px;">
                            <h3 style="font-size: 18px; font-weight: 700; margin-bottom: 16px; color: var(--adm-text, #fff);">Flexible Financing Options Card</h3>

                            <div class="adm-form-row">
                                <div class="adm-field">
                                    <label class="adm-label" for="sec_inv_fin_title">Financing Card Title</label>
                                    <input type="text" id="sec_inv_fin_title" name="sections[investment][financing_title]" value="{{ $sContent['financing_title'] ?? 'Flexible Financing Options' }}" class="adm-input">
                                </div>
                                <div class="adm-field">
                                    <label class="adm-label" for="sec_inv_fin_cta">Financing Card Button Label</label>
                                    <input type="text" id="sec_inv_fin_cta" name="sections[investment][financing_cta]" value="{{ $sContent['financing_cta'] ?? 'Contact a Mortgage Specialist' }}" class="adm-input">
                                </div>
                            </div>

                            <div class="adm-field">
                                <label class="adm-label" for="sec_inv_fin_desc">Financing Description</label>
                                <textarea id="sec_inv_fin_desc" name="sections[investment][financing_desc]" class="adm-textarea" rows="3">{{ $sContent['financing_desc'] ?? '' }}</textarea>
                            </div>

                            <!-- 2. Financing Highlights Repeater (Drag & Drop) -->
                            <div class="adm-repeater-wrap">
                                <div class="adm-repeater-intro">
                                    <div>
                                        <h3>Financing Highlights (<span id="repeaterCount_fin_hl">{{ count($sContent['financing_highlights'] ?? []) }}</span>)</h3>
                                        <p>Drag any financing highlight using the ⇅ handle to change the order. Add, edit or delete points.</p>
                                    </div>
                                    <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addFinancingHighlight()">
                                        @include('admin.partials.icon', ['name' => 'plus']) Add Financing Bullet
                                    </button>
                                </div>

                                <div class="adm-repeater-toolbar">
                                    <div class="adm-collapse-links">
                                        <button type="button" class="adm-link-btn" onclick="toggleCollapseAll(this, 'repeater_fin_hl_items')">Collapse all</button>
                                        <span>|</span>
                                        <button type="button" class="adm-link-btn" onclick="toggleExpandAll(this, 'repeater_fin_hl_items')">Expand all</button>
                                    </div>
                                </div>

                                <div class="adm-repeater-list" id="repeater_fin_hl_items">
                                    @foreach(($sContent['financing_highlights'] ?? []) as $idx => $fhl)
                                        @php $fhlText = is_array($fhl) ? ($fhl['text'] ?? $fhl['title'] ?? '') : $fhl; @endphp
                                        <div class="adm-repeater-item" id="fin_hl_item_{{ $idx }}" draggable="true">
                                            <div class="adm-repeater-head">
                                                <div class="adm-repeater-title-wrap">
                                                    <div class="adm-drag-handle" title="Drag to reorder">
                                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                            <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                            <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                        </svg>
                                                    </div>
                                                    <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                    <strong class="adm-repeater-heading-text">{{ $fhlText ?: 'Point ' . ($idx + 1) }}</strong>
                                                </div>
                                                <div class="adm-repeater-actions-head">
                                                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                    </button>
                                                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'fin_hl')">
                                                        @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="adm-repeater-body">
                                                <div class="adm-field" style="margin-bottom:0;">
                                                    <label class="adm-label">Financing Point Text</label>
                                                    <input type="text" name="sections[investment][financing_highlights][{{ $idx }}][text]" value="{{ $fhlText }}" class="adm-input" oninput="updateCardHeading(this)">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="adm-repeater-actions">
                                    <button type="button" class="adm-btn adm-btn-ghost" onclick="addFinancingHighlight()">
                                        @include('admin.partials.icon', ['name' => 'plus']) Add Another Financing Bullet
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'overview_location')
            <!-- OVERVIEW & LOCATION TAB -->
            <div id="tab-overview_location" class="tab-pane {{ $currentTab === 'overview_location' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Overview &amp; Location</h2>
                            <p>Manage the large location overview section, paragraph description, featured photo, and distance cards.</p>
                        </div>
                        <span class="adm-chip">overview_location</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[overview_location][_has_locations]" value="1">
                        <div class="adm-field">
                            <label class="adm-label" for="sec_loc_heading">Main Heading</label>
                            <input type="text" id="sec_loc_heading" name="sections[overview_location][heading]" value="{{ $sContent['heading'] ?? 'Hudayriyat Island Overview and Location' }}" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="sec_loc_paragraphs">Overview Paragraphs</label>
                            <textarea id="sec_loc_paragraphs" name="sections[overview_location][paragraphs]" class="adm-textarea adm-summernote" rows="6">{{ $sContent['paragraphs'] ?? '' }}</textarea>
                            <div class="adm-help">Double enter (blank line) creates a new paragraph on the frontend.</div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Featured Location Photo (Change Image / Upload)</label>
                            @php
                                $locImg = $sContent['image'] ?? '/images/hudayriyat-overview.jpg';
                                if ($locImg && !str_starts_with($locImg, 'http') && !str_starts_with($locImg, '/')) {
                                    $locImg = asset($locImg);
                                }
                            @endphp
                            <div class="adm-img-box">
                                <img src="{{ $locImg }}" class="adm-img-thumb-lg" alt="Preview">
                                <div class="adm-img-controls">
                                    <div class="adm-file-row">
                                        <input type="file" name="section_files[overview_location][image]" accept="image/*" class="adm-file-input" onchange="previewItemImage(this)">
                                    </div>
                                    <input type="text" name="sections[overview_location][image]" value="{{ $sContent['image'] ?? '/images/hudayriyat-overview.jpg' }}" class="adm-input" placeholder="Or enter image path">
                                    <input type="text" name="sections[overview_location][image_alt]" value="{{ $sContent['image_alt'] ?? 'Hudayriyat Island Overview and Luxury Villas' }}" class="adm-input" placeholder="Image Alt Text">
                                </div>
                            </div>
                        </div>

                        <div class="adm-repeater-wrap">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Location Highlights &amp; Distances (<span id="repeaterCount_locations">{{ count($sContent['locations'] ?? []) }}</span>)</h3>
                                    <p>Drag any distance card using the ⇅ handle to change the order. Add, edit or delete locations.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addLocationCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Distance Card
                                </button>
                            </div>

                            <div class="adm-repeater-toolbar">
                                <div class="adm-collapse-links">
                                    <button type="button" class="adm-link-btn" onclick="toggleCollapseAll(this, 'repeater_locations_items')">Collapse all</button>
                                    <span>|</span>
                                    <button type="button" class="adm-link-btn" onclick="toggleExpandAll(this, 'repeater_locations_items')">Expand all</button>
                                </div>
                            </div>

                            <div class="adm-repeater-list" id="repeater_locations_items">
                                @foreach(($sContent['locations'] ?? []) as $idx => $loc)
                                    <div class="adm-repeater-item" id="loc_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $loc['name'] ?? 'Location ' . ($idx + 1) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'locations')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field" style="margin-bottom:0;">
                                                    <label class="adm-label">Landmark / Destination Name</label>
                                                    <input type="text" name="sections[overview_location][locations][{{ $idx }}][name]" value="{{ $loc['name'] ?? '' }}" class="adm-input"  oninput="updateCardHeading(this)">
                                                </div>
                                                <div class="adm-field" style="margin-bottom:0;">
                                                    <label class="adm-label">Travel Time / Distance</label>
                                                    <input type="text" name="sections[overview_location][locations][{{ $idx }}][distance]" value="{{ $loc['distance'] ?? '' }}" class="adm-input" placeholder="e.g. 5 minutes by car" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addLocationCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Distance Card
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'payment_methods')
            <!-- PAYMENT METHODS TAB -->
            <div id="tab-payment_methods" class="tab-pane {{ $currentTab === 'payment_methods' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Accepted Payment Methods</h2>
                            <p>Configure accepted payment options, cards, and icons.</p>
                        </div>
                        <span class="adm-chip">payment_methods</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[payment_methods][_has_items]" value="1">
                        <div class="adm-field">
                            <label class="adm-label" for="sec_pay_heading">Heading</label>
                            <input type="text" id="sec_pay_heading" name="sections[payment_methods][heading]" value="{{ $sContent['heading'] ?? 'Hudayriyat Island Payment Methods' }}" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="sec_pay_subtitle">Subtitle</label>
                            <input type="text" id="sec_pay_subtitle" name="sections[payment_methods][subtitle]" value="{{ $sContent['subtitle'] ?? 'We accept all the following payment methods' }}" class="adm-input">
                        </div>

                        <div class="adm-repeater-wrap">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Payment Options (<span id="repeaterCount_payments">{{ count($sContent['items'] ?? []) }}</span>)</h3>
                                    <p>Drag any payment card with the ⇅ handle to change the order. Manage accepted payment methods.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addPaymentMethod()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Payment Method
                                </button>
                            </div>

                            <div class="adm-repeater-toolbar">
                                <div class="adm-collapse-links">
                                    <button type="button" class="adm-link-btn" onclick="toggleCollapseAll(this, 'repeater_payments_items')">Collapse all</button>
                                    <span>|</span>
                                    <button type="button" class="adm-link-btn" onclick="toggleExpandAll(this, 'repeater_payments_items')">Expand all</button>
                                </div>
                            </div>

                            <div class="adm-repeater-list" id="repeater_payments_items">
                                @foreach(($sContent['items'] ?? []) as $idx => $pay)
                                    @php
                                        $iconSrc = $pay['icon'] ?? '/images/payments/card.png';
                                        if ($iconSrc && !str_starts_with($iconSrc, 'http') && !str_starts_with($iconSrc, '/')) {
                                            $iconSrc = asset($iconSrc);
                                        }
                                    @endphp
                                    <div class="adm-repeater-item" id="pay_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $pay['name'] ?? 'Payment ' . ($idx + 1) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'payments')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-field">
                                                <label class="adm-label">Payment Method Name</label>
                                                <input type="text" name="sections[payment_methods][items][{{ $idx }}][name]" value="{{ $pay['name'] ?? '' }}" class="adm-input"  oninput="updateCardHeading(this)">
                                            </div>

                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">Icon / Image (Change Icon / Upload)</label>
                                                <div class="adm-img-box">
                                                    <img src="{{ $iconSrc }}" class="adm-img-thumb-icon" alt="Icon">
                                                    <div class="adm-img-controls">
                                                        <div class="adm-file-row">
                                                            <input type="file" name="section_files[payment_methods][items][{{ $idx }}][icon]" accept="image/*" class="adm-file-input" onchange="previewItemImage(this)">
                                                        </div>
                                                        <input type="text" name="sections[payment_methods][items][{{ $idx }}][icon]" value="{{ $pay['icon'] ?? '' }}" class="adm-input" placeholder="Or enter icon path / URL">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addPaymentMethod()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Payment Method
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'faq')
            <!-- FAQ TAB -->
            <div id="tab-faq" class="tab-pane {{ $currentTab === 'faq' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Frequently Asked Questions (FAQ)</h2>
                            <p>Manage common questions and answers displayed in the interactive accordion on the home page.</p>
                        </div>
                        <span class="adm-chip">faq</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[faq][_has_items]" value="1">
                        <div class="adm-field">
                            <label class="adm-label" for="sec_faq_heading">Section Title</label>
                            <input type="text" id="sec_faq_heading" name="sections[faq][heading]" value="{{ $sContent['heading'] ?? 'Frequently Asked Questions' }}" class="adm-input">
                        </div>

                        <div class="adm-faq-wrap">
                            <div class="adm-faq-intro">
                                <h3>Questions &amp; Answers (<span id="repeaterCount_faq">{{ count($sContent['items'] ?? []) }}</span>)</h3>
                                <p>Drag <strong>⇅</strong> to reorder, <strong>✕</strong> to delete a row.</p>
                            </div>

                            <div class="adm-faq-cols" aria-hidden="true">
                                <span></span><span>Question</span><span>Answer</span><span></span>
                            </div>

                            <div class="adm-repeater-list adm-faq-list" id="repeater_faq_items">
                                @foreach(($sContent['items'] ?? []) as $idx => $faq)
                                    <div class="adm-repeater-item adm-faq-row" id="faq_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head adm-faq-handle">
                                            <div class="adm-drag-handle" title="Drag to reorder">
                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                    <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                </svg>
                                            </div>
                                        </div>
                                        <input type="text" name="sections[faq][items][{{ $idx }}][q]" value="{{ $faq['q'] ?? ($faq['question'] ?? '') }}" class="adm-input" placeholder="Question">
                                        <textarea name="sections[faq][items][{{ $idx }}][a]" class="adm-textarea" rows="1" placeholder="Answer">{{ trim(html_entity_decode(strip_tags($faq['a'] ?? ($faq['answer'] ?? '')), ENT_QUOTES)) }}</textarea>
                                        <button type="button" class="adm-faq-del" onclick="removeFaqRow(this)" title="Delete row" aria-label="Delete row">&#10005;</button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="adm-faq-add" onclick="addFaqQuestion()">+ Add Row</button>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'contact')
            <!-- CONTACT SECTION TAB -->
            <div id="tab-contact" class="tab-pane {{ $currentTab === 'contact' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Contact &amp; Callback Section</h2>
                            <p>Configure contact section headings, form labels, submit button, and background image.</p>
                        </div>
                        <span class="adm-chip">contact</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label" for="sec_contact_pretitle">Pretitle / Eyebrow</label>
                            <input type="text" id="sec_contact_pretitle" name="sections[contact][pretitle]" value="{{ $sContent['pretitle'] ?? "LET'S CONNECT" }}" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="sec_contact_heading">Main Heading</label>
                            <input type="text" id="sec_contact_heading" name="sections[contact][heading]" value="{{ $sContent['heading'] ?? 'Invest in Your Future' }}" class="adm-input" required>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="sec_contact_subtitle">Subtitle / Description</label>
                            <textarea id="sec_contact_subtitle" name="sections[contact][subtitle]" class="adm-textarea" rows="3">{{ $sContent['subtitle'] ?? '' }}</textarea>
                        </div>

                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="sec_contact_f_small">Form Small Title</label>
                                <input type="text" id="sec_contact_f_small" name="sections[contact][form_small]" value="{{ $sContent['form_small'] ?? 'REQUEST' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="sec_contact_f_large">Form Large Title</label>
                                <input type="text" id="sec_contact_f_large" name="sections[contact][form_large]" value="{{ $sContent['form_large'] ?? 'A CALL BACK' }}" class="adm-input">
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="sec_contact_submit">Submit Button Label</label>
                            <input type="text" id="sec_contact_submit" name="sections[contact][submit_button]" value="{{ $sContent['submit_button'] ?? 'REQUEST NOW' }}" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Background Image (Upload / Change)</label>
                            @php
                                $cBg = $sContent['bg_image'] ?? '/images/form image.jpg';
                                if ($cBg && !str_starts_with($cBg, 'http') && !str_starts_with($cBg, '/')) {
                                    $cBg = asset($cBg);
                                }
                            @endphp
                            <div class="adm-img-box">
                                <img src="{{ $cBg }}" class="adm-img-thumb-lg" alt="Preview">
                                <div class="adm-img-controls">
                                    <div class="adm-file-row">
                                        <input type="file" name="section_files[contact][bg_image]" accept="image/*" class="adm-file-input" onchange="previewItemImage(this)">
                                    </div>
                                    <input type="text" name="sections[contact][bg_image]" value="{{ $sContent['bg_image'] ?? '/images/form image.jpg' }}" class="adm-input" placeholder="Or enter image path">
                                    <div class="adm-help">Upload a photo from your computer or enter an image path / URL.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'intro')
            <!-- INTRODUCTION & PHOTO TAB -->
            <div id="tab-intro" class="tab-pane {{ $currentTab === 'intro' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Introduction &amp; Featured Photo</h2>
                            <p>Configure introductory text paragraphs and featured photography.</p>
                        </div>
                        <span class="adm-chip">intro</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label" for="introLead">Lead Paragraph</label>
                            <textarea id="introLead" name="sections[intro][lead]" class="adm-textarea" rows="3" placeholder="Lead summary paragraph...">{{ $sContent['lead'] ?? '' }}</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="introBody">Body Paragraph</label>
                            <textarea id="introBody" name="sections[intro][body]" class="adm-textarea adm-summernote" rows="4" placeholder="Detailed body paragraph...">{{ $sContent['body'] ?? '' }}</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Featured Image (Upload / Change)</label>
                            @php
                                $introImgVal = $sContent['image'] ?? '/images/form image.jpg';
                                if ($introImgVal && !str_starts_with($introImgVal, 'http') && !str_starts_with($introImgVal, '/')) {
                                    $introImgVal = asset($introImgVal);
                                }
                            @endphp
                            <div class="adm-img-box">
                                <img src="{{ $introImgVal }}" class="adm-img-thumb-lg" alt="Preview">
                                <div class="adm-img-controls">
                                    <div class="adm-file-row">
                                        <input type="file" name="section_files[intro][image]" accept="image/*" class="adm-file-input" onchange="previewItemImage(this)">
                                    </div>
                                    <input type="text" name="sections[intro][image]" value="{{ $sContent['image'] ?? '/images/form image.jpg' }}" class="adm-input" placeholder="Or enter image path">
                                    <div class="adm-help">Upload a photo from your computer or enter an image path / URL.</div>
                                </div>
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="introAlt">Image Alt Text (SEO)</label>
                            <input type="text" id="introAlt" name="sections[intro][image_alt]" value="{{ $sContent['image_alt'] ?? '' }}" class="adm-input" placeholder="Hudayriyat Island Waterfront Luxury Architecture">
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'services')
            <!-- CORE SERVICES TAB -->
            <div id="tab-services" class="tab-pane {{ $currentTab === 'services' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Core Services</h2>
                            <p>Manage the services cards list. Drag any service card with the ⇅ handle to reorder.</p>
                        </div>
                        <span class="adm-chip">services</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[services][_has_items]" value="1">
                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="srvTag">Section Tag / Eyebrow</label>
                                <input type="text" id="srvTag" name="sections[services][tag]" value="{{ $sContent['tag'] ?? 'WHAT WE DO' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="srvHeading">Section Heading</label>
                                <input type="text" id="srvHeading" name="sections[services][heading]" value="{{ $sContent['heading'] ?? 'Our Core Services' }}" class="adm-input">
                            </div>
                        </div>

                        @php $srvItems = $sContent['items'] ?? []; @endphp
                        <div class="adm-repeater-wrap">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Service Cards (<span id="repeaterCount_services">{{ count($srvItems) }}</span>)</h3>
                                    <p>Drag any service card using the ⇅ handle to reorder.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addServiceCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Service
                                </button>
                            </div>

                            <div class="adm-repeater-toolbar">
                                <div class="adm-collapse-links">
                                    <button type="button" class="adm-link-btn" onclick="toggleCollapseAll(this, 'repeater_services_items')">Collapse all</button>
                                    <span>|</span>
                                    <button type="button" class="adm-link-btn" onclick="toggleExpandAll(this, 'repeater_services_items')">Expand all</button>
                                </div>
                            </div>

                            <div class="adm-repeater-list" id="repeater_services_items">
                                @foreach($srvItems as $idx => $item)
                                    <div class="adm-repeater-item" id="srv_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $item['title'] ?? ('Service ' . ($idx + 1)) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'services')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field">
                                                    <label class="adm-label">Service Title</label>
                                                    <input type="text" name="sections[services][items][{{ $idx }}][title]" value="{{ $item['title'] ?? '' }}" class="adm-input"  oninput="updateCardHeading(this)">
                                                </div>
                                                <div class="adm-field">
                                                    <label class="adm-label">Icon (compass / building / trending-up)</label>
                                                    <input type="text" name="sections[services][items][{{ $idx }}][icon]" value="{{ $item['icon'] ?? 'compass' }}" class="adm-input">
                                                </div>
                                            </div>
                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">Service Description</label>
                                                <textarea name="sections[services][items][{{ $idx }}][description]" class="adm-textarea adm-summernote" rows="3" >{{ $item['description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addServiceCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Service
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'pillars')
            <!-- PILLARS TAB -->
            <div id="tab-pillars" class="tab-pane {{ $currentTab === 'pillars' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Mission, Vision &amp; Values</h2>
                            <p>Configure core pillar cards. Drag cards using the ⇅ handle to reorder.</p>
                        </div>
                        <span class="adm-chip">pillars</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[pillars][_has_items]" value="1">
                        @php $pillarItems = $sContent['items'] ?? []; @endphp
                        <div class="adm-repeater-wrap">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Pillar Cards (<span id="repeaterCount_pillars">{{ count($pillarItems) }}</span>)</h3>
                                    <p>Drag any pillar using the ⇅ handle to reorder.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addPillarCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Pillar
                                </button>
                            </div>

                            <div class="adm-repeater-list" id="repeater_pillars_items">
                                @foreach($pillarItems as $idx => $item)
                                    <div class="adm-repeater-item" id="pillar_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $item['title'] ?? ('Pillar ' . ($idx + 1)) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'pillars')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field">
                                                    <label class="adm-label">Pillar Title (e.g. Our Mission)</label>
                                                    <input type="text" name="sections[pillars][items][{{ $idx }}][title]" value="{{ $item['title'] ?? '' }}" class="adm-input"  oninput="updateCardHeading(this)">
                                                </div>
                                                <div class="adm-field">
                                                    <label class="adm-label">Icon (target / eye / shield)</label>
                                                    <input type="text" name="sections[pillars][items][{{ $idx }}][icon]" value="{{ $item['icon'] ?? 'target' }}" class="adm-input">
                                                </div>
                                            </div>
                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">Pillar Description</label>
                                                <textarea name="sections[pillars][items][{{ $idx }}][description]" class="adm-textarea adm-summernote" rows="3" >{{ $item['description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addPillarCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Pillar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'why_us')
            <!-- WHY CHOOSE US TAB -->
            <div id="tab-why_us" class="tab-pane {{ $currentTab === 'why_us' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Why Choose Us</h2>
                            <p>Configure reasons to choose and key advantages. Drag cards using the ⇅ handle to reorder.</p>
                        </div>
                        <span class="adm-chip">why_us</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[why_us][_has_items]" value="1">
                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="whyTag">Section Tag / Eyebrow</label>
                                <input type="text" id="whyTag" name="sections[why_us][tag]" value="{{ $sContent['tag'] ?? 'THE ADVANTAGE' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="whyHeading">Section Heading</label>
                                <input type="text" id="whyHeading" name="sections[why_us][heading]" value="{{ $sContent['heading'] ?? 'Why Choose Us?' }}" class="adm-input">
                            </div>
                        </div>

                        @php $whyItems = $sContent['items'] ?? []; @endphp
                        <div class="adm-repeater-wrap">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Advantage Cards (<span id="repeaterCount_why_us">{{ count($whyItems) }}</span>)</h3>
                                    <p>Drag any card using the ⇅ handle to reorder.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addWhyUsCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Advantage
                                </button>
                            </div>

                            <div class="adm-repeater-list" id="repeater_why_us_items">
                                @foreach($whyItems as $idx => $item)
                                    <div class="adm-repeater-item" id="why_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $item['title'] ?? ('Advantage ' . ($idx + 1)) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'why_us')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field">
                                                    <label class="adm-label">Advantage Title</label>
                                                    <input type="text" name="sections[why_us][items][{{ $idx }}][title]" value="{{ $item['title'] ?? '' }}" class="adm-input"  oninput="updateCardHeading(this)">
                                                </div>
                                                <div class="adm-field">
                                                    <label class="adm-label">Icon (map-pin / heart / search)</label>
                                                    <input type="text" name="sections[why_us][items][{{ $idx }}][icon]" value="{{ $item['icon'] ?? 'map-pin' }}" class="adm-input">
                                                </div>
                                            </div>
                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">Advantage Description</label>
                                                <textarea name="sections[why_us][items][{{ $idx }}][description]" class="adm-textarea adm-summernote" rows="3" >{{ $item['description'] ?? '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addWhyUsCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Advantage
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'cta')
            <!-- CTA TAB -->
            <div id="tab-cta" class="tab-pane {{ $currentTab === 'cta' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>CTA &amp; Contact Form</h2>
                            <p>Configure call to action messaging, benefit bullets, and form prompts.</p>
                        </div>
                        <span class="adm-chip">cta</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[cta][_has_benefits]" value="1">
                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="ctaTag">Section Tag / Eyebrow</label>
                                <input type="text" id="ctaTag" name="sections[cta][tag]" value="{{ $sContent['tag'] ?? 'START YOUR JOURNEY' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="ctaHeading">Heading</label>
                                <input type="text" id="ctaHeading" name="sections[cta][heading]" value="{{ $sContent['heading'] ?? 'Looking for Your Dream Property?' }}" class="adm-input">
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="ctaBody">Description Body</label>
                            <textarea id="ctaBody" name="sections[cta][body]" class="adm-textarea adm-summernote" rows="3">{{ $sContent['body'] ?? '' }}</textarea>
                        </div>

                        @php $benefits = $sContent['benefits'] ?? []; @endphp
                        <div class="adm-repeater-wrap" style="margin-top:16px;">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Benefit Highlights (<span id="repeaterCount_cta_ben">{{ count($benefits) }}</span>)</h3>
                                    <p>Drag bullet points using the ⇅ handle to reorder.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addCtaBenefit()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Benefit Bullet
                                </button>
                            </div>

                            <div class="adm-repeater-list" id="repeater_cta_ben_items">
                                @foreach($benefits as $idx => $bItem)
                                    @php $bText = is_array($bItem) ? ($bItem['text'] ?? '') : $bItem; @endphp
                                    <div class="adm-repeater-item" id="cta_ben_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $bText }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'cta_ben')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">Benefit Bullet Text</label>
                                                <input type="text" name="sections[cta][benefits][{{ $idx }}][text]" value="{{ $bText }}" class="adm-input"  oninput="updateCardHeading(this)">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addCtaBenefit()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Benefit
                                </button>
                            </div>
                        </div>

                        <div class="adm-form-row" style="margin-top:16px;">
                            <div class="adm-field">
                                <label class="adm-label" for="ctaFormTitle">Form Title</label>
                                <input type="text" id="ctaFormTitle" name="sections[cta][form_title]" value="{{ $sContent['form_title'] ?? 'Get in Touch' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="ctaFormSubtitle">Form Subtitle</label>
                                <input type="text" id="ctaFormSubtitle" name="sections[cta][form_subtitle]" value="{{ $sContent['form_subtitle'] ?? 'Enter your details and our team will contact you shortly.' }}" class="adm-input">
                            </div>
                        </div>

                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="ctaSubmit">Submit Button Label</label>
                                <input type="text" id="ctaSubmit" name="sections[cta][submit_button]" value="{{ $sContent['submit_button'] ?? 'SUBMIT NOW' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="ctaTerms">Terms Note</label>
                                <input type="text" id="ctaTerms" name="sections[cta][terms_note]" value="{{ $sContent['terms_note'] ?? 'By submitting, you agree to our Terms & Privacy Policy.' }}" class="adm-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'channels')
            <!-- DIRECT CONTACT CHANNELS TAB -->
            <div id="tab-channels" class="tab-pane {{ $currentTab === 'channels' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Direct Contact Channels</h2>
                            <p>Configure direct contact options (WhatsApp, Phone, Email, Location). Drag cards using the ⇅ handle to reorder.</p>
                        </div>
                        <span class="adm-chip">channels</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[channels][_has_items]" value="1">
                        @php $channelItems = $sContent['items'] ?? []; @endphp
                        <div class="adm-repeater-wrap">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Channel Cards (<span id="repeaterCount_channels">{{ count($channelItems) }}</span>)</h3>
                                    <p>Drag any channel card using the ⇅ handle to reorder.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addChannelCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Contact Channel
                                </button>
                            </div>

                            <div class="adm-repeater-list" id="repeater_channels_items">
                                @foreach($channelItems as $idx => $item)
                                    <div class="adm-repeater-item" id="channel_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $item['title'] ?? ('Channel ' . ($idx + 1)) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'channels')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field">
                                                    <label class="adm-label">Channel Title</label>
                                                    <input type="text" name="sections[channels][items][{{ $idx }}][title]" value="{{ $item['title'] ?? '' }}" class="adm-input"  oninput="updateCardHeading(this)">
                                                </div>
                                                <div class="adm-field">
                                                    <label class="adm-label">Icon (whatsapp / phone / email / location)</label>
                                                    <input type="text" name="sections[channels][items][{{ $idx }}][icon]" value="{{ $item['icon'] ?? 'phone' }}" class="adm-input">
                                                </div>
                                            </div>
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field">
                                                    <label class="adm-label">Info / Phone / Address</label>
                                                    <input type="text" name="sections[channels][items][{{ $idx }}][info]" value="{{ $item['info'] ?? '' }}" class="adm-input" placeholder="+971 50 000 0000">
                                                </div>
                                                <div class="adm-field">
                                                    <label class="adm-label">Action Text</label>
                                                    <input type="text" name="sections[channels][items][{{ $idx }}][action]" value="{{ $item['action'] ?? '' }}" class="adm-input" placeholder="Call an Advisor →">
                                                </div>
                                            </div>
                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">URL / Link (wa.me / tel: / mailto: / blank)</label>
                                                <input type="text" name="sections[channels][items][{{ $idx }}][url]" value="{{ $item['url'] ?? '' }}" class="adm-input" placeholder="tel:+971500000000">
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addChannelCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Channel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'info')
            <!-- EMERGING PROPERTIES & CONTACT FORM TAB -->
            <div id="tab-info" class="tab-pane {{ $currentTab === 'info' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Emerging Properties &amp; Contact Form</h2>
                            <p>Configure informational copy, feature highlights badges, and contact form settings.</p>
                        </div>
                        <span class="adm-chip">info</span>
                    </div>
                    <div class="adm-card-body">
                        <input type="hidden" name="sections[info][_has_features]" value="1">
                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="infoTag">Section Tag / Eyebrow</label>
                                <input type="text" id="infoTag" name="sections[info][tag]" value="{{ $sContent['tag'] ?? 'PREMIER OPPORTUNITY' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="infoHeading">Section Heading</label>
                                <input type="text" id="infoHeading" name="sections[info][heading]" value="{{ $sContent['heading'] ?? 'Discover Emerging Properties on Hudayriyat Island' }}" class="adm-input">
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="infoLead">Lead Paragraph</label>
                            <textarea id="infoLead" name="sections[info][lead]" class="adm-textarea" rows="3">{{ $sContent['lead'] ?? '' }}</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="infoBody">Body Paragraph</label>
                            <textarea id="infoBody" name="sections[info][body]" class="adm-textarea adm-summernote" rows="3">{{ $sContent['body'] ?? '' }}</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="infoHighlight">Highlight Paragraph</label>
                            <textarea id="infoHighlight" name="sections[info][highlight]" class="adm-textarea" rows="2">{{ $sContent['highlight'] ?? '' }}</textarea>
                        </div>

                        @php $featuresList = $sContent['features'] ?? []; @endphp
                        <div class="adm-repeater-wrap" style="margin-top:16px;">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Feature Badges (<span id="repeaterCount_info_feat">{{ count($featuresList) }}</span>)</h3>
                                    <p>Drag badge cards using the ⇅ handle to reorder.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addFeatureCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Feature Badge
                                </button>
                            </div>

                            <div class="adm-repeater-list" id="repeater_info_feat_items">
                                @foreach($featuresList as $idx => $feat)
                                    <div class="adm-repeater-item" id="feat_item_{{ $idx }}" draggable="true">
                                        <div class="adm-repeater-head">
                                            <div class="adm-repeater-title-wrap">
                                                <div class="adm-drag-handle" title="Drag to reorder">
                                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                    </svg>
                                                </div>
                                                <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                <strong class="adm-repeater-heading-text">{{ $feat['title'] ?? ('Feature ' . ($idx + 1)) }}</strong>
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                </button>
                                                <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'info_feat')">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-repeater-body">
                                            <div class="adm-grid-2-col">
                                                <div class="adm-field">
                                                    <label class="adm-label">Feature Title</label>
                                                    <input type="text" name="sections[info][features][{{ $idx }}][title]" value="{{ $feat['title'] ?? '' }}" class="adm-input"  oninput="updateCardHeading(this)">
                                                </div>
                                                <div class="adm-field">
                                                    <label class="adm-label">Icon (building / sparkles / clock)</label>
                                                    <input type="text" name="sections[info][features][{{ $idx }}][icon]" value="{{ $feat['icon'] ?? 'building' }}" class="adm-input">
                                                </div>
                                            </div>
                                            <div class="adm-field" style="margin-bottom:0;">
                                                <label class="adm-label">Description</label>
                                                <input type="text" name="sections[info][features][{{ $idx }}][desc]" value="{{ $feat['desc'] ?? ($feat['description'] ?? '') }}" class="adm-input" >
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="adm-repeater-actions">
                                <button type="button" class="adm-btn adm-btn-ghost" onclick="addFeatureCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Another Feature
                                </button>
                            </div>
                        </div>

                        <div class="adm-form-row" style="margin-top:16px;">
                            <div class="adm-field">
                                <label class="adm-label" for="infoFormTitle">Form Title</label>
                                <input type="text" id="infoFormTitle" name="sections[info][form_title]" value="{{ $sContent['form_title'] ?? 'Get in Touch' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="infoFormSubtitle">Form Subtitle</label>
                                <input type="text" id="infoFormSubtitle" name="sections[info][form_subtitle]" value="{{ $sContent['form_subtitle'] ?? 'Enter your details and our team will contact you shortly.' }}" class="adm-input">
                            </div>
                        </div>

                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label" for="infoSubmit">Submit Button Label</label>
                                <input type="text" id="infoSubmit" name="sections[info][submit_button]" value="{{ $sContent['submit_button'] ?? 'SUBMIT NOW' }}" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="infoTerms">Terms Note</label>
                                <input type="text" id="infoTerms" name="sections[info][terms_note]" value="{{ $sContent['terms_note'] ?? 'By submitting, you agree to our Terms & Privacy Policy.' }}" class="adm-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                @elseif($sec->section_key === 'location')
            <!-- LOCATION & CONNECTIVITY TAB -->
            <div id="tab-location" class="tab-pane {{ $currentTab === 'location' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Location &amp; Connectivity</h2>
                            <p>Manage section title, description, map visual / photograph, and nearby destination categories.</p>
                        </div>
                        <span class="adm-chip">location</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[location][title]" value="{{ old('sections.location.title', $sContent['title'] ?? ($page->title . ' Location & Attractions')) }}" class="adm-input" placeholder="e.g. Wadeem Gardens Location & Attractions">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Subtitle / Description</label>
                            <textarea name="sections[location][subtitle]" class="adm-textarea" rows="3" placeholder="Describe the location, proximity, and surroundings...">{{ old('sections.location.subtitle', $sContent['subtitle'] ?? '') }}</textarea>
                        </div>

                        <!-- Location Image with Live Preview and File Upload -->
                        <div class="adm-field">
                            <label class="adm-label">Location Graphic / Signboard Photo</label>
                            <div style="display: flex; gap: 20px; align-items: flex-start; background: #faf8f5; border: 1px solid #e8e1d7; border-radius: 8px; padding: 16px;">
                                <div style="width: 140px; height: 95px; border-radius: 6px; overflow: hidden; background: #1a1a1a; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #d4c7b5;">
                                    <img id="preview_location_img" src="{{ $sContent['image'] ?? '/images/20231014_191447.webp' }}" alt="Location Preview" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1;">
                                    <label class="adm-label" style="font-size: 12px; margin-bottom: 4px;">Image URL / Path</label>
                                    <input type="text" name="sections[location][image]" id="input_location_img" value="{{ $sContent['image'] ?? '/images/20231014_191447.webp' }}" class="adm-input" placeholder="/images/20231014_191447.webp" oninput="document.getElementById('preview_location_img').src = this.value">
                                    <div style="margin-top: 10px;">
                                        <label class="adm-label" style="font-size: 12px; margin-bottom: 4px;">Or Upload New Image</label>
                                        <input type="file" name="section_files[location][image]" class="adm-input" accept="image/*" onchange="previewUploadedImage(this, 'preview_location_img', 'input_location_img')">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Accordion Categories & Places Repeater -->
                        @php
                            $locCategories = $sContent['categories'] ?? [];
                        @endphp
                        <div class="adm-repeater-wrap" style="margin-top: 24px;">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Attraction Categories &amp; Destinations</h3>
                                    <p>Configure accordion categories (Restaurants, Hospitals, Schools, Landmarks) and individual destination rows with travel times.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addLocationCategory()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Category
                                </button>
                            </div>

                            <div id="location_categories_container" style="display: flex; flex-direction: column; gap: 16px;">
                                @foreach($locCategories as $catIdx => $cat)
                                    <div class="adm-card" id="loc_cat_{{ $catIdx }}" style="border: 1px solid #dcd3c6; background: #fff; margin-bottom: 0;">
                                        <div class="adm-card-head" style="padding: 12px 16px; background: #fdfcfb;">
                                            <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                                                <span class="adm-chip" style="font-weight: 700;">#{{ $catIdx + 1 }}</span>
                                                <input type="text" name="sections[location][categories][{{ $catIdx }}][name]" value="{{ $cat['name'] ?? '' }}" class="adm-input" placeholder="Category Name (e.g. Restaurants)" style="font-weight: 700; max-width: 320px;">
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('loc_cat_{{ $catIdx }}').remove()">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete Category
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-card-body" style="padding: 16px;">
                                            <div style="margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                                                <label class="adm-label" style="margin-bottom: 0;">Places &amp; Estimated Travel Times:</label>
                                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addLocationItem({{ $catIdx }})" style="font-size: 11px; padding: 4px 10px;">
                                                    + Add Destination
                                                </button>
                                            </div>
                                            <div id="loc_cat_{{ $catIdx }}_items" style="display: flex; flex-direction: column; gap: 8px;">
                                                @foreach($cat['items'] ?? [] as $itmIdx => $itm)
                                                    <div class="adm-form-row" id="loc_cat_{{ $catIdx }}_item_{{ $itmIdx }}" style="gap: 12px; align-items: center; margin-bottom: 4px;">
                                                        <div style="flex: 2;">
                                                            <input type="text" name="sections[location][categories][{{ $catIdx }}][items][{{ $itmIdx }}][name]" value="{{ $itm['name'] ?? '' }}" class="adm-input" placeholder="Destination Name (e.g. Marmoura Restaurant)">
                                                        </div>
                                                        <div style="flex: 1.2;">
                                                            <input type="text" name="sections[location][categories][{{ $catIdx }}][items][{{ $itmIdx }}][time]" value="{{ $itm['time'] ?? '' }}" class="adm-input" placeholder="e.g. 4 mins">
                                                        </div>
                                                        <button type="button" class="adm-btn-item-delete" style="padding: 8px;" onclick="document.getElementById('loc_cat_{{ $catIdx }}_item_{{ $itmIdx }}').remove()" title="Delete Destination">
                                                            ✕
                                                        </button>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'payment_plan')
            <!-- PAYMENT PLAN TAB -->
            <div id="tab-payment_plan" class="tab-pane {{ $currentTab === 'payment_plan' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Payment Plan &amp; Milestone Schedule</h2>
                            <p>Manage payment plan title, description, milestone percentage table rows, and the download payment plan CTA.</p>
                        </div>
                        <span class="adm-chip">payment_plan</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[payment_plan][title]" value="{{ old('sections.payment_plan.title', $sContent['title'] ?? ($page->title . ' Payment Plan')) }}" class="adm-input" placeholder="e.g. Wadeem Gardens Payment Plan">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description / Subtitle</label>
                            <textarea name="sections[payment_plan][description]" class="adm-textarea adm-summernote" rows="2" placeholder="Flexible milestone payment terms tailored for island living...">{{ old('sections.payment_plan.description', $sContent['description'] ?? '') }}</textarea>
                        </div>

                        <div class="adm-grid-2-col">
                            <div class="adm-field">
                                <label class="adm-label">Plan Tabs (Comma separated)</label>
                                <input type="text" name="sections[payment_plan][plan_tabs]" value="{{ is_array($sContent['plan_tabs'] ?? null) ? implode(', ', $sContent['plan_tabs']) : ($sContent['plan_tabs'] ?? 'Without Finance - 45/55, With Finance - 25/75') }}" class="adm-input" placeholder="Without Finance - 45/55, With Finance - 25/75">
                                <div class="adm-help">Displays tab filters above the table</div>
                            </div>
                            <div class="adm-field">
                                <label class="adm-label">Download Button Text</label>
                                <input type="text" name="sections[payment_plan][download_text]" value="{{ $sContent['download_text'] ?? 'DOWNLOAD PAYMENT PLAN' }}" class="adm-input" placeholder="DOWNLOAD PAYMENT PLAN">
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Download Brochure / PDF URL</label>
                            <div style="display: flex; gap: 12px;">
                                <input type="text" name="sections[payment_plan][download_url]" value="{{ $sContent['download_url'] ?? '#' }}" class="adm-input" placeholder="https://example.com/payment-plan.pdf or #" style="flex:1;">
                                <input type="file" name="section_files[payment_plan][download_file]" class="adm-input" accept=".pdf,.png,.jpg,.jpeg" style="max-width: 280px;">
                            </div>
                        </div>

                        <!-- Installment Table Rows Repeater -->
                        @php
                            $payRows = $sContent['rows'] ?? [];
                        @endphp
                        <div class="adm-repeater-wrap" style="margin-top: 24px;">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Installment Breakdown Rows (<span id="payRowCount">{{ count($payRows) }}</span>)</h3>
                                    <p>Configure installment name, percentage, and target construction/handover milestone.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addPaymentRow()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Installment Row
                                </button>
                            </div>

                            <div style="background: #faf8f5; border: 1px solid #e8e1d7; border-radius: 8px; overflow: hidden;">
                                <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 13px;">
                                    <thead>
                                        <tr style="background: #ece4d8; color: #4a3e2f; font-weight: 700; border-bottom: 1px solid #d4c7b5;">
                                            <th style="padding: 10px 14px; width: 40px;">#</th>
                                            <th style="padding: 10px 14px;">Installment</th>
                                            <th style="padding: 10px 14px; width: 140px;">Percentage</th>
                                            <th style="padding: 10px 14px;">Milestone</th>
                                            <th style="padding: 10px 14px; width: 60px; text-align: center;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="payment_rows_container">
                                        @foreach($payRows as $rIdx => $row)
                                            <tr id="pay_row_{{ $rIdx }}" style="border-bottom: 1px solid #e8e1d7;">
                                                <td style="padding: 8px 14px; font-weight: 700; color: #1a4731;">{{ $rIdx + 1 }}</td>
                                                <td style="padding: 8px 14px;">
                                                    <input type="text" name="sections[payment_plan][rows][{{ $rIdx }}][installment]" value="{{ $row['installment'] ?? '' }}" class="adm-input" placeholder="e.g. Down Payment" style="font-weight: 600;">
                                                </td>
                                                <td style="padding: 8px 14px;">
                                                    <input type="text" name="sections[payment_plan][rows][{{ $rIdx }}][percentage]" value="{{ $row['percentage'] ?? '' }}" class="adm-input" placeholder="e.g. 5% or 10%" style="font-weight: 700; color: #1a4731;">
                                                </td>
                                                <td style="padding: 8px 14px;">
                                                    <input type="text" name="sections[payment_plan][rows][{{ $rIdx }}][milestone]" value="{{ $row['milestone'] ?? '' }}" class="adm-input" placeholder="e.g. Construction Milestone / On Booking">
                                                </td>
                                                <td style="padding: 8px 14px; text-align: center;">
                                                    <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('pay_row_{{ $rIdx }}').remove()" style="padding: 6px 8px;" title="Remove row">
                                                        ✕
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'floor_plans')
            <!-- FLOOR PLANS TAB -->
            <div id="tab-floor_plans" class="tab-pane {{ $currentTab === 'floor_plans' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Floor Plans</h2>
                            <p>Configure floor plan layouts, specifications, unit images, and downloadable brochure.</p>
                        </div>
                        <span class="adm-chip">floor_plans</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-form-row">
                            <div class="adm-field">
                                <label class="adm-label">Section Title</label>
                                <input type="text" name="sections[floor_plans][title]" value="{{ old('sections.floor_plans.title', html_entity_decode($sContent['title'] ?? ($page->title . ' Floor Plan'), ENT_QUOTES | ENT_HTML5, 'UTF-8')) }}" class="adm-input" placeholder="e.g. {{ $page->title }} Floor Plan">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label">Download Button Text</label>
                                <input type="text" name="sections[floor_plans][download_text]" value="{{ $sContent['download_text'] ?? 'Download Floor Plan' }}" class="adm-input" placeholder="Download Floor Plan">
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Subtitle / Description</label>
                            <textarea name="sections[floor_plans][subtitle]" class="adm-textarea" rows="2" placeholder="Spacious layouts designed across multiple levels with premium specifications...">{{ $sContent['subtitle'] ?? '' }}</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Brochure Download URL / File Upload</label>
                            <div style="display: flex; gap: 12px;">
                                <input type="text" name="sections[floor_plans][download_url]" id="input_floor_download_url" value="{{ $sContent['download_url'] ?? '#' }}" class="adm-input" placeholder="https://... or /downloads/floor-plans.pdf" style="flex:1;">
                                <input type="file" name="section_files[floor_plans][download_file]" class="adm-input" accept=".pdf,.png,.jpg,.jpeg" style="max-width: 280px;" onchange="if(this.files[0]) document.getElementById('input_floor_download_url').value = '/uploads/pages/' + this.files[0].name">
                            </div>
                        </div>

                        <!-- Floor Plans Repeater -->
                        @php
                            $floorItems = $sContent['items'] ?? [];
                        @endphp
                        <div class="adm-repeater-wrap" style="margin-top: 24px;">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Floor Plan Layouts (<span id="floorPlansCount">{{ count($floorItems) }}</span>)</h3>
                                    <p>Add, edit, or delete floor plan configurations with live blueprint previews.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addFloorPlanItem()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Floor Plan
                                </button>
                            </div>

                            <div id="floor_plans_container" style="display: flex; flex-direction: column; gap: 16px;">
                                @foreach($floorItems as $fIdx => $plan)
                                    <div class="adm-card" id="floor_plan_card_{{ $fIdx }}" style="border: 1px solid #dcd3c6; background: #fff; margin-bottom: 0;">
                                        <div class="adm-card-head" style="padding: 10px 16px; background: #fdfcfb;">
                                            <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                                                <span class="adm-chip" style="font-weight: 700;">#{{ $fIdx + 1 }}</span>
                                                <input type="text" name="sections[floor_plans][items][{{ $fIdx }}][title]" value="{{ $plan['title'] ?? '' }}" class="adm-input" placeholder="Layout Title (e.g. 1 Bedroom Apartment – Type A)" style="font-weight: 700; max-width: 360px;">
                                            </div>
                                            <div class="adm-repeater-actions-head">
                                                <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('floor_plan_card_{{ $fIdx }}').remove()">
                                                    @include('admin.partials.icon', ['name' => 'trash']) Delete Layout
                                                </button>
                                            </div>
                                        </div>
                                        <div class="adm-card-body" style="padding: 16px;">
                                            <div style="display: flex; gap: 20px; align-items: flex-start; margin-bottom: 14px;">
                                                <div style="width: 140px; height: 100px; border-radius: 6px; overflow: hidden; background: #f5f2ed; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #d4c7b5;">
                                                    <img id="preview_floor_{{ $fIdx }}" src="{{ $plan['image'] ?? '/images/placeholder.svg' }}" alt="Floor Plan Preview" style="width: 100%; height: 100%; object-fit: contain;">
                                                </div>
                                                <div style="flex: 1;">
                                                    <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Blueprint Image URL / Path</label>
                                                    <input type="text" name="sections[floor_plans][items][{{ $fIdx }}][image]" id="input_floor_{{ $fIdx }}" value="{{ $plan['image'] ?? '' }}" class="adm-input" placeholder="/images/nawayef-park-views/asset_48.png" oninput="document.getElementById('preview_floor_{{ $fIdx }}').src = this.value">
                                                    <label class="adm-label" style="font-size: 11px; margin-top: 8px; margin-bottom: 2px;">Or Upload New Blueprint Image</label>
                                                    <input type="file" name="section_files[floor_plans][items][{{ $fIdx }}][image]" class="adm-input" accept="image/*" onchange="previewUploadedImage(this, 'preview_floor_{{ $fIdx }}', 'input_floor_{{ $fIdx }}')">
                                                </div>
                                            </div>

                                            <div class="adm-field">
                                                <label class="adm-label">Layout Description</label>
                                                <textarea name="sections[floor_plans][items][{{ $fIdx }}][description]" class="adm-textarea adm-summernote" rows="2" placeholder="Description of this apartment/villa floor plan...">{{ $plan['description'] ?? '' }}</textarea>
                                            </div>

                                            <div class="adm-grid-4-col" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;">
                                                <div class="adm-field" style="margin-bottom:0;">
                                                    <label class="adm-label" style="font-size:11px;">Bedrooms</label>
                                                    <input type="text" name="sections[floor_plans][items][{{ $fIdx }}][bedrooms]" value="{{ $plan['bedrooms'] ?? '' }}" class="adm-input" placeholder="e.g. 1">
                                                </div>
                                                <div class="adm-field" style="margin-bottom:0;">
                                                    <label class="adm-label" style="font-size:11px;">Bathrooms</label>
                                                    <input type="text" name="sections[floor_plans][items][{{ $fIdx }}][bathrooms]" value="{{ $plan['bathrooms'] ?? '' }}" class="adm-input" placeholder="e.g. 2">
                                                </div>
                                                <div class="adm-field" style="margin-bottom:0;">
                                                    <label class="adm-label" style="font-size:11px;">Parking Spaces</label>
                                                    <input type="text" name="sections[floor_plans][items][{{ $fIdx }}][parking]" value="{{ $plan['parking'] ?? '' }}" class="adm-input" placeholder="e.g. 1">
                                                </div>
                                                <div class="adm-field" style="margin-bottom:0;">
                                                    <label class="adm-label" style="font-size:11px;">Total Area (sqft)</label>
                                                    <input type="text" name="sections[floor_plans][items][{{ $fIdx }}][area]" value="{{ $plan['area'] ?? '' }}" class="adm-input" placeholder="e.g. 1090">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'gallery')
            <!-- PROJECT GALLERY TAB -->
            <div id="tab-gallery" class="tab-pane {{ $currentTab === 'gallery' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Project Gallery</h2>
                            <p>Manage high-resolution gallery images, photography captions, and carousel views.</p>
                        </div>
                        <span class="adm-chip">gallery</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label">Gallery Heading</label>
                            <input type="text" name="sections[gallery][title]" value="{{ old('sections.gallery.title', $sContent['title'] ?? ($page->title . ' Gallery')) }}" class="adm-input" placeholder="e.g. Wadeem Gardens Gallery">
                        </div>

                        @php
                            $galImages = $sContent['images'] ?? [];
                            if (!is_array($galImages)) $galImages = [];
                            $galImages = array_slice($galImages, 0, 10);
                        @endphp
                        <div class="adm-repeater-wrap" style="margin-top: 20px;">
                            <div class="adm-repeater-intro" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; flex-wrap: wrap; gap: 10px;">
                                <div>
                                    <h3 style="margin: 0; font-size: 15px; font-weight: 700; color: #1a1a1a;">
                                        Gallery Photos (<span id="galleryCount">{{ count($galImages) }}</span>/10)
                                    </h3>
                                    <p style="margin: 3px 0 0; font-size: 12.5px; color: #736b5e;">
                                        Drag &amp; drop images to reorder. Supported: JPG, WEBP (Max 2MB, up to 10 photos).
                                    </p>
                                </div>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <input type="file" id="galleryFileInput" accept=".jpg,.jpeg,.webp,image/jpeg,image/webp" multiple style="display: none;" onchange="handleGalleryFilesSelected(this)">
                                    <button type="button" class="adm-btn adm-btn-primary adm-btn-sm" id="addGalleryBtn" onclick="triggerGalleryUpload()" style="display: inline-flex; align-items: center; gap: 6px;">
                                        @include('admin.partials.icon', ['name' => 'plus']) Add Images
                                    </button>
                                </div>
                            </div>

                            <div id="gallery_images_container" style="display: flex; flex-direction: column; gap: 10px;">
                                @foreach($galImages as $gIdx => $gImg)
                                    <div class="adm-gal-row" id="gal_row_{{ $gIdx }}" draggable="true" data-index="{{ $gIdx }}" style="display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid #e2dad0; border-radius: 8px; padding: 10px 14px; transition: all 0.2s; cursor: default;">
                                        <div class="adm-gal-handle" title="Drag to reorder" style="cursor: grab; color: #9c9182; font-size: 18px; user-select: none; display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 4px; background: #faf8f5;">
                                            ⇅
                                        </div>
                                        <div class="adm-gal-num" style="font-size: 12px; font-weight: 700; color: #847565; min-width: 28px;">
                                            #{{ $gIdx + 1 }}
                                        </div>
                                        <div style="width: 120px; height: 75px; border-radius: 6px; overflow: hidden; background: #1a1a1a; flex-shrink: 0; border: 1px solid #dcd3c6; display: flex; align-items: center; justify-content: center;">
                                            <img class="adm-gal-thumb" src="{{ $gImg['src'] ?? '' }}" alt="Photo {{ $gIdx + 1 }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                        <div style="flex: 1; min-width: 0;">
                                            <div class="adm-gal-name" style="font-size: 13px; font-weight: 600; color: #2d261e; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                {{ basename($gImg['src'] ?? ('Photo ' . ($gIdx + 1))) }}
                                            </div>
                                            <div style="font-size: 11px; color: #9c9182; margin-top: 2px;">
                                                JPG / WEBP Image
                                            </div>
                                        </div>
                                        <input type="hidden" class="adm-gal-src" name="sections[gallery][images][{{ $gIdx }}][src]" value="{{ $gImg['src'] ?? '' }}">
                                        <input type="hidden" class="adm-gal-alt" name="sections[gallery][images][{{ $gIdx }}][alt]" value="{{ $gImg['alt'] ?? 'Project Photo' }}">
                                        <input type="hidden" class="adm-gal-cat" name="sections[gallery][images][{{ $gIdx }}][category]" value="{{ $gImg['category'] ?? 'Exterior' }}">
                                        <button type="button" class="adm-gal-del" onclick="deleteGalleryRow(this)" title="Delete Image" style="background: #fbf7f4; border: 1px solid #eddcd0; color: #b43b3b; width: 34px; height: 34px; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 15px; font-weight: bold; transition: all 0.2s;">
                                            ✕
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'master_plan')
            <!-- MASTER PLAN TAB -->
            <div id="tab-master_plan" class="tab-pane {{ $currentTab === 'master_plan' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Master Plan</h2>
                            <p>Manage the master layout blueprint graphic, title, and modal zoom settings.</p>
                        </div>
                        <span class="adm-chip">master_plan</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[master_plan][title]" value="{{ old('sections.master_plan.title', $sContent['title'] ?? ($page->title . ' Master Plan')) }}" class="adm-input" placeholder="e.g. Wadeem Gardens Master Plan">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Zoom Button Text</label>
                            <input type="text" name="sections[master_plan][badge]" value="{{ $sContent['badge'] ?? 'Click to Enlarge' }}" class="adm-input" placeholder="Click to Enlarge">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Master Plan Blueprint Image</label>
                            <div style="background: #faf8f5; border: 1px solid #e8e1d7; border-radius: 8px; padding: 18px;">
                                <div style="width: 100%; max-height: 280px; background: #1a1a1a; border-radius: 6px; overflow: hidden; display: flex; align-items: center; justify-content: center; margin-bottom: 14px;">
                                    <img id="preview_master_img" src="{{ $sContent['image'] ?? ('/images/' . $page->slug . '/master-plan.png') }}" alt="Master Plan Preview" style="max-width: 100%; max-height: 280px; object-fit: contain;">
                                </div>
                                <div class="adm-grid-2-col">
                                    <div>
                                        <label class="adm-label" style="font-size: 12px;">Image Path / URL</label>
                                        <input type="text" name="sections[master_plan][image]" id="input_master_img" value="{{ $sContent['image'] ?? ('/images/' . $page->slug . '/master-plan.png') }}" class="adm-input" oninput="document.getElementById('preview_master_img').src = this.value">
                                    </div>
                                    <div>
                                        <label class="adm-label" style="font-size: 12px;">Upload New Master Plan File</label>
                                        <input type="file" name="section_files[master_plan][image]" class="adm-input" accept="image/*" onchange="previewUploadedImage(this, 'preview_master_img', 'input_master_img')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'about')
            <!-- ABOUT COMMUNITY & VIDEO TAB -->
            <div id="tab-about" class="tab-pane {{ $currentTab === 'about' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>About Community &amp; Video</h2>
                            <p>Manage community story, detailed narrative paragraphs, video stream URL, and cover poster.</p>
                        </div>
                        <span class="adm-chip">about</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label">Headline / Title</label>
                            <input type="text" name="sections[about][title]" value="{{ old('sections.about.title', $sContent['title'] ?? ($page->title . ' by Modon')) }}" class="adm-input" placeholder="e.g. Wadeem Gardens by Modon">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Community Overview &amp; Narrative</label>
                            <textarea name="sections[about][description]" class="adm-textarea adm-summernote" rows="6" placeholder="Detailed story, architectural styling, villa sizes, and lifestyle details...">{{ old('sections.about.description', $sContent['description'] ?? '') }}</textarea>
                            <div class="adm-help">Line breaks create clean separate paragraphs on the live page.</div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Featured Video Stream URL (.mp4 or link)</label>
                            <input type="text" name="sections[about][video_url]" value="{{ $sContent['video_url'] ?? '' }}" class="adm-input" placeholder="https://www.hudayriyat-island.com/storage/...mp4">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Video Poster / Cover Image</label>
                            <div style="display: flex; gap: 16px; align-items: flex-start; background: #faf8f5; border: 1px solid #e8e1d7; border-radius: 8px; padding: 14px;">
                                <div style="width: 130px; height: 85px; border-radius: 6px; overflow: hidden; background: #1a1a1a; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <img id="preview_about_poster" src="{{ $sContent['video_poster'] ?? ('/images/' . $page->slug . '/video-poster.png') }}" alt="Poster" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                                <div style="flex: 1;">
                                    <label class="adm-label" style="font-size: 11px;">Poster Image URL</label>
                                    <input type="text" name="sections[about][video_poster]" id="input_about_poster" value="{{ $sContent['video_poster'] ?? ('/images/' . $page->slug . '/video-poster.png') }}" class="adm-input" oninput="document.getElementById('preview_about_poster').src = this.value">
                                    <div style="margin-top: 8px;">
                                        <label class="adm-label" style="font-size: 11px;">Upload New Poster</label>
                                        <input type="file" name="section_files[about][video_poster]" class="adm-input" accept="image/*" onchange="previewUploadedImage(this, 'preview_about_poster', 'input_about_poster')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'amenities')
            <!-- AMENITIES & FACILITIES TAB -->
            <div id="tab-amenities" class="tab-pane {{ $currentTab === 'amenities' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Amenities &amp; Facilities</h2>
                            <p>Manage community amenities heading, lifestyle subtitle, and interactive facility cards with icons.</p>
                        </div>
                        <span class="adm-chip">amenities</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[amenities][title]" value="{{ old('sections.amenities.title', $sContent['title'] ?? ($page->title . ' Amenities')) }}" class="adm-input" placeholder="e.g. Wadeem Gardens Amenities">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Subtitle / Lifestyle Description</label>
                            <textarea name="sections[amenities][subtitle]" class="adm-textarea" rows="3" placeholder="Describe the lifestyle amenities and resident conveniences...">{{ old('sections.amenities.subtitle', $sContent['subtitle'] ?? '') }}</textarea>
                        </div>

                        @php
                            $amenitiesItems = $sContent['items'] ?? [];
                        @endphp
                        <div class="adm-repeater-wrap" style="margin-top: 20px;">
                            <div class="adm-repeater-intro">
                                <div>
                                    <h3>Amenities Grid Cards (<span id="amenitiesCount">{{ count($amenitiesItems) }}</span>)</h3>
                                    <p>Add, edit, or remove amenities with custom icon images.</p>
                                </div>
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addAmenityCard()">
                                    @include('admin.partials.icon', ['name' => 'plus']) Add Amenity
                                </button>
                            </div>

                            <div id="amenities_cards_container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 14px;">
                                @foreach($amenitiesItems as $aIdx => $aItem)
                                    <div class="adm-card" id="amenity_card_{{ $aIdx }}" style="border: 1px solid #dcd3c6; background: #fff; margin-bottom: 0; padding: 14px;">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                                            <div style="width: 44px; height: 44px; border-radius: 6px; background: #faf8f5; border: 1px solid #e0d7cb; display: flex; align-items: center; justify-content: center;">
                                                <img id="preview_amenity_{{ $aIdx }}" src="{{ $aItem['icon'] ?? '/images/wadeem-gardens/amenity-club.png' }}" alt="Icon" style="width: 28px; height: 28px; object-fit: contain;">
                                            </div>
                                            <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('amenity_card_{{ $aIdx }}').remove()" style="padding: 4px 8px; font-size: 11px;">
                                                ✕ Delete
                                            </button>
                                        </div>
                                        <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Amenity Name</label>
                                        <input type="text" name="sections[amenities][items][{{ $aIdx }}][name]" value="{{ $aItem['name'] ?? '' }}" class="adm-input" placeholder="e.g. Clubhouses" style="font-size: 12px; font-weight: 600; margin-bottom: 8px;">
                                        <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Icon URL</label>
                                        <input type="text" name="sections[amenities][items][{{ $aIdx }}][icon]" id="input_amenity_{{ $aIdx }}" value="{{ $aItem['icon'] ?? '' }}" class="adm-input" placeholder="/images/...png" style="font-size: 11px;" oninput="document.getElementById('preview_amenity_{{ $aIdx }}').src = this.value">
                                        <label class="adm-label" style="font-size: 11px; margin-top: 6px; margin-bottom: 2px;">Upload Icon</label>
                                        <input type="file" name="section_files[amenities][items][{{ $aIdx }}][icon]" class="adm-input" accept="image/*" style="font-size: 10px; padding: 3px;" onchange="previewUploadedImage(this, 'preview_amenity_{{ $aIdx }}', 'input_amenity_{{ $aIdx }}')">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @elseif($sec->section_key === 'payment_methods' && $page->slug !== '/')
            <!-- PAYMENT METHODS TAB (COMMUNITIES) -->
            <div id="tab-payment_methods" class="tab-pane {{ $currentTab === 'payment_methods' ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>Payment Methods</h2>
                            <p>Manage accepted payment gateways and icons (Card, Cheque, Cash, Bitcoin).</p>
                        </div>
                        <span class="adm-chip">payment_methods</span>
                    </div>
                    <div class="adm-card-body">
                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[payment_methods][title]" value="{{ old('sections.payment_methods.title', $sContent['title'] ?? ($page->title . ' Payment Methods')) }}" class="adm-input" placeholder="e.g. Wadeem Gardens Payment Methods">
                        </div>
                        <div class="adm-field">
                            <label class="adm-label">Subtitle</label>
                            <input type="text" name="sections[payment_methods][subtitle]" value="{{ old('sections.payment_methods.subtitle', $sContent['subtitle'] ?? 'We accept all the following payment methods.') }}" class="adm-input">
                        </div>
                        @php
                            $payMethods = $sContent['items'] ?? [
                                ['name' => 'Card', 'icon' => '/images/payments/card.png'],
                                ['name' => 'Cheque', 'icon' => '/images/payments/cheque.png'],
                                ['name' => 'Cash', 'icon' => '/images/payments/cash.png'],
                                ['name' => 'Bitcoin', 'icon' => '/images/payments/bitcoin.png'],
                            ];
                        @endphp
                        <div class="adm-grid-2-col" style="margin-top: 16px;">
                            @foreach($payMethods as $pmIdx => $pm)
                                <div class="adm-card" style="border: 1px solid #e0d7cb; background: #fff; margin-bottom: 0; padding: 14px; display: flex; gap: 14px; align-items: center;">
                                    <div style="width: 50px; height: 50px; background: #faf8f5; border: 1px solid #d4c7b5; border-radius: 6px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <img id="preview_pm_{{ $pmIdx }}" src="{{ $pm['icon'] ?? '' }}" alt="{{ $pm['name'] ?? '' }}" style="width: 38px; height: 38px; object-fit: contain;">
                                    </div>
                                    <div style="flex: 1;">
                                        <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Method Name</label>
                                        <input type="text" name="sections[payment_methods][items][{{ $pmIdx }}][name]" value="{{ $pm['name'] ?? '' }}" class="adm-input" style="font-size: 12px; font-weight: 700; margin-bottom: 6px;">
                                        <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Icon URL</label>
                                        <input type="text" name="sections[payment_methods][items][{{ $pmIdx }}][icon]" id="input_pm_{{ $pmIdx }}" value="{{ $pm['icon'] ?? '' }}" class="adm-input" style="font-size: 11px;" oninput="document.getElementById('preview_pm_{{ $pmIdx }}').src = this.value">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- DEFAULT / OVERVIEW / GENERIC SECTION TAB -->
            <div id="tab-{{ $sec->section_key }}" class="tab-pane {{ $currentTab === $sec->section_key ? 'active' : '' }}">
                <div class="adm-card">
                    <div class="adm-card-head">
                        <div>
                            <h2>{{ $sec->section_name }}</h2>
                            <p>Configure text, key values and content blocks for this section.</p>
                        </div>
                        <span class="adm-chip">{{ $sec->section_key }}</span>
                    </div>
                    <div class="adm-card-body">
                        @forelse($sContent as $fieldKey => $fieldVal)
                            <div class="adm-field">
                                <label class="adm-label" for="sec_{{ $sec->section_key }}_{{ $fieldKey }}">
                                    <span>{{ ucwords(str_replace('_', ' ', $fieldKey)) }}</span>
                                    <span class="adm-chip">{{ $fieldKey }}</span>
                                </label>

                                @if($fieldKey === 'items' && is_array($fieldVal))
                                    <div class="adm-repeater-wrap">
                                        <input type="hidden" name="sections[{{ $sec->section_key }}][_has_items]" value="1">
                                        <div class="adm-repeater-intro">
                                            <div>
                                                <h3>Community Rundown Items (<span id="repeaterCount_{{ $sec->section_key }}">{{ count($fieldVal) }}</span>)</h3>
                                                <p>Drag any community card using the ⇅ handle to change the order. Add, edit, or delete items.</p>
                                            </div>
                                            <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addRepeaterItem('{{ $sec->section_key }}')">
                                                @include('admin.partials.icon', ['name' => 'plus']) Add Community
                                            </button>
                                        </div>

                                        <div class="adm-repeater-toolbar">
                                            <div class="adm-collapse-links">
                                                <button type="button" class="adm-link-btn" onclick="toggleCollapseAll(this, 'repeater_{{ $sec->section_key }}_items')">Collapse all</button>
                                                <span>|</span>
                                                <button type="button" class="adm-link-btn" onclick="toggleExpandAll(this, 'repeater_{{ $sec->section_key }}_items')">Expand all</button>
                                            </div>
                                        </div>

                                        <div class="adm-repeater-list" id="repeater_{{ $sec->section_key }}_items">
                                            @foreach($fieldVal as $idx => $item)
                                                <div class="adm-repeater-item" id="repeater_item_{{ $sec->section_key }}_{{ $idx }}" draggable="true">
                                                    <div class="adm-repeater-head">
                                                        <div class="adm-repeater-title-wrap">
                                                            <div class="adm-drag-handle" title="Drag to reorder">
                                                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                                                    <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                                                                    <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                                                                </svg>
                                                            </div>
                                                            <span class="adm-repeater-badge">#{{ $idx + 1 }}</span>
                                                            <strong class="adm-repeater-heading-text">{{ $item['title'] ?? ('Community ' . ($idx + 1)) }}</strong>
                                                        </div>
                                                        <div class="adm-repeater-actions-head">
                                                            <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                                                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                                                            </button>
                                                            <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, '{{ $sec->section_key }}')">
                                                                @include('admin.partials.icon', ['name' => 'trash']) Delete
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="adm-repeater-body">
                                                        <div class="adm-field">
                                                            <label class="adm-label">Community / Project Title</label>
                                                            <input type="text"
                                                                   name="sections[{{ $sec->section_key }}][items][{{ $idx }}][title]"
                                                                   value="{{ $item['title'] ?? '' }}"
                                                                   class="adm-input adm-repeater-title-input"
                                                                   placeholder="e.g. Wadeem Gardens"
                                                                   
                                                                   oninput="updateCardHeading(this)">
                                                        </div>
                                                        <div class="adm-field" style="margin-top:12px; margin-bottom:0;">
                                                            <label class="adm-label">Community Description &amp; Details</label>
                                                            <textarea name="sections[{{ $sec->section_key }}][items][{{ $idx }}][description]"
                                                                      class="adm-textarea adm-summernote"
                                                                      rows="4"
                                                                      placeholder="Full details and description for this community..."
                                                                      >{{ $item['description'] ?? '' }}</textarea>
                                                            <div class="adm-help">Double enter (blank line) creates a new paragraph on the website.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <div class="adm-repeater-actions">
                                            <button type="button" class="adm-btn adm-btn-ghost" onclick="addRepeaterItem('{{ $sec->section_key }}')">
                                                @include('admin.partials.icon', ['name' => 'plus']) Add Another Community
                                            </button>
                                        </div>
                                    </div>
                                @elseif(is_array($fieldVal))
                                    <textarea id="sec_{{ $sec->section_key }}_{{ $fieldKey }}" name="sections[{{ $sec->section_key }}][{{ $fieldKey }}]" class="adm-textarea" rows="4">{{ json_encode($fieldVal, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</textarea>
                                    <div class="adm-help">JSON format</div>
                                @elseif(strlen($fieldVal ?? '') > 80 || str_contains($fieldVal ?? '', "\n"))
                                    <textarea id="sec_{{ $sec->section_key }}_{{ $fieldKey }}" name="sections[{{ $sec->section_key }}][{{ $fieldKey }}]" class="adm-textarea" rows="3">{{ $fieldVal }}</textarea>
                                @else
                                    <input type="text" id="sec_{{ $sec->section_key }}_{{ $fieldKey }}" name="sections[{{ $sec->section_key }}][{{ $fieldKey }}]" value="{{ $fieldVal }}" class="adm-input">
                                @endif
                            </div>
                        @empty
                            <div class="adm-empty">
                                @include('admin.partials.icon', ['name' => 'edit'])
                                <h3>No dynamic fields registered yet</h3>
                                <p>This section is active. You can add custom fields using the tool below.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <!-- 4. SEO & META TAB -->
    <div id="tab-seo" class="tab-pane {{ $currentTab === 'seo' ? 'active' : '' }}">
        <div class="adm-card">
            <div class="adm-card-head">
                <div>
                    <h2>SEO &amp; Social Metadata</h2>
                    <p>Optimize search engine presence, page titles, and OpenGraph social preview sharing.</p>
                </div>
            </div>
            <div class="adm-card-body">
                <div class="adm-field">
                    <label class="adm-label" for="metaTitle">Meta Title (&lt;title&gt;)</label>
                    <input type="text" id="metaTitle" name="meta_title" value="{{ old('meta_title', $page->meta_title) }}" class="adm-input" placeholder="e.g. Hudayriyat Island – Luxury Villas in Abu Dhabi">
                    <div class="adm-help">Optimal length: 50–60 characters.</div>
                </div>

                <div class="adm-field">
                    <label class="adm-label" for="metaDesc">Meta Description</label>
                    <textarea id="metaDesc" name="meta_description" class="adm-textarea" rows="3" placeholder="Brief summary for search engine snippets (120–160 characters)...">{{ old('meta_description', $page->meta_description) }}</textarea>
                </div>

                <div class="adm-field">
                    <label class="adm-label" for="metaKeywords">Meta Keywords</label>
                    <input type="text" id="metaKeywords" name="meta_keywords" value="{{ old('meta_keywords', $page->meta_keywords) }}" class="adm-input" placeholder="Hudayriyat Island, Luxury Villas, Modon Properties">
                    <div class="adm-help">Comma-separated keyword list.</div>
                </div>


            </div>
        </div>
    </div>

    <!-- Sticky Save Bar -->
    <div class="adm-sticky-save">
        <span>Saving changes for <strong>{{ $page->title }}</strong></span>
        <button type="button" class="adm-btn adm-btn-primary" id="savePageBtn" onclick="submitEditForm(event)">
            @include('admin.partials.icon', ['name' => 'check']) <span id="saveBtnText">Save Changes</span>
        </button>
    </div>
</form>
</div>

<style>
    .tab-pane { display: none; }
    .tab-pane.active { display: block; animation: admFadeUp .35s ease both; }

    /* FAQ: simple one-row-per-FAQ editor */
    .adm-faq-wrap { margin-top: 6px; }
    .adm-faq-intro h3 { margin: 0 0 2px; font-size: 14px; }
    .adm-faq-intro p { margin: 0 0 12px; font-size: 12px; color: var(--text-muted); }
    .adm-faq-cols, .adm-faq-row {
        display: grid;
        grid-template-columns: 34px minmax(0, 1fr) minmax(0, 1.6fr) 34px;
        gap: 10px;
        align-items: start;
    }
    .adm-faq-cols { padding: 0 10px; margin-bottom: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .04em; color: var(--text-muted); }
    .adm-faq-list { display: flex; flex-direction: column; gap: 8px; }
    .adm-faq-row { padding: 8px 10px; overflow: visible; }
    .adm-faq-row .adm-repeater-head.adm-faq-handle { padding: 0; background: none; border: 0; display: block; }
    .adm-faq-row .adm-drag-handle { width: 34px; height: 36px; }
    .adm-faq-row .adm-input, .adm-faq-row .adm-textarea { margin: 0; width: 100%; min-height: 36px; font-size: 13px; }
    .adm-faq-row .adm-textarea { resize: vertical; line-height: 1.4; }
    .adm-faq-del {
        width: 34px; height: 36px; border: 1px solid #fecaca; background: #fef2f2; color: #b91c1c;
        border-radius: 8px; cursor: pointer; font-size: 14px; line-height: 1; transition: all .15s ease;
    }
    .adm-faq-del:hover { background: #b91c1c; color: #fff; border-color: #b91c1c; }
    .adm-faq-add {
        margin-top: 12px; padding: 6px 14px; font-size: 12.5px; font-weight: 600; cursor: pointer;
        border: 1px dashed #1a4731; color: #1a4731; background: #faf8f5; border-radius: 8px; transition: all .15s ease;
    }
    .adm-faq-add:hover { background: #1a4731; color: #fff; border-style: solid; }
    @media (max-width: 700px) {
        .adm-faq-cols { display: none; }
        .adm-faq-row { grid-template-columns: 34px 1fr 34px; }
        .adm-faq-row .adm-textarea { grid-column: 2 / 3; }
    }

    /* Gallery: single vertical list */
    .adm-gal-row {
        transition: transform .15s ease, box-shadow .15s ease, border-color .15s ease;
    }
    .adm-gal-row:hover {
        border-color: #bfa88f !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .adm-gal-handle:hover {
        background: #f0ebe1 !important;
        color: #4a3f35 !important;
    }
    .adm-gal-del:hover {
        background: #a93333 !important;
        border-color: #a93333 !important;
        color: #ffffff !important;
    }

    /* Vertical sidebar tabs (Pages & Projects editor) */
    .adm-edit-layout {
        display: flex;
        align-items: flex-start;
        gap: 20px;
    }
    .adm-edit-layout > #pageSectionTabs {
        flex: 0 0 250px;
        width: 250px;
        flex-direction: column;
        flex-wrap: nowrap;
        gap: 6px;
        margin-bottom: 0;
        position: sticky;
        top: 16px;
        height: calc(100vh - 190px);
        max-height: calc(100vh - 190px);
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #c9b9a4 transparent;
    }
    .adm-edit-layout > #pageSectionTabs .adm-tab {
        display: flex;
        width: 100%;
        justify-content: flex-start;
        white-space: normal;
        text-align: left;
    }
    .adm-edit-layout > #pageSectionTabs .adm-tab:hover { transform: translateX(2px); }
    .adm-edit-layout > #pageSectionTabs .adm-draggable-tabs-group {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        flex-wrap: nowrap;
        gap: 6px;
        width: 100%;
    }
    .adm-edit-layout > #pageSectionTabs .adm-tab-toast { align-self: flex-start; }
    .adm-edit-layout > #pageEditForm {
        flex: 1 1 0;
        min-width: 0;
        position: sticky;
        top: 16px;
        height: calc(100vh - 190px);
        max-height: calc(100vh - 190px);
        overflow-y: auto;
        overscroll-behavior: contain;
        padding-right: 8px;
        padding-bottom: 24px;
        box-sizing: border-box;
        scrollbar-width: thin;
        scrollbar-color: #c9b9a4 transparent;
    }
    .adm-edit-layout > #pageEditForm::-webkit-scrollbar { width: 8px; }
    .adm-edit-layout > #pageEditForm::-webkit-scrollbar-thumb { background: #c9b9a4; border-radius: 8px; }

    .adm-edit-layout .tab-pane {
        padding-bottom: 20px;
    }

    .adm-edit-layout .adm-sticky-save {
        position: sticky;
        bottom: 0 !important;
        z-index: 100;
        margin-top: 16px;
        margin-bottom: 4px;
        background: rgba(255, 255, 255, 0.98) !important;
        border: 1px solid #d4c7b5 !important;
        box-shadow: 0 -4px 18px rgba(0, 0, 0, 0.08) !important;
    }

    @media (max-width: 900px) {
        .adm-edit-layout { flex-direction: column; }
        .adm-edit-layout > #pageSectionTabs {
            flex: none; width: 100%; position: static; height: auto; max-height: none;
            flex-direction: row; flex-wrap: wrap;
        }
        .adm-edit-layout > #pageSectionTabs .adm-tab { width: auto; }
        .adm-edit-layout > #pageSectionTabs .adm-draggable-tabs-group { flex-direction: row; flex-wrap: wrap; width: auto; }
        .adm-edit-layout > #pageEditForm { width: 100%; position: static; height: auto; max-height: none; overflow: visible; padding-right: 0; }
    }

    /* Highlights Repeater: Metric Name Dropdown with SVG Icons */
    #repeater_highlights_items .adm-repeater-item,
    #repeater_highlights_items .adm-repeater-body {
        overflow: visible !important;
    }
    .adm-metric-input-wrap {
        position: relative;
        width: 100%;
    }
    .adm-metric-input-group {
        display: flex;
        align-items: center;
        position: relative;
        width: 100%;
    }
    .adm-metric-prefix-icon {
        position: absolute;
        left: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: #eaf1ed;
        color: #234937;
        pointer-events: none;
        z-index: 2;
        transition: color .2s, background .2s;
    }
    .adm-metric-prefix-icon svg {
        width: 17px;
        height: 17px;
    }
    .adm-metric-input {
        padding-left: 46px !important;
        padding-right: 38px !important;
        width: 100% !important;
    }
    .adm-metric-dropdown-btn {
        position: absolute;
        right: 8px;
        top: 50%;
        transform: translateY(-50%);
        width: 26px;
        height: 26px;
        border: 1px solid #d2dbe5;
        border-radius: 6px;
        background: #f8fafc;
        color: #475569;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all .15s ease;
        z-index: 2;
    }
    .adm-metric-dropdown-btn:hover {
        background: #e2e8f0;
        color: #1e293b;
        border-color: #94a3b8;
    }
    .adm-metric-menu {
        display: none;
        position: absolute;
        top: calc(100% + 4px);
        left: 0;
        right: 0;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.15), 0 8px 10px -6px rgba(0,0,0,0.1);
        z-index: 1050;
        max-height: 240px;
        overflow-y: auto;
        padding: 6px;
    }
    .adm-metric-menu.show {
        display: block;
        animation: admMetricFadeIn .15s ease-out;
    }
    @keyframes admMetricFadeIn {
        from { opacity: 0; transform: translateY(-4px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .adm-metric-menu-header {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        color: #64748b;
        padding: 6px 10px 4px;
        border-bottom: 1px solid #f1f5f9;
        margin-bottom: 4px;
    }
    .adm-metric-menu-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 8px 10px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13.5px;
        font-weight: 500;
        color: #1e293b;
        transition: background .12s, color .12s;
    }
    .adm-metric-menu-item:hover {
        background: #f1f5f9;
        color: #234937;
    }
    .adm-metric-menu-item-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #234937;
        flex-shrink: 0;
    }
    .adm-metric-menu-item:hover .adm-metric-menu-item-icon {
        background: #eaf1ed;
        color: #1b3d2d;
    }
    .adm-metric-menu-item-icon svg {
        width: 17px;
        height: 17px;
    }
    .adm-metric-menu-item-label {
        flex: 1;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>

@push('scripts')
<script>
    function switchTab(tabId) {
        // Toggle tab panes
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.remove('active'));
        const activePane = document.getElementById('tab-' + tabId);
        if (activePane) {
            activePane.classList.add('active');
            if (window.initSummernote) window.initSummernote('#tab-' + tabId + ' .adm-summernote');
        }

        // Toggle button states
        document.querySelectorAll('.adm-tabs .adm-tab').forEach(btn => {
            if (btn.getAttribute('data-tab-id') === tabId) {
                btn.classList.add('is-active');
            } else {
                btn.classList.remove('is-active');
            }
        });

        // Update hidden input and URL state
        const tabInput = document.getElementById('activeTabInput');
        if (tabInput) tabInput.value = tabId;
        const newUrl = new URL(window.location.href);
        newUrl.searchParams.set('tab', tabId);
        window.history.replaceState({}, '', newUrl);
    }

    // Dynamic viewport height calculation so the bottom save button is always completely visible
    function adjustEditLayoutHeight() {
        if (window.innerWidth <= 900) return;
        const form = document.getElementById('pageEditForm');
        const tabs = document.getElementById('pageSectionTabs');
        if (!form) return;
        const rect = form.getBoundingClientRect();
        const availableHeight = Math.max(350, Math.floor(window.innerHeight - rect.top - 18));
        form.style.height = availableHeight + 'px';
        form.style.maxHeight = availableHeight + 'px';
        if (tabs) {
            tabs.style.height = availableHeight + 'px';
            tabs.style.maxHeight = availableHeight + 'px';
        }
    }

    window.addEventListener('resize', adjustEditLayoutHeight);
    window.addEventListener('scroll', adjustEditLayoutHeight, { passive: true });
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', adjustEditLayoutHeight);
    } else {
        adjustEditLayoutHeight();
    }
    setTimeout(adjustEditLayoutHeight, 150);

    // Automatically sync Hero Main Heading (H1) text to Hero Image Alt Text (SEO)
    function syncHeroTitleToAlt(val) {
        const altInput = document.getElementById('heroBgImageAlt');
        if (altInput) {
            altInput.value = (val || '').replace(/[\r\n]+/g, ' ').replace(/\s+/g, ' ').trim();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const heroTitleEl = document.getElementById('heroTitle');
        const heroAltEl = document.getElementById('heroBgImageAlt');
        if (heroTitleEl && heroAltEl) {
            heroTitleEl.addEventListener('input', function() {
                syncHeroTitleToAlt(this.value);
            });
            heroTitleEl.addEventListener('change', function() {
                syncHeroTitleToAlt(this.value);
            });
        }
    });

    let currentDraggedTab = null;
    let isTabDragging = false;

    function handleTabClick(event, sectionKey) {
        if (isTabDragging) {
            event.preventDefault();
            event.stopPropagation();
            return false;
        }
        switchTab(sectionKey);
    }

    function setupDraggableTabs() {
        const container = document.getElementById('draggableTabsContainer');
        if (!container) return;

        const tabs = container.querySelectorAll('.adm-tab-draggable');
        tabs.forEach(tab => {
            tab.setAttribute('draggable', 'true');

            tab.addEventListener('dragstart', function(e) {
                isTabDragging = true;
                currentDraggedTab = tab;
                tab.classList.add('is-dragging');
                e.dataTransfer.effectAllowed = 'move';
                e.dataTransfer.setData('text/plain', tab.getAttribute('data-section-key'));

                setTimeout(() => {
                    if (currentDraggedTab === tab) {
                        tab.style.opacity = '0.35';
                    }
                }, 0);
            });

            tab.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';

                if (!currentDraggedTab || currentDraggedTab === tab) return;
                if (currentDraggedTab.parentNode !== container) return;

                const rect = tab.getBoundingClientRect();
                const midpoint = rect.left + rect.width / 2;

                if (e.clientX < midpoint) {
                    if (tab.previousElementSibling !== currentDraggedTab) {
                        container.insertBefore(currentDraggedTab, tab);
                    }
                } else {
                    if (tab.nextElementSibling !== currentDraggedTab) {
                        container.insertBefore(currentDraggedTab, tab.nextElementSibling);
                    }
                }
            });

            tab.addEventListener('dragend', function() {
                tab.classList.remove('is-dragging');
                tab.style.opacity = '';
                currentDraggedTab = null;

                setTimeout(() => {
                    isTabDragging = false;
                }, 120);

                saveSectionTabOrder();
            });

            tab.addEventListener('drop', function(e) {
                e.preventDefault();
                saveSectionTabOrder();
            });
        });

        container.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
        });

        container.addEventListener('drop', function(e) {
            e.preventDefault();
            saveSectionTabOrder();
        });
    }

    function saveSectionTabOrder() {
        const container = document.getElementById('draggableTabsContainer');
        if (!container) return;

        const orderedKeys = Array.from(container.querySelectorAll('.adm-tab-draggable'))
            .map(t => t.getAttribute('data-section-key'))
            .filter(Boolean);

        // 1. Sync hidden inputs in the form
        const inputsContainer = document.getElementById('sectionOrderInputs');
        if (inputsContainer) {
            inputsContainer.innerHTML = '';
            orderedKeys.forEach(key => {
                const inp = document.createElement('input');
                inp.type = 'hidden';
                inp.name = 'section_order[]';
                inp.value = key;
                inputsContainer.appendChild(inp);
            });
        }

        // 2. Persist immediately via AJAX
        const csrfToken = document.querySelector('input[name="_token"]')?.value;
        const reorderUrl = "{{ route('admin.pages.reorder-sections', $page) }}";

        fetch(reorderUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
            },
            body: JSON.stringify({ order: orderedKeys })
        })
        .then(res => res.json())
        .then(data => {
            const toast = document.getElementById('tabReorderToast');
            if (toast) {
                toast.style.display = 'inline-flex';
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 2200);
            }
        })
        .catch(err => console.error('Error saving tab order:', err));
    }

    function previewItemImage(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const box = input.closest('.adm-img-box');
                if (box) {
                    const img = box.querySelector('img');
                    if (img) {
                        img.src = e.target.result;
                    }
                }
            };
            reader.readAsDataURL(file);
        }
    }

    function updateCardHeading(input) {
        const card = input.closest('.adm-repeater-item');
        if (!card) return;
        const heading = card.querySelector('.adm-repeater-heading-text');
        if (heading) {
            heading.textContent = input.value.trim() || 'Untitled';
        }
    }

    function updateRepeaterTitle(input) {
        updateCardHeading(input);
    }

    let currentDraggedItem = null;

    function getGroupKeyFromList(list) {
        if (!list || !list.id) return null;
        const match = list.id.match(/^repeater_(.+)_items$/);
        return match ? match[1] : null;
    }

    function setupDraggableItem(item) {
        const head = item.querySelector('.adm-repeater-head');

        // Mousedown control: enable drag when starting on handle or header
        item.addEventListener('mousedown', function(e) {
            if (e.target.closest('button, a, input, textarea, select')) {
                item.setAttribute('draggable', 'false');
            } else if (e.target.closest('.adm-drag-handle') || e.target.closest('.adm-repeater-head')) {
                item.setAttribute('draggable', 'true');
            }
        });

        // Mouse hover control
        if (head) {
            head.addEventListener('mouseenter', function() {
                item.setAttribute('draggable', 'true');
            });
            head.addEventListener('mouseleave', function() {
                if (!currentDraggedItem) {
                    item.setAttribute('draggable', 'false');
                }
            });
            head.querySelectorAll('button, a').forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    item.setAttribute('draggable', 'false');
                });
                btn.addEventListener('mouseleave', function() {
                    if (!currentDraggedItem) {
                        item.setAttribute('draggable', 'true');
                    }
                });
            });
        }

        item.addEventListener('dragstart', function(e) {
            currentDraggedItem = item;
            item.classList.add('is-dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', item.id);

            // Subtle opacity delay so the native drag ghost renders crisp
            setTimeout(() => {
                if (currentDraggedItem === item) {
                    item.style.opacity = '0.35';
                }
            }, 0);
        });

        item.addEventListener('dragover', function(e) {
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';

            if (!currentDraggedItem || currentDraggedItem === item) return;
            if (currentDraggedItem.parentNode !== item.parentNode) return;

            const rect = item.getBoundingClientRect();
            const midpoint = rect.top + rect.height / 2;

            if (e.clientY < midpoint) {
                if (item.previousElementSibling !== currentDraggedItem) {
                    item.parentNode.insertBefore(currentDraggedItem, item);
                }
            } else {
                if (item.nextElementSibling !== currentDraggedItem) {
                    item.parentNode.insertBefore(currentDraggedItem, item.nextElementSibling);
                }
            }
        });

        item.addEventListener('dragend', function() {
            item.classList.remove('is-dragging');
            item.style.opacity = '';
            item.setAttribute('draggable', 'false');

            const list = item.parentNode;
            currentDraggedItem = null;

            if (list) {
                const groupKey = getGroupKeyFromList(list);
                if (groupKey) renumberRepeaterCards(groupKey);
            }
        });

        item.addEventListener('drop', function(e) {
            e.preventDefault();
            const list = item.parentNode;
            if (list) {
                const groupKey = getGroupKeyFromList(list);
                if (groupKey) renumberRepeaterCards(groupKey);
            }
        });
    }

    function initDragAndDrop() {
        document.querySelectorAll('.adm-repeater-list').forEach(list => {
            list.addEventListener('dragover', function(e) {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
            });
            list.addEventListener('drop', function(e) {
                e.preventDefault();
                const groupKey = getGroupKeyFromList(list);
                if (groupKey) renumberRepeaterCards(groupKey);
            });

            list.querySelectorAll(':scope > .adm-repeater-item').forEach(item => {
                setupDraggableItem(item);
            });
        });

        // Initialize section tabs drag and drop reordering
        setupDraggableTabs();
    }

    // Initialize drag-drop on page load
    document.addEventListener('DOMContentLoaded', initDragAndDrop);
    initDragAndDrop();

    function toggleCollapseAll(button, listId) {
        const list = document.getElementById(listId);
        if (!list) return;
        list.querySelectorAll('.adm-repeater-item').forEach(item => item.classList.add('is-collapsed'));
    }

    function toggleExpandAll(button, listId) {
        const list = document.getElementById(listId);
        if (!list) return;
        list.querySelectorAll('.adm-repeater-item').forEach(item => item.classList.remove('is-collapsed'));
    }

    function toggleCardCollapse(button) {
        const card = button.closest('.adm-repeater-item');
        if (card) card.classList.toggle('is-collapsed');
    }

    function removeRepeaterCard(button, groupKey) {
        if (!confirm('Are you sure you want to delete this item? Changes will take effect when you click "Save Changes".')) {
            return;
        }
        const card = button.closest('.adm-repeater-item');
        if (!card) return;

        card.style.opacity = '0';
        card.style.transform = 'scale(0.96)';
        setTimeout(() => {
            card.remove();
            renumberRepeaterCards(groupKey);
        }, 200);
    }

    function removeRepeaterItem(button, sectionKey) {
        removeRepeaterCard(button, sectionKey);
    }

    function renumberRepeaterCards(groupKey) {
        const list = document.getElementById('repeater_' + groupKey + '_items');
        if (!list) return;
        const items = list.querySelectorAll(':scope > .adm-repeater-item');
        items.forEach((item, idx) => {
            const badge = item.querySelector('.adm-repeater-badge');
            if (badge) {
                badge.textContent = groupKey === 'faq' ? 'Q#' + (idx + 1) : '#' + (idx + 1);
            }

            // Re-index form field names dynamically so submission order strictly matches visual DOM order
            item.querySelectorAll('input, textarea, select').forEach(input => {
                if (input.name) {
                    input.name = input.name.replace(/\[items\]\[.*?\]/, `[items][${idx}]`);
                    input.name = input.name.replace(/\[locations\]\[.*?\]/, `[locations][${idx}]`);
                    input.name = input.name.replace(/\[investment_highlights\]\[.*?\]/, `[investment_highlights][${idx}]`);
                    input.name = input.name.replace(/\[financing_highlights\]\[.*?\]/, `[financing_highlights][${idx}]`);
                    input.name = input.name.replace(/\[benefits\]\[.*?\]/, `[benefits][${idx}]`);
                    input.name = input.name.replace(/\[features\]\[.*?\]/, `[features][${idx}]`);
                }
            });
        });
        const countBadge = document.getElementById('repeaterCount_' + groupKey);
        if (countBadge) countBadge.textContent = items.length;
    }

    function renumberRepeaterItems(sectionKey) {
        renumberRepeaterCards(sectionKey);
    }

    function addInvestmentHighlight() {
        const list = document.getElementById('repeater_inv_hl_items');
        if (!list) return;

        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;

        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `inv_hl_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';

        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                            <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Highlight Bullet</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'inv_hl')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Bullet Point Text</label>
                    <input type="text" name="sections[investment][investment_highlights][${newId}][text]" value="New Investment Highlight" class="adm-input" oninput="updateCardHeading(this)">
                </div>
            </div>
        `;

        list.appendChild(card);
        setupDraggableItem(card);

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);

        renumberRepeaterCards('inv_hl');
    }

    function addFinancingHighlight() {
        const list = document.getElementById('repeater_fin_hl_items');
        if (!list) return;

        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;

        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `fin_hl_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';

        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                            <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Financing Bullet</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'fin_hl')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Financing Point Text</label>
                    <input type="text" name="sections[investment][financing_highlights][${newId}][text]" value="New Financing Highlight Point" class="adm-input" oninput="updateCardHeading(this)">
                </div>
            </div>
        `;

        list.appendChild(card);
        setupDraggableItem(card);

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);

        renumberRepeaterCards('fin_hl');
    }

    const METRIC_PRESETS = [
        { label: 'Developer', key: 'developer', icon: 'building', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9v.01"/><path d="M9 12v.01"/><path d="M9 15v.01"/><path d="M9 18v.01"/></svg>' },
        { label: 'Price', key: 'price', icon: 'price', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>' },
        { label: 'Price From', key: 'price', icon: 'price', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>' },
        { label: 'Handover Date', key: 'handover', icon: 'date', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>' },
        { label: 'Property Type', key: 'property_type', icon: 'property_type', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>' },
        { label: 'Ownership', key: 'ownership', icon: 'shield', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>' },
        { label: 'Bedrooms', key: 'bedrooms', icon: 'bed', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>' },
        { label: 'Location', key: 'location', icon: 'map-pin', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>' },
        { label: 'Plot Size', key: 'plot_size', icon: 'plot_size', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>' },
        { label: 'Down Payment', key: 'down_payment', icon: 'down_payment', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>' },
        { label: 'Featured Highlight', key: 'featured', icon: 'star', svg: '<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>' }
    ];

    function getMetricSvg(label) {
        if (!label) return METRIC_PRESETS[0].svg;
        const low = label.toLowerCase().trim();
        const match = METRIC_PRESETS.find(p => {
            const pLow = p.label.toLowerCase();
            return low.includes(pLow) || pLow.includes(low);
        });
        return match ? match.svg : METRIC_PRESETS[0].svg;
    }

    function toggleMetricDropdown(btn) {
        const wrap = btn.closest('.adm-metric-input-wrap');
        if (!wrap) return;
        const menu = wrap.querySelector('.adm-metric-menu');
        if (!menu) return;

        const wasOpen = menu.classList.contains('show');
        document.querySelectorAll('.adm-metric-menu.show').forEach(m => m.classList.remove('show'));
        if (!wasOpen) {
            menu.classList.add('show');
        }
    }

    function selectMetricOption(itemEl, label, key, iconType) {
        const wrap = itemEl.closest('.adm-metric-input-wrap');
        if (!wrap) return;
        const card = wrap.closest('.adm-repeater-item');
        const input = wrap.querySelector('.adm-metric-input');
        const prefixIcon = wrap.querySelector('.adm-metric-prefix-icon');
        const menu = wrap.querySelector('.adm-metric-menu');

        if (input) {
            input.value = label;
            updateCardHeading(input);
        }

        const itemSvg = itemEl.querySelector('svg');
        if (prefixIcon && itemSvg) {
            prefixIcon.innerHTML = itemSvg.outerHTML;
        }

        if (card) {
            const keyInput = card.querySelector('input[name*="[key]"]');
            if (keyInput && (!keyInput.value || keyInput.value.startsWith('highlight_'))) {
                keyInput.value = key;
            }
            const iconInput = card.querySelector('.adm-hl-icon-input');
            if (iconInput) {
                iconInput.value = iconType;
            }
        }

        if (menu) {
            menu.classList.remove('show');
        }
    }

    function onMetricInputChange(input) {
        updateCardHeading(input);
        const wrap = input.closest('.adm-metric-input-wrap');
        if (!wrap) return;
        const prefixIcon = wrap.querySelector('.adm-metric-prefix-icon');
        if (prefixIcon) {
            prefixIcon.innerHTML = getMetricSvg(input.value);
        }
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.adm-metric-input-wrap')) {
            document.querySelectorAll('.adm-metric-menu.show').forEach(m => m.classList.remove('show'));
        }
    });

    function addHighlightItem() {
        const list = document.getElementById('repeater_highlights_items');
        if (!list) return;

        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;

        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `hl_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';

        const menuItemsHtml = METRIC_PRESETS.map(p => `
            <div class="adm-metric-menu-item" onclick="selectMetricOption(this, '${p.label}', '${p.key}', '${p.icon}')">
                <span class="adm-metric-menu-item-icon">${p.svg}</span>
                <span class="adm-metric-menu-item-label">${p.label}</span>
            </div>
        `).join('');

        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                            <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">Developer</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'highlights')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <input type="hidden" name="sections[highlights][items][${newId}][key]" value="highlight_${newId}">
                <input type="hidden" class="adm-hl-icon-input" name="sections[highlights][items][${newId}][icon]" value="building">
                <div class="adm-grid-2-col">
                    <div class="adm-field">
                        <label class="adm-label">Highlight Label / Metric Name</label>
                        <div class="adm-metric-input-wrap">
                            <div class="adm-metric-input-group">
                                <span class="adm-metric-prefix-icon" title="Metric Icon">
                                    ${METRIC_PRESETS[0].svg}
                                </span>
                                <input type="text" name="sections[highlights][items][${newId}][label]" value="Developer" class="adm-input adm-metric-input" oninput="onMetricInputChange(this)" placeholder="e.g. Developer, Price, Handover...">
                                <button type="button" class="adm-metric-dropdown-btn" onclick="toggleMetricDropdown(this)" title="Choose Metric Name">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="6 9 12 15 18 9"></polyline>
                                    </svg>
                                </button>
                            </div>
                            <div class="adm-metric-menu">
                                <div class="adm-metric-menu-header">Select Predefined Metric</div>
                                ${menuItemsHtml}
                            </div>
                        </div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Highlight Value / Content</label>
                        <input type="text" name="sections[highlights][items][${newId}][value]" value="" class="adm-input" placeholder="e.g. Modon Properties" >
                    </div>
                </div>
            </div>
        `;

        list.appendChild(card);
        setupDraggableItem(card);

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input[type="text"]');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);

        renumberRepeaterCards('highlights');
    }

    function addLocationCard() {
        const list = document.getElementById('repeater_locations_items');
        if (!list) return;

        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;

        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `loc_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';

        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                            <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Location</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'locations')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-grid-2-col">
                    <div class="adm-field" style="margin-bottom:0;">
                        <label class="adm-label">Landmark / Destination Name</label>
                        <input type="text" name="sections[overview_location][locations][${newId}][name]" value="New Landmark" class="adm-input"  oninput="updateCardHeading(this)">
                    </div>
                    <div class="adm-field" style="margin-bottom:0;">
                        <label class="adm-label">Travel Time / Distance</label>
                        <input type="text" name="sections[overview_location][locations][${newId}][distance]" value="10 minutes by car" class="adm-input" placeholder="e.g. 5 minutes by car" >
                    </div>
                </div>
            </div>
        `;

        list.appendChild(card);
        setupDraggableItem(card);

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);

        renumberRepeaterCards('locations');
    }

    function addPaymentMethod() {
        const list = document.getElementById('repeater_payments_items');
        if (!list) return;

        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;

        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `pay_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';

        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                            <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Payment Method</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'payments')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-field">
                    <label class="adm-label">Payment Method Name</label>
                    <input type="text" name="sections[payment_methods][items][${newId}][name]" value="Payment Method" class="adm-input"  oninput="updateCardHeading(this)">
                </div>

                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Icon / Image (Change Icon / Upload)</label>
                    <div class="adm-img-box">
                        <img src="/images/payments/card.png" class="adm-img-thumb-icon" alt="Icon">
                        <div class="adm-img-controls">
                            <div class="adm-file-row">
                                <input type="file" name="section_files[payment_methods][items][${newId}][icon]" accept="image/*" class="adm-file-input" onchange="previewItemImage(this)">
                            </div>
                            <input type="text" name="sections[payment_methods][items][${newId}][icon]" value="/images/payments/card.png" class="adm-input" placeholder="Or enter icon path / URL">
                        </div>
                    </div>
                </div>
            </div>
        `;

        list.appendChild(card);
        setupDraggableItem(card);

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);

        renumberRepeaterCards('payments');
    }

    function addFaqQuestion() {
        const list = document.getElementById('repeater_faq_items');
        if (!list) return;

        const newId = 'new_' + Date.now();
        const row = document.createElement('div');
        row.className = 'adm-repeater-item adm-faq-row';
        row.id = `faq_item_${newId}`;
        row.innerHTML = `
            <div class="adm-repeater-head adm-faq-handle">
                <div class="adm-drag-handle" title="Drag to reorder">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                        <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                    </svg>
                </div>
            </div>
            <input type="text" name="sections[faq][items][${newId}][q]" class="adm-input" placeholder="Question">
            <textarea name="sections[faq][items][${newId}][a]" class="adm-textarea" rows="1" placeholder="Answer"></textarea>
            <button type="button" class="adm-faq-del" onclick="removeFaqRow(this)" title="Delete row" aria-label="Delete row">&#10005;</button>
        `;

        list.appendChild(row);
        setupDraggableItem(row);
        renumberRepeaterCards('faq');

        const input = row.querySelector('input');
        if (input) input.focus();
        row.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function removeFaqRow(button) {
        const row = button.closest('.adm-faq-row');
        if (!row) return;
        row.remove();
        renumberRepeaterCards('faq');
    }

    function addRepeaterItem(sectionKey) {
        const list = document.getElementById('repeater_' + sectionKey + '_items');
        if (!list) return;

        const newIndex = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;

        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `repeater_item_${sectionKey}_${newIndex}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';

        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M7 20V4m0 0L3 8m4-4l4 4"/>
                            <path d="M17 4v16m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Community</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg>
                    </button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterItem(this, '${sectionKey}')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                        Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-field">
                    <label class="adm-label">Community / Project Title</label>
                    <input type="text"
                           name="sections[${sectionKey}][items][${newIndex}][title]"
                           value=""
                           class="adm-input adm-repeater-title-input"
                           placeholder="e.g. New Waterfront Villas"
                           
                           oninput="updateRepeaterTitle(this)">
                </div>
                <div class="adm-field" style="margin-top:12px; margin-bottom:0;">
                    <label class="adm-label">Community Description &amp; Details</label>
                    <textarea name="sections[${sectionKey}][items][${newIndex}][description]"
                              class="adm-textarea adm-summernote"
                              rows="4"
                              placeholder="Detailed rundown of this community..."
                              ></textarea>
                    <div class="adm-help">Double enter (blank line) creates a new paragraph on the website.</div>
                </div>
            </div>
        `;

        list.appendChild(card);
        setupDraggableItem(card);

        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);

        renumberRepeaterCards(sectionKey);
    }

    function addServiceCard() {
        const list = document.getElementById('repeater_services_items');
        if (!list) return;
        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;
        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `srv_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';
        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Service</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'services')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-grid-2-col">
                    <div class="adm-field">
                        <label class="adm-label">Service Title</label>
                        <input type="text" name="sections[services][items][${newId}][title]" value="New Service" class="adm-input"  oninput="updateCardHeading(this)">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Icon (compass / building / trending-up)</label>
                        <input type="text" name="sections[services][items][${newId}][icon]" value="compass" class="adm-input">
                    </div>
                </div>
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Service Description</label>
                    <textarea name="sections[services][items][${newId}][description]" class="adm-textarea adm-summernote" rows="3"  placeholder="Service description details..."></textarea>
                </div>
            </div>
        `;
        list.appendChild(card);
        setupDraggableItem(card);
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);
        renumberRepeaterCards('services');
    }

    function addPillarCard() {
        const list = document.getElementById('repeater_pillars_items');
        if (!list) return;
        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;
        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `pillar_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';
        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Pillar</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'pillars')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-grid-2-col">
                    <div class="adm-field">
                        <label class="adm-label">Pillar Title (e.g. Our Mission)</label>
                        <input type="text" name="sections[pillars][items][${newId}][title]" value="Our Pillar" class="adm-input"  oninput="updateCardHeading(this)">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Icon (target / eye / shield)</label>
                        <input type="text" name="sections[pillars][items][${newId}][icon]" value="target" class="adm-input">
                    </div>
                </div>
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Pillar Description</label>
                    <textarea name="sections[pillars][items][${newId}][description]" class="adm-textarea adm-summernote" rows="3"  placeholder="Pillar statement..."></textarea>
                </div>
            </div>
        `;
        list.appendChild(card);
        setupDraggableItem(card);
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);
        renumberRepeaterCards('pillars');
    }

    function addWhyUsCard() {
        const list = document.getElementById('repeater_why_us_items');
        if (!list) return;
        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;
        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `why_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';
        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Advantage</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'why_us')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-grid-2-col">
                    <div class="adm-field">
                        <label class="adm-label">Advantage Title</label>
                        <input type="text" name="sections[why_us][items][${newId}][title]" value="New Advantage" class="adm-input"  oninput="updateCardHeading(this)">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Icon (map-pin / heart / search)</label>
                        <input type="text" name="sections[why_us][items][${newId}][icon]" value="map-pin" class="adm-input">
                    </div>
                </div>
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Advantage Description</label>
                    <textarea name="sections[why_us][items][${newId}][description]" class="adm-textarea adm-summernote" rows="3"  placeholder="Why clients choose us..."></textarea>
                </div>
            </div>
        `;
        list.appendChild(card);
        setupDraggableItem(card);
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);
        renumberRepeaterCards('why_us');
    }

    function addCtaBenefit() {
        const list = document.getElementById('repeater_cta_ben_items');
        if (!list) return;
        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;
        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `cta_ben_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';
        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Benefit Point</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'cta_ben')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Benefit Bullet Text</label>
                    <input type="text" name="sections[cta][benefits][${newId}][text]" value="New Benefit Point" class="adm-input"  oninput="updateCardHeading(this)">
                </div>
            </div>
        `;
        list.appendChild(card);
        setupDraggableItem(card);
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);
        renumberRepeaterCards('cta_ben');
    }

    function addChannelCard() {
        const list = document.getElementById('repeater_channels_items');
        if (!list) return;
        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;
        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `channel_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';
        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Channel</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'channels')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-grid-2-col">
                    <div class="adm-field">
                        <label class="adm-label">Channel Title</label>
                        <input type="text" name="sections[channels][items][${newId}][title]" value="New Channel" class="adm-input"  oninput="updateCardHeading(this)">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Icon (whatsapp / phone / email / location)</label>
                        <input type="text" name="sections[channels][items][${newId}][icon]" value="phone" class="adm-input">
                    </div>
                </div>
                <div class="adm-grid-2-col">
                    <div class="adm-field">
                        <label class="adm-label">Info / Phone / Address</label>
                        <input type="text" name="sections[channels][items][${newId}][info]" value="+971 50 000 0000" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Action Text</label>
                        <input type="text" name="sections[channels][items][${newId}][action]" value="Call Us →" class="adm-input">
                    </div>
                </div>
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">URL / Link (wa.me / tel: / mailto: / blank)</label>
                    <input type="text" name="sections[channels][items][${newId}][url]" value="tel:+971500000000" class="adm-input">
                </div>
            </div>
        `;
        list.appendChild(card);
        setupDraggableItem(card);
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);
        renumberRepeaterCards('channels');
    }

    function addFeatureCard() {
        const list = document.getElementById('repeater_info_feat_items');
        if (!list) return;
        const newId = 'new_' + Date.now();
        const currentCount = list.querySelectorAll('.adm-repeater-item').length + 1;
        const card = document.createElement('div');
        card.className = 'adm-repeater-item';
        card.id = `feat_item_${newId}`;
        card.style.opacity = '0';
        card.style.transform = 'translateY(-10px)';
        card.innerHTML = `
            <div class="adm-repeater-head">
                <div class="adm-repeater-title-wrap">
                    <div class="adm-drag-handle" title="Drag to reorder">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                    </div>
                    <span class="adm-repeater-badge">#${currentCount}</span>
                    <strong class="adm-repeater-heading-text">New Feature</strong>
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-collapse" onclick="toggleCardCollapse(this)" title="Toggle Collapse"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="6 9 12 15 18 9"/></svg></button>
                    <button type="button" class="adm-btn-item-delete" onclick="removeRepeaterCard(this, 'info_feat')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg> Delete
                    </button>
                </div>
            </div>
            <div class="adm-repeater-body">
                <div class="adm-grid-2-col">
                    <div class="adm-field">
                        <label class="adm-label">Feature Title</label>
                        <input type="text" name="sections[info][features][${newId}][title]" value="New Feature Title" class="adm-input"  oninput="updateCardHeading(this)">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Icon (building / sparkles / clock)</label>
                        <input type="text" name="sections[info][features][${newId}][icon]" value="building" class="adm-input">
                    </div>
                </div>
                <div class="adm-field" style="margin-bottom:0;">
                    <label class="adm-label">Description</label>
                    <input type="text" name="sections[info][features][${newId}][desc]" value="Description of feature..." class="adm-input" >
                </div>
            </div>
        `;
        list.appendChild(card);
        setupDraggableItem(card);
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'none';
            const input = card.querySelector('input');
            if (input) input.focus();
            card.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 50);
        renumberRepeaterCards('info_feat');
    }
    function previewUploadedImage(input, previewId, urlInputId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById(previewId);
                if (preview) preview.src = e.target.result;
                const urlInput = document.getElementById(urlInputId);
                if (urlInput) urlInput.placeholder = "File selected: " + input.files[0].name;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function addLocationCategory() {
        const container = document.getElementById('location_categories_container');
        if (!container) return;
        const newIdx = container.children.length;
        const catCard = document.createElement('div');
        catCard.className = 'adm-card';
        catCard.id = `loc_cat_${newIdx}`;
        catCard.style.cssText = 'border: 1px solid #dcd3c6; background: #fff; margin-bottom: 0;';
        catCard.innerHTML = `
            <div class="adm-card-head" style="padding: 12px 16px; background: #fdfcfb;">
                <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                    <span class="adm-chip" style="font-weight: 700;">#${newIdx + 1}</span>
                    <input type="text" name="sections[location][categories][${newIdx}][name]" value="New Category" class="adm-input" placeholder="Category Name" style="font-weight: 700; max-width: 320px;">
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('loc_cat_${newIdx}').remove()">
                        Delete Category
                    </button>
                </div>
            </div>
            <div class="adm-card-body" style="padding: 16px;">
                <div style="margin-bottom: 10px; display: flex; justify-content: space-between; align-items: center;">
                    <label class="adm-label" style="margin-bottom: 0;">Places &amp; Estimated Travel Times:</label>
                    <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addLocationItem(${newIdx})" style="font-size: 11px; padding: 4px 10px;">
                        + Add Destination
                    </button>
                </div>
                <div id="loc_cat_${newIdx}_items" style="display: flex; flex-direction: column; gap: 8px;">
                    <div class="adm-form-row" id="loc_cat_${newIdx}_item_0" style="gap: 12px; align-items: center; margin-bottom: 4px;">
                        <div style="flex: 2;">
                            <input type="text" name="sections[location][categories][${newIdx}][items][0][name]" value="" class="adm-input" placeholder="Destination Name (e.g. Nearby Attraction)">
                        </div>
                        <div style="flex: 1.2;">
                            <input type="text" name="sections[location][categories][${newIdx}][items][0][time]" value="" class="adm-input" placeholder="e.g. 5 mins">
                        </div>
                        <button type="button" class="adm-btn-item-delete" style="padding: 8px;" onclick="document.getElementById('loc_cat_${newIdx}_item_0').remove()">
                            ✕
                        </button>
                    </div>
                </div>
            </div>
        `;
        container.appendChild(catCard);
    }

    function addLocationItem(catIdx) {
        const list = document.getElementById(`loc_cat_${catIdx}_items`);
        if (!list) return;
        const newItmIdx = list.children.length;
        const row = document.createElement('div');
        row.className = 'adm-form-row';
        row.id = `loc_cat_${catIdx}_item_${newItmIdx}`;
        row.style.cssText = 'gap: 12px; align-items: center; margin-bottom: 4px;';
        row.innerHTML = `
            <div style="flex: 2;">
                <input type="text" name="sections[location][categories][${catIdx}][items][${newItmIdx}][name]" value="" class="adm-input" placeholder="Destination Name">
            </div>
            <div style="flex: 1.2;">
                <input type="text" name="sections[location][categories][${catIdx}][items][${newItmIdx}][time]" value="" class="adm-input" placeholder="e.g. 10 mins">
            </div>
            <button type="button" class="adm-btn-item-delete" style="padding: 8px;" onclick="document.getElementById('loc_cat_${catIdx}_item_${newItmIdx}').remove()">
                ✕
            </button>
        `;
        list.appendChild(row);
    }

    function addPaymentRow() {
        const tbody = document.getElementById('payment_rows_container');
        if (!tbody) return;
        const newIdx = tbody.children.length;
        const tr = document.createElement('tr');
        tr.id = `pay_row_${newIdx}`;
        tr.style.cssText = 'border-bottom: 1px solid #e8e1d7;';
        tr.innerHTML = `
            <td style="padding: 8px 14px; font-weight: 700; color: #1a4731;">${newIdx + 1}</td>
            <td style="padding: 8px 14px;">
                <input type="text" name="sections[payment_plan][rows][${newIdx}][installment]" value="New Installment" class="adm-input" placeholder="e.g. Next Installment" style="font-weight: 600;">
            </td>
            <td style="padding: 8px 14px;">
                <input type="text" name="sections[payment_plan][rows][${newIdx}][percentage]" value="10%" class="adm-input" placeholder="e.g. 10%" style="font-weight: 700; color: #1a4731;">
            </td>
            <td style="padding: 8px 14px;">
                <input type="text" name="sections[payment_plan][rows][${newIdx}][milestone]" value="Construction Milestone" class="adm-input" placeholder="Milestone description">
            </td>
            <td style="padding: 8px 14px; text-align: center;">
                <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('pay_row_${newIdx}').remove()" style="padding: 6px 8px;">
                    ✕
                </button>
            </td>
        `;
        tbody.appendChild(tr);
        const countSpan = document.getElementById('payRowCount');
        if (countSpan) countSpan.textContent = tbody.children.length;
    }

    // --- Project Gallery Drag-and-Drop & Row Management ---
    let draggedGalRow = null;

    function initGalleryDragAndDrop() {
        const container = document.getElementById('gallery_images_container');
        if (!container) return;

        container.querySelectorAll('.adm-gal-row').forEach(row => {
            row.setAttribute('draggable', 'true');

            row.ondragstart = (e) => {
                draggedGalRow = row;
                row.style.opacity = '0.35';
                e.dataTransfer.effectAllowed = 'move';
            };

            row.ondragend = () => {
                if (draggedGalRow) draggedGalRow.style.opacity = '1';
                draggedGalRow = null;
                renumberGalleryRows();
            };

            row.ondragover = (e) => {
                e.preventDefault();
                e.dataTransfer.dropEffect = 'move';
                if (draggedGalRow && draggedGalRow !== row) {
                    const rect = row.getBoundingClientRect();
                    const next = (e.clientY - rect.top) / (rect.bottom - rect.top) > 0.5;
                    container.insertBefore(draggedGalRow, next ? row.nextSibling : row);
                }
            };
        });
    }

    function renumberGalleryRows() {
        const container = document.getElementById('gallery_images_container');
        if (!container) return;
        const rows = container.querySelectorAll('.adm-gal-row');
        rows.forEach((row, idx) => {
            row.dataset.index = idx;
            row.id = `gal_row_${idx}`;

            const numEl = row.querySelector('.adm-gal-num');
            if (numEl) numEl.textContent = '#' + (idx + 1);

            const srcInput = row.querySelector('.adm-gal-src');
            if (srcInput) srcInput.name = `sections[gallery][images][${idx}][src]`;

            const altInput = row.querySelector('.adm-gal-alt');
            if (altInput) altInput.name = `sections[gallery][images][${idx}][alt]`;

            const catInput = row.querySelector('.adm-gal-cat');
            if (catInput) catInput.name = `sections[gallery][images][${idx}][category]`;

            const fileInput = row.querySelector('.adm-gal-file');
            if (fileInput) fileInput.name = `section_files[gallery][images][${idx}][file]`;
        });

        const count = rows.length;
        const countSpan = document.getElementById('galleryCount');
        if (countSpan) countSpan.textContent = count;

        const addBtn = document.getElementById('addGalleryBtn');
        if (addBtn) {
            if (count >= 10) {
                addBtn.disabled = true;
                addBtn.style.opacity = '0.5';
                addBtn.style.cursor = 'not-allowed';
                addBtn.title = 'Maximum 10 images limit reached';
            } else {
                addBtn.disabled = false;
                addBtn.style.opacity = '1';
                addBtn.style.cursor = 'pointer';
                addBtn.title = '';
            }
        }
    }

    function deleteGalleryRow(btn) {
        const row = btn.closest('.adm-gal-row');
        if (!row) return;
        row.remove();
        renumberGalleryRows();
    }

    function triggerGalleryUpload() {
        const container = document.getElementById('gallery_images_container');
        const currentCount = container ? container.querySelectorAll('.adm-gal-row').length : 0;
        if (currentCount >= 10) {
            alert('Maximum 10 images allowed. Please delete an image first to add a new one.');
            return;
        }
        const fileInput = document.getElementById('galleryFileInput');
        if (fileInput) {
            fileInput.value = '';
            fileInput.click();
        }
    }

    function handleGalleryFilesSelected(input) {
        if (!input.files || input.files.length === 0) return;
        const container = document.getElementById('gallery_images_container');
        if (!container) return;

        const MAX_IMAGES = 10;
        const MAX_SIZE_BYTES = 2 * 1024 * 1024; // 2MB
        const allowedExtensions = ['jpg', 'jpeg', 'webp'];
        const allowedMimeTypes = ['image/jpeg', 'image/webp'];

        Array.from(input.files).forEach(file => {
            let currentCount = container.querySelectorAll('.adm-gal-row').length;
            if (currentCount >= MAX_IMAGES) {
                alert(`Maximum ${MAX_IMAGES} images limit reached. Skipping remaining files.`);
                return;
            }

            // Validate file size (<= 2MB)
            if (file.size > MAX_SIZE_BYTES) {
                alert(`"${file.name}" is too large (${(file.size / (1024 * 1024)).toFixed(2)} MB). Maximum allowed size is 2MB.`);
                return;
            }

            // Validate file format (jpg, webp)
            const ext = file.name.split('.').pop().toLowerCase();
            const isValidType = allowedExtensions.includes(ext) || allowedMimeTypes.includes(file.type);
            if (!isValidType) {
                alert(`"${file.name}" has an unsupported format. Only JPG and WEBP images are allowed.`);
                return;
            }

            // Read file preview
            const reader = new FileReader();
            reader.onload = function(e) {
                const dataUrl = e.target.result;
                const newIdx = container.querySelectorAll('.adm-gal-row').length;
                if (newIdx >= MAX_IMAGES) return;

                const row = document.createElement('div');
                row.className = 'adm-gal-row';
                row.id = `gal_row_${newIdx}`;
                row.draggable = true;
                row.dataset.index = newIdx;
                row.style.cssText = 'display: flex; align-items: center; gap: 14px; background: #fff; border: 1px solid #e2dad0; border-radius: 8px; padding: 10px 14px; transition: all 0.2s; cursor: default;';

                row.innerHTML = `
                    <div class="adm-gal-handle" title="Drag to reorder" style="cursor: grab; color: #9c9182; font-size: 18px; user-select: none; display: flex; align-items: center; justify-content: center; width: 28px; height: 28px; border-radius: 4px; background: #faf8f5;">
                        ⇅
                    </div>
                    <div class="adm-gal-num" style="font-size: 12px; font-weight: 700; color: #847565; min-width: 28px;">
                        #${newIdx + 1}
                    </div>
                    <div style="width: 120px; height: 75px; border-radius: 6px; overflow: hidden; background: #1a1a1a; flex-shrink: 0; border: 1px solid #dcd3c6; display: flex; align-items: center; justify-content: center;">
                        <img class="adm-gal-thumb" src="${dataUrl}" alt="New Photo" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div style="flex: 1; min-width: 0;">
                        <div class="adm-gal-name" style="font-size: 13px; font-weight: 600; color: #2d261e; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            ${file.name}
                        </div>
                        <div style="font-size: 11px; color: #9c9182; margin-top: 2px;">
                            New Upload (${(file.size / 1024).toFixed(0)} KB) • JPG/WEBP
                        </div>
                    </div>
                    <input type="hidden" class="adm-gal-src" name="sections[gallery][images][${newIdx}][src]" value="">
                    <input type="hidden" class="adm-gal-alt" name="sections[gallery][images][${newIdx}][alt]" value="Project Photo">
                    <input type="hidden" class="adm-gal-cat" name="sections[gallery][images][${newIdx}][category]" value="Exterior">
                    <input type="file" class="adm-gal-file" name="section_files[gallery][images][${newIdx}][file]" style="display: none;">
                    <button type="button" class="adm-gal-del" onclick="deleteGalleryRow(this)" title="Delete Image" style="background: #fbf7f4; border: 1px solid #eddcd0; color: #b43b3b; width: 34px; height: 34px; border-radius: 6px; display: flex; align-items: center; justify-content: center; cursor: pointer; font-size: 15px; font-weight: bold; transition: all 0.2s;">
                        ✕
                    </button>
                `;

                // Attach file to row's hidden file input using DataTransfer
                try {
                    const dt = new DataTransfer();
                    dt.items.add(file);
                    const hiddenFileInput = row.querySelector('.adm-gal-file');
                    if (hiddenFileInput) hiddenFileInput.files = dt.files;
                } catch (err) {
                    console.warn('DataTransfer attachment:', err);
                }

                container.appendChild(row);
                renumberGalleryRows();
                initGalleryDragAndDrop();
            };
            reader.readAsDataURL(file);
        });
    }

    // Initialize gallery on load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initGalleryDragAndDrop();
            renumberGalleryRows();
        });
    } else {
        initGalleryDragAndDrop();
        renumberGalleryRows();
    }

    function addAmenityCard() {
        const grid = document.getElementById('amenities_cards_container');
        if (!grid) return;
        const newIdx = grid.children.length;
        const card = document.createElement('div');
        card.className = 'adm-card';
        card.id = `amenity_card_${newIdx}`;
        card.style.cssText = 'border: 1px solid #dcd3c6; background: #fff; margin-bottom: 0; padding: 14px;';
        card.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                <div style="width: 44px; height: 44px; border-radius: 6px; background: #faf8f5; border: 1px solid #e0d7cb; display: flex; align-items: center; justify-content: center;">
                    <img id="preview_amenity_${newIdx}" src="/images/wadeem-gardens/amenity-club.png" alt="Icon" style="width: 28px; height: 28px; object-fit: contain;">
                </div>
                <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('amenity_card_${newIdx}').remove()" style="padding: 4px 8px; font-size: 11px;">
                    ✕ Delete
                </button>
            </div>
            <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Amenity Name</label>
            <input type="text" name="sections[amenities][items][${newIdx}][name]" value="New Amenity" class="adm-input" style="font-size: 12px; font-weight: 600; margin-bottom: 8px;">
            <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Icon URL</label>
            <input type="text" name="sections[amenities][items][${newIdx}][icon]" id="input_amenity_${newIdx}" value="/images/wadeem-gardens/amenity-club.png" class="adm-input" style="font-size: 11px;" oninput="document.getElementById('preview_amenity_${newIdx}').src = this.value">
            <label class="adm-label" style="font-size: 11px; margin-top: 6px; margin-bottom: 2px;">Upload Icon</label>
            <input type="file" name="section_files[amenities][items][${newIdx}][icon]" class="adm-input" accept="image/*" style="font-size: 10px; padding: 3px;" onchange="previewUploadedImage(this, 'preview_amenity_${newIdx}', 'input_amenity_${newIdx}')">
        `;
        grid.appendChild(card);
        const countSpan = document.getElementById('amenitiesCount');
        if (countSpan) countSpan.textContent = grid.children.length;
    }

    function submitEditForm(event) {
        if (event) event.preventDefault();
        const form = document.getElementById('pageEditForm');
        if (!form) return;

        // Ensure all Summernote instances sync their current HTML to the underlying textarea
        if (window.jQuery) {
            window.jQuery('.adm-summernote, .summernote').each(function() {
                if (window.jQuery(this).data('summernote')) {
                    window.jQuery(this).val(window.jQuery(this).summernote('code'));
                }
            });
        }

        // Strip HTML5 required constraints that block submission from hidden tabs
        form.querySelectorAll('[required]').forEach(el => el.removeAttribute('required'));
        form.setAttribute('novalidate', 'novalidate');

        const btn = document.getElementById('savePageBtn');
        const txt = document.getElementById('saveBtnText');
        if (btn) btn.disabled = true;
        if (txt) txt.textContent = 'Saving Changes...';

        form.submit();
    }

    function addFloorPlanItem() {
        const container = document.getElementById('floor_plans_container');
        if (!container) return;
        const newIdx = container.children.length;
        const card = document.createElement('div');
        card.className = 'adm-card';
        card.id = `floor_plan_card_${newIdx}`;
        card.style.cssText = 'border: 1px solid #dcd3c6; background: #fff; margin-bottom: 0;';
        card.innerHTML = `
            <div class="adm-card-head" style="padding: 10px 16px; background: #fdfcfb;">
                <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                    <span class="adm-chip" style="font-weight: 700;">#${newIdx + 1}</span>
                    <input type="text" name="sections[floor_plans][items][${newIdx}][title]" value="New Floor Plan Layout" class="adm-input" placeholder="Layout Title" style="font-weight: 700; max-width: 360px;">
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('floor_plan_card_${newIdx}').remove()">
                        ✕ Delete Layout
                    </button>
                </div>
            </div>
            <div class="adm-card-body" style="padding: 16px;">
                <div style="display: flex; gap: 20px; align-items: flex-start; margin-bottom: 14px;">
                    <div style="width: 140px; height: 100px; border-radius: 6px; overflow: hidden; background: #f5f2ed; display: flex; align-items: center; justify-content: center; flex-shrink: 0; border: 1px solid #d4c7b5;">
                        <img id="preview_floor_${newIdx}" src="/images/placeholder.svg" alt="Floor Plan Preview" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div style="flex: 1;">
                        <label class="adm-label" style="font-size: 11px; margin-bottom: 2px;">Blueprint Image URL / Path</label>
                        <input type="text" name="sections[floor_plans][items][${newIdx}][image]" id="input_floor_${newIdx}" value="" class="adm-input" placeholder="/images/nawayef-park-views/asset_48.png" oninput="document.getElementById('preview_floor_${newIdx}').src = this.value">
                        <label class="adm-label" style="font-size: 11px; margin-top: 8px; margin-bottom: 2px;">Or Upload New Blueprint Image</label>
                        <input type="file" name="section_files[floor_plans][items][${newIdx}][image]" class="adm-input" accept="image/*" onchange="previewUploadedImage(this, 'preview_floor_${newIdx}', 'input_floor_${newIdx}')">
                    </div>
                </div>
                <div class="adm-field">
                    <label class="adm-label">Layout Description</label>
                    <textarea name="sections[floor_plans][items][${newIdx}][description]" class="adm-textarea adm-summernote" rows="2" placeholder="Description of this apartment/villa floor plan..."></textarea>
                </div>
                <div class="adm-grid-4-col" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 12px;">
                    <div class="adm-field" style="margin-bottom:0;">
                        <label class="adm-label" style="font-size:11px;">Bedrooms</label>
                        <input type="text" name="sections[floor_plans][items][${newIdx}][bedrooms]" value="1" class="adm-input">
                    </div>
                    <div class="adm-field" style="margin-bottom:0;">
                        <label class="adm-label" style="font-size:11px;">Bathrooms</label>
                        <input type="text" name="sections[floor_plans][items][${newIdx}][bathrooms]" value="1" class="adm-input">
                    </div>
                    <div class="adm-field" style="margin-bottom:0;">
                        <label class="adm-label" style="font-size:11px;">Parking Spaces</label>
                        <input type="text" name="sections[floor_plans][items][${newIdx}][parking]" value="1" class="adm-input">
                    </div>
                    <div class="adm-field" style="margin-bottom:0;">
                        <label class="adm-label" style="font-size:11px;">Total Area (sqft)</label>
                        <input type="text" name="sections[floor_plans][items][${newIdx}][area]" value="1000" class="adm-input">
                    </div>
                </div>
            </div>
        `;
        container.appendChild(card);
        const count = document.getElementById('floorPlansCount');
        if (count) count.textContent = container.children.length;
    }

    function addOverviewItem() {
        const container = document.getElementById('overview_items_container');
        if (!container) return;
        const newIdx = container.children.length;
        const card = document.createElement('div');
        card.className = 'adm-card';
        card.id = `overview_card_${newIdx}`;
        card.style.cssText = 'border: 1px solid #dcd3c6; background: #fff; margin-bottom: 0;';
        card.innerHTML = `
            <div class="adm-card-head" style="padding: 10px 16px; background: #fdfcfb;">
                <div style="display: flex; align-items: center; gap: 10px; flex: 1;">
                    <span class="adm-chip" style="font-weight: 700;">#${newIdx + 1}</span>
                    <input type="text" name="sections[overview][items][${newIdx}][title]" value="Community Name" class="adm-input" placeholder="Community Name" style="font-weight: 700; max-width: 340px;">
                </div>
                <div class="adm-repeater-actions-head">
                    <button type="button" class="adm-btn-item-delete" onclick="document.getElementById('overview_card_${newIdx}').remove()">
                        ✕ Delete
                    </button>
                </div>
            </div>
            <div class="adm-card-body" style="padding: 14px 16px;">
                <label class="adm-label" style="font-size: 11px; margin-bottom: 4px;">Editorial Narrative / Paragraphs</label>
                <textarea name="sections[overview][items][${newIdx}][description]" class="adm-textarea adm-summernote" rows="4" placeholder="Enter multi-paragraph narrative..."></textarea>
            </div>
        `;
        container.appendChild(card);
        const count = document.getElementById('overviewCount');
        if (count) count.textContent = container.children.length;
    }
</script>
@endpush
@endsection
