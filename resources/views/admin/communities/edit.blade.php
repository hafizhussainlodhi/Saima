@extends('admin.layouts.app')

@section('title', 'Edit Neighbourhood/Community > ' . $community->name)

@push('styles')
<style>
    .adm-topbar { display: none !important; }
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
    .adm-edit-layout > .adm-tabs {
        flex: 0 0 240px !important;
        width: 240px !important;
        display: flex !important;
        flex-direction: column !important;
        gap: 4px !important;
        position: sticky !important;
        top: 20px !important;
    }
    .adm-edit-layout > .adm-tabs .adm-tab {
        background: transparent !important;
        border: none !important;
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
    .adm-edit-layout > .adm-tabs .adm-tab.is-active {
        background: #f0f9ff !important;
        color: #0284c7 !important;
        font-weight: 600 !important;
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
    .adm-edit-layout > .adm-edit-form-area {
        flex: 1 1 0 !important;
        min-width: 0 !important;
    }
    .adm-edit-layout .tab-pane { display: none; }
    .adm-edit-layout .tab-pane.active { display: block; }
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
        width: 100%;
        box-sizing: border-box;
    }
    .adm-edit-layout .adm-field { margin-bottom: 18px; }
    .adm-edit-layout .adm-label {
        display: block;
        font-size: 13px !important;
        font-weight: 600 !important;
        color: #334155 !important;
        margin-bottom: 6px !important;
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
<div id="editCommunityView">
    <div class="cms-page-header" style="margin-bottom: 22px; display: flex; justify-content: space-between; align-items: flex-end; flex-wrap: wrap; gap: 14px;">
        <div>
            <h1 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0;">Edit Neighbourhood/Community &gt; {{ $community->name }}</h1>
            <div style="font-size: 13px; color: #8c9ba5;">Home &ndash; Manage &ndash; Neighbourhood/Community &ndash; {{ $community->name }}</div>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('admin.communities.index') }}" class="adm-btn" style="background: #ffffff; border: 1px solid #cbd5e1; color: #475569; padding: 8px 16px; border-radius: 8px; text-decoration: none; font-size: 13px; font-weight: 600;">
                &larr; Back to Neighbourhood/Community
            </a>
            <a href="{{ url('/' . ltrim($community->slug, '/')) }}" target="_blank" class="adm-btn adm-btn-primary" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; padding: 8px 16px; border-radius: 8px; text-decoration: none;">
                @include('admin.partials.icon', ['name' => 'external']) View Community Page
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ route('admin.communities.update', $community->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @php
            $page = $page ?? ($community->page ?? null);
            $sections = $sections ?? ($page ? $page->sections->keyBy('section_key') : collect());
            $heroContent = $sections['hero']->content ?? [];
            $tocContent  = $sections['content']->content ?? [];
            $commContent = $sections['communities']->content ?? [];
            $aboutContent= $sections['about']->content ?? [];
            $faqContent  = $sections['faq']->content ?? [];
            $contactContent = $sections['contact']->content ?? [];

            $selectedProjectIds = $selectedProjectIds ?? ($commContent['selected_ids'] ?? []);
            if (!is_array($selectedProjectIds)) {
                $selectedProjectIds = [];
            }
            $faqItems = $faqItems ?? ($faqContent['items'] ?? []);
            if (!is_array($faqItems) || empty($faqItems)) {
                $faqItems = [
                    ['q' => 'Are properties in this city freehold for foreign and overseas investors?', 'a' => 'Yes, designated luxury master developments offer 100% freehold ownership for local and international buyers with complete title deed registration.'],
                    ['q' => 'What are the typical payment plans available?', 'a' => 'Flexible installment plans are offered typically linked to construction milestones, with down payments starting from 5% to 10%.'],
                ];
            }
        @endphp

        <!-- Top Live Preview Bar -->
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; padding: 14px 20px; margin-bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #64748b;">Page URL:</span>
                <span style="font-size: 14px; font-family: monospace; color: #0284c7; font-weight: 600;">
                    {{ url('/' . ltrim($community->slug, '/')) }}
                </span>
            </div>
            <div style="display: flex; align-items: center; gap: 8px;">
                <span style="font-size: 12px; color: #64748b; font-weight: 500;">Status:</span>
                @php
                    $curStatus = $community->status ?? 'publish';
                    $statusMap = [
                        'publish'  => ['bg' => '#f0fdf4', 'border' => '#bbf7d0', 'color' => '#15803d', 'dot' => '#22c55e', 'label' => 'Publish'],
                        'draft'    => ['bg' => '#fffbeb', 'border' => '#fde68a', 'color' => '#b45309', 'dot' => '#f59e0b', 'label' => 'Draft'],
                        'sold_out' => ['bg' => '#fef2f2', 'border' => '#fecaca', 'color' => '#b91c1c', 'dot' => '#ef4444', 'label' => 'Sold out'],
                    ];
                    $st = $statusMap[$curStatus] ?? $statusMap['publish'];
                @endphp
                <div class="adm-status-dropdown-wrap" style="position: relative; display: inline-block;">
                    <input type="hidden" name="status" id="edit_city_status" value="{{ $curStatus }}">
                    <button type="button" id="edit_city_status_btn" class="adm-status-btn" onclick="toggleStatusDropdown('edit_city_status_menu')" style="display: inline-flex; align-items: center; gap: 8px; padding: 6px 14px; font-size: 12.5px; font-weight: 700; border-radius: 8px; cursor: pointer; border: 1px solid {{ $st['border'] }}; background: {{ $st['bg'] }}; color: {{ $st['color'] }}; transition: all 0.15s ease;">
                        <span class="status-dot" style="width: 7px; height: 7px; border-radius: 50%; background: {{ $st['dot'] }};"></span>
                        <span id="edit_city_status_label">{{ $st['label'] }}</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 2px;"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div id="edit_city_status_menu" class="adm-status-menu" style="display: none; position: absolute; right: 0; top: calc(100% + 6px); background: #ffffff; border: 1px solid #e2e8f0; border-radius: 10px; box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.05); min-width: 140px; padding: 6px; z-index: 9999;">
                        <button type="button" onclick="selectFormStatus('publish', 'Publish', '#f0fdf4', '#bbf7d0', '#15803d', '#22c55e', 'edit_city_status', 'edit_city_status_btn', 'edit_city_status_label', 'edit_city_status_menu')" class="adm-status-opt" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 7px 10px; font-size: 13px; font-weight: 600; border: none; background: none; border-radius: 6px; cursor: pointer; color: #15803d; text-align: left;">
                            <span style="width: 7px; height: 7px; border-radius: 50%; background: #22c55e;"></span> Publish
                        </button>
                        <button type="button" onclick="selectFormStatus('draft', 'Draft', '#fffbeb', '#fde68a', '#b45309', '#f59e0b', 'edit_city_status', 'edit_city_status_btn', 'edit_city_status_label', 'edit_city_status_menu')" class="adm-status-opt" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 7px 10px; font-size: 13px; font-weight: 600; border: none; background: none; border-radius: 6px; cursor: pointer; color: #b45309; text-align: left;">
                            <span style="width: 7px; height: 7px; border-radius: 50%; background: #f59e0b;"></span> Draft
                        </button>
                        <button type="button" onclick="selectFormStatus('sold_out', 'Sold out', '#fef2f2', '#fecaca', '#b91c1c', '#ef4444', 'edit_city_status', 'edit_city_status_btn', 'edit_city_status_label', 'edit_city_status_menu')" class="adm-status-opt" style="display: flex; align-items: center; gap: 8px; width: 100%; padding: 7px 10px; font-size: 13px; font-weight: 600; border: none; background: none; border-radius: 6px; cursor: pointer; color: #b91c1c; text-align: left;">
                            <span style="width: 7px; height: 7px; border-radius: 50%; background: #ef4444;"></span> Sold out
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="adm-edit-layout">
            <!-- Left Tabs -->
            <div class="adm-tabs">
                <button type="button" class="adm-tab is-active" onclick="switchEditTab('general')" data-tab="general">
                    @include('admin.partials.icon', ['name' => 'grid'])
                    <span>General Settings</span>
                </button>
                <button type="button" class="adm-tab" onclick="switchEditTab('hero')" data-tab="hero">
                    @include('admin.partials.icon', ['name' => 'spark'])
                    <span>Hero</span>
                </button>
                <button type="button" class="adm-tab" onclick="switchEditTab('content')" data-tab="content">
                    @include('admin.partials.icon', ['name' => 'edit'])
                    <span>Content</span>
                </button>
                <button type="button" class="adm-tab" onclick="switchEditTab('projects')" data-tab="projects">
                    @include('admin.partials.icon', ['name' => 'building'])
                    <span>Project Card</span>
                </button>
                <button type="button" class="adm-tab" onclick="switchEditTab('about')" data-tab="about">
                    @include('admin.partials.icon', ['name' => 'book'])
                    <span>About Community</span>
                </button>
                <button type="button" class="adm-tab" onclick="switchEditTab('faq')" data-tab="faq">
                    @include('admin.partials.icon', ['name' => 'list'])
                    <span>FAQ</span>
                </button>
                <button type="button" class="adm-tab" onclick="switchEditTab('contact')" data-tab="contact">
                    @include('admin.partials.icon', ['name' => 'mail'])
                    <span>Contact Section</span>
                </button>
                <button type="button" class="adm-tab" onclick="switchEditTab('seo')" data-tab="seo">
                    @include('admin.partials.icon', ['name' => 'search'])
                    <span>SEO &amp; Meta</span>
                </button>
            </div>

            <!-- Right Form Area -->
            <div class="adm-edit-form-area">
                <!-- 1. GENERAL -->
                <div id="edit_tab_general" class="tab-pane active">
                    <div class="adm-card-head">
                        <div>
                            <h2>General Settings</h2>
                            <p>Neighbourhood/Community Name, City, URL slug, and navigation settings.</p>
                        </div>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 6px;">
                        <div class="adm-field">
                            <label class="adm-label">Neighbourhood/Community Name <span style="color: #ef4444;">*</span></label>
                            <input type="text" name="name" value="{{ $community->name }}" required class="adm-input">
                        </div>
                        <div class="adm-field">
                            <label class="adm-label">Route / Slug <span style="color: #ef4444;">*</span></label>
                            <input type="text" name="slug" value="{{ $community->slug }}" required class="adm-input">
                        </div>
                    </div>

                    <div class="adm-field" style="margin-top: 14px; max-width: 50%;">
                        <label class="adm-label">Cities <span style="font-weight: 400; color: #64748b; font-size: 12px;">(Select City)</span></label>
                        <select name="city_id" class="adm-input" style="background: #ffffff; cursor: pointer;">
                            <option value="">-- Select City --</option>
                            @foreach($cities as $c)
                                <option value="{{ $c->id }}" {{ (old('city_id', $community->city_id) == $c->id) ? 'selected' : '' }}>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="adm-help">Jo cities add ki hain wo is dropdown me ayengi. Select karein kis city me ye community aati hai.</div>
                    </div>
                    <div class="adm-field">
                        <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 13.5px; font-weight: 600;">
                            <input type="checkbox" name="in_navbar" value="1" {{ ($page && $page->in_navbar) ? 'checked' : '' }}>
                            <span>Show in Top Navigation Menu</span>
                        </label>
                    </div>
                </div>

                <!-- 2. HERO -->
                <div id="edit_tab_hero" class="tab-pane">
                    <div class="adm-card-head">
                        <div>
                            <h2>Hero Banner</h2>
                            <p>Main heading, subtitle, and hero backdrop.</p>
                        </div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Hero Main Heading (H1)</label>
                        <input type="text" name="sections[hero][title]" value="{{ $heroContent['title'] ?? $community->name }}" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Hero Subtitle</label>
                        <textarea name="sections[hero][subtitle]" rows="2" class="adm-textarea">{{ $heroContent['subtitle'] ?? '' }}</textarea>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Badge Text</label>
                        <input type="text" name="sections[hero][badge]" value="{{ $heroContent['badge'] ?? '' }}" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Hero Background Image</label>
                        <input type="file" name="hero_image_file" accept="image/*" class="adm-input">
                        <input type="text" name="sections[hero][bg_image]" value="{{ $heroContent['bg_image'] ?? '' }}" placeholder="or image path" class="adm-input" style="margin-top: 6px;">
                    </div>
                </div>

                <!-- 3. CONTENT TAB (WYSIWYG) -->
                <div id="edit_tab_content" class="tab-pane">
                    <div class="adm-card-head">
                        <div>
                            <h2>Content Editor</h2>
                            <p>Single visual WYSIWYG editor containing complete page article, H1/H2/H3 headings, paragraphs, and embedded photos.</p>
                        </div>
                        <span class="adm-chip" style="background: #f1f5f9; color: #475569; font-size: 11px; font-weight: 700; padding: 4px 8px; border-radius: 6px; text-transform: uppercase;">content section</span>
                    </div>

                    <div class="adm-field">
                        <label class="adm-label">Page Article &amp; Community Body (Headings, Paragraphs, Images)</label>
                        <textarea name="sections[content][html]" id="edit_content_wysiwyg" class="adm-textarea adm-summernote" data-height="500" rows="22">{{ $tocContent['html'] ?? ($tocContent['body'] ?? '') }}</textarea>
                    </div>
                </div>

                <!-- 4. PROJECTS -->
                <div id="edit_tab_projects" class="tab-pane">
                    <div class="adm-card-head">
                        <div>
                            <h2>Project Card (Featured Properties)</h2>
                            <p>Select which properties are featured on this city page.</p>
                        </div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Section Heading</label>
                        <input type="text" name="sections[communities][heading]" value="{{ $commContent['heading'] ?? '' }}" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Section Subtitle</label>
                        <input type="text" name="sections[communities][subtitle]" value="{{ $commContent['subtitle'] ?? '' }}" class="adm-input">
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
                            
                            <!-- BOX 1: Available Property Cards -->
                            <div style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 16px; display: flex; flex-direction: column;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                                    <div>
                                        <strong style="font-size: 13.5px; color: #1e293b; display: flex; align-items: center; gap: 6px;">
                                            📁 Available Property Cards ( <span id="availableCount">0</span> )
                                        </strong>
                                        <span style="font-size: 11.5px; color: #64748b;">All created property cards in your system</span>
                                    </div>
                                </div>

                                <div id="box1_availableCards" ondragover="allowDropCard(event)" ondrop="dropCardToAvailable(event)" style="display: flex; flex-direction: column; gap: 8px; min-height: 380px; max-height: 540px; overflow-y: auto; padding: 4px;">
                                    @foreach($allProjects as $proj)
                                        @if(!in_array($proj->id, $selectedProjectIds, true))
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
                                        @endif
                                    @endforeach
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
                                    <div id="selectedCardsEmptyState" style="text-align: center; padding: 80px 20px; border: 2px dashed #e2e8f0; border-radius: 8px; color: #94a3b8; display: none;">
                                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.8" style="margin: 0 auto 10px; display: block;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><line x1="3" y1="9" x2="21" y2="9"/><line x1="9" y1="21" x2="9" y2="9"/></svg>
                                        <strong style="display: block; font-size: 14px; color: #475569; margin-bottom: 4px;">Drag Cards Here</strong>
                                        <span style="font-size: 12px; color: #94a3b8;">Left box se mouse se pakar kar yahan chhor dein (drop karein)</span>
                                    </div>

                                    @foreach($allProjects as $proj)
                                        @if(in_array($proj->id, $selectedProjectIds, true))
                                            <div class="dual-project-card" id="proj_card_{{ $proj->id }}" data-id="{{ $proj->id }}" draggable="true" ondragstart="dragCardStart(event)" ondragend="dragCardEnd(event)" style="display: flex; align-items: center; gap: 10px; background: #f0fdf4; border: 1px solid #86efac; border-radius: 8px; padding: 9px 12px; cursor: grab; box-shadow: 0 1px 2px rgba(0,0,0,0.03); transition: all 0.15s ease;">
                                                <span style="color: #94a3b8; font-size: 14px; cursor: grab; user-select: none;">⠿</span>
                                                <img src="{{ $proj->image_url }}" alt="" style="width: 48px; height: 34px; object-fit: cover; border-radius: 5px; border: 1px solid #cbd5e1; flex-shrink: 0; background: #f1f5f9;">
                                                <div style="flex: 1; min-width: 0;">
                                                    <strong class="dual-card-title" style="display: block; font-size: 13px; color: #1e293b; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $proj->title }}</strong>
                                                    <span style="font-size: 11px; color: #64748b;">{{ $proj->price ?: ($proj->location ?: 'Hudayriyat Island') }}</span>
                                                </div>
                                                <button type="button" onclick="moveCardToAvailable({{ $proj->id }})" title="Remove from page" style="background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; border-radius: 6px; padding: 5px 11px; font-size: 12px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 4px; flex-shrink: 0;">
                                                    ✕ Remove
                                                </button>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>

                                <!-- Hidden container for form inputs -->
                                <div id="selectedCardsInputsContainer"></div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- 5. ABOUT -->
                <div id="edit_tab_about" class="tab-pane">
                    <div class="adm-card-head">
                        <div>
                            <h2>About Community</h2>
                            <p>City narrative and video showcase.</p>
                        </div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Headline</label>
                        <input type="text" name="sections[about][heading]" value="{{ $aboutContent['heading'] ?? '' }}" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Description / Narrative</label>
                        <textarea name="sections[about][description]" rows="5" class="adm-textarea">{{ $aboutContent['description'] ?? '' }}</textarea>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Video Stream URL</label>
                        <input type="text" name="sections[about][video_url]" value="{{ $aboutContent['video_url'] ?? '' }}" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Video Poster / Cover Image</label>
                        <div class="adm-img-box" style="display: flex; gap: 14px; align-items: center; background: #faf8f5; border: 1px solid #e2e8f0; border-radius: 8px; padding: 10px;">
                            <img id="preview_edit_about_poster" src="{{ $aboutContent['poster_image'] ?? ($aboutContent['video_poster'] ?? '/images/projects/poster.jpg') }}" style="width: 100px; height: 62px; object-fit: cover; border-radius: 6px; border: 1px solid #cbd5e1; background: #ffffff;" alt="Poster">
                            <div style="flex: 1;">
                                <div style="margin-bottom: 8px;">
                                    <input type="file" name="about_poster_file" accept="image/*" class="adm-input" style="padding: 6px 10px;" onchange="if(this.files && this.files[0]){const r=new FileReader();r.onload=e=>document.getElementById('preview_edit_about_poster').src=e.target.result;r.readAsDataURL(this.files[0]);}">
                                </div>
                                <input type="text" id="edit_about_poster" name="sections[about][poster_image]" value="{{ $aboutContent['poster_image'] ?? ($aboutContent['video_poster'] ?? '/images/projects/poster.jpg') }}" class="adm-input" oninput="document.getElementById('preview_edit_about_poster').src = this.value">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 6. FAQ -->
                <div id="edit_tab_faq" class="tab-pane">
                    <div class="adm-card-head">
                        <div>
                            <h2>Frequently Asked Questions</h2>
                            <p>Manage questions and answers.</p>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 18px;">
                        <div class="adm-field" style="margin-bottom: 0;">
                            <label class="adm-label">FAQ Section Title</label>
                            <input type="text" name="sections[faq][title]" value="{{ $faqContent['title'] ?? 'Frequently Asked Questions' }}" class="adm-input">
                        </div>

                        <div class="adm-field" style="margin-bottom: 0;">
                            <label class="adm-label">FAQ Subtitle</label>
                            <input type="text" name="sections[faq][subtitle]" value="{{ $faqContent['subtitle'] ?? 'Find answers to common questions about properties, buying process, and payment plans.' }}" class="adm-input">
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

                    <div id="editFaqItemsContainer" style="display: flex; flex-direction: column; gap: 8px; margin-bottom: 12px;">
                        @foreach($faqItems as $idx => $item)
                            <div class="faq-repeater-row" style="display: grid; grid-template-columns: 34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap: 10px; align-items: center; background: #faf8f5; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px;">
                                <div class="faq-drag-handle" draggable="true" style="display: flex; align-items: center; justify-content: center; width: 34px; height: 36px; border: 1px solid #d1d5db; background: #ffffff; border-radius: 6px; color: #1a4731; cursor: grab; user-select: none;" title="Drag ⇅ to reorder">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                                </div>
                                <input type="text" name="faq_q[]" value="{{ $item['q'] ?? '' }}" class="adm-input" placeholder="Question" style="margin: 0; min-height: 36px; font-size: 13px;">
                                <textarea name="faq_a[]" class="adm-textarea" rows="1" placeholder="Answer" style="margin: 0; min-height: 36px; font-size: 13px; resize: vertical; line-height: 1.4;">{{ $item['a'] ?? '' }}</textarea>
                                <button type="button" onclick="this.closest('.faq-repeater-row').remove()" title="Delete row" style="width: 34px; height: 36px; border: 1px solid #fecaca; background: #fef2f2; color: #b91c1c; border-radius: 6px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center; transition: all 0.15s ease;">&#10005;</button>
                            </div>
                        @endforeach
                    </div>

                    <!-- Add Row Button matching Image 2 -->
                    <button type="button" onclick="addEditFaqRow()" style="padding: 6px 14px; font-size: 12.5px; font-weight: 600; cursor: pointer; border: 1.5px dashed #1a4731; color: #1a4731; background: #faf8f5; border-radius: 8px; display: inline-flex; align-items: center; gap: 6px; transition: all 0.15s ease;">
                        + Add Row
                    </button>
                </div>

                <!-- 7. CONTACT -->
                <div id="edit_tab_contact" class="tab-pane">
                    <div class="adm-card-head">
                        <div>
                            <h2>Contact Section</h2>
                            <p>Call to action information.</p>
                        </div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Heading</label>
                        <input type="text" name="sections[contact][heading]" value="{{ $contactContent['heading'] ?? '' }}" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Subtitle</label>
                        <textarea name="sections[contact][subtitle]" rows="2" class="adm-textarea">{{ $contactContent['subtitle'] ?? '' }}</textarea>
                    </div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 14px;">
                        <div class="adm-field">
                            <label class="adm-label">Phone / WhatsApp</label>
                            <input type="text" name="sections[contact][phone]" value="{{ $contactContent['phone'] ?? '' }}" class="adm-input">
                        </div>
                        <div class="adm-field">
                            <label class="adm-label">Email</label>
                            <input type="email" name="sections[contact][email]" value="{{ $contactContent['email'] ?? '' }}" class="adm-input">
                        </div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Button Text</label>
                        <input type="text" name="sections[contact][btn_text]" value="{{ $contactContent['btn_text'] ?? '' }}" class="adm-input">
                    </div>
                </div>

                <!-- 8. SEO -->
                <div id="edit_tab_seo" class="tab-pane">
                    <div class="adm-card-head">
                        <div>
                            <h2>SEO &amp; Meta Settings</h2>
                            <p>Search engine optimization tags.</p>
                        </div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Meta Title</label>
                        <input type="text" name="meta_title" value="{{ $page->meta_title ?? '' }}" class="adm-input">
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="adm-textarea">{{ $page->meta_description ?? '' }}</textarea>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label">Meta Keywords</label>
                        <input type="text" name="meta_keywords" value="{{ $page->meta_keywords ?? '' }}" class="adm-input">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Bottom Save Bar -->
        <div style="position: sticky; bottom: 0; background: #ffffff; border-top: 1px solid #e2e8f0; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; border-radius: 0 0 16px 16px; margin-top: -10px; z-index: 10;">
            <div style="font-size: 13.5px; color: #64748b;">
                Editing Neighbourhood/Community: <strong style="color: #0f172a;">{{ $community->name }}</strong>
            </div>
            <div style="display: flex; gap: 10px;">
                <a href="{{ route('admin.communities.index') }}" class="adm-btn" style="background: #f1f5f9; color: #475569; border: 1px solid #cbd5e1; padding: 8px 18px; border-radius: 8px; text-decoration: none;">Cancel</a>
                <button type="submit" class="adm-btn adm-btn-primary" style="padding: 8px 24px; border-radius: 8px;">Save Changes</button>
            </div>
        </div>
    </form>
</div>

<script>
    function switchEditTab(tabId) {
        document.querySelectorAll('.adm-tabs .adm-tab').forEach(btn => {
            btn.classList.toggle('is-active', btn.getAttribute('data-tab') === tabId);
        });
        document.querySelectorAll('.tab-pane').forEach(pane => {
            pane.classList.remove('active');
        });
        const target = document.getElementById('edit_tab_' + tabId);
        if (target) {
            target.classList.add('active');
            if (tabId === 'content' && window.initSummernote) {
                window.initSummernote();
            }
        }
    }

    function addEditFaqRow() {
        const container = document.getElementById('editFaqItemsContainer');
        const div = document.createElement('div');
        div.className = 'faq-repeater-row';
        div.style.cssText = 'display: grid; grid-template-columns: 34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap: 10px; align-items: center; background: #faf8f5; border: 1px solid #e5e7eb; border-radius: 8px; padding: 6px 10px;';
        div.innerHTML = `
            <div style="display: flex; align-items: center; justify-content: center; width: 34px; height: 36px; border: 1px solid #d1d5db; background: #ffffff; border-radius: 6px; color: #1a4731; cursor: grab;" title="Drag to reorder">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
            </div>
            <input type="text" name="faq_q[]" class="adm-input" placeholder="Question" style="margin: 0; min-height: 36px; font-size: 13px;">
            <textarea name="faq_a[]" class="adm-textarea" rows="1" placeholder="Answer" style="margin: 0; min-height: 36px; font-size: 13px; resize: vertical; line-height: 1.4;"></textarea>
            <button type="button" onclick="this.closest('.faq-repeater-row').remove()" title="Delete row" style="width: 34px; height: 36px; border: 1px solid #fecaca; background: #fef2f2; color: #b91c1c; border-radius: 6px; cursor: pointer; font-size: 14px; line-height: 1; display: flex; align-items: center; justify-content: center; transition: all 0.15s ease;">&#10005;</button>
        `;
        container.appendChild(div);
        const input = div.querySelector('input');
        if (input) input.focus();
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

    function addEditFaqRow() {
        const container = document.getElementById('editFaqItemsContainer');
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

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.adm-status-dropdown-wrap') && !e.target.closest('.adm-status-menu')) {
            document.querySelectorAll('.adm-status-menu').forEach(m => m.style.display = 'none');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        updateDualBoxState();
        document.querySelectorAll('#editFaqItemsContainer .faq-repeater-row').forEach(bindFaqDragEvents);
    });
</script>
@endsection
