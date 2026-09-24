@extends('layouts.site')

@section('content')
<section class="tech-hero">
    <div class="tech-grid-glow"></div>
    <div class="tech-shell tech-hero__grid">
        <div class="tech-hero__copy">
            <div class="tech-kicker"><span></span>{{ $settings['hero_eyebrow'] ?? 'IT solutions for modern businesses' }}</div>
            <h1>{{ $settings['site_title'] ?? 'K Bashar' }}<em>Business technology, built to work.</em></h1>
            <div class="tech-role-line">
                <span>Specialized in</span>
                <strong data-rotating-role data-roles='["Web Development","Software Development","Network Administration","Server Administration","Search Engine Optimization","Digital Marketing"]'>Web Development</strong>
            </div>
            <p>{{ $settings['hero_description'] ?? 'I plan, build and operate the technology that helps businesses work securely, move faster and grow with confidence.' }}</p>
            <div class="tech-actions">
                <a href="{{ route('contact') }}" class="tech-btn">Let’s work together <x-icon name="arrow-right" /></a>
                <a href="{{ route('services') }}" class="tech-btn tech-btn--ghost">Explore services <x-icon name="arrow-up-right" /></a>
            </div>
            <div class="tech-hero__meta"><span><i></i> Available for projects</span><span>Remote & on-site support</span><span>{{ $settings['location'] ?? 'Bangladesh' }}</span></div>
        </div>

        <div class="tech-hero__visual">
            <div class="tech-image-frame"><img src="{{ asset('images/kb-tech-hero.png') }}" alt="IT infrastructure professional in a modern server environment"></div>
            <div class="tech-terminal">
                <div><span></span><span></span><span></span><b>system-status</b></div>
                <code><i>$</i> infrastructure --status</code>
                <code><i>✓</i> network: secure</code>
                <code><i>✓</i> services: running</code>
            </div>
            <div class="tech-visual-badge"><span class="tech-pulse"></span><div><small>Current status</small><strong>Ready to build</strong></div></div>
        </div>
    </div>
</section>

<section class="tech-statbar">
    <div class="tech-shell tech-statbar__grid">
        <div><x-icon name="layers" /><span><strong>{{ str_pad((string) $projects->count(), 2, '0', STR_PAD_LEFT) }}</strong><small>Selected solutions</small></span></div>
        <div><x-icon name="server" /><span><strong>{{ str_pad((string) $services->count(), 2, '0', STR_PAD_LEFT) }}</strong><small>Core capabilities</small></span></div>
        <div><x-icon name="shield" /><span><strong>360°</strong><small>Technology view</small></span></div>
        <div><x-icon name="clock" /><span><strong>Online</strong><small>Project availability</small></span></div>
    </div>
</section>

<section class="tech-section" id="services">
    <div class="tech-shell">
        <div class="tech-section__head reveal"><div><div class="tech-kicker"><span></span>02 / Services</div><h2>Comprehensive IT solutions<br><em>for modern businesses.</em></h2></div><p>From dependable infrastructure to customer-facing products, each service is delivered as part of one clear, connected technology plan.</p></div>
        <div class="tech-service-grid">
            @foreach($services as $index => $service)
                <a href="{{ route('services') }}" class="tech-service-card reveal">
                    <div class="tech-service-card__top"><span>0{{ $index + 1 }}</span><i><x-icon :name="$service->icon" /></i></div>
                    <h3>{{ $service->title }}</h3><p>{{ $service->summary }}</p>
                    <small>View capability <x-icon name="arrow-up-right" /></small>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="tech-section tech-section--blue" id="about">
    <div class="tech-shell tech-about">
        <div class="tech-about__visual reveal">
            <div class="tech-server-stack"><span></span><span></span><span></span><span></span><span></span></div>
            <div class="tech-about__signal"><i></i><span>SECURE CONNECTION</span><b>99.9%</b></div>
        </div>
        <div class="tech-about__copy reveal">
            <div class="tech-kicker"><span></span>03 / About</div>
            <h2>{{ $settings['about_title'] ?? 'A practical technology partner focused on real solutions.' }}</h2>
            <p>{{ $settings['about_text'] ?? 'I connect software, infrastructure and digital growth into solutions built around real business needs.' }}</p>
            <div class="tech-about__points">
                @foreach([['server','Server & system operations'],['code','Web application development'],['network','Network design & security'],['search','Search and digital growth']] as $point)
                    <div><x-icon :name="$point[0]" /><span>{{ $point[1] }}</span></div>
                @endforeach
            </div>
            <a href="{{ route('contact') }}" class="tech-text-link">Discuss a requirement <x-icon name="arrow-right" /></a>
        </div>
    </div>
</section>

<section class="tech-section" id="skills">
    <div class="tech-shell">
        <div class="tech-section__head reveal"><div><div class="tech-kicker"><span></span>04 / Technology</div><h2>Tools selected for<br><em>the job at hand.</em></h2></div><p>A cross-functional stack for building, deploying, securing and growing modern digital operations.</p></div>
        <div class="tech-tools reveal">
            @foreach([['Linux','terminal'],['Windows Server','server'],['Nginx','server'],['Apache','server'],['PHP','code'],['Laravel','code'],['MySQL','layers'],['WordPress','files'],['Docker','layers'],['Git','share'],['Firewall','shield'],['Cisco','network']] as $tool)
                <div><span><x-icon :name="$tool[1]" /></span><b>{{ $tool[0] }}</b></div>
            @endforeach
        </div>
    </div>
</section>

<section class="tech-section tech-work" id="work">
    <div class="tech-shell">
        <div class="tech-section__head reveal"><div><div class="tech-kicker"><span></span>05 / Selected work</div><h2>Real solutions.<br><em>Measurable purpose.</em></h2></div><p>A selection of project directions that combine technical depth with clear business outcomes.</p></div>
        <div class="tech-project-grid">
            @forelse($projects as $index => $project)
                <article class="tech-project-card reveal">
                    <div class="tech-project-card__visual tech-project-card__visual--{{ ($index % 3) + 1 }}"><span>0{{ $index + 1 }}</span><x-icon :name="$index % 3 === 0 ? 'code' : ($index % 3 === 1 ? 'server' : 'network')" /></div>
                    <div class="tech-project-card__body"><small>{{ $project->category }}</small><h3>{{ $project->title }}</h3><p>{{ $project->summary }}</p><div>@foreach($project->technologies ?? [] as $tech)<span>{{ $tech }}</span>@endforeach</div></div>
                </article>
            @empty
                <article class="tech-project-card"><div class="tech-project-card__visual tech-project-card__visual--1"><span>01</span><x-icon name="code" /></div><div class="tech-project-card__body"><small>Digital product</small><h3>Your next project</h3><p>A focused solution designed around your operational or growth objective.</p></div></article>
            @endforelse
        </div>
    </div>
</section>

<section class="tech-section">
    <div class="tech-shell">
        <div class="tech-kicker"><span></span>06 / Delivery approach</div>
        <div class="tech-timeline">
            @foreach([['01','Discover','Understand the business need and technical context.'],['02','Design','Define the right architecture, scope and priorities.'],['03','Deploy','Build, test and launch with visible progress.'],['04','Improve','Support, measure and evolve the solution.']] as $step)
                <div class="reveal"><span><x-icon name="{{ $loop->first ? 'search' : ($loop->last ? 'chart' : 'terminal') }}" /></span><small>{{ $step[0] }}</small><h3>{{ $step[1] }}</h3><p>{{ $step[2] }}</p></div>
            @endforeach
        </div>
    </div>
</section>

<section class="tech-section tech-section--last">
    <div class="tech-shell"><div class="tech-cta reveal"><div><div class="tech-kicker"><span></span>07 / Let’s connect</div><h2>Have a project<br><em>in mind?</em></h2><p>Tell me what the business needs. I’ll help turn it into a clear technical plan.</p></div><div><a href="{{ route('contact') }}" class="tech-btn">Send a message <x-icon name="arrow-right" /></a><a href="mailto:{{ $settings['email'] ?? '' }}" class="tech-cta__mail"><x-icon name="mail" />{{ $settings['email'] ?? '' }}</a></div></div></div>
</section>
@endsection
