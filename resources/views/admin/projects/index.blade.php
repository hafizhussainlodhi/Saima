@extends('admin.layouts.app')

@section('title', 'Manage > Projects (Property Cards)')

@push('styles')
<style>
    .adm-topbar { display: none !important; }
    .project-card-row:hover { background-color: #fafbfd !important; }
    .cms-action-btn {
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 6px;
        transition: all 0.2s ease;
        text-decoration: none;
    }
    .cms-action-btn:hover {
        color: #1a4731;
        background-color: #f1f5f9;
        transform: translateY(-1px);
    }
    .cms-action-btn.cms-action-delete:hover {
        color: #ef4444 !important;
        background-color: #fef2f2 !important;
    }
    .badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 8px;
        border-radius: 6px;
        line-height: 1.4;
    }
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(4px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    /* Full Tabbed Layout Container matching Screenshot 1 */
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

    /* Left Sidebar Tabs (Screenshot 1 / 2 exact style) */
    .adm-edit-layout > .adm-tabs {
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

    .adm-edit-layout > .adm-tabs .adm-tab {
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

    .adm-edit-layout > .adm-tabs .adm-tab svg {
        width: 17px !important;
        height: 17px !important;
        stroke: #94a3b8 !important;
        flex-shrink: 0 !important;
        transition: stroke 0.18s ease !important;
    }

    .adm-edit-layout > .adm-tabs .adm-tab:hover {
        background: #f8fafc !important;
        color: #1e293b !important;
    }

    .adm-edit-layout > .adm-tabs .adm-tab:hover svg {
        stroke: #64748b !important;
    }

    /* Active Tab (Screenshot 1 Style: soft light blue pill with chevron) */
    .adm-edit-layout > .adm-tabs .adm-tab.is-active {
        background: #f0f9ff !important;
        color: #0284c7 !important;
        font-weight: 600 !important;
        border-radius: 10px !important;
    }

    .adm-edit-layout > .adm-tabs .adm-tab.is-active svg {
        stroke: #0284c7 !important;
    }

    .adm-edit-layout > .adm-tabs .adm-tab.is-active::after {
        content: '';
        position: absolute;
        right: 14px;
        top: 50%;
        transform: translateY(-50%) rotate(45deg);
        width: 6px;
        height: 6px;
        border-top: 2px solid #0284c7;
        border-right: 2px solid #0284c7;
    }

    /* Right Form Area */
    .adm-edit-layout > .adm-edit-form-area {
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

    .adm-edit-layout .tab-pane {
        display: none;
    }
    .adm-edit-layout .tab-pane.active {
        display: block;
        animation: fadeInTab 0.15s ease-in-out;
    }

    @keyframes fadeInTab {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .adm-edit-layout .adm-card-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
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

    .adm-edit-layout .adm-chip {
        font-size: 11px;
        font-weight: 600;
        background: #f1f5f9;
        color: #64748b;
        padding: 3px 8px;
        border-radius: 6px;
        text-transform: uppercase;
        letter-spacing: 0.04em;
    }

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
        width: 100%;
        box-sizing: border-box;
    }

    .adm-edit-layout .adm-input:focus,
    .adm-edit-layout .adm-textarea:focus,
    .adm-edit-layout .adm-select:focus {
        background: #ffffff !important;
        border-color: #0284c7 !important;
        outline: none !important;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1) !important;
    }

    .adm-edit-layout .adm-field {
        margin-bottom: 18px;
    }

    .adm-edit-layout .adm-label {
        display: block;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #334155 !important;
        margin-bottom: 6px !important;
    }

    .adm-edit-layout .adm-help {
        font-size: 12px !important;
        color: #94a3b8 !important;
        margin-top: 4px !important;
    }

    .adm-img-box {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        background: #faf8f5;
        border: 1px solid #e8e1d7;
        border-radius: 10px;
        padding: 14px 18px;
    }

    .adm-img-thumb-lg {
        width: 120px;
        height: 75px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #cbd5e1;
        background: #e2e8f0;
        flex-shrink: 0;
    }
</style>
@endpush

@section('content')
<div id="projectsManagerView">
    <!-- Breadcrumbs & Heading -->
    <div class="cms-page-header" style="margin-bottom: 22px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 14px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; font-family: var(--font-display, 'Outfit', sans-serif); letter-spacing: -0.01em;">Manage &gt; Projects (Property Cards)</h1>
            <div style="font-size: 13px; color: #8c9ba5; font-weight: 400;">Home &ndash; Manage &ndash; Projects (Featured Property Cards)</div>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <div style="display: flex; background: #f8fafc; padding: 3px; border-radius: 8px; border: 1px solid #f1f5f9; gap: 2px;">
                <a href="{{ route('admin.pages.index') }}" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; text-decoration: none; color: #64748b;">Pages</a>
                <a href="{{ route('admin.projects.index') }}" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; text-decoration: none; background: #ffffff; color: #1e293b; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">Projects ({{ $totalProjects }})</a>
                <a href="{{ route('admin.cities.index') }}" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; text-decoration: none; color: #64748b;">Cities</a>
            </div>
            <button type="button" class="adm-btn adm-btn-primary" onclick="toggleAddCardForm()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; padding: 8px 16px; border-radius: 8px;">
                @include('admin.partials.icon', ['name' => 'plus']) Add Property
            </button>
        </div>
    </div>

    <!-- Collapsible Add Property & Detail Page Full Tabbed Editor Container -->
    <div id="addCardFormBox" style="display: none; margin-bottom: 30px;">
        <!-- Top URL Card Banner matching Screenshot 1 -->
        <div style="background:#ffffff; border-radius:14px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.03); padding:14px 20px; margin-bottom:18px; display:flex; justify-content:space-between; align-items:center; gap:12px; font-size:14px;">
            <div style="display:flex; align-items:center; gap:10px;">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                </svg>
                <span style="font-weight:600; color:#475569;">Page URL:</span>
                <span style="color:#0284c7; font-weight:500;">{{ url('/') }}/<strong id="slugLivePreview" style="color:#0284c7;">new-property</strong></span>
            </div>
            <button type="button" onclick="toggleAddCardForm()" style="background: none; border: none; font-size: 22px; line-height: 1; color: #94a3b8; cursor: pointer; padding: 0 4px;" title="Close">&times;</button>
        </div>

        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" id="addPropertyFullForm">
            @csrf

            <div class="adm-edit-layout">
                <!-- Left Sidebar Vertical Navigation Tabs (Screenshot 1 / 2 exact style) -->
                <div class="adm-tabs" role="tablist">
                    <button type="button" class="adm-tab is-active" onclick="switchAddTab('general')" data-tab-id="general">
                        @include('admin.partials.icon', ['name' => 'grid'])
                        <span>General Settings</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('hero')" data-tab-id="hero">
                        @include('admin.partials.icon', ['name' => 'spark'])
                        <span>Hero Banner</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('highlights')" data-tab-id="highlights">
                        @include('admin.partials.icon', ['name' => 'trend'])
                        <span>Project Highlights</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('about')" data-tab-id="about">
                        @include('admin.partials.icon', ['name' => 'book'])
                        <span>About Community</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('amenities')" data-tab-id="amenities">
                        @include('admin.partials.icon', ['name' => 'spark'])
                        <span>Amenities &amp; Facilities</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('gallery')" data-tab-id="gallery">
                        @include('admin.partials.icon', ['name' => 'spark'])
                        <span>Project Gallery</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('content')" data-tab-id="content">
                        @include('admin.partials.icon', ['name' => 'edit'])
                        <span>Content</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('payment_plan')" data-tab-id="payment_plan">
                        @include('admin.partials.icon', ['name' => 'trend'])
                        <span>Payment Plan</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('master_plan')" data-tab-id="master_plan">
                        @include('admin.partials.icon', ['name' => 'globe'])
                        <span>Master Plan</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('location')" data-tab-id="location">
                        @include('admin.partials.icon', ['name' => 'globe'])
                        <span>Location &amp; Connectivity</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('faq')" data-tab-id="faq">
                        @include('admin.partials.icon', ['name' => 'list'])
                        <span>Frequently Asked Questions</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('contact')" data-tab-id="contact">
                        @include('admin.partials.icon', ['name' => 'mail'])
                        <span>Contact &amp; Booking CTA</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('seo')" data-tab-id="seo">
                        @include('admin.partials.icon', ['name' => 'search'])
                        <span>SEO &amp; Meta</span>
                    </button>
                </div>

                <!-- Right Content Form Area -->
                <div class="adm-edit-form-area">

                    <!-- 1. GENERAL SETTINGS & PROPERTY CARD TAB -->
                    <div id="add_tab_general" class="tab-pane active">
                        <div class="adm-card-head">
                            <div>
                                <h2>General Settings &amp; Property Card</h2>
                                <p>Configure title, URL route slug, card metrics for Home Page, and publishing state.</p>
                            </div>
                            <div style="display:flex; align-items:center; gap:10px;">
                                <span class="adm-chip">card &amp; page</span>

                                <!-- Status Dropdown Button -->
                                <div class="adm-status-dropdown-wrap" style="position:relative; display:inline-block;">
                                    <input type="hidden" name="status" id="add_prop_status" value="publish">
                                    <button type="button" id="add_prop_status_btn" class="adm-status-btn" onclick="toggleStatusDropdown('add_prop_status_menu')" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; font-size:12.5px; font-weight:700; border-radius:8px; cursor:pointer; border:1px solid #bbf7d0; background:#f0fdf4; color:#15803d; transition:all 0.15s ease;">
                                        <span class="status-dot" style="width:7px; height:7px; border-radius:50%; background:#22c55e;"></span>
                                        <span id="add_prop_status_label">Publish</span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:2px;"><polyline points="6 9 12 15 18 9"></polyline></svg>
                                    </button>
                                    <div id="add_prop_status_menu" class="adm-status-menu" style="display:none; position:absolute; right:0; top:calc(100% + 6px); background:#ffffff; border:1px solid #e2e8f0; border-radius:10px; box-shadow:0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.05); min-width:140px; padding:6px; z-index:9999;">
                                        <button type="button" onclick="selectFormStatus('publish', 'Publish', '#f0fdf4', '#bbf7d0', '#15803d', '#22c55e', 'add_prop_status', 'add_prop_status_btn', 'add_prop_status_label', 'add_prop_status_menu')" class="adm-status-opt" style="display:flex; align-items:center; gap:8px; width:100%; padding:7px 10px; font-size:13px; font-weight:600; border:none; background:none; border-radius:6px; cursor:pointer; color:#15803d; text-align:left;">
                                            <span style="width:7px; height:7px; border-radius:50%; background:#22c55e;"></span> Publish
                                        </button>
                                        <button type="button" onclick="selectFormStatus('draft', 'Draft', '#fffbeb', '#fde68a', '#b45309', '#f59e0b', 'add_prop_status', 'add_prop_status_btn', 'add_prop_status_label', 'add_prop_status_menu')" class="adm-status-opt" style="display:flex; align-items:center; gap:8px; width:100%; padding:7px 10px; font-size:13px; font-weight:600; border:none; background:none; border-radius:6px; cursor:pointer; color:#b45309; text-align:left;">
                                            <span style="width:7px; height:7px; border-radius:50%; background:#f59e0b;"></span> Draft
                                        </button>
                                        <button type="button" onclick="selectFormStatus('sold_out', 'Sold out', '#fef2f2', '#fecaca', '#b91c1c', '#ef4444', 'add_prop_status', 'add_prop_status_btn', 'add_prop_status_label', 'add_prop_status_menu')" class="adm-status-opt" style="display:flex; align-items:center; gap:8px; width:100%; padding:7px 10px; font-size:13px; font-weight:600; border:none; background:none; border-radius:6px; cursor:pointer; color:#b91c1c; text-align:left;">
                                            <span style="width:7px; height:7px; border-radius:50%; background:#ef4444;"></span> Sold out
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 18px;">
                            <div class="adm-field">
                                <label class="adm-label">Property Name <span style="color:#ef4444;">*</span></label>
                                <input type="text" name="title" id="add_prop_title" required placeholder="e.g. Wadeem Gardens" class="adm-input" oninput="syncPropertyTitle(this.value)">
                                <div class="adm-help">Display name used on the property card, page headers, and meta titles.</div>
                            </div>

                            <div class="adm-field">
                                <label class="adm-label">Route Slug (URL path)</label>
                                <input type="text" name="slug" id="add_prop_slug" placeholder="e.g. wadeem-gardens" class="adm-input" oninput="updateSlugLivePreview(this.value)">
                                <div class="adm-help">The web link path (e.g. <code>/wadeem-gardens</code>). Auto-generated from name if left blank.</div>
                            </div>
                        </div>

                        <!-- Headline (Auto-propagates to Hero Section) -->
                        <div class="adm-field" style="margin-bottom: 18px;">
                            <label class="adm-label">Headline</label>
                            <input type="text" name="headline" id="add_prop_headline" placeholder="e.g. Exclusive Waterfront Living Destination" class="adm-input" oninput="syncHeadline(this.value)">
                            <div class="adm-help">When you enter a headline here, it automatically applies to the Hero Section of the inner detail page.</div>
                        </div>

                        <!-- Neighbourhood / Community -->
                        <div class="adm-field" style="margin-bottom: 20px;">
                            <label class="adm-label">Neighbourhood/Community <span style="font-weight: 400; color: #64748b; font-size: 12px;">(Select Community)</span></label>
                            <select name="location" id="add_prop_location" class="adm-select" style="background: #ffffff; cursor: pointer;">
                                <option value="">-- Select Neighbourhood/Community --</option>
                                @forelse($communities ?? [] as $comm)
                                    @php
                                        $locValue = $comm->name . ($comm->city ? ', ' . $comm->city->name : '');
                                    @endphp
                                    <option value="{{ $locValue }}">
                                        {{ $locValue }}
                                    </option>
                                @empty
                                    <option value="" disabled>No communities found. Please add a community from sidebar first.</option>
                                @endforelse
                            </select>
                            <div class="adm-help">Jo community sidebar se add ki hai wo yahan dropdown me ayegi (Community, City format me card par show hogi).</div>
                        </div>

                        <!-- Card Badges / Attributes Drag & Drop (City ke neeche do input field) -->
                        <div class="adm-field" style="margin-bottom: 22px;">
                            <label class="adm-label" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                                <span style="display: flex; align-items: center; gap: 6px; font-weight: 700; color: #1e293b;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#1a4731" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                                    </svg>
                                    Card Badges / Attributes (Active on Card)
                                </span>
                                <span style="font-size: 11px; font-weight: 600; color: #059669; background: #ecfdf5; padding: 2px 8px; border-radius: 999px; border: 1px solid #a7f3d0;">
                                    Box 1 &bull; Active on Property Card
                                </span>
                            </label>
                            
                            <div id="add_selected_badges" class="badge-drag-box badge-selected-box"
                                 ondragover="handleBadgeDragOver(event)"
                                 ondragleave="handleBadgeDragLeave(event)"
                                 ondrop="handleBadgeDrop(event, 'add', 'selected')"
                                 style="min-height: 52px; background: #f8fafc; border: 2px dashed #94a3b8; border-radius: 10px; padding: 10px 14px; display: flex; flex-wrap: wrap; gap: 8px; align-items: center; transition: all 0.2s ease;">
                                <span class="badge-empty-hint" style="color: #94a3b8; font-size: 12.5px; font-style: italic; pointer-events: none; user-select: none;">
                                    Drag attributes here from Box 2 below (or click them) to display on this card
                                </span>
                            </div>
                            <input type="hidden" name="badges" id="add_badges_input" value="[]">
                            <div class="adm-help" style="margin-top: 4px; margin-bottom: 14px;">Whichever attribute you place in this first box will appear directly on the property card (replaces old price/delivery date).</div>

                            <label class="adm-label" style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 6px;">
                                <span style="display: flex; align-items: center; gap: 6px; font-weight: 700; color: #475569;">
                                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="3" width="7" height="7"></rect>
                                        <rect x="14" y="14" width="7" height="7"></rect>
                                        <rect x="3" y="14" width="7" height="7"></rect>
                                    </svg>
                                    Available Attributes
                                </span>
                                <span style="font-size: 11px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 999px;">
                                    Box 2 &bull; Drag with mouse to Box 1
                                </span>
                            </label>
                            
                            <div id="add_available_badges" class="badge-drag-box badge-available-box"
                                 ondragover="handleBadgeDragOver(event)"
                                 ondragleave="handleBadgeDragLeave(event)"
                                 ondrop="handleBadgeDrop(event, 'add', 'available')"
                                 style="min-height: 52px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 10px 14px; display: flex; flex-wrap: wrap; gap: 8px; align-items: center; transition: all 0.2s ease;">
                            </div>
                            <div class="adm-help" style="margin-top: 4px;">Click or drag any attribute into Box 1 above with your mouse. Drag back to remove.</div>
                        </div>

                        <!-- Property Card Image (Auto-syncs to Hero Background) -->
                        <div class="adm-field">
                            <label class="adm-label">Property Image</label>
                            <div class="adm-img-box">
                                <img id="preview_add_card_img" src="/images/communities/wadeem-gardens.png" class="adm-img-thumb-lg" alt="Card Preview">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <label class="adm-label" style="font-size: 11.5px; color: #64748b;">Upload from computer:</label>
                                        <input type="file" name="image_file" accept="image/*" class="adm-input" onchange="previewAddCardAndHeroImage(this)">
                                    </div>
                                    <input type="text" name="image" id="input_add_card_img" value="/images/communities/wadeem-gardens.png" class="adm-input" placeholder="Or enter image URL path (e.g. /images/communities/wadeem-gardens.png)" oninput="syncCardAndHeroImageUrl(this.value)">
                                    <div class="adm-help">Whichever image you upload or set here will show on the card front and also automatically on the inner page hero section.</div>
                                </div>
                            </div>
                        </div>

                        <!-- Page Nav & Publish Options -->
                        <div style="display: flex; gap: 24px; align-items: center; margin-top: 18px; padding-top: 14px; border-top: 1px solid #f1f5f9;">
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; color: #334155; cursor: pointer;">
                                <input type="checkbox" name="in_navbar" value="1" checked style="width: 16px; height: 16px; accent-color: #1a4731;">
                                <strong>Show in Navigation Menu</strong>
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; font-size: 13.5px; color: #334155; cursor: pointer;">
                                <input type="checkbox" name="is_published" value="1" checked style="width: 16px; height: 16px; accent-color: #1a4731;">
                                <strong>Published (Publicly accessible)</strong>
                            </label>
                        </div>
                    </div>

                    <!-- 2. HERO BANNER TAB -->
                    <div id="add_tab_hero" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Hero Banner Content</h2>
                                <p>Manage the large header visual, main heading, badge, and callback card.</p>
                            </div>
                            <span class="adm-chip">hero section</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Hero Background Image (Change Photo / Upload)</label>
                            <div class="adm-img-box">
                                <img id="preview_add_hero_img" src="/images/hero/slide-1.jpg" class="adm-img-thumb-lg" alt="Hero Preview">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <input type="file" name="section_files[hero][bg_image]" accept="image/*" class="adm-input" onchange="previewAddImage(this, 'preview_add_hero_img', 'input_add_hero_img')">
                                    </div>
                                    <input type="text" name="sections[hero][bg_image]" id="input_add_hero_img" value="/images/hero/slide-1.jpg" class="adm-input" placeholder="Or enter image path / URL (e.g. /images/hero/slide-1.jpg)" oninput="document.getElementById('preview_add_hero_img').src = this.value">
                                    <div class="adm-help">Upload a new hero background photo from your computer or specify a file path / URL.</div>
                                </div>
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Hero Image Alt Text (SEO)</label>
                            <input type="text" name="sections[hero][bg_image_alt]" id="add_hero_alt" placeholder="e.g. Wadeem Gardens at Hudayriyat Island" class="adm-input">
                            <div class="adm-help">Descriptive alternative text rendered inside the hero &lt;img alt="..."&gt; tag for search engine optimization (SEO) and accessibility.</div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Badge / Pretitle</label>
                            <input type="text" name="sections[hero][badge]" value="Freehold for All Nationalities" class="adm-input" placeholder="e.g. Freehold for All Nationalities">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="adm-field">
                                <label class="adm-label">Main Heading (H1)</label>
                                <textarea name="sections[hero][title]" id="add_hero_title" class="adm-textarea" rows="2" placeholder="e.g. Wadeem Gardens&#10;at Hudayriyat Island"></textarea>
                                <div class="adm-help">Line breaks render as visual breaks on the frontend.</div>
                            </div>

                            <div class="adm-field">
                                <label class="adm-label">Subtitle / Tagline</label>
                                <textarea name="sections[hero][subtitle]" id="add_hero_subtitle" class="adm-textarea" rows="2" placeholder="Abu Dhabi’s Most Exclusive Coastal Lifestyle Destination on Hudayriyat Island">Abu Dhabi’s Most Exclusive Coastal Lifestyle Destination on Hudayriyat Island</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. PROJECT HIGHLIGHTS TAB -->
                    <div id="add_tab_highlights" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Project Highlights</h2>
                                <p>Configure key highlight metrics (Developer, Price, Handover Date, Property Type, Ownership, Bedrooms).</p>
                            </div>
                            <span class="adm-chip">highlights</span>
                        </div>

                        <div id="add_highlights_list" style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                            <div class="adm-highlight-card" style="display: flex; gap: 12px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px;">
                                <input type="text" name="sections[highlights][items][0][label]" value="Developer" class="adm-input" style="flex: 1; font-weight: 600;" placeholder="Metric Name">
                                <input type="text" name="sections[highlights][items][0][value]" value="Modon Properties" class="adm-input" style="flex: 1;" placeholder="Value">
                            </div>
                            <div class="adm-highlight-card" style="display: flex; gap: 12px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px;">
                                <input type="text" name="sections[highlights][items][1][label]" value="Price" class="adm-input" style="flex: 1; font-weight: 600;" placeholder="Metric Name">
                                <input type="text" name="sections[highlights][items][1][value]" value="AED 2,500,000" class="adm-input" style="flex: 1;" placeholder="Value">
                            </div>
                            <div class="adm-highlight-card" style="display: flex; gap: 12px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px;">
                                <input type="text" name="sections[highlights][items][2][label]" value="Handover Date" class="adm-input" style="flex: 1; font-weight: 600;" placeholder="Metric Name">
                                <input type="text" name="sections[highlights][items][2][value]" value="Q4 2028" class="adm-input" style="flex: 1;" placeholder="Value">
                            </div>
                            <div class="adm-highlight-card" style="display: flex; gap: 12px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px;">
                                <input type="text" name="sections[highlights][items][3][label]" value="Property Type" class="adm-input" style="flex: 1; font-weight: 600;" placeholder="Metric Name">
                                <input type="text" name="sections[highlights][items][3][value]" value="Luxury Villas &amp; Apartments" class="adm-input" style="flex: 1;" placeholder="Value">
                            </div>
                            <div class="adm-highlight-card" style="display: flex; gap: 12px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px;">
                                <input type="text" name="sections[highlights][items][4][label]" value="Ownership" class="adm-input" style="flex: 1; font-weight: 600;" placeholder="Metric Name">
                                <input type="text" name="sections[highlights][items][4][value]" value="Freehold" class="adm-input" style="flex: 1;" placeholder="Value">
                            </div>
                        </div>

                        <button type="button" class="adm-btn adm-btn-secondary" onclick="addAddHighlightItem()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
                            + Add Metric Item
                        </button>
                    </div>

                    <!-- 4. ABOUT COMMUNITY TAB -->
                    <div id="add_tab_about" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>About Community &amp; Video</h2>
                                <p>Manage community story, narrative paragraphs, video stream URL, and cover poster.</p>
                            </div>
                            <span class="adm-chip">about</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Headline / Title</label>
                            <input type="text" name="sections[about][title]" id="add_about_title" class="adm-input" placeholder="e.g. Wadeem Gardens by Modon">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Community Overview &amp; Narrative</label>
                            <textarea name="sections[about][description]" id="add_about_desc" class="adm-textarea" rows="6" placeholder="Detailed story, architectural styling, villa sizes, and lifestyle details...">&lt;p&gt;A premier residential development by Modon Properties on Abu Dhabi’s prestigious Hudayriyat Island. Surrounded by pristine coastlines and lush parklands, this community offers a refined island lifestyle that effortlessly blends contemporary sophistication with seaside serenity.&lt;/p&gt;&lt;p&gt;Featuring open layouts, expansive terraces, and curated modern architecture, each residence is designed to maximize natural light and panoramic views of the Arabian Gulf.&lt;/p&gt;</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Featured Video Stream URL (.mp4 or link)</label>
                            <input type="text" name="sections[about][video_url]" value="/images/nawayef-park-views/asset_15.mp4" class="adm-input" placeholder="https://www.hudayriyat-island.com/storage/...mp4">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Video Poster / Cover Image</label>
                            <div class="adm-img-box">
                                <img id="preview_add_about_poster" src="/images/nawayef-park-views/asset_14.jpg" class="adm-img-thumb-lg" alt="Poster">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <input type="file" name="section_files[about][video_poster]" class="adm-input" accept="image/*" onchange="previewAddImage(this, 'preview_add_about_poster', 'input_add_about_poster')">
                                    </div>
                                    <input type="text" name="sections[about][video_poster]" id="input_add_about_poster" value="/images/nawayef-park-views/asset_14.jpg" class="adm-input" oninput="document.getElementById('preview_add_about_poster').src = this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 5. AMENITIES & FACILITIES TAB -->
                    <div id="add_tab_amenities" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Amenities &amp; Facilities</h2>
                                <p>Manage community amenities heading, lifestyle subtitle, and interactive facility cards with icons.</p>
                            </div>
                            <span class="adm-chip">amenities</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[amenities][title]" id="add_amenities_title" value="Community Amenities" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Subtitle / Lifestyle Description</label>
                            <textarea name="sections[amenities][subtitle]" class="adm-textarea" rows="2">Offers a complete coastal lifestyle with luxury amenities for wellness, recreation, and community living.</textarea>
                        </div>

                        <div id="add_amenities_container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(210px, 1fr)); gap: 12px; margin-top: 14px;">
                            @php
                                $defAmenities = [
                                    ['name' => 'Gymnasium', 'icon' => '/images/nawayef-park-views/asset_16.png'],
                                    ['name' => 'Yoga Zone', 'icon' => '/images/nawayef-park-views/asset_17.png'],
                                    ['name' => 'Co-working Area', 'icon' => '/images/nawayef-park-views/asset_18.png'],
                                    ['name' => 'Private Beach', 'icon' => '/images/nawayef-park-views/asset_20.png'],
                                    ['name' => 'Swimming Pool', 'icon' => '/images/nawayef-park-views/asset_22.png'],
                                    ['name' => 'Club House', 'icon' => '/images/nawayef-park-views/asset_23.png'],
                                ];
                            @endphp
                            @foreach($defAmenities as $aIdx => $amenity)
                                <div class="adm-card" style="border: 1px solid #e2e8f0; background: #fff; padding: 12px; border-radius: 8px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <img src="{{ $amenity['icon'] }}" style="width: 24px; height: 24px; object-fit: contain;">
                                        <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 11px; cursor: pointer;">✕ Delete</button>
                                    </div>
                                    <input type="text" name="sections[amenities][items][{{ $aIdx }}][name]" value="{{ $amenity['name'] }}" class="adm-input" style="font-size: 12px; font-weight: 600; margin-bottom: 6px;">
                                    <input type="text" name="sections[amenities][items][{{ $aIdx }}][icon]" value="{{ $amenity['icon'] }}" class="adm-input" style="font-size: 11px;">
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="adm-btn adm-btn-secondary" onclick="addAddAmenityCard()" style="margin-top: 14px; display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
                            + Add Amenity
                        </button>
                    </div>

                    <!-- 6. PROJECT GALLERY TAB -->
                    <div id="add_tab_gallery" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Project Gallery</h2>
                                <p>High-resolution photo showcase for community architecture and landscape.</p>
                            </div>
                            <span class="adm-chip">gallery</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Gallery Title</label>
                            <input type="text" name="sections[gallery][title]" value="Project Gallery" class="adm-input">
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 14px;">
                            @php
                                $defGallery = [
                                    ['src' => '/images/hero/slide-1.jpg', 'alt' => 'Exterior View'],
                                    ['src' => '/images/nawayef-park-views/asset_2.jpg', 'alt' => 'Architecture'],
                                    ['src' => '/images/wadeem-gardens/hero-1.png', 'alt' => 'Coastal Views'],
                                    ['src' => '/images/bashayer-residences/hero-slider-1.jpg', 'alt' => 'Interior Design'],
                                    ['src' => '/images/al-naseem-villas/hero-slider-1.jpg', 'alt' => 'Living Lounge'],
                                    ['src' => '/images/golf-estates/hero-1.jpg', 'alt' => 'Scenic Surroundings'],
                                ];
                            @endphp
                            @foreach($defGallery as $gIdx => $gItem)
                                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px;">
                                    <img id="preview_add_gal_{{ $gIdx }}" src="{{ $gItem['src'] }}" style="width: 100%; height: 95px; object-fit: cover; border-radius: 6px; margin-bottom: 8px;">
                                    <input type="text" name="sections[gallery][images][{{ $gIdx }}][src]" value="{{ $gItem['src'] }}" class="adm-input" style="font-size: 11px; margin-bottom: 6px;" oninput="document.getElementById('preview_add_gal_{{ $gIdx }}').src = this.value">
                                    <input type="text" name="sections[gallery][images][{{ $gIdx }}][alt]" value="{{ $gItem['alt'] }}" class="adm-input" placeholder="Alt text" style="font-size: 11px;">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 7. CONTENT TAB (WYSIWYG) -->
                    <div id="add_tab_content" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Content Editor</h2>
                                <p>Single visual WYSIWYG editor containing complete page article, H1/H2/H3 headings, paragraphs, and embedded photos.</p>
                            </div>
                            <span class="adm-chip">content section</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Page Article &amp; Community Body (Headings, Paragraphs, Images)</label>
                            <textarea name="sections[content][html]" id="add_content_wysiwyg" class="adm-textarea adm-summernote" data-height="500" rows="22"><p class="saimaIntroP">A premier benchmark for luxury waterfront living, seamlessly blending contemporary architectural elegance with a tranquil coastal sanctuary. Residents enjoy fresh sea breezes, private beach access, and immediate connectivity to key metropolitan hubs.</p>
<p class="saimaIntroP">Located along prestigious shoreline corridors, the community offers an inspired lifestyle for professionals, investors, and families seeking refined island elegance away from urban congestion.</p>
<p class="saimaIntroP">Every residence offers a harmonious blend of sophistication, security, and long-term capital appreciation, presenting an extraordinary investment opportunity in one of the most coveted coastal addresses.</p>

<h2 id="about-the-developers">About the Developers</h2>
<p>Crafted by premier developers renowned for shaping iconic waterfront communities across the region for decades. Buyers and international investors benefit from a celebrated track record of timely delivery, construction excellence, and sustainable urban design.</p>
<p>Working alongside leading international architectural consultants and market advisory firms, every aspect of the project is engineered to global standards of prestige and durability.</p>

<h2 id="project-approvals-noc">Approvals &amp; Clearances</h2>
<p>The project holds full regulatory clearance and title approvals from all relevant municipal and developmental authorities. Complying strictly with environmental and structural guidelines, purchasers can invest with absolute peace of mind and secure freehold ownership.</p>

<h2 id="prime-location-connectivity">Prime Location &amp; Seamless Connectivity</h2>
<p>Set within a scenic coastal landscape, the project offers rapid access to international airports, commercial business districts, premier private schools, and luxury retail destinations.</p>
<p><img src="/TOC1.png" alt="Strategic Location &amp; Connectivity Map" style="max-width: 100%; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); width: 100%; margin: 15px 0;"></p>
<p>Surrounded by protected green reserves and pristine waters, residents wake up to panoramic coastal vistas and unpolluted air throughout the year.</p>

<h2 id="architectural-excellence-floor-plans">Architectural Excellence &amp; Floor Plans</h2>
<p>The layouts focus on space efficiency, panoramic natural lighting, and seamless indoor-outdoor living with spacious private terraces and balconies.</p>

<h3 id="contemporary-luxury-layouts">Curated Residences &amp; Layout Types</h3>
<p><img src="/TOC2.png" alt="Luxury Layout Plan - Type C" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>
<p>Featuring open-plan living rooms, floor-to-ceiling double-glazed windows, designer show kitchens, and lavish en-suite master bedrooms designed for modern family living.</p>

<p><img src="/TOC3.png" alt="Executive Layout Plan - Type B" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>
<p>Expansive terraces provide seamless entertaining spaces overlooking lush landscaped courtyards and the sparkling coastline.</p>

<p><img src="/TOC4.png" alt="Presidential Villa Layout Plan - Type A" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>
<p>Generous multi-level accommodations including private elevators, maid's quarters, private swimming pools, and dedicated family lounges.</p>

<h2 id="master-plan-community-lifestyle">Master Plan &amp; Community Lifestyle</h2>
<p>The community master plan establishes a secure, private, and walkable residential haven. Dedicated subterranean parking ensures pedestrian safety across surface walkways, cycling trails, and waterfront boardwalks.</p>
<p><img src="/TOC8.png" alt="Community Master Plan Overview" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>

<h2 id="flexible-payment-plan">Flexible Investment &amp; Payment Plan</h2>
<p>A buyer-friendly, construction-linked payment structure is offered with flexible milestones, making property acquisition straightforward and stress-free.</p>
<p><img src="/TOC12.png" alt="Milestone Payment Structure" style="max-width: 100%; height: auto; border-radius: 8px; box-shadow: 0 4px 14px rgba(0,0,0,0.08); margin: 10px 0;"></p>

<h2 id="world-class-amenities">World-Class Facilities &amp; Amenities</h2>
<p>Enjoy infinity swimming pools, state-of-the-art fitness centres, private beach cabanas, children's play areas, multi-sport courts, and fine-dining waterfront restaurants just steps from your front door.</p></textarea>
                        </div>
                    </div>

                    <!-- 8. PAYMENT PLAN TAB -->
                    <div id="add_tab_payment_plan" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Payment Plan</h2>
                                <p>Milestone breakdown for down payment, during construction, and handover percentages.</p>
                            </div>
                            <span class="adm-chip">payment plan</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[payment_plan][title]" value="Payment Plan" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[payment_plan][description]" class="adm-textarea" rows="2">A flexible, milestone-linked payment structure making ownership effortless and transparent throughout the development phase.</textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 16px;">
                            <div>
                                <label class="adm-label">Down Payment</label>
                                <input type="text" name="sections[payment_plan][down_payment]" value="10%" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">During Construction</label>
                                <input type="text" name="sections[payment_plan][during_construction]" value="40%" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">On Handover</label>
                                <input type="text" name="sections[payment_plan][on_handover]" value="50%" class="adm-input">
                            </div>
                        </div>

                        <!-- Milestone Breakdown Rows -->
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            @php
                                $defMilestones = [
                                    ['milestone' => 'Down Payment', 'percentage' => '10%', 'due' => 'On Booking Date'],
                                    ['milestone' => 'Construction Milestone 1', 'percentage' => '10%', 'due' => '6 Months after Booking'],
                                    ['milestone' => 'Construction Milestone 2', 'percentage' => '10%', 'due' => '12 Months after Booking'],
                                    ['milestone' => 'Construction Milestone 3', 'percentage' => '10%', 'due' => '18 Months after Booking'],
                                    ['milestone' => 'Construction Milestone 4', 'percentage' => '10%', 'due' => '24 Months after Booking'],
                                    ['milestone' => 'On Handover', 'percentage' => '50%', 'due' => '100% Completion'],
                                ];
                            @endphp
                            @foreach($defMilestones as $mIdx => $mItem)
                                <div style="display: grid; grid-template-columns: 2fr 1fr 2fr; gap: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px;">
                                    <input type="text" name="sections[payment_plan][items][{{ $mIdx }}][milestone]" value="{{ $mItem['milestone'] }}" class="adm-input" style="font-size: 12px; font-weight: 600;">
                                    <input type="text" name="sections[payment_plan][items][{{ $mIdx }}][percentage]" value="{{ $mItem['percentage'] }}" class="adm-input" style="font-size: 12px; text-align: center;">
                                    <input type="text" name="sections[payment_plan][items][{{ $mIdx }}][due]" value="{{ $mItem['due'] }}" class="adm-input" style="font-size: 12px;">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 8. MASTER PLAN TAB -->
                    <div id="add_tab_master_plan" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Master Plan</h2>
                                <p>Community master plan visual diagram and descriptive features.</p>
                            </div>
                            <span class="adm-chip">master plan</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[master_plan][title]" value="Master Plan" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[master_plan][description]" class="adm-textarea" rows="3">The master plan creates a harmonious, walkable enclave where residential clusters are woven naturally into open green parklands, pedestrian corridors, and scenic waterfront trails.</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Master Plan Image</label>
                            <div class="adm-img-box">
                                <img id="preview_add_master_img" src="/images/nawayef-park-views/asset_2.jpg" class="adm-img-thumb-lg" alt="Master Plan">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <input type="file" name="section_files[master_plan][image]" class="adm-input" accept="image/*" onchange="previewAddImage(this, 'preview_add_master_img', 'input_add_master_img')">
                                    </div>
                                    <input type="text" name="sections[master_plan][image]" id="input_add_master_img" value="/images/nawayef-park-views/asset_2.jpg" class="adm-input" oninput="document.getElementById('preview_add_master_img').src = this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 9. LOCATION & CONNECTIVITY TAB -->
                    <div id="add_tab_location" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Location &amp; Connectivity</h2>
                                <p>Key Abu Dhabi destination drive times (Downtown, Airport, Louvre, etc.).</p>
                            </div>
                            <span class="adm-chip">location</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[location][title]" value="Seamless Access, Prime Location" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[location][description]" class="adm-textarea" rows="2">Conveniently located on Hudayriyat Island with direct access via modern bridges to Abu Dhabi’s key commercial, cultural, and travel hubs.</textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                            @php
                                $defLocations = [
                                    ['place' => 'Downtown Abu Dhabi', 'time' => '20 mins'],
                                    ['place' => 'Emirates Palace', 'time' => '23 mins'],
                                    ['place' => 'Sheikh Zayed Grand Mosque', 'time' => '23 mins'],
                                    ['place' => 'Abu Dhabi Global Financial Centre', 'time' => '30 mins'],
                                    ['place' => 'Louvre Abu Dhabi', 'time' => '33 mins'],
                                    ['place' => 'Zayed International Airport', 'time' => '34 mins'],
                                ];
                            @endphp
                            @foreach($defLocations as $lIdx => $lItem)
                                <div style="display: flex; gap: 8px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px;">
                                    <input type="text" name="sections[location][items][{{ $lIdx }}][place]" value="{{ $lItem['place'] }}" class="adm-input" style="flex: 2; font-size: 12px; font-weight: 600;">
                                    <input type="text" name="sections[location][items][{{ $lIdx }}][time]" value="{{ $lItem['time'] }}" class="adm-input" style="flex: 1; font-size: 12px; text-align: center;">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- 10. FREQUENTLY ASKED QUESTIONS TAB -->
                    <div id="add_tab_faq" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Frequently Asked Questions</h2>
                                <p>Configure FAQ accordion items with rich answers.</p>
                            </div>
                            <span class="adm-chip">faq</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[faq][title]" value="Frequently Asked Questions" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[faq][description]" class="adm-textarea" rows="2">Key information and helpful answers regarding property purchases on Hudayriyat Island.</textarea>
                        </div>

                        <div id="add_faq_container" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 14px;">
                            @php
                                $defFaqs = [
                                    ['q' => 'Is this a freehold development?', 'a' => 'Yes, it is a 100% freehold development open to buyers and investors of all nationalities worldwide.'],
                                    ['q' => 'What are the expected handover dates?', 'a' => 'Handover is scheduled for Q4 2028, with milestone construction progress reports delivered periodically to registered owners.'],
                                    ['q' => 'What amenities are available within the community?', 'a' => 'Residents enjoy private access to a clubhouse, swimming pools, fitness centers, sports courts, cycle tracks, and direct beach access.'],
                                    ['q' => 'Does this purchase qualify for the UAE Golden Visa?', 'a' => 'Yes, property investments valued at AED 2,000,000 or above qualify for the 10-year renewable UAE Golden Visa.'],
                                ];
                            @endphp
                            @foreach($defFaqs as $fIdx => $fItem)
                                <div class="adm-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                        <strong style="font-size: 12px; color: #475569;">Question #{{ $fIdx + 1 }}</strong>
                                        <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 11px; cursor: pointer;">✕ Delete</button>
                                    </div>
                                    <input type="text" name="sections[faq][items][{{ $fIdx }}][question]" value="{{ $fItem['q'] }}" class="adm-input" placeholder="Question..." style="margin-bottom: 6px; font-weight: 600; font-size: 12.5px;">
                                    <textarea name="sections[faq][items][{{ $fIdx }}][answer]" class="adm-textarea" rows="2" placeholder="Answer..." style="font-size: 12px;">{{ $fItem['a'] }}</textarea>
                                </div>
                            @endforeach
                        </div>

                        <button type="button" class="adm-btn adm-btn-secondary" onclick="addAddFaqItem()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
                            + Add Question
                        </button>
                    </div>

                    <!-- 11. CONTACT & BOOKING CTA TAB -->
                    <div id="add_tab_contact" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Contact &amp; Booking CTA</h2>
                                <p>High-conversion booking form, advisor contact details, and direct inquiry card.</p>
                            </div>
                            <span class="adm-chip">contact</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Headline / Title</label>
                            <input type="text" name="sections[contact][title]" value="Register Your Interest" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Subtitle / Narrative</label>
                            <textarea name="sections[contact][subtitle]" class="adm-textarea" rows="2">Our property specialists will contact you with VIP floor plans, pricing sheets, and private site visit bookings.</textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px;">
                            <div>
                                <label class="adm-label">Button Text</label>
                                <input type="text" name="sections[contact][button_text]" value="REGISTER INTEREST" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">Phone</label>
                                <input type="text" name="sections[contact][phone]" value="+971 2 000 0000" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">Email</label>
                                <input type="text" name="sections[contact][email]" value="info@hudayriyat-island.com" class="adm-input">
                            </div>
                        </div>
                    </div>

                    <!-- 13. SEO & META TAB -->
                    <div id="add_tab_seo" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>SEO &amp; Search Engine Metadata</h2>
                                <p>Control search engine snippet previews, page title tags, and Google indexing description.</p>
                            </div>
                            <span class="adm-chip">seo</span>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Meta Title (Page Title Tag)</label>
                            <input type="text" name="meta_title" id="add_meta_title" placeholder="e.g. Wadeem Gardens | Luxury Freehold Villas at Hudayriyat Island Abu Dhabi" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Meta Description</label>
                            <textarea name="meta_description" id="add_meta_desc" class="adm-textarea" rows="3" placeholder="e.g. Explore Wadeem Gardens on Hudayriyat Island, Abu Dhabi. Discover freehold residences, pricing, master plan, and world-class amenities."></textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Meta Keywords</label>
                            <input type="text" name="meta_keywords" id="add_meta_keywords" placeholder="e.g. Wadeem Gardens, Hudayriyat Island, Abu Dhabi villas, Modon Properties" class="adm-input">
                        </div>
                    </div>

                    <!-- Sticky Bottom Action Bar matching Screenshot 1 -->
                    <div class="adm-sticky-save" style="display: flex; justify-content: space-between; align-items: center; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 22px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); margin-top: 24px;">
                        <div style="font-size: 13.5px; color: #475569;">
                            Saving changes for <strong id="newCardNamePreview" style="color: #1e293b;">New Property</strong>
                        </div>
                        <div style="display: flex; gap: 10px; align-items: center;">
                            <button type="button" class="adm-btn adm-btn-secondary" onclick="toggleAddCardForm()" style="padding: 9px 18px; border-radius: 8px; font-size: 13px;">Cancel</button>
                            <button type="submit" class="adm-btn adm-btn-primary" style="background: #1a4731; border-color: #1a4731; color: #fff; padding: 10px 24px; border-radius: 8px; font-weight: 600; font-size: 13.5px; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 2px 6px rgba(26,71,49,0.2);">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                Save Changes
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>

    <!-- Main Table Container -->
    <div class="adm-card" style="background:#ffffff; border-radius:16px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.03); padding:28px 32px 36px; margin-bottom:30px;">
        
        <!-- Search Bar -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:24px; gap:16px; flex-wrap:wrap;">
            <div style="position:relative; width:100%; max-width:320px;">
                <svg style="position:absolute; left:14px; top:50%; transform:translateY(-50%); width:16px; height:16px; color:#94a3b8; pointer-events:none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="projectSearchInput" placeholder="Search property cards..." style="width:100%; background:#f8fafc; border:1px solid #f1f5f9; border-radius:10px; padding:10px 14px 10px 40px; font-size:13.5px; color:#1e293b; outline:none; transition:all 0.2s;" onkeyup="filterProjectCards(this.value)">
            </div>
            <div style="font-size: 13px; color: #64748b;">
                Showing <strong>{{ $totalProjects }}</strong> Featured Cards ({{ $activeProjects }} Active)
            </div>
        </div>

        <!-- Table of Property Cards -->
        <div style="width:100%; overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr style="border-bottom:1px solid #f1f5f9;">
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; width:80px;">#</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em;">NAME</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; width:150px;">STATUS</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; text-align:right; width:140px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="projectsTableBody">
                    @forelse($projects as $project)
                        <tr class="project-card-row" data-search="{{ strtolower($project->title . ' ' . $project->location . ' ' . ($project->page->title ?? '')) }}" style="border-bottom:1px dotted #e2e8f0; transition:background 0.15s ease;">
                            <td style="padding:18px 12px; font-size:14px; color:#64748b; font-weight:500;">
                                {{ $loop->iteration }}
                            </td>
                            <td style="padding:16px 12px; font-size:14.5px; color:#334155; font-weight:500;">
                                <a href="{{ route('admin.projects.edit', $project) }}" style="font-weight:600; color:#1e293b; text-decoration:none;" onmouseover="this.style.color='#0284c7'" onmouseout="this.style.color='#1e293b'">{{ $project->title }}</a>
                                <span style="font-size:12px; color:#94a3b8; display:block; margin-top:3px; font-family:Consolas, Monaco, monospace;">
                                    /{{ ltrim($project->page->slug ?? $project->slug ?? '', '/') }}
                                </span>
                            </td>

                            <!-- Status Column -->
                            <td style="padding:16px 12px; vertical-align:middle;">
                                @php
                                    $projStatus = $project->status ?: ($project->is_active ? 'publish' : 'draft');
                                    $badgeConfig = match($projStatus) {
                                        'sold_out' => ['bg' => '#fef2f2', 'border' => '#fecaca', 'color' => '#b91c1c', 'dot' => '#ef4444', 'label' => 'Sold out'],
                                        'draft'    => ['bg' => '#fffbeb', 'border' => '#fde68a', 'color' => '#b45309', 'dot' => '#f59e0b', 'label' => 'Draft'],
                                        default    => ['bg' => '#f0fdf4', 'border' => '#bbf7d0', 'color' => '#15803d', 'dot' => '#22c55e', 'label' => 'Publish'],
                                    };
                                @endphp
                                <span style="display:inline-flex; align-items:center; gap:6px; padding:4px 10px; font-size:12px; font-weight:700; border-radius:6px; border:1px solid {{ $badgeConfig['border'] }}; background:{{ $badgeConfig['bg'] }}; color:{{ $badgeConfig['color'] }}; text-transform:capitalize; user-select:none;">
                                    <span style="width:6px; height:6px; border-radius:50%; background:{{ $badgeConfig['dot'] }};"></span>
                                    <span>{{ $badgeConfig['label'] }}</span>
                                </span>
                            </td>

                            <!-- Actions -->
                            <td style="padding:16px 12px; text-align:right;">
                                <div style="display:inline-flex; align-items:center; justify-content:flex-end; gap:6px;">
                                    <!-- Edit Property Full Page & Badges Button (Screenshot 1 / 2) -->
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="cms-action-btn" title="Edit Property (Full Edit & Badges)">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </a>

                                    @if($project->page)
                                    <!-- Edit Linked Detail Page -->
                                    <a href="{{ route('admin.pages.edit', $project->page) }}" class="cms-action-btn" title="Edit Detail Page (Hero, Highlights, FAQ...)">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                            <polyline points="14 2 14 8 20 8"></polyline>
                                            <line x1="16" y1="13" x2="8" y2="13"></line>
                                            <line x1="16" y1="17" x2="8" y2="17"></line>
                                            <polyline points="10 9 9 9 8 9"></polyline>
                                        </svg>
                                    </a>
                                    @endif

                                    <!-- View Live Link -->
                                    <a href="{{ $project->url }}" target="_blank" rel="noopener" class="cms-action-btn" title="View Detail Page">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>

                                    <!-- Delete Icon -->
                                    <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" onsubmit="return confirm('Are you sure you want to remove card \'{{ addslashes($project->title) }}\'?');" style="display:inline; margin:0; padding:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cms-action-btn cms-action-delete" title="Delete Card" style="background:none; border:none; cursor:pointer; padding:0;">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align:center; padding:40px; color:#94a3b8; font-size:14px;">
                                No property cards created yet. Click "+ Add Property" above to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Property Card Modal -->
<div id="editCardModal" class="modal-overlay" style="display: none;">
    <div style="background: #ffffff; border-radius: 16px; width: 100%; max-width: 680px; max-height: 90vh; overflow-y: auto; padding: 26px 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 12px;">
            <h3 style="margin: 0; font-size: 17px; font-weight: 700; color: #1e293b;">Edit Property Card</h3>
            <button type="button" onclick="closeEditModal()" style="background: none; border: none; font-size: 22px; color: #94a3b8; cursor: pointer;">&times;</button>
        </div>

        <form id="editCardForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
                <!-- Property Name -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Property Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" id="edit_title" name="title" required class="adm-input" style="width: 100%; border-radius: 8px;">
                </div>

                <!-- Linked Page Dropdown -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #1e3a8a; margin-bottom: 5px; text-transform: uppercase;">
                        🔗 Detail Page Link (page_id)
                    </label>
                    <select id="edit_page_id" name="page_id" class="adm-input" style="width: 100%; border-radius: 8px; background: #eff6ff; border-color: #93c5fd; font-weight: 600; color: #1e3a8a;">
                        <option value="">-- No Attached Detail Page --</option>
                        @foreach($pages as $p)
                            <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->slug === '/' ? '/' : '/' . $p->slug }})</option>
                        @endforeach
                    </select>
                </div>

                <!-- Headline -->
                <div style="grid-column: span 2;">
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">
                        Headline
                    </label>
                    <input type="text" id="edit_headline" name="headline" placeholder="Inner page hero section headline" class="adm-input" style="width: 100%; border-radius: 8px;">
                </div>

                <!-- Neighbourhood / Community Dropdown -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Neighbourhood/Community</label>
                    <select id="edit_location" name="location" class="adm-input" style="width: 100%; border-radius: 8px; background: #ffffff; cursor: pointer;">
                        <option value="">-- Select Neighbourhood/Community --</option>
                        @forelse($communities ?? [] as $comm)
                            @php
                                $locValue = $comm->name . ($comm->city ? ', ' . $comm->city->name : '');
                            @endphp
                            <option value="{{ $locValue }}">
                                {{ $locValue }}
                            </option>
                        @empty
                            <option value="" disabled>No communities found.</option>
                        @endforelse
                    </select>
                </div>

                <!-- Status -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Status</label>
                    <select id="edit_status" name="status" class="adm-input" style="width: 100%; border-radius: 8px;">
                        <option value="publish">Publish</option>
                        <option value="draft">Draft</option>
                        <option value="sold_out">Sold out</option>
                    </select>
                </div>

                <!-- Card Badges / Attributes Drag & Drop (City ke neeche do input field) -->
                <div style="grid-column: span 2; margin-top: 4px;">
                    <label style="display: flex; align-items: center; justify-content: space-between; font-size: 11.5px; font-weight: 700; color: #1e293b; margin-bottom: 6px; text-transform: uppercase;">
                        <span style="display: flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1a4731" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                            Card Badges (Selected – Active on Card)
                        </span>
                        <span style="font-size: 11px; font-weight: 600; color: #059669; background: #ecfdf5; padding: 2px 8px; border-radius: 999px; border: 1px solid #a7f3d0; text-transform: none;">
                            Box 1 &bull; Active on Property Card
                        </span>
                    </label>
                    
                    <div id="edit_selected_badges" class="badge-drag-box badge-selected-box"
                         ondragover="handleBadgeDragOver(event)"
                         ondragleave="handleBadgeDragLeave(event)"
                         ondrop="handleBadgeDrop(event, 'edit', 'selected')"
                         style="min-height: 50px; background: #f8fafc; border: 2px dashed #94a3b8; border-radius: 10px; padding: 10px 14px; display: flex; flex-wrap: wrap; gap: 8px; align-items: center; transition: all 0.2s ease;">
                        <span class="badge-empty-hint" style="color: #94a3b8; font-size: 12.5px; font-style: italic; pointer-events: none; user-select: none;">
                            Drag attributes here from Box 2 below (or click them) to display on this card
                        </span>
                    </div>
                    <input type="hidden" name="badges" id="edit_badges_input" value="[]">
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 4px; margin-bottom: 14px;">Whichever attribute you place in this first box will appear directly on the property card (replaces old price/delivery date).</div>

                    <label style="display: flex; align-items: center; justify-content: space-between; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">
                        <span style="display: flex; align-items: center; gap: 6px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="7" height="7"></rect>
                                <rect x="14" y="3" width="7" height="7"></rect>
                                <rect x="14" y="14" width="7" height="7"></rect>
                                <rect x="3" y="14" width="7" height="7"></rect>
                            </svg>
                            Available Attributes
                        </span>
                        <span style="font-size: 11px; font-weight: 600; color: #64748b; background: #f1f5f9; padding: 2px 8px; border-radius: 999px; text-transform: none;">
                            Box 2 &bull; Drag with mouse to Box 1
                        </span>
                    </label>
                    
                    <div id="edit_available_badges" class="badge-drag-box badge-available-box"
                         ondragover="handleBadgeDragOver(event)"
                         ondragleave="handleBadgeDragLeave(event)"
                         ondrop="handleBadgeDrop(event, 'edit', 'available')"
                         style="min-height: 50px; background: #ffffff; border: 1.5px solid #cbd5e1; border-radius: 10px; padding: 10px 14px; display: flex; flex-wrap: wrap; gap: 8px; align-items: center; transition: all 0.2s ease;">
                    </div>
                    <div style="font-size: 11.5px; color: #64748b; margin-top: 4px;">Click or drag any attribute into Box 1 above with your mouse. Drag back to remove.</div>
                </div>
            </div>

            <!-- Image Settings (Auto-syncs to Hero background) -->
            <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px; padding: 16px; margin-bottom: 20px;">
                <div style="font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 4px;">Update Image</div>
                <div style="font-size: 11.5px; color: #64748b; margin-bottom: 10px;">When updated, this image applies to the property card and automatically sets the inner page hero background.</div>
                <div style="display: grid; grid-template-columns: 80px 1fr; gap: 14px; align-items: center;">
                    <div style="width: 80px; height: 55px; border-radius: 6px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1;">
                        <img id="edit_preview_img" src="" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div>
                        <input type="file" name="image_file" accept="image/*" class="adm-input" style="width: 100%; font-size: 12px; margin-bottom: 6px;" onchange="previewAddImage(this, 'edit_preview_img', 'edit_image')">
                        <input type="text" id="edit_image" name="image" placeholder="/images/communities/... or image URL" class="adm-input" style="width: 100%; font-size: 12px;" oninput="document.getElementById('edit_preview_img').src = this.value">
                    </div>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="adm-btn adm-btn-secondary" onclick="closeEditModal()">Cancel</button>
                <button type="submit" class="adm-btn adm-btn-primary">Update Property Card</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleAddCardForm() {
        const box = document.getElementById('addCardFormBox');
        box.style.display = (box.style.display === 'none' || box.style.display === '') ? 'block' : 'none';
        if (box.style.display === 'block') {
            box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            if (window.initSummernote) {
                window.initSummernote();
            }
        }
    }

    function switchAddTab(tabKey) {
        const box = document.getElementById('addCardFormBox');
        if (!box) return;

        // Deactivate all tabs & panes inside addCardFormBox
        box.querySelectorAll('.adm-tabs .adm-tab').forEach(t => t.classList.remove('is-active'));
        box.querySelectorAll('.adm-edit-form-area .tab-pane').forEach(p => p.classList.remove('active'));

        // Activate matching tab button & pane
        const targetBtn = box.querySelector(`.adm-tabs .adm-tab[data-tab-id="${tabKey}"]`);
        const targetPane = document.getElementById(`add_tab_${tabKey}`);

        if (targetBtn) targetBtn.classList.add('is-active');
        if (targetPane) {
            targetPane.classList.add('active');
            if (tabKey === 'content' || tabKey === 'about') {
                if (window.initSummernote) window.initSummernote();
            }
        }
    }

    let slugUserEdited = false;
    document.getElementById('add_prop_slug')?.addEventListener('input', function() {
        slugUserEdited = true;
    });

    function slugify(text) {
        return text.toString().toLowerCase().trim()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-');
    }

    function syncPropertyTitle(val) {
        val = val.trim();
        const displayVal = val || 'New Property';
        
        // Update Bottom Bar Preview
        const previewEl = document.getElementById('newCardNamePreview');
        if (previewEl) previewEl.textContent = displayVal;

        // Auto Slugify if user hasn't manually edited
        if (!slugUserEdited) {
            const cleanSlug = slugify(val) || 'new-property';
            const slugInput = document.getElementById('add_prop_slug');
            if (slugInput) slugInput.value = cleanSlug;
            updateSlugLivePreview(cleanSlug);
        }

        // Auto-fill Headline from Property Name
        const headlineInput = document.getElementById('add_prop_headline');
        if (headlineInput && !headlineInput.dataset.edited) {
            headlineInput.value = val;
            syncHeadline(val);
        }

        // Auto pre-populate defaults for sections
        const heroTitle = document.getElementById('add_hero_title');
        if (heroTitle && !heroTitle.dataset.edited) {
            heroTitle.value = val ? (val + '\nat Hudayriyat Island') : '';
        }

        const heroAlt = document.getElementById('add_hero_alt');
        if (heroAlt && !heroAlt.dataset.edited) {
            heroAlt.value = val ? (val + ' at Hudayriyat Island') : '';
        }

        const aboutTitle = document.getElementById('add_about_title');
        if (aboutTitle && !aboutTitle.dataset.edited) {
            aboutTitle.value = val ? (val + ' by Modon') : '';
        }

        const amTitle = document.getElementById('add_amenities_title');
        if (amTitle && !amTitle.dataset.edited) {
            amTitle.value = val ? (val + ' Amenities') : 'Community Amenities';
        }

        const metaTitle = document.getElementById('add_meta_title');
        if (metaTitle && !metaTitle.dataset.edited) {
            metaTitle.value = val ? (val + ' | Luxury Freehold Villas at Hudayriyat Island Abu Dhabi') : '';
        }
    }

    // Track manual edits so auto-sync doesn't override intentional user changes
    ['add_prop_headline', 'add_hero_title', 'add_hero_alt', 'add_about_title', 'add_amenities_title', 'add_meta_title'].forEach(id => {
        document.getElementById(id)?.addEventListener('input', function() {
            this.dataset.edited = 'true';
        });
    });

    document.getElementById('edit_title')?.addEventListener('input', function() {
        const editHeadline = document.getElementById('edit_headline');
        if (editHeadline && !editHeadline.dataset.edited) {
            editHeadline.value = this.value;
        }
    });
    document.getElementById('edit_headline')?.addEventListener('input', function() {
        this.dataset.edited = 'true';
    });

    function syncHeadline(val) {
        val = val || '';
        const heroSubtitle = document.getElementById('add_hero_subtitle');
        if (heroSubtitle) {
            heroSubtitle.value = val;
        }
    }

    function previewAddCardAndHeroImage(input) {
        previewAddImage(input, 'preview_add_card_img', 'input_add_card_img');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const heroPreview = document.getElementById('preview_add_hero_img');
                if (heroPreview) heroPreview.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function syncCardAndHeroImageUrl(val) {
        const cardPreview = document.getElementById('preview_add_card_img');
        if (cardPreview) cardPreview.src = val;
        const heroInput = document.getElementById('input_add_hero_img');
        if (heroInput) heroInput.value = val;
        const heroPreview = document.getElementById('preview_add_hero_img');
        if (heroPreview) heroPreview.src = val;
    }

    function updateSlugLivePreview(val) {
        const previewEl = document.getElementById('slugLivePreview');
        if (previewEl) {
            previewEl.textContent = slugify(val) || 'new-property';
        }
    }

    function previewAddImage(input, previewImgId, textInputId) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById(previewImgId);
                if (img) img.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    let addHighlightIdx = 5;
    function addAddHighlightItem() {
        const container = document.getElementById('add_highlights_list');
        if (!container) return;
        const row = document.createElement('div');
        row.className = 'adm-highlight-card';
        row.style.cssText = 'display: flex; gap: 12px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px;';
        row.innerHTML = `
            <input type="text" name="sections[highlights][items][${addHighlightIdx}][label]" placeholder="Metric Name (e.g. Bedrooms)" class="adm-input" style="flex: 1; font-weight: 600;">
            <input type="text" name="sections[highlights][items][${addHighlightIdx}][value]" placeholder="Value (e.g. 3 to 6 Bedrooms)" class="adm-input" style="flex: 1;">
            <button type="button" onclick="this.closest('.adm-highlight-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer;">✕</button>
        `;
        container.appendChild(row);
        addHighlightIdx++;
    }

    let addAmenityIdx = 10;
    function addAddAmenityCard() {
        const container = document.getElementById('add_amenities_container');
        if (!container) return;
        const card = document.createElement('div');
        card.className = 'adm-card';
        card.style.cssText = 'border: 1px solid #e2e8f0; background: #fff; padding: 12px; border-radius: 8px;';
        card.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <img src="/images/nawayef-park-views/asset_16.png" style="width: 24px; height: 24px; object-fit: contain;">
                <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 11px; cursor: pointer;">✕ Delete</button>
            </div>
            <input type="text" name="sections[amenities][items][${addAmenityIdx}][name]" placeholder="Amenity Name" class="adm-input" style="font-size: 12px; font-weight: 600; margin-bottom: 6px;">
            <input type="text" name="sections[amenities][items][${addAmenityIdx}][icon]" value="/images/nawayef-park-views/asset_16.png" class="adm-input" style="font-size: 11px;">
        `;
        container.appendChild(card);
        addAmenityIdx++;
    }

    let addFaqIdx = 10;
    function addAddFaqItem() {
        const container = document.getElementById('add_faq_container');
        if (!container) return;
        const card = document.createElement('div');
        card.className = 'adm-card';
        card.style.cssText = 'background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px;';
        card.innerHTML = `
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                <strong style="font-size: 12px; color: #475569;">New Question</strong>
                <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 11px; cursor: pointer;">✕ Delete</button>
            </div>
            <input type="text" name="sections[faq][items][${addFaqIdx}][question]" placeholder="Question..." class="adm-input" style="margin-bottom: 6px; font-weight: 600; font-size: 12.5px;">
            <textarea name="sections[faq][items][${addFaqIdx}][answer]" class="adm-textarea" rows="2" placeholder="Answer..." style="font-size: 12px;"></textarea>
        `;
        container.appendChild(card);
        addFaqIdx++;
    }

    function filterProjectCards(query) {
        query = query.toLowerCase().trim();
        const rows = document.querySelectorAll('.project-card-row');
        rows.forEach(r => {
            const data = r.getAttribute('data-search') || '';
            r.style.display = data.includes(query) ? '' : 'none';
        });
    }

    function openEditModal(project) {
        document.getElementById('editCardForm').action = '/admin/projects/' + project.id;
        document.getElementById('edit_title').value = project.title || '';
        document.getElementById('edit_page_id').value = project.page_id || '';
        document.getElementById('edit_headline').value = project.headline || '';

        // Select or add location in Pakistan dropdown
        const locSelect = document.getElementById('edit_location');
        if (locSelect) {
            const targetLoc = (project.location || '').trim();
            if (targetLoc) {
                let found = false;
                for (let i = 0; i < locSelect.options.length; i++) {
                    if (locSelect.options[i].value.toLowerCase() === targetLoc.toLowerCase()) {
                        locSelect.selectedIndex = i;
                        found = true;
                        break;
                    }
                }
                if (!found) {
                    const opt = new Option(targetLoc, targetLoc, true, true);
                    locSelect.add(opt);
                }
            }
        }

        document.getElementById('edit_image').value = project.image || '';
        document.getElementById('edit_status').value = project.status || (project.is_active ? 'publish' : 'draft');
        document.getElementById('edit_preview_img').src = project.image || '/images/communities/wadeem-gardens.png';
        
        // Sync project badges to editBadgeManager
        if (window.editBadgeManager) {
            let b = project.badges;
            if (typeof b === 'string') {
                try { b = JSON.parse(b); } catch(e) { b = []; }
            }
            window.editBadgeManager.setSelected(Array.isArray(b) ? b : []);
        }

        document.getElementById('editCardModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editCardModal').style.display = 'none';
    }

    // Close on backdrop click
    document.getElementById('editCardModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });

    // Status Dropdown Functions
    function toggleStatusDropdown(menuId) {
        const menu = document.getElementById(menuId);
        if (!menu) return;
        const isShown = menu.style.display === 'block';
        document.querySelectorAll('.adm-status-menu').forEach(m => m.style.display = 'none');
        menu.style.display = isShown ? 'none' : 'block';
    }

    function selectFormStatus(statusVal, label, bg, border, color, dotColor, inputId, btnId, labelId, menuId) {
        const hiddenInput = document.getElementById(inputId);
        if (hiddenInput) hiddenInput.value = statusVal;

        const btn = document.getElementById(btnId);
        if (btn) {
            btn.style.background = bg;
            btn.style.borderColor = border;
            btn.style.color = color;
            const dot = btn.querySelector('.status-dot');
            if (dot) dot.style.background = dotColor;
        }

        const lbl = document.getElementById(labelId);
        if (lbl) lbl.textContent = label;

        const menu = document.getElementById(menuId);
        if (menu) menu.style.display = 'none';
    }

    function quickUpdateProjectStatus(projectId, newStatus, btnId, menuId) {
        const btn = document.getElementById(btnId);
        const menu = document.getElementById(menuId);
        if (menu) menu.style.display = 'none';

        const config = {
            'publish': { bg: '#f0fdf4', border: '#bbf7d0', color: '#15803d', dot: '#22c55e', label: 'Publish' },
            'draft': { bg: '#fffbeb', border: '#fde68a', color: '#b45309', dot: '#f59e0b', label: 'Draft' },
            'sold_out': { bg: '#fef2f2', border: '#fecaca', color: '#b91c1c', dot: '#ef4444', label: 'Sold out' }
        }[newStatus] || { bg: '#f0fdf4', border: '#bbf7d0', color: '#15803d', dot: '#22c55e', label: 'Publish' };

        if (btn) {
            btn.style.background = config.bg;
            btn.style.borderColor = config.border;
            btn.style.color = config.color;
            const dot = btn.querySelector('.status-dot');
            if (dot) dot.style.background = config.dot;
            const txt = btn.querySelector('.status-text');
            if (txt) txt.textContent = config.label;
        }

        fetch('/admin/projects/' + projectId + '/status', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: newStatus })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                alert('Failed to update status');
            }
        })
        .catch(err => {
            console.error(err);
        });
    }

    // Close status menus on outside click
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.adm-status-dropdown-wrap')) {
            document.querySelectorAll('.adm-status-menu').forEach(m => m.style.display = 'none');
        }
    });

    /* ==========================================================================
       DRAG & DROP CARD BADGES / ATTRIBUTES MANAGER
       Supports mouse drag-and-drop between Box 1 (Selected) and Box 2 (Available),
       as well as click-to-move and removal.
       ========================================================================== */
    const ALL_CARD_ATTRIBUTES = ['New', 'Offer', 'Off plan', 'Ready'];

    const ATTR_STYLES = {
        'New':      { bg: '#ecfdf5', border: '#a7f3d0', text: '#065f46', activeBg: '#059669' },
        'Offer':    { bg: '#fffbeb', border: '#fde68a', text: '#92400e', activeBg: '#d97706' },
        'Off plan': { bg: '#f1f5f9', border: '#cbd5e1', text: '#334155', activeBg: '#1a4731' },
        'Ready':    { bg: '#eff6ff', border: '#bfdbfe', text: '#1e40af', activeBg: '#2563eb' }
    };

    class BadgeManager {
        constructor(prefix, initialSelected = []) {
            this.prefix = prefix;
            this.selectedBox = document.getElementById(prefix + '_selected_badges');
            this.availableBox = document.getElementById(prefix + '_available_badges');
            this.hiddenInput = document.getElementById(prefix + '_badges_input');
            this.selected = Array.isArray(initialSelected) ? [...initialSelected] : [];
            this.render();
        }

        setSelected(items) {
            this.selected = Array.isArray(items) ? [...items] : [];
            this.render();
        }

        add(attr) {
            if (!this.selected.includes(attr)) {
                this.selected.push(attr);
                this.render();
            }
        }

        remove(attr) {
            this.selected = this.selected.filter(x => x !== attr);
            this.render();
        }

        render() {
            if (!this.selectedBox || !this.availableBox || !this.hiddenInput) return;

            // Sync hidden input value as JSON
            this.hiddenInput.value = JSON.stringify(this.selected);

            // 1. Render Box 1 (Selected / Active on Card)
            this.selectedBox.innerHTML = '';
            if (this.selected.length === 0) {
                const hint = document.createElement('span');
                hint.className = 'badge-empty-hint';
                hint.style.cssText = 'color: #94a3b8; font-size: 12.5px; font-style: italic; pointer-events: none; user-select: none;';
                hint.textContent = 'Drag attributes here from Box 2 below (or click them) to display on this card';
                this.selectedBox.appendChild(hint);
            } else {
                this.selected.forEach((attr, idx) => {
                    const el = this.createSelectedBadgeEl(attr, idx);
                    this.selectedBox.appendChild(el);
                });
            }

            // 2. Render Box 2 (Available Attributes)
            this.availableBox.innerHTML = '';
            const available = ALL_CARD_ATTRIBUTES.filter(x => !this.selected.includes(x));
            if (available.length === 0) {
                const hint = document.createElement('span');
                hint.style.cssText = 'color: #94a3b8; font-size: 12px; font-style: italic; user-select: none;';
                hint.textContent = 'All 4 attributes have been moved to Box 1 above.';
                this.availableBox.appendChild(hint);
            } else {
                available.forEach(attr => {
                    const el = this.createAvailableBadgeEl(attr);
                    this.availableBox.appendChild(el);
                });
            }
        }

        createSelectedBadgeEl(attr, idx) {
            const styleConf = ATTR_STYLES[attr] || { activeBg: '#1a4731' };
            const el = document.createElement('div');
            el.className = 'draggable-badge is-selected';
            el.draggable = true;
            el.setAttribute('data-attr', attr);
            el.setAttribute('data-index', idx);
            el.style.cssText = `background: ${styleConf.activeBg}; color: #ffffff; padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 8px; cursor: grab; user-select: none; box-shadow: 0 2px 6px rgba(0,0,0,0.25); transition: transform 0.15s, opacity 0.15s;`;
            
            el.innerHTML = `
                <span style="opacity: 0.7; font-size: 11px; cursor: grab;" title="Drag with mouse">⠿</span>
                <span>${attr}</span>
                <span class="badge-remove-btn" title="Remove (move back to Box 2)" style="cursor: pointer; background: rgba(255,255,255,0.22); width: 17px; height: 17px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; font-size: 13px; line-height: 1; margin-left: 2px;">&times;</span>
            `;

            el.querySelector('.badge-remove-btn').addEventListener('click', (e) => {
                e.stopPropagation();
                this.remove(attr);
            });

            el.addEventListener('dragstart', (e) => {
                e.dataTransfer.setData('text/plain', JSON.stringify({ attr, source: 'selected', prefix: this.prefix, index: idx }));
                el.style.opacity = '0.4';
                el.style.cursor = 'grabbing';
            });

            el.addEventListener('dragend', () => {
                el.style.opacity = '1';
                el.style.cursor = 'grab';
            });

            return el;
        }

        createAvailableBadgeEl(attr) {
            const styleConf = ATTR_STYLES[attr] || { bg: '#f8fafc', border: '#cbd5e1', text: '#1e293b' };
            const el = document.createElement('div');
            el.className = 'draggable-badge is-available';
            el.draggable = true;
            el.setAttribute('data-attr', attr);
            el.style.cssText = `background: ${styleConf.bg}; color: ${styleConf.text}; border: 1.5px solid ${styleConf.border}; padding: 6px 14px; border-radius: 999px; font-size: 12px; font-weight: 700; display: inline-flex; align-items: center; gap: 7px; cursor: grab; user-select: none; transition: all 0.15s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05);`;
            
            el.innerHTML = `
                <span style="opacity: 0.5; font-size: 11px;" title="Drag with mouse">⠿</span>
                <span>${attr}</span>
                <span style="font-size: 13px; font-weight: bold; margin-left: 2px; opacity: 0.8;" title="Click to move to Box 1">+</span>
            `;

            el.addEventListener('mouseenter', () => {
                el.style.transform = 'translateY(-2px)';
                el.style.boxShadow = '0 4px 10px rgba(0,0,0,0.1)';
            });

            el.addEventListener('mouseleave', () => {
                el.style.transform = 'translateY(0)';
                el.style.boxShadow = '0 1px 2px rgba(0,0,0,0.05)';
            });

            el.addEventListener('click', () => {
                this.add(attr);
            });

            el.addEventListener('dragstart', (e) => {
                e.dataTransfer.setData('text/plain', JSON.stringify({ attr, source: 'available', prefix: this.prefix }));
                el.style.opacity = '0.4';
                el.style.cursor = 'grabbing';
            });

            el.addEventListener('dragend', () => {
                el.style.opacity = '1';
                el.style.cursor = 'grab';
            });

            return el;
        }
    }

    function handleBadgeDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        e.currentTarget.style.borderColor = '#1a4731';
        e.currentTarget.style.background = '#f0fdf4';
    }

    function handleBadgeDragLeave(e) {
        const isSelected = e.currentTarget.classList.contains('badge-selected-box');
        e.currentTarget.style.borderColor = isSelected ? '#94a3b8' : '#cbd5e1';
        e.currentTarget.style.background = isSelected ? '#f8fafc' : '#ffffff';
    }

    function handleBadgeDrop(e, prefix, targetBox) {
        e.preventDefault();
        const isSelected = targetBox === 'selected';
        e.currentTarget.style.borderColor = isSelected ? '#94a3b8' : '#cbd5e1';
        e.currentTarget.style.background = isSelected ? '#f8fafc' : '#ffffff';

        const raw = e.dataTransfer.getData('text/plain');
        if (!raw) return;

        try {
            const data = JSON.parse(raw);
            if (data.prefix !== prefix) return;

            const manager = prefix === 'add' ? window.addBadgeManager : window.editBadgeManager;
            if (!manager) return;

            if (targetBox === 'selected') {
                if (data.source === 'available') {
                    manager.add(data.attr);
                }
            } else if (targetBox === 'available') {
                if (data.source === 'selected') {
                    manager.remove(data.attr);
                }
            }
        } catch (err) {
            console.error(err);
        }
    }

    // Initialize Badge Managers when DOM is loaded
    document.addEventListener('DOMContentLoaded', function() {
        window.addBadgeManager = new BadgeManager('add', ['Off plan']);
        window.editBadgeManager = new BadgeManager('edit', []);
    });

    // Also initialize immediately if DOM already loaded
    if (document.readyState === 'complete' || document.readyState === 'interactive') {
        window.addBadgeManager = new BadgeManager('add', ['Off plan']);
        window.editBadgeManager = new BadgeManager('edit', []);
    }
</script>
@endsection
