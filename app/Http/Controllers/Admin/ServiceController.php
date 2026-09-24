<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public function index(): View
    {
        return view('admin.services.index', [
            'services' => Service::query()->orderBy('sort_order')->get(),
            'activeModule' => 'services',
        ]);
    }

    public function create(): View
    {
        return view('admin.services.form', ['service' => new Service, 'activeModule' => 'services']);
    }

    public function store(Request $request): RedirectResponse
    {
        $service = Service::query()->create($this->validated($request));

        return redirect()->route('admin.services.edit', $service)->with('status', 'Service created.');
    }

    public function edit(Service $service): View
    {
        return view('admin.services.form', compact('service') + ['activeModule' => 'services']);
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $service->update($this->validated($request, $service));

        return back()->with('status', 'Service updated.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('status', 'Service removed.');
    }

    private function validated(Request $request, ?Service $service = null): array
    {
        $request->merge(['slug' => $request->input('slug') ?: Str::slug($request->input('title', ''))]);
        $data = $request->validate([
            'title' => ['required', 'string', 'max:160'],
            'slug' => ['required', 'alpha_dash', 'max:180', Rule::unique('services')->ignore($service)],
            'icon' => ['required', 'string', 'max:40'],
            'summary' => ['required', 'string', 'max:500'],
            'description' => ['nullable', 'string', 'max:10000'],
            'features_text' => ['nullable', 'string', 'max:3000'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:999'],
        ]);
        $data['features'] = collect(preg_split('/\r\n|\r|\n/', $data['features_text'] ?? ''))->map(fn ($item) => trim($item))->filter()->values()->all();
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_published'] = $request->boolean('is_published');
        unset($data['features_text']);

        return $data;
    }
}
