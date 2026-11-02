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

    /* Full-width sticky save bar at bottom */
    .adm-add-save-bar {
        position: sticky;
        bottom: 0;
        z-index: 9999;
        background: #ffffff;
        border: 1.5px solid #d4c7b5;
        border-radius: 12px;
        box-shadow: 0 6px 24px rgba(0, 0, 0, 0.14), 0 2px 6px rgba(0, 0, 0, 0.05);
        padding: 14px 22px;
        margin-top: 20px;
        margin-bottom: 8px;
        display: flex;
        justify-content: space-between;
        align-items: center;
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

                        <!-- Navbar Dropdown Options -->
                        <div class="adm-field" style="margin-bottom: 20px; padding: 14px 18px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;">
                            <div style="font-weight: 700; color: #1e293b; font-size: 13.5px; margin-bottom: 8px; display: flex; align-items: center; gap: 8px;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1a4731" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                                Navbar Dropdown Placement
                            </div>
                            <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                                <label class="adm-check" style="cursor: pointer; display: flex; align-items: center; gap: 8px; margin: 0; user-select: none;">
                                    <input type="checkbox" name="show_in_projects" value="1" id="add_prop_show_in_projects" checked style="width: 17px; height: 17px; accent-color: #1a4731; cursor: pointer;">
                                    <span style="font-weight: 600; color: #334155; font-size: 13px;">Show in Projects Dropdown</span>
                                </label>
                                <label class="adm-check" style="cursor: pointer; display: flex; align-items: center; gap: 8px; margin: 0; user-select: none;">
                                    <input type="checkbox" name="show_in_commercial" value="1" id="add_prop_show_in_commercial" style="width: 17px; height: 17px; accent-color: #1a4731; cursor: pointer;">
                                    <span style="font-weight: 600; color: #334155; font-size: 13px;">Show in Commercial Dropdown</span>
                                </label>
                            </div>
                            <div class="adm-help" style="margin-top: 6px; font-size: 12px; color: #64748b;">
                                Select which navbar dropdown this property will appear under (Projects and/or Commercial). If the user visits this property's page, it will automatically hide from that dropdown.
                            </div>
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
                                <img id="preview_add_hero_img" src="/images/placeholder.svg" class="adm-img-thumb-lg" alt="Hero Preview" style="object-fit: contain; background: #f8fafc;">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <input type="file" name="section_files[hero][bg_image]" accept="image/*" class="adm-input" onchange="previewAddImage(this, 'preview_add_hero_img', 'input_add_hero_img')">
                                    </div>
                                    <input type="text" name="sections[hero][bg_image]" id="input_add_hero_img" value="" class="adm-input" placeholder="Or enter image path / URL (e.g. /images/hero/slide-1.jpg)" oninput="document.getElementById('preview_add_hero_img').src = this.value || '/images/placeholder.svg'">
                                    <div class="adm-help" style="color: #1a4731; font-weight: 600;">✓ Jo image yahan Hero Banner pr upload/set hogi, wahi image Property Card pr bhi automatically lag jayegi.</div>
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
                            <input type="text" name="sections[hero][badge]" value="" class="adm-input" placeholder="e.g. Freehold for All Nationalities">
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                            <div class="adm-field">
                                <label class="adm-label">Main Heading (H1)</label>
                                <textarea name="sections[hero][title]" id="add_hero_title" class="adm-textarea" rows="2" placeholder="e.g. Wadeem Gardens&#10;at Hudayriyat Island"></textarea>
                                <div class="adm-help">Line breaks render as visual breaks on the frontend.</div>
                            </div>

                            <div class="adm-field">
                                <label class="adm-label">Subtitle / Tagline</label>
                                <textarea name="sections[hero][subtitle]" id="add_hero_subtitle" class="adm-textarea" rows="2" placeholder="e.g. Abu Dhabi’s Most Exclusive Coastal Lifestyle Destination on Hudayriyat Island"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- 3. PROJECT HIGHLIGHTS TAB -->
                    <div id="add_tab_highlights" class="tab-pane">
                        <input type="hidden" name="sections[highlights][_has_items]" value="1">
                        <div class="adm-card-head">
                            <div>
                                <h2>Project Highlights</h2>
                                <p>Configure key highlight metrics (Developer, Price, Handover Date, Property Type, Ownership, Bedrooms).</p>
                            </div>
                            <span class="adm-chip">highlights</span>
                        </div>

                        <div id="add_highlights_list" style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                            <div class="adm-highlight-card" style="display: flex; gap: 10px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; flex-wrap: wrap;">
                                <div style="display: flex; gap: 8px; align-items: center; width: 100%; max-width: 250px;">
                                    <span class="adm-hl-icon-preview" style="width: 32px; height: 32px; border-radius: 6px; background: #fff; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <img src="/images/placeholder.svg" style="width: 20px; height: 20px; object-fit: contain;">
                                    </span>
                                    <select class="adm-select add-hl-select" name="sections[highlights][items][0][label]" onchange="applyAddHighlightChoice(this)" style="font-size: 11.5px; padding: 5px 8px; border-radius: 6px; background: #f0f9ff; border-color: #bae6fd; width: 100%;">
                                        <option value="">-- Choose Amenity --</option>
                                        @if(isset($allAmenities) && $allAmenities->isNotEmpty())
                                            @foreach($allAmenities as $am)
                                                <option value="{{ $am->name }}" data-icon="{{ $am->icon }}">{{ $am->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <input type="hidden" name="sections[highlights][items][0][icon]" value="">
                                <input type="text" name="sections[highlights][items][0][value]" value="" class="adm-input" style="flex: 1; min-width: 160px;" placeholder="Value (e.g. Included / 500 sqm / Modon Properties)">
                                <button type="button" onclick="this.closest('.adm-highlight-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer; padding: 4px;" title="Remove Item">✕</button>
                            </div>
                            <div class="adm-highlight-card" style="display: flex; gap: 10px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; flex-wrap: wrap;">
                                <div style="display: flex; gap: 8px; align-items: center; width: 100%; max-width: 250px;">
                                    <span class="adm-hl-icon-preview" style="width: 32px; height: 32px; border-radius: 6px; background: #fff; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <img src="/images/placeholder.svg" style="width: 20px; height: 20px; object-fit: contain;">
                                    </span>
                                    <select class="adm-select add-hl-select" name="sections[highlights][items][1][label]" onchange="applyAddHighlightChoice(this)" style="font-size: 11.5px; padding: 5px 8px; border-radius: 6px; background: #f0f9ff; border-color: #bae6fd; width: 100%;">
                                        <option value="">-- Choose Amenity --</option>
                                        @if(isset($allAmenities) && $allAmenities->isNotEmpty())
                                            @foreach($allAmenities as $am)
                                                <option value="{{ $am->name }}" data-icon="{{ $am->icon }}">{{ $am->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <input type="hidden" name="sections[highlights][items][1][icon]" value="">
                                <input type="text" name="sections[highlights][items][1][value]" value="" class="adm-input" style="flex: 1; min-width: 160px;" placeholder="Value (e.g. AED 2,500,000 / Included)">
                                <button type="button" onclick="this.closest('.adm-highlight-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer; padding: 4px;" title="Remove Item">✕</button>
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
                            <input type="text" name="sections[about][title]" id="add_about_title" value="" class="adm-input" placeholder="e.g. Wadeem Gardens by Modon">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Community Overview &amp; Narrative</label>
                            <textarea name="sections[about][description]" id="add_about_desc" class="adm-textarea" rows="6" placeholder="Detailed story, architectural styling, villa sizes, and lifestyle details..."></textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Video Poster / Cover Image</label>
                            <div class="adm-img-box">
                                <img id="preview_add_about_poster" src="/images/placeholder.svg" class="adm-img-thumb-lg" alt="Poster" style="object-fit: contain; background: #f8fafc;">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <input type="file" name="section_files[about][video_poster]" class="adm-input" accept="image/*" onchange="previewAddImage(this, 'preview_add_about_poster', 'input_add_about_poster')">
                                    </div>
                                    <input type="text" name="sections[about][video_poster]" id="input_add_about_poster" value="" class="adm-input" placeholder="Or enter image URL path" oninput="document.getElementById('preview_add_about_poster').src = this.value || '/images/placeholder.svg'">
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
                        <input type="hidden" name="sections[amenities][_has_items]" value="1">

                        <div class="adm-field">
                            <label class="adm-label">Section Title</label>
                            <input type="text" name="sections[amenities][title]" id="add_amenities_title" value="" placeholder="e.g. Community Amenities" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Subtitle / Lifestyle Description</label>
                            <textarea name="sections[amenities][subtitle]" class="adm-textarea" rows="2" placeholder="e.g. Offers a complete coastal lifestyle with luxury amenities for wellness, recreation, and community living."></textarea>
                        </div>

                        <div id="add_amenities_container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; margin-top: 14px;">
                            <div class="adm-card" style="border: 1px solid #e2e8f0; background: #fff; padding: 10px 12px; border-radius: 8px;">
                                <div style="display: flex; gap: 10px; align-items: center;">
                                    <div style="width: 36px; height: 36px; border-radius: 6px; background: #faf8f5; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                        <img src="/images/placeholder.svg" style="width: 22px; height: 22px; object-fit: contain;">
                                    </div>
                                    <select class="adm-select add-amenity-select" name="sections[amenities][items][0][name]" onchange="applyProjectAmenity(this)" style="flex: 1; min-width: 120px; font-size: 12px; font-weight: 600; padding: 6px 10px; border-radius: 6px; background: #f0f9ff; border-color: #bae6fd;">
                                        <option value="">-- Choose Amenity --</option>
                                        @if(isset($allAmenities))
                                            @foreach($allAmenities as $am)
                                                <option value="{{ $am->name }}" data-icon="{{ $am->icon }}">{{ $am->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <input type="hidden" name="sections[amenities][items][0][icon]" value="">
                                    <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 13px; cursor: pointer; padding: 4px; flex-shrink: 0;" title="Delete">✕</button>
                                </div>
                            </div>
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
                            <input type="text" name="sections[gallery][title]" value="" placeholder="e.g. Project Gallery" class="adm-input">
                        </div>

                        <div id="add_gallery_container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 14px;">
                            <div class="adm-gal-box" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; position: relative;">
                                <button type="button" onclick="this.closest('.adm-gal-box').remove()" style="position: absolute; right: 8px; top: 8px; background: #fff; border: 1px solid #fecaca; color: #ef4444; border-radius: 4px; padding: 2px 6px; font-size: 11px; cursor: pointer;">✕</button>
                                <img id="preview_add_gal_0" src="/images/placeholder.svg" style="width: 100%; height: 95px; object-fit: contain; border-radius: 6px; margin-bottom: 8px; background: #f1f5f9;">
                                <input type="text" name="sections[gallery][images][0][src]" value="" class="adm-input" placeholder="Image URL / path (e.g. /images/hero/photo.jpg)" style="font-size: 11px;" oninput="document.getElementById('preview_add_gal_0').src = this.value || '/images/placeholder.svg'">
                                <input type="hidden" name="sections[gallery][images][0][alt]" value="Project Photo">
                            </div>
                        </div>

                        <button type="button" class="adm-btn adm-btn-secondary" onclick="addAddGalleryItem()" style="margin-top: 14px; display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
                            + Add Gallery Photo
                        </button>
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
                            <textarea name="sections[content][html]" id="add_content_wysiwyg" class="adm-textarea adm-summernote" data-height="500" rows="22" placeholder="Write or paste your custom article content, headings, and images here..."></textarea>
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
                            <input type="text" name="sections[payment_plan][title]" value="" placeholder="e.g. Payment Plan" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[payment_plan][description]" class="adm-textarea" rows="2" placeholder="e.g. A flexible, milestone-linked payment structure making ownership effortless and transparent..."></textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; margin-bottom: 16px;">
                            <div>
                                <label class="adm-label">Down Payment</label>
                                <input type="text" name="sections[payment_plan][down_payment]" value="" placeholder="e.g. 10%" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">During Construction</label>
                                <input type="text" name="sections[payment_plan][during_construction]" value="" placeholder="e.g. 40%" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">On Handover</label>
                                <input type="text" name="sections[payment_plan][on_handover]" value="" placeholder="e.g. 50%" class="adm-input">
                            </div>
                        </div>

                        <!-- Milestone Breakdown Rows -->
                        <div id="add_milestones_container" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 14px;">
                            <div class="adm-milestone-row" style="display: grid; grid-template-columns: 2fr 1fr 2fr auto; gap: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px; align-items: center;">
                                <input type="text" name="sections[payment_plan][items][0][milestone]" value="" placeholder="Milestone (e.g. Down Payment)" class="adm-input" style="font-size: 12px; font-weight: 600;">
                                <input type="text" name="sections[payment_plan][items][0][percentage]" value="" placeholder="e.g. 10%" class="adm-input" style="font-size: 12px; text-align: center;">
                                <input type="text" name="sections[payment_plan][items][0][due]" value="" placeholder="Due Date (e.g. On Booking Date)" class="adm-input" style="font-size: 12px;">
                                <button type="button" onclick="this.closest('.adm-milestone-row').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer;">✕</button>
                            </div>
                        </div>

                        <button type="button" class="adm-btn adm-btn-secondary" onclick="addAddMilestoneItem()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
                            + Add Milestone Row
                        </button>
                    </div>

                    <!-- 9. MASTER PLAN TAB -->
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
                            <input type="text" name="sections[master_plan][title]" value="" placeholder="e.g. Master Plan" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[master_plan][description]" class="adm-textarea" rows="3" placeholder="e.g. The master plan creates a harmonious, walkable enclave where residential clusters are woven naturally..."></textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Master Plan Image</label>
                            <div class="adm-img-box">
                                <img id="preview_add_master_img" src="/images/placeholder.svg" class="adm-img-thumb-lg" alt="Master Plan" style="object-fit: contain; background: #f8fafc;">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <input type="file" name="section_files[master_plan][image]" class="adm-input" accept="image/*" onchange="previewAddImage(this, 'preview_add_master_img', 'input_add_master_img')">
                                    </div>
                                    <input type="text" name="sections[master_plan][image]" id="input_add_master_img" value="" class="adm-input" placeholder="Or enter image URL path (e.g. /images/projects/master-plan.jpg)" oninput="document.getElementById('preview_add_master_img').src = this.value || '/images/placeholder.svg'">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 10. LOCATION & CONNECTIVITY TAB -->
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
                            <input type="text" name="sections[location][title]" value="" placeholder="e.g. Seamless Access, Prime Location" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[location][description]" class="adm-textarea" rows="2" placeholder="e.g. Conveniently located on Hudayriyat Island with direct access via modern bridges..."></textarea>
                        </div>

                        <div id="add_locations_container" style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 14px;">
                            <div class="adm-loc-row" style="display: flex; gap: 8px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px; align-items: center;">
                                <input type="text" name="sections[location][items][0][place]" value="" placeholder="Destination (e.g. Downtown)" class="adm-input" style="flex: 2; font-size: 12px; font-weight: 600;">
                                <input type="text" name="sections[location][items][0][time]" value="" placeholder="Time (e.g. 20 mins)" class="adm-input" style="flex: 1; font-size: 12px; text-align: center;">
                                <button type="button" onclick="this.closest('.adm-loc-row').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer;">✕</button>
                            </div>
                        </div>

                        <button type="button" class="adm-btn adm-btn-secondary" onclick="addAddLocationItem()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
                            + Add Destination
                        </button>
                    </div>

                    <!-- 11. FREQUENTLY ASKED QUESTIONS TAB -->
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
                            <input type="text" name="sections[faq][title]" value="" placeholder="e.g. Frequently Asked Questions" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Description</label>
                            <textarea name="sections[faq][description]" class="adm-textarea" rows="2" placeholder="e.g. Key information and helpful answers regarding property purchases..."></textarea>
                        </div>

                        <div id="add_faq_container" style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 14px;">
                            <div class="adm-card" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px 16px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                    <strong style="font-size: 12px; color: #475569;">Question #1</strong>
                                    <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 11px; cursor: pointer;">✕ Delete</button>
                                </div>
                                <input type="text" name="sections[faq][items][0][question]" value="" class="adm-input" placeholder="Question (e.g. Is this a freehold development?)" style="margin-bottom: 6px; font-weight: 600; font-size: 12.5px;">
                                <textarea name="sections[faq][items][0][answer]" class="adm-textarea" rows="2" placeholder="Answer..." style="font-size: 12px;"></textarea>
                            </div>
                        </div>

                        <button type="button" class="adm-btn adm-btn-secondary" onclick="addAddFaqItem()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px;">
                            + Add Question
                        </button>
                    </div>

                    <!-- 12. CONTACT & BOOKING CTA TAB -->
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
                            <input type="text" name="sections[contact][title]" value="" placeholder="e.g. Register Your Interest" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Subtitle / Narrative</label>
                            <textarea name="sections[contact][subtitle]" class="adm-textarea" rows="2" placeholder="e.g. Our property specialists will contact you with VIP floor plans, pricing sheets, and private site visit bookings."></textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px;">
                            <div>
                                <label class="adm-label">Button Text</label>
                                <input type="text" name="sections[contact][button_text]" value="" placeholder="e.g. REGISTER INTEREST" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">Phone</label>
                                <input type="text" name="sections[contact][phone]" value="" placeholder="e.g. +971 2 000 0000" class="adm-input">
                            </div>
                            <div>
                                <label class="adm-label">Email</label>
                                <input type="text" name="sections[contact][email]" value="" placeholder="e.g. info@hudayriyat-island.com" class="adm-input">
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


                </div>
            </div>

            <!-- Sticky Bottom Action Bar (full width, below layout) -->
            <div class="adm-add-save-bar">
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
                                    /project/{{ ltrim(preg_replace('#^project/#', '', ltrim($project->page->slug ?? $project->slug ?? '', '/')), '/') }}
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
                                    <a href="{{ route('admin.projects.edit', $project) }}" class="cms-action-btn" title="Edit Detail Page (Hero, Highlights, FAQ...)">
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

                <!-- Navbar Dropdown Options -->
                <div style="grid-column: span 2; padding: 12px 16px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <div style="font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">
                        Navbar Dropdown Placement
                    </div>
                    <div style="display: flex; gap: 24px; flex-wrap: wrap;">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; font-weight: 600; color: #334155;">
                            <input type="checkbox" name="show_in_projects" id="edit_show_in_projects" value="1" style="width: 16px; height: 16px; accent-color: #1a4731; cursor: pointer;">
                            Show in Projects Dropdown
                        </label>
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13px; font-weight: 600; color: #334155;">
                            <input type="checkbox" name="show_in_commercial" id="edit_show_in_commercial" value="1" style="width: 16px; height: 16px; accent-color: #1a4731; cursor: pointer;">
                            Show in Commercial Dropdown
                        </label>
                    </div>
                    <input type="hidden" name="from_project_modal" value="1">
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

    window.ALL_AMENITIES = @json($allAmenities ?? []);

    function escapeHtml(str) {
        if (!str) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function syncAmenitiesFromApi() {
        fetch('/admin/api/amenities')
            .then(res => res.json())
            .then(data => {
                if (Array.isArray(data) && data.length) {
                    window.ALL_AMENITIES = data;
                }
            })
            .catch(() => {});
    }
    syncAmenitiesFromApi();

    function applyAddHighlightChoice(selectEl) {
        const card = selectEl.closest('.adm-highlight-card');
        if (!card) return;
        const opt = selectEl.options[selectEl.selectedIndex];
        if (!opt || !opt.value) return;

        const labelInput = card.querySelector('.add-hl-label') || card.querySelector('input[name*="[label]"]');
        if (labelInput) labelInput.value = opt.value;

        const iconInput = card.querySelector('input[name*="[icon]"]');
        const iconVal = opt.getAttribute('data-icon') || '';
        if (iconInput) iconInput.value = iconVal;

        const img = card.querySelector('.adm-hl-icon-preview img');
        if (img) {
            if (iconVal && (iconVal.startsWith('/') || iconVal.startsWith('http'))) {
                img.src = iconVal;
            } else {
                img.src = '/images/placeholder.svg';
            }
        }
    }

    function addAddHighlightItem() {
        const list = document.getElementById('add_highlights_list');
        if (!list) return;
        const newId = Date.now();
        let amenitiesOptHtml = '';
        if (window.ALL_AMENITIES && window.ALL_AMENITIES.length) {
            amenitiesOptHtml = window.ALL_AMENITIES.map(am => `<option value="${escapeHtml(am.name)}" data-icon="${am.icon || ''}">${escapeHtml(am.name)}</option>`).join('');
        } else {
            @if(isset($allAmenities))
                @foreach($allAmenities as $am)
                    amenitiesOptHtml += `<option value="{{ addslashes($am->name) }}" data-icon="{{ $am->icon }}">{{ $am->name }}</option>`;
                @endforeach
            @endif
        }

        const card = document.createElement('div');
        card.className = 'adm-highlight-card';
        card.style.cssText = 'display: flex; gap: 10px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; flex-wrap: wrap;';
        card.innerHTML = `
            <div style="display: flex; gap: 8px; align-items: center; width: 100%; max-width: 250px;">
                <span class="adm-hl-icon-preview" style="width: 32px; height: 32px; border-radius: 6px; background: #fff; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <img src="/images/placeholder.svg" style="width: 20px; height: 20px; object-fit: contain;">
                </span>
                <select class="adm-select add-hl-select" name="sections[highlights][items][${newId}][label]" onchange="applyAddHighlightChoice(this)" style="font-size: 11.5px; padding: 5px 8px; border-radius: 6px; background: #f0f9ff; border-color: #bae6fd; width: 100%;">
                    <option value="">-- Choose Amenity --</option>
                    ${amenitiesOptHtml}
                </select>
            </div>
            <input type="hidden" name="sections[highlights][items][${newId}][icon]" value="">
            <input type="text" name="sections[highlights][items][${newId}][value]" value="" class="adm-input" style="flex: 1; min-width: 160px;" placeholder="Value (e.g. Included / 500 sqm / Modon Properties)">
            <button type="button" onclick="this.closest('.adm-highlight-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer; padding: 4px;" title="Remove Item">✕</button>
        `;
        list.appendChild(card);
    }

    function applyProjectAmenity(selectEl) {
        const card = selectEl.closest('.adm-card');
        if (!card) return;
        const opt = selectEl.options[selectEl.selectedIndex];
        if (!opt || !opt.value) return;

        const nameInput = card.querySelector('input[name*="[name]"]');
        if (nameInput) nameInput.value = opt.value;

        const iconInput = card.querySelector('input[name*="[icon]"]');
        const iconUrl = opt.getAttribute('data-icon') || '';
        if (iconInput) iconInput.value = iconUrl;

        const img = card.querySelector('img');
        if (img && iconUrl) img.src = iconUrl;
    }

    function addAddAmenityCard() {
        const container = document.getElementById('add_amenities_container');
        if (!container) return;
        const idx = Date.now();
        const card = document.createElement('div');
        card.className = 'adm-card';
        card.style.cssText = 'border: 1px solid #e2e8f0; background: #fff; padding: 10px 12px; border-radius: 8px;';

        let amenitiesOptions = '<option value="">-- Choose Amenity --</option>';
        if (window.ALL_AMENITIES && window.ALL_AMENITIES.length) {
            amenitiesOptions += window.ALL_AMENITIES.map(am => `<option value="${escapeHtml(am.name)}" data-icon="${am.icon || ''}">${escapeHtml(am.name)}</option>`).join('');
        } else {
            @if(isset($allAmenities))
                @foreach($allAmenities as $am)
                    amenitiesOptions += `<option value="{{ addslashes($am->name) }}" data-icon="{{ $am->icon }}">{{ $am->name }}</option>`;
                @endforeach
            @endif
        }

        card.innerHTML = `
            <div style="display: flex; gap: 10px; align-items: center;">
                <div style="width: 36px; height: 36px; border-radius: 6px; background: #faf8f5; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <img src="/images/placeholder.svg" style="width: 22px; height: 22px; object-fit: contain;">
                </div>
                <select class="adm-select add-amenity-select" name="sections[amenities][items][${idx}][name]" onchange="applyProjectAmenity(this)" style="flex: 1; min-width: 120px; font-size: 12px; font-weight: 600; padding: 6px 10px; border-radius: 6px; background: #f0f9ff; border-color: #bae6fd;">
                    ${amenitiesOptions}
                </select>
                <input type="hidden" name="sections[amenities][items][${idx}][icon]" value="">
                <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 13px; cursor: pointer; padding: 4px; flex-shrink: 0;" title="Delete">✕</button>
            </div>
        `;
        container.appendChild(card);
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
    }

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

    let addHighlightIdx = 10;
    function addAddHighlightItem() {
        const container = document.getElementById('add_highlights_list');
        if (!container) return;
        const idx = addHighlightIdx++;

        let amenitiesOptions = '';
        if (window.ALL_AMENITIES && window.ALL_AMENITIES.length) {
            amenitiesOptions = window.ALL_AMENITIES.map(am => `<option value="${escapeHtml(am.name)}" data-icon="${am.icon || ''}">${escapeHtml(am.name)}</option>`).join('');
        } else {
            @if(isset($allAmenities))
                @foreach($allAmenities as $am)
                    amenitiesOptions += `<option value="{{ addslashes($am->name) }}" data-icon="{{ $am->icon }}">{{ $am->name }}</option>`;
                @endforeach
            @endif
        }

        const row = document.createElement('div');
        row.className = 'adm-highlight-card';
        row.style.cssText = 'display: flex; gap: 10px; align-items: center; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px 14px; flex-wrap: wrap;';
        row.innerHTML = `
            <div style="display: flex; gap: 8px; align-items: center; width: 100%; max-width: 250px;">
                <span class="adm-hl-icon-preview" style="width: 32px; height: 32px; border-radius: 6px; background: #fff; border: 1px solid #cbd5e1; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <img src="/images/placeholder.svg" style="width: 20px; height: 20px; object-fit: contain;">
                </span>
                <select class="adm-select add-hl-select" onchange="applyAddHighlightChoice(this)" style="font-size: 11.5px; padding: 5px 8px; border-radius: 6px; background: #f0f9ff; border-color: #bae6fd; width: 100%;">
                    <option value="">-- Choose Amenity --</option>
                    ${amenitiesOptions}
                </select>
            </div>
            <input type="hidden" name="sections[highlights][items][${idx}][icon]" value="">
            <input type="hidden" name="sections[highlights][items][${idx}][label]" value="" class="add-hl-label">
            <input type="text" name="sections[highlights][items][${idx}][value]" value="" class="adm-input" style="flex: 1; min-width: 160px;" placeholder="Value (e.g. AED 2,500,000 / Included)">
            <button type="button" onclick="this.closest('.adm-highlight-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer; padding: 4px;" title="Remove Item">✕</button>
        `;
        container.appendChild(row);
    }

    function addAddGalleryItem() {
        const container = document.getElementById('add_gallery_container');
        if (!container) return;
        const idx = Date.now();
        const box = document.createElement('div');
        box.className = 'adm-gal-box';
        box.style.cssText = 'background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px; position: relative;';
        box.innerHTML = `
            <button type="button" onclick="this.closest('.adm-gal-box').remove()" style="position: absolute; right: 8px; top: 8px; background: #fff; border: 1px solid #fecaca; color: #ef4444; border-radius: 4px; padding: 2px 6px; font-size: 11px; cursor: pointer;">✕</button>
            <img id="preview_add_gal_${idx}" src="/images/placeholder.svg" style="width: 100%; height: 95px; object-fit: contain; border-radius: 6px; margin-bottom: 8px; background: #f1f5f9;">
            <input type="text" name="sections[gallery][images][${idx}][src]" value="" class="adm-input" placeholder="Image URL / path (e.g. /images/hero/photo.jpg)" style="font-size: 11px;" oninput="document.getElementById('preview_add_gal_${idx}').src = this.value || '/images/placeholder.svg'">
            <input type="hidden" name="sections[gallery][images][${idx}][alt]" value="Project Photo">
        `;
        container.appendChild(box);
    }

    function addAddMilestoneItem() {
        const container = document.getElementById('add_milestones_container');
        if (!container) return;
        const idx = Date.now();
        const row = document.createElement('div');
        row.className = 'adm-milestone-row';
        row.style.cssText = 'display: grid; grid-template-columns: 2fr 1fr 2fr auto; gap: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px; align-items: center;';
        row.innerHTML = `
            <input type="text" name="sections[payment_plan][items][${idx}][milestone]" value="" placeholder="Milestone (e.g. Construction Milestone)" class="adm-input" style="font-size: 12px; font-weight: 600;">
            <input type="text" name="sections[payment_plan][items][${idx}][percentage]" value="" placeholder="e.g. 10%" class="adm-input" style="font-size: 12px; text-align: center;">
            <input type="text" name="sections[payment_plan][items][${idx}][due]" value="" placeholder="Due Date (e.g. 12 Months after Booking)" class="adm-input" style="font-size: 12px;">
            <button type="button" onclick="this.closest('.adm-milestone-row').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer;">✕</button>
        `;
        container.appendChild(row);
    }

    function addAddLocationItem() {
        const container = document.getElementById('add_locations_container');
        if (!container) return;
        const idx = Date.now();
        const row = document.createElement('div');
        row.className = 'adm-loc-row';
        row.style.cssText = 'display: flex; gap: 8px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 8px 12px; align-items: center;';
        row.innerHTML = `
            <input type="text" name="sections[location][items][${idx}][place]" value="" placeholder="Destination (e.g. Downtown)" class="adm-input" style="flex: 2; font-size: 12px; font-weight: 600;">
            <input type="text" name="sections[location][items][${idx}][time]" value="" placeholder="Time (e.g. 20 mins)" class="adm-input" style="flex: 1; font-size: 12px; text-align: center;">
            <button type="button" onclick="this.closest('.adm-loc-row').remove()" style="background: none; border: none; color: #ef4444; font-size: 14px; cursor: pointer;">✕</button>
        `;
        container.appendChild(row);
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
                <strong style="font-size: 12px; color: #475569;">Question</strong>
                <button type="button" onclick="this.closest('.adm-card').remove()" style="background: none; border: none; color: #ef4444; font-size: 11px; cursor: pointer;">✕ Delete</button>
            </div>
            <input type="text" name="sections[faq][items][${addFaqIdx}][question]" value="" placeholder="Question..." class="adm-input" style="margin-bottom: 6px; font-weight: 600; font-size: 12.5px;">
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

        const showInProjEl = document.getElementById('edit_show_in_projects');
        if (showInProjEl) {
            showInProjEl.checked = (project.show_in_projects !== false && project.show_in_projects !== 0 && project.show_in_projects !== '0');
        }
        const showInCommEl = document.getElementById('edit_show_in_commercial');
        if (showInCommEl) {
            showInCommEl.checked = Boolean(project.show_in_commercial && project.show_in_commercial !== '0');
        }
        
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
