<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Admin Login · Hudayriyat Island</title>
    <meta name="description" content="Secure sign-in to the Hudayriyat Island content management system.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}">
</head>
<body>
<div class="adm-login">
    <section class="adm-login-visual" aria-hidden="true">
        <img src="{{ asset('images/hero/slide-1.jpg') }}" alt="">
        <div class="adm-login-copy">
            <div class="adm-eyebrow" style="margin-bottom:14px">Content Management System</div>
            <h2>Manage <span>Hudayriyat Island</span><br>with elegance.</h2>
            <p>Edit website copy, curate the table of contents and follow up on every callback request — all from one place.</p>
            <div class="adm-login-features">
                <div>@include('admin.partials.icon', ['name' => 'edit']) Live text editing</div>
                <div>@include('admin.partials.icon', ['name' => 'list']) TOC manager</div>
                <div>@include('admin.partials.icon', ['name' => 'users']) Lead pipeline</div>
            </div>
        </div>
    </section>

    <section class="adm-login-panel">
        <div class="adm-login-card">
            <div class="adm-brand">
                <div class="adm-brand-mark">H</div>
                <div class="adm-brand-text">
                    <strong>Hudayriyat</strong>
                    <span>Admin CMS</span>
                </div>
            </div>

            <h1>Welcome back</h1>
            <p>Sign in with your administrator account to continue.</p>

            @if(session('success'))
                <div class="adm-alert adm-alert-success" role="status">
                    @include('admin.partials.icon', ['name' => 'check'])
                    <div>{{ session('success') }}</div>
                </div>
            @endif
            @if($errors->any())
                <div class="adm-alert adm-alert-error" role="alert">
                    @include('admin.partials.icon', ['name' => 'alert'])
                    <div>{{ $errors->first() }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}" id="adminLoginForm" novalidate>
                @csrf
                <div class="adm-field">
                    <label class="adm-label" for="loginEmail">Email address</label>
                    <div class="adm-input-icon">
                        @include('admin.partials.icon', ['name' => 'mail'])
                        <input type="email" name="email" id="loginEmail" class="adm-input" value="{{ old('email') }}" placeholder="admin@hudayriyat.com" autocomplete="username" required autofocus>
                    </div>
                </div>
                <div class="adm-field">
                    <label class="adm-label" for="loginPassword">Password</label>
                    <div class="adm-input-icon">
                        @include('admin.partials.icon', ['name' => 'lock'])
                        <input type="password" name="password" id="loginPassword" class="adm-input" placeholder="••••••••" autocomplete="current-password" required>
                        <button type="button" class="adm-pass-toggle" id="togglePasswordBtn" aria-label="Show password">SHOW</button>
                    </div>
                </div>
                <div class="adm-field" style="margin-bottom:24px">
                    <label class="adm-check" for="loginRemember">
                        <input type="checkbox" name="remember" id="loginRemember" value="1"> Keep me signed in
                    </label>
                </div>
                <button type="submit" class="adm-btn adm-btn-primary adm-btn-block" id="loginSubmitBtn" style="padding:13px">
                    Sign in to Dashboard
                </button>
            </form>

            <div class="adm-login-foot">
                @include('admin.partials.icon', ['name' => 'shield']) &nbsp;Protected area · <a href="{{ url('/') }}" id="backToSiteLink">Back to website</a>
            </div>
        </div>
    </section>
</div>
<style>.adm-login-foot svg { width: 13px; height: 13px; vertical-align: -2px; }</style>
<script>
    const passInput = document.getElementById('loginPassword');
    const passBtn = document.getElementById('togglePasswordBtn');
    passBtn.addEventListener('click', () => {
        const show = passInput.type === 'password';
        passInput.type = show ? 'text' : 'password';
        passBtn.textContent = show ? 'HIDE' : 'SHOW';
        passBtn.setAttribute('aria-label', show ? 'Hide password' : 'Show password');
    });
    document.getElementById('adminLoginForm').addEventListener('submit', () => {
        const btn = document.getElementById('loginSubmitBtn');
        btn.textContent = 'Signing in…';
        btn.style.opacity = '.75';
    });
</script>
</body>
</html>
