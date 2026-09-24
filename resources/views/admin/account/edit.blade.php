@extends('layouts.admin')
@section('title', 'Account Security')
@section('content')
<div><p class="text-xs font-extrabold uppercase tracking-[.18em] text-violet-600">System</p><h1 class="admin-title mt-2">Account security</h1><p class="admin-subtitle">Manage your administrator identity and sign-in password.</p></div>

<form method="POST" action="{{ route('admin.account.update') }}" class="mt-8 grid gap-6 xl:grid-cols-[1fr_340px]">@csrf @method('PUT')
    <div class="space-y-6">
        <section class="admin-card p-6 sm:p-7">
            <div class="border-b border-slate-100 pb-5"><h2 class="font-extrabold text-slate-950">Administrator profile</h2><p class="mt-1 text-xs text-slate-500">These details identify the signed-in administrator.</p></div>
            <div class="mt-6 grid gap-5 sm:grid-cols-2"><div><label class="form-label">Display name</label><input class="form-input" name="name" value="{{ old('name', $user->name) }}" required></div><div><label class="form-label">Email address</label><input class="form-input" type="email" name="email" value="{{ old('email', $user->email) }}" required></div></div>
        </section>
        <section class="admin-card p-6 sm:p-7">
            <div class="border-b border-slate-100 pb-5"><h2 class="font-extrabold text-slate-950">Change password</h2><p class="mt-1 text-xs text-slate-500">Leave these fields blank if you only want to update your profile.</p></div>
            <div class="mt-6 space-y-5"><div><label class="form-label">Current password</label><input class="form-input" type="password" name="current_password" autocomplete="current-password"></div><div class="grid gap-5 sm:grid-cols-2"><div><label class="form-label">New password</label><input class="form-input" type="password" name="password" autocomplete="new-password"><p class="mt-2 text-xs text-slate-400">Use at least 12 characters.</p></div><div><label class="form-label">Confirm new password</label><input class="form-input" type="password" name="password_confirmation" autocomplete="new-password"></div></div></div>
        </section>
    </div>
    <aside><section class="admin-card p-6"><div class="grid size-14 place-items-center rounded-2xl bg-violet-100 text-violet-700"><x-icon name="shield" class="size-7" /></div><h2 class="mt-5 font-extrabold text-slate-950">Keep access private</h2><p class="mt-2 text-xs leading-6 text-slate-500">Change the temporary password before adding real client information. Use a unique password that is not shared with another account.</p><button class="admin-btn mt-6 w-full" type="submit"><x-icon name="save" class="size-4" />Update account</button></section></aside>
</form>
@endsection
