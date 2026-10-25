@extends('admin.layouts.app')

@section('title', 'Footer & Newsletter')
@section('eyebrow', 'Site Settings')
@section('heading', 'Footer & Newsletter Configuration')
@section('subheading', 'Customize the public footer columns, brand intro, navigation links with drag-and-drop, and bottom bar.')

@section('content')
<div class="adm-card" style="max-width: 1100px; margin: 0 auto; padding: 24px;">
    @if(session('success'))
        <div class="adm-alert adm-alert-success" style="margin-bottom: 20px;">
            @include('admin.partials.icon', ['name' => 'check'])
            <div>{{ session('success') }}</div>
        </div>
    @endif

    @php
        $activeTab = request()->query('tab', 'columns');
    @endphp

    <!-- 1. TABS HEADER (Matching Image 2) -->
    <div style="display: flex; gap: 8px; border-bottom: 1.5px solid #e5e7eb; margin-bottom: 24px; padding-bottom: 2px; overflow-x: auto;">
        <button type="button" class="footer-tab-btn {{ $activeTab === 'brand' ? 'is-active' : '' }}" onclick="switchFooterTab('brand')" id="tabBtn-brand">
            @include('admin.partials.icon', ['name' => 'spark'])
            <span>Brand &amp; Newsletter</span>
        </button>
        <button type="button" class="footer-tab-btn {{ $activeTab === 'social' ? 'is-active' : '' }}" onclick="switchFooterTab('social')" id="tabBtn-social">
            @include('admin.partials.icon', ['name' => 'globe'])
            <span>Social Links</span>
        </button>
        <button type="button" class="footer-tab-btn {{ $activeTab === 'columns' ? 'is-active' : '' }}" onclick="switchFooterTab('columns')" id="tabBtn-columns">
            @include('admin.partials.icon', ['name' => 'panels'])
            <span>Footer Columns</span>
        </button>
        <button type="button" class="footer-tab-btn {{ $activeTab === 'bottom' ? 'is-active' : '' }}" onclick="switchFooterTab('bottom')" id="tabBtn-bottom">
            @include('admin.partials.icon', ['name' => 'list'])
            <span>Bottom Bar</span>
        </button>
    </div>

    <form method="POST" action="{{ route('admin.footer.update') }}" id="footerForm">
        @csrf
        @method('PUT')
        <input type="hidden" name="active_tab" id="activeTabInput" value="{{ $activeTab }}">

        <!-- ==================== TAB 1: BRAND & NEWSLETTER ==================== -->
        <div id="tabContent-brand" class="footer-tab-pane" style="display: {{ $activeTab === 'brand' ? 'block' : 'none' }};">
            <div style="background: #faf8f5; border: 1px solid #ede8e1; border-radius: 8px; padding: 20px; margin-bottom: 24px;">
                <h4 style="margin: 0 0 14px 0; font-size: 16px; font-weight: 700; color: #1f2937;">Brand Identity Column</h4>
                
                <div class="adm-field">
                    <label class="adm-label" for="brandTitle">Brand Heading / Text <span style="color:#ef4444">*</span></label>
                    <input type="text" name="brand_title" id="brandTitle" value="{{ old('brand_title', $footer->brand_title ?? 'Saima') }}" class="adm-input" required placeholder="e.g. Saima">
                </div>

                <div class="adm-field" style="margin-top: 14px;">
                    <label class="adm-label" for="brandDescription">Brand Description Paragraph</label>
                    <textarea name="brand_description" id="brandDescription" class="adm-textarea" rows="4" placeholder="Brief company summary in footer">{{ old('brand_description', $footer->brand_description) }}</textarea>
                    <span class="adm-help">Displayed on the left column in the global footer.</span>
                </div>
            </div>

            <div style="background: #faf8f5; border: 1px solid #ede8e1; border-radius: 8px; padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                    <h4 style="margin: 0; font-size: 16px; font-weight: 700; color: #1f2937;">Newsletter Subscription</h4>
                    <label class="adm-check" style="cursor: pointer; font-weight: 600;">
                        <input type="checkbox" name="newsletter_enabled" value="1" {{ old('newsletter_enabled', $footer->newsletter_enabled) ? 'checked' : '' }}>
                        Enable Newsletter Box
                    </label>
                </div>

                <div class="adm-field">
                    <label class="adm-label" for="newsTitle">Newsletter Title</label>
                    <input type="text" name="newsletter_title" id="newsTitle" value="{{ old('newsletter_title', $footer->newsletter_title) }}" class="adm-input" placeholder="Subscribe to Our Newsletter">
                </div>

                <div class="adm-field" style="margin-top: 14px;">
                    <label class="adm-label" for="newsSubtitle">Newsletter Subtitle</label>
                    <input type="text" name="newsletter_subtitle" id="newsSubtitle" value="{{ old('newsletter_subtitle', $footer->newsletter_subtitle) }}" class="adm-input" placeholder="Get latest updates and property offers delivered to your inbox.">
                </div>
            </div>
        </div>

        <!-- ==================== TAB 2: SOCIAL LINKS ==================== -->
        <div id="tabContent-social" class="footer-tab-pane" style="display: {{ $activeTab === 'social' ? 'block' : 'none' }};">
            <div style="background: #faf8f5; border: 1px solid #ede8e1; border-radius: 8px; padding: 20px;">
                <h4 style="margin: 0 0 14px 0; font-size: 16px; font-weight: 700; color: #1f2937;">Social Media Channels</h4>
                <p style="font-size: 13.5px; color: #6b7280; margin: 0 0 18px 0;">Enter the destination URLs for the social profile links in the footer.</p>

                @php
                    $platforms = [
                        'facebook' => 'Facebook URL',
                        'instagram' => 'Instagram URL',
                        'twitter' => 'X / Twitter URL',
                        'linkedin' => 'LinkedIn URL',
                        'whatsapp' => 'WhatsApp Number / Link',
                        'youtube' => 'YouTube Channel URL'
                    ];
                    $savedSocial = [];
                    foreach($footer->social_links ?? [] as $s) {
                        if (!empty($s['platform'])) {
                            $savedSocial[$s['platform']] = $s['url'] ?? '';
                        }
                    }
                @endphp

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;">
                    @foreach($platforms as $pKey => $pLabel)
                        <div class="adm-field">
                            <label class="adm-label" style="text-transform: capitalize;">{{ $pLabel }}</label>
                            <input type="hidden" name="social_links[{{ $loop->index }}][platform]" value="{{ $pKey }}">
                            <input type="text" name="social_links[{{ $loop->index }}][url]" value="{{ old('social_links.'.$loop->index.'.url', $savedSocial[$pKey] ?? '') }}" class="adm-input" placeholder="https://{{ $pKey }}.com/...">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- ==================== TAB 3: FOOTER COLUMNS & DRAG-DROP LINKS (Matching Image 2 & 3) ==================== -->
        <div id="tabContent-columns" class="footer-tab-pane" style="display: {{ $activeTab === 'columns' ? 'block' : 'none' }};">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
                <div>
                    <h4 style="margin: 0; font-size: 17px; font-weight: 700; color: #111827;">Footer Columns &amp; Navigation Links</h4>
                    <p style="margin: 4px 0 0 0; font-size: 13px; color: #6b7280;">Manage column headings and drag &amp; drop links up or down to reorder them.</p>
                </div>
                <button type="button" class="adm-btn adm-btn-secondary" onclick="addNewColumn()" style="font-size: 13px; padding: 7px 14px;">
                    @include('admin.partials.icon', ['name' => 'plus']) Add New Column
                </button>
            </div>

            <div id="columnsContainer" style="display: flex; flex-direction: column; gap: 20px;">
                @php
                    $columns = $footer->columns ?? \App\Models\FooterSection::defaultColumns();
                @endphp

                @foreach($columns as $cIdx => $column)
                    <div class="footer-col-card" data-col-index="{{ $cIdx }}" style="background: #ffffff; border: 1.5px solid #e5e7eb; border-radius: 10px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f3f4f6; padding-bottom: 10px;">
                            <div style="font-size: 15px; font-weight: 700; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                                <span class="adm-chip" style="background: #ede8e1; color: #1a4731; font-weight: 700; font-size: 11px;">Column {{ $cIdx + 1 }}</span>
                                <span class="col-title-preview">{{ $column['header'] ?? 'Column Header' }}</span>
                            </div>
                            @if(count($columns) > 1)
                                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="removeColumn(this)" style="color: #ef4444; font-size: 12px; padding: 3px 8px;">
                                    @include('admin.partials.icon', ['name' => 'trash']) Remove Column
                                </button>
                            @endif
                        </div>

                        <!-- Column Header Input -->
                        <div class="adm-field" style="margin-bottom: 16px;">
                            <label class="adm-label" style="font-weight: 600;">Column {{ $cIdx + 1 }} Header <span style="color:#ef4444">*</span></label>
                            <input type="text" name="columns[{{ $cIdx }}][header]" value="{{ $column['header'] ?? '' }}" class="adm-input col-header-input" oninput="updateColHeaderPreview(this)" required placeholder="e.g. About Hudayriyat">
                        </div>

                        <!-- Column Links Container with Drag & Drop -->
                        <div style="margin-top: 12px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <label style="font-size: 12.5px; font-weight: 700; color: #4b5563; text-transform: uppercase; letter-spacing: 0.5px;">Column Links</label>
                                <span style="font-size: 11.5px; color: #9ca3af;">Drag handle (↕) to reorder</span>
                            </div>

                            <div class="links-sortable-list" data-col-index="{{ $cIdx }}" style="display: flex; flex-direction: column; gap: 8px;">
                                @foreach($column['links'] ?? [] as $lIdx => $link)
                                    <div class="link-sortable-row" draggable="true" style="display: grid; grid-template-columns: 28px 1fr 1fr 34px; gap: 10px; align-items: center; background: #fafafa; border: 1px solid #e5e7eb; border-radius: 6px; padding: 8px 10px; cursor: move;">
                                        <!-- Drag Handle -->
                                        <div class="link-drag-handle" title="Drag to reorder" style="cursor: grab; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
                                            <span style="font-size: 16px; font-weight: bold; user-select: none;">↕</span>
                                        </div>

                                        <!-- Label -->
                                        <div>
                                            <label style="font-size: 10.5px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 2px;">Label <span style="color:#ef4444">*</span></label>
                                            <input type="text" name="columns[{{ $cIdx }}][links][{{ $lIdx }}][label]" value="{{ $link['label'] ?? '' }}" class="adm-input link-label-input" required placeholder="Link text" style="padding: 6px 10px; font-size: 13px; background: #fff;">
                                        </div>

                                        <!-- URL -->
                                        <div>
                                            <label style="font-size: 10.5px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 2px;">URL <span style="color:#ef4444">*</span></label>
                                            <input type="text" name="columns[{{ $cIdx }}][links][{{ $lIdx }}][url]" value="{{ $link['url'] ?? '' }}" class="adm-input link-url-input" required placeholder="/page-url" style="padding: 6px 10px; font-size: 13px; background: #fff; font-family: monospace;">
                                        </div>

                                        <!-- Delete Link Button -->
                                        <div style="padding-top: 16px; text-align: center;">
                                            <button type="button" class="adm-btn adm-btn-ghost adm-btn-icon" onclick="deleteLinkRow(this)" title="Delete Link" style="color: #ef4444; padding: 4px;">
                                                @include('admin.partials.icon', ['name' => 'trash', 'size' => 14])
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addLinkRow({{ $cIdx }}, this)" style="margin-top: 10px; font-size: 12.5px; padding: 5px 12px; color: #1a4731; border-color: #ede8e1;">
                                @include('admin.partials.icon', ['name' => 'plus', 'size' => 12]) Add Link to this Column
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ==================== TAB 4: BOTTOM BAR (Image 3) ==================== -->
        <div id="tabContent-bottom" class="footer-tab-pane" style="display: {{ $activeTab === 'bottom' ? 'block' : 'none' }};">
            <div style="background: #faf8f5; border: 1px solid #ede8e1; border-radius: 8px; padding: 20px;">
                <h4 style="margin: 0 0 14px 0; font-size: 16px; font-weight: 700; color: #1f2937;">Bottom Bar &amp; Legal Notices</h4>

                <div class="adm-field">
                    <label class="adm-label" for="disclaimerText">Disclaimer Notice</label>
                    <textarea name="disclaimer_text" id="disclaimerText" class="adm-textarea" rows="4" placeholder="Full disclaimer text appearing at the very bottom">{{ old('disclaimer_text', $footer->disclaimer_text) }}</textarea>
                    <span class="adm-help">Displayed in the bottom bar in small font matching Image 3.</span>
                </div>

                <div class="adm-field" style="margin-top: 16px;">
                    <label class="adm-label" for="copyrightText">Copyright Text</label>
                    <input type="text" name="copyright_text" id="copyrightText" value="{{ old('copyright_text', $footer->copyright_text) }}" class="adm-input" placeholder="© 2026 hudayriyat-island.ae All Rights Reserved.">
                </div>
            </div>
        </div>

        <!-- Form Action Buttons -->
        <div style="display: flex; gap: 12px; margin-top: 24px; padding-top: 16px; border-top: 1.5px solid #f0ede8;">
            <button type="submit" class="adm-btn adm-btn-primary" style="padding: 12px 26px; font-size: 14.5px; font-weight: 700;">
                @include('admin.partials.icon', ['name' => 'check']) Save Footer Settings
            </button>
            <a href="{{ route('admin.dashboard') }}" class="adm-btn adm-btn-ghost" style="padding: 12px 20px;">Cancel</a>
        </div>
    </form>
</div>

<style>
/* Tab Button Styling (Matching Image 1 & 2) */
.footer-tab-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 18px;
    font-size: 13.5px;
    font-weight: 600;
    color: #4b5563;
    background: transparent;
    border: none;
    border-bottom: 2.5px solid transparent;
    cursor: pointer;
    border-radius: 6px 6px 0 0;
    transition: all 0.2s ease;
}
.footer-tab-btn:hover {
    color: #1a4731;
    background: #faf8f5;
}
.footer-tab-btn.is-active {
    color: #6366f1;
    background: #f5f3ff;
    border-bottom-color: #6366f1;
    font-weight: 700;
}
.link-sortable-row.is-dragging {
    opacity: 0.35;
    border: 2px dashed #6366f1;
    background: #faf5ff;
}
.link-sortable-row.drag-over {
    border-top: 2px solid #6366f1;
}
</style>

<script>
// Switch active tab
function switchFooterTab(tabName) {
    document.querySelectorAll('.footer-tab-pane').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.footer-tab-btn').forEach(btn => btn.classList.remove('is-active'));

    const activePane = document.getElementById('tabContent-' + tabName);
    const activeBtn = document.getElementById('tabBtn-' + tabName);
    if (activePane) activePane.style.display = 'block';
    if (activeBtn) activeBtn.classList.add('is-active');

    document.getElementById('activeTabInput').value = tabName;
}

// Update Column title preview in card header
function updateColHeaderPreview(input) {
    const card = input.closest('.footer-col-card');
    const preview = card.querySelector('.col-title-preview');
    if (preview) {
        preview.textContent = input.value.trim() || 'Column Header';
    }
}

// Add new Link row to specific column
function addLinkRow(colIdx, btn) {
    const list = btn.previousElementSibling;
    const newIdx = list.querySelectorAll('.link-sortable-row').length;

    const row = document.createElement('div');
    row.className = 'link-sortable-row';
    row.draggable = true;
    row.style.cssText = 'display: grid; grid-template-columns: 28px 1fr 1fr 34px; gap: 10px; align-items: center; background: #fafafa; border: 1px solid #e5e7eb; border-radius: 6px; padding: 8px 10px; cursor: move;';

    row.innerHTML = `
        <div class="link-drag-handle" title="Drag to reorder" style="cursor: grab; display: flex; align-items: center; justify-content: center; color: #9ca3af;">
            <span style="font-size: 16px; font-weight: bold; user-select: none;">↕</span>
        </div>
        <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 2px;">Label <span style="color:#ef4444">*</span></label>
            <input type="text" name="columns[${colIdx}][links][${newIdx}][label]" class="adm-input link-label-input" required placeholder="New Link" style="padding: 6px 10px; font-size: 13px; background: #fff;">
        </div>
        <div>
            <label style="font-size: 10.5px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 2px;">URL <span style="color:#ef4444">*</span></label>
            <input type="text" name="columns[${colIdx}][links][${newIdx}][url]" class="adm-input link-url-input" required placeholder="/url" style="padding: 6px 10px; font-size: 13px; background: #fff; font-family: monospace;">
        </div>
        <div style="padding-top: 16px; text-align: center;">
            <button type="button" class="adm-btn adm-btn-ghost adm-btn-icon" onclick="deleteLinkRow(this)" title="Delete Link" style="color: #ef4444; padding: 4px;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
            </button>
        </div>
    `;

    list.appendChild(row);
    bindDragEvents(row);
    row.querySelector('.link-label-input').focus();
}

// Delete link row
function deleteLinkRow(btn) {
    const row = btn.closest('.link-sortable-row');
    const list = row.closest('.links-sortable-list');
    row.remove();
    reindexLinks(list);
}

// Add New Column
function addNewColumn() {
    const container = document.getElementById('columnsContainer');
    const newColIdx = container.querySelectorAll('.footer-col-card').length;

    const card = document.createElement('div');
    card.className = 'footer-col-card';
    card.setAttribute('data-col-index', newColIdx);
    card.style.cssText = 'background: #ffffff; border: 1.5px solid #e5e7eb; border-radius: 10px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.02);';

    card.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px; border-bottom: 1px solid #f3f4f6; padding-bottom: 10px;">
            <div style="font-size: 15px; font-weight: 700; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                <span class="adm-chip" style="background: #ede8e1; color: #1a4731; font-weight: 700; font-size: 11px;">Column ${newColIdx + 1}</span>
                <span class="col-title-preview">New Column</span>
            </div>
            <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="removeColumn(this)" style="color: #ef4444; font-size: 12px; padding: 3px 8px;">
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg> Remove Column
            </button>
        </div>
        <div class="adm-field" style="margin-bottom: 16px;">
            <label class="adm-label" style="font-weight: 600;">Column ${newColIdx + 1} Header <span style="color:#ef4444">*</span></label>
            <input type="text" name="columns[${newColIdx}][header]" value="New Section" class="adm-input col-header-input" oninput="updateColHeaderPreview(this)" required placeholder="e.g. Quick Links">
        </div>
        <div style="margin-top: 12px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                <label style="font-size: 12.5px; font-weight: 700; color: #4b5563; text-transform: uppercase;">Column Links</label>
                <span style="font-size: 11.5px; color: #9ca3af;">Drag handle (↕) to reorder</span>
            </div>
            <div class="links-sortable-list" data-col-index="${newColIdx}" style="display: flex; flex-direction: column; gap: 8px;">
                <div class="link-sortable-row" draggable="true" style="display: grid; grid-template-columns: 28px 1fr 1fr 34px; gap: 10px; align-items: center; background: #fafafa; border: 1px solid #e5e7eb; border-radius: 6px; padding: 8px 10px; cursor: move;">
                    <div class="link-drag-handle" title="Drag to reorder" style="cursor: grab; display: flex; align-items: center; justify-content: center; color: #9ca3af;"><span style="font-size: 16px; font-weight: bold;">↕</span></div>
                    <div><label style="font-size: 10.5px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 2px;">Label *</label><input type="text" name="columns[${newColIdx}][links][0][label]" value="Sample Link" class="adm-input link-label-input" required style="padding: 6px 10px; font-size: 13px; background: #fff;"></div>
                    <div><label style="font-size: 10.5px; font-weight: 600; color: #6b7280; display: block; margin-bottom: 2px;">URL *</label><input type="text" name="columns[${newColIdx}][links][0][url]" value="/" class="adm-input link-url-input" required style="padding: 6px 10px; font-size: 13px; background: #fff; font-family: monospace;"></div>
                    <div style="padding-top: 16px; text-align: center;"><button type="button" class="adm-btn adm-btn-ghost adm-btn-icon" onclick="deleteLinkRow(this)" style="color: #ef4444; padding: 4px;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/></svg></button></div>
                </div>
            </div>
            <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="addLinkRow(${newColIdx}, this)" style="margin-top: 10px; font-size: 12.5px; padding: 5px 12px; color: #1a4731; border-color: #ede8e1;">
                + Add Link to this Column
            </button>
        </div>
    `;

    container.appendChild(card);
    card.querySelectorAll('.link-sortable-row').forEach(bindDragEvents);
}

// Remove column
function removeColumn(btn) {
    if (!confirm('Are you sure you want to remove this entire column?')) return;
    const card = btn.closest('.footer-col-card');
    card.remove();
    reindexColumns();
}

// Re-index link inputs within a column so array serialization is sequential
function reindexLinks(list) {
    const colIdx = list.getAttribute('data-col-index');
    list.querySelectorAll('.link-sortable-row').forEach((row, lIdx) => {
        row.querySelector('.link-label-input').name = `columns[${colIdx}][links][${lIdx}][label]`;
        row.querySelector('.link-url-input').name = `columns[${colIdx}][links][${lIdx}][url]`;
    });
}

function reindexColumns() {
    const container = document.getElementById('columnsContainer');
    container.querySelectorAll('.footer-col-card').forEach((card, cIdx) => {
        card.setAttribute('data-col-index', cIdx);
        card.querySelector('.col-header-input').name = `columns[${cIdx}][header]`;
        const list = card.querySelector('.links-sortable-list');
        list.setAttribute('data-col-index', cIdx);
        reindexLinks(list);
    });
}

// Drag & Drop Reordering Logic
let draggedRow = null;

function bindDragEvents(row) {
    row.addEventListener('dragstart', function(e) {
        draggedRow = this;
        this.classList.add('is-dragging');
        e.dataTransfer.effectAllowed = 'move';
    });

    row.addEventListener('dragend', function() {
        this.classList.remove('is-dragging');
        document.querySelectorAll('.link-sortable-row').forEach(r => r.classList.remove('drag-over'));
        const list = this.closest('.links-sortable-list');
        if (list) reindexLinks(list);
        draggedRow = null;
    });

    row.addEventListener('dragover', function(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        if (draggedRow && draggedRow !== this && draggedRow.parentNode === this.parentNode) {
            this.classList.add('drag-over');
        }
    });

    row.addEventListener('dragleave', function() {
        this.classList.remove('drag-over');
    });

    row.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('drag-over');
        if (draggedRow && draggedRow !== this && draggedRow.parentNode === this.parentNode) {
            const list = this.parentNode;
            const rows = Array.from(list.children);
            const draggedIdx = rows.indexOf(draggedRow);
            const targetIdx = rows.indexOf(this);

            if (draggedIdx < targetIdx) {
                list.insertBefore(draggedRow, this.nextSibling);
            } else {
                list.insertBefore(draggedRow, this);
            }
            reindexLinks(list);
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.link-sortable-row').forEach(bindDragEvents);
});
</script>
@endsection
