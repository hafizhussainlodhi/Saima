@extends('admin.layouts.app')

@section('title', 'Amenities')
@section('eyebrow', 'Home – Manage – Amenities')
@section('heading', 'Amenities')

@push('styles')
<style>
    .amenities-page-wrap {
        padding: 0 4px;
    }
    .amenities-card {
        background: #ffffff;
        border-radius: 14px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), 0 20px 25px -5px rgba(0, 0, 0, 0.02);
        border: 1px solid #f1f5f9;
        overflow: hidden;
        margin-top: 10px;
    }
    .amenities-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 28px 18px;
        gap: 16px;
        flex-wrap: wrap;
    }
    .amenities-search-box {
        position: relative;
        min-width: 260px;
        max-width: 380px;
        flex: 1;
    }
    .amenities-search-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        display: flex;
        align-items: center;
        pointer-events: none;
    }
    .amenities-search-input {
        width: 100%;
        padding: 11px 16px 11px 42px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        font-size: 13.5px;
        color: #1e293b;
        outline: none;
        transition: all 0.2s ease;
    }
    .amenities-search-input:focus {
        background: #ffffff;
        border-color: #0099ff;
        box-shadow: 0 0 0 3px rgba(0, 153, 255, 0.15);
    }
    .btn-add-amenities {
        background: #0099ff;
        color: #ffffff;
        font-weight: 600;
        font-size: 13px;
        padding: 10px 22px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(0, 153, 255, 0.25);
    }
    .btn-add-amenities:hover {
        background: #0088e6;
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(0, 153, 255, 0.35);
        color: #ffffff;
    }
    .amenities-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13.5px;
    }
    .amenities-table thead th {
        text-align: left;
        padding: 14px 28px;
        color: #94a3b8;
        font-weight: 600;
        font-size: 11px;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        border-bottom: 1px solid #f1f5f9;
        user-select: none;
    }
    .amenities-table thead th:last-child {
        text-align: right;
    }
    .amenities-table thead th.th-icon {
        text-align: center;
    }
    .amenities-table tbody td {
        padding: 20px 28px;
        vertical-align: middle;
        border-bottom: 1px solid #f8fafc;
        color: #475569;
    }
    .amenities-table tbody tr:hover td {
        background: #fafcff;
    }
    .amenities-table tbody tr:last-child td {
        border-bottom: none;
    }
    .amenity-num {
        color: #64748b;
        font-weight: 500;
        font-size: 13px;
        width: 60px;
    }
    .amenity-title {
        color: #1e293b;
        font-weight: 600;
        font-size: 14px;
    }
    .amenity-icon-cell {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .amenity-icon-preview {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0f172a;
    }
    .amenity-icon-preview svg {
        width: 38px;
        height: 38px;
        stroke: #0f172a;
        display: block;
    }
    .amenity-icon-preview img {
        width: 38px;
        height: 38px;
        object-fit: contain;
        display: block;
    }
    .amenity-actions {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 10px;
    }
    .btn-action-icon {
        background: transparent;
        border: none;
        color: #94a3b8;
        cursor: pointer;
        padding: 6px;
        border-radius: 6px;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-action-icon:hover {
        background: #f1f5f9;
        color: #0099ff;
    }
    .btn-action-icon.btn-delete:hover {
        background: #fef2f2;
        color: #ef4444;
    }

    /* Modal Styling */
    .amenity-modal-backdrop {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(4px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }
    .amenity-modal-backdrop.is-open {
        display: flex;
    }
    .amenity-modal-box {
        background: #ffffff;
        border-radius: 16px;
        width: 100%;
        max-width: 480px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        overflow: hidden;
        animation: modalSlideIn 0.2s ease-out;
    }
    @keyframes modalSlideIn {
        from { opacity: 0; transform: translateY(-12px) scale(0.97); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    .amenity-modal-header {
        padding: 20px 24px;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .amenity-modal-title {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .amenity-modal-close {
        background: transparent;
        border: none;
        font-size: 20px;
        color: #94a3b8;
        cursor: pointer;
        line-height: 1;
        padding: 4px;
        border-radius: 4px;
    }
    .amenity-modal-close:hover {
        color: #334155;
    }
    .amenity-modal-body {
        padding: 24px;
    }
    .amenity-modal-footer {
        padding: 16px 24px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }
    .svg-drop-zone {
        border: 2px dashed #cbd5e1;
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        background: #fafcff;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
    }
    .svg-drop-zone:hover, .svg-drop-zone.dragover {
        border-color: #0099ff;
        background: #f0f7ff;
    }
    .svg-live-preview {
        width: 64px;
        height: 64px;
        margin: 0 auto 10px;
        display: none;
        align-items: center;
        justify-content: center;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #ffffff;
        padding: 8px;
    }
    .svg-live-preview svg {
        width: 100%;
        height: 100%;
        stroke: #0f172a;
    }
    .svg-note-badge {
        display: inline-block;
        background: #eff6ff;
        color: #0284c7;
        font-size: 11px;
        font-weight: 600;
        padding: 3px 8px;
        border-radius: 6px;
        margin-top: 6px;
    }
</style>
@endpush

@section('actions')
    <button type="button" class="btn-add-amenities" onclick="openAddModal()">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.8" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Add Amenities
    </button>
@endsection

@section('content')
<div class="amenities-page-wrap">
    <div class="amenities-card">
        <!-- Toolbar: Search on left, count/button -->
        <div class="amenities-toolbar">
            <div class="amenities-search-box">
                <span class="amenities-search-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                <input type="text" id="amenitySearchInput" class="amenities-search-input" placeholder="Search..." oninput="filterAmenitiesTable(this.value)">
            </div>
            <div style="font-size: 13px; color: #64748b; font-weight: 500;">
                Showing <strong id="amenitiesCountDisplay" style="color: #0f172a;">{{ $amenities->count() }}</strong> amenities
            </div>
        </div>

        <!-- Table matching Image 1 & Image 2 -->
        <table class="amenities-table" id="amenitiesTable">
            <thead>
                <tr>
                    <th style="width: 70px;"># <span style="font-size: 10px; opacity: 0.6;">^</span></th>
                    <th>AMENITIES</th>
                    <th class="th-icon" style="width: 140px;">ICON</th>
                    <th style="width: 110px;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @forelse($amenities as $index => $item)
                    <tr class="amenity-row" data-name="{{ strtolower($item->name) }}" data-id="{{ $item->id }}">
                        <td class="amenity-num">{{ $index + 1 }}</td>
                        <td>
                            <span class="amenity-title">{{ $item->name }}</span>
                        </td>
                        <td class="th-icon">
                            <div class="amenity-icon-cell">
                                <div class="amenity-icon-preview">
                                    {!! $item->rendered_svg !!}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="amenity-actions">
                                <button type="button" class="btn-action-icon" title="Edit Amenity" 
                                        onclick="openEditModal({{ $item->id }}, '{{ addslashes($item->name) }}', '{{ $item->icon }}')">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L7 19l-4 1 1-4Z"></path>
                                    </svg>
                                </button>
                                <form method="POST" action="{{ route('admin.amenities.destroy', $item->id) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete \'{{ addslashes($item->name) }}\'? This will also automatically remove it from all CMS icon dropdowns.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action-icon btn-delete" title="Delete Amenity">
                                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M3 6h18"></path>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                                            <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr id="noAmenitiesRow">
                        <td colspan="4" style="text-align: center; padding: 48px 20px; color: #94a3b8;">
                            <div style="font-size: 15px; font-weight: 600; margin-bottom: 6px; color: #475569;">No Amenities Found</div>
                            <p style="font-size: 13px; margin: 0 0 14px;">Click the button below to upload your first amenity with an SVG icon.</p>
                            <button type="button" class="btn-add-amenities" onclick="openAddModal()">+ Add Amenities</button>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ================= ADD AMENITY MODAL ================= -->
<div class="amenity-modal-backdrop" id="addAmenityModal" onclick="if(event.target === this) closeAddModal()">
    <div class="amenity-modal-box">
        <div class="amenity-modal-header">
            <h3 class="amenity-modal-title">Add Amenities</h3>
            <button type="button" class="amenity-modal-close" onclick="closeAddModal()">&times;</button>
        </div>
        <form method="POST" action="{{ route('admin.amenities.store') }}" enctype="multipart/form-data" id="addAmenityForm" onsubmit="return validateSvgBeforeSubmit(this, 'add_icon_file')">
            @csrf
            <div class="amenity-modal-body">
                <div class="adm-field" style="margin-bottom: 18px;">
                    <label class="adm-label" for="add_name" style="font-weight: 600; color: #1e293b; margin-bottom: 6px;">Amenity Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="add_name" required class="adm-input" placeholder="e.g. Banquet Hall, Swimming Pool..." style="width: 100%; font-size: 13.5px; padding: 9px 12px; border-radius: 8px;">
                </div>

                <div class="adm-field">
                    <label class="adm-label" style="font-weight: 600; color: #1e293b; margin-bottom: 6px;">Upload SVG Icon <span style="color:#ef4444;">*</span></label>
                    
                    <div class="svg-drop-zone" id="add_drop_zone" onclick="document.getElementById('add_icon_file').click()">
                        <div class="svg-live-preview" id="add_svg_preview_box"></div>
                        <div id="add_drop_prompt">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin: 0 auto 8px; display: block;">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                            <span style="font-size: 13px; font-weight: 600; color: #0099ff;">Click to upload SVG</span>
                            <span style="font-size: 12px; color: #64748b; display: block; margin-top: 2px;">or drag and drop your .svg file here</span>
                        </div>
                        <input type="file" name="icon" id="add_icon_file" accept=".svg,image/svg+xml" required style="display: none;" onchange="handleSvgFileSelected(this, 'add_svg_preview_box', 'add_drop_prompt')">
                    </div>
                    <div style="margin-top: 8px; display: flex; align-items: center; justify-content: space-between;">
                        <span class="svg-note-badge">NOTE: Only SVG files (.svg) allowed</span>
                        <span style="font-size: 11px; color: #94a3b8;">Auto-syncs to CMS dropdowns</span>
                    </div>
                </div>
            </div>
            <div class="amenity-modal-footer">
                <button type="button" class="adm-btn adm-btn-secondary" onclick="closeAddModal()" style="font-size: 13px;">Cancel</button>
                <button type="submit" class="btn-add-amenities" style="padding: 8px 20px;">Save Amenity</button>
            </div>
        </form>
    </div>
</div>

<!-- ================= EDIT AMENITY MODAL ================= -->
<div class="amenity-modal-backdrop" id="editAmenityModal" onclick="if(event.target === this) closeEditModal()">
    <div class="amenity-modal-box">
        <div class="amenity-modal-header">
            <h3 class="amenity-modal-title">Edit Amenity</h3>
            <button type="button" class="amenity-modal-close" onclick="closeEditModal()">&times;</button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" id="editAmenityForm" onsubmit="return validateSvgBeforeSubmit(this, 'edit_icon_file', false)">
            @csrf
            @method('PUT')
            <div class="amenity-modal-body">
                <div class="adm-field" style="margin-bottom: 18px;">
                    <label class="adm-label" for="edit_name" style="font-weight: 600; color: #1e293b; margin-bottom: 6px;">Amenity Name <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="name" id="edit_name" required class="adm-input" style="width: 100%; font-size: 13.5px; padding: 9px 12px; border-radius: 8px;">
                </div>

                <div class="adm-field">
                    <label class="adm-label" style="font-weight: 600; color: #1e293b; margin-bottom: 6px;">SVG Icon (Upload to replace existing)</label>
                    
                    <div style="display: flex; gap: 14px; align-items: center; margin-bottom: 12px; padding: 10px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                        <div style="font-size: 12px; font-weight: 600; color: #64748b;">Current Icon:</div>
                        <div id="edit_current_icon_preview" style="width: 36px; height: 36px; display: flex; align-items: center; justify-content: center;"></div>
                    </div>

                    <div class="svg-drop-zone" id="edit_drop_zone" onclick="document.getElementById('edit_icon_file').click()">
                        <div class="svg-live-preview" id="edit_svg_preview_box"></div>
                        <div id="edit_drop_prompt">
                            <span style="font-size: 13px; font-weight: 600; color: #0099ff;">Click to replace with new SVG</span>
                            <span style="font-size: 12px; color: #64748b; display: block; margin-top: 2px;">Leave blank to keep existing icon</span>
                        </div>
                        <input type="file" name="icon" id="edit_icon_file" accept=".svg,image/svg+xml" style="display: none;" onchange="handleSvgFileSelected(this, 'edit_svg_preview_box', 'edit_drop_prompt')">
                    </div>
                    <div style="margin-top: 8px;">
                        <span class="svg-note-badge">NOTE: Only SVG files (.svg) allowed</span>
                    </div>
                </div>
            </div>
            <div class="amenity-modal-footer">
                <button type="button" class="adm-btn adm-btn-secondary" onclick="closeEditModal()" style="font-size: 13px;">Cancel</button>
                <button type="submit" class="btn-add-amenities" style="padding: 8px 20px;">Update Amenity</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Live Search Filter
    function filterAmenitiesTable(query) {
        const q = (query || '').toLowerCase().trim();
        const rows = document.querySelectorAll('#amenitiesTable tbody tr.amenity-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const name = row.getAttribute('data-name') || '';
            if (!q || name.includes(q)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const countEl = document.getElementById('amenitiesCountDisplay');
        if (countEl) countEl.textContent = visibleCount;
    }

    // Modal Controls
    function openAddModal() {
        const modal = document.getElementById('addAmenityModal');
        modal.classList.add('is-open');
        document.getElementById('add_name').value = '';
        document.getElementById('add_icon_file').value = '';
        document.getElementById('add_svg_preview_box').style.display = 'none';
        document.getElementById('add_svg_preview_box').innerHTML = '';
        document.getElementById('add_drop_prompt').style.display = 'block';
        setTimeout(() => document.getElementById('add_name').focus(), 100);
    }

    function closeAddModal() {
        document.getElementById('addAmenityModal').classList.remove('is-open');
    }

    function openEditModal(id, name, iconUrl) {
        const modal = document.getElementById('editAmenityModal');
        const form = document.getElementById('editAmenityForm');
        form.action = '/admin/amenities/' + id;

        document.getElementById('edit_name').value = name;
        document.getElementById('edit_icon_file').value = '';
        document.getElementById('edit_svg_preview_box').style.display = 'none';
        document.getElementById('edit_svg_preview_box').innerHTML = '';
        document.getElementById('edit_drop_prompt').style.display = 'block';

        const curBox = document.getElementById('edit_current_icon_preview');
        curBox.innerHTML = '<img src="' + iconUrl + '" style="width:34px;height:34px;object-fit:contain;" alt="">';

        modal.classList.add('is-open');
        setTimeout(() => document.getElementById('edit_name').focus(), 100);
    }

    function closeEditModal() {
        document.getElementById('editAmenityModal').classList.remove('is-open');
    }

    // Strict SVG File Handling & Instant Preview
    function handleSvgFileSelected(input, previewBoxId, promptBoxId) {
        const file = input.files && input.files[0];
        if (!file) return;

        // Strict extension validation: .svg only!
        const fileName = file.name.toLowerCase();
        if (!fileName.endsWith('.svg')) {
            alert('NOTE: Only SVG files (.svg) are allowed for amenities icon. Please select a valid .svg file.');
            input.value = '';
            return;
        }

        const previewBox = document.getElementById(previewBoxId);
        const promptBox = document.getElementById(promptBoxId);

        const reader = new FileReader();
        reader.onload = function(e) {
            const content = e.target.result;
            if (content.includes('<svg')) {
                previewBox.innerHTML = content;
                previewBox.style.display = 'flex';
                promptBox.style.display = 'none';
            } else {
                alert('The selected file does not appear to be a valid SVG vector. Please choose another .svg file.');
                input.value = '';
            }
        };
        reader.readAsText(file);
    }

    function validateSvgBeforeSubmit(form, fileInputId, isRequired = true) {
        const input = document.getElementById(fileInputId);
        if (isRequired && (!input.files || !input.files[0])) {
            alert('Please select an SVG icon file.');
            return false;
        }
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name.toLowerCase();
            if (!fileName.endsWith('.svg')) {
                alert('NOTE: Only SVG files (.svg) are allowed.');
                return false;
            }
        }
        return true;
    }

    // Drag and Drop support on drop zones
    ['add_drop_zone', 'edit_drop_zone'].forEach(zoneId => {
        const zone = document.getElementById(zoneId);
        if (!zone) return;

        zone.addEventListener('dragover', (e) => {
            e.preventDefault();
            zone.classList.add('dragover');
        });
        zone.addEventListener('dragleave', () => zone.classList.remove('dragover'));
        zone.addEventListener('drop', (e) => {
            e.preventDefault();
            zone.classList.remove('dragover');
            const fileInput = zone.querySelector('input[type="file"]');
            if (e.dataTransfer.files && e.dataTransfer.files[0]) {
                fileInput.files = e.dataTransfer.files;
                const previewBoxId = zoneId === 'add_drop_zone' ? 'add_svg_preview_box' : 'edit_svg_preview_box';
                const promptBoxId = zoneId === 'add_drop_zone' ? 'add_drop_prompt' : 'edit_drop_prompt';
                handleSvgFileSelected(fileInput, previewBoxId, promptBoxId);
            }
        });
    });

    // ESC key closes modals
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeAddModal();
            closeEditModal();
        }
    });
</script>
@endpush
@endsection
