@extends('layouts.site')

@section('content')
<section class="tech-page-hero">
    <div class="tech-grid-glow"></div>
    <div class="tech-shell tech-page-hero__grid"><div><div class="tech-kicker"><span></span>{{ $page->eyebrow ?: 'Capabilities' }}</div><h1>Services built around<br><em>real business needs.</em></h1></div><p>{{ $page->excerpt }} Start with one capability or connect several under a single delivery plan.</p></div>
</section>

<section class="tech-section"><div class="tech-shell tech-service-details">
    @foreach($services as $index => $service)
        <article class="tech-detail reveal">
            <div class="tech-detail__number">0{{ $index + 1 }}</div>
            <div class="tech-detail__title"><span><x-icon :name="$service->icon" /></span><div><small>Capability</small><h2>{{ $service->title }}</h2></div></div>
            <div class="tech-detail__body"><p>{{ $service->summary }}</p><div>@foreach($service->features ?? [] as $feature)<span><x-icon name="check" />{{ $feature }}</span>@endforeach</div><a href="{{ route('contact') }}" class="tech-text-link">Discuss this service <x-icon name="arrow-right" /></a></div>
        </article>
    @endforeach
</div></section>

<section class="tech-section tech-section--blue"><div class="tech-shell"><div class="tech-section__head"><div><div class="tech-kicker"><span></span>Engagement models</div><h2>The right structure<br><em>for the work.</em></h2></div><p>Choose a focused build, dependable technical support, or a connected technology partnership.</p></div><div class="tech-models">@foreach([['01','Focused project','A defined outcome, clear scope and planned delivery.'],['02','Ongoing support','Maintenance, monitoring and continuous improvement.'],['03','Integrated partnership','Connected expertise across product, infrastructure and growth.']] as $model)<div><small>{{ $model[0] }}</small><h3>{{ $model[1] }}</h3><p>{{ $model[2] }}</p></div>@endforeach</div></div></section>

<section class="tech-section tech-section--last"><div class="tech-shell"><div class="tech-cta"><div><div class="tech-kicker"><span></span>Start with the requirement</div><h2>Not sure which service<br><em>fits best?</em></h2><p>Share the challenge and I’ll help identify the clearest route forward.</p></div><a href="{{ route('contact') }}" class="tech-btn">Request a consultation <x-icon name="arrow-right" /></a></div></div></section>
@endsection
