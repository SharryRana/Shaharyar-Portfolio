{{-- resources/views/components/categories.blade.php --}}
<section class="py-16 lg:py-24 bg-white">

    <style>
        @keyframes marquee-left {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @keyframes marquee-right {
            0%   { transform: translateX(-50%); }
            100% { transform: translateX(0); }
        }
        .marquee-left       { animation: marquee-left  38s linear infinite; }
        .marquee-right      { animation: marquee-right 30s linear infinite; }
        .marquee-left-slow  { animation: marquee-left  46s linear infinite; }
        .marquee-row:hover .marquee-left,
        .marquee-row:hover .marquee-right,
        .marquee-row:hover .marquee-left-slow { animation-play-state: paused; }
    </style>

    {{-- Heading --}}
    <div class="text-center mb-10 px-4">
        <h2 class="text-2xl sm:text-3xl font-bold text-gray-900">Our Best Categories</h2>
    </div>

    @php
        $icon = [
            'car'        => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 17H3v-5l2-5h14l2 5v5h-2"/><circle cx="7.5" cy="17.5" r="2.5"/><circle cx="16.5" cy="17.5" r="2.5"/><path d="M5 12h14"/></svg>',
            'chart'      => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>',
            'leaf'       => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8 0 5.5-4.78 10-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>',
            'cpu'        => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="4" width="16" height="16" rx="2"/><rect x="9" y="9" width="6" height="6"/><line x1="9" y1="1" x2="9" y2="4"/><line x1="15" y1="1" x2="15" y2="4"/><line x1="9" y1="20" x2="9" y2="23"/><line x1="15" y1="20" x2="15" y2="23"/><line x1="20" y1="9" x2="23" y2="9"/><line x1="20" y1="14" x2="23" y2="14"/><line x1="1" y1="9" x2="4" y2="9"/><line x1="1" y1="14" x2="4" y2="14"/></svg>',
            'bitcoin'    => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M11.767 19.089c4.924.868 6.14-6.025 1.216-6.894m-1.216 6.894L5.86 18.047m5.908 1.042-.347 1.97m1.563-8.864c4.924.869 6.14-6.025 1.215-6.893m-1.215 6.893-3.94-.694m5.155-6.2L8.29 4.26m5.908 1.042.348-1.97M7.48 20.364l3.126-17.727"/></svg>',
            'newspaper'  => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 22h16a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v16a2 2 0 0 1-2 2Zm0 0a2 2 0 0 1-2-2v-9c0-1.1.9-2 2-2h2"/><path d="M18 14h-8"/><path d="M15 18h-5"/><path d="M10 6h8v4h-8V6Z"/></svg>',
            'plane'      => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.8 19.2 16 11l3.5-3.5C21 6 21 4 19 2c-2-2-4-2-5.5-.5L10 5 1.8 6.2c-.5.1-.9.5-1 1-.1.6.1 1.2.6 1.6l2.6 2.6c.4.4.8.7 1.4.8l2.2.4-3.2 3.2c-.4.4-.7.9-.8 1.5L3.3 19c-.1.5.1 1 .4 1.4l.4.4c.5.5 1.2.6 1.8.3L9 19.6l2.2 2.2c.5.5 1.1.7 1.8.6.5-.1 1-.4 1.3-.9l3.5-2.3z"/></svg>',
            'palette'    => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="13.5" cy="6.5" r=".5" fill="currentColor"/><circle cx="17.5" cy="10.5" r=".5" fill="currentColor"/><circle cx="8.5" cy="7.5" r=".5" fill="currentColor"/><circle cx="6.5" cy="12.5" r=".5" fill="currentColor"/><path d="M12 2C6.5 2 2 6.5 2 12s4.5 10 10 10c.926 0 1.648-.746 1.648-1.688 0-.437-.18-.835-.437-1.125-.29-.289-.438-.652-.438-1.125a1.64 1.64 0 0 1 1.668-1.668h1.996c3.051 0 5.555-2.503 5.555-5.554C21.965 6.012 17.461 2 12 2z"/></svg>',
            'building'   => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><path d="M9 22v-4h6v4"/><path d="M8 6h.01"/><path d="M16 6h.01"/><path d="M12 6h.01"/><path d="M12 10h.01"/><path d="M12 14h.01"/><path d="M16 10h.01"/><path d="M16 14h.01"/><path d="M8 10h.01"/><path d="M8 14h.01"/></svg>',
            'hammer'     => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m15 12-8.5 8.5c-.83.83-2.17.83-3 0a2.12 2.12 0 0 1 0-3L12 9"/><path d="M17.64 15 22 10.64"/><path d="m20.91 11.7-1.25-1.25c-.6-.6-.93-1.4-.93-2.25v-.86L16.01 4.6a5.56 5.56 0 0 0-3.94-1.64H9l.92.82A6.18 6.18 0 0 1 12 8.4v1.56l2 2h2.47l2.26 1.91"/></svg>',
            'activity'   => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/></svg>',
            'cog'        => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 2.83-2.83l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>',
            'gem'        => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polygon points="6 3 18 3 22 9 12 22 2 9"/><polyline points="2 9 12 14 22 9"/><line x1="12" y1="22" x2="12" y2="14"/><line x1="6" y1="3" x2="2" y2="9"/><line x1="18" y1="3" x2="22" y2="9"/></svg>',
            'graduation' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>',
            'sparkles'   => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"/><path d="M5 3v4"/><path d="M19 17v4"/><path d="M3 5h4"/><path d="M17 19h4"/></svg>',
            'home'       => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>',
            'scale'      => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="m16 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="m2 16 3-8 3 8c-.87.65-1.92 1-3 1s-2.13-.35-3-1Z"/><path d="M7 21H17"/><path d="M12 3v18"/><path d="M3 7h2c2 0 5-1 7-2 2 1 5 2 7 2h2"/></svg>',
            'truck'      => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 17H3a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v3"/><rect x="9" y="11" width="14" height="10" rx="2"/><circle cx="12" cy="21" r="1"/><circle cx="20" cy="21" r="1"/></svg>',
            'monitor'    => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>',
            'phone'      => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>',
            'heart'      => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>',
        ];

        $row1 = [
            ['name' => 'Automotive / Moto',               'icon' => 'car'],
            ['name' => 'Business and Finance',             'icon' => 'chart'],
            ['name' => 'Ecology / Resource Conservation',  'icon' => 'leaf'],
            ['name' => 'Electronics and Technology',       'icon' => 'cpu'],
            ['name' => 'Cryptocurrencies',                 'icon' => 'bitcoin'],
            ['name' => 'News and Media',                   'icon' => 'newspaper'],
            ['name' => 'Travel and Tourism',               'icon' => 'plane'],
            ['name' => 'Fashion and Beauty',               'icon' => 'gem'],
        ];

        $row2 = [
            ['name' => 'Culture and Art',                  'icon' => 'palette'],
            ['name' => 'Real Estate',                      'icon' => 'building'],
            ['name' => 'Construction and Repair',          'icon' => 'hammer'],
            ['name' => 'Sports and Healthy Nutrition',     'icon' => 'activity'],
            ['name' => 'Manufacturing and Industry',       'icon' => 'cog'],
            ['name' => 'Education',                        'icon' => 'graduation'],
            ['name' => 'Health / Medical',                 'icon' => 'heart'],
            ['name' => 'Web Design',                       'icon' => 'monitor'],
        ];

        $row3 = [
            ['name' => 'Beauty / Cosmetics',               'icon' => 'sparkles'],
            ['name' => 'Home and Family',                  'icon' => 'home'],
            ['name' => 'Law and Jurisprudence',            'icon' => 'scale'],
            ['name' => 'Logistics and Cargo Transportation','icon' => 'truck'],
            ['name' => 'Mobile Technology',                'icon' => 'phone'],
            ['name' => 'Business and Finance',             'icon' => 'chart'],
            ['name' => 'Electronics and Technology',       'icon' => 'cpu'],
            ['name' => 'Travel and Tourism',               'icon' => 'plane'],
        ];
    @endphp

    {{-- Marquee wrapper with edge fades --}}
    <div class="relative overflow-hidden">

        {{-- Edge gradient fades --}}
        <div class="absolute left-0 top-0 bottom-0 w-24 lg:w-48 bg-linear-to-r from-white to-transparent z-10 pointer-events-none"></div>
        <div class="absolute right-0 top-0 bottom-0 w-24 lg:w-48 bg-linear-to-l from-white to-transparent z-10 pointer-events-none"></div>

        {{-- Row 1 — scrolls left --}}
        <div class="flex mb-3 marquee-row">
            <div class="flex gap-3 marquee-left" style="width: max-content;">
                @foreach(array_merge($row1, $row1) as $cat)
                    <a href="#"
                        class="group inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-brand hover:shadow-sm px-4 py-2.5 rounded-full transition-all duration-200 whitespace-nowrap shrink-0 text-brand">
                        {!! $icon[$cat['icon']] !!}
                        <span class="text-sm font-medium text-[#686677] group-hover:text-brand transition-colors duration-200">
                            {{ $cat['name'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Row 2 — scrolls right --}}
        <div class="flex mb-3 marquee-row">
            <div class="flex gap-3 marquee-right" style="width: max-content;">
                @foreach(array_merge($row2, $row2) as $cat)
                    <a href="#"
                        class="group inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-brand hover:shadow-sm px-4 py-2.5 rounded-full transition-all duration-200 whitespace-nowrap shrink-0 text-brand">
                        {!! $icon[$cat['icon']] !!}
                        <span class="text-sm font-medium text-[#686677] group-hover:text-brand transition-colors duration-200">
                            {{ $cat['name'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Row 3 — scrolls left (slower) --}}
        <div class="flex marquee-row">
            <div class="flex gap-3 marquee-left-slow" style="width: max-content;">
                @foreach(array_merge($row3, $row3) as $cat)
                    <a href="#"
                        class="group inline-flex items-center gap-2 bg-white border border-gray-200 hover:border-brand hover:shadow-sm px-4 py-2.5 rounded-full transition-all duration-200 whitespace-nowrap shrink-0 text-brand">
                        {!! $icon[$cat['icon']] !!}
                        <span class="text-sm font-medium text-[#686677] group-hover:text-brand transition-colors duration-200">
                            {{ $cat['name'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</section>
