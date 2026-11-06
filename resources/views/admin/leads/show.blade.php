@extends('admin.layouts.app')

@section('title', 'Lead #' . $lead->id . ' - ' . $lead->name)
@section('eyebrow', 'Sales Pipeline')
@section('heading', 'Lead #' . $lead->id . ' · ' . $lead->name)
@section('subheading', 'Submitted on ' . ($lead->created_at ? $lead->created_at->format('d M Y, h:i A') : 'N/A'))

@section('actions')
    <a href="{{ route('admin.leads.index') }}" class="adm-btn adm-btn-ghost">
        ← Back to Leads
    </a>
@endsection

@section('content')
<div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; align-items: start;">
    <!-- Left Column: Lead Details -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <!-- Lead Information Card -->
        <div class="adm-card">
            <div class="adm-card-head">
                <div>
                    <h2>Lead Information</h2>
                    <p>Contact information and inquiry origin details.</p>
                </div>
                <span class="adm-badge adm-badge-{{ $lead->status }}">
                    {{ $statuses[$lead->status] ?? ucfirst($lead->status) }}
                </span>
            </div>
            <div class="adm-card-body" style="padding: 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 24px;">
                    <div>
                        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-faint); margin-bottom: 6px;">Client Name</div>
                        <div style="font-size: 17px; font-weight: 700; color: var(--text);">{{ $lead->name }}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-faint); margin-bottom: 6px;">Phone Number</div>
                        <div style="font-size: 16px; font-weight: 600;">
                            <a href="tel:{{ $lead->phone }}" style="color: #1a4731; display: inline-flex; align-items: center; gap: 6px; text-decoration: none;">
                                @include('admin.partials.icon', ['name' => 'phone']) {{ $lead->phone }}
                            </a>
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-faint); margin-bottom: 6px;">Email Address</div>
                        <div style="font-size: 15px;">
                            @if($lead->email)
                                <a href="mailto:{{ $lead->email }}" style="color: #1a4731; text-decoration: underline;">
                                    {{ $lead->email }}
                                </a>
                            @else
                                <span style="color: var(--text-faint);">Not provided</span>
                            @endif
                        </div>
                    </div>
                    <div>
                        <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-faint); margin-bottom: 6px;">Project / Community</div>
                        <div style="font-size: 16px; font-weight: 600; color: var(--text);">{{ $lead->project ?? 'Saima' }}</div>
                    </div>
                </div>

                <!-- Page URL Source Banner -->
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 8px; padding: 16px; margin-bottom: 24px;">
                    <div style="font-size: 12px; font-weight: 700; text-transform: uppercase; color: #475569; margin-bottom: 6px; display: flex; align-items: center; gap: 6px;">
                        <span>🔗 Source Page URL</span>
                        <span style="font-size: 11px; font-weight: 500; color: #64748b;">(Exact website page where lead was submitted)</span>
                    </div>
                    @if($lead->page_url)
                        <div style="display: flex; align-items: center; justify-content: space-between; gap: 12px; flex-wrap: wrap;">
                            <a href="{{ $lead->page_url }}" target="_blank" rel="noopener noreferrer" style="font-size: 14px; font-weight: 600; color: #1a4731; word-break: break-all; text-decoration: underline;">
                                {{ $lead->page_url }}
                            </a>
                            <a href="{{ $lead->page_url }}" target="_blank" rel="noopener noreferrer" class="adm-btn adm-btn-sm adm-btn-primary" style="white-space: nowrap;">
                                Open Live Page ↗
                            </a>
                        </div>
                    @else
                        <div style="font-size: 14px; color: var(--text-faint);">No source URL recorded for this entry.</div>
                    @endif
                </div>

                <!-- Comments & Requirements -->
                <div>
                    <div style="font-size: 12px; font-weight: 600; text-transform: uppercase; color: var(--text-faint); margin-bottom: 6px;">Client Comment / Requirements</div>
                    <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 8px; padding: 16px; font-size: 14px; line-height: 1.6; color: var(--text); min-height: 80px; white-space: pre-wrap;">{{ $lead->comment ?: 'No additional notes provided by client.' }}</div>
                </div>
            </div>
        </div>

        <!-- Technical Metadata Card -->
        <div class="adm-card">
            <div class="adm-card-head">
                <div>
                    <h3>Technical Metadata</h3>
                </div>
            </div>
            <div class="adm-card-body" style="padding: 20px 24px;">
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 16px;">
                    <div>
                        <div style="font-size: 12px; color: var(--text-faint);">Country Detection</div>
                        <div style="font-size: 14px; font-weight: 600; margin-top: 4px;">{{ $lead->country ?: 'Unknown' }}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-faint);">Visitor IP Address</div>
                        <div style="font-size: 14px; font-mono; margin-top: 4px;">{{ $lead->ip_address ?: 'Unknown' }}</div>
                    </div>
                    <div>
                        <div style="font-size: 12px; color: var(--text-faint);">Submitted At</div>
                        <div style="font-size: 14px; margin-top: 4px;">{{ $lead->created_at?->format('Y-m-d H:i:s') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Column: Status & Actions -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <!-- Status Card -->
        <div class="adm-card">
            <div class="adm-card-head">
                <div>
                    <h3>Update Status</h3>
                </div>
            </div>
            <div class="adm-card-body" style="padding: 20px;">
                <form method="POST" action="{{ route('admin.leads.status', $lead) }}">
                    @csrf
                    @method('PATCH')
                    <div style="margin-bottom: 16px;">
                        <label class="adm-label" for="leadStatusSelect">Pipeline Status</label>
                        <select name="status" id="leadStatusSelect" class="adm-select" style="width: 100%;">
                            @foreach($statuses as $stKey => $stLabel)
                                <option value="{{ $stKey }}" {{ $lead->status === $stKey ? 'selected' : '' }}>
                                    {{ $stLabel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="adm-btn adm-btn-primary" style="width: 100%;">
                        Save Status
                    </button>
                </form>
            </div>
        </div>

        <!-- Danger Zone Card -->
        <div class="adm-card">
            <div class="adm-card-head">
                <div>
                    <h3 style="color: #dc2626;">Danger Zone</h3>
                </div>
            </div>
            <div class="adm-card-body" style="padding: 20px;">
                <p style="font-size: 13px; color: var(--text-faint); margin-bottom: 16px;">
                    Permanently delete this lead record from the database. This action cannot be undone.
                </p>
                <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" onsubmit="return confirm('Are you sure you want to permanently delete lead #{{ $lead->id }}?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="adm-btn adm-btn-danger" style="width: 100%;">
                        @include('admin.partials.icon', ['name' => 'trash']) Delete Lead
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
