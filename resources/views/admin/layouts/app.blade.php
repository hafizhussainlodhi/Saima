<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Dashboard') · Hudayriyat Admin</title>
    <meta name="description" content="Hudayriyat Island admin panel for managing website content, table of contents and leads.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
    <!-- Summernote Lite WYSIWYG Editor Styles -->
    <link rel="stylesheet" href="{{ asset('vendor/summernote/summernote-lite.min.css') }}">
    <style>
        /* Summernote Clean Theme Overrides for Hudayriyat Admin */
        .note-editor.note-frame {
            border: 1px solid #d1d5db !important;
            border-radius: 8px !important;
            overflow: hidden;
            background: #ffffff;
            font-family: inherit;
        }
        .note-editor.note-frame.codeview .note-editing-area .note-codable {
            background-color: #1f2937;
            color: #f3f4f6;
            font-family: monospace;
            padding: 12px;
        }
        .note-toolbar {
            background: #faf8f5 !important;
            border-bottom: 1px solid #e5e7eb !important;
            padding: 6px 10px !important;
        }
        .note-btn {
            border: 1px solid #e5e7eb !important;
            background: #ffffff !important;
            border-radius: 4px !important;
            padding: 4px 8px !important;
            font-size: 12px !important;
            color: #374151 !important;
        }
        .note-btn:hover, .note-btn.active {
            background: #ede8e1 !important;
            color: #1a4731 !important;
            border-color: #d6cbbe !important;
        }
        .note-editable {
            font-family: inherit !important;
            font-size: 14px !important;
            line-height: 1.7 !important;
            color: #1f2937 !important;
            padding: 14px !important;
            background: #ffffff !important;
        }
        .note-editable h1, .note-editable h2, .note-editable h3 {
            color: #111827;
            margin-top: 0.5em;
            margin-bottom: 0.3em;
        }
        .note-editable p {
            margin-bottom: 0.75em;
        }

        /* Image 1 Exact Site Settings Styling */
        .site-settings-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 12px 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #5d5fef !important;
        }
        .site-settings-header svg {
            stroke: #5d5fef;
            opacity: 0.9;
        }
        .adm-nav-link.site-settings-link {
            font-size: 13.5px;
            font-weight: 500;
            color: #374151;
            padding: 11px 14px;
            border-radius: 12px;
            margin-bottom: 4px;
            transition: all 0.2s ease;
        }
        .adm-nav-link.site-settings-link svg {
            stroke: #6b7280;
            width: 19px;
            height: 19px;
        }
        .adm-nav-link.site-settings-link:hover {
            background: #f3f4f6;
            color: #111827;
        }
        .adm-nav-link.site-settings-link.is-active {
            background: #6366f1 !important;
            color: #ffffff !important;
            font-weight: 600;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.35);
        }
        .adm-nav-link.site-settings-link.is-active::before {
            display: none !important;
        }
        .adm-nav-link.site-settings-link.is-active svg {
            stroke: #ffffff !important;
            opacity: 1;
        }
    </style>
    @stack('styles')
</head>
<body>
@php
    $adminUser = auth()->user();
@endphp
<div class="adm-shell" id="admShell">
    <aside class="adm-sidebar" id="admSidebar" aria-label="Admin navigation">
        <a href="{{ route('admin.dashboard') }}" class="adm-brand" id="admBrandLink">
            <div class="adm-brand-mark">H</div>
            <div class="adm-brand-text">
                <strong>Hudayriyat</strong>
                <span>Admin CMS</span>
            </div>
        </a>

        <div class="adm-nav-label">Overview</div>
        <a href="{{ route('admin.dashboard') }}" id="navDashboard" class="adm-nav-link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
            @include('admin.partials.icon', ['name' => 'grid']) Dashboard
        </a>

        <div class="adm-nav-label">Content</div>
        @if($adminUser->hasPermission('pages'))
            @php
                $isPagesActive = request()->routeIs('admin.pages.*');
                $isProjectsActive = request()->routeIs('admin.projects.*');
            @endphp
            <a href="{{ route('admin.pages.index') }}" id="navPages" class="adm-nav-link {{ $isPagesActive ? 'is-active' : '' }}">
                @include('admin.partials.icon', ['name' => 'file']) Pages
            </a>
            <a href="{{ route('admin.projects.index') }}" id="navProjects" class="adm-nav-link {{ $isProjectsActive ? 'is-active' : '' }}">
                @include('admin.partials.icon', ['name' => 'building']) Projects
            </a>
        @endif


        {{-- SITE SETTINGS (Matching Image 1) --}}
        @if($adminUser->hasPermission('seo') || $adminUser->hasPermission('footer') || $adminUser->hasPermission('users'))
            <div class="site-settings-header">
                <span>SITE SETTINGS</span>
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="18 15 12 9 6 15"/></svg>
            </div>

            @if($adminUser->hasPermission('seo'))
                <a href="{{ route('admin.seo.index') }}" id="navSeo" class="adm-nav-link site-settings-link {{ request()->routeIs('admin.seo.*') ? 'is-active' : '' }}">
                    @include('admin.partials.icon', ['name' => 'globe', 'size' => 19]) Global SEO & Indexing
                </a>
            @endif

            @if($adminUser->hasPermission('footer'))
                <a href="{{ route('admin.footer.index') }}" id="navFooter" class="adm-nav-link site-settings-link {{ request()->routeIs('admin.footer.*') ? 'is-active' : '' }}">
                    @include('admin.partials.icon', ['name' => 'panels', 'size' => 19]) Footer & Newsletter
                </a>
            @endif

            @if($adminUser->hasPermission('users'))
                <a href="{{ route('admin.users.index') }}" id="navUsers" class="adm-nav-link site-settings-link {{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}">
                    @include('admin.partials.icon', ['name' => 'users', 'size' => 19]) Users & Permissions
                </a>
            @endif
        @endif

        <div class="adm-sidebar-foot">
            <a href="{{ url('/') }}" target="_blank" rel="noopener" class="adm-nav-link" id="navViewSite">
                @include('admin.partials.icon', ['name' => 'globe']) View Website
            </a>
            <div class="adm-user">
                <div class="adm-avatar">{{ strtoupper(substr($adminUser->name ?? 'A', 0, 1)) }}</div>
                <div class="adm-user-info">
                    <strong>{{ $adminUser->name }}</strong>
                    <span>{{ $adminUser->email }}</span>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="adm-btn adm-btn-ghost adm-btn-block" id="logoutBtn">
                    @include('admin.partials.icon', ['name' => 'logout']) Sign out
                </button>
            </form>
        </div>
    </aside>

    <main class="adm-main">
        <div class="adm-topbar">
            <div>
                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm adm-mobile-toggle" id="admNavToggle" aria-label="Open navigation" style="margin-bottom:12px">
                    @include('admin.partials.icon', ['name' => 'menu']) Menu
                </button>
                <div class="adm-eyebrow">@yield('eyebrow', 'Hudayriyat Island')</div>
                <h1 class="adm-title">@yield('heading')</h1>
                @hasSection('subheading')
                    <p class="adm-subtitle">@yield('subheading')</p>
                @endif
            </div>
            <div class="adm-actions">@yield('actions')</div>
        </div>

        @if(session('success'))
            <div class="adm-alert adm-alert-success" role="status">
                @include('admin.partials.icon', ['name' => 'check'])
                <div>{{ session('success') }}</div>
                <button type="button" class="adm-alert-close" aria-label="Dismiss" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif
        @if(session('error'))
            <div class="adm-alert adm-alert-error" role="alert">
                @include('admin.partials.icon', ['name' => 'alert'])
                <div>{{ session('error') }}</div>
                <button type="button" class="adm-alert-close" aria-label="Dismiss" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif
        @if($errors->any())
            <div class="adm-alert adm-alert-error" role="alert">
                @include('admin.partials.icon', ['name' => 'alert'])
                <div>@foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach</div>
            </div>
        @endif

        @yield('content')
    </main>
</div>

<script>
    // Mobile navigation
    document.getElementById('admNavToggle')?.addEventListener('click', (e) => {
        e.stopPropagation();
        document.getElementById('admShell').classList.toggle('is-nav-open');
    });
    document.addEventListener('click', (e) => {
        const shell = document.getElementById('admShell');
        if (shell.classList.contains('is-nav-open') && !e.target.closest('#admSidebar')) {
            shell.classList.remove('is-nav-open');
        }
    });
    // Confirm destructive actions
    document.querySelectorAll('form[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (e) => {
            if (!confirm(form.dataset.confirm)) e.preventDefault();
        });
    });
    // Auto-dismiss success alerts
    setTimeout(() => document.querySelectorAll('.adm-alert-success').forEach((el) => {
        el.style.transition = 'opacity .4s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 400);
    }), 6000);
</script>

<!-- jQuery & Summernote Lite Scripts -->
<script src="{{ asset('vendor/summernote/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('vendor/summernote/summernote-lite.min.js') }}"></script>
<script>
    $(document).ready(function() {
        // Initialize Summernote on all textareas with .adm-summernote or .summernote
        function initSummernote(selector = '.adm-summernote, .summernote') {
            $(selector).each(function() {
                if (!$(this).data('summernote-initialized')) {
                    const customHeight = $(this).data('height') || 200;
                    $(this).summernote({
                        height: customHeight,
                        minHeight: 120,
                        tabsize: 2,
                        toolbar: [
                            ['style', ['style']],
                            ['font', ['bold', 'italic', 'underline', 'clear']],
                            ['color', ['color']],
                            ['para', ['ul', 'ol', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture', 'hr']],
                            ['view', ['fullscreen', 'codeview', 'help']]
                        ],
                        styleTags: [
                            'p',
                            { title: 'Heading 1', tag: 'h1', className: '', value: 'h1' },
                            { title: 'Heading 2', tag: 'h2', className: '', value: 'h2' },
                            { title: 'Heading 3', tag: 'h3', className: '', value: 'h3' },
                            { title: 'Heading 4', tag: 'h4', className: '', value: 'h4' },
                            'blockquote'
                        ],
                        callbacks: {
                            onChange: function(contents) {
                                // Keep textarea value synchronized in real-time
                                $(this).val(contents);
                            }
                        }
                    });
                    $(this).data('summernote-initialized', true);
                }
            });
        }

        initSummernote();

        // Ensure Summernote code is synced before any form submission
        $('form').on('submit', function() {
            $('.adm-summernote, .summernote').each(function() {
                if ($(this).data('summernote')) {
                    $(this).val($(this).summernote('code'));
                }
            });
        });

        // Expose initSummernote globally for dynamically shown elements/tabs
        window.initSummernote = initSummernote;
    });
</script>
@stack('scripts')
</body>
</html>
