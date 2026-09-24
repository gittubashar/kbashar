<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SettingController extends Controller
{
    private array $keys = [
        'site_title', 'site_tagline', 'hero_eyebrow', 'hero_title', 'hero_description',
        'about_title', 'about_text', 'email', 'phone', 'location',
        'github_url', 'linkedin_url', 'facebook_url',
    ];

    public function edit(Request $request): View
    {
        return view('admin.settings.edit', [
            'settings' => SiteSetting::query()->get()->keyBy('key'),
            'activeModule' => 'appearance',
            'section' => $request->string('section')->toString() ?: 'identity',
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'settings' => ['required', 'array'],
            'settings.*' => ['nullable', 'string', 'max:3000'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        foreach ($validated['settings'] as $key => $value) {
            if (in_array($key, $this->keys, true)) {
                SiteSetting::query()->where('key', $key)->update(['value' => $value]);
            }
        }

        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('branding', 'public');
            SiteSetting::query()->updateOrCreate(
                ['key' => 'logo_path'],
                ['group' => 'general', 'value' => $path, 'type' => 'image']
            );
        }

        return back()->with('status', 'Site settings saved.');
    }
}
