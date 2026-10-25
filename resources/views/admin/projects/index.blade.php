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
            </div>
            <button type="button" class="adm-btn adm-btn-primary" onclick="toggleAddCardForm()" style="display: inline-flex; align-items: center; gap: 6px; font-size: 13px; padding: 8px 16px; border-radius: 8px;">
                @include('admin.partials.icon', ['name' => 'plus']) Add Property Card
            </button>
        </div>
    </div>

    <!-- Collapsible Add Property Card Form Container -->
    <div id="addCardFormBox" style="display: none; margin-bottom: 24px;">
        <div class="adm-card" style="background: #ffffff; border-radius: 16px; border: 1.5px solid #1a4731; box-shadow: 0 10px 25px rgba(26, 71, 49, 0.08); padding: 26px 30px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
                <div>
                    <h3 style="margin: 0; font-size: 16px; font-weight: 700; color: #1e293b;">Create New Property Card</h3>
                    <p style="margin: 3px 0 0; font-size: 12.5px; color: #64748b;">This card will appear on the Home Page and redirect to the selected detail page.</p>
                </div>
                <button type="button" onclick="toggleAddCardForm()" style="background: none; border: none; font-size: 20px; color: #94a3b8; cursor: pointer;">&times;</button>
            </div>

            <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 18px; margin-bottom: 20px;">
                    <!-- Title -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">Property Title <span style="color:#ef4444;">*</span></label>
                        <input type="text" name="title" required placeholder="e.g. Wadeem Gardens" class="adm-input" style="width: 100%; border-radius: 8px;">
                    </div>

                    <!-- Linked Page Dropdown -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #1e3a8a; margin-bottom: 6px; text-transform: uppercase;">
                            🔗 Link to Detail Page (page_id) <span style="color:#ef4444;">*</span>
                        </label>
                        <select name="page_id" required class="adm-input" style="width: 100%; border-radius: 8px; background: #eff6ff; border-color: #93c5fd; font-weight: 600; color: #1e3a8a;">
                            <option value="">-- Select Destination Page --</option>
                            @foreach($pages as $p)
                                <option value="{{ $p->id }}">{{ $p->title }} ({{ $p->slug === '/' ? '/' : '/' . $p->slug }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Location -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">Location</label>
                        <input type="text" name="location" value="Hudayriyat Island, Abu Dhabi" class="adm-input" style="width: 100%; border-radius: 8px;">
                    </div>

                    <!-- Launch Price -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">Launch Price</label>
                        <input type="text" name="price" placeholder="e.g. Launch Price: 8.7M AED" class="adm-input" style="width: 100%; border-radius: 8px;">
                    </div>

                    <!-- Delivery Date -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">Delivery Date</label>
                        <input type="text" name="delivery_date" placeholder="e.g. Delivery Date: Q2 2031" class="adm-input" style="width: 100%; border-radius: 8px;">
                    </div>

                    <!-- Developer Badge -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">Developer Badge</label>
                        <input type="text" name="developer" value="Modon Properties" class="adm-input" style="width: 100%; border-radius: 8px;">
                    </div>

                    <!-- Payment Plan Badge -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">Payment Plan Badge</label>
                        <input type="text" name="payment_plan" placeholder="e.g. Flexible Payment Plan" class="adm-input" style="width: 100%; border-radius: 8px;">
                    </div>

                    <!-- Status -->
                    <div>
                        <label style="display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase;">Status</label>
                        <select name="is_active" class="adm-input" style="width: 100%; border-radius: 8px;">
                            <option value="1">Active / Display on Home Page</option>
                            <option value="0">Hidden / Draft</option>
                        </select>
                    </div>
                </div>

                <!-- Image Upload & URL -->
                <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px; padding: 18px 20px; margin-bottom: 22px;">
                    <div style="font-size: 12.5px; font-weight: 700; color: #334155; margin-bottom: 8px;">Property Card Image</div>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                        <div>
                            <label style="font-size: 11.5px; color: #64748b; display: block; margin-bottom: 4px;">Upload from device:</label>
                            <input type="file" name="image_file" accept="image/*" class="adm-input" style="width: 100%; font-size: 12px;">
                        </div>
                        <div>
                            <label style="font-size: 11.5px; color: #64748b; display: block; margin-bottom: 4px;">Or Image Path / URL:</label>
                            <input type="text" name="image" placeholder="/images/communities/wadeem-gardens.png" class="adm-input" style="width: 100%;">
                        </div>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="adm-btn adm-btn-secondary" onclick="toggleAddCardForm()">Cancel</button>
                    <button type="submit" class="adm-btn adm-btn-primary">Save Property Card</button>
                </div>
            </form>
        </div>
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
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; width:50px;">#</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; width:80px;">IMAGE</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em;">TITLE &amp; LOCATION</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em;">LINKED DETAIL PAGE</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em;">PRICE &amp; DELIVERY</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; width:90px;">STATUS</th>
                        <th style="padding:10px 12px; font-size:12px; font-weight:700; color:#8c9ba5; letter-spacing:0.06em; text-align:right; width:130px;">ACTIONS</th>
                    </tr>
                </thead>
                <tbody id="projectsTableBody">
                    @forelse($projects as $project)
                        <tr class="project-card-row" data-search="{{ strtolower($project->title . ' ' . $project->location . ' ' . ($project->page->title ?? '')) }}" style="border-bottom:1px dotted #e2e8f0; transition:background 0.15s ease;">
                            <!-- Order Number -->
                            <td style="padding:16px 12px; font-size:13.5px; color:#64748b; font-weight:600;">
                                #{{ $project->order }}
                            </td>

                            <!-- Thumbnail Image -->
                            <td style="padding:16px 12px;">
                                <div style="width: 60px; height: 42px; border-radius: 6px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1; display: flex; align-items: center; justify-content: center;">
                                    <img src="{{ $project->image_url }}" alt="{{ $project->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            </td>

                            <!-- Title & Location -->
                            <td style="padding:16px 12px;">
                                <div style="font-weight: 700; font-size: 14.5px; color: #1e293b;">{{ $project->title }}</div>
                                <div style="font-size: 12px; color: #64748b; margin-top: 2px;">{{ $project->location ?? 'Hudayriyat Island, Abu Dhabi' }}</div>
                            </td>

                            <!-- Linked Detail Page -->
                            <td style="padding:16px 12px;">
                                @if($project->page)
                                    <a href="{{ url($project->page->slug === '/' ? '' : $project->page->slug) }}" target="_blank" class="badge-pill" style="background: #eff6ff; color: #1d4ed8; border: 1px solid #bfdbfe; text-decoration: none;" title="Open {{ $project->page->title }}">
                                        📄 {{ $project->page->title }} <span style="opacity: 0.7;">↗</span>
                                    </a>
                                    <div style="font-size: 11px; color: #94a3b8; margin-top: 3px; font-family: monospace;">
                                        /{{ ltrim($project->page->slug, '/') }}
                                    </div>
                                @else
                                    <span class="badge-pill" style="background: #fef2f2; color: #b91c1c; border: 1px solid #fecaca;">
                                        ⚠️ No Page Attached
                                    </span>
                                @endif
                            </td>

                            <!-- Price & Delivery Badges -->
                            <td style="padding:16px 12px;">
                                <div style="display: flex; flex-direction: column; gap: 4px; align-items: flex-start;">
                                    @if($project->price)
                                        <span class="badge-pill" style="background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0;">
                                            💰 {{ $project->price }}
                                        </span>
                                    @endif
                                    @if($project->delivery_date)
                                        <span class="badge-pill" style="background: #f8fafc; color: #475569; border: 1px solid #e2e8f0;">
                                            📅 {{ $project->delivery_date }}
                                        </span>
                                    @endif
                                </div>
                            </td>

                            <!-- Active Toggle -->
                            <td style="padding:16px 12px;">
                                <form method="POST" action="{{ route('admin.projects.toggle', $project) }}" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background: none; border: none; cursor: pointer; padding: 0;">
                                        @if($project->is_active)
                                            <span class="badge-pill" style="background: #dcfce7; color: #15803d; border: 1px solid #86efac; cursor: pointer;">
                                                ● Active
                                            </span>
                                        @else
                                            <span class="badge-pill" style="background: #f1f5f9; color: #94a3b8; border: 1px solid #cbd5e1; cursor: pointer;">
                                                ○ Hidden
                                            </span>
                                        @endif
                                    </button>
                                </form>
                            </td>

                            <!-- Actions -->
                            <td style="padding:16px 12px; text-align:right;">
                                <div style="display:inline-flex; align-items:center; justify-content:flex-end; gap:6px;">
                                    <!-- Edit Icon -->
                                    <button type="button" class="cms-action-btn" onclick="openEditModal({{ json_encode($project) }})" title="Edit Card">
                                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                        </svg>
                                    </button>

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
                            <td colspan="7" style="text-align:center; padding:40px; color:#94a3b8; font-size:14px;">
                                No property cards created yet. Click "+ Add Property Card" above to create one.
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
                <!-- Title -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Property Title <span style="color:#ef4444;">*</span></label>
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

                <!-- Location -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Location</label>
                    <input type="text" id="edit_location" name="location" class="adm-input" style="width: 100%; border-radius: 8px;">
                </div>

                <!-- Launch Price -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Launch Price</label>
                    <input type="text" id="edit_price" name="price" class="adm-input" style="width: 100%; border-radius: 8px;">
                </div>

                <!-- Delivery Date -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Delivery Date</label>
                    <input type="text" id="edit_delivery_date" name="delivery_date" class="adm-input" style="width: 100%; border-radius: 8px;">
                </div>

                <!-- Developer Badge -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Developer Badge</label>
                    <input type="text" id="edit_developer" name="developer" class="adm-input" style="width: 100%; border-radius: 8px;">
                </div>

                <!-- Payment Plan Badge -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Payment Plan Badge</label>
                    <input type="text" id="edit_payment_plan" name="payment_plan" class="adm-input" style="width: 100%; border-radius: 8px;">
                </div>

                <!-- Status -->
                <div>
                    <label style="display: block; font-size: 11.5px; font-weight: 700; color: #475569; margin-bottom: 5px; text-transform: uppercase;">Status</label>
                    <select id="edit_is_active" name="is_active" class="adm-input" style="width: 100%; border-radius: 8px;">
                        <option value="1">Active / Display on Home Page</option>
                        <option value="0">Hidden / Draft</option>
                    </select>
                </div>
            </div>

            <!-- Image Settings -->
            <div style="background: #f8fafc; border: 1px dashed #cbd5e1; border-radius: 10px; padding: 16px; margin-bottom: 20px;">
                <div style="font-size: 12px; font-weight: 700; color: #334155; margin-bottom: 8px;">Update Card Image</div>
                <div style="display: grid; grid-template-columns: 80px 1fr; gap: 14px; align-items: center;">
                    <div style="width: 80px; height: 55px; border-radius: 6px; overflow: hidden; background: #e2e8f0; border: 1px solid #cbd5e1;">
                        <img id="edit_preview_img" src="" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div>
                        <input type="file" name="image_file" accept="image/*" class="adm-input" style="width: 100%; font-size: 12px; margin-bottom: 6px;">
                        <input type="text" id="edit_image" name="image" placeholder="/images/communities/... or image URL" class="adm-input" style="width: 100%; font-size: 12px;">
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
        }
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
        document.getElementById('edit_location').value = project.location || '';
        document.getElementById('edit_price').value = project.price || '';
        document.getElementById('edit_delivery_date').value = project.delivery_date || '';
        document.getElementById('edit_developer').value = project.developer || '';
        document.getElementById('edit_payment_plan').value = project.payment_plan || '';
        document.getElementById('edit_image').value = project.image || '';
        document.getElementById('edit_is_active').value = project.is_active ? '1' : '0';
        document.getElementById('edit_preview_img').src = project.image || '/images/communities/wadeem-gardens.png';
        
        document.getElementById('editCardModal').style.display = 'flex';
    }

    function closeEditModal() {
        document.getElementById('editCardModal').style.display = 'none';
    }

    // Close on backdrop click
    document.getElementById('editCardModal')?.addEventListener('click', function(e) {
        if (e.target === this) closeEditModal();
    });
</script>
@endsection
