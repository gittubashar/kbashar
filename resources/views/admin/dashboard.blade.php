@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="admin-overview-head">
    <div><p>CONTROL CENTRE / LIVE OVERVIEW</p><h1>Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }}, {{ explode(' ', auth()->user()->name)[0] }}.</h1><span>Your website operations at a glance.</span></div>
    <div><span><i></i>All systems nominal</span><a class="admin-btn" href="{{ route('admin.projects.create') }}"><x-icon name="plus" />New project</a></div>
</div>

<section class="admin-metrics">
    @foreach($stats as $index => $stat)
        <article class="admin-metric">
            <div><span>NODE_0{{ $index + 1 }}</span><i>LIVE</i></div>
            <div class="admin-metric__value"><strong>{{ number_format($stat['value']) }}</strong><span><x-icon :name="$stat['icon']" /></span></div>
            <p>{{ $stat['label'] }}</p><em></em>
        </article>
    @endforeach
</section>

<div class="admin-data-grid">
    <section class="admin-card admin-chart-panel">
        <div class="admin-panel-head"><div><span>ANALYTICS / 7D</span><h2>Visitor activity</h2><p>Page views over the last seven days</p></div><div><strong>{{ number_format($totalViews) }}</strong><small>ALL-TIME VIEWS</small></div></div>
        @php $maxView = max(1, $views->max('value')); @endphp
        <div class="admin-bars">
            @foreach($views as $view)
                <div><span><i style="height: {{ max(4, ($view['value'] / $maxView) * 100) }}%"></i></span><b>{{ $view['value'] }}</b><small>{{ $view['label'] }}</small></div>
            @endforeach
        </div>
    </section>
    <section class="admin-card admin-popular">
        <div class="admin-panel-head"><div><span>TRAFFIC / ROUTES</span><h2>Popular pages</h2><p>Most visited website paths</p></div><x-icon name="chart" /></div>
        <div class="admin-popular-list">
            @forelse($popularPages as $popular)
                <div><span><x-icon name="eye" /></span><b>{{ $popular->path }}</b><strong>{{ $popular->total }}</strong></div>
            @empty
                <div class="admin-empty">Visitor data will appear here.</div>
            @endforelse
        </div>
    </section>
</div>

<section class="admin-card admin-inbox-panel">
    <div class="admin-panel-head"><div><span>COMMUNICATIONS / INBOX</span><h2>Recent enquiries</h2><p>Latest messages from the contact form</p></div><a href="{{ route('admin.messages.index') }}">Open inbox <x-icon name="arrow-right" /></a></div>
    <div class="overflow-x-auto"><table class="admin-table"><thead><tr><th>Sender</th><th>Subject</th><th>Service</th><th>Received</th><th>Status</th></tr></thead><tbody>
        @forelse($recentMessages as $message)
            <tr><td><a href="{{ route('admin.messages.show', $message) }}">{{ $message->name }}</a><small>{{ $message->email }}</small></td><td>{{ $message->subject }}</td><td>{{ $message->service ?: 'General enquiry' }}</td><td>{{ $message->created_at->diffForHumans() }}</td><td><span class="status-pill {{ $message->read_at ? 'status-draft' : 'status-live' }}">{{ $message->read_at ? 'Read' : 'New' }}</span></td></tr>
        @empty
            <tr><td colspan="5" class="admin-empty">No enquiries yet.</td></tr>
        @endforelse
    </tbody></table></div>
</section>
@endsection
