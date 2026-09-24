<!DOCTYPE html>
<html lang="en">
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><meta name="robots" content="noindex,nofollow"><meta name="theme-color" content="#020810"><title>Sign in — K Bashar</title>@vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body class="login-body">
    <main class="login-shell">
        <section class="login-visual">
            <a href="{{ route('home') }}" class="tech-brand"><span class="tech-brand__mark">KB</span><span><strong>K Bashar</strong><small>Operations console</small></span></a>
            <div class="login-visual__copy"><div class="tech-kicker"><span></span>SECURE ADMINISTRATION</div><h1>One focused console for your entire digital presence.</h1><p>Manage content, services, projects and enquiries from a purpose-built workspace.</p></div>
            <div class="login-nodes"><span></span><span></span><span></span><span></span><i></i></div>
            <div class="login-system"><i></i><span><small>SYSTEM STATUS</small><strong>Encrypted connection active</strong></span></div>
        </section>
        <section class="login-form-panel">
            <div class="login-form-wrap">
                <div class="login-form-head"><small>ADMIN ACCESS / AUTH_01</small><h2>Sign in to the console</h2><p>Use your administrator credentials to continue.</p></div>
                <form method="POST" action="{{ route('login.store') }}" class="login-form">@csrf
                    <div><label for="email">Email address</label><div class="login-input"><x-icon name="mail" /><input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="email" placeholder="admin@example.com"></div>@error('email')<p class="form-error">{{ $message }}</p>@enderror</div>
                    <div><label for="password">Password</label><div class="login-input"><x-icon name="shield" /><input type="password" id="password" name="password" required autocomplete="current-password" placeholder="••••••••••••"></div></div>
                    <label class="login-remember"><input type="checkbox" name="remember" value="1"><span>Keep this session active</span></label>
                    <button class="tech-btn" type="submit">Authenticate <x-icon name="arrow-right" /></button>
                </form>
                <a href="{{ route('home') }}" class="login-back"><x-icon name="arrow-right" />Return to website</a>
            </div>
        </section>
    </main>
</body>
</html>
