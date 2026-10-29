@extends('admin.layouts.app')

@section('title', ($blog ? 'Edit Blog' : (empty($isCreating) ? 'Manage Blogs' : 'Add Blog')))

@push('styles')
<style>
    .adm-topbar { display: none !important; }

    /* Page container */
    .blog-page-container {
        padding: 6px 0 30px;
    }

    /* Outer Card */
    .blog-card-box {
        background: #ffffff;
        border: 1px solid #eef2f6;
        border-radius: 16px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02);
        padding: 28px 32px;
        display: flex;
        gap: 40px;
        align-items: flex-start;
    }

    /* Left Sidebar Tabs */
    .blog-left-sidebar {
        width: 220px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .blog-tab-btn {
        display: flex;
        align-items: center;
        gap: 12px;
        background: transparent;
        color: #64748b;
        padding: 12px 18px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        position: relative;
        cursor: pointer;
        user-select: none;
        border: none;
        width: 100%;
        text-align: left;
        transition: all 0.15s ease;
    }

    .blog-tab-btn:hover {
        background: #f8fafc;
        color: #1e293b;
    }

    .blog-tab-btn.is-active {
        background: #e0f2fe;
        color: #0369a1;
    }

    .blog-tab-btn .pill-icon {
        width: 28px;
        height: 28px;
        border-radius: 7px;
        background: #f1f5f9;
        color: #64748b;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.15s ease;
    }

    .blog-tab-btn.is-active .pill-icon {
        background: #0284c7;
        color: #ffffff;
    }

    /* Right small arrow pointing to form on active tab */
    .blog-tab-btn.is-active::after {
        content: '';
        position: absolute;
        right: -8px;
        top: 50%;
        transform: translateY(-50%);
        width: 0;
        height: 0;
        border-top: 7px solid transparent;
        border-bottom: 7px solid transparent;
        border-left: 8px solid #e0f2fe;
    }

    /* Right Form Area */
    .blog-form-area {
        flex: 1;
        min-width: 0;
    }

    .blog-section-title {
        font-size: 16px;
        font-weight: 700;
        color: #1e293b;
        margin: 0 0 26px 0;
    }

    /* Grid layout for each input row */
    .blog-form-grid {
        display: grid;
        grid-template-columns: 180px minmax(0, 1fr);
        gap: 22px 24px;
        align-items: start;
    }

    .blog-field-label {
        font-size: 13.5px;
        font-weight: 600;
        color: #1e293b;
        padding-top: 10px;
        line-height: 1.4;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .blog-field-label .req {
        color: #ef4444;
        font-weight: 700;
    }

    /* Text inputs & textareas */
    .blog-input-control {
        width: 100%;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 10px 14px;
        font-size: 13.5px;
        color: #1e293b;
        transition: all 0.15s ease;
        outline: none;
        box-sizing: border-box;
        font-family: inherit;
    }

    .blog-input-control:focus {
        background: #ffffff;
        border-color: #0284c7;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.12);
    }

    /* Cover Image Box */
    .cover-upload-card {
        width: 100%;
        max-width: 580px;
        aspect-ratio: 7 / 5;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        background: #ffffff;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    }

    .cover-upload-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .cover-edit-btn {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #ffffff;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.15s ease;
        cursor: pointer;
        border: none;
    }

    .cover-edit-btn:hover {
        color: #0284c7;
        transform: scale(1.05);
    }

    /* Add FAQ Button */
    .btn-add-faq {
        background: #e0f2fe;
        color: #0284c7;
        border: none;
        font-weight: 600;
        font-size: 13px;
        padding: 7px 16px;
        border-radius: 6px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: background 0.15s ease;
    }

    .btn-add-faq:hover {
        background: #bae6fd;
    }

    /* Save Blog Button */
    .btn-save-blog {
        background: #1a4731;
        color: #ffffff;
        border: none;
        font-weight: 600;
        font-size: 14px;
        padding: 10px 24px;
        border-radius: 8px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 2px 5px rgba(26, 71, 49, 0.25);
        transition: all 0.15s ease;
    }

    .btn-save-blog:hover {
        background: #123322;
        transform: translateY(-1px);
    }

    /* Summernote customization */
    .note-editor.note-airframe, .note-editor.note-frame {
        border: 1px solid #e2e8f0 !important;
        border-radius: 8px !important;
        overflow: hidden !important;
        background: #ffffff !important;
    }
    .note-editor.note-frame .note-toolbar {
        background: #f8fafc !important;
        border-bottom: 1px solid #e2e8f0 !important;
        padding: 6px 10px !important;
    }
    .note-btn {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        color: #334155 !important;
        padding: 4px 8px !important;
        font-size: 12px !important;
        border-radius: 4px !important;
    }
    .note-editable {
        background: #ffffff !important;
        min-height: 200px !important;
        font-size: 14px !important;
        color: #1e293b !important;
        line-height: 1.6 !important;
    }

    /* FAQ repeater rows */
    .faq-item-row {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px;
        margin-top: 10px;
        display: flex;
        flex-direction: column;
        gap: 8px;
        position: relative;
    }
    .faq-del-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 24px;
        height: 24px;
        border-radius: 4px;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #b91c1c;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        line-height: 1;
    }

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

    /* Top Banner Status Dropdown */
    .adm-status-dropdown-wrap {
        position: relative;
        display: inline-block;
        flex-shrink: 0;
    }
    .adm-status-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 7px 16px;
        font-size: 13px;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.15s ease;
        outline: none;
    }
    .adm-status-btn:hover {
        opacity: 0.92;
        box-shadow: 0 1px 3px rgba(0,0,0,0.06);
    }
    .adm-status-menu {
        display: none;
        position: absolute;
        right: 0;
        top: calc(100% + 6px);
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1), 0 8px 10px -6px rgba(0,0,0,0.05);
        min-width: 140px;
        padding: 6px;
        z-index: 9999;
    }
    .adm-status-opt {
        display: flex;
        align-items: center;
        gap: 8px;
        width: 100%;
        padding: 7px 10px;
        font-size: 13px;
        font-weight: 600;
        border: none;
        background: transparent;
        border-radius: 6px;
        cursor: pointer;
        text-align: left;
        transition: background 0.15s ease;
    }
    .adm-status-opt:hover {
        background: #f8fafc;
    }
</style>
@endpush

@section('content')
<div class="blog-page-container">

    @php
        $isEditOrCreate = ($blog !== null || !empty($isCreating));
    @endphp

    @if(!$isEditOrCreate)
        <!-- ========================================================================= -->
        <!-- VIEW 1: BLOGS LIST TABLE (Default View matching Pages, Projects, Cities)  -->
        <!-- ========================================================================= -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px;">
            <div>
                <h1 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; font-family: var(--font-display, 'Outfit', sans-serif); letter-spacing: -0.01em;">
                    Blogs
                </h1>
                <div style="font-size: 13px; color: #94a3b8; font-weight: 400;">Home &ndash; Manage &ndash; Blog</div>
            </div>

            <a href="{{ route('admin.blogs.index', ['action' => 'create']) }}" class="adm-btn" style="display: inline-flex; align-items: center; gap: 8px; padding: 9px 20px; background: #1a4731; color: #ffffff; border-radius: 8px; font-size: 13.5px; font-weight: 600; text-decoration: none; cursor: pointer; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                <span>+ Add Blog</span>
            </a>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                @include('admin.partials.icon', ['name' => 'check'])
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(isset($errors) && $errors->any())
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 22px 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 18px; border-bottom: 1px solid #f1f5f9; padding-bottom: 14px;">
                <div>
                    <h3 style="font-size: 16px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0;">All Blogs ({{ $allBlogs->count() }})</h3>
                    <p style="font-size: 13px; color: #64748b; margin: 0;">Manage your blog articles, edit content, or view live pages.</p>
                </div>
            </div>

            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13.5px;">
                    <thead>
                        <tr style="text-align: left; background: #f8fafc; color: #64748b; font-size: 12px; text-transform: uppercase;">
                            <th style="padding: 12px 14px;">Cover</th>
                            <th style="padding: 12px 14px;">Blog Title</th>
                            <th style="padding: 12px 14px;">URL Slug</th>
                            <th style="padding: 12px 14px;">Category</th>
                            <th style="padding: 12px 14px;">FAQs</th>
                            <th style="padding: 12px 14px;">Status</th>
                            <th style="padding: 12px 14px; text-align: right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($allBlogs as $b)
                            <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.15s ease;" onmouseover="this.style.background='#fafbfd'" onmouseout="this.style.background='transparent'">
                                <td style="padding: 12px 14px;">
                                    <img src="{{ $b->cover_image ? asset($b->cover_image) : asset('/images/Hudayriyat-Island---Marsana-East-Beach---Sign---Sunset-2.jpg') }}" alt="Cover" style="width: 58px; height: 42px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                                </td>
                                <td style="padding: 12px 14px; font-weight: 600; color: #1e293b;">
                                    <a href="{{ route('admin.blogs.index', ['id' => $b->id]) }}" style="color: #1e293b; text-decoration: none;">
                                        {{ $b->title }}
                                    </a>
                                </td>
                                <td style="padding: 12px 14px; color: #0284c7; font-family: Consolas, Monaco, monospace; font-size: 13px;">
                                    /blog/{{ $b->slug }}
                                </td>
                                <td style="padding: 12px 14px;">
                                    <span style="font-size: 12px; font-weight: 600; padding: 3px 9px; border-radius: 6px; background: #f1f5f9; color: #334155;">{{ $b->category }}</span>
                                </td>
                                <td style="padding: 12px 14px; color: #64748b;">
                                    {{ is_array($b->faqs) ? count($b->faqs) : 0 }} Questions
                                </td>
                                <td style="padding: 12px 14px;">
                                    @if($b->status === 'publish')
                                        <span style="font-size: 11.5px; font-weight: 700; color: #15803d; background: #f0fdf4; border: 1px solid #bbf7d0; padding: 3px 10px; border-radius: 999px;">Published</span>
                                    @else
                                        <span style="font-size: 11.5px; font-weight: 700; color: #b45309; background: #fffbeb; border: 1px solid #fde68a; padding: 3px 10px; border-radius: 999px;">Draft</span>
                                    @endif
                                </td>
                                <td style="padding: 12px 14px; text-align: right;">
                                    <div style="display: inline-flex; align-items: center; gap: 4px;">
                                        <!-- View Live Page -->
                                        <a href="{{ url('/blog/' . $b->slug) }}" target="_blank" rel="noopener" class="cms-action-btn" title="View Live Page">
                                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('admin.blogs.index', ['id' => $b->id]) }}" class="cms-action-btn" title="Edit Blog">
                                            @include('admin.partials.icon', ['name' => 'edit'])
                                        </a>

                                        <!-- Delete -->
                                        <form method="POST" action="{{ route('admin.blogs.destroy', $b->id) }}" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this blog post?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cms-action-btn cms-action-delete" title="Delete Blog" style="border: none; background: none; cursor: pointer;">
                                                @include('admin.partials.icon', ['name' => 'trash'])
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="padding: 40px 14px; text-align: center; color: #94a3b8;">
                                    No blogs created yet. Click "+ Add Blog" above to create your first article.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    @else
        <!-- ========================================================================= -->
        <!-- VIEW 2: ADD / EDIT BLOG FORM                                              -->
        <!-- ========================================================================= -->

        <!-- Top Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 22px;">
            <div>
                <h1 style="font-size: 20px; font-weight: 700; color: #1e293b; margin: 0 0 4px 0; font-family: var(--font-display, 'Outfit', sans-serif); letter-spacing: -0.01em;">
                    {{ $blog ? 'Edit Blog' : 'Add Blog' }}
                </h1>
                <div style="font-size: 13px; color: #94a3b8; font-weight: 400;">Home &ndash; Manage &ndash; Blog</div>
            </div>

            <div style="display: flex; gap: 10px; align-items: center;">
                <a href="{{ route('admin.blogs.index') }}" class="adm-btn" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border: 1px solid #cbd5e1; background: #ffffff; color: #475569; border-radius: 8px; font-size: 13.5px; font-weight: 600; text-decoration: none; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.04);">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
                    <span>Blog List</span>
                </a>

                @if($blog)
                    <a href="{{ url('/blog/' . $blog->slug) }}" target="_blank" rel="noopener" class="adm-btn" style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border: 1px solid #cbd5e1; background: #ffffff; color: #0284c7; border-radius: 8px; font-size: 13.5px; font-weight: 600; text-decoration: none; cursor: pointer; box-shadow: 0 1px 2px rgba(0,0,0,0.04);">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        <span>View Live Page</span>
                    </a>
                @endif
            </div>
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; color: #15803d; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                @include('admin.partials.icon', ['name' => 'check'])
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if(isset($errors) && $errors->any())
            <div style="background: #fef2f2; border: 1px solid #fecaca; color: #b91c1c; padding: 12px 18px; border-radius: 10px; margin-bottom: 20px; font-size: 14px;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ $blog ? route('admin.blogs.update', $blog->id) : route('admin.blogs.store') }}" enctype="multipart/form-data" id="blogForm">
            @csrf
            @if($blog)
                @method('PUT')
            @endif

            <!-- Top Page URL & Status Banner -->
            <div style="background:#ffffff; border-radius:14px; border:1px solid #f1f5f9; box-shadow:0 1px 3px rgba(0,0,0,0.03); padding:14px 20px; margin-bottom:22px; display:flex; align-items:center; justify-content:space-between; gap:16px;">
                <!-- Left: Page URL -->
                <div style="display:flex; align-items:center; gap:12px; font-size:14px; min-width:0; overflow:hidden;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#0ea5e9" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                    </svg>
                    <span style="font-weight:600; color:#475569; flex-shrink:0;">Page URL:</span>
                    <a href="{{ $blog ? url('/blog/' . $blog->slug) : '#' }}" id="topBannerPageUrlLink" target="_blank" rel="noopener" style="color:#0284c7; text-decoration:none; font-weight:500; word-break:break-all;">
                        {{ $blog ? url('/blog/' . $blog->slug) : url('/blog/[slug]') }}
                    </a>
                </div>

                <!-- Right: Status Dropdown -->
                @php
                    $currStatus = old('status', $blog->status ?? 'publish');
                    $badgeConfig = match($currStatus) {
                        'draft' => ['bg' => '#fffbeb', 'border' => '#fde68a', 'color' => '#b45309', 'dot' => '#f59e0b', 'label' => 'Draft'],
                        default => ['bg' => '#f0fdf4', 'border' => '#bbf7d0', 'color' => '#15803d', 'dot' => '#22c55e', 'label' => 'Published'],
                    };
                @endphp
                <div class="adm-status-dropdown-wrap">
                    <input type="hidden" name="status" id="blog_status" value="{{ $currStatus }}">
                    <button type="button" id="blog_status_btn" class="adm-status-btn" onclick="toggleBlogStatusDropdown(event)" style="border: 1px solid {{ $badgeConfig['border'] }}; background: {{ $badgeConfig['bg'] }}; color: {{ $badgeConfig['color'] }};">
                        <span id="blog_status_dot" style="width:7px; height:7px; border-radius:50%; background:{{ $badgeConfig['dot'] }};"></span>
                        <span id="blog_status_label">{{ $badgeConfig['label'] }}</span>
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left:2px;"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </button>
                    <div id="blog_status_menu" class="adm-status-menu">
                        <button type="button" onclick="selectBlogStatus('publish', 'Published', '#f0fdf4', '#bbf7d0', '#15803d', '#22c55e')" class="adm-status-opt" style="color:#15803d;">
                            <span style="width:7px; height:7px; border-radius:50%; background:#22c55e;"></span> Published
                        </button>
                        <button type="button" onclick="selectBlogStatus('draft', 'Draft', '#fffbeb', '#fde68a', '#b45309', '#f59e0b')" class="adm-status-opt" style="color:#b45309;">
                            <span style="width:7px; height:7px; border-radius:50%; background:#f59e0b;"></span> Draft
                        </button>
                    </div>
                </div>
            </div>

            <!-- MAIN FORM CARD -->
            <div class="blog-card-box">

                <!-- Left Sidebar: Blog Details & Blog SEO Tabs -->
                <div class="blog-left-sidebar">
                    <button type="button" class="blog-tab-btn is-active" id="tabBtnDetails" onclick="switchBlogTab('details')">
                        <div class="pill-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1-2.5-2.5Z"/><path d="M6 6h10"/><path d="M6 10h10"/></svg>
                        </div>
                        <span>Blog Details</span>
                    </button>

                    <button type="button" class="blog-tab-btn" id="tabBtnSeo" onclick="switchBlogTab('seo')">
                        <div class="pill-icon">
                            <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        </div>
                        <span>Blog SEO</span>
                    </button>
                </div>

                <!-- Right Form Area -->
                <div class="blog-form-area">

                    <!-- ========================================================= -->
                    <!-- PANE 1: BLOG DETAILS                                      -->
                    <!-- ========================================================= -->
                    <div id="paneBlogDetails" class="blog-tab-pane">
                        <h2 class="blog-section-title">Blog Details</h2>

                        <div class="blog-form-grid">

                            <!-- 1. Page Title -->
                            <label class="blog-field-label" for="field_page_title">
                                Page Title <span class="req">*</span>
                            </label>
                            <div>
                                <input type="text"
                                       id="field_page_title"
                                       name="title"
                                       required
                                       class="blog-input-control"
                                       placeholder="Enter Page Title"
                                       value="{{ old('title', $blog->title ?? '') }}"
                                       oninput="autoGenerateSlug(this.value)">
                            </div>

                            <!-- 2. Slug -->
                            <label class="blog-field-label" for="field_slug">
                                Slug <span class="req">*</span>
                            </label>
                            <div>
                                <input type="text"
                                       id="field_slug"
                                       name="slug"
                                       required
                                       class="blog-input-control"
                                       placeholder="Enter Slug (e.g. saima-builder-real-estate)"
                                       value="{{ old('slug', $blog->slug ?? '') }}"
                                       oninput="updateBannerUrl(this.value)"
                                       onchange="this.dataset.manuallyEdited = '1'; updateBannerUrl(this.value)">
                            </div>

                            <!-- 3. Category -->
                            <label class="blog-field-label" for="field_category">
                                Category <span class="req">*</span>
                            </label>
                            <div>
                                <select id="field_category" name="category" required class="blog-input-control" style="background: #ffffff; cursor: pointer;">
                                    @php $currentCat = old('category', $blog->category ?? 'Real Estate'); @endphp
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}" {{ $currentCat === $cat ? 'selected' : '' }}>
                                            {{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>



                            <!-- 6. Short Content -->
                            <label class="blog-field-label" for="field_short_content">
                                Short Content <span class="req">*</span>
                            </label>
                            <div>
                                <textarea id="field_short_content"
                                          name="short_content"
                                          rows="4"
                                          required
                                          class="blog-input-control"
                                          placeholder="A brief summary or excerpt for this article">{{ old('short_content', $blog->short_content ?? '') }}</textarea>
                            </div>

                            <!-- 7. Full Content (Summernote) -->
                            <label class="blog-field-label" for="field_full_content">
                                Full Content <span class="req">*</span>
                            </label>
                            <div>
                                <textarea id="field_full_content"
                                          name="content"
                                          class="blog-input-control adm-summernote"
                                          style="display:none;">{{ old('content', $blog->content ?? '') }}</textarea>
                            </div>

                            <!-- 8. Cover Image (700x500) -->
                            <label class="blog-field-label">
                                Cover Image
                            </label>
                            <div>
                                <div class="cover-upload-card" onclick="document.getElementById('coverFileInput').click()">
                                    @php
                                        $coverSrc = $blog && $blog->cover_image ? asset($blog->cover_image) : asset('/images/Hudayriyat-Island---Marsana-East-Beach---Sign---Sunset-2.jpg');
                                    @endphp
                                    <img id="coverImageElement" src="{{ $coverSrc }}" alt="Cover">
                                    <button type="button" class="cover-edit-btn" title="Change Cover Image">
                                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                    </button>
                                </div>
                                <input type="file" id="coverFileInput" name="cover_image_file" accept="image/*" style="display:none;" onchange="previewCoverImage(this)">
                                <div style="font-size: 12px; color: #94a3b8; margin-top: 6px;">Recommended dimensions: 700 &times; 500 px. Max size 5MB.</div>
                            </div>

                            <!-- 9. FAQs Section -->
                            <label class="blog-field-label" style="align-items: flex-start;">
                                FAQs Section
                            </label>
                            <div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                    <span style="font-size: 13px; color: #64748b;">Add frequently asked questions related to this blog post:</span>
                                    <button type="button" class="btn-add-faq" onclick="addNewFaqRow()">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                        Add FAQ
                                    </button>
                                </div>

                                <div id="faqItemsList">
                                    @php
                                        $faqs = old('faqs', $blog->faqs ?? []);
                                    @endphp
                                    @if(is_array($faqs) && count($faqs) > 0)
                                        @foreach($faqs as $fIndex => $faq)
                                            <div class="faq-item-row">
                                                <button type="button" class="faq-del-btn" onclick="this.closest('.faq-item-row').remove()" title="Delete FAQ">&times;</button>
                                                <input type="text"
                                                       name="faq_q[]"
                                                       value="{{ $faq['question'] ?? '' }}"
                                                       placeholder="Question"
                                                       class="blog-input-control"
                                                       style="background: #ffffff; padding: 8px 12px; font-weight: 600;">
                                                <textarea name="faq_a[]"
                                                          rows="2"
                                                          placeholder="Answer"
                                                          class="blog-input-control"
                                                          style="background: #ffffff; padding: 8px 12px; font-size: 13px;">{{ $faq['answer'] ?? '' }}</textarea>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- ========================================================= -->
                    <!-- PANE 2: BLOG SEO                                          -->
                    <!-- ========================================================= -->
                    <div id="paneBlogSeo" class="blog-tab-pane" style="display:none;">
                        <h2 class="blog-section-title">Blog SEO &amp; Meta</h2>

                        <div class="blog-form-grid">
                            <label class="blog-field-label" for="field_meta_title">
                                Meta Title
                            </label>
                            <div>
                                <input type="text"
                                       id="field_meta_title"
                                       name="meta_title"
                                       class="blog-input-control"
                                       placeholder="SEO Meta Title"
                                       value="{{ old('meta_title', $blog->meta_title ?? '') }}">
                                <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">Recommended: 50&ndash;60 characters.</div>
                            </div>

                            <label class="blog-field-label" for="field_meta_description">
                                Meta Description
                            </label>
                            <div>
                                <textarea id="field_meta_description"
                                          name="meta_description"
                                          rows="3"
                                          class="blog-input-control"
                                          placeholder="SEO Meta Description">{{ old('meta_description', $blog->meta_description ?? '') }}</textarea>
                                <div style="font-size: 12px; color: #94a3b8; margin-top: 4px;">Recommended: 150&ndash;160 characters.</div>
                            </div>

                            <label class="blog-field-label" for="field_meta_keywords">
                                Meta Keywords
                            </label>
                            <div>
                                <input type="text"
                                       id="field_meta_keywords"
                                       name="meta_keywords"
                                       class="blog-input-control"
                                       placeholder="keyword 1, keyword 2, keyword 3"
                                       value="{{ old('meta_keywords', $blog->meta_keywords ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Save Action Row -->
                    <div style="margin-top: 36px; padding-top: 24px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 12px;">
                        <a href="{{ route('admin.blogs.index') }}" style="display: inline-flex; align-items: center; padding: 10px 20px; border: 1px solid #cbd5e1; background: #ffffff; color: #475569; border-radius: 8px; font-size: 14px; font-weight: 600; text-decoration: none;">
                            Cancel
                        </a>
                        <button type="submit" class="btn-save-blog">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                            <span>Save Changes</span>
                        </button>
                    </div>

                </div>
            </div>
        </form>
    @endif

</div>

@push('scripts')
<script>
    // Tab switching between Blog Details & Blog SEO
    function switchBlogTab(tab) {
        const btnDetails = document.getElementById('tabBtnDetails');
        const btnSeo = document.getElementById('tabBtnSeo');
        const paneDetails = document.getElementById('paneBlogDetails');
        const paneSeo = document.getElementById('paneBlogSeo');

        if (!btnDetails || !btnSeo || !paneDetails || !paneSeo) return;

        if (tab === 'seo') {
            btnDetails.classList.remove('is-active');
            btnSeo.classList.add('is-active');
            paneDetails.style.display = 'none';
            paneSeo.style.display = 'block';
        } else {
            btnSeo.classList.remove('is-active');
            btnDetails.classList.add('is-active');
            paneSeo.style.display = 'none';
            paneDetails.style.display = 'block';
        }
    }

    // Auto generate slug from title unless manually edited
    function autoGenerateSlug(val) {
        const slugInput = document.getElementById('field_slug');
        if (slugInput && !slugInput.dataset.manuallyEdited) {
            const slug = val.toLowerCase()
                .replace(/[^\w\s-]/g, '')
                .trim()
                .replace(/[\s_-]+/g, '-')
                .replace(/^-+|-+$/g, '');
            slugInput.value = slug;
            updateBannerUrl(slug);
        }
    }

    // Live update Page URL link in the top banner
    function updateBannerUrl(slugVal) {
        const link = document.getElementById('topBannerPageUrlLink');
        if (link) {
            const baseUrl = "{{ url('/blog') }}";
            const cleanSlug = (slugVal || '').trim().replace(/^\/+/, '');
            if (cleanSlug) {
                link.href = `${baseUrl}/${cleanSlug}`;
                link.textContent = `${baseUrl}/${cleanSlug}`;
            } else {
                link.href = '#';
                link.textContent = `${baseUrl}/[slug]`;
            }
        }
    }

    // Toggle Status Dropdown in top banner
    function toggleBlogStatusDropdown(e) {
        if (e) e.stopPropagation();
        const menu = document.getElementById('blog_status_menu');
        if (menu) {
            menu.style.display = (menu.style.display === 'none' || menu.style.display === '') ? 'block' : 'none';
        }
    }

    // Select Status Option
    function selectBlogStatus(val, label, bg, border, color, dot) {
        const input = document.getElementById('blog_status');
        if (input) input.value = val;
        const btn = document.getElementById('blog_status_btn');
        if (btn) {
            btn.style.background = bg;
            btn.style.borderColor = border;
            btn.style.color = color;
        }
        const dotEl = document.getElementById('blog_status_dot');
        if (dotEl) dotEl.style.background = dot;
        const labelEl = document.getElementById('blog_status_label');
        if (labelEl) labelEl.textContent = label;
        const menu = document.getElementById('blog_status_menu');
        if (menu) menu.style.display = 'none';
    }

    // Close dropdown on outside click
    document.addEventListener('click', function(e) {
        const wrap = document.querySelector('.adm-status-dropdown-wrap');
        const menu = document.getElementById('blog_status_menu');
        if (menu && wrap && !wrap.contains(e.target)) {
            menu.style.display = 'none';
        }
    });

    // Preview selected cover image
    function previewCoverImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.getElementById('coverImageElement');
                if (img) {
                    img.src = e.target.result;
                }
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Add FAQ Row
    function addNewFaqRow(q = '', a = '') {
        const container = document.getElementById('faqItemsList');
        if (!container) return;

        const row = document.createElement('div');
        row.className = 'faq-item-row';
        row.innerHTML = `
            <button type="button" class="faq-del-btn" onclick="this.closest('.faq-item-row').remove()" title="Delete FAQ">&times;</button>
            <input type="text" name="faq_q[]" value="${q.replace(/"/g, '&quot;')}" placeholder="Question" class="blog-input-control" style="background: #ffffff; padding: 8px 12px; font-weight: 600;">
            <textarea name="faq_a[]" rows="2" placeholder="Answer" class="blog-input-control" style="background: #ffffff; padding: 8px 12px; font-size: 13px;">${a}</textarea>
        `;
        container.appendChild(row);
        row.querySelector('input').focus();
    }

    // Initialize Summernote on page load
    $(document).ready(function() {
        if ($.fn.summernote) {
            $('#field_full_content').summernote({
                height: 260,
                minHeight: 180,
                placeholder: 'Enter Blog Content....',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'strikethrough', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        }
    });
</script>
@endpush
@endsection
