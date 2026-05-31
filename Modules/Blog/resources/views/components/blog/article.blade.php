@props(['article'])

@php
    $heroImage =
        $article->image ?:
        'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80';
    $imageTitle = $article->image_title ?: $article->title;
    $imageAlt = $article->image_alt_text ?: $article->title;
    $imageObject = [
        '@context' => 'https://schema.org',
        '@type' => 'ImageObject',
        'contentUrl' => $heroImage,
        'url' => $heroImage,
        'name' => $imageTitle,
        'caption' => $article->image_caption ?: $imageAlt,
        'description' => $article->image_description ?: $imageAlt,
    ];
    $author = $article->author;
    $authorName = $author?->name ?: ($article->author_name ?: 'Admin');
    $authorAvatar = $author?->avatar ?: $article->author_avatar;
    $authorSignature = $author?->signature ?: $article->author_signature;
    $authorBio = $author?->bio ?: ($article->excerpt ?: 'This author has not added a bio yet.');
    $authorDesignation = $author?->designation;
    $displayCategory = $article->display_category;
    $content = $article->content;
    $sections = [];
    $videoEmbed = function (string $url): ?string {
        $url = html_entity_decode($url, ENT_QUOTES);
        $embedUrl = null;

        if (
            preg_match(
                '/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/',
                $url,
                $matches,
            )
        ) {
            $embedUrl = 'https://www.youtube.com/embed/' . $matches[1];
        } elseif (preg_match('/vimeo\.com\/(?:video\/)?([0-9]+)/', $url, $matches)) {
            $embedUrl = 'https://player.vimeo.com/video/' . $matches[1];
        }

        if (!$embedUrl) {
            return null;
        }

        return '<div class="blog-video-embed"><iframe src="' .
            e($embedUrl) .
            '" title="Article video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>';
    };

    $content = preg_replace_callback(
        '/<figure[^>]*class=(["\'])(?=[^"\']*\bmedia\b)[^"\']*\1[^>]*>\s*<oembed[^>]*url=(["\'])(.*?)\2[^>]*><\/oembed>\s*<\/figure>/is',
        function ($matches) use ($videoEmbed) {
            return $videoEmbed($matches[3]) ?? $matches[0];
        },
        $content,
    );

    $content = preg_replace_callback(
        '/<oembed[^>]*url=(["\'])(.*?)\1[^>]*><\/oembed>/is',
        function ($matches) use ($videoEmbed) {
            return $videoEmbed($matches[2]) ?? $matches[0];
        },
        $content,
    );

    $content = preg_replace_callback(
        '/<h([1-6])([^>]*)>(.*?)<\/h\1>/is',
        function ($matches) use (&$sections) {
            $text = trim(strip_tags($matches[3]));
            $id = \Illuminate\Support\Str::slug($text);
            $id = $id ?: 'section-' . (count($sections) + 1);
            $sections[] = ['id' => $id, 'title' => $text, 'level' => (int) $matches[1]];

            $attrs = preg_replace('/\s+id=(["\']).*?\1/i', '', $matches[2]);
            $class = match ($matches[1]) {
                '1' => 'mt-11 scroll-mt-28 text-3xl font-extrabold leading-tight text-[#1C1412] sm:text-4xl',
                '2' => 'mt-10 scroll-mt-28 text-2xl font-extrabold text-[#1C1412] sm:text-3xl',
                '3' => 'mt-8 scroll-mt-28 text-xl font-extrabold text-[#1C1412]',
                '4' => 'mt-7 scroll-mt-28 text-lg font-extrabold text-[#1C1412]',
                '5' => 'mt-6 scroll-mt-28 text-base font-extrabold text-[#1C1412]',
                default => 'mt-6 scroll-mt-28 text-sm font-extrabold uppercase text-[#1C1412]',
            };

            if (preg_match('/class=(["\'])(.*?)\1/i', $attrs, $classMatch)) {
                $attrs = preg_replace('/class=(["\'])(.*?)\1/i', 'class="$2 ' . $class . '"', $attrs);
            } else {
                $attrs .= ' class="' . $class . '"';
            }

            return '<h' . $matches[1] . $attrs . ' id="' . e($id) . '">' . $matches[3] . '</h' . $matches[1] . '>';
        },
        $content,
    );

    $authorInitials = collect(explode(' ', trim($authorName)))
        ->filter()
        ->take(2)
        ->map(fn($part) => \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($part, 0, 1)))
        ->join('');
    $authorInitials = $authorInitials ?: 'A';
@endphp

<script type="application/ld+json">
    {!! json_encode($imageObject, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
</script>

<section class="pt-24">
    <div class="mx-auto max-w-[1500px] px-4 text-center sm:px-6 lg:px-8">
        <p class="text-lg font-bold text-[#E97A37]">{{ optional($article->published_at)->format('F j, Y') }}</p>
        <h1
            class="mx-auto mt-8 max-w-6xl text-[25px] font-extrabold leading-tight text-[#1C1412] sm:text-5xl lg:text-[40px]">
            {{ $article->title }}
        </h1>
        <div class="relative mx-auto mt-12 max-w-[1250px]">
            <div
                class="pointer-events-none absolute -bottom-10 left-1/2 h-36 w-[92%] -translate-x-1/2 rounded-[100%] bg-[#FFE5D1] opacity-80 blur-3xl">
            </div>
            <img src="{{ $heroImage }}" alt="{{ $imageAlt }}" title="{{ $imageTitle }}"
                class="relative z-10 h-[260px] w-full rounded-[18px] object-cover sm:h-[560px]">
            <div
                class="absolute bottom-0 right-0 z-20 flex h-[76px] w-[222px] items-center justify-start rounded-tl-[18px] bg-gradient-to-br from-[#FFE5D1] via-[#FFF2E8] to-white p-1.5 sm:h-[94px] sm:w-[334px] sm:p-2">
                <div
                    class="flex h-[64px] w-[210px] items-center gap-3 rounded-xl bg-white px-4 shadow-xl sm:h-[82px] sm:w-[310px] sm:gap-4 sm:rounded-2xl sm:px-5">
                    @if ($authorAvatar)
                        <img src="{{ $authorAvatar }}" alt="{{ $authorName }}"
                            class="h-12 w-12 rounded-full border-4 border-[#77C88D] object-cover sm:h-16 sm:w-16">
                    @else
                        <span
                            class="flex h-12 w-12 items-center justify-center rounded-full border-4 border-[#77C88D] bg-gradient-to-br from-[#FFE5D1] via-[#F5A876] to-[#E97A37] text-base font-extrabold text-white shadow-sm sm:h-16 sm:w-16 sm:text-xl">{{ $authorInitials }}</span>
                    @endif
                    <span class="text-base font-extrabold text-[#1C1412] sm:text-2xl">{{ $authorName }}</span>
                </div>
            </div>
        </div>
        @if ($article->image_caption)
            <p class="mx-auto mt-4 max-w-[920px] text-sm font-medium leading-relaxed text-[#686677]">
                {{ $article->image_caption }}
            </p>
        @endif
    </div>
</section>

<script>
    function blogArticleNav() {
        const ids = @json(collect($sections)->pluck('id')->values());
        const initialId = ids[0] || null;

        return {
            activeId: window.location.hash ? window.location.hash.substring(1) : initialId,
            goTo(id) {
                this.activeId = id;
                const target = document.getElementById(id);

                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    history.replaceState(null, '', `#${id}`);
                }
            },
            init() {
                if (!ids.length) return;

                const updateActive = () => {
                    let current = ids[0];

                    for (const id of ids) {
                        const target = document.getElementById(id);

                        if (target && target.getBoundingClientRect().top <= 150) {
                            current = id;
                        }
                    }

                    this.activeId = current;
                };

                updateActive();
                window.addEventListener('scroll', updateActive, {
                    passive: true
                });
            },
        };
    }
</script>

<section class="mt-12 pb-24" x-data="blogArticleNav()">
    <div class="mx-auto grid max-w-[1500px] gap-10 px-4 sm:px-6 lg:grid-cols-[430px_1fr] lg:px-8">
        <aside class="hidden lg:block">
            <div class="sticky top-24 overflow-hidden rounded-lg bg-white shadow-sm">
                <div class="flex items-center justify-between bg-[#FFE5D1] px-5 py-5">
                    <h2 class="text-2xl font-semibold text-[#1C1412]">NAVIGATION</h2>
                    <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 7L7 1L13 7" stroke="#1C1412" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
                <nav>
                    @forelse ($sections as $section)
                        <a href="#{{ $section['id'] }}" @click.prevent="goTo('{{ $section['id'] }}')"
                            :class="activeId === '{{ $section['id'] }}' ? 'bg-[#E97A37] text-white' :
                                'text-[#686677] hover:bg-[#FFE5D1] hover:text-[#E97A37]'"
                            class="flex items-center gap-3 border-t border-[#E6E3EA] px-5 py-4 text-[15px] font-semibold transition {{ $section['level'] >= 3 ? 'pl-8 text-[13px]' : '' }}">
                            <span>{{ $section['title'] }}</span>
                        </a>
                    @empty
                        <div class="border-t border-[#E6E3EA] px-5 py-4 text-[15px] font-semibold text-[#686677]">
                            Article</div>
                    @endforelse
                </nav>
            </div>
        </aside>

        <article class="min-w-0 rounded-none bg-white lg:pt-0">
            <div class="prose-content mx-auto max-w-[920px] text-[#686677]">
                {!! $content !!}

                <div class="mt-8 flex flex-wrap gap-3">
                    <span
                        class="rounded-lg border border-[#CBCAD7] px-4 py-2 text-sm font-semibold text-[#686677]">#{{ $displayCategory }}</span>
                    @foreach (array_filter(array_map('trim', explode(',', (string) $article->meta_keywords))) as $tag)
                        <span
                            class="rounded-lg border border-[#CBCAD7] px-4 py-2 text-sm font-semibold text-[#686677]">#{{ $tag }}</span>
                    @endforeach
                </div>

                @if ($authorSignature)
                    <div class="mt-10">
                        <p class="text-sm font-semibold text-[#686677]">I wish you luck</p>
                        <img src="{{ $authorSignature }}" alt="{{ $authorName }} signature"
                            class="mt-2 h-auto w-42" loading="lazy">
                    </div>
                @endif

                <div class="mt-10 rounded-xl bg-[#FFE5D1] p-5 sm:p-7">
                    <div class="flex items-start justify-between">
                        <p class="text-sm font-bold text-[#686677]">About Author</p>
                    </div>
                    <div class="mt-4 inline-flex min-h-0 items-center gap-3 rounded-lg bg-white px-4 py-2 align-middle">
                        @if ($authorAvatar)
                            <img src="{{ $authorAvatar }}" alt="{{ $authorName }}"
                                class="author-avatar h-10 w-10 rounded-full border-4 border-[#77C88D] object-cover">
                        @else
                            <span
                                class="flex h-12 w-12 items-center justify-center rounded-full border-4 border-[#77C88D] bg-gradient-to-br from-[#FFE5D1] via-[#F5A876] to-[#E97A37] text-base font-extrabold text-white shadow-sm">{{ $authorInitials }}</span>
                        @endif
                        <span>
                            <span class="block font-extrabold text-[#1C1412]">{{ $authorName }}</span>
                            @if ($authorDesignation)
                                <span class="block text-xs font-bold uppercase tracking-wide text-[#E97A37]">{{ $authorDesignation }}</span>
                            @endif
                        </span>
                    </div>
                    <p class="mt-3 text-sm leading-relaxed text-[#686677]">{{ $authorBio }}</p>
                </div>
            </div>
        </article>
    </div>
</section>
