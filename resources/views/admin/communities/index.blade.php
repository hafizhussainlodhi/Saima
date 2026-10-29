@extends('admin.layouts.app')

@section('title', 'Manage > Cities (City Pages)')

@push('styles')
<style>
    .adm-topbar { display: none !important; }
    .city-row:hover { background-color: #fafbfd !important; }
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

    /* Tabbed Layout Container matching Add Property */
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

    /* Left Sidebar Tabs */
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
        padding-bottom: 20px;
        margin-bottom: 24px;
        border-bottom: 1px solid #f1f5f9;
    }

    .adm-edit-layout .adm-card-head h2 {
        font-size: 18px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin: 0 0 4px 0 !important;
    }

    .adm-edit-layout .adm-card-head p {
        font-size: 13.5px !important;
        color: #64748b !important;
        margin: 0 !important;
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

    .project-card-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 6px 12px;
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        cursor: pointer;
        transition: all 0.15s ease;
        user-select: none;
    }
    .project-card-chip:hover {
        border-color: #0284c7;
        background: #f0f9ff;
    }
    .project-card-chip.selected {
        background: #0284c7;
        color: #ffffff;
        border-color: #0284c7;
    }
    /* FAQ Drag & Drop Styles */
    .faq-repeater-row {
        transition: background 0.15s ease, border-color 0.15s ease;
    }
    .faq-repeater-row.is-dragging {
        opacity: 0.45 !important;
        background: #f0fdf4 !important;
        border: 1.5px dashed #1a4731 !important;
    }
    .faq-repeater-row.drag-over-top {
        border-top: 3px solid #1a4731 !important;
    }
    .faq-repeater-row.drag-over-bottom {
        border-bottom: 3px solid #1a4731 !important;
    }
    .faq-drag-handle:hover {
        background: #f0fdf4 !important;
        border-color: #1a4731 !important;
    }
    .faq-drag-handle:active {
        cursor: grabbing !important;
    }
</style>
@endpush

@section('content')
<div id="citiesManagerView">
    <!-- Breadcrumbs & Heading -->
    <div class="cms-page-header" style="margin-bottom: 22px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 14px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; font-family: var(--font-display, 'Outfit', sans-serif); letter-spacing: -0.01em;">Manage &gt; Neighbourhood / Community</h1>
            <div style="font-size: 13px; color: #8c9ba5; font-weight: 400;">Home &ndash; Manage &ndash; Neighbourhoods &amp; Communities</div>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <div style="display: flex; background: #f8fafc; padding: 3px; border-radius: 8px; border: 1px solid #f1f5f9; gap: 2px;">
                <a href="{{ route('admin.pages.index') }}" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; text-decoration: none; color: #64748b;">Pages</a>
                <a href="{{ route('admin.projects.index') }}" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; text-decoration: none; color: #64748b;">Projects</a>
                <a href="{{ route('admin.cities.index') }}" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; text-decoration: none; color: #64748b;">Cities</a>
                <a href="{{ route('admin.communities.index') }}" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; border-radius: 6px; text-decoration: none; background: #ffffff; color: #1e293b; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">Neighbourhood / Community ({{ $totalCommunities }})</a>
            </div>
            <button type="button" class="adm-btn adm-btn-primary" onclick="toggleAddCommForm()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; padding: 8px 16px; border-radius: 8px;">
                @include('admin.partials.icon', ['name' => 'plus']) Add Neighbourhood/Community
            </button>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 10px;">
            @include('admin.partials.icon', ['name' => 'check'])
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if($errors->any())
        <div style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- ========================================================================= -->
    <!-- ADD CITY DRAWER / TABBED FORM (.adm-edit-layout matching Add Property)    -->
    <!-- ========================================================================= -->
    <div id="addCommFormContainer" style="display: none; margin-bottom: 30px;">
        <form method="POST" action="{{ route('admin.communities.store') }}" enctype="multipart/form-data" id="addCommForm">
            @csrf

            <!-- Live URL Preview Bar -->
            <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b;">Page URL:</span>
                    <span style="font-size: 14px; font-family: Consolas, Monaco, monospace; color: #0284c7; font-weight: 600;" id="add_live_url_preview">
                        {{ url('/') }}/<span id="add_slug_preview">new-community</span>
                    </span>
                </div>
                <div style="display: flex; align-items: center; gap: 8px;">
                    <span style="font-size: 12px; color: #64748b; font-weight: 500;">Status:</span>
                    <div class="adm-status-dropdown-wrap" style="position: relative; display: inline-block;">
                        <input type="hidden" name="status" id="add_comm_status" value="publish">
                        <button type="button" id="add_comm_status_btn" class="adm-status-btn" onclick="toggleStatusDropdown('add_comm_status_menu')" style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700; border-radius: 8px; cursor: pointer; border: 1px solid #bbf7d0; background: #f0fdf4; color: #15803d; transition: all 0.15s ease;">
                            <span class="status-dot" style="width: 7px; height: 7px; border-radius: 50%; background: #22c55e;"></span>
                            <span id="add_comm_status_label">Publish</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 2px;"><polyline points="6 9 12 15 18 9"></polyline></svg>
                        </button>
                        <div id="add_comm_status_menu" class="adm-status-menu" style="display: none; position: absolute; right: 0; top: calc(100% + 6px); background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.05); min-width: 140px; padding: 6px; z-index: 9999;">
                            <button type="button" onclick="selectFormStatus('publish', 'Publish', '#f0fdf4', '#bbf7d0', '#15803d', '#22c55e', 'add_comm_status', 'add_comm_status_btn', 'add_comm_status_label', 'add_comm_status_menu')" class="adm-status-opt" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 7px 10px; font-size: 13px; font-weight: 600; border: none; background: none; border-radius: 6px; cursor: pointer; color: #15803d; text-align: left;">
                                <span style="width: 7px; height: 7px; border-radius: 50%; background: #22c55e;"></span> Publish
                            </button>
                            <button type="button" onclick="selectFormStatus('draft', 'Draft', '#fffbeb', '#fde68a', '#b45309', '#f59e0b', 'add_comm_status', 'add_comm_status_btn', 'add_comm_status_label', 'add_comm_status_menu')" class="adm-status-opt" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 7px 10px; font-size: 13px; font-weight: 600; border: none; background: none; border-radius: 6px; cursor: pointer; color: #b45309; text-align: left;">
                                <span style="width: 7px; height: 7px; border-radius: 50%; background: #f59e0b;"></span> Draft
                            </button>
                            <button type="button" onclick="selectFormStatus('sold_out', 'Sold out', '#fef2f2', '#fecaca', '#b91c1c', '#ef4444', 'add_comm_status', 'add_comm_status_btn', 'add_comm_status_label', 'add_comm_status_menu')" class="adm-status-opt" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 7px 10px; font-size: 13px; font-weight: 600; border: none; background: none; border-radius: 6px; cursor: pointer; color: #b91c1c; text-align: left;">
                                <span style="width: 7px; height: 7px; border-radius: 50%; background: #ef4444;"></span> Sold out
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="adm-edit-layout">
                <!-- Left Sidebar Vertical Navigation Tabs -->
                <div class="adm-tabs" role="tablist">
                    <button type="button" class="adm-tab is-active" onclick="switchAddTab('general')" data-tab-id="general">
                        @include('admin.partials.icon', ['name' => 'grid'])
                        <span>General Settings</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('hero')" data-tab-id="hero">
                        @include('admin.partials.icon', ['name' => 'spark'])
                        <span>Hero</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('content')" data-tab-id="content">
                        @include('admin.partials.icon', ['name' => 'edit'])
                        <span>Content</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('projects')" data-tab-id="projects">
                        @include('admin.partials.icon', ['name' => 'building'])
                        <span>Project Card</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('about')" data-tab-id="about">
                        @include('admin.partials.icon', ['name' => 'book'])
                        <span>About Community</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('faq')" data-tab-id="faq">
                        @include('admin.partials.icon', ['name' => 'list'])
                        <span>FAQ</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('contact')" data-tab-id="contact">
                        @include('admin.partials.icon', ['name' => 'mail'])
                        <span>Contact Section</span>
                    </button>

                    <button type="button" class="adm-tab" onclick="switchAddTab('seo')" data-tab-id="seo">
                        @include('admin.partials.icon', ['name' => 'search'])
                        <span>SEO &amp; Meta</span>
                    </button>
                </div>

                <!-- Right Form Area -->
                <div class="adm-edit-form-area">
                    <!-- 1. GENERAL SETTINGS -->
                    <div id="add_tab_general" class="tab-pane active">
                        <div class="adm-card-head">
                            <div>
                                <h2>General Settings</h2>
                                <p>Configure Neighbourhood/Community Name, Slug and status. Typing Name automatically populates the slug and Hero Heading.</p>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 6px;">
                            <div class="adm-field">
                                <label class="adm-label" for="add_comm_name">Neighbourhood/Community Name <span style="color: #ef4444;">*</span></label>
                                <input type="text" id="add_comm_name" name="name" required placeholder="e.g. Downtown, Marina, Bahria Town, Gulberg" class="adm-input" oninput="syncCommTitle(this.value)">
                                <div class="adm-help">This name will automatically set the route slug and Hero H1 title.</div>
                            </div>

                            <div class="adm-field">
                                <label class="adm-label" for="add_comm_slug">Route / Slug <span style="color: #ef4444;">*</span></label>
                                <div style="display: flex; align-items: center; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 8px; overflow: hidden;">
                                    <span style="padding: 0 12px; color: #64748b; font-family: monospace; font-size: 14px; user-select: none;">/</span>
                                    <input type="text" id="add_comm_slug" name="slug" placeholder="downtown" class="adm-input" style="border: none !important; background: transparent !important;" oninput="updateSlugPreview(this.value)">
                                </div>
                                <div class="adm-help">Live URL route for this community's dedicated landing page.</div>
                            </div>
                        </div>

                        <div class="adm-field" style="margin-top: 14px; max-width: 50%;">
                            <label class="adm-label" for="add_city_id">Cities <span style="font-weight: 400; color: #64748b; font-size: 12px;">(Select City)</span></label>
                            <select id="add_city_id" name="city_id" class="adm-input" style="background: #ffffff; cursor: pointer;">
                                <option value="">-- Select City --</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            <div class="adm-help">Jo cities add ki hain wo is dropdown me ayengi. Select karein kis city me ye community aati hai.</div>
                        </div>

                        <div class="adm-field" style="margin-top: 18px;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13.5px; font-weight: 600; color: #1e293b;">
                                <input type="checkbox" name="in_navbar" value="1" checked style="width: 16px; height: 16px;">
                                <span>Show in Top Navigation Menu</span>
                            </label>
                        </div>
                    </div>

                    <!-- 2. HERO -->
                    <div id="add_tab_hero" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Hero Banner</h2>
                                <p>Main visual section at the top of the City page.</p>
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_hero_title">Hero Main Heading (H1) <span style="color: #ef4444;">*</span></label>
                            <input type="text" id="add_hero_title" name="sections[hero][title]" placeholder="Neighbourhood / Community Name" class="adm-input">
                            <div class="adm-help">Auto-filled from Community Name. Can be customized if desired.</div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_hero_subtitle">Hero Subtitle</label>
                            <textarea id="add_hero_subtitle" name="sections[hero][subtitle]" rows="2" class="adm-textarea" placeholder="Explore Premier Properties, Waterfront Developments &amp; Investment Opportunities"></textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_hero_badge">Badge / Pill Text</label>
                            <input type="text" id="add_hero_badge" name="sections[hero][badge]" value="Prime Real Estate Destination" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label">Hero Background Image</label>
                            <input type="file" name="hero_image_file" accept="image/*" class="adm-input" style="padding: 7px 10px;">
                            <div style="margin-top: 6px; font-size: 12px; color: #64748b;">Or provide an image URL:</div>
                            <input type="text" name="sections[hero][bg_image]" placeholder="/images/hero/slide-1.jpg" class="adm-input" style="margin-top: 4px;">
                        </div>
                    </div>

                    <!-- 3. CONTENT TAB (WYSIWYG) -->
                    <div id="add_tab_content" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Content Editor</h2>
                                <p>Single visual WYSIWYG editor containing complete page article, H1/H2/H3 headings, paragraphs, and embedded photos.</p>
                            </div>
                            <span class="adm-chip" style="background: #f1f5f9; color: #475569; font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 6px; text-transform: uppercase;">content section</span>
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

                    <!-- 4. PROJECT CARD -->
                    <div id="add_tab_projects" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Project Card (Featured Properties)</h2>
                                <p>Select which property cards appear in this city's featured projects section.</p>
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_comm_heading">Section Heading</label>
                            <input type="text" id="add_comm_heading" name="sections[communities][heading]" value="Featured Projects" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_comm_subtitle">Section Subtitle</label>
                            <input type="text" id="add_comm_subtitle" name="sections[communities][subtitle]" value="Explore premium residential and commercial developments" class="adm-input">
                        </div>

                        <div style="margin-top: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <span style="font-size: 13px; font-weight: 700; color: #1a4731; text-transform: uppercase; letter-spacing: 0.5px;">
                                    Select Property Cards (Drag &amp; Drop Between Boxes):
                                </span>
                                <span style="font-size: 12px; color: #64748b;">
                                    Mouse se card ko pakar kar right box me le aayein ya (+ Add) par click karein
                                </span>
                            </div>

                            <!-- Dual Boxes Grid matching Image 2 -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                
                                <!-- BOX 1: All Available Property Cards -->
                                <div style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 16px; display: flex; flex-direction: column;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                                        <div>
                                            <strong style="font-size: 13.5px; color: #1e293b; display: flex; align-items: center; gap: 6px;">
                                                📁 Available Property Cards ( <span id="availableCount">{{ $allProjects->count() }}</span> )
                                            </strong>
                                            <span style="font-size: 11.5px; color: #64748b;">All created property cards in your system</span>
                                        </div>
                                    </div>

                                    <div id="box1_availableCards" ondragover="allowDropCard(event)" ondrop="dropCardToAvailable(event)" style="display: flex; flex-direction: column; gap: 8px; min-height: 380px; max-height: 540px; overflow-y: auto; padding: 4px;">
                                        @foreach($allProjects as $proj)
                                            <div class="dual-project-card" id="proj_card_{{ $proj->id }}" data-id="{{ $proj->id }}" draggable="true" ondragstart="dragCardStart(event)" ondragend="dragCardEnd(event)" style="display: flex; align-items: center; gap: 10px; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 8px; padding: 9px 12px; cursor: grab; box-shadow: 0 1px 2px rgba(0,0,0,0.03); transition: all 0.15s ease;">
                                                <span style="color: #94a3b8; font-size: 14px; cursor: grab; user-select: none;">⠿</span>
                                                <img src="{{ $proj->image_url }}" alt="" style="width: 48px; height: 34px; object-fit: cover; border-radius: 5px; border: 1px solid #cbd5e1; flex-shrink: 0; background: #f1f5f9;">
                                                <div style="flex: 1; min-width: 0;">
                                                    <strong class="dual-card-title" style="display: block; font-size: 13px; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $proj->title }}</strong>
                                                    <span style="font-size: 11px; color: #64748b;">{{ $proj->price ?: ($proj->location ?: 'Hudayriyat Island') }}</span>
                                                </div>
                                                <button type="button" onclick="moveCardToSelected({{ $proj->id }})" title="Add to page" style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; border-radius: 6px; padding: 5px 11px; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 4px; flex-shrink: 0;">
                                                    + Add
                                                </button>
                                            </div>
                                        @endforeach
                                        @if($allProjects->isEmpty())
                                            <div style="text-align: center; padding: 40px 10px; color: #94a3b8; font-size: 13px;">
                                                No property cards found.<br>
                                                <a href="{{ route('admin.projects.index') }}" target="_blank" style="color: #0284c7; text-decoration: underline;">Create property cards in Projects module</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- BOX 2: Selected Cards for This Page -->
                                <div style="background: #ffffff; border: 1.5px solid #1a4731; border-radius: 12px; padding: 16px; display: flex; flex-direction: column; box-shadow: 0 4px 14px rgba(26, 71, 49, 0.05);">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px solid #f1f5f9;">
                                        <div>
                                            <strong style="font-size: 13.5px; color: #1a4731; display: flex; align-items: center; gap: 6px;">
                                                ✓ Selected Cards for This Page ( <span id="selectedCount">0</span> )
                                            </strong>
                                            <span style="font-size: 11.5px; color: #64748b;">Sirf ye cards aapke page par dikhenge</span>
                                        </div>
                                        <button type="button" onclick="clearAllSelectedCards()" style="background: none; border: none; font-size: 11.5px; color: #ef4444; cursor: pointer; text-decoration: underline;">Clear All</button>
                                    </div>

                                    <div id="box2_selectedCards" ondragover="allowDropCard(event)" ondrop="dropCardToSelected(event)" style="display: flex; flex-direction: column; gap: 8px; min-height: 380px; max-height: 540px; overflow-y: auto; padding: 4px; border-radius: 8px;">
                                        <!-- Empty placeholder when 0 cards -->
                                        <div id="selectedCardsEmptyState" style="text-align: center; padding: 80px 20px; border: 2px dashed #e2e8f0; border-radius: 8px; color: #94a3b8;">
                                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.8" style="margin: 0 auto 10px; display: block;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                                            <strong style="display: block; font-size: 14px; color: #475569; margin-bottom: 4px;">Drag Cards Here</strong>
                                            <span style="font-size: 12px; color: #94a3b8;">Left box se mouse se pakar kar yahan chhor dein (drop karein)</span>
                                        </div>
                                    </div>

                                    <!-- Hidden container for form inputs -->
                                    <div id="selectedCardsInputsContainer"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- 5. ABOUT COMMUNITY -->
                    <div id="add_tab_about" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>About Community</h2>
                                <p>Detailed narrative, video stream URL, and poster image.</p>
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_about_heading">Headline</label>
                            <input type="text" id="add_about_heading" name="sections[about][heading]" value="About the Community" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_about_desc">City Narrative &amp; Story</label>
                            <textarea id="add_about_desc" name="sections[about][description]" rows="5" class="adm-textarea" placeholder="Detailed story about this city's master infrastructure, waterfront, and lifestyle...">A meticulously planned coastal sanctuary seamlessly integrating contemporary luxury living with untouched nature. Spanning scenic waterfronts, lush mangroves, and cycling corridors, the master community offers an unmatched urban lifestyle for residents and high-yield potential for global real estate investors.</textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_about_video">Video URL (HLS / MP4)</label>
                            <input type="text" id="add_about_video" name="sections[about][video_url]" value="https://stream.mux.com/A3200aZtT5Wq7VlYwQv3wP9W2hX8.m3u8" placeholder="https://stream.mux.com/... or https://..." class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_about_poster">Video Poster / Cover Image</label>
                            <div class="adm-img-box" style="display: flex; gap: 14px; align-items: center; background: #faf8f5; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px;">
                                <img id="preview_add_about_poster" src="/images/projects/poster.jpg" style="width: 100px; height: 62px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; background: #ffffff;" alt="Poster">
                                <div style="flex: 1;">
                                    <div style="margin-bottom: 8px;">
                                        <input type="file" name="about_poster_file" accept="image/*" class="adm-input" style="padding: 6px 10px;" onchange="if(this.files && this.files[0]){const r=new FileReader();r.onload=e=>document.getElementById('preview_add_about_poster').src=e.target.result;r.readAsDataURL(this.files[0]);}">
                                    </div>
                                    <input type="text" id="add_about_poster" name="sections[about][poster_image]" value="/images/projects/poster.jpg" placeholder="/images/projects/poster.jpg" class="adm-input" oninput="document.getElementById('preview_add_about_poster').src = this.value">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 6. FAQ -->
                    <div id="add_tab_faq" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Frequently Asked Questions</h2>
                                <p>Interactive accordion questions and answers for buyers &amp; investors.</p>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 18px;">
                            <div class="adm-field" style="margin-bottom: 0;">
                                <label class="adm-label" for="add_faq_title">FAQ Section Title</label>
                                <input type="text" id="add_faq_title" name="sections[faq][title]" value="Frequently Asked Questions" class="adm-input">
                            </div>

                            <div class="adm-field" style="margin-bottom: 0;">
                                <label class="adm-label" for="add_faq_subtitle">FAQ Subtitle</label>
                                <input type="text" id="add_faq_subtitle" name="sections[faq][subtitle]" value="Find answers to common questions about properties, buying process, and payment plans." class="adm-input">
                            </div>
                        </div>

                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; border-bottom: 1px solid #e5e7eb; padding-bottom: 8px;">
                            <span style="font-size: 12.5px; font-weight: 700; color: #1a4731; text-transform: uppercase; letter-spacing: 0.5px;">
                                Questions &amp; Answers List:
                            </span>
                            <span style="font-size: 11.5px; color: #6b7280;">Drag ⇅ to reorder, ✕ to delete</span>
                        </div>

                        <!-- Table-like Header (Question next to Answer) -->
                        <div style="display: grid; grid-template-columns: 34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap: 10px; padding: 0 6px; margin-bottom: 6px; font-size: 11px; font-weight: 700; text-transform: uppercase; color: #6b7280;" aria-hidden="true">
                            <span></span><span>Question</span><span>Answer</span><span></span>
                        </div>

                        <div id="faqItemsContainer" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 12px;">
                            <!-- Default FAQ Item 1 -->
                            <div class="faq-repeater-row" style="display: grid; grid-template-columns: 34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap: 10px; align-items: center; background: #faf8f5; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px;">
                                <div class="faq-drag-handle" draggable="true" style="display: flex; align-items: center; justify-content: center; width: 34px; height: 36px; border: 1px solid #d1d5db; background: #ffffff; border-radius: 6px; color: #1a4731; cursor: grab; user-select: none;" title="Drag ⇅ to reorder">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                                </div>
                                <input type="text" name="faq_q[]" value="Are properties in this city freehold for foreign and overseas investors?" class="adm-input" placeholder="Question" style="margin: 0; min-height: 36px; font-size: 13px;">
                                <textarea name="faq_a[]" class="adm-textarea" rows="1" placeholder="Answer" style="margin: 0; min-height: 36px; font-size: 13px; resize: vertical; line-height: 1.4;">Yes, designated luxury master developments offer 100% freehold ownership for local and international buyers with complete title deed registration.</textarea>
                                <button type="button" onclick="this.closest('.faq-repeater-row').remove()" title="Delete row" style="width: 34px; height: 36px; border: 1px solid #fecaca; background: #fef2f2; color: #b91c1c; border-radius: 6px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center; transition: all 0.15s ease;">&#10005;</button>
                            </div>

                            <!-- Default FAQ Item 2 -->
                            <div class="faq-repeater-row" style="display: grid; grid-template-columns: 34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap: 10px; align-items: center; background: #faf8f5; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px;">
                                <div class="faq-drag-handle" draggable="true" style="display: flex; align-items: center; justify-content: center; width: 34px; height: 36px; border: 1px solid #d1d5db; background: #ffffff; border-radius: 6px; color: #1a4731; cursor: grab; user-select: none;" title="Drag ⇅ to reorder">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                                </div>
                                <input type="text" name="faq_q[]" value="What are the typical payment plans available?" class="adm-input" placeholder="Question" style="margin: 0; min-height: 36px; font-size: 13px;">
                                <textarea name="faq_a[]" class="adm-textarea" rows="1" placeholder="Answer" style="margin: 0; min-height: 36px; font-size: 13px; resize: vertical; line-height: 1.4;">Flexible installment plans are offered typically linked to construction milestones, with down payments starting from 5% to 10%.</textarea>
                                <button type="button" onclick="this.closest('.faq-repeater-row').remove()" title="Delete row" style="width: 34px; height: 36px; border: 1px solid #fecaca; background: #fef2f2; color: #b91c1c; border-radius: 6px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center; transition: all 0.15s ease;">&#10005;</button>
                            </div>
                        </div>

                        <!-- Add Row Button matching Image 2 -->
                        <button type="button" onclick="addFaqRow()" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; cursor: pointer; border: 1.5px dashed #1a4731; color: #1a4731; background: #faf8f5; border-radius: 8px; display: inline-flex; align-items: center; gap: 6px; transition: all 0.15s ease;">
                            + Add Row
                        </button>
                    </div>

                    <!-- 7. CONTACT SECTION -->
                    <div id="add_tab_contact" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>Contact Section</h2>
                                <p>Call-to-action banner for direct inquiries, bookings, and VIP viewings.</p>
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_contact_heading">Heading</label>
                            <input type="text" id="add_contact_heading" name="sections[contact][heading]" value="Ready to Find Your Dream Property?" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_contact_sub">Subtitle</label>
                            <textarea id="add_contact_sub" name="sections[contact][subtitle]" rows="2" class="adm-textarea">Connect with our dedicated city property advisors for personalized availability, floor plans, and VIP access.</textarea>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                            <div class="adm-field">
                                <label class="adm-label" for="add_contact_phone">Phone / WhatsApp</label>
                                <input type="text" id="add_contact_phone" name="sections[contact][phone]" value="+971 2 000 0000" class="adm-input">
                            </div>
                            <div class="adm-field">
                                <label class="adm-label" for="add_contact_email">Email Address</label>
                                <input type="email" id="add_contact_email" name="sections[contact][email]" value="info@hudayriyat-island.ae" class="adm-input">
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_contact_btn">Button Text</label>
                            <input type="text" id="add_contact_btn" name="sections[contact][btn_text]" value="Schedule a Private Viewing" class="adm-input">
                        </div>
                    </div>

                    <!-- 8. SEO & META -->
                    <div id="add_tab_seo" class="tab-pane">
                        <div class="adm-card-head">
                            <div>
                                <h2>SEO &amp; Meta Settings</h2>
                                <p>Search engine title, meta description, and keywords for this city page.</p>
                            </div>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_meta_title">Meta Title</label>
                            <input type="text" id="add_meta_title" name="meta_title" placeholder="Properties &amp; Real Estate | Luxury Waterfront Living" class="adm-input">
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_meta_description">Meta Description</label>
                            <textarea id="add_meta_description" name="meta_description" rows="3" class="adm-textarea" placeholder="Explore top real estate investments, new project launches, and luxury residences."></textarea>
                        </div>

                        <div class="adm-field">
                            <label class="adm-label" for="add_meta_keywords">Meta Keywords</label>
                            <input type="text" id="add_meta_keywords" name="meta_keywords" placeholder="real estate, properties, luxury homes" class="adm-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sticky Bottom Action Bar -->
            <div style="position: sticky; bottom: 0; background: #ffffff; border-top: 1px solid #e2e8f0; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 -4px 10px rgba(0,0,0,0.03); border-radius: 0 0 16px 16px; margin-top: -10px; z-index: 10;">
                <div style="font-size: 13.5px; color: #64748b; font-weight: 500;">
                    Creating Community Page for: <strong id="action_bar_city_name" style="color: #0f172a;">New Community</strong>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button type="button" class="adm-btn" onclick="toggleAddCommForm()" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 8px 18px; border-radius: 8px;">Cancel</button>
                    <button type="submit" class="adm-btn adm-btn-primary" style="padding: 8px 24px; border-radius: 8px;">Save Community</button>
                </div>
            </div>
        </form>
    </div>

    <!-- ========================================================================= -->
    <!-- CITIES LISTING TABLE (#, NAME, STATUS, ACTIONS)                           -->
    <!-- ========================================================================= -->
    <div style="background: #ffffff; border-radius: 14px; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.03); padding: 20px 24px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; flex-wrap: wrap; gap: 12px;">
            <div style="position: relative; width: 100%; max-width: 280px;">
                <svg style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); width: 16px; height: 16px; color: #94a3b8; pointer-events: none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8"></circle>
                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                </svg>
                <input type="text" id="cmsSearchInput" placeholder="Search communities..." style="width: 100%; background: #f8fafc; border: 1px solid #f1f5f9; border-radius: 10px; padding: 10px 14px 10px 40px; font-size: 13.5px; color: #1e293b; outline: none; transition: all 0.2s;" onkeyup="filterCommTable(this.value)">
            </div>
            <div style="font-size: 13px; color: #64748b;">
                Showing <strong>{{ $totalCommunities }}</strong> communities
            </div>
        </div>

        <div style="width: 100%; overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <th style="padding: 10px 12px; font-size: 12px; font-weight: 700; color: #8c9ba5; letter-spacing: 0.06em; width: 70px;">
                            # <span style="font-size: 10px;">▲</span>
                        </th>
                        <th style="padding: 10px 12px; font-size: 12px; font-weight: 700; color: #8c9ba5; letter-spacing: 0.06em;">
                            NAME
                        </th>
                        <th style="padding: 10px 12px; font-size: 12px; font-weight: 700; color: #8c9ba5; letter-spacing: 0.06em; width: 140px;">
                            CITY
                        </th>
                        <th style="padding: 10px 12px; font-size: 12px; font-weight: 700; color: #8c9ba5; letter-spacing: 0.06em; width: 130px;">
                            STATUS
                        </th>
                        <th style="padding: 10px 12px; font-size: 12px; font-weight: 700; color: #8c9ba5; letter-spacing: 0.06em; text-align: right; width: 130px;">
                            ACTIONS
                        </th>
                    </tr>
                </thead>
                <tbody id="citiesTableBody">
                    @forelse($communities as $comm)
                        <tr class="city-row" data-name="{{ strtolower($comm->name) }}" style="border-bottom: 1px dotted #e2e8f0; transition: background 0.15s ease;">
                            <td style="padding: 16px 12px; font-size: 14px; color: #64748b; font-weight: 500;">
                                {{ $loop->iteration }}
                            </td>
                            <td style="padding: 16px 12px; font-size: 14.5px; color: #334155; font-weight: 500;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <strong style="color: #1e293b; font-weight: 600;">{{ $comm->name }}</strong>
                                    <span style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; font-size: 10px; font-weight: 700; padding: 2px 7px; border-radius: 4px; text-transform: uppercase;">Community</span>
                                </div>
                                <span style="font-size: 12px; color: #94a3b8; display: block; margin-top: 3px; font-family: Consolas, Monaco, monospace;">
                                    /{{ ltrim($comm->slug, '/') }}
                                </span>
                            </td>

                            <!-- CITY -->
                            <td style="padding: 16px 12px; vertical-align: middle;">
                                @if($comm->city)
                                    <span style="display: inline-flex; align-items: center; gap: 5px; background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 6px;">
                                        @include('admin.partials.icon', ['name' => 'map-pin', 'size' => 12])
                                        {{ $comm->city->name }}
                                    </span>
                                @else
                                    <span style="color: #94a3b8; font-size: 12.5px; font-style: italic;">Not Assigned</span>
                                @endif
                            </td>

                            <td style="padding: 16px 12px; vertical-align: middle;">
                                @php
                                    $cStatus = $comm->status ?: ($comm->is_active ? 'publish' : 'draft');
                                    $badgeConfig = match($cStatus) {
                                        'sold_out' => ['bg' => '#fef2f2', 'border' => '#fecaca', 'color' => '#b91c1c', 'dot' => '#ef4444', 'label' => 'Sold out'],
                                        'draft'    => ['bg' => '#fffbeb', 'border' => '#fde68a', 'color' => '#b45309', 'dot' => '#f59e0b', 'label' => 'Draft'],
                                        default    => ['bg' => '#f0fdf4', 'border' => '#bbf7d0', 'color' => '#15803d', 'dot' => '#22c55e', 'label' => 'Publish'],
                                    };
                                @endphp
                                <span style="display: inline-flex; align-items: center; gap: 6px; padding: 4px 10px; font-size: 12px; font-weight: 700; border-radius: 6px; border: 1px solid {{ $badgeConfig['border'] }}; background: {{ $badgeConfig['bg'] }}; color: {{ $badgeConfig['color'] }}; text-transform: capitalize; user-select: none;">
                                    <span style="width: 6px; height: 6px; border-radius: 50%; background: {{ $badgeConfig['dot'] }};"></span>
                                    <span>{{ $badgeConfig['label'] }}</span>
                                </span>
                            </td>

                            <!-- ACTIONS -->
                            <td style="padding: 16px 12px; text-align: right; vertical-align: middle;">
                                <div style="display: inline-flex; align-items: center; gap: 4px;">
                                    <!-- View Page -->
                                    <a href="{{ url('/' . ltrim($comm->slug, '/')) }}" target="_blank" class="cms-action-btn" title="View Public Page">
                                        @include('admin.partials.icon', ['name' => 'external'])
                                    </a>
                                    <!-- Edit Community -->
                                    <a href="{{ route('admin.communities.edit', $comm->id) }}" class="cms-action-btn" title="Edit Neighbourhood/Community">
                                        @include('admin.partials.icon', ['name' => 'edit'])
                                    </a>
                                    <!-- Delete Community -->
                                    <form method="POST" action="{{ route('admin.communities.destroy', $comm->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete {{ addslashes($comm->name) }} and its linked page?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cms-action-btn cms-action-delete" style="border: none; background: transparent; cursor: pointer;" title="Delete Neighbourhood/Community">
                                            @include('admin.partials.icon', ['name' => 'trash'])
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center; padding: 48px 20px; color: #94a3b8;">
                                <div style="font-size: 15px; font-weight: 600; color: #64748b; margin-bottom: 6px;">No Cities Created Yet</div>
                                <div style="font-size: 13px;">Click the <strong>"+ Add Neighbourhood/Community"</strong> button above to create your first city page.</div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Tab switching in Add Neighbourhood/Community Drawer
    function switchAddTab(tabId) {
        document.querySelectorAll('#addCommFormContainer .adm-tab').forEach(btn => {
            btn.classList.toggle('is-active', btn.getAttribute('data-tab-id') === tabId);
        });
        document.querySelectorAll('#addCommFormContainer .tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });
        const target = document.getElementById('add_tab_' + tabId);
        if (target) {
            target.classList.add('active');
            if (tabId === 'content' && window.initSummernote) {
                window.initSummernote();
            }
        }
    }

    // Toggle Add Neighbourhood/Community Drawer
    function toggleAddCommForm() {
        const drawer = document.getElementById('addCommFormContainer');
        if (drawer.style.display === 'none' || drawer.style.display === '') {
            drawer.style.display = 'block';
            window.scrollTo({ top: drawer.offsetTop - 20, behavior: 'smooth' });
            if (window.initSummernote) {
                window.initSummernote();
            }
            const nameEl = document.getElementById('add_comm_name');
            if (nameEl) nameEl.focus();
        } else {
            drawer.style.display = 'none';
        }
    }

    // Live Title -> Slug and Hero Heading H1 sync
    function syncCommTitle(commName) {
        const raw = commName || '';
        // Slugify: lowercase, strip non-alphanumeric, convert spaces and multiple dashes to single dash
        const slug = raw
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');

        const slugInput = document.getElementById('add_comm_slug');
        if (slugInput) {
            slugInput.value = slug;
        }

        const preview = document.getElementById('add_slug_preview');
        if (preview) {
            preview.textContent = slug || 'new-community';
        }

        const heroH1 = document.getElementById('add_hero_title');
        if (heroH1) {
            heroH1.value = raw;
        }

        const barName = document.getElementById('action_bar_city_name');
        if (barName) {
            barName.textContent = raw.trim() || 'New Community';
        }
    }

    // Safety alias
    function syncCityTitle(cityName) {
        syncCommTitle(cityName);
    }

    function updateSlugPreview(val) {
        const slug = (val || '')
            .toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s_-]+/g, '-')
            .replace(/^-+|-+$/g, '');
        const preview = document.getElementById('add_slug_preview');
        if (preview) {
            preview.textContent = slug || 'new-community';
        }
    }

    // ==========================================
    // DUAL-BOX CARD SELECTOR (DRAG & DROP + CLICK)
    // ==========================================
    let draggedDualCard = null;

    function dragCardStart(e) {
        draggedDualCard = e.currentTarget;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', e.currentTarget.getAttribute('data-id'));
        setTimeout(() => { if (draggedDualCard) draggedDualCard.style.opacity = '0.4'; }, 0);
    }

    function dragCardEnd(e) {
        if (e.currentTarget) {
            e.currentTarget.style.opacity = '1';
        }
        draggedDualCard = null;
    }

    function allowDropCard(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
    }

    function dropCardToSelected(e) {
        e.preventDefault();
        const card = draggedDualCard;
        if (!card) return;

        const box2 = document.getElementById('box2_selectedCards');
        if (!box2) return;

        const targetCard = e.target.closest('.dual-project-card');
        if (targetCard && targetCard.parentNode === box2 && targetCard !== card) {
            box2.insertBefore(card, targetCard);
        } else {
            box2.appendChild(card);
        }

        const id = card.getAttribute('data-id');
        setCardToSelectedStyle(card, id);
        updateDualBoxState();
    }

    function dropCardToAvailable(e) {
        e.preventDefault();
        const card = draggedDualCard;
        if (!card) return;

        const box1 = document.getElementById('box1_availableCards');
        if (!box1) return;

        box1.appendChild(card);
        const id = card.getAttribute('data-id');
        setCardToAvailableStyle(card, id);
        updateDualBoxState();
    }

    function moveCardToSelected(id) {
        const card = document.getElementById('proj_card_' + id);
        const box2 = document.getElementById('box2_selectedCards');
        if (!card || !box2) return;

        box2.appendChild(card);
        setCardToSelectedStyle(card, id);
        updateDualBoxState();
    }

    function moveCardToAvailable(id) {
        const card = document.getElementById('proj_card_' + id);
        const box1 = document.getElementById('box1_availableCards');
        if (!card || !box1) return;

        box1.appendChild(card);
        setCardToAvailableStyle(card, id);
        updateDualBoxState();
    }

    function clearAllSelectedCards() {
        const box1 = document.getElementById('box1_availableCards');
        const box2 = document.getElementById('box2_selectedCards');
        if (!box1 || !box2) return;

        const cards = Array.from(box2.querySelectorAll('.dual-project-card'));
        cards.forEach(card => {
            box1.appendChild(card);
            const id = card.getAttribute('data-id');
            setCardToAvailableStyle(card, id);
        });
        updateDualBoxState();
    }

    function setCardToSelectedStyle(card, id) {
        card.style.background = '#f0fdf4';
        card.style.borderColor = '#86efac';
        const actionBtn = card.querySelector('button');
        if (actionBtn) {
            actionBtn.setAttribute('onclick', `moveCardToAvailable(${id})`);
            actionBtn.setAttribute('title', 'Remove from page');
            actionBtn.style.background = '#fef2f2';
            actionBtn.style.borderColor = '#fecaca';
            actionBtn.style.color = '#dc2626';
            actionBtn.innerHTML = '✕ Remove';
        }
    }

    function setCardToAvailableStyle(card, id) {
        card.style.background = '#ffffff';
        card.style.borderColor = '#e2e8f0';
        const actionBtn = card.querySelector('button');
        if (actionBtn) {
            actionBtn.setAttribute('onclick', `moveCardToSelected(${id})`);
            actionBtn.setAttribute('title', 'Add to page');
            actionBtn.style.background = '#f0fdf4';
            actionBtn.style.borderColor = '#bbf7d0';
            actionBtn.style.color = '#15803d';
            actionBtn.innerHTML = '+ Add';
        }
    }

    function updateDualBoxState() {
        const box1 = document.getElementById('box1_availableCards');
        const box2 = document.getElementById('box2_selectedCards');
        const availCountSpan = document.getElementById('availableCount');
        const selCountSpan = document.getElementById('selectedCount');
        const emptyState = document.getElementById('selectedCardsEmptyState');
        const inputsContainer = document.getElementById('selectedCardsInputsContainer');

        if (!box1 || !box2) return;

        const availCards = box1.querySelectorAll('.dual-project-card');
        const selCards = box2.querySelectorAll('.dual-project-card');

        if (availCountSpan) availCountSpan.textContent = availCards.length;
        if (selCountSpan) selCountSpan.textContent = selCards.length;

        if (emptyState) {
            emptyState.style.display = selCards.length === 0 ? 'block' : 'none';
        }

        if (inputsContainer) {
            inputsContainer.innerHTML = '';
            selCards.forEach(card => {
                const id = card.getAttribute('data-id');
                if (id) {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'selected_project_ids[]';
                    input.value = id;
                    inputsContainer.appendChild(input);
                }
            });
        }
    }

    // FAQ Drag & Drop Reordering Logic
    let draggedFaqRow = null;

    function bindFaqDragEvents(row) {
        if (!row) return;
        const handle = row.querySelector('.faq-drag-handle');
        if (!handle) return;

        handle.setAttribute('draggable', 'true');

        handle.addEventListener('dragstart', function(e) {
            draggedFaqRow = row;
            row.classList.add('is-dragging');
            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/plain', '');
            if (e.dataTransfer.setDragImage) {
                e.dataTransfer.setDragImage(row, 20, 20);
            }
        });

        handle.addEventListener('dragend', function() {
            if (draggedFaqRow) {
                draggedFaqRow.classList.remove('is-dragging');
            }
            document.querySelectorAll('.faq-repeater-row').forEach(r => {
                r.classList.remove('drag-over-top', 'drag-over-bottom', 'is-dragging');
            });
            draggedFaqRow = null;
        });

        row.addEventListener('dragover', function(e) {
            if (!draggedFaqRow || draggedFaqRow === this || draggedFaqRow.parentNode !== this.parentNode) return;
            e.preventDefault();
            e.dataTransfer.dropEffect = 'move';
            const rect = this.getBoundingClientRect();
            const midpoint = rect.top + rect.height / 2;
            if (e.clientY < midpoint) {
                this.classList.add('drag-over-top');
                this.classList.remove('drag-over-bottom');
            } else {
                this.classList.add('drag-over-bottom');
                this.classList.remove('drag-over-top');
            }
        });

        row.addEventListener('dragleave', function() {
            this.classList.remove('drag-over-top', 'drag-over-bottom');
        });

        row.addEventListener('drop', function(e) {
            if (!draggedFaqRow || draggedFaqRow === this || draggedFaqRow.parentNode !== this.parentNode) return;
            e.preventDefault();
            this.classList.remove('drag-over-top', 'drag-over-bottom');
            const list = this.parentNode;
            const rect = this.getBoundingClientRect();
            const midpoint = rect.top + rect.height / 2;
            if (e.clientY < midpoint) {
                list.insertBefore(draggedFaqRow, this);
            } else {
                list.insertBefore(draggedFaqRow, this.nextSibling);
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        updateDualBoxState();
        document.querySelectorAll('#faqItemsContainer .faq-repeater-row').forEach(bindFaqDragEvents);
    });

    // Add FAQ row dynamically matching Image 2
    function addFaqRow() {
        const container = document.getElementById('faqItemsContainer');
        const div = document.createElement('div');
        div.className = 'faq-repeater-row';
        div.style.cssText = 'display: grid; grid-template-columns: 34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap: 10px; align-items: center; background: #faf8f5; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px;';
        div.innerHTML = `
            <div class="faq-drag-handle" draggable="true" style="display: flex; align-items: center; justify-content: center; width: 34px; height: 36px; border: 1px solid #d1d5db; background: #ffffff; border-radius: 6px; color: #1a4731; cursor: grab; user-select: none;" title="Drag ⇅ to reorder">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
            </div>
            <input type="text" name="faq_q[]" class="adm-input" placeholder="Question" style="margin: 0; min-height: 36px; font-size: 13px;">
            <textarea name="faq_a[]" class="adm-textarea" rows="1" placeholder="Answer" style="margin: 0; min-height: 36px; font-size: 13px; resize: vertical; line-height: 1.4;"></textarea>
            <button type="button" onclick="this.closest('.faq-repeater-row').remove()" title="Delete row" style="width: 34px; height: 36px; border: 1px solid #fecaca; background: #fef2f2; color: #b91c1c; border-radius: 6px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center; transition: all 0.15s ease;">&#10005;</button>
        `;
        container.appendChild(div);
        bindFaqDragEvents(div);
        const input = div.querySelector('input');
        if (input) input.focus();
    }

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

    // Status dropdown toggle for table listing & quick AJAX update
    function toggleCommStatusMenu(commId) {
        const menu = document.getElementById('status_menu_' + commId);
        document.querySelectorAll('[id^="status_menu_"]').forEach(m => {
            if (m !== menu) m.style.display = 'none';
        });
        if (menu) {
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
        }
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('[id^="status_btn_"]') && !e.target.closest('[id^="status_menu_"]') && !e.target.closest('.adm-status-dropdown-wrap')) {
            document.querySelectorAll('[id^="status_menu_"], .adm-status-menu').forEach(m => m.style.display = 'none');
        }
    });

    function quickUpdateCommStatus(commId, status) {
        fetch('{{ url("/admin/communities") }}/' + commId + '/status', {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status: status })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            } else {
                alert('Status update failed');
            }
        })
        .catch(() => window.location.reload());
    }

    // Table search filter
    function filterCommTable(query) {
        const q = (query || '').toLowerCase().trim();
        document.querySelectorAll('#citiesTableBody .city-row').forEach(row => {
            const name = row.getAttribute('data-name') || '';
            row.style.display = name.includes(q) ? '' : 'none';
        });
    }
</script>
@endsection
