<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\PageView;
use App\Models\Project;
use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicSiteController extends Controller
{
    public function home(Request $request): View
    {
        $this->track($request);

        return view('site.home', $this->shared() + [
            'page' => $this->page('home'),
            'services' => Service::query()->where('is_published', true)->orderBy('sort_order')->take(6)->get(),
            'projects' => Project::query()->where('is_published', true)->orderByDesc('is_featured')->orderBy('sort_order')->take(6)->get(),
        ]);
    }

    public function services(Request $request): View
    {
        $this->track($request);

        return view('site.services', $this->shared() + [
            'page' => $this->page('services'),
            'services' => Service::query()->where('is_published', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function contact(Request $request): View
    {
        $this->track($request);

        return view('site.contact', $this->shared() + ['page' => $this->page('contact')]);
    }

    public function legal(Request $request, Page $page): View
    {
        abort_unless(in_array($page->slug, ['privacy-policy', 'terms-of-service'], true) && $page->is_published, 404);
        $this->track($request);

        return view('site.legal', $this->shared() + compact('page'));
    }

    private function page(string $slug): Page
    {
        return Page::query()->where('slug', $slug)->where('is_published', true)->firstOrFail();
    }

    private function shared(): array
    {
        return [
            'settings' => SiteSetting::query()->pluck('value', 'key'),
            'navigation' => Page::query()->where('is_published', true)->where('show_in_navigation', true)->orderBy('sort_order')->get(),
        ];
    }

    private function track(Request $request): void
    {
        PageView::query()->create([
            'path' => '/'.$request->path(),
            'visitor_hash' => hash('sha256', ($request->ip() ?? '').'|'.($request->userAgent() ?? '').'|'.now()->toDateString()),
            'referrer' => $request->headers->get('referer'),
            'viewed_on' => now()->toDateString(),
        ]);
    }
}
