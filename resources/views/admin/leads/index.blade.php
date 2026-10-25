@extends('admin.layouts.app')

@section('title', 'Leads Management')
@section('eyebrow', 'Sales Pipeline')
@section('heading', 'Leads Management')
@section('subheading', 'Review, filter and track client callbacks and enquiries.')

@section('actions')
    <a href="{{ route('admin.leads.export', request()->query()) }}" class="adm-btn adm-btn-ghost">
        @include('admin.partials.icon', ['name' => 'download']) Export CSV
    </a>
@endsection

@section('content')
<div class="adm-card" style="margin-bottom: 20px;">
    <div class="adm-card-body" style="padding: 16px 20px;">
        <form method="GET" action="{{ route('admin.leads.index') }}" class="adm-filters">
            <!-- Search Input -->
            <div class="adm-search">
                @include('admin.partials.icon', ['name' => 'search'])
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search name, phone, email..." class="adm-input">
            </div>

            <!-- Status Filter -->
            <select name="status" class="adm-select" onchange="this.form.submit()">
                <option value="">All Statuses</option>
                @foreach($statuses as $stKey => $stLabel)
                    <option value="{{ $stKey }}" {{ request('status') === $stKey ? 'selected' : '' }}>
                        {{ $stLabel }} ({{ $counts[$stKey] ?? 0 }})
                    </option>
                @endforeach
            </select>

            <!-- Project Filter -->
            @if($projects->isNotEmpty())
                <select name="project" class="adm-select" onchange="this.form.submit()">
                    <option value="">All Communities</option>
                    @foreach($projects as $proj)
                        <option value="{{ $proj }}" {{ request('project') === $proj ? 'selected' : '' }}>
                            {{ $proj }}
                        </option>
                    @endforeach
                </select>
            @endif

            <button type="submit" class="adm-btn adm-btn-ghost">Filter</button>
            @if(request()->hasAny(['q', 'status', 'project']))
                <a href="{{ route('admin.leads.index') }}" class="adm-btn adm-btn-ghost" style="color: var(--text-faint);">Clear</a>
            @endif
        </form>
    </div>
</div>

<div class="adm-card">
    <div class="adm-card-head">
        <div>
            <h2>Submitted Inquiries</h2>
            <p>Showing {{ $leads->total() }} total lead records</p>
        </div>
    </div>

    @if($leads->isEmpty())
        <div class="adm-empty">
            @include('admin.partials.icon', ['name' => 'inbox'])
            <h3>No leads found</h3>
            <p>No enquiries match your current filters.</p>
        </div>
    @else
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client Details</th>
                        <th>Phone</th>
                        <th>Project / Community</th>
                        <th>Country</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="text-align: right;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($leads as $lead)
                        <tr>
                            <td><span class="adm-chip">#{{ $lead->id }}</span></td>
                            <td>
                                <div class="adm-cell-main">{{ $lead->name }}</div>
                                <div class="adm-cell-sub">{{ $lead->email ?: 'No email provided' }}</div>
                            </td>
                            <td>
                                <a href="tel:{{ $lead->phone }}" style="font-weight: 600; color: var(--text); display:flex; align-items:center; gap:4px;">
                                    @include('admin.partials.icon', ['name' => 'phone']) {{ $lead->phone }}
                                </a>
                            </td>
                            <td><div class="adm-truncate">{{ $lead->project ?? 'Hudayriyat Island' }}</div></td>
                            <td>
                                @if($lead->country)
                                    <span class="adm-chip">{{ $lead->country }}</span>
                                @else
                                    <span class="adm-cell-sub">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="adm-badge adm-badge-{{ $lead->status }}">
                                    {{ $statuses[$lead->status] ?? ucfirst($lead->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="adm-cell-sub">{{ $lead->created_at?->format('d M Y, h:i A') }}</div>
                            </td>
                            <td style="text-align: right;">
                                <a href="{{ route('admin.leads.show', $lead) }}" class="adm-btn adm-btn-ghost adm-btn-sm">
                                    View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($leads->hasPages())
            <div class="adm-pagination">
                <div>Showing {{ $leads->firstItem() }} to {{ $leads->lastItem() }} of {{ $leads->total() }}</div>
                <div class="adm-pages">
                    {{-- Previous Page Link --}}
                    @if ($leads->onFirstPage())
                        <span class="adm-page is-disabled">&laquo;</span>
                    @else
                        <a href="{{ $leads->previousPageUrl() }}" class="adm-page">&laquo;</a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($leads->getUrlRange(1, $leads->lastPage()) as $page => $url)
                        @if ($page == $leads->currentPage())
                            <span class="adm-page is-active">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="adm-page">{{ $page }}</a>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($leads->hasMorePages())
                        <a href="{{ $leads->nextPageUrl() }}" class="adm-page">&raquo;</a>
                    @else
                        <span class="adm-page is-disabled">&raquo;</span>
                    @endif
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
