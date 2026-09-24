<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if ($request->filled('website')) {
            return back()->with('success', 'Thank you. Your message has been received.');
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:40'],
            'service' => ['nullable', 'string', 'max:120'],
            'subject' => ['required', 'string', 'max:190'],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
        ]);

        ContactMessage::query()->create($validated);

        return back()->with('success', 'Thanks for reaching out. I will get back to you shortly.');
    }
}
