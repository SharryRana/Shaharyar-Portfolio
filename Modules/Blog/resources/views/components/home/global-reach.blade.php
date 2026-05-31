{{-- resources/views/components/home/global-reach.blade.php --}}
<section class="py-16">

    <style>
        [x-cloak] {
            display: none !important;
        }

        @keyframes cr-scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .cr-marquee {
            animation: cr-scroll 28s linear infinite;
        }

        .cr-marquee-fast {
            animation: cr-scroll 16s linear infinite;
        }

        .cr-hide-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .cr-hide-scrollbar::-webkit-scrollbar {
            display: none;
            width: 0;
            height: 0;
        }

        @media (max-width: 639px) {
            .cr-marquee,
            .cr-marquee-fast {
                animation: none;
            }
        }
    </style>

    @php
        $regions = [
            'All Country' => [
                ['name' => 'USA', 'code' => 'us'],
                ['name' => 'Switzerland', 'code' => 'ch'],
                ['name' => 'Portugal', 'code' => 'pt'],
                ['name' => 'Netherlands', 'code' => 'nl'],
                ['name' => 'Spain', 'code' => 'es'],
                ['name' => 'Romania', 'code' => 'ro'],
                ['name' => 'Singapore', 'code' => 'sg'],
                ['name' => 'Philippines', 'code' => 'ph'],
                ['name' => 'UK', 'code' => 'gb'],
                ['name' => 'Germany', 'code' => 'de'],
                ['name' => 'France', 'code' => 'fr'],
                ['name' => 'Italy', 'code' => 'it'],
                ['name' => 'Canada', 'code' => 'ca'],
                ['name' => 'Brazil', 'code' => 'br'],
                ['name' => 'India', 'code' => 'in'],
                ['name' => 'Japan', 'code' => 'jp'],
                ['name' => 'Australia', 'code' => 'au'],
                ['name' => 'Mexico', 'code' => 'mx'],
                ['name' => 'Argentina', 'code' => 'ar'],
                ['name' => 'South Korea', 'code' => 'kr'],
            ],
            'Europe' => [
                ['name' => 'UK', 'code' => 'gb'],
                ['name' => 'Germany', 'code' => 'de'],
                ['name' => 'France', 'code' => 'fr'],
                ['name' => 'Spain', 'code' => 'es'],
                ['name' => 'Italy', 'code' => 'it'],
                ['name' => 'Netherlands', 'code' => 'nl'],
                ['name' => 'Switzerland', 'code' => 'ch'],
                ['name' => 'Portugal', 'code' => 'pt'],
                ['name' => 'Romania', 'code' => 'ro'],
                ['name' => 'Sweden', 'code' => 'se'],
                ['name' => 'Norway', 'code' => 'no'],
                ['name' => 'Denmark', 'code' => 'dk'],
                ['name' => 'Poland', 'code' => 'pl'],
                ['name' => 'Austria', 'code' => 'at'],
            ],
            'North America' => [
                ['name' => 'USA', 'code' => 'us'],
                ['name' => 'Canada', 'code' => 'ca'],
                ['name' => 'Mexico', 'code' => 'mx'],
                ['name' => 'Puerto Rico', 'code' => 'pr'],
                ['name' => 'Cuba', 'code' => 'cu'],
                ['name' => 'Jamaica', 'code' => 'jm'],
            ],
            'Central America' => [
                ['name' => 'Guatemala', 'code' => 'gt'],
                ['name' => 'Honduras', 'code' => 'hn'],
                ['name' => 'El Salvador', 'code' => 'sv'],
                ['name' => 'Costa Rica', 'code' => 'cr'],
                ['name' => 'Panama', 'code' => 'pa'],
                ['name' => 'Nicaragua', 'code' => 'ni'],
                ['name' => 'Belize', 'code' => 'bz'],
            ],
            'South America' => [
                ['name' => 'Brazil', 'code' => 'br'],
                ['name' => 'Argentina', 'code' => 'ar'],
                ['name' => 'Colombia', 'code' => 'co'],
                ['name' => 'Chile', 'code' => 'cl'],
                ['name' => 'Peru', 'code' => 'pe'],
                ['name' => 'Venezuela', 'code' => 've'],
                ['name' => 'Ecuador', 'code' => 'ec'],
                ['name' => 'Bolivia', 'code' => 'bo'],
            ],
            'Asia-Pacific' => [
                ['name' => 'Japan', 'code' => 'jp'],
                ['name' => 'Australia', 'code' => 'au'],
                ['name' => 'Singapore', 'code' => 'sg'],
                ['name' => 'Philippines', 'code' => 'ph'],
                ['name' => 'India', 'code' => 'in'],
                ['name' => 'South Korea', 'code' => 'kr'],
                ['name' => 'New Zealand', 'code' => 'nz'],
                ['name' => 'Thailand', 'code' => 'th'],
                ['name' => 'Vietnam', 'code' => 'vn'],
                ['name' => 'Malaysia', 'code' => 'my'],
                ['name' => 'Indonesia', 'code' => 'id'],
            ],
            'Middle East' => [
                ['name' => 'UAE', 'code' => 'ae'],
                ['name' => 'Saudi Arabia', 'code' => 'sa'],
                ['name' => 'Qatar', 'code' => 'qa'],
                ['name' => 'Kuwait', 'code' => 'kw'],
                ['name' => 'Bahrain', 'code' => 'bh'],
                ['name' => 'Jordan', 'code' => 'jo'],
                ['name' => 'Israel', 'code' => 'il'],
                ['name' => 'Turkey', 'code' => 'tr'],
                ['name' => 'Oman', 'code' => 'om'],
            ],
            'Africa' => [
                ['name' => 'South Africa', 'code' => 'za'],
                ['name' => 'Nigeria', 'code' => 'ng'],
                ['name' => 'Kenya', 'code' => 'ke'],
                ['name' => 'Ghana', 'code' => 'gh'],
                ['name' => 'Egypt', 'code' => 'eg'],
                ['name' => 'Morocco', 'code' => 'ma'],
                ['name' => 'Tanzania', 'code' => 'tz'],
                ['name' => 'Ethiopia', 'code' => 'et'],
            ],
            'Central Asia' => [
                ['name' => 'Kazakhstan', 'code' => 'kz'],
                ['name' => 'Uzbekistan', 'code' => 'uz'],
                ['name' => 'Kyrgyzstan', 'code' => 'kg'],
                ['name' => 'Tajikistan', 'code' => 'tj'],
                ['name' => 'Turkmenistan', 'code' => 'tm'],
                ['name' => 'Afghanistan', 'code' => 'af'],
                ['name' => 'Pakistan', 'code' => 'pk'],
            ],
        ];
    @endphp

    <div x-data="{ region: 'All Country' }">

        {{-- Header --}}
        <div class="text-center mb-10 px-4">
            <h2 class="text-2xl sm:text-3xl font-extrabold text-gray-900">
                Advertise Your Business Worldwide In
                <span class="text-brand">146 Countries</span> &
                <span class="text-brand">51 Languages</span>
            </h2>
        </div>

        {{-- Region filter tabs --}}
        <div class="mx-4 sm:mx-8 lg:mx-16 mb-8 overflow-x-auto cr-hide-scrollbar">
            <div
                class="inline-flex min-w-max flex-nowrap sm:flex-wrap items-stretch justify-start sm:justify-center border-0 sm:border sm:border-gray-200 py-2 px-0 sm:px-2 gap-2 rounded-none sm:rounded-2xl">
                @foreach (array_keys($regions) as $r)
                    <button @click="region = '{{ $r }}'"
                        :class="region === '{{ $r }}'
                            ?
                            'bg-brand text-white shadow-sm' :
                            'bg-white text-gray-600 border border-gray-200 hover:border-brand hover:text-brand'"
                        class="inline-flex shrink-0 px-6 sm:px-10 py-2 rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer">
                        {{ $r }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Country scrolling strip — one per region, shown/hidden by Alpine --}}
        @foreach ($regions as $regionName => $list)
            <div x-show="region === '{{ $regionName }}'" x-cloak
                class="flex items-stretch overflow-x-auto sm:overflow-hidden p-2 cr-hide-scrollbar
                        border-0 sm:border sm:border-gray-100 shadow-none sm:shadow-sm bg-[#FFE5D1]">

                {{-- Fixed left label --}}
                <div class="hidden sm:flex shrink-0 items-center px-8 py-5 mr-2 rounded-lg bg-white shadow-sm">
                    <span class="text-base font-bold text-[#1C1412] whitespace-nowrap">{{ $regionName }}</span>
                </div>

                {{-- Scrolling country pills --}}
                <div class="flex-1 overflow-x-auto sm:overflow-hidden cr-hide-scrollbar">
                    <div class="flex items-center gap-3 py-3 {{ count($list) < 8 ? 'cr-marquee-fast' : 'cr-marquee' }}"
                        style="width: max-content;">
                        @foreach ([...$list, ...$list] as $country)
                            <div
                                class="flex items-center gap-2 border border-gray-100 px-4 py-2 rounded-sm shrink-0 bg-[#FFE5D1]">
                                <img src="https://flagcdn.com/20x15/{{ $country['code'] }}.png" width="20"
                                    height="15" alt="{{ $country['name'] }}" class="select-none rounded-sm">
                                <span
                                    class="text-sm font-medium text-gray-700 whitespace-nowrap">{{ $country['name'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        @endforeach

    </div>
</section>
