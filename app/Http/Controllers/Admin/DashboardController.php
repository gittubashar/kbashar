<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\PageView;
use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $views = collect(range(6, 0))->map(function (int $daysAgo) {
            $date = now()->subDays($daysAgo)->toDateString();

            return [
                'label' => now()->subDays($daysAgo)->format('D'),
                'value' => PageView::query()->whereDate('viewed_on', $date)->count(),
            ];
        });

        return view('admin.dashboard', [
            'activeModule' => 'overview',
            'stats' => [
                ['label' => 'Published pages', 'value' => Page::query()->where('is_published', true)->count(), 'icon' => 'files', 'tone' => 'violet'],
                ['label' => 'Active services', 'value' => Service::query()->where('is_published', true)->count(), 'icon' => 'briefcase', 'tone' => 'cyan'],
                ['label' => 'Portfolio projects', 'value' => Project::query()->where('is_published', true)->count(), 'icon' => 'layers', 'tone' => 'amber'],
                ['label' => 'Unread messages', 'value' => ContactMessage::query()->whereNull('read_at')->count(), 'icon' => 'inbox', 'tone' => 'rose'],
            ],
            'views' => $views,
            'totalViews' => PageView::query()->count(),
            'popularPages' => PageView::query()->select('path', DB::raw('count(*) as total'))->groupBy('path')->orderByDesc('total')->take(5)->get(),
            'recentMessages' => ContactMessage::query()->latest()->take(5)->get(),
        ]);
    }
}
