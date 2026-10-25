@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('eyebrow', now()->format('l, d F Y'))
@section('heading', 'Welcome, ' . explode(' ', auth()->user()->name)[0])
@section('subheading', 'Here is what is happening across the Hudayriyat Island website today.')

@section('actions')
    <a href="{{ route('admin.leads.export') }}" class="adm-btn adm-btn-ghost" id="dashExportBtn">
        @include('admin.partials.icon', ['name' => 'download']) Export Leads
    </a>
    <a href="{{ route('admin.content.index') }}" class="adm-btn adm-btn-primary" id="dashEditContentBtn">
        @include('admin.partials.icon', ['name' => 'edit']) Edit Website
    </a>
@endsection

@section('content')
    <div class="adm-grid adm-grid-stats">
        <div class="adm-card adm-stat">
            <div class="adm-stat-icon">@include('admin.partials.icon', ['name' => 'inbox'])</div>
            <div class="adm-stat-label">Total Leads</div>
            <div class="adm-stat-value">{{ number_format($stats['total']) }}</div>
        </div>
        <div class="adm-card adm-stat">
            <div class="adm-stat-icon">@include('admin.partials.icon', ['name' => 'spark'])</div>
            <div class="adm-stat-label">New / Uncontacted</div>
            <div class="adm-stat-value">{{ number_format($stats['new']) }}</div>
        </div>
        <div class="adm-card adm-stat">
            <div class="adm-stat-icon">@include('admin.partials.icon', ['name' => 'calendar'])</div>
            <div class="adm-stat-label">Leads Today</div>
            <div class="adm-stat-value">{{ number_format($stats['today']) }}</div>
        </div>
        <div class="adm-card adm-stat">
            <div class="adm-stat-icon">@include('admin.partials.icon', ['name' => 'trend'])</div>
            <div class="adm-stat-label">Last 7 Days</div>
            <div class="adm-stat-value">{{ number_format($stats['week']) }}</div>
        </div>
    </div>

    <div class="adm-grid adm-grid-2" style="margin-bottom:22px">
        <div class="adm-card" style="animation-delay:.15s">
            <div class="adm-card-head">
                <div>
                    <h2>Lead Activity</h2>
                    <p>Form submissions over the last 14 days</p>
                </div>
            </div>
            <div class="adm-card-body">
                @php $max = max(1, $chart->max('count')); @endphp
                <div class="adm-chart" role="img" aria-label="Leads per day chart">
                    @foreach($chart as $i => $day)
                        <div class="adm-bar-col" title="{{ $day['label'] }}: {{ $day['count'] }} lead(s)">
                            <div class="adm-bar {{ $day['count'] ? '' : 'is-empty' }}" data-count="{{ $day['count'] }}"
                                 style="height: {{ max(3, round($day['count'] / $max * 100)) }}%; animation-delay: {{ $i * 0.04 }}s"></div>
                            <span class="adm-bar-label">{{ substr($day['short'], 0, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="adm-card" style="animation-delay:.2s">
            <div class="adm-card-head">
                <div>
                    <h2>Pipeline</h2>
                    <p>Leads by status</p>
                </div>
            </div>
            <div class="adm-card-body">
                @php
                    $colors = ['new' => 'var(--gold)', 'contacted' => 'var(--info)', 'qualified' => 'var(--violet)', 'converted' => 'var(--success)', 'lost' => 'var(--danger)'];
                    $totalForBreakdown = max(1, $stats['total']);
                @endphp
                <div class="adm-breakdown">
                    @foreach($statusBreakdown as $key => $row)
                        <a class="adm-breakdown-row" href="{{ route('admin.leads.index', ['status' => $key]) }}" style="color:inherit">
                            <div class="adm-breakdown-top">
                                <span>{{ $row['label'] }}</span>
                                <strong>{{ $row['count'] }}</strong>
                            </div>
                            <div class="adm-progress"><span style="width: {{ round($row['count'] / $totalForBreakdown * 100) }}%; --c: {{ $colors[$key] ?? 'var(--brand-light)' }}"></span></div>
                        </a>
                    @endforeach
                </div>
                <div style="display:flex; gap:10px; margin-top:24px; flex-wrap:wrap">
                    <span class="adm-badge adm-badge-muted">{{ $stats['cms'] }} content blocks</span>
                    <span class="adm-badge adm-badge-muted">{{ $stats['toc'] }} TOC items live</span>
                </div>
            </div>
        </div>
    </div>

    <div class="adm-card" style="animation-delay:.25s">
        <div class="adm-card-head">
            <div>
                <h2>Recent Leads</h2>
                <p>Latest callback & enquiry form submissions</p>
            </div>
            <a href="{{ route('admin.leads.index') }}" class="adm-btn adm-btn-ghost adm-btn-sm" id="dashViewAllLeads">View all</a>
        </div>
        @if($recentLeads->isEmpty())
            <div class="adm-empty">
                @include('admin.partials.icon', ['name' => 'inbox'])
                <h3>No leads yet</h3>
                <p>Form submissions from the website will appear here.</p>
            </div>
        @else
            <div class="adm-table-wrap">
                <table class="adm-table">
                    <thead><tr><th>Lead</th><th>Phone</th><th>Project</th><th>Status</th><th>Received</th></tr></thead>
                    <tbody>
                    @foreach($recentLeads as $lead)
                        <tr onclick="location.href='{{ route('admin.leads.show', $lead) }}'" style="cursor:pointer">
                            <td>
                                <div class="adm-cell-main">{{ $lead->name }}</div>
                                <div class="adm-cell-sub">{{ $lead->email ?: '—' }}</div>
                            </td>
                            <td>{{ $lead->phone }}</td>
                            <td class="adm-truncate">{{ $lead->project }}</td>
                            <td><span class="adm-badge adm-badge-{{ $lead->status }}">{{ config('cms.lead_statuses.' . $lead->status, ucfirst($lead->status)) }}</span></td>
                            <td class="adm-cell-sub">{{ $lead->created_at?->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
