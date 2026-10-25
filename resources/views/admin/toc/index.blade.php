@extends('admin.layouts.app')

@section('title', 'Table of Contents & Article Sections')
@section('eyebrow', 'Editorial & Navigation')
@section('heading', 'Table of Contents')
@section('subheading', 'Drag & drop to reorder article sections. Click Edit on any item to view and update its full section content.')

@section('content')
<div class="adm-grid adm-grid-toc" style="grid-template-columns: minmax(420px, 1.1fr) minmax(460px, 1.3fr); gap: 24px; align-items: start;">
    <!-- Left Column: TOC Items List with Drag & Drop Reordering -->
    <div class="adm-card">
        <div class="adm-card-head" style="display:flex; justify-content:space-between; align-items:center;">
            <div>
                <h2>TOC Structure & Sections</h2>
                <p>Drag any item up or down using the handle (<span style="color:#1a4731; font-weight:bold;">⋮⋮</span>) to reorder.</p>
            </div>
            <div style="display:flex; gap:8px; align-items:center;">
                <span id="reorderStatus" class="adm-chip" style="display:none; background:#ecfdf5; color:#047857; font-weight:600;">Saved ✓</span>
                <span class="adm-chip">{{ $items->count() }} main sections</span>
            </div>
        </div>

        <div class="adm-card-body" style="padding: 16px 20px;">
            @if($items->isEmpty())
                <div class="adm-empty">
                    @include('admin.partials.icon', ['name' => 'list'])
                    <h3>No TOC items found</h3>
                    <p>Add your first Table of Contents link using the editor on the right.</p>
                </div>
            @else
                <ol class="adm-toc-list" id="sortableTocList" style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:10px;">
                    @foreach($items as $index => $item)
                        <li class="adm-toc-item {{ !$item->is_active ? 'is-hidden' : '' }} {{ optional($editing)->id === $item->id ? 'is-editing' : '' }}"
                            draggable="true"
                            data-id="{{ $item->id }}"
                            data-order="{{ $item->order }}"
                            style="cursor: default; transition: all 0.2s ease; border-radius: 8px; border: 1px solid {{ optional($editing)->id === $item->id ? '#1a4731' : '#e5e7eb' }}; background: {{ optional($editing)->id === $item->id ? '#fffaf4' : '#ffffff' }}; box-shadow: {{ optional($editing)->id === $item->id ? '0 0 0 2px rgba(26,71,49,0.2)' : '0 1px 3px rgba(0,0,0,0.03)' }};">
                            
                            <!-- Drag Handle -->
                            <div class="adm-drag-handle" title="Drag to reorder" style="cursor: grab; padding: 10px 10px; color: #9ca3af; display: flex; align-items: center; justify-content: center; user-select: none;">
                                @include('admin.partials.icon', ['name' => 'grip'])
                            </div>

                            <!-- Number Badge -->
                            <div class="adm-toc-num" style="min-width:32px; height:32px; border-radius:6px; background:#f5efe6; color:#1a4731; font-weight:700; display:flex; align-items:center; justify-content:center; font-size:13px;">
                                {{ $index + 1 }}
                            </div>

                            <!-- Body / Title & Anchor -->
                            <div class="adm-toc-body" style="flex: 1; min-width: 0; padding: 0 10px;">
                                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                    <a href="{{ route('admin.toc.index', ['edit' => $item->id]) }}" style="text-decoration:none; color:#111827; font-weight:700; font-size:14.5px;" title="Click to edit section">
                                        {{ $item->title }}
                                    </a>
                                    @if(!empty(trim($item->content ?? '')))
                                        <span class="adm-chip" style="font-size:10px; padding:2px 7px; background:#fef3c7; color:#92400e; border:1px solid #fde68a;">Custom Content</span>
                                    @endif
                                    @if(!empty($item->image))
                                        <span class="adm-chip" style="font-size:10px; padding:2px 7px; background:#ecfdf5; color:#047857; border:1px solid #a7f3d0; display:inline-flex; align-items:center; gap:4px;">
                                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect width="18" height="18" x="3" y="3" rx="2"/><circle cx="9" cy="9" r="2"/><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"/></svg>
                                            Image
                                        </span>
                                    @endif
                                </div>
                                <div style="display:flex; align-items:center; gap:6px; margin-top:2px;">
                                    <span class="adm-chip" style="font-size: 11px; padding: 1px 6px; font-family: monospace; color:#6b7280; background:#f3f4f6;">#{{ $item->target_id }}</span>
                                    @if(!$item->is_active)
                                        <span style="font-size:11px; color:#ef4444; font-weight:600;">(Hidden on site)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Tools -->
                            <div class="adm-toc-tools" style="display:flex; align-items:center; gap:4px; padding-right:8px;">
                                <!-- Move Up -->
                                <form method="POST" action="{{ route('admin.toc.move', $item) }}" style="margin:0;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="direction" value="up">
                                    <button type="submit" class="adm-btn adm-btn-ghost adm-btn-icon" title="Move Up" {{ $index === 0 ? 'disabled' : '' }} style="padding:6px;">
                                        @include('admin.partials.icon', ['name' => 'up'])
                                    </button>
                                </form>

                                <!-- Move Down -->
                                <form method="POST" action="{{ route('admin.toc.move', $item) }}" style="margin:0;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="direction" value="down">
                                    <button type="submit" class="adm-btn adm-btn-ghost adm-btn-icon" title="Move Down" {{ $loop->last ? 'disabled' : '' }} style="padding:6px;">
                                        @include('admin.partials.icon', ['name' => 'down'])
                                    </button>
                                </form>

                                <!-- Toggle Active/Hidden -->
                                <form method="POST" action="{{ route('admin.toc.toggle', $item) }}" style="margin:0;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="adm-btn adm-btn-ghost adm-btn-icon" title="{{ $item->is_active ? 'Hide from website' : 'Show on website' }}" style="padding:6px;">
                                        @include('admin.partials.icon', ['name' => $item->is_active ? 'eye' : 'eyeoff'])
                                    </button>
                                </form>

                                <!-- Edit Section Content & Title -->
                                <a href="{{ route('admin.toc.index', ['edit' => $item->id]) }}" class="adm-btn {{ optional($editing)->id === $item->id ? 'adm-btn-primary' : 'adm-btn-ghost' }} adm-btn-icon" title="Edit Section & Content" style="padding:6px;">
                                    @include('admin.partials.icon', ['name' => 'edit'])
                                </a>

                                <!-- Delete -->
                                <form method="POST" action="{{ route('admin.toc.destroy', $item) }}" data-confirm="Delete '{{ $item->title }}' and its section?" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="adm-btn adm-btn-danger adm-btn-icon" title="Delete" style="padding:6px;">
                                        @include('admin.partials.icon', ['name' => 'trash'])
                                    </button>
                                </form>
                            </div>
                        </li>

                        <!-- Child Items (Level 3) -->
                        @if($item->children->isNotEmpty())
                            <ul class="adm-toc-children" style="list-style:none; padding:0 0 0 38px; margin:-4px 0 6px 0; display:flex; flex-direction:column; gap:6px;">
                                @foreach($item->children as $cIdx => $child)
                                    <li class="adm-toc-item {{ !$child->is_active ? 'is-hidden' : '' }} {{ optional($editing)->id === $child->id ? 'is-editing' : '' }}"
                                        draggable="true"
                                        data-id="{{ $child->id }}"
                                        data-order="{{ $child->order }}"
                                        style="border-radius: 6px; border: 1px solid {{ optional($editing)->id === $child->id ? '#1a4731' : '#e5e7eb' }}; background: {{ optional($editing)->id === $child->id ? '#fffaf4' : '#fafafa' }};">
                                        
                                        <div class="adm-drag-handle" title="Drag to reorder sub-item" style="cursor: grab; padding: 6px 8px; color: #a8a29e;">
                                            @include('admin.partials.icon', ['name' => 'grip'])
                                        </div>

                                        <div class="adm-toc-num" style="min-width:28px; height:26px; border-radius:4px; background:#ede8e1; color:#5c4832; font-size:11.5px; font-weight:700;">
                                            {{ $index + 1 }}.{{ $cIdx + 1 }}
                                        </div>

                                        <div class="adm-toc-body" style="flex:1; min-width:0; padding:0 8px;">
                                            <a href="{{ route('admin.toc.index', ['edit' => $child->id]) }}" style="text-decoration:none; color:#1f2937; font-weight:600; font-size:13.5px;">
                                                {{ $child->title }}
                                            </a>
                                            <span class="adm-chip" style="font-size: 10.5px; padding: 1px 5px; font-family: monospace;">#{{ $child->target_id }}</span>
                                            @if(!empty($child->image))
                                                <span class="adm-chip" style="font-size:10px; padding:1px 5px; background:#ecfdf5; color:#047857; border:1px solid #a7f3d0;">Image</span>
                                            @endif
                                        </div>

                                        <div class="adm-toc-tools" style="display:flex; align-items:center; gap:3px; padding-right:6px;">
                                            <a href="{{ route('admin.toc.index', ['edit' => $child->id]) }}" class="adm-btn adm-btn-ghost adm-btn-icon" title="Edit Content" style="padding:4px;">
                                                @include('admin.partials.icon', ['name' => 'edit'])
                                            </a>
                                            <form method="POST" action="{{ route('admin.toc.destroy', $child) }}" data-confirm="Delete '{{ $child->title }}'?" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="adm-btn adm-btn-danger adm-btn-icon" title="Delete" style="padding:4px;">
                                                    @include('admin.partials.icon', ['name' => 'trash'])
                                                </button>
                                            </form>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    @endforeach
                </ol>
            @endif
        </div>
    </div>

    <!-- Right Column: Edit Section Content / Add Item Editor -->
    <div class="adm-card" id="tocEditorCard" style="position: sticky; top: 88px;">
        <div class="adm-card-head" style="display:flex; justify-content:space-between; align-items:center; background:#faf8f5; border-bottom:1px solid #ede8e1;">
            <div>
                <h2 style="color:#1a4731; display:flex; align-items:center; gap:8px;">
                    @include('admin.partials.icon', ['name' => $editing ? 'edit' : 'plus'])
                    {{ $editing ? 'Edit Section Content' : 'Add New Section' }}
                </h2>
                <p>
                    @if($editing)
                        Editing <strong style="color:#111827;">{{ $editing->title }}</strong> (<code style="background:#f3f4f6; padding:2px 6px; border-radius:4px; font-size:12px;">#{{ $editing->target_id }}</code>)
                    @else
                        Create a new heading anchor and section for the Table of Contents.
                    @endif
                </p>
            </div>
            @if($editing)
                <a href="{{ route('admin.toc.index') }}" class="adm-btn adm-btn-ghost adm-btn-sm" title="Clear selection">Cancel Edit</a>
            @endif
        </div>

        <div class="adm-card-body" style="padding: 22px;">
            <form method="POST" action="{{ $editing ? route('admin.toc.update', $editing) : route('admin.toc.store') }}" id="tocEditForm" enctype="multipart/form-data">
                @csrf
                @if($editing)
                    @method('PUT')
                @endif

                <div class="adm-form-row" style="display:grid; grid-template-columns: 1fr 1fr; gap:14px;">
                    <div class="adm-field">
                        <label class="adm-label" for="tocTitle">Item Title (Heading) <span style="color:#ef4444;">*</span></label>
                        <input type="text" id="tocTitle" name="title" required value="{{ old('title', $editing->title ?? '') }}" placeholder="e.g. Facilities and Amenities" class="adm-input" style="font-weight:600;">
                    </div>

                    <div class="adm-field">
                        <label class="adm-label" for="tocTarget">Anchor Slug (#id)</label>
                        <input type="text" id="tocTarget" name="target_id" value="{{ old('target_id', $editing->target_id ?? '') }}" placeholder="e.g. facilities-and-amenities" class="adm-input" style="font-family: monospace;">
                    </div>
                </div>

                <div class="adm-form-row" style="display:grid; grid-template-columns: 1fr 1fr; gap:14px; margin-top:14px;">
                    <div class="adm-field">
                        <label class="adm-label" for="tocParent">Parent Section (Optional)</label>
                        <select id="tocParent" name="parent_id" class="adm-select">
                            <option value="">— None (Top-Level H2) —</option>
                            @foreach($parents as $parent)
                                @if(!$editing || $editing->id !== $parent->id)
                                    <option value="{{ $parent->id }}" {{ old('parent_id', $editing->parent_id ?? '') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->title }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="adm-field" style="display:flex; align-items:center; padding-top:24px;">
                        <label class="adm-check" style="cursor:pointer; font-weight:600;">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $editing->is_active ?? true) ? 'checked' : '' }}>
                            Visible on website
                        </label>
                    </div>
                </div>

                <!-- SECTION IMAGE (CRUD: Upload, URL, Live Preview, Delete) -->
                <div class="adm-field" style="margin-top: 16px; padding: 14px 16px; background: #faf8f5; border: 1px solid #ede8e1; border-radius: 8px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                        <label class="adm-label" style="font-weight: 700; color: #1f2937; margin-bottom: 0; display: flex; align-items: center; gap: 6px;">
                            @include('admin.partials.icon', ['name' => 'spark'])
                            Section Featured Image (Map, Diagram, Illustration)
                        </label>
                        @if($editing && !empty($editing->image))
                            <span class="adm-chip" style="background:#ecfdf5; color:#047857; font-size:11px; font-weight:600;">✓ Image Active</span>
                        @endif
                    </div>

                    @if($editing && !empty($editing->image))
                        <div id="currentImageWrapper" style="display: flex; align-items: center; gap: 14px; margin-bottom: 12px; padding: 10px 14px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 6px;">
                            <img src="{{ asset($editing->image) }}" alt="{{ $editing->title }}" style="max-height: 80px; max-width: 140px; border-radius: 4px; object-fit: contain; border: 1px solid #e5e7eb; background: #f9fafb;">
                            <div style="flex: 1; min-width: 0;">
                                <div style="font-size: 13px; font-weight: 700; color: #111827;">Current Image</div>
                                <div style="font-size: 12px; font-family: monospace; color: #6b7280; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-top: 2px;">{{ $editing->image }}</div>
                                <label class="adm-check" style="cursor: pointer; font-size: 12px; color: #ef4444; margin-top: 6px; display: inline-flex; align-items: center; gap: 6px;">
                                    <input type="checkbox" name="remove_image" value="1" onchange="toggleRemoveImage(this)">
                                    <strong>Remove / Delete this image</strong>
                                </label>
                            </div>
                        </div>
                    @endif

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div>
                            <label style="font-size: 11.5px; font-weight: 600; color: #4b5563; display: block; margin-bottom: 3px;">Upload Image File (JPG, PNG, WEBP)</label>
                            <input type="file" name="image_file" accept="image/*" class="adm-input" onchange="previewTocImage(this)" style="font-size: 12.5px; padding: 6px 10px; background:#fff;">
                        </div>
                        <div>
                            <label style="font-size: 11.5px; font-weight: 600; color: #4b5563; display: block; margin-bottom: 3px;">Or Image Path / Asset URL</label>
                            <input type="text" name="image" id="tocImageUrl" value="{{ old('image', $editing->image ?? '') }}" placeholder="e.g. /TOC1.png" class="adm-input" style="font-family: monospace; font-size: 12.5px; background:#fff;">
                        </div>
                    </div>

                    <!-- Live Upload Preview -->
                    <div id="tocImageLivePreview" style="display: none; margin-top: 10px; padding: 8px; background: #ffffff; border: 1px dashed #1a4731; border-radius: 6px; text-align: center;">
                        <span style="font-size: 11px; color: #1a4731; font-weight: 700; display: block; margin-bottom: 4px;">New Image Selected:</span>
                        <img id="tocPreviewImg" src="" style="max-height: 110px; max-width: 100%; object-fit: contain; border-radius: 4px;">
                    </div>
                </div>

                <!-- SECTION CONTENT EDITOR (PRIMARY FOCUS) -->
                <div class="adm-field" style="margin-top: 18px;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                        <label class="adm-label" for="tocContent" style="margin-bottom:0; font-weight:700; color:#1f2937;">
                            Section Content (HTML & Paragraphs)
                        </label>
                        <div style="display:flex; gap:6px;">
                            <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="togglePreviewMode()" id="previewToggleBtn" style="font-size:12px; padding:3px 10px;">
                                Live Preview
                            </button>
                        </div>
                    </div>

                    <!-- Quick Toolbar -->
                    <div style="display:flex; gap:6px; flex-wrap:wrap; padding: 6px 10px; background:#f9fafb; border: 1px solid #e5e7eb; border-bottom:none; border-radius: 6px 6px 0 0;">
                        <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="insertTag('p')" title="Wrap with <p class='saimaP'>" style="font-size:11.5px; padding:2px 8px; font-weight:600;">&lt;p&gt;</button>
                        <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="insertTag('strong')" title="Bold text" style="font-size:11.5px; padding:2px 8px; font-weight:bold;">&lt;b&gt;</button>
                        <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="insertTag('br')" title="Insert line break" style="font-size:11.5px; padding:2px 8px;">&lt;br&gt;</button>
                        <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="insertLink()" title="Insert link" style="font-size:11.5px; padding:2px 8px;">&lt;a&gt;</button>
                        <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="insertImg()" title="Insert image" style="font-size:11.5px; padding:2px 8px;">&lt;img&gt;</button>
                        @if($editing)
                            <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="resetToDefaultContent()" style="font-size:11.5px; padding:2px 8px; color:#d97706; margin-left:auto;" title="Restore original text">
                                Restore Default Text
                            </button>
                        @endif
                    </div>

                    <textarea id="tocContent" name="content" class="adm-textarea adm-summernote" rows="13"
                              placeholder="Enter the section paragraphs, HTML formatting, links, and images for this section..."
                              style="font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace; font-size: 13px; line-height: 1.6; border-radius: 0 0 6px 6px; resize: vertical;">{{ old('content', $editing ? $editing->resolvedContent() : '') }}</textarea>

                    <div id="previewContainer" style="display:none; padding:16px 20px; border:1px solid #e5e7eb; border-radius:0 0 6px 6px; background:#ffffff; min-height:220px; max-height:420px; overflow-y:auto; line-height:1.75;">
                    </div>

                    <div class="adm-help" style="margin-top:6px; display:flex; justify-content:space-between;">
                        <span>Supports standard HTML tags (<code style="background:#f3f4f6; padding:1px 4px; border-radius:3px;">&lt;p&gt;</code>, <code style="background:#f3f4f6; padding:1px 4px; border-radius:3px;">&lt;strong&gt;</code>, <code style="background:#f3f4f6; padding:1px 4px; border-radius:3px;">&lt;a&gt;</code>, <code style="background:#f3f4f6; padding:1px 4px; border-radius:3px;">&lt;img&gt;</code>).</span>
                        <span id="charCount" style="color:#9ca3af; font-size:12px;"></span>
                    </div>
                </div>

                <div style="display:flex; gap:12px; margin-top:20px;">
                    <button type="submit" class="adm-btn adm-btn-primary adm-btn-block" style="padding:12px 20px; font-size:15px; font-weight:700;">
                        @include('admin.partials.icon', ['name' => $editing ? 'check' : 'plus'])
                        {{ $editing ? 'Update Section & Content' : 'Add to TOC' }}
                    </button>
                    @if($editing)
                        <a href="{{ route('admin.toc.index') }}" class="adm-btn adm-btn-ghost" style="padding:12px 18px;">Cancel</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Drag & Drop Styling and AJAX Logic -->
<style>
    .adm-toc-item.is-dragging {
        opacity: 0.35 !important;
        background: #fdfaf6 !important;
        border: 2px dashed #1a4731 !important;
    }
    .adm-toc-item.drag-over {
        border-top: 3px solid #1a4731 !important;
        transform: translateY(2px);
    }
    .adm-drag-handle:active {
        cursor: grabbing !important;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sortableList = document.getElementById('sortableTocList');
    if (!sortableList) return;

    let draggedItem = null;

    // Attach drag events to all top-level TOC items
    const items = sortableList.querySelectorAll('li.adm-toc-item');
    items.forEach(item => {
        item.addEventListener('dragstart', handleDragStart);
        item.addEventListener('dragover', handleDragOver);
        item.addEventListener('dragleave', handleDragLeave);
        item.addEventListener('drop', handleDrop);
        item.addEventListener('dragend', handleDragEnd);
    });

    function handleDragStart(e) {
        draggedItem = this;
        this.classList.add('is-dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', this.dataset.id);
    }

    function handleDragOver(e) {
        e.preventDefault();
        e.dataTransfer.dropEffect = 'move';
        if (this !== draggedItem && this.parentNode === draggedItem.parentNode) {
            this.classList.add('drag-over');
        }
    }

    function handleDragLeave() {
        this.classList.remove('drag-over');
    }

    function handleDrop(e) {
        e.preventDefault();
        this.classList.remove('drag-over');

        if (this !== draggedItem && this.parentNode === draggedItem.parentNode) {
            const allItems = Array.from(this.parentNode.children).filter(el => el.classList.contains('adm-toc-item'));
            const draggedIdx = allItems.indexOf(draggedItem);
            const targetIdx = allItems.indexOf(this);

            if (draggedIdx < targetIdx) {
                this.parentNode.insertBefore(draggedItem, this.nextSibling);
            } else {
                this.parentNode.insertBefore(draggedItem, this);
            }

            // Renumber visual badges
            renumberList();

            // Save order to server via AJAX
            saveNewOrder();
        }
    }

    function handleDragEnd() {
        this.classList.remove('is-dragging');
        items.forEach(el => el.classList.remove('drag-over'));
    }

    function renumberList() {
        const topItems = sortableList.querySelectorAll(':scope > li.adm-toc-item');
        topItems.forEach((el, idx) => {
            const numEl = el.querySelector('.adm-toc-num');
            if (numEl) numEl.textContent = (idx + 1);
        });
    }

    async function saveNewOrder() {
        const topItems = sortableList.querySelectorAll(':scope > li.adm-toc-item');
        const payload = [];

        topItems.forEach((el, idx) => {
            payload.push({
                id: parseInt(el.dataset.id),
                order: idx + 1
            });
        });

        const statusEl = document.getElementById('reorderStatus');
        if (statusEl) {
            statusEl.textContent = 'Saving...';
            statusEl.style.display = 'inline-block';
            statusEl.style.background = '#fef3c7';
            statusEl.style.color = '#b45309';
        }

        try {
            const res = await fetch('{{ route("admin.toc.reorder") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ items: payload })
            });

            const data = await res.json();
            if (data.success) {
                if (statusEl) {
                    statusEl.textContent = 'Order Saved ✓';
                    statusEl.style.background = '#ecfdf5';
                    statusEl.style.color = '#047857';
                    setTimeout(() => { statusEl.style.display = 'none'; }, 2500);
                }
            } else {
                alert('Could not save reorder. Please try again.');
            }
        } catch (err) {
            console.error(err);
            if (statusEl) statusEl.style.display = 'none';
        }
    }

    // Auto update char count
    const textarea = document.getElementById('tocContent');
    const charCount = document.getElementById('charCount');
    if (textarea && charCount) {
        function updateCount() {
            charCount.textContent = `${textarea.value.length} characters`;
        }
        textarea.addEventListener('input', updateCount);
        updateCount();
    }

    // Auto-generate slug from title for new items
    const titleInput = document.getElementById('tocTitle');
    const targetInput = document.getElementById('tocTarget');
    @if(!$editing)
    if (titleInput && targetInput) {
        let manuallyEdited = false;
        targetInput.addEventListener('input', () => { manuallyEdited = targetInput.value.trim().length > 0; });
        titleInput.addEventListener('input', () => {
            if (!manuallyEdited) {
                targetInput.value = titleInput.value
                    .toLowerCase()
                    .replace(/[^\w\s-]/g, '')
                    .trim()
                    .replace(/[\s_-]+/g, '-');
            }
        });
    }
    @endif
});

// Quick Editor Toolbar Helpers
function insertTag(tag) {
    const textarea = document.getElementById('tocContent');
    if (!textarea) return;

    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selected = textarea.value.substring(start, end);

    let replacement = '';
    if (tag === 'p') {
        replacement = selected ? `<p class="saimaP">${selected}</p>` : `<p class="saimaP">\n    \n</p>`;
    } else if (tag === 'strong') {
        replacement = `<strong>${selected || 'bold text'}</strong>`;
    } else if (tag === 'br') {
        replacement = `<br>\n`;
    }

    textarea.setRangeText(replacement, start, end, 'end');
    textarea.focus();
}

function insertLink() {
    const textarea = document.getElementById('tocContent');
    if (!textarea) return;

    const url = prompt('Enter destination URL:', 'https://theleadmarketing.com/');
    if (!url) return;

    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const selected = textarea.value.substring(start, end) || 'Learn more';

    const tag = `<a href="${url}" target="_blank" rel="noopener noreferrer">${selected}</a>`;
    textarea.setRangeText(tag, start, end, 'end');
    textarea.focus();
}

function insertImg() {
    const textarea = document.getElementById('tocContent');
    if (!textarea) return;

    const src = prompt('Enter Image URL or asset filename (e.g. /TOC1.png):', '/TOC1.png');
    if (!src) return;

    const alt = prompt('Enter Image Description (alt):', 'Section Illustration') || '';
    const imgHtml = `\n<div class="saimaImgWrapper">\n    <img src="${src}" alt="${alt}" class="saimaImg">\n</div>\n`;

    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    textarea.setRangeText(imgHtml, start, end, 'end');
    textarea.focus();
}

function resetToDefaultContent() {
    if (!confirm('Restore the default paragraphs and text for this section?')) return;
    const textarea = document.getElementById('tocContent');
    const targetId = document.getElementById('tocTarget')?.value;
    
    @php
        $defaultMap = [];
        foreach($items as $it) {
            $defaultMap[$it->target_id] = \App\Models\TocItem::getDefaultContent($it->target_id);
            foreach($it->children as $ch) {
                $defaultMap[$ch->target_id] = \App\Models\TocItem::getDefaultContent($ch->target_id);
            }
        }
    @endphp
    const defaultContents = @json($defaultMap);

    if (defaultContents && targetId && defaultContents[targetId]) {
        textarea.value = defaultContents[targetId];
    } else {
        alert('No default template available for #' + targetId);
    }
}

// Live Preview Toggle
function togglePreviewMode() {
    const textarea = document.getElementById('tocContent');
    const preview = document.getElementById('previewContainer');
    const btn = document.getElementById('previewToggleBtn');

    if (preview.style.display === 'none') {
        preview.innerHTML = textarea.value || '<p style="color:#9ca3af; font-style:italic;">No content to preview.</p>';
        preview.style.display = 'block';
        textarea.style.display = 'none';
        btn.textContent = 'Edit Code';
        btn.classList.add('adm-btn-primary');
        btn.classList.remove('adm-btn-ghost');
    } else {
        preview.style.display = 'none';
        textarea.style.display = 'block';
        btn.textContent = 'Live Preview';
        btn.classList.remove('adm-btn-primary');
        btn.classList.add('adm-btn-ghost');
    }
}

// Section Image CRUD Helpers
function previewTocImage(input) {
    const previewBox = document.getElementById('tocImageLivePreview');
    const previewImg = document.getElementById('tocPreviewImg');
    if (!previewBox || !previewImg) return;

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewBox.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        previewBox.style.display = 'none';
        previewImg.src = '';
    }
}

function toggleRemoveImage(checkbox) {
    const wrapper = document.getElementById('currentImageWrapper');
    if (!wrapper) return;
    if (checkbox.checked) {
        wrapper.style.opacity = '0.35';
        wrapper.style.filter = 'grayscale(100%)';
    } else {
        wrapper.style.opacity = '1';
        wrapper.style.filter = 'none';
    }
}
</script>
@endsection
