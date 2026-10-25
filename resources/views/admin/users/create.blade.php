@extends('admin.layouts.app')

@section('title', 'Add New User')
@section('eyebrow', 'Users & Permissions')
@section('heading', 'Create Admin User')
@section('subheading', 'Set up credentials, assign role, and configure granular permissions.')

@section('content')
<div class="adm-card" style="max-width: 740px; margin: 0 auto; padding: 26px;">
    @if($errors->any())
        <div class="adm-alert adm-alert-danger" style="margin-bottom: 20px;">
            @include('admin.partials.icon', ['name' => 'alert'])
            <div>
                <strong>Please check the form errors:</strong>
                <ul style="margin: 6px 0 0 16px; padding: 0;">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.users.store') }}">
        @csrf

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px;">
            <div class="adm-field">
                <label class="adm-label" for="userName">Full Name <span style="color:#ef4444">*</span></label>
                <input type="text" name="name" id="userName" value="{{ old('name') }}" class="adm-input" required placeholder="e.g. John Doe">
            </div>

            <div class="adm-field">
                <label class="adm-label" for="userEmail">Email Address <span style="color:#ef4444">*</span></label>
                <input type="email" name="email" id="userEmail" value="{{ old('email') }}" class="adm-input" required placeholder="user@company.com">
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 22px;">
            <div class="adm-field">
                <label class="adm-label" for="userPassword">Password <span style="color:#ef4444">*</span></label>
                <input type="password" name="password" id="userPassword" class="adm-input" required minlength="6" placeholder="At least 6 characters">
            </div>

            <div class="adm-field">
                <label class="adm-label" for="userRole">Role <span style="color:#ef4444">*</span></label>
                <select name="role" id="userRole" class="adm-select" onchange="handleRoleChange(this.value)">
                    <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Administrator (Full Access)</option>
                    <option value="editor" {{ old('role', 'editor') === 'editor' ? 'selected' : '' }}>Editor (Custom Permissions)</option>
                    <option value="manager" {{ old('role') === 'manager' ? 'selected' : '' }}>Sales / Marketing Manager</option>
                    <option value="staff" {{ old('role') === 'staff' ? 'selected' : '' }}>Staff / Viewer</option>
                </select>
            </div>
        </div>

        <!-- GRANULAR ACCESS CONTROL CHECKBOXES -->
        <div style="background: #faf8f5; border: 1.5px solid #ede8e1; border-radius: 10px; padding: 20px; margin-bottom: 24px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                <div>
                    <h4 style="margin: 0; font-size: 15px; font-weight: 700; color: #111827;">Granular Access Permissions</h4>
                    <span style="font-size: 12.5px; color: #6b7280;">Check the specific sections this user is allowed to access and manage:</span>
                </div>
                <button type="button" class="adm-btn adm-btn-ghost adm-btn-sm" onclick="toggleAllPermissions()" style="font-size: 12px; padding: 3px 10px;">Select All</button>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;" id="permissionsGrid">
                @foreach($availablePermissions as $pKey => $pLabel)
                    <label class="adm-check" style="cursor: pointer; padding: 10px 14px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 6px; display: flex; align-items: center; gap: 10px; font-size: 13.5px; font-weight: 600; color: #1f2937;">
                        <input type="checkbox" name="permissions[]" value="{{ $pKey }}" class="perm-checkbox" {{ in_array($pKey, old('permissions', ['pages', 'toc'])) ? 'checked' : '' }}>
                        <span>{{ $pLabel }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="adm-field" style="margin-bottom: 24px;">
            <label class="adm-check" style="cursor: pointer; font-weight: 600;">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                User account is Active (can log into CMS)
            </label>
        </div>

        <div style="display: flex; gap: 12px; border-top: 1px solid #f0ede8; padding-top: 18px;">
            <button type="submit" class="adm-btn adm-btn-primary" style="padding: 12px 24px; font-weight: 700;">
                @include('admin.partials.icon', ['name' => 'check']) Create User
            </button>
            <a href="{{ route('admin.users.index') }}" class="adm-btn adm-btn-ghost">Cancel</a>
        </div>
    </form>
</div>

<script>
function toggleAllPermissions() {
    const checkboxes = document.querySelectorAll('.perm-checkbox');
    const allChecked = Array.from(checkboxes).every(cb => cb.checked);
    checkboxes.forEach(cb => cb.checked = !allChecked);
}

function handleRoleChange(role) {
    if (role === 'admin') {
        document.querySelectorAll('.perm-checkbox').forEach(cb => cb.checked = true);
    }
}
</script>
@endsection
