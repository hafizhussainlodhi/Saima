@extends('admin.layouts.app')

@section('title', 'Global SEO & Indexing')
@section('eyebrow', 'Site Settings')
@section('heading', 'Global SEO & Indexing')
@section('subheading', 'Control search engine indexing visibility, meta tags, Open Graph images and analytics.')

@section('content')
<div class="adm-card" style="max-width: 960px; margin: 0 auto;">
    @if(session('success'))
        <div class="adm-alert adm-alert-success" style="margin-bottom: 20px;">
            @include('admin.partials.icon', ['name' => 'check'])
            <div>{{ session('success') }}</div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.seo.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- 1. SEARCH ENGINE INDEXING BUTTON / TOGGLE SETUP (ON / OFF) -->
        <div style="background: linear-gradient(135deg, #faf7f2 0%, #f4eee5 100%); border: 1.5px solid #dcd4c7; border-radius: 12px; padding: 22px 24px; margin-bottom: 28px; box-shadow: 0 4px 14px rgba(0,0,0,0.03);">
            <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                <div style="flex: 1; min-width: 260px;">
                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                        <span style="display: inline-flex; align-items: center; justify-content: center; width: 32px; height: 32px; border-radius: 8px; background: #1a4731; color: #fff;">
                            @include('admin.partials.icon', ['name' => 'globe', 'size' => 18])
                        </span>
                        <h3 style="margin: 0; font-size: 17px; font-weight: 700; color: #1f2937;">Search Engine Indexing</h3>
                        @if($settings['indexing_enabled'])
                            <span class="adm-chip" style="background: #ecfdf5; color: #047857; font-weight: 700; font-size: 11.5px; border: 1px solid #a7f3d0;">
                                ● INDEXING ON (Live)
                            </span>
                        @else
                            <span class="adm-chip" style="background: #fef2f2; color: #dc2626; font-weight: 700; font-size: 11.5px; border: 1px solid #fecaca;">
                                ✕ INDEXING OFF (Noindex)
                            </span>
                        @endif
                    </div>
                    <p style="margin: 6px 0 0 0; font-size: 13.5px; color: #4b5563; line-height: 1.5;">
                        Controls whether Google, Bing, and other search engines are allowed to crawl and index your website.
                    </p>
                </div>

                <!-- Modern Big Toggle Switch -->
                <div style="display: flex; align-items: center; gap: 14px;">
                    <span id="indexingLabel" style="font-weight: 700; font-size: 14px; color: {{ $settings['indexing_enabled'] ? '#047857' : '#dc2626' }};">
                        {{ $settings['indexing_enabled'] ? 'Indexing Allowed' : 'Indexing Blocked' }}
                    </span>
                    <label style="position: relative; display: inline-block; width: 56px; height: 30px; cursor: pointer;">
                        <input type="checkbox" name="indexing_enabled" id="indexingToggle" value="1" {{ $settings['indexing_enabled'] ? 'checked' : '' }} onchange="toggleIndexingState(this)" style="opacity: 0; width: 0; height: 0;">
                        <span class="seo-toggle-slider" style="position: absolute; cursor: pointer; inset: 0; background-color: {{ $settings['indexing_enabled'] ? '#059669' : '#9ca3af' }}; transition: .3s; border-radius: 30px;">
                            <span class="seo-toggle-knob" style="position: absolute; content: ''; height: 22px; width: 22px; left: {{ $settings['indexing_enabled'] ? '30px' : '4px' }}; bottom: 4px; background-color: white; transition: .3s; border-radius: 50%; box-shadow: 0 2px 4px rgba(0,0,0,0.2);"></span>
                        </span>
                    </label>
                </div>
            </div>

            <!-- Notice / Status Banner -->
            <div id="indexingNotice" style="margin-top: 14px; padding: 10px 14px; background: {{ $settings['indexing_enabled'] ? '#ecfdf5' : '#fffbeb' }}; border: 1px solid {{ $settings['indexing_enabled'] ? '#a7f3d0' : '#fef3c7' }}; border-radius: 6px; font-size: 12.5px; color: {{ $settings['indexing_enabled'] ? '#065f46' : '#92400e' }}; line-height: 1.5;">
                @if($settings['indexing_enabled'])
                    <strong>✓ Production Ready:</strong> Search engines will receive <code style="background:rgba(0,0,0,0.06); padding:2px 5px; border-radius:3px;">&lt;meta name="robots" content="index, follow"&gt;</code> and index all published pages.
                @else
                    <strong>⚠️ Staging / Private Mode:</strong> Search engines receive <code style="background:rgba(0,0,0,0.06); padding:2px 5px; border-radius:3px;">&lt;meta name="robots" content="noindex, nofollow"&gt;</code>, preventing the site from appearing in search results.
                @endif
            </div>
        </div>

        <!-- 2. DEFAULT META TAGS -->
        <div style="margin-bottom: 28px;">
            <h4 style="font-size: 15px; font-weight: 700; color: #111827; margin: 0 0 14px 0; border-bottom: 1px solid #f0ede8; padding-bottom: 8px;">
                Default SEO Meta Tags
            </h4>

            <div class="adm-field">
                <label class="adm-label" for="defaultTitle">Default Meta Title (&lt;title&gt;) <span style="color:#ef4444">*</span></label>
                <input type="text" id="defaultTitle" name="default_title" value="{{ old('default_title', $settings['default_title']) }}" class="adm-input" required placeholder="Brand &amp; primary description">
                <span class="adm-help">Fallback title used across pages without a specific meta title override.</span>
            </div>

            <div class="adm-field" style="margin-top: 14px;">
                <label class="adm-label" for="defaultDescription">Default Meta Description</label>
                <textarea id="defaultDescription" name="default_description" class="adm-textarea" rows="3" placeholder="Summary for search engine snippets">{{ old('default_description', $settings['default_description']) }}</textarea>
                <span class="adm-help">Optimal length: 150–160 characters.</span>
            </div>

            <div class="adm-field" style="margin-top: 14px;">
                <label class="adm-label" for="defaultKeywords">Default Meta Keywords</label>
                <input type="text" id="defaultKeywords" name="default_keywords" value="{{ old('default_keywords', $settings['default_keywords']) }}" class="adm-input" placeholder="comma-separated keywords">
            </div>

            <div class="adm-field" style="margin-top: 14px;">
                <label class="adm-label" for="canonicalUrl">Canonical Base URL</label>
                <input type="url" id="canonicalUrl" name="canonical_url" value="{{ old('canonical_url', $settings['canonical_url']) }}" class="adm-input" placeholder="https://hudayriyat-island.ae">
            </div>
        </div>

        <!-- 3. SOCIAL SHARING (OPEN GRAPH) -->
        <div style="margin-bottom: 28px;">
            <h4 style="font-size: 15px; font-weight: 700; color: #111827; margin: 0 0 14px 0; border-bottom: 1px solid #f0ede8; padding-bottom: 8px;">
                Social Media Sharing (Open Graph)
            </h4>

            <div style="display: grid; grid-template-columns: 140px 1fr; gap: 18px; align-items: start;">
                <div style="border: 1px solid #e5e7eb; border-radius: 8px; overflow: hidden; height: 95px; background: #f9fafb; display: flex; align-items: center; justify-content: center;">
                    <img id="ogPreview" src="{{ asset($settings['og_image']) }}" alt="OG Preview" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div>
                    <label class="adm-label">Default Share Image (og:image)</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <input type="file" name="og_image_file" accept="image/*" class="adm-input" style="padding: 7px 10px; font-size: 12.5px;" onchange="previewOgImage(this)">
                        <input type="text" name="og_image" id="ogImageInput" value="{{ old('og_image', $settings['og_image']) }}" class="adm-input" placeholder="/images/hero/slide-1.jpg">
                    </div>
                    <span class="adm-help">Recommended dimension: 1200 x 630 pixels (JPG/PNG).</span>
                </div>
            </div>
        </div>

        <!-- 4. TRACKING SCRIPTS -->
        <div style="margin-bottom: 28px;">
            <h4 style="font-size: 15px; font-weight: 700; color: #111827; margin: 0 0 14px 0; border-bottom: 1px solid #f0ede8; padding-bottom: 8px;">
                Header Tracking Scripts &amp; Verification
            </h4>
            <div class="adm-field">
                <label class="adm-label" for="headerScripts">Google Analytics, Tag Manager, or Meta Pixel (HTML &lt;script&gt;)</label>
                <textarea id="headerScripts" name="header_scripts" class="adm-textarea" rows="4" style="font-family: monospace; font-size: 12.5px;" placeholder="<!-- Global site tag (gtag.js) - Google Analytics -->&#10;<script async src='https://www.googletagmanager.com/gtag/js?id=G-...'></script>">{{ old('header_scripts', $settings['header_scripts']) }}</textarea>
                <span class="adm-help">Injected safely into the &lt;head&gt; of all public website pages.</span>
            </div>
        </div>

        <!-- Submit Button -->
        <div style="display: flex; gap: 12px; padding-top: 10px; border-top: 1px solid #f0ede8;">
            <button type="submit" class="adm-btn adm-btn-primary" style="padding: 12px 24px; font-size: 14.5px; font-weight: 700;">
                @include('admin.partials.icon', ['name' => 'check']) Save SEO Settings
            </button>
            <a href="{{ route('admin.dashboard') }}" class="adm-btn adm-btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<script>
function toggleIndexingState(checkbox) {
    const slider = checkbox.nextElementSibling;
    const knob = slider.querySelector('.seo-toggle-knob');
    const label = document.getElementById('indexingLabel');
    const notice = document.getElementById('indexingNotice');

    if (checkbox.checked) {
        slider.style.backgroundColor = '#059669';
        knob.style.left = '30px';
        label.textContent = 'Indexing Allowed';
        label.style.color = '#047857';
        notice.style.background = '#ecfdf5';
        notice.style.borderColor = '#a7f3d0';
        notice.style.color = '#065f46';
        notice.innerHTML = '<strong>✓ Production Ready:</strong> Search engines will receive <code>&lt;meta name="robots" content="index, follow"&gt;</code> and index all published pages.';
    } else {
        slider.style.backgroundColor = '#9ca3af';
        knob.style.left = '4px';
        label.textContent = 'Indexing Blocked';
        label.style.color = '#dc2626';
        notice.style.background = '#fffbeb';
        notice.style.borderColor = '#fef3c7';
        notice.style.color = '#92400e';
        notice.innerHTML = '<strong>⚠️ Staging / Private Mode:</strong> Search engines receive <code>&lt;meta name="robots" content="noindex, nofollow"&gt;</code>, preventing the site from appearing in search results.';
    }
}

function previewOgImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('ogPreview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
