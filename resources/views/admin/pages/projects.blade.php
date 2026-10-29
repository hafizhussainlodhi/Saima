@extends('admin.layouts.app')

@section('title', 'Manage > Projects')

@push('styles')
<style>
    .adm-topbar { display: none !important; }
    .cms-page-row:hover { background-color: #fafbfd !important; }
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
    #cmsSearchInput::placeholder {
        color: #94a3b8;
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
        left: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 26px;
        height: 26px;
        border-radius: 6px;
        background: #eaf1ed;
        color: #234937;
        pointer-events: none;
        z-index: 2;
        transition: color .2s, background .2s;
    }
    .adm-metric-prefix-icon svg {
        width: 15px;
        height: 15px;
    }
    .adm-metric-input {
        padding-left: 38px !important;
        padding-right: 32px !important;
        width: 100% !important;
    }
    .adm-metric-dropdown-btn {
        position: absolute;
        right: 6px;
        top: 50%;
        transform: translateY(-50%);
        width: 24px;
        height: 24px;
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
        max-height: 220px;
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
        padding: 7px 10px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 13px;
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
        width: 26px;
        height: 26px;
        border-radius: 6px;
        background: #f1f5f9;
        color: #234937;
        flex-shrink: 0;
    }
    .adm-metric-menu-item:hover .adm-metric-menu-item-icon {
        background: #eaf1ed;
        color: #1b3d2d;
    }
</style>
@endpush

@section('content')
<!-- 1. PROJECTS LIST VIEW -->
<div id="projectsListView">
    <!-- Image 1 Pattern: Breadcrumbs & Page Heading -->
    <div class="cms-page-header" style="margin-bottom: 22px;">
        <h1 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; font-family: var(--font-display, 'Outfit', sans-serif); letter-spacing: -0.01em;">Manage &gt; Projects</h1>
        <div style="font-size: 13px; color: #8c9ba5; font-weight: 400;">Home &ndash; Manage &ndash; Projects</div>
    </div>

<!-- Image 1 Pattern: Clean White Card Container -->
<div class="adm-card" style="background:#ffffff; border-radius:16px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.03); padding:28px 32px 36px; margin-bottom:30px;">
    
    <!-- Top Bar: Search Input (Image 1) & Actions -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:26px; gap:16px; flex-wrap:wrap;">
        <div style="position:relative; width:100%; max-width:280px;">
            <svg style="position:absolute; left:14px; top:50%; transform:translateY(-50%); width:16px; height:16px; color:#94a3b8; pointer-events:none;" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input type="text" id="cmsSearchInput" placeholder="Search..." style="width:100%; background:#f8fafc; border:1px solid #f1f5f9; border-radius:10px; padding:10px 14px 10px 40px; font-size:13.5px; color:#1e293b; outline:none; transition:all 0.2s;" onfocus="this.style.borderColor='#cbd5e1'; this.style.background='#ffffff';" onblur="this.style.borderColor='#f1f5f9'; this.style.background='#f8fafc';">
        </div>

        <div style="display:flex; gap:10px; align-items:center;">
            <div style="display:flex; background:#f8fafc; padding:3px; border-radius:8px; border:1px solid #f1f5f9; gap:2px;">
                <a href="{{ route('admin.pages.index') }}" style="padding:6px 14px; font-size:12.5px; font-weight:600; border-radius:6px; text-decoration:none; color:#64748b;">Pages</a>
                <a href="{{ route('admin.projects.index') }}" style="padding:6px 14px; font-size:12.5px; font-weight:600; border-radius:6px; text-decoration:none; background:#ffffff; color:#1e293b; box-shadow:0 1px 2px rgba(0,0,0,0.05);">Projects</a>
            </div>
            <button type="button" class="adm-btn adm-btn-primary" onclick="openCreatePageModal()" style="display:inline-flex; align-items:center; gap:6px; font-size:13px; padding:8px 16px; border-radius:8px;">
                @include('admin.partials.icon', ['name' => 'plus']) Create New Project
            </button>
        </div>
    </div>

    <!-- Image 1 Pattern: Table with #, NAME, ACTIONS -->
    <div style="width:100%; overflow-x:auto;">
        <table style="width:100%; border-collapse:collapse; text-align:left;">
            <thead>
                <tr style="border-bottom:1px solid #f8fafc;">
                    <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; width:80px; user-select:none;">
                        # <span style="font-size:10px; display:inline-block; vertical-align:middle; margin-left:1px;">▲</span>
                    </th>
                    <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em;">
                        NAME
                    </th>
                    <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; text-align:right; width:140px;">
                        ACTIONS
                    </th>
                </tr>
            </thead>
            <tbody id="cmsTableBody">
                @forelse($pages as $page)
                    <tr class="cms-page-row" data-name="{{ strtolower($page->title) }}" style="border-bottom:1px dotted #e2e8f0; transition:background 0.15s ease;">
                        <td class="cms-row-num" style="padding:18px 12px; font-size:14px; color:#64748b; font-weight:500;">
                            {{ $loop->iteration }}
                        </td>
                        <td style="padding:18px 12px; font-size:14.5px; color:#334155; font-weight:500;">
                            {{ $page->title }}
                        </td>
                        <td style="padding:18px 12px; text-align:right;">
                            <div style="display:inline-flex; align-items:center; justify-content:flex-end; gap:8px;">
                                <!-- Edit Icon (Pencil) -->
                                <a href="{{ route('admin.pages.edit', $page) }}" class="cms-action-btn" title="Edit {{ $page->title }}">
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                    </svg>
                                </a>
                                <!-- View Live Icon (Eye) -->
                                <a href="{{ url($page->slug === '/' ? '' : $page->slug) }}" target="_blank" rel="noopener" class="cms-action-btn" title="View {{ $page->title }}">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </a>
                                <!-- Delete Icon (Trash) -->
                                @if($page->slug !== '/' && $page->slug !== 'home')
                                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($page->title) }}\'?');" style="display:inline; margin:0; padding:0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="cms-action-btn cms-action-delete" title="Delete {{ $page->title }}" style="background:none; border:none; cursor:pointer; padding:0;">
                                            <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="text-align:center; padding:36px; color:#94a3b8; font-size:14px;">
                            No projects found.
                        </td>
                    </tr>
                @endforelse
                <tr id="cmsNoMatchesRow" style="display:none;">
                    <td colspan="3" style="text-align:center; padding:36px; color:#94a3b8; font-size:14px;">
                        No matching projects found for your search.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div><!-- /#projectsListView -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('cmsSearchInput');
        if (!searchInput) return;

        searchInput.addEventListener('input', function () {
            const query = this.value.toLowerCase().trim();
            const rows = document.querySelectorAll('.cms-page-row');
            let visibleCount = 0;
            let counter = 1;

            rows.forEach(function (row) {
                const name = (row.getAttribute('data-name') || '').toLowerCase();
                if (!query || name.includes(query)) {
                    row.style.display = '';
                    const numCell = row.querySelector('.cms-row-num');
                    if (numCell) numCell.textContent = counter++;
                    visibleCount++;
                } else {
                    row.style.display = 'none';
                }
            });

            const emptyRow = document.getElementById('cmsNoMatchesRow');
            if (emptyRow) {
                emptyRow.style.display = (visibleCount === 0) ? '' : 'none';
            }
        });
    });
</script>

<!-- ========================================================================= -->
<!-- 2. INLINE ADD PROJECT VIEW (NO POPUP - FLOWS DIRECTLY ON THE PAGE)       -->
<!-- ========================================================================= -->
<div id="createProjectSection" style="display:none;">
    <!-- Breadcrumbs & Heading -->
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px; flex-wrap:wrap; gap:14px;">
        <div>
            <h1 style="font-size:20px; font-weight:700; color:#1e293b; margin:0 0 4px 0; font-family:var(--font-display, 'Outfit', sans-serif); letter-spacing:-0.01em;">
                Manage &gt; Add New Project
            </h1>
            <div style="font-size:13px; color:#8c9ba5; font-weight:400;">
                Home &ndash; Manage &ndash; Add New Project
            </div>
        </div>
        <button type="button" onclick="closeCreatePageModal()" class="adm-btn" style="background:#ffffff; border:1px solid #e2e8f0; color:#475569; font-size:13px; font-weight:600; padding:8px 16px; border-radius:8px; display:inline-flex; align-items:center; gap:6px; cursor:pointer; text-decoration:none;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
            Back to Project List
        </button>
    </div>

    <!-- White Card Container for Add Project Form -->
    <div class="adm-card" style="background:#ffffff; width:100%; border-radius:16px; box-shadow:0 1px 3px rgba(0,0,0,0.03); overflow:hidden; border:1px solid #f1f5f9; margin-bottom:30px;">
        
        <!-- Header inside card -->
        <div style="padding:20px 24px; background:#faf8f5; border-bottom:1px solid #ede8e1; display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h2 style="margin:0; font-size:18px; font-weight:700; color:#111827; display:flex; align-items:center; gap:8px;">
                    @include('admin.partials.icon', ['name' => 'file'])
                    Add Project
                </h2>
                <p style="margin:4px 0 0 0; font-size:13px; color:#6b7280;">Enter project details, select modular sections, and customize content in Summernote.</p>
            </div>
            <button type="button" onclick="closeCreatePageModal()" class="adm-btn adm-btn-ghost" style="padding:6px 14px; font-size:12.5px; border-radius:6px; cursor:pointer;">Cancel</button>
        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('admin.pages.store') }}" id="createPageForm" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="page_type" value="project">
            <input type="hidden" name="has_hero" id="hasHeroInput" value="0">

            <div style="padding:28px 24px;">
                
                <!-- General Info -->
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:18px;">
                    <div>
                        <label class="adm-label" for="newPageTitle" style="font-weight:700;">Page Name <span style="color:#ef4444;">*</span></label>
                        <input type="text" id="newPageTitle" name="title" required placeholder="e.g. Sunset Residences" class="adm-input" style="font-size:15px; font-weight:600;">
                    </div>
                    <div>
                        <label class="adm-label" for="newPageSlug" style="font-weight:700;">Route / Slug <span style="color:#ef4444;">*</span></label>
                        <div style="display:flex; align-items:center; background:#f3f4f6; border:1px solid #d1d5db; border-radius:6px; overflow:hidden;">
                            <span style="padding:0 12px; color:#6b7280; font-family:monospace; font-size:14px; user-select:none;">/</span>
                            <input type="text" id="newPageSlug" name="slug" required placeholder="sunset-residences" class="adm-input" style="border:none; background:transparent; font-family:monospace; font-size:14px;">
                        </div>
                    </div>
                </div>

                <!-- Toggles -->
                <div style="display:flex; gap:24px; align-items:center; padding:12px 16px; background:#f9fafb; border-radius:8px; margin-bottom:22px; border:1px solid #f3f4f6;">
                    <label class="adm-check" style="cursor:pointer; font-weight:600; display:flex; align-items:center; gap:8px;">
                        <input type="checkbox" name="in_navbar" value="1">
                        <span>Show in Navigation Header</span>
                    </label>
                    <label class="adm-check" style="cursor:pointer; font-weight:600; display:flex; align-items:center; gap:8px;">
                        <input type="checkbox" name="is_published" value="1" checked>
                        <span>Publish Immediately</span>
                    </label>
                </div>

                <!-- TWO-TAB BUILDER: SELECT SECTIONS & REORDER/EDIT -->
                <div style="margin-bottom:18px;">
                    <!-- Unified Section Builder: Upper Area = Selected Sections, Lower Area = Available Sections -->

                    <!-- Hidden Inputs for Submission -->
                    <input type="hidden" name="has_hero" id="hasHeroInput" value="0">
                    <input type="hidden" name="has_highlights" id="hasHighlightsInput" value="0">
                    <input type="hidden" name="has_about" id="hasAboutInput" value="0">
                    <input type="hidden" name="has_content" id="hasContentInput" value="0">
                    <input type="hidden" name="has_communities" id="hasCommunitiesInput" value="0">
                    <input type="hidden" name="has_faq" id="hasFaqInput" value="0">
                    <input type="hidden" name="section_order" id="sectionOrderInput" value="[]">

                    
                    <!-- ========================================================================= -->
                    <!-- 1. UPPER AREA: SELECTED SECTIONS (PAGE LAYOUT)                            -->
                    <!-- ========================================================================= -->
                    <!-- ============================================== -->
                    <!-- TAB 2: LAYOUT & REORDER / EDIT CONTENT         -->
                    <!-- ============================================== -->
                    <div id="modalTabLayout" style="display:block; margin-bottom:32px;">
                        
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; padding-bottom:8px; border-bottom:1px solid #e5e7eb;">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <h3 style="margin:0; font-size:14px; font-weight:700; color:#111827; text-transform:uppercase; letter-spacing:0.04em;">
                                    Selected Page Sections
                                </h3>
                                <span id="tabLayoutCountBadge" style="background:#1a4731; color:#ffffff; font-size:11px; font-weight:700; padding:2px 8px; border-radius:12px;">0 Added</span>
                            </div>
                            <span style="font-size:12px; color:#6b7280;">(Drag ☰ or click ▲ ▼ to reorder &bull; ✎ Edit Content to customize)</span>
                        </div>

                        <!-- Empty State Notice -->
                        <div id="layoutEmptyNotice" style="display:block; text-align:center; padding:24px 20px; border:2px dashed #cbd5e1; border-radius:10px; background:#f8fafc;">
                            <div style="font-size:14px; font-weight:700; color:#374151; margin-bottom:4px;">No Sections Selected Yet</div>
                            <div style="font-size:12.5px; color:#64748b;">Click on any section card below to add it directly to this layout.</div>
                        </div>

                        
                        <!-- Draggable Big Box Cards List -->
                        <div id="selectedSectionsList" style="display:none; flex-wrap:wrap; gap:14px; align-items:flex-start; margin-bottom:16px;">

                            <!-- 1. BIG BOX: Hero Section -->
                            <div id="dragItemHero" draggable="true" ondragstart="handleDragStart(event, 'hero')" ondragover="handleDragOver(event)" ondrop="handleDrop(event, 'hero')" ondragend="handleDragEnd(event)"
                                 style="display:none; width:220px; border:2px solid #1a4731; border-radius:12px; background:#ffffff; padding:12px; box-shadow:0 3px 10px rgba(0,0,0,0.06); position:relative; cursor:grab; user-select:none; transition:transform 0.15s ease, box-shadow 0.15s ease;">
                                
                                <!-- Order Badge (Top-Left) -->
                                <span id="heroOrderBadge" style="position:absolute; top:8px; left:8px; z-index:5; background:#1a4731; color:#ffffff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">#1</span>
                                
                                <!-- Small Delete Cross Button (Top-Right) -->
                                <button type="button" onclick="event.stopPropagation(); removeSection('hero')" title="Remove Hero Section"
                                        style="position:absolute; top:8px; right:8px; z-index:5; width:24px; height:24px; border-radius:50%; background:#fee2e2; border:1px solid #fca5a5; color:#b91c1c; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; cursor:pointer; padding:0; line-height:1; transition:all 0.15s ease;">
                                    ✕
                                </button>

                                <!-- Thumbnail Image with Tag Overlay -->
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:8px;">
                                    <img src="{{ asset('hero.png') }}" alt="Hero Section Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">TOP BANNER</span>
                                    </div>
                                </div>

                                <!-- Title & Drag Indicator -->
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Hero Section</span>
                                    <span style="font-size:11px; color:#94a3b8; font-weight:600; cursor:grab;" title="Drag with mouse to reorder">☰ Grab</span>
                                </div>

                                <!-- Edit Content Button -->
                                <button type="button" onclick="toggleHeroEditorDrawer()" id="heroDrawerBtn" class="adm-btn adm-btn-sm"
                                        style="width:100%; padding:6px 10px; font-size:12px; background:#faf8f5; border:1px solid #1a4731; color:#1a4731; font-weight:600; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:4px; cursor:pointer;">
                                    <span>✎ Edit Content</span>
                                </button>
                            </div>

                            <!-- 2. BIG BOX: Project Highlights -->
                            <div id="dragItemHighlights" draggable="true" ondragstart="handleDragStart(event, 'highlights')" ondragover="handleDragOver(event)" ondrop="handleDrop(event, 'highlights')" ondragend="handleDragEnd(event)"
                                 style="display:none; width:220px; border:2px solid #1a4731; border-radius:12px; background:#ffffff; padding:12px; box-shadow:0 3px 10px rgba(0,0,0,0.06); position:relative; cursor:grab; user-select:none; transition:transform 0.15s ease, box-shadow 0.15s ease;">
                                
                                <!-- Order Badge (Top-Left) -->
                                <span id="hlOrderBadge" style="position:absolute; top:8px; left:8px; z-index:5; background:#1a4731; color:#ffffff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">#2</span>
                                
                                <!-- Small Delete Cross Button (Top-Right) -->
                                <button type="button" onclick="event.stopPropagation(); removeSection('highlights')" title="Remove Project Highlights"
                                        style="position:absolute; top:8px; right:8px; z-index:5; width:24px; height:24px; border-radius:50%; background:#fee2e2; border:1px solid #fca5a5; color:#b91c1c; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; cursor:pointer; padding:0; line-height:1; transition:all 0.15s ease;">
                                    ✕
                                </button>

                                <!-- Thumbnail Image with Tag Overlay -->
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:8px;">
                                    <img src="{{ asset('project_hightlights.png') }}" alt="Project Highlights Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">KEY FACTS GRID</span>
                                    </div>
                                </div>

                                <!-- Title & Drag Indicator -->
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Project Highlights</span>
                                    <span style="font-size:11px; color:#94a3b8; font-weight:600; cursor:grab;" title="Drag with mouse to reorder">☰ Grab</span>
                                </div>

                                <!-- Edit Content Button -->
                                <button type="button" onclick="toggleHighlightsEditorDrawer()" id="hlDrawerBtn" class="adm-btn adm-btn-sm"
                                        style="width:100%; padding:6px 10px; font-size:12px; background:#faf8f5; border:1px solid #1a4731; color:#1a4731; font-weight:600; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:4px; cursor:pointer;">
                                    <span>✎ Edit Content</span>
                                </button>
                            </div>

                            <!-- 3. BIG BOX: About Community -->
                            <div id="dragItemAbout" draggable="true" ondragstart="handleDragStart(event, 'about')" ondragover="handleDragOver(event)" ondrop="handleDrop(event, 'about')" ondragend="handleDragEnd(event)"
                                 style="display:none; width:220px; border:2px solid #1a4731; border-radius:12px; background:#ffffff; padding:12px; box-shadow:0 3px 10px rgba(0,0,0,0.06); position:relative; cursor:grab; user-select:none; transition:transform 0.15s ease, box-shadow 0.15s ease;">
                                
                                <!-- Order Badge (Top-Left) -->
                                <span id="aboutOrderBadge" style="position:absolute; top:8px; left:8px; z-index:5; background:#1a4731; color:#ffffff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">#3</span>
                                
                                <!-- Small Delete Cross Button (Top-Right) -->
                                <button type="button" onclick="event.stopPropagation(); removeSection('about')" title="Remove About Community"
                                        style="position:absolute; top:8px; right:8px; z-index:5; width:24px; height:24px; border-radius:50%; background:#fee2e2; border:1px solid #fca5a5; color:#b91c1c; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; cursor:pointer; padding:0; line-height:1; transition:all 0.15s ease;">
                                    ✕
                                </button>

                                <!-- Thumbnail Image with Tag Overlay -->
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:8px;">
                                    <img src="{{ asset('about_community.png') }}" alt="About Community Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">EDITORIAL & VIDEO</span>
                                    </div>
                                </div>

                                <!-- Title & Drag Indicator -->
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">About Community</span>
                                    <span style="font-size:11px; color:#94a3b8; font-weight:600; cursor:grab;" title="Drag with mouse to reorder">☰ Grab</span>
                                </div>

                                <!-- Edit Content Button -->
                                <button type="button" onclick="toggleAboutEditorDrawer()" id="aboutDrawerBtn" class="adm-btn adm-btn-sm"
                                        style="width:100%; padding:6px 10px; font-size:12px; background:#faf8f5; border:1px solid #1a4731; color:#1a4731; font-weight:600; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:4px; cursor:pointer;">
                                    <span>✎ Edit Content</span>
                                </button>
                            </div>

                            <!-- 4. BIG BOX: Article & Booking -->
                            <div id="dragItemContent" draggable="true" ondragstart="handleDragStart(event, 'content')" ondragover="handleDragOver(event)" ondrop="handleDrop(event, 'content')" ondragend="handleDragEnd(event)"
                                 style="display:none; width:220px; border:2px solid #1a4731; border-radius:12px; background:#ffffff; padding:12px; box-shadow:0 3px 10px rgba(0,0,0,0.06); position:relative; cursor:grab; user-select:none; transition:transform 0.15s ease, box-shadow 0.15s ease;">
                                
                                <!-- Order Badge (Top-Left) -->
                                <span id="contentOrderBadge" style="position:absolute; top:8px; left:8px; z-index:5; background:#1a4731; color:#ffffff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">#4</span>
                                
                                <!-- Small Delete Cross Button (Top-Right) -->
                                <button type="button" onclick="event.stopPropagation(); removeSection('content')" title="Remove Article & Booking"
                                        style="position:absolute; top:8px; right:8px; z-index:5; width:24px; height:24px; border-radius:50%; background:#fee2e2; border:1px solid #fca5a5; color:#b91c1c; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; cursor:pointer; padding:0; line-height:1; transition:all 0.15s ease;">
                                    ✕
                                </button>

                                <!-- Thumbnail Image with Tag Overlay -->
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:8px;">
                                    <img src="{{ asset('article_booking.png') }}" alt="Article & Booking Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">ARTICLE & BOOKING</span>
                                    </div>
                                </div>

                                <!-- Title & Drag Indicator -->
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Article & Booking</span>
                                    <span style="font-size:11px; color:#94a3b8; font-weight:600; cursor:grab;" title="Drag with mouse to reorder">☰ Grab</span>
                                </div>

                                <!-- Edit Content Button -->
                                <button type="button" onclick="toggleContentEditorDrawer()" id="contentDrawerBtn" class="adm-btn adm-btn-sm"
                                        style="width:100%; padding:6px 10px; font-size:12px; background:#faf8f5; border:1px solid #1a4731; color:#1a4731; font-weight:600; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:4px; cursor:pointer;">
                                    <span>✎ Edit Content</span>
                                </button>
                            </div>

                            <!-- 5. BIG BOX: Project Cards -->
                            <div id="dragItemCommunities" draggable="true" ondragstart="handleDragStart(event, 'communities')" ondragover="handleDragOver(event)" ondrop="handleDrop(event, 'communities')" ondragend="handleDragEnd(event)"
                                 style="display:none; width:220px; border:2px solid #1a4731; border-radius:12px; background:#ffffff; padding:12px; box-shadow:0 3px 10px rgba(0,0,0,0.06); position:relative; cursor:grab; user-select:none; transition:transform 0.15s ease, box-shadow 0.15s ease;">
                                
                                <!-- Order Badge (Top-Left) -->
                                <span id="communitiesOrderBadge" style="position:absolute; top:8px; left:8px; z-index:5; background:#1a4731; color:#ffffff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">#5</span>
                                
                                <!-- Small Delete Cross Button (Top-Right) -->
                                <button type="button" onclick="event.stopPropagation(); removeSection('communities')" title="Remove Project Cards"
                                        style="position:absolute; top:8px; right:8px; z-index:5; width:24px; height:24px; border-radius:50%; background:#fee2e2; border:1px solid #fca5a5; color:#b91c1c; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; cursor:pointer; padding:0; line-height:1; transition:all 0.15s ease;">
                                    ✕
                                </button>

                                <!-- Thumbnail Image with Tag Overlay -->
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:8px;">
                                    <img src="{{ asset('card.png') }}" alt="Project Cards Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">PROJECT CARDS</span>
                                    </div>
                                </div>

                                <!-- Title & Drag Indicator -->
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Project Cards</span>
                                    <span style="font-size:11px; color:#94a3b8; font-weight:600; cursor:grab;" title="Drag with mouse to reorder">☰ Grab</span>
                                </div>

                                <!-- Edit Content Button -->
                                <button type="button" onclick="toggleCommunitiesEditorDrawer()" id="commDrawerBtn" class="adm-btn adm-btn-sm"
                                        style="width:100%; padding:6px 10px; font-size:12px; background:#faf8f5; border:1px solid #1a4731; color:#1a4731; font-weight:600; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:4px; cursor:pointer;">
                                    <span>✎ Edit Content</span>
                                </button>
                            </div>

                            <!-- 6. BIG BOX: FAQ Section -->
                            <div id="dragItemFaq" draggable="true" ondragstart="handleDragStart(event, 'faq')" ondragover="handleDragOver(event)" ondrop="handleDrop(event, 'faq')" ondragend="handleDragEnd(event)"
                                 style="display:none; width:220px; border:2px solid #1a4731; border-radius:12px; background:#ffffff; padding:12px; box-shadow:0 3px 10px rgba(0,0,0,0.06); position:relative; cursor:grab; user-select:none; transition:transform 0.15s ease, box-shadow 0.15s ease;">
                                
                                <!-- Order Badge (Top-Left) -->
                                <span id="faqOrderBadge" style="position:absolute; top:8px; left:8px; z-index:5; background:#1a4731; color:#ffffff; font-size:11px; font-weight:700; padding:2px 7px; border-radius:6px; box-shadow:0 1px 3px rgba(0,0,0,0.2);">#6</span>
                                
                                <!-- Small Delete Cross Button (Top-Right) -->
                                <button type="button" onclick="event.stopPropagation(); removeSection('faq')" title="Remove FAQ Section"
                                        style="position:absolute; top:8px; right:8px; z-index:5; width:24px; height:24px; border-radius:50%; background:#fee2e2; border:1px solid #fca5a5; color:#b91c1c; font-size:12px; font-weight:700; display:flex; align-items:center; justify-content:center; cursor:pointer; padding:0; line-height:1; transition:all 0.15s ease;">
                                    ✕
                                </button>

                                <!-- Thumbnail Image with Tag Overlay -->
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:8px;">
                                    <img src="{{ asset('FAQ.png') }}" alt="FAQ Section Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">FAQ ACCORDION</span>
                                    </div>
                                </div>

                                <!-- Title & Drag Indicator -->
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">FAQ Section</span>
                                    <span style="font-size:11px; color:#94a3b8; font-weight:600; cursor:grab;" title="Drag with mouse to reorder">☰ Grab</span>
                                </div>

                                <!-- Edit Content Button -->
                                <button type="button" onclick="toggleFaqEditorDrawer()" id="faqDrawerBtn" class="adm-btn adm-btn-sm"
                                        style="width:100%; padding:6px 10px; font-size:12px; background:#faf8f5; border:1px solid #1a4731; color:#1a4731; font-weight:600; border-radius:6px; display:flex; align-items:center; justify-content:center; gap:4px; cursor:pointer;">
                                    <span>✎ Edit Content</span>
                                </button>
                            </div>
                        </div>

                        <!-- Full-Width Section Editor Drawers -->
                        <div id="selectedSectionsDrawersContainer" style="width:100%;">
<div id="heroEditorDrawer" style="display:none; padding:20px; background:#ffffff; border:1.5px solid #1a4731; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.06); margin-top:14px; margin-bottom:14px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #e5e7eb;">
                                    <h4 style="margin:0; font-size:15px; font-weight:700; color:#1a4731; display:flex; align-items:center; gap:8px;">
                                        ✎ Edit Hero Section Content
                                    </h4>
                                    <button type="button" onclick="toggleHeroEditorDrawer()" class="adm-btn adm-btn-ghost" style="padding:4px 10px; font-size:12px; border:1px solid #d1d5db; border-radius:6px;">✕ Close Editor</button>
                                </div>
                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
                                        <div>
                                            <label class="adm-label" for="heroTitleInput" style="font-weight:600; font-size:12.5px;">Main Heading (H1)</label>
                                            <input type="text" id="heroTitleInput" name="hero_title" class="adm-input" placeholder="e.g. Sunset Residences" value="" style="font-size:13px;">
                                        </div>
                                        <div>
                                            <label class="adm-label" for="heroSubtitleInput" style="font-weight:600; font-size:12.5px;">Subtitle / Tagline</label>
                                            <input type="text" id="heroSubtitleInput" name="hero_subtitle" class="adm-input" placeholder="e.g. Abu Dhabi’s Most Exclusive Coastal Lifestyle Destination" value="" style="font-size:13px;">
                                        </div>
                                    </div>

                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:14px;">
                                        <div>
                                            <label class="adm-label" for="heroBadgeInput" style="font-weight:600; font-size:12.5px;">Badge / Pretitle</label>
                                            <input type="text" id="heroBadgeInput" name="hero_badge" class="adm-input" placeholder="e.g. Freehold for All Nationalities" value="" style="font-size:13px;">
                                        </div>
                                        <div>
                                            <label class="adm-label" style="font-weight:600; font-size:12.5px; display:flex; justify-content:space-between; align-items:center;">
                                                <span>Hero Background Image</span>
                                                <span style="font-size:11px; color:#1a4731; font-weight:600;">Change / Upload</span>
                                            </label>
                                            <div style="display:flex; gap:10px; align-items:center; background:#ffffff; border:1px solid #d1d5db; padding:6px 10px; border-radius:6px;">
                                                <div style="width:58px; height:38px; border-radius:5px; overflow:hidden; border:1px solid #1a4731; flex-shrink:0; background:#f3f4f6;">
                                                    <img id="heroImagePreview" src="{{ asset('images/hero/slide-1.jpg') }}" alt="Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                                </div>
                                                <div style="flex:1; display:flex; flex-direction:column; gap:4px; min-width:0;">
                                                    <div style="display:flex; gap:6px; align-items:center;">
                                                        <input type="file" id="heroFileInput" name="hero_image_file" accept="image/*" style="display:none;" onchange="handleHeroFileChange(this)">
                                                        <button type="button" onclick="document.getElementById('heroFileInput').click()" class="adm-btn adm-btn-secondary" style="padding:4px 9px; font-size:11.5px; font-weight:600; white-space:nowrap; background:#faf8f5; border:1px solid #1a4731; color:#1a4731;">
                                                             Upload Image
                                                        </button>
                                                        <input type="text" id="heroBgImageInput" name="hero_bg_image" class="adm-input" placeholder="/images/hero/slide-1.jpg" value="" style="font-size:12px; padding:4px 8px; height:auto;" oninput="updateHeroPreviewFromUrl(this.value)">
                                                    </div>
                                                    <span id="heroFileNameHint" style="font-size:11px; color:#6b7280; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">e.g. /images/hero/slide-1.jpg</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

<div id="hlEditorDrawer" style="display:none; padding:20px; background:#ffffff; border:1.5px solid #1a4731; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.06); margin-top:14px; margin-bottom:14px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #e5e7eb;">
                                    <h4 style="margin:0; font-size:15px; font-weight:700; color:#1a4731; display:flex; align-items:center; gap:8px;">
                                        ✎ Edit Project Highlights Content
                                    </h4>
                                    <button type="button" onclick="toggleHighlightsEditorDrawer()" class="adm-btn adm-btn-ghost" style="padding:4px 10px; font-size:12px; border:1px solid #d1d5db; border-radius:6px;">✕ Close Editor</button>
                                </div>
                                    <div style="margin-bottom:14px;">
                                        <label class="adm-label" for="hlSectionTitle" style="font-weight:600; font-size:12.5px;">Section Title</label>
                                        <input type="text" id="hlSectionTitle" name="highlights_title" class="adm-input" placeholder="e.g. Project Highlights" value="" style="font-size:13px; max-width:350px;">
                                    </div>

                                    <div style="font-size:12px; font-weight:700; color:#1a4731; margin-bottom:10px; text-transform:uppercase; letter-spacing:0.5px;">
                                        Key Highlight Cards (Customize Metric Label &amp; Value):
                                    </div>

                                    @php
                                        $metricPresetsList = [
                                            ['label' => 'Developer', 'key' => 'developer', 'icon' => 'building', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9v.01"/><path d="M9 12v.01"/><path d="M9 15v.01"/><path d="M9 18v.01"/></svg>'],
                                            ['label' => 'Price', 'key' => 'price', 'icon' => 'price', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>'],
                                            ['label' => 'Price From', 'key' => 'price', 'icon' => 'price', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>'],
                                            ['label' => 'Handover Date', 'key' => 'handover', 'icon' => 'calendar', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>'],
                                            ['label' => 'Property Type', 'key' => 'property_type', 'icon' => 'home', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>'],
                                            ['label' => 'Ownership', 'key' => 'ownership', 'icon' => 'shield', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>'],
                                            ['label' => 'Bedrooms', 'key' => 'bedrooms', 'icon' => 'bed', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>'],
                                            ['label' => 'Location', 'key' => 'location', 'icon' => 'map-pin', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>'],
                                            ['label' => 'Plot Size', 'key' => 'plot_size', 'icon' => 'plot_size', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>'],
                                            ['label' => 'Down Payment', 'key' => 'down_payment', 'icon' => 'credit-card', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>'],
                                            ['label' => 'Featured Highlight', 'key' => 'featured', 'icon' => 'star', 'svg' => '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>'],
                                        ];

                                        $initialHighlightCards = [
                                            ['label' => 'Developer', 'value' => 'e.g. Saima Group', 'icon' => 'building'],
                                            ['label' => 'Price', 'value' => 'e.g. Starting from 1.5 Cr', 'icon' => 'price'],
                                            ['label' => 'Handover Date', 'value' => 'e.g. Dec 2026', 'icon' => 'calendar'],
                                            ['label' => 'Property Type', 'value' => 'e.g. Luxury Apartments', 'icon' => 'home'],
                                            ['label' => 'Ownership', 'value' => 'e.g. Freehold', 'icon' => 'shield'],
                                        ];
                                    @endphp

                                    <!-- Highlight Cards Grid -->
                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px;">
                                        @foreach($initialHighlightCards as $idx => $card)
                                            <div style="border:1px solid #e5e7eb; border-radius:8px; padding:10px 12px; background:#faf8f5;">
                                                <div style="font-size:11.5px; font-weight:700; color:#374151; margin-bottom:6px;">Card {{ $idx + 1 }}</div>
                                                <div style="display:grid; grid-template-columns:1fr 1fr; gap:8px;">
                                                    <div>
                                                        <label style="font-size:11px; color:#6b7280; display:block; margin-bottom:2px; font-weight:600;">Metric</label>
                                                        <input type="hidden" name="highlights_items[{{ $idx }}][icon]" class="adm-hl-icon-input" value="{{ $card['icon'] }}">
                                                        <div class="adm-metric-input-wrap">
                                                            <div class="adm-metric-input-group">
                                                                <span class="adm-metric-prefix-icon" title="Metric Icon">
                                                                    @php
                                                                        $matchedSvg = $metricPresetsList[0]['svg'];
                                                                        foreach($metricPresetsList as $mp) {
                                                                            if(strtolower($mp['label']) === strtolower($card['label'])) {
                                                                                $matchedSvg = $mp['svg'];
                                                                                break;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    {!! $matchedSvg !!}
                                                                </span>
                                                                <input type="text" name="highlights_items[{{ $idx }}][label]" value="" class="adm-input adm-metric-input" oninput="onMetricInputChange(this)" placeholder="{{ $card['label'] }}" style="font-size:12px; padding:5px 30px 5px 38px;">
                                                                <button type="button" class="adm-metric-dropdown-btn" onclick="toggleMetricDropdown(this)" title="Choose Metric Name">
                                                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                                                        <polyline points="6 9 12 15 18 9"></polyline>
                                                                    </svg>
                                                                </button>
                                                            </div>
                                                            <div class="adm-metric-menu">
                                                                <div class="adm-metric-menu-header">Select Predefined Metric</div>
                                                                @foreach($metricPresetsList as $preset)
                                                                    <div class="adm-metric-menu-item" onclick="selectMetricOption(this, '{{ $preset['label'] }}', '{{ $preset['key'] }}', '{{ $preset['icon'] }}')">
                                                                        <span class="adm-metric-menu-item-icon">{!! $preset['svg'] !!}</span>
                                                                        <span class="adm-metric-menu-item-label">{{ $preset['label'] }}</span>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <label style="font-size:11px; color:#6b7280; display:block; margin-bottom:2px; font-weight:600;">Value</label>
                                                        <input type="text" name="highlights_items[{{ $idx }}][value]" value="" placeholder="{{ $card['value'] }}" class="adm-input" style="font-size:12px; padding:5px 8px;">
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

<div id="aboutEditorDrawer" style="display:none; padding:20px; background:#ffffff; border:1.5px solid #1a4731; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.06); margin-top:14px; margin-bottom:14px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #e5e7eb;">
                                    <h4 style="margin:0; font-size:15px; font-weight:700; color:#1a4731; display:flex; align-items:center; gap:8px;">
                                        ✎ Edit About Community Content
                                    </h4>
                                    <button type="button" onclick="toggleAboutEditorDrawer()" class="adm-btn adm-btn-ghost" style="padding:4px 10px; font-size:12px; border:1px solid #d1d5db; border-radius:6px;">✕ Close Editor</button>
                                </div>
                                    <div style="margin-bottom:12px;">
                                        <label class="adm-label" for="aboutTitleInput" style="font-weight:600; font-size:12.5px;">Section Title / Heading</label>
                                        <input type="text" id="aboutTitleInput" name="about_title" class="adm-input" placeholder="e.g. Waterfront Sanctuary by Developer" value="" style="font-size:13px;">
                                    </div>

                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:12px;">
                                        <div>
                                            <label class="adm-label" for="aboutVideoPosterInput" style="font-weight:600; font-size:12.5px;">Video Poster Image URL</label>
                                            <input type="text" id="aboutVideoPosterInput" name="about_video_poster" class="adm-input" placeholder="/images/golf-estates/video-poster.jpg" value="" style="font-size:12.5px;">
                                        </div>
                                        <div>
                                            <label class="adm-label" for="aboutVideoSrcInput" style="font-weight:600; font-size:12.5px;">Video File / Stream URL (.mp4)</label>
                                            <input type="text" id="aboutVideoSrcInput" name="about_video_src" class="adm-input" placeholder="https://example.com/video.mp4" value="" style="font-size:12.5px;">
                                        </div>
                                    </div>

                                    <div style="margin-bottom:6px;">
                                        <label class="adm-label" for="aboutDescInput" style="font-weight:700; font-size:12.5px; color:#111827; margin-bottom:6px;">
                                            Community Narrative / Editorial Story
                                        </label>
                                        <textarea id="aboutDescInput" name="about_description" class="adm-input" placeholder="Write community narrative or editorial story here..." style="min-height:120px; font-size:13px; line-height:1.5;"></textarea>
                                    </div>
                                </div>

<div id="contentEditorDrawer" style="display:none; padding:20px; background:#ffffff; border:1.5px solid #1a4731; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.06); margin-top:14px; margin-bottom:14px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #e5e7eb;">
                                    <h4 style="margin:0; font-size:15px; font-weight:700; color:#1a4731; display:flex; align-items:center; gap:8px;">
                                        ✎ Edit Article & Booking Content
                                    </h4>
                                    <button type="button" onclick="toggleContentEditorDrawer()" class="adm-btn adm-btn-ghost" style="padding:4px 10px; font-size:12px; border:1px solid #d1d5db; border-radius:6px;">✕ Close Editor</button>
                                </div>
                                    <div style="margin-bottom:12px;">
                                        <label class="adm-label" for="articleTitleInput" style="font-weight:600; font-size:12.5px;">Main Heading (Title)</label>
                                        <input type="text" id="articleTitleInput" name="article_title" class="adm-input" placeholder="e.g. Saima Residences is a new benchmark for living" value="" style="font-size:13px;">
                                    </div>

                                    <!-- Simple Text Area -->
                                    <div style="margin-bottom:14px;">
                                        <label class="adm-label" for="articleIntroInput" style="font-weight:700; font-size:12.5px; color:#111827; margin-bottom:4px;">
                                            Intro Paragraphs (Simple Text Area)
                                        </label>
                                        <div style="font-size:11.5px; color:#6b7280; margin-bottom:6px;">
                                            Text entered here appears directly at the top. The &quot;Read More&quot; button will automatically appear at the end of these paragraphs.
                                        </div>
                                        <textarea id="articleIntroInput" name="article_intro" class="adm-input" rows="5" placeholder="Enter introductory paragraphs here..." style="min-height:100px; font-size:13px; line-height:1.6;"></textarea>
                                    </div>

                                    <!-- Summernote Editor (Right Below Textarea) -->
                                    <div style="margin-bottom:14px;">
                                        <label class="adm-label" for="articleSummernote" style="font-weight:700; font-size:12.5px; color:#111827; margin-bottom:4px;">
                                            Full Content (Summernote WYSIWYG Editor - Expands on &quot;Read More&quot;)
                                        </label>
                                        <div style="font-size:11.5px; color:#6b7280; margin-bottom:6px;">
                                            Add rich text, headings, detailed descriptions, images, and formatting. This is revealed when clicking &quot;Read More&quot;.
                                        </div>
                                        <textarea id="articleSummernote" name="article_summernote" class="adm-summernote" placeholder="Write full article content here..." style="min-height:180px;"></textarea>
                                    </div>

                                    <!-- Appointment Form Title -->
                                    <div>
                                        <label class="adm-label" for="articleApptTitleInput" style="font-weight:600; font-size:12.5px;">Appointment Form Header</label>
                                        <input type="text" id="articleApptTitleInput" name="article_appt_title" class="adm-input" placeholder="e.g. BOOK AN APPOINTMENT" value="" style="font-size:13px; max-width:350px;">
                                    </div>
                                </div>

<div id="communitiesEditorDrawer" style="display:none; padding:20px; background:#ffffff; border:1.5px solid #1a4731; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.06); margin-top:14px; margin-bottom:14px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #e5e7eb;">
                                    <h4 style="margin:0; font-size:15px; font-weight:700; color:#1a4731; display:flex; align-items:center; gap:8px;">
                                        ✎ Edit Project Cards Content
                                    </h4>
                                    <button type="button" onclick="toggleCommunitiesEditorDrawer()" class="adm-btn adm-btn-ghost" style="padding:4px 10px; font-size:12px; border:1px solid #d1d5db; border-radius:6px;">✕ Close Editor</button>
                                </div>
                                    <!-- Section Header Configuration -->
                                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:12px; margin-bottom:16px;">
                                        <div>
                                            <label class="adm-label" for="communitiesHeadingInput" style="font-weight:600; font-size:12.5px;">Section Heading</label>
                                            <input type="text" id="communitiesHeadingInput" name="communities_heading" class="adm-input" value="" placeholder="e.g. Featured Projects" style="font-size:13px;">
                                        </div>
                                        <div>
                                            <label class="adm-label" for="communitiesSubtitleInput" style="font-weight:600; font-size:12.5px;">Section Subtitle / Tagline</label>
                                            <input type="text" id="communitiesSubtitleInput" name="communities_subtitle" class="adm-input" value="" placeholder="e.g. Explore premier residential communities" style="font-size:13px;">
                                        </div>
                                    </div>

                                    @php
                                        $allAvailableProjects = $allProjects ?? \App\Models\Project::with('page')->orderBy('order', 'asc')->get();
                                    @endphp

                                    <div style="margin-top: 18px;">
                                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                            <span style="font-size: 13px; font-weight: 700; color: #1a4731; text-transform: uppercase; letter-spacing: 0.5px;">
                                                Select Property Cards (Drag &amp; Drop Between Boxes):
                                            </span>
                                            <span style="font-size: 12px; color: #64748b;">
                                                Mouse se card ko pakar kar right box me le aayein
                                            </span>
                                        </div>

                                        <!-- Dual Boxes Grid (Side-by-side tall boxes) -->
                                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                                            
                                            <!-- BOX 1: All Available Property Cards -->
                                            <div style="background: #f8fafc; border: 1.5px dashed #cbd5e1; border-radius: 12px; padding: 16px; display: flex; flex-direction: column;">
                                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                                                    <div>
                                                        <strong style="font-size: 13.5px; color: #1e293b; display: flex; align-items: center; gap: 6px;">
                                                            📁 Available Property Cards (<span id="availableCount">{{ $allAvailableProjects->count() }}</span>)
                                                        </strong>
                                                        <span style="font-size: 11.5px; color: #64748b;">All created property cards in your system</span>
                                                    </div>
                                                </div>

                                                <div id="box1_availableCards" ondragover="allowDropCard(event)" ondrop="dropCardToAvailable(event)" style="display: flex; flex-direction: column; gap: 8px; min-height: 380px; max-height: 540px; overflow-y: auto; padding: 4px;">
                                                    @foreach($allAvailableProjects as $proj)
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
                                                    @if($allAvailableProjects->isEmpty())
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
                                                            ✓ Selected Cards for This Page (<span id="selectedCount">0</span>)
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

<div id="faqEditorDrawer" style="display:none; padding:20px; background:#ffffff; border:1.5px solid #1a4731; border-radius:12px; box-shadow:0 4px 16px rgba(0,0,0,0.06); margin-top:14px; margin-bottom:14px;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:16px; padding-bottom:10px; border-bottom:1px solid #e5e7eb;">
                                    <h4 style="margin:0; font-size:15px; font-weight:700; color:#1a4731; display:flex; align-items:center; gap:8px;">
                                        ✎ Edit FAQ Section Content
                                    </h4>
                                    <button type="button" onclick="toggleFaqEditorDrawer()" class="adm-btn adm-btn-ghost" style="padding:4px 10px; font-size:12px; border:1px solid #d1d5db; border-radius:6px;">✕ Close Editor</button>
                                </div>
                                    <!-- Section Header Configuration -->
                                    <div style="margin-bottom:16px;">
                                        <label class="adm-label" for="faqHeadingInput" style="font-weight:600; font-size:12.5px;">Section Heading</label>
                                        <input type="text" id="faqHeadingInput" name="faq_heading" class="adm-input" value="" placeholder="e.g. Frequently Asked Questions" style="font-size:13px;">
                                    </div>

                                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:12px; border-bottom:1px solid #e5e7eb; padding-bottom:8px;">
                                        <span style="font-size:12.5px; font-weight:700; color:#1a4731; text-transform:uppercase; letter-spacing:0.5px;">
                                            Questions &amp; Answers List:
                                        </span>
                                        <span style="font-size:11.5px; color:#6b7280;">Drag ⇅ to reorder, ✕ to delete</span>
                                    </div>

                                    <!-- Table-like Header -->
                                    <div style="display:grid; grid-template-columns:34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap:10px; padding:0 6px; margin-bottom:6px; font-size:11px; font-weight:700; text-transform:uppercase; color:#6b7280;" aria-hidden="true">
                                        <span></span><span>Question</span><span>Answer</span><span></span>
                                    </div>

                                    <!-- FAQ Repeater Container -->
                                    <div id="faqQuestionsContainer" style="display:flex; flex-direction:column; gap:8px; margin-bottom:12px;">
                                        <!-- FAQ Item 1 (Default) -->
                                        <div class="faq-repeater-row" id="faqCard_0" style="display:grid; grid-template-columns:34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap:10px; align-items:center; background:#faf8f5; border:1px solid #e5e7eb; border-radius:8px; padding:6px 10px;">
                                            <div style="display:flex; align-items:center; justify-content:center; width:34px; height:36px; border:1px solid #d1d5db; background:#ffffff; border-radius:6px; color:#1a4731; cursor:grab;" title="Drag to reorder">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                                            </div>
                                            <input type="text" name="faq_items[0][q]" value="" class="adm-input" placeholder="Question (e.g. Is this a freehold development?)" style="margin:0; min-height:36px; font-size:13px;">
                                            <textarea name="faq_items[0][a]" class="adm-textarea" rows="1" placeholder="Answer..." style="margin:0; min-height:36px; font-size:13px; resize:vertical; line-height:1.4;"></textarea>
                                            <button type="button" onclick="deleteFaqCard(this)" title="Delete row" style="width:34px; height:36px; border:1px solid #fecaca; background:#fef2f2; color:#b91c1c; border-radius:6px; cursor:pointer; font-size:14px; line-height:1; display:flex; align-items:center; justify-content:center; transition:all 0.15s ease;">&#10005;</button>
                                        </div>

                                        <!-- FAQ Item 2 (Default) -->
                                        <div class="faq-repeater-row" id="faqCard_1" style="display:grid; grid-template-columns:34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap:10px; align-items:center; background:#faf8f5; border:1px solid #e5e7eb; border-radius:8px; padding:6px 10px;">
                                            <div style="display:flex; align-items:center; justify-content:center; width:34px; height:36px; border:1px solid #d1d5db; background:#ffffff; border-radius:6px; color:#1a4731; cursor:grab;" title="Drag to reorder">
                                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
                                            </div>
                                            <input type="text" name="faq_items[1][q]" value="" class="adm-input" placeholder="Question (e.g. What is the payment plan schedule?)" style="margin:0; min-height:36px; font-size:13px;">
                                            <textarea name="faq_items[1][a]" class="adm-textarea" rows="1" placeholder="Answer..." style="margin:0; min-height:36px; font-size:13px; resize:vertical; line-height:1.4;"></textarea>
                                            <button type="button" onclick="deleteFaqCard(this)" title="Delete row" style="width:34px; height:36px; border:1px solid #fecaca; background:#fef2f2; color:#b91c1c; border-radius:6px; cursor:pointer; font-size:14px; line-height:1; display:flex; align-items:center; justify-content:center; transition:all 0.15s ease;">&#10005;</button>
                                        </div>
                                    </div>

                                    <!-- Add Row Button -->
                                    <button type="button" onclick="addFaqQuestionItem()" style="padding:6px 14px; font-size:12.5px; font-weight:600; cursor:pointer; border:1px dashed #1a4731; color:#1a4731; background:#faf8f5; border-radius:8px; display:inline-flex; align-items:center; gap:6px; transition:all 0.15s ease;">
                                        + Add Row
                                    </button>
                                </div>
                        </div>
                        </div>
                    </div>

                    <!-- ========================================================================= -->
                    <!-- 2. LOWER AREA: AVAILABLE SECTIONS (CLICK TO ADD)                          -->
                    <!-- ========================================================================= -->
                    <!-- ============================================== -->
                    <!-- TAB 1: SELECT SECTIONS (AVAILABLE SECTIONS)    -->
                    <!-- ============================================== -->
                    <div id="modalTabSelect" style="display:block;">
                        
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:14px; padding-bottom:8px; border-bottom:1px solid #e5e7eb;">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <h3 style="margin:0; font-size:14px; font-weight:700; color:#111827; text-transform:uppercase; letter-spacing:0.04em;">
                                    Available Sections
                                </h3>
                                <span id="tabSelectCountBadge" style="background:#e5e7eb; color:#374151; font-size:11px; font-weight:700; padding:2px 8px; border-radius:12px;">6 Available</span>
                            </div>
                            <span style="font-size:12.5px; color:#6b7280;">Click on any section card below to add it directly to your page layout above</span>
                        </div>

                        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(210px, 1fr)); gap:14px;">
                            <!-- 1. Hero Section Card -->
                            <div id="cardSelectHero" onclick="toggleSectionSelection('hero')" style="border:2px dashed #d1d5db; border-radius:10px; background:#ffffff; padding:12px; cursor:pointer; transition:all 0.2s ease; user-select:none; position:relative;">
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:10px;">
                                    <img src="{{ asset('hero.png') }}" alt="Hero Section Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">TOP BANNER</span>
                                    </div>
                                    <div id="heroCardBadge" style="position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.6); color:#ffffff; font-size:10px; padding:2px 7px; border-radius:4px; font-weight:600;">
                                        + Click to Add
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Hero Section</span>
                                    <span id="heroCheckIcon" style="display:none; color:#16a34a; font-weight:700; font-size:13px;">✓ Selected</span>
                                </div>
                                <p style="font-size:11.5px; color:#6b7280; margin:4px 0 0; line-height:1.4;">
                                    Header banner with headline, subtitle, badge, photo &amp; lead capture form.
                                </p>
                            </div>

                            <!-- 2. Project Highlights Card -->
                            <div id="cardSelectHighlights" onclick="toggleSectionSelection('highlights')" style="border:2px dashed #d1d5db; border-radius:10px; background:#ffffff; padding:12px; cursor:pointer; transition:all 0.2s ease; user-select:none; position:relative;">
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:10px;">
                                    <img src="{{ asset('project_hightlights.png') }}" alt="Project Highlights Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">KEY FACTS GRID</span>
                                    </div>
                                    <div id="hlCardBadge" style="position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.6); color:#ffffff; font-size:10px; padding:2px 7px; border-radius:4px; font-weight:600;">
                                        + Click to Add
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Project Highlights</span>
                                    <span id="hlCheckIcon" style="display:none; color:#16a34a; font-weight:700; font-size:13px;">✓ Selected</span>
                                </div>
                                <p style="font-size:11.5px; color:#6b7280; margin:4px 0 0; line-height:1.4;">
                                    6 key highlight cards (Developer, Price, Handover, Type, Ownership, Payment Plan).
                                </p>
                            </div>

                            <!-- 3. About Community Card -->
                            <div id="cardSelectAbout" onclick="toggleSectionSelection('about')" style="border:2px dashed #d1d5db; border-radius:10px; background:#ffffff; padding:12px; cursor:pointer; transition:all 0.2s ease; user-select:none; position:relative;">
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:10px;">
                                    <img src="{{ asset('about_community.png') }}" alt="About Community Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">EDITORIAL &amp; VIDEO</span>
                                    </div>
                                    <div id="aboutCardBadge" style="position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.6); color:#ffffff; font-size:10px; padding:2px 7px; border-radius:4px; font-weight:600;">
                                        + Click to Add
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">About Community</span>
                                    <span id="aboutCheckIcon" style="display:none; color:#16a34a; font-weight:700; font-size:13px;">✓ Selected</span>
                                </div>
                                <p style="font-size:11.5px; color:#6b7280; margin:4px 0 0; line-height:1.4;">
                                    Editorial story narrative, community overview paragraphs &amp; video player showcase.
                                </p>
                            </div>

                            <!-- 4. Article / Content & Booking Form Card -->
                            <div id="cardSelectContent" onclick="toggleSectionSelection('content')" style="border:2px dashed #d1d5db; border-radius:10px; background:#ffffff; padding:12px; cursor:pointer; transition:all 0.2s ease; user-select:none; position:relative;">
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:10px;">
                                    <img src="{{ asset('article_booking.png') }}" alt="Article &amp; Booking Form Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">ARTICLE &amp; BOOKING</span>
                                    </div>
                                    <div id="contentCardBadge" style="position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.6); color:#ffffff; font-size:10px; padding:2px 7px; border-radius:4px; font-weight:600;">
                                        + Click to Add
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Article &amp; Booking</span>
                                    <span id="contentCheckIcon" style="display:none; color:#16a34a; font-weight:700; font-size:13px;">✓ Selected</span>
                                </div>
                                <p style="font-size:11.5px; color:#6b7280; margin:4px 0 0; line-height:1.4;">
                                    Intro text area, "Read More" button, Summernote editor &amp; side appointment form.
                                </p>
                            </div>

                            <!-- 5. Community / Project Cards -->
                            <div id="cardSelectCommunities" onclick="toggleSectionSelection('communities')" style="border:2px dashed #d1d5db; border-radius:10px; background:#ffffff; padding:12px; cursor:pointer; transition:all 0.2s ease; user-select:none; position:relative;">
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:10px;">
                                    <img src="{{ asset('card.png') }}" alt="Project Cards Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">PROJECT CARDS</span>
                                    </div>
                                    <div id="communitiesCardBadge" style="position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.6); color:#ffffff; font-size:10px; padding:2px 7px; border-radius:4px; font-weight:600;">
                                        + Click to Add
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">Project Cards</span>
                                    <span id="communitiesCheckIcon" style="display:none; color:#16a34a; font-weight:700; font-size:13px;">✓ Selected</span>
                                </div>
                                <p style="font-size:11.5px; color:#6b7280; margin:4px 0 0; line-height:1.4;">
                                    Dynamic project cards grid with page attachment dropdown, price, delivery &amp; &quot;Add to Card&quot; button.
                                </p>
                            </div>

                            <!-- 6. FAQ Accordion Section -->
                            <div id="cardSelectFaq" onclick="toggleSectionSelection('faq')" style="border:2px dashed #d1d5db; border-radius:10px; background:#ffffff; padding:12px; cursor:pointer; transition:all 0.2s ease; user-select:none; position:relative;">
                                <div style="position:relative; width:100%; height:95px; border-radius:6px; overflow:hidden; border:1px solid #e5e7eb; background:#f9fafb; margin-bottom:10px;">
                                    <img src="{{ asset('FAQ.png') }}" alt="FAQ Section Preview" style="width:100%; height:100%; object-fit:cover; display:block;">
                                    <div style="position:absolute; bottom:0; left:0; right:0; background:linear-gradient(to top, rgba(0,0,0,0.75), transparent); padding:4px 8px;">
                                        <span style="font-size:9.5px; color:#ffffff; font-weight:700; letter-spacing:0.5px;">FAQ ACCORDION</span>
                                    </div>
                                    <div id="faqCardBadge" style="position:absolute; top:6px; right:6px; background:rgba(0,0,0,0.6); color:#ffffff; font-size:10px; padding:2px 7px; border-radius:4px; font-weight:600;">
                                        + Click to Add
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:space-between; align-items:center;">
                                    <span style="font-size:13.5px; font-weight:700; color:#111827;">FAQ Section</span>
                                    <span id="faqCheckIcon" style="display:none; color:#16a34a; font-weight:700; font-size:13px;">✓ Selected</span>
                                </div>
                                <p style="font-size:11.5px; color:#6b7280; margin:4px 0 0; line-height:1.4;">
                                    Interactive questions &amp; answers accordion with section title, description &amp; add/delete FAQ items.
                                </p>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Form Foot -->
            <div style="padding:16px 24px; background:#faf8f5; border-top:1px solid #ede8e1; display:flex; justify-content:flex-end; gap:12px; align-items:center;">
                <button type="button" onclick="closeCreatePageModal()" class="adm-btn adm-btn-ghost" style="padding:10px 18px;">Cancel</button>
                <button type="submit" class="adm-btn adm-btn-primary" style="padding:10px 24px; font-size:14.5px; font-weight:700; display:inline-flex; align-items:center; gap:8px;">
                    @include('admin.partials.icon', ['name' => 'plus'])
                    Create Project
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Selected sections in order: array of strings e.g. ['hero', 'highlights', 'about']
    let selectedSections = [];
    let heroDrawerOpen = false;
    let hlDrawerOpen = false;
    let aboutDrawerOpen = false;
    let contentDrawerOpen = false;
    let communitiesDrawerOpen = false;
    let faqDrawerOpen = false;
    let commCardCount = 1;
    let faqCardCount = 2;
    let draggedSectionKey = null;

    function openCreatePageModal() {
        const listView = document.getElementById('projectsListView');
        const section = document.getElementById('createProjectSection');
        if (listView) listView.style.display = 'none';
        if (section) {
            section.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
            setTimeout(() => {
                document.getElementById('newPageTitle')?.focus();
            }, 50);
        }
        manuallyEditedSlug = false;
        manuallyEditedHeroTitle = false;
    }

    function closeCreatePageModal() {
        const listView = document.getElementById('projectsListView');
        const section = document.getElementById('createProjectSection');
        if (section) section.style.display = 'none';
        if (listView) {
            listView.style.display = 'block';
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }
    }

    // Switch between Tab 1 (Select Sections) and Tab 2 (Layout & Reorder / Edit)
    function switchModalTab(tab) {
        // Unified single-view builder: both sections are always visible
        if (heroDrawerOpen || contentDrawerOpen) {
            initSummernote();
        }
    }

    // Toggle Selection of Section from Tab 1
    function toggleSectionSelection(key) {
        const index = selectedSections.indexOf(key);
        if (index === -1) {
            // Add section
            selectedSections.push(key);
            updateUiState();

            // Smooth scroll up to added section so user sees it in top layout
            setTimeout(function() {
                const addedItem = document.getElementById('dragItem' + capitalize(key));
                if (addedItem) {
                    addedItem.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }
            }, 40);
        } else {
            // Remove section
            selectedSections.splice(index, 1);
            updateUiState();
        }
    }

    function removeSection(key) {
        const index = selectedSections.indexOf(key);
        if (index !== -1) {
            selectedSections.splice(index, 1);
            // Close drawer if open
            if (key === 'hero' && heroDrawerOpen) toggleHeroEditorDrawer();
            if (key === 'highlights' && hlDrawerOpen) toggleHighlightsEditorDrawer();
            if (key === 'about' && aboutDrawerOpen) toggleAboutEditorDrawer();
            if (key === 'content' && contentDrawerOpen) toggleContentEditorDrawer();
            if (key === 'communities' && communitiesDrawerOpen) toggleCommunitiesEditorDrawer();
            if (key === 'faq' && faqDrawerOpen) toggleFaqEditorDrawer();
            updateUiState();
        }
    }

    // Move section up or down in order
    function moveSectionOrder(key, direction) {
        const idx = selectedSections.indexOf(key);
        if (idx === -1) return;

        if (direction === 'up' && idx > 0) {
            const temp = selectedSections[idx];
            selectedSections[idx] = selectedSections[idx - 1];
            selectedSections[idx - 1] = temp;
        } else if (direction === 'down' && idx < selectedSections.length - 1) {
            const temp = selectedSections[idx];
            selectedSections[idx] = selectedSections[idx + 1];
            selectedSections[idx + 1] = temp;
        }
        updateUiState();
    }

    // HTML5 Drag and Drop handlers
    function handleDragStart(e, key) {
        draggedSectionKey = key;
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', key);
        const item = document.getElementById('dragItem' + capitalize(key));
        if (item) item.style.opacity = '0.4';
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
    }

    function handleDrop(e, targetKey) {
        e.preventDefault();
        if (!draggedSectionKey || draggedSectionKey === targetKey) return;

        const fromIdx = selectedSections.indexOf(draggedSectionKey);
        const toIdx = selectedSections.indexOf(targetKey);

        if (fromIdx !== -1 && toIdx !== -1) {
            selectedSections.splice(fromIdx, 1);
            selectedSections.splice(toIdx, 0, draggedSectionKey);
            updateUiState();
        }
    }

    function handleDragEnd(e) {
        const itemHero = document.getElementById('dragItemHero');
        const itemHl = document.getElementById('dragItemHighlights');
        const itemAbout = document.getElementById('dragItemAbout');
        const itemContent = document.getElementById('dragItemContent');
        const itemComm = document.getElementById('dragItemCommunities');
        const itemFaq = document.getElementById('dragItemFaq');
        if (itemHero) itemHero.style.opacity = '1';
        if (itemHl) itemHl.style.opacity = '1';
        if (itemAbout) itemAbout.style.opacity = '1';
        if (itemContent) itemContent.style.opacity = '1';
        if (itemComm) itemComm.style.opacity = '1';
        if (itemFaq) itemFaq.style.opacity = '1';
        draggedSectionKey = null;
    }

    function capitalize(s) {
        return s.charAt(0).toUpperCase() + s.slice(1);
    }

    // Update entire UI state based on selectedSections array
    function updateUiState() {
        const hasHero = selectedSections.includes('hero');
        const hasHl = selectedSections.includes('highlights');
        const hasAbout = selectedSections.includes('about');
        const hasContent = selectedSections.includes('content');
        const hasCommunities = selectedSections.includes('communities');
        const hasFaq = selectedSections.includes('faq');

        // 1. Update hidden inputs
        document.getElementById('hasHeroInput').value = hasHero ? '1' : '0';
        document.getElementById('hasHighlightsInput').value = hasHl ? '1' : '0';
        document.getElementById('hasAboutInput').value = hasAbout ? '1' : '0';
        document.getElementById('hasContentInput').value = hasContent ? '1' : '0';
        document.getElementById('hasCommunitiesInput').value = hasCommunities ? '1' : '0';
        document.getElementById('hasFaqInput').value = hasFaq ? '1' : '0';
        document.getElementById('sectionOrderInput').value = JSON.stringify(selectedSections);

        // 2. Update Lower Area Cards Appearance
        updateTabCard('cardSelectHero', 'heroCardBadge', 'heroCheckIcon', hasHero);
        updateTabCard('cardSelectHighlights', 'hlCardBadge', 'hlCheckIcon', hasHl);
        updateTabCard('cardSelectAbout', 'aboutCardBadge', 'aboutCheckIcon', hasAbout);
        updateTabCard('cardSelectContent', 'contentCardBadge', 'contentCheckIcon', hasContent);
        updateTabCard('cardSelectCommunities', 'communitiesCardBadge', 'communitiesCheckIcon', hasCommunities);
        updateTabCard('cardSelectFaq', 'faqCardBadge', 'faqCheckIcon', hasFaq);

        // 3. Update Count Badge
        const countBadge = document.getElementById('tabLayoutCountBadge');
        if (countBadge) countBadge.innerText = selectedSections.length + ' Added';

        // 4. Update Upper Area Big Cards Container
        const emptyNotice = document.getElementById('layoutEmptyNotice');
        const listContainer = document.getElementById('selectedSectionsList');

        if (selectedSections.length === 0) {
            if (emptyNotice) emptyNotice.style.display = 'block';
            if (listContainer) listContainer.style.display = 'none';
        } else {
            if (emptyNotice) emptyNotice.style.display = 'none';
            if (listContainer) listContainer.style.display = 'flex';

            // Re-order DOM elements inside listContainer
            selectedSections.forEach((key, index) => {
                const elementId = 'dragItem' + capitalize(key);
                const el = document.getElementById(elementId);
                if (el && listContainer) {
                    el.style.display = 'block';
                    listContainer.appendChild(el);
                    // Update order badge e.g. #1, #2
                    const badge = document.getElementById(key === 'highlights' ? 'hlOrderBadge' : (key + 'OrderBadge'));
                    if (badge) badge.innerText = '#' + (index + 1);
                }
            });

            // Hide unselected big cards from DOM
            ['hero', 'highlights', 'about', 'content', 'communities', 'faq'].forEach(key => {
                if (!selectedSections.includes(key)) {
                    const el = document.getElementById('dragItem' + capitalize(key));
                    if (el) el.style.display = 'none';
                }
            });
        }
    }

    function updateTabCard(cardId, badgeId, checkId, isSelected) {
        const card = document.getElementById(cardId);
        const badge = document.getElementById(badgeId);
        const check = document.getElementById(checkId);
        if (!card || !badge || !check) return;

        if (isSelected) {
            card.style.borderColor = '#1a4731';
            card.style.borderStyle = 'solid';
            card.style.background = '#fffaf4';
            badge.innerText = '✓ Added';
            badge.style.background = '#1a4731';
            check.style.display = 'inline-block';
        } else {
            card.style.borderColor = '#d1d5db';
            card.style.borderStyle = 'dashed';
            card.style.background = '#ffffff';
            badge.innerText = '+ Click to Add';
            badge.style.background = 'rgba(0,0,0,0.6)';
            check.style.display = 'none';
        }
    }

    // Toggle Hero Drawer
    function toggleHeroEditorDrawer() {
        heroDrawerOpen = !heroDrawerOpen;
        const drawer = document.getElementById('heroEditorDrawer');
        const btn = document.getElementById('heroDrawerBtn');
        if (heroDrawerOpen || contentDrawerOpen) {
            drawer.style.display = 'block';
            btn.innerHTML = '<span>Close Edit</span>';
            initSummernote();
        } else {
            drawer.style.display = 'none';
            btn.innerHTML = '<span>✎ Edit Content</span>';
        }
    }

    // Toggle Highlights Drawer
    function toggleHighlightsEditorDrawer() {
        hlDrawerOpen = !hlDrawerOpen;
        const drawer = document.getElementById('hlEditorDrawer');
        const btn = document.getElementById('hlDrawerBtn');
        if (hlDrawerOpen) {
            drawer.style.display = 'block';
            btn.innerHTML = '<span>Close Edit</span>';
        } else {
            drawer.style.display = 'none';
            btn.innerHTML = '<span>✎ Edit Content</span>';
        }
    }

    // Toggle About Drawer
    function toggleAboutEditorDrawer() {
        aboutDrawerOpen = !aboutDrawerOpen;
        const drawer = document.getElementById('aboutEditorDrawer');
        const btn = document.getElementById('aboutDrawerBtn');
        if (aboutDrawerOpen) {
            drawer.style.display = 'block';
            btn.innerHTML = '<span>Close Edit</span>';
        } else {
            drawer.style.display = 'none';
            btn.innerHTML = '<span>✎ Edit Content</span>';
        }
    }

    // Toggle Content / Article Drawer
    function toggleContentEditorDrawer() {
        contentDrawerOpen = !contentDrawerOpen;
        const drawer = document.getElementById('contentEditorDrawer');
        const btn = document.getElementById('contentDrawerBtn');
        if (contentDrawerOpen) {
            drawer.style.display = 'block';
            btn.innerHTML = '<span>Close Edit</span>';
            initSummernote();
        } else {
            drawer.style.display = 'none';
            btn.innerHTML = '<span>✎ Edit Content</span>';
        }
    }

    function initSummernote() {
        setTimeout(function() {
            if (typeof $ !== 'undefined') {
                if ($('#articleSummernote').length && !$('#articleSummernote').data('summernote')) {
                    $('#articleSummernote').summernote({
                        height: 180,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline', 'clear']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['insert', ['link', 'picture', 'hr']],
                            ['view', ['fullscreen', 'codeview']]
                        ],
                        styleTags: [
                            'p',
                            { title: 'Heading 1', tag: 'h1', className: '', value: 'h1' },
                            { title: 'Heading 2', tag: 'h2', className: '', value: 'h2' },
                            { title: 'Heading 3', tag: 'h3', className: '', value: 'h3' },
                        ]
                    });
                }
            }
        }, 60);
    }

    // Hero Background Image live preview & file upload handler
    function handleHeroFileChange(input) {
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('heroImagePreview');
                if (preview) preview.src = e.target.result;
                const hint = document.getElementById('heroFileNameHint');
                if (hint) {
                    hint.textContent = 'Selected: ' + file.name + ' (' + (file.size / 1024).toFixed(1) + ' KB)';
                    hint.style.color = '#1a4731';
                    hint.style.fontWeight = '600';
                }
            };
            reader.readAsDataURL(file);
        }
    }

    function updateHeroPreviewFromUrl(url) {
        if (!url) return;
        const preview = document.getElementById('heroImagePreview');
        if (preview) preview.src = url;
        const hint = document.getElementById('heroFileNameHint');
        if (hint) {
            hint.textContent = 'URL: ' + url;
            hint.style.color = '#6b7280';
            hint.style.fontWeight = 'normal';
        }
    }

    const METRIC_PRESETS_DATA = [
        { label: 'Developer', key: 'developer', icon: 'building', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l8-4v18"/><path d="M19 21V11l-6-4"/><path d="M9 9v.01"/><path d="M9 12v.01"/><path d="M9 15v.01"/><path d="M9 18v.01"/></svg>' },
        { label: 'Price', key: 'price', icon: 'price', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>' },
        { label: 'Price From', key: 'price', icon: 'price', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><circle cx="12" cy="13" r="3"/><path d="M12 11v4"/></svg>' },
        { label: 'Handover Date', key: 'handover', icon: 'calendar', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="4" rx="2" ry="2"/><line x1="16" x2="16" y1="2" y2="6"/><line x1="8" x2="8" y1="2" y2="6"/><line x1="3" x2="21" y1="10" y2="10"/><path d="m9 16 2 2 4-4"/></svg>' },
        { label: 'Property Type', key: 'property_type', icon: 'home', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="18" x="3" y="3" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>' },
        { label: 'Ownership', key: 'ownership', icon: 'shield', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>' },
        { label: 'Bedrooms', key: 'bedrooms', icon: 'bed', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2 4v16"/><path d="M2 8h18a2 2 0 0 1 2 2v10"/><path d="M2 17h20"/><path d="M6 8v9"/></svg>' },
        { label: 'Location', key: 'location', icon: 'map-pin', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>' },
        { label: 'Plot Size', key: 'plot_size', icon: 'plot_size', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><path d="M3 9h18"/><path d="M9 21V9"/></svg>' },
        { label: 'Down Payment', key: 'down_payment', icon: 'credit-card', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="5" x2="5" y2="19"/><circle cx="6.5" cy="6.5" r="2.5"/><circle cx="17.5" cy="17.5" r="2.5"/></svg>' },
        { label: 'Featured Highlight', key: 'featured', icon: 'star', svg: '<svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>' }
    ];

    function toggleMetricDropdown(btn) {
        const wrap = btn.closest('.adm-metric-input-wrap');
        if (!wrap) return;
        const menu = wrap.querySelector('.adm-metric-menu');
        if (!menu) return;
        const wasOpen = menu.classList.contains('show');
        document.querySelectorAll('.adm-metric-menu.show').forEach(m => m.classList.remove('show'));
        if (!wasOpen) menu.classList.add('show');
    }

    function selectMetricOption(itemEl, label, key, iconType) {
        const wrap = itemEl.closest('.adm-metric-input-wrap');
        if (!wrap) return;
        const card = wrap.closest('[style*="border-radius:8px"]') || wrap.parentElement.parentElement.parentElement;
        const input = wrap.querySelector('.adm-metric-input');
        const prefixIcon = wrap.querySelector('.adm-metric-prefix-icon');
        const menu = wrap.querySelector('.adm-metric-menu');

        if (input) input.value = label;
        const itemSvg = itemEl.querySelector('svg');
        if (prefixIcon && itemSvg) prefixIcon.innerHTML = itemSvg.outerHTML;

        if (card) {
            const iconInput = card.querySelector('.adm-hl-icon-input');
            if (iconInput) iconInput.value = iconType;
        }
        if (menu) menu.classList.remove('show');
    }

    function onMetricInputChange(input) {
        const wrap = input.closest('.adm-metric-input-wrap');
        if (!wrap) return;
        const prefixIcon = wrap.querySelector('.adm-metric-prefix-icon');
        const card = wrap.closest('[style*="border-radius:8px"]') || wrap.parentElement.parentElement.parentElement;
        const low = (input.value || '').toLowerCase().trim();
        const match = METRIC_PRESETS_DATA.find(p => {
            const pLow = p.label.toLowerCase();
            return low.includes(pLow) || pLow.includes(low);
        });
        if (prefixIcon && match) {
            prefixIcon.innerHTML = match.svg;
        }
        if (card && match) {
            const iconInput = card.querySelector('.adm-hl-icon-input');
            if (iconInput) iconInput.value = match.icon;
        }
    }

    document.addEventListener('click', function(e) {
        if (!e.target.closest('.adm-metric-input-wrap')) {
            document.querySelectorAll('.adm-metric-menu.show').forEach(m => m.classList.remove('show'));
        }
    });

    // Auto-generate slug and prefill heading from page title
    document.addEventListener('DOMContentLoaded', function () {
        const titleInput = document.getElementById('newPageTitle');
        const slugInput = document.getElementById('newPageSlug');
        const heroTitleInput = document.getElementById('heroTitleInput');
        const aboutTitleInput = document.getElementById('aboutTitleInput');
        let manuallyEditedSlug = false;
        let manuallyEditedHeroTitle = false;
        let manuallyEditedAboutTitle = false;

        if (heroTitleInput) {
            heroTitleInput.addEventListener('input', () => {
                manuallyEditedHeroTitle = true;
            });
        }

        if (aboutTitleInput) {
            aboutTitleInput.addEventListener('input', () => {
                manuallyEditedAboutTitle = true;
            });
        }

        if (slugInput) {
            slugInput.addEventListener('input', () => {
                manuallyEditedSlug = true;
            });
        }

        if (titleInput && slugInput) {
            titleInput.addEventListener('input', function () {
                if (!manuallyEditedSlug) {
                    const slug = this.value
                        .toLowerCase()
                        .trim()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    slugInput.value = slug;
                }
                if (!manuallyEditedHeroTitle && heroTitleInput) {
                    heroTitleInput.value = this.value;
                }
                if (!manuallyEditedAboutTitle && aboutTitleInput) {
                    aboutTitleInput.value = this.value.trim() ? this.value.trim() + ' by Modon' : 'Hudayriyat Island Waterfront Sanctuary by Modon';
                }
            });
        }
    });
    // Toggle Communities Drawer
    function toggleCommunitiesEditorDrawer() {
        communitiesDrawerOpen = !communitiesDrawerOpen;
        const drawer = document.getElementById('communitiesEditorDrawer');
        const btn = document.getElementById('communitiesDrawerBtn');
        if (communitiesDrawerOpen) {
            drawer.style.display = 'block';
            btn.innerHTML = '<span>Close Edit</span>';
        } else {
            drawer.style.display = 'none';
            btn.innerHTML = '<span>✎ Edit Content</span>';
        }
    }

    // ==========================================
    // DUAL-BOX PROJECT CARDS SELECTION (DRAG & DROP)
    // ==========================================
    let draggedDualCard = null;

    function dragCardStart(e) {
        draggedDualCard = e.currentTarget;
        e.dataTransfer.setData('text/plain', e.currentTarget.getAttribute('data-id') || '');
        e.dataTransfer.effectAllowed = 'move';
        e.currentTarget.style.opacity = '0.5';
        e.currentTarget.style.border = '1.5px dashed #0284c7';
    }

    function dragCardEnd(e) {
        if (e.currentTarget) {
            e.currentTarget.style.opacity = '1';
            e.currentTarget.style.border = '1px solid #e2e8f0';
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

        // If dropped onto a specific card in Box 2, insert before it for precise ordering
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

        // Re-generate hidden inputs for selected_project_ids in exact DOM order
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

    document.addEventListener('DOMContentLoaded', function() {
        updateDualBoxState();
    });

    // Toggle FAQ Drawer
    function toggleFaqEditorDrawer() {
        faqDrawerOpen = !faqDrawerOpen;
        const drawer = document.getElementById('faqEditorDrawer');
        const btn = document.getElementById('faqDrawerBtn');
        if (faqDrawerOpen) {
            drawer.style.display = 'block';
            btn.innerHTML = '<span>Close Edit</span>';
        } else {
            drawer.style.display = 'none';
            btn.innerHTML = '<span>✎ Edit Content</span>';
        }
    }

    // Add FAQ Question Item dynamically
    function addFaqQuestionItem() {
        const container = document.getElementById('faqQuestionsContainer');
        if (!container) return;
        const idx = faqCardCount++;
        const cardNum = container.querySelectorAll('.faq-repeater-row').length + 1;

        const row = document.createElement('div');
        row.className = 'faq-repeater-row';
        row.id = `faqCard_${idx}`;
        row.style.cssText = 'display:grid; grid-template-columns:34px minmax(0, 1fr) minmax(0, 1.5fr) 34px; gap:10px; align-items:center; background:#faf8f5; border:1px solid #e5e7eb; border-radius:8px; padding:6px 10px;';

        row.innerHTML = `
            <div style="display:flex; align-items:center; justify-content:center; width:34px; height:36px; border:1px solid #d1d5db; background:#ffffff; border-radius:6px; color:#1a4731; cursor:grab;" title="Drag to reorder">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M7 20V4m0 0L3 8m4-4l4 4"/><path d="M17 4v16m0 0l4-4m-4 4l-4-4"/></svg>
            </div>
            <input type="text" name="faq_items[${idx}][q]" value="" class="adm-input" placeholder="Question ${cardNum}" style="margin:0; min-height:36px; font-size:13px;">
            <textarea name="faq_items[${idx}][a]" class="adm-textarea" rows="1" placeholder="Answer..." style="margin:0; min-height:36px; font-size:13px; resize:vertical; line-height:1.4;"></textarea>
            <button type="button" onclick="deleteFaqCard(this)" title="Delete row" style="width:34px; height:36px; border:1px solid #fecaca; background:#fef2f2; color:#b91c1c; border-radius:6px; cursor:pointer; font-size:14px; line-height:1; display:flex; align-items:center; justify-content:center; transition:all 0.15s ease;">&#10005;</button>
        `;

        container.appendChild(row);
        const input = row.querySelector('input');
        if (input) input.focus();
    }

    // Delete FAQ row
    function deleteFaqCard(btn) {
        const row = btn.closest('.faq-repeater-row');
        if (row) {
            row.remove();
            renumberFaqCards();
        }
    }

    // Renumber FAQ rows
    function renumberFaqCards() {
        const container = document.getElementById('faqQuestionsContainer');
        if (!container) return;
        const rows = container.querySelectorAll('.faq-repeater-row');
        rows.forEach((row, index) => {
            row.querySelectorAll('input, textarea').forEach(input => {
                if (input.name) {
                    input.name = input.name.replace(/\[faq_items\]\[.*?\]/, `[faq_items][${index}]`).replace(/faq_items\[.*?\]/, `faq_items[${index}]`);
                }
            });
        });
    }
</script>
@endsection
