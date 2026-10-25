@extends('admin.layouts.app')

@section('title', 'Website Content')
@section('eyebrow', 'CMS Editor')
@section('heading', 'Website Content')
@section('subheading', 'Edit website text blocks live. Changes reflect immediately on the public website.')

@section('actions')
    <a href="{{ url('/') }}" target="_blank" class="adm-btn adm-btn-ghost">
        @include('admin.partials.icon', ['name' => 'external']) Preview Site
    </a>
@endsection

@section('content')
    <!-- Section Navigation Tabs -->
    <div class="adm-tabs" role="tablist">
        @foreach($groups as $key => $meta)
            @php $count = isset($contents[$key]) ? count($contents[$key]) : 0; @endphp
            <a href="{{ route('admin.content.index', ['group' => $key]) }}"
               class="adm-tab {{ $active === $key ? 'is-active' : '' }}">
                <span>{{ $meta['label'] }}</span>
                <span class="adm-tab-count">({{ $count }})</span>
            </a>
        @endforeach
    </div>

    <!-- Active Section Edit Form -->
    <div class="adm-card">
        <div class="adm-card-head">
            <div>
                <h2>{{ $groups[$active]['label'] ?? 'Content Blocks' }}</h2>
                <p>Update copy for this section and click save.</p>
            </div>
            <span class="adm-chip">{{ count($contents[$active] ?? []) }} blocks</span>
        </div>

        <div class="adm-card-body">
            @if(empty($contents[$active]) || $contents[$active]->isEmpty())
                <div class="adm-empty">
                    @include('admin.partials.icon', ['name' => 'edit'])
                    <h3>No content blocks found</h3>
                    <p>There are no content blocks defined in this group.</p>
                </div>
            @else
                <form method="POST" action="{{ route('admin.content.update') }}" id="contentForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="group" value="{{ $active }}">

                    @foreach($contents[$active] as $item)
                        <div class="adm-content-item" id="item-{{ $item->key }}">
                            <div class="adm-field">
                                <div class="adm-label">
                                    <span>
                                        <span class="adm-dirty-dot"></span>
                                        {{ $item->label }}
                                    </span>
                                    <div class="adm-content-tools">
                                        <span class="adm-chip">{{ $item->key }}</span>
                                        @if(in_array($item->key, $registeredKeys))
                                            <button type="submit" form="reset-{{ $item->id }}" class="adm-btn adm-btn-ghost adm-btn-sm" title="Reset to original text" style="padding: 2px 7px; font-size: 11px;">
                                                @include('admin.partials.icon', ['name' => 'reset']) Reset
                                            </button>
                                        @else
                                            <button type="submit" form="delete-{{ $item->id }}" class="adm-btn adm-btn-danger adm-btn-sm" title="Delete custom block" style="padding: 2px 7px; font-size: 11px;">
                                                @include('admin.partials.icon', ['name' => 'trash'])
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                @if($item->type === 'textarea')
                                    <textarea name="contents[{{ $item->key }}]" class="adm-textarea adm-summernote content-input" rows="4">{{ $item->value }}</textarea>
                                @elseif($item->type === 'list')
                                    <textarea name="contents[{{ $item->key }}]" class="adm-textarea content-input" rows="4">{{ $item->value }}</textarea>
                                    <div class="adm-help">One item per line. Rendered as a bulleted list.</div>
                                @else
                                    <input type="text" name="contents[{{ $item->key }}]" value="{{ $item->value }}" class="adm-input content-input">
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <div class="adm-sticky-save">
                        <span>Save all edits in <strong>{{ $groups[$active]['label'] }}</strong></span>
                        <button type="submit" class="adm-btn adm-btn-primary" id="saveContentBtn">
                            @include('admin.partials.icon', ['name' => 'check']) Save Changes
                        </button>
                    </div>
                </form>

                <!-- Hidden Reset/Delete Forms -->
                @foreach($contents[$active] as $item)
                    @if(in_array($item->key, $registeredKeys))
                        <form id="reset-{{ $item->id }}" method="POST" action="{{ route('admin.content.reset', $item) }}" data-confirm="Reset '{{ $item->label }}' to original default text?" style="display:none;">@csrf</form>
                    @else
                        <form id="delete-{{ $item->id }}" method="POST" action="{{ route('admin.content.destroy', $item) }}" data-confirm="Delete custom block '{{ $item->label }}'?" style="display:none;">@csrf @method('DELETE')</form>
                    @endif
                @endforeach
            @endif
        </div>
    </div>

    <!-- Add Custom Content Block Modal/Card -->
    <details class="adm-card adm-details" style="margin-top: 24px;">
        <summary class="adm-card-head" style="cursor: pointer;">
            <div>
                <h2 style="display:flex; align-items:center; gap:8px;">
                    @include('admin.partials.icon', ['name' => 'plus']) Add Custom Text Block
                </h2>
                <p>Register a new custom text key that can be called anywhere in Blade views.</p>
            </div>
            <span class="adm-btn adm-btn-ghost adm-btn-sm">Expand</span>
        </summary>
        <div class="adm-card-body">
            <form method="POST" action="{{ route('admin.content.store') }}">
                @csrf
                <div class="adm-form-row">
                    <div class="adm-field">
                        <label class="adm-label" for="newKey">Key Identifier (snake_case)</label>
                        <input type="text" id="newKey" name="key" required placeholder="e.g. promo_banner_text" class="adm-input" pattern="^[a-z0-9_]+$">
                        <div class="adm-help">Usage: @{{ cms('your_key') }}</div>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label" for="newLabel">Admin Label</label>
                        <input type="text" id="newLabel" name="label" required placeholder="e.g. Promo Banner Heading" class="adm-input">
                    </div>
                </div>

                <div class="adm-form-row">
                    <div class="adm-field">
                        <label class="adm-label" for="newGroup">Group Section</label>
                        <select id="newGroup" name="group" class="adm-select" required>
                            @foreach($groups as $k => $meta)
                                <option value="{{ $k }}" {{ $k === $active ? 'selected' : '' }}>{{ $meta['label'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="adm-field">
                        <label class="adm-label" for="newType">Input Type</label>
                        <select id="newType" name="type" class="adm-select" required>
                            <option value="text">Single Line Text</option>
                            <option value="textarea">Multi-line Textarea</option>
                            <option value="list">List (one item per line)</option>
                        </select>
                    </div>
                </div>

                <div class="adm-field">
                    <label class="adm-label" for="newValue">Initial Content</label>
                    <textarea id="newValue" name="value" class="adm-textarea" placeholder="Enter content..."></textarea>
                </div>

                <button type="submit" class="adm-btn adm-btn-primary">
                    @include('admin.partials.icon', ['name' => 'plus']) Create Block
                </button>
            </form>
        </div>
    </details>

    @push('scripts')
    <script>
        document.querySelectorAll('.content-input').forEach(input => {
            const originalVal = input.value;
            input.addEventListener('input', () => {
                const item = input.closest('.adm-content-item');
                if (item) {
                    if (input.value !== originalVal) {
                        item.classList.add('is-dirty');
                    } else {
                        item.classList.remove('is-dirty');
                    }
                }
            });
        });
    </script>
    @endpush
@endsection
