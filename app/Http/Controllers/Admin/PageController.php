<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Support\SafeHtml;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.index', [
            'pages' => Page::query()->orderBy('sort_order')->get(),
            'activeModule' => 'content',
        ]);
    }

    public function edit(Page $page): View
    {
        return view('admin.pages.edit', compact('page') + ['activeModule' => 'content']);
    }

    public function update(Request $request, Page $page): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:120'],
            'eyebrow' => ['nullable', 'string', 'max:120'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['nullable', 'string', 'max:30000'],
            'meta_title' => ['nullable', 'string', 'max:160'],
            'meta_description' => ['nullable', 'string', 'max:300'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
        ]);

        $validated['is_published'] = $page->is_system ? true : $request->boolean('is_published');
        $validated['show_in_navigation'] = $request->boolean('show_in_navigation');
        $validated['content'] = SafeHtml::clean($validated['content'] ?? '');
        $page->update($validated);

        return back()->with('status', 'Page updated successfully.');
    }
}
