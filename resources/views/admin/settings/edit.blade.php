@extends('layouts.admin')
@section('title', 'Appearance')
@section('content')
<div><p class="text-xs font-extrabold uppercase tracking-[.18em] text-violet-600">Appearance</p><h1 class="admin-title mt-2">Site identity & content</h1><p class="admin-subtitle">Manage the brand, homepage introduction and contact details used throughout the website.</p></div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data" class="mt-8 space-y-6">@csrf @method('PUT')
    <section id="identity" class="admin-card p-6 sm:p-7">
        <div class="border-b border-slate-100 pb-5"><h2 class="font-extrabold text-slate-950">Site identity</h2><p class="mt-1 text-xs text-slate-500">Core brand details displayed in the header and dashboard.</p></div>
        <div class="mt-6 grid gap-6 lg:grid-cols-[180px_1fr]">
            <div><p class="form-label">Current logo</p><div class="grid aspect-square max-w-36 place-items-center overflow-hidden rounded-3xl border border-dashed border-slate-300 bg-slate-50">@if(($settings['logo_path']->value ?? null))<img src="{{ asset('storage/'.$settings['logo_path']->value) }}" class="size-full object-cover" alt="Current logo">@else<span class="grid size-16 place-items-center rounded-2xl bg-slate-950 text-lg font-extrabold text-white">KB</span>@endif</div></div>
            <div class="grid content-start gap-5 sm:grid-cols-2"><div><label class="form-label">Site title</label><input class="form-input" name="settings[site_title]" value="{{ old('settings.site_title', $settings['site_title']->value ?? '') }}" required></div><div><label class="form-label">Tagline</label><input class="form-input" name="settings[site_tagline]" value="{{ old('settings.site_tagline', $settings['site_tagline']->value ?? '') }}"></div><div class="sm:col-span-2"><label class="form-label">Upload logo</label><input class="form-input file:mr-4 file:rounded-lg file:border-0 file:bg-slate-950 file:px-3 file:py-2 file:text-xs file:font-bold file:text-white" type="file" name="logo" accept=".jpg,.jpeg,.png,.webp"><p class="mt-2 text-xs text-slate-400">PNG, JPG or WebP. Maximum 2 MB. A square image works best.</p></div></div>
        </div>
    </section>

    <section class="admin-card p-6 sm:p-7">
        <div class="border-b border-slate-100 pb-5"><h2 class="font-extrabold text-slate-950">Homepage introduction</h2><p class="mt-1 text-xs text-slate-500">The primary message visitors see when they arrive.</p></div>
        <div class="mt-6 grid gap-5 sm:grid-cols-2"><div class="sm:col-span-2"><label class="form-label">Status label</label><input class="form-input" name="settings[hero_eyebrow]" value="{{ old('settings.hero_eyebrow', $settings['hero_eyebrow']->value ?? '') }}"></div><div class="sm:col-span-2"><label class="form-label">Main headline</label><input class="form-input" name="settings[hero_title]" value="{{ old('settings.hero_title', $settings['hero_title']->value ?? '') }}"></div><div class="sm:col-span-2"><label class="form-label">Hero description</label><textarea class="form-input min-h-28" name="settings[hero_description]">{{ old('settings.hero_description', $settings['hero_description']->value ?? '') }}</textarea></div><div><label class="form-label">About heading</label><input class="form-input" name="settings[about_title]" value="{{ old('settings.about_title', $settings['about_title']->value ?? '') }}"></div><div><label class="form-label">About text</label><textarea class="form-input min-h-32" name="settings[about_text]">{{ old('settings.about_text', $settings['about_text']->value ?? '') }}</textarea></div></div>
    </section>

    <section id="contact" class="admin-card p-6 sm:p-7">
        <div class="border-b border-slate-100 pb-5"><h2 class="font-extrabold text-slate-950">Contact information</h2><p class="mt-1 text-xs text-slate-500">Used on the contact page and future service enquiries.</p></div>
        <div class="mt-6 grid gap-5 sm:grid-cols-3"><div><label class="form-label">Email</label><input class="form-input" type="email" name="settings[email]" value="{{ old('settings.email', $settings['email']->value ?? '') }}"></div><div><label class="form-label">Phone</label><input class="form-input" name="settings[phone]" value="{{ old('settings.phone', $settings['phone']->value ?? '') }}"></div><div><label class="form-label">Location</label><input class="form-input" name="settings[location]" value="{{ old('settings.location', $settings['location']->value ?? '') }}"></div></div>
    </section>

    <section id="social" class="admin-card p-6 sm:p-7">
        <div class="border-b border-slate-100 pb-5"><h2 class="font-extrabold text-slate-950">Social profiles</h2><p class="mt-1 text-xs text-slate-500">Add full profile URLs, or use # until a profile is ready.</p></div>
        <div class="mt-6 grid gap-5 sm:grid-cols-3"><div><label class="form-label">GitHub URL</label><input class="form-input" name="settings[github_url]" value="{{ old('settings.github_url', $settings['github_url']->value ?? '') }}"></div><div><label class="form-label">LinkedIn URL</label><input class="form-input" name="settings[linkedin_url]" value="{{ old('settings.linkedin_url', $settings['linkedin_url']->value ?? '') }}"></div><div><label class="form-label">Facebook URL</label><input class="form-input" name="settings[facebook_url]" value="{{ old('settings.facebook_url', $settings['facebook_url']->value ?? '') }}"></div></div>
    </section>

    <div class="sticky bottom-5 flex justify-end"><button class="admin-btn shadow-xl shadow-slate-900/15" type="submit"><x-icon name="save" class="size-4" />Save site settings</button></div>
</form>
@endsection
