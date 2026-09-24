@extends('layouts.admin')
@section('title', 'Pages')
@section('content')
<div><p class="text-xs font-extrabold uppercase tracking-[.18em] text-violet-600">Website content</p><h1 class="admin-title mt-2">System pages</h1><p class="admin-subtitle">Core pages are protected and always available. You can edit their content, SEO and navigation visibility.</p></div>
<section class="admin-card mt-8 overflow-hidden">
    <div class="overflow-x-auto"><table class="admin-table"><thead><tr><th>Page</th><th>URL</th><th>Navigation</th><th>Status</th><th>Updated</th><th></th></tr></thead><tbody>
    @foreach($pages as $page)<tr><td><div class="flex items-center gap-3"><span class="grid size-10 place-items-center rounded-xl bg-violet-50 text-violet-600"><x-icon name="files" class="size-4" /></span><div><p class="font-extrabold text-slate-900">{{ $page->title }}</p>@if($page->is_system)<p class="mt-1 text-[10px] font-extrabold uppercase tracking-wider text-slate-400">System default</p>@endif</div></div></td><td><code class="rounded bg-slate-100 px-2 py-1 text-xs text-slate-500">/{{ $page->slug === 'home' ? '' : $page->slug }}</code></td><td><span class="status-pill {{ $page->show_in_navigation ? 'status-live' : 'status-draft' }}">{{ $page->show_in_navigation ? 'Visible' : 'Hidden' }}</span></td><td><span class="status-pill {{ $page->is_published ? 'status-live' : 'status-draft' }}">{{ $page->is_published ? 'Published' : 'Draft' }}</span></td><td class="text-slate-500">{{ $page->updated_at->diffForHumans() }}</td><td><a href="{{ route('admin.pages.edit', $page) }}" class="admin-btn-soft !px-3 !py-2"><x-icon name="edit" class="size-4" />Edit</a></td></tr>@endforeach
    </tbody></table></div>
</section>
@endsection
