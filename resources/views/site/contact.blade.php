@extends('layouts.site')

@section('content')
@php
    $contactDetails = [['Email', $settings['email'] ?? '', 'mail'], ['Location', $settings['location'] ?? '', 'network']];
    if (!str_contains($settings['phone'] ?? '', 'X')) {
        $contactDetails[] = ['Phone', $settings['phone'], 'contact'];
    }
@endphp
<section class="tech-contact">
    <div class="tech-shell tech-contact__grid">
        <aside class="tech-contact__aside reveal">
            <div class="tech-kicker"><span></span>{{ $page->eyebrow ?: 'Contact' }}</div>
            <h1>Let’s talk about what the business needs next.</h1>
            <p>{{ $page->excerpt }}</p>
            <div class="tech-contact__details">@foreach($contactDetails as $detail)<div><span><x-icon :name="$detail[2]" /></span><p><small>{{ $detail[0] }}</small><b>{{ $detail[1] }}</b></p></div>@endforeach</div>
            <div class="tech-contact__status"><i></i><span><b>Available for new projects</b><small>Usually responds within one business day</small></span></div>
        </aside>
        <div class="tech-contact__form reveal">
            <div><small>PROJECT INQUIRY / SECURE FORM</small><h2>Tell me about the requirement.</h2><p>A few useful details are enough to start.</p></div>
            @if(session('success'))<div class="tech-alert"><x-icon name="check" />{{ session('success') }}</div>@endif
            <form method="POST" action="{{ route('contact.store') }}" class="tech-form">@csrf
                <div class="hidden" aria-hidden="true"><label>Website<input name="website" tabindex="-1" autocomplete="off"></label></div>
                <div><label for="name">Name</label><input id="name" name="name" value="{{ old('name') }}" required placeholder="Your name">@error('name')<p class="form-error">{{ $message }}</p>@enderror</div>
                <div><label for="email">Business email</label><input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="you@company.com">@error('email')<p class="form-error">{{ $message }}</p>@enderror</div>
                <div><label for="phone">Phone <small>Optional</small></label><input id="phone" name="phone" value="{{ old('phone') }}" placeholder="+880 ..."></div>
                <div><label for="service">Service interest</label><select id="service" name="service"><option value="">Select a service</option>@foreach(\App\Models\Service::query()->where('is_published', true)->orderBy('sort_order')->get() as $service)<option @selected(old('service') === $service->title)>{{ $service->title }}</option>@endforeach</select></div>
                <div class="tech-form__full"><label for="subject">Subject</label><input id="subject" name="subject" value="{{ old('subject') }}" required placeholder="What outcome are you working towards?">@error('subject')<p class="form-error">{{ $message }}</p>@enderror</div>
                <div class="tech-form__full"><label for="message">Requirement</label><textarea id="message" name="message" required placeholder="Challenge, desired outcome, timing and useful context...">{{ old('message') }}</textarea>@error('message')<p class="form-error">{{ $message }}</p>@enderror</div>
                <div class="tech-form__full"><button type="submit" class="tech-btn">Send enquiry <x-icon name="arrow-right" /></button></div>
            </form>
        </div>
    </div>
</section>
@endsection
