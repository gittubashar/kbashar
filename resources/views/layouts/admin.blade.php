<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="theme-color" content="#020810">
    <title>@yield('title', 'Dashboard') — {{ \App\Models\SiteSetting::value('site_title', 'K Bashar') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="admin-body">
@php
    $modules = config('dashboard.modules');
    $currentModule = $modules[$activeModule ?? 'overview'];
    $siteTitle = \App\Models\SiteSetting::value('site_title', 'K Bashar');
    $logoPath = \App\Models\SiteSetting::value('logo_path');
    $unreadCount = \App\Models\ContactMessage::query()->whereNull('read_at')->count();
@endphp
<header class="admin-topbar">
    <a class="admin-brand" href="{{ route('admin.dashboard') }}">
        @if($logoPath)<img src="{{ asset('storage/'.$logoPath) }}" class="admin-brand-mark object-cover" alt="{{ $siteTitle }}">@else<span class="admin-brand-mark">KB</span>@endif
        <span class="admin-brand-copy"><strong>{{ $siteTitle }}</strong><small>Operations console</small></span>
    </a>
    <div class="admin-modules">
        <button type="button" data-sidebar-toggle class="admin-sidebar-trigger" aria-label="Toggle sidebar"><x-icon name="menu" /></button>
        @foreach($modules as $key => $module)
            <a href="{{ route($module['route']) }}" class="admin-module-link {{ ($activeModule ?? 'overview') === $key ? 'is-active' : '' }}">
                <span><x-icon :name="$module['icon']" />@if($key === 'messages' && $unreadCount)<i></i>@endif</span>
                <b>{{ $module['label'] }}</b>
            </a>
        @endforeach
    </div>
    <div class="admin-topbar-actions">
        <span class="admin-health"><i></i><b>System online</b></span>
        <a href="{{ route('home') }}" target="_blank" class="admin-icon-btn" title="View website"><x-icon name="external-link" /></a>
        <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
    </div>
</header>

<aside data-admin-sidebar class="admin-sidebar">
    <div class="admin-sidebar-head">
        <div><small>ACTIVE MODULE / 0{{ array_search($activeModule ?? 'overview', array_keys($modules), true) + 1 }}</small><strong>{{ $currentModule['label'] }}</strong></div>
        <button type="button" data-sidebar-toggle aria-label="Close sidebar"><x-icon name="x" /></button>
    </div>
    <nav class="admin-side-nav">
        @foreach($currentModule['items'] as $item)
            @php $itemUrl = route($item['route'], $item['params'] ?? []); @endphp
            <a href="{{ $itemUrl }}" class="admin-side-link {{ request()->fullUrlIs($itemUrl) || request()->url() === strtok($itemUrl, '?') ? 'is-active' : '' }}" @if($item['route'] === 'home' || in_array($item['route'], ['services','contact'])) target="_blank" @endif>
                <span><x-icon :name="$item['icon']" /></span><b>{{ $item['label'] }}</b>
                @if($item['route'] === 'admin.messages.index' && $unreadCount)<em>{{ $unreadCount }}</em>@endif
                @if(in_array($item['route'], ['home','services','contact']))<x-icon name="external-link" class="admin-side-external" />@endif
            </a>
        @endforeach
    </nav>
    <div class="admin-sidebar-status"><span class="admin-radar"><i></i></span><div><small>WORKSPACE STATUS</small><strong>All systems nominal</strong></div></div>
    <div class="admin-user-panel"><div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div><div><strong>{{ auth()->user()->name }}</strong><small>{{ auth()->user()->email }}</small></div></div>
    <form method="POST" action="{{ route('admin.logout') }}">@csrf<button class="admin-side-link admin-signout" type="submit"><span><x-icon name="logout" /></span><b>Sign out</b></button></form>
</aside>

<main class="admin-main">
    <div class="admin-scanline"></div>
    <div class="admin-content">
        <div class="admin-breadcrumb"><span>KB / Control centre</span><i></i><strong>{{ strtoupper($currentModule['label']) }}</strong></div>
        @if(session('status'))<div class="admin-notice admin-notice--success"><x-icon name="check" />{{ session('status') }}</div>@endif
        @if($errors->any())<div class="admin-notice admin-notice--error"><strong>Please correct the highlighted fields.</strong><ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
        @yield('content')
    </div>
</main>
</body>
</html>
