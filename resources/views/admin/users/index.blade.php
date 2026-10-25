@extends('admin.layouts.app')

@section('title', 'Users & Permissions')
@section('eyebrow', 'Site Settings')
@section('heading', 'User Management & Granular Access Control')
@section('subheading', 'Manage administrator accounts, assign roles, and configure granular permissions per section.')

@section('actions')
    <a href="{{ route('admin.users.create') }}" class="adm-btn adm-btn-primary">
        @include('admin.partials.icon', ['name' => 'plus']) Add New User
    </a>
@endsection

@section('content')
<div class="adm-card">
    @if(session('success'))
        <div class="adm-alert adm-alert-success" style="margin-bottom: 20px;">
            @include('admin.partials.icon', ['name' => 'check'])
            <div>{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div class="adm-alert adm-alert-danger" style="margin-bottom: 20px;">
            @include('admin.partials.icon', ['name' => 'alert'])
            <div>{{ session('error') }}</div>
        </div>
    @endif

    <div style="overflow-x: auto;">
        <table class="adm-table" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="width: 40px;">#</th>
                    <th>User</th>
                    <th>Role</th>
                    <th>Granular Permissions</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th style="text-align: right; width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $u)
                    <tr>
                        <td style="color: #9ca3af; font-size: 12px;">{{ $loop->iteration }}</td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 36px; height: 36px; border-radius: 50%; background: #1a4731; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; font-size: 14px;">
                                    {{ strtoupper(substr($u->name, 0, 1)) }}
                                </div>
                                <div>
                                    <strong style="color: #111827; font-size: 14px;">{{ $u->name }}</strong>
                                    @if(auth()->id() === $u->id)
                                        <span class="adm-chip" style="font-size: 10px; background: #ede8e1; color: #1a4731; margin-left: 4px;">You</span>
                                    @endif
                                    <div style="font-size: 12px; color: #6b7280;">{{ $u->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="adm-chip" style="text-transform: uppercase; font-size: 11px; font-weight: 700; 
                                background: {{ $u->role === 'admin' ? '#eff6ff' : ($u->role === 'editor' ? '#f0fdf4' : '#faf5ff') }};
                                color: {{ $u->role === 'admin' ? '#1d4ed8' : ($u->role === 'editor' ? '#15803d' : '#7e22ce') }};">
                                {{ $u->role }}
                            </span>
                        </td>
                        <td>
                            @if($u->isSuperAdmin())
                                <span class="adm-chip" style="background: #ecfdf5; color: #047857; font-size: 11px; font-weight: 600;">
                                    ★ Full Access (All Sections)
                                </span>
                            @else
                                <div style="display: flex; flex-wrap: wrap; gap: 4px;">
                                    @forelse($u->permissions ?? [] as $perm)
                                        <span class="adm-chip" style="background: #f3f4f6; color: #374151; font-size: 10.5px;">
                                            {{ $availablePermissions[$perm] ?? $perm }}
                                        </span>
                                    @empty
                                        <span style="color: #9ca3af; font-size: 12px; font-style: italic;">No permissions assigned</span>
                                    @endforelse
                                </div>
                            @endif
                        </td>
                        <td>
                            @if($u->is_active ?? true)
                                <span class="adm-chip" style="background: #ecfdf5; color: #047857; font-size: 11px;">Active</span>
                            @else
                                <span class="adm-chip" style="background: #fef2f2; color: #dc2626; font-size: 11px;">Suspended</span>
                            @endif
                        </td>
                        <td style="font-size: 12px; color: #6b7280;">
                            {{ $u->created_at ? $u->created_at->format('M d, Y') : '—' }}
                        </td>
                        <td style="text-align: right;">
                            <div style="display: inline-flex; gap: 6px;">
                                <a href="{{ route('admin.users.edit', $u) }}" class="adm-btn adm-btn-ghost adm-btn-sm" title="Edit Permissions">
                                    @include('admin.partials.icon', ['name' => 'edit']) Edit
                                </a>
                                @if(auth()->id() !== $u->id && $users->count() > 1)
                                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}" onsubmit="return confirm('Delete user {{ $u->name }}?')" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="adm-btn adm-btn-danger adm-btn-sm adm-btn-icon" title="Delete User">
                                            @include('admin.partials.icon', ['name' => 'trash'])
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
