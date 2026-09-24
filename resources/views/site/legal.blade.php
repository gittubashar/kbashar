@extends('layouts.site')

@section('content')
<section class="tech-page-hero tech-page-hero--compact"><div class="tech-grid-glow"></div><div class="tech-shell tech-page-hero__grid"><div><div class="tech-kicker"><span></span>{{ $page->eyebrow ?: 'Legal' }}</div><h1>{{ $page->title }}</h1></div><div><p>{{ $page->excerpt }}</p><small>Last updated {{ $page->updated_at->format('F j, Y') }}</small></div></div></section>
<section class="tech-section"><div class="tech-shell tech-legal"><aside><div class="tech-kicker"><span></span>Document</div><p>Plain-language information about this website and how it operates.</p></aside><article class="tech-prose">{!! $page->content !!}</article></div></section>
@endsection
