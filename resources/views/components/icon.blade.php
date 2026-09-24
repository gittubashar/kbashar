@props(['name'])
<svg {{ $attributes->merge(['class' => 'size-5']) }} viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
    @switch($name)
        @case('layout-dashboard') <rect x="3" y="3" width="7" height="7" rx="2"/><rect x="14" y="3" width="7" height="7" rx="2"/><rect x="3" y="14" width="7" height="7" rx="2"/><rect x="14" y="14" width="7" height="7" rx="2"/> @break
        @case('files') <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6M8 13h8M8 17h6"/> @break
        @case('briefcase') <rect x="3" y="7" width="18" height="13" rx="2"/><path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2M3 12h18M10 12v2h4v-2"/> @break
        @case('layers') <path d="m12 2 9 5-9 5-9-5 9-5zM3 12l9 5 9-5M3 17l9 5 9-5"/> @break
        @case('inbox') <path d="M4 4h16v14H4zM4 13h4l2 3h4l2-3h4"/> @break
        @case('palette') <path d="M12 3a9 9 0 0 0 0 18h1.5a1.5 1.5 0 0 0 0-3H12a2 2 0 0 1 0-4h2a7 7 0 0 0 0-14h-2z"/><circle cx="7.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="9" cy="7" r=".5" fill="currentColor"/><circle cx="13" cy="6" r=".5" fill="currentColor"/><circle cx="16" cy="9" r=".5" fill="currentColor"/> @break
        @case('home') <path d="m3 11 9-8 9 8v10h-6v-7H9v7H3z"/> @break
        @case('external-link') <path d="M15 3h6v6M10 14 21 3M18 13v7a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h7"/> @break
        @case('mail') <rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/> @break
        @case('shield') <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/> @break
        @case('file-check') <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8zM14 2v6h6M9 15l2 2 4-4"/> @break
        @case('plus') <path d="M12 5v14M5 12h14"/> @break
        @case('badge') <circle cx="12" cy="8" r="5"/><path d="M8.5 12 7 22l5-3 5 3-1.5-10"/> @break
        @case('share') <circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 10.5 6.8-4M8.6 13.5l6.8 4"/> @break
        @case('contact') <path d="M16 18a4 4 0 0 0-8 0M12 14a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/><rect x="3" y="3" width="18" height="18" rx="3"/> @break
        @case('code') <path d="m8 9-3 3 3 3M16 9l3 3-3 3M14 5l-4 14"/> @break
        @case('terminal') <rect x="3" y="4" width="18" height="16" rx="2"/><path d="m7 9 3 3-3 3M13 15h4"/> @break
        @case('network') <rect x="9" y="3" width="6" height="5" rx="1"/><rect x="3" y="16" width="6" height="5" rx="1"/><rect x="15" y="16" width="6" height="5" rx="1"/><path d="M12 8v4M6 16v-4h12v4"/> @break
        @case('server') <rect x="3" y="4" width="18" height="7" rx="2"/><rect x="3" y="13" width="18" height="7" rx="2"/><path d="M7 7h.01M7 16h.01M11 7h6M11 16h6"/> @break
        @case('search') <circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/> @break
        @case('megaphone') <path d="m3 11 15-6v14L3 13v-2zM11 16l-1 5H6l-1-7"/> @break
        @case('arrow-right') <path d="M5 12h14M13 6l6 6-6 6"/> @break
        @case('arrow-up-right') <path d="M7 17 17 7M7 7h10v10"/> @break
        @case('menu') <path d="M4 7h16M4 12h16M4 17h16"/> @break
        @case('x') <path d="m6 6 12 12M18 6 6 18"/> @break
        @case('check') <path d="m5 12 4 4L19 6"/> @break
        @case('edit') <path d="M12 20h9M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4z"/> @break
        @case('trash') <path d="M3 6h18M8 6V4h8v2M19 6l-1 15H6L5 6M10 11v6M14 11v6"/> @break
        @case('logout') <path d="M10 17l5-5-5-5M15 12H3M15 4h4a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2h-4"/> @break
        @case('user') <circle cx="12" cy="8" r="4"/><path d="M4 21a8 8 0 0 1 16 0"/> @break
        @case('eye') <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z"/><circle cx="12" cy="12" r="3"/> @break
        @case('clock') <circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/> @break
        @case('save') <path d="M5 3h12l4 4v14H3V3h2zM7 3v6h10V3M7 21v-8h10v8"/> @break
        @case('chevron-right') <path d="m9 18 6-6-6-6"/> @break
        @case('chart') <path d="M4 20V10M10 20V4M16 20v-7M22 20H2"/> @break
        @default <circle cx="12" cy="12" r="9"/><path d="M12 8v4M12 16h.01"/>
    @endswitch
</svg>
