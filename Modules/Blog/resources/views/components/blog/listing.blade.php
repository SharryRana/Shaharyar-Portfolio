@props(['articles', 'trendingArticle' => null])

@php
    $trendingArticle = $trendingArticle ?: $articles->first();
    $fallbackImage = 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1200&q=80';
    $posts = $articles;
    $perPage = request()->integer('per_page', 10);
    $search = trim((string) request('search', ''));
    $paginationPages = [];

    if ($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator) {
        $lastPage = $articles->lastPage();
        $currentPage = $articles->currentPage();

        if ($lastPage <= 7) {
            $paginationPages = range(1, $lastPage);
        } elseif ($currentPage <= 4) {
            $paginationPages = [1, 2, 3, 4, 5, '...', $lastPage];
        } elseif ($currentPage >= $lastPage - 3) {
            $paginationPages = [1, '...', $lastPage - 4, $lastPage - 3, $lastPage - 2, $lastPage - 1, $lastPage];
        } else {
            $paginationPages = [1, '...', $currentPage - 1, $currentPage, $currentPage + 1, '...', $lastPage];
        }
    }
@endphp

<section class="relative z-20 pt-24 lg:pt-32 pb-20">
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden">
        <div class="absolute left-0 right-0 bottom-0 h-36 bg-gradient-to-t from-[#FFE5D1]/75 to-transparent"></div>

        <div class="absolute left-3 top-20 h-10 w-10 overflow-hidden rounded-full border-4 border-white shadow-lg sm:left-[8%] sm:top-36 sm:h-12 sm:w-12">
            <img src="https://i.pravatar.cc/120?img=11" alt="" class="h-full w-full object-cover">
        </div>
        <div class="absolute right-3 top-20 h-10 w-10 overflow-hidden rounded-full border-4 border-white shadow-lg sm:right-[9%] sm:top-36 sm:h-14 sm:w-14">
            <img src="https://i.pravatar.cc/120?img=15" alt="" class="h-full w-full object-cover">
        </div>
        <div class="absolute left-3 bottom-6 h-11 w-11 overflow-hidden rounded-full border-4 border-white shadow-lg sm:left-[13%] sm:bottom-16 sm:h-12 sm:w-12">
            <img src="https://i.pravatar.cc/120?img=59" alt="" class="h-full w-full object-cover">
        </div>
        <div class="absolute left-[42%] bottom-6 h-11 w-11 overflow-hidden rounded-full border-4 border-white shadow-lg sm:left-[30%] sm:bottom-auto sm:top-24 sm:h-14 sm:w-14">
            <img src="https://i.pravatar.cc/120?img=32" alt="" class="h-full w-full object-cover">
        </div>
        <div class="absolute right-3 bottom-6 h-11 w-11 overflow-hidden rounded-full border-4 border-[#77C88D] shadow-lg sm:right-[13%] sm:bottom-20 sm:h-12 sm:w-12">
            <img src="https://i.pravatar.cc/120?img=3" alt="" class="h-full w-full object-cover">
        </div>
    </div>

    <div class="relative mx-auto max-w-[1500px] px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl text-center">
            <span class="inline-flex rounded-full border border-[#CBCAD7] bg-white px-5 py-2 text-sm font-semibold text-[#686677]">Blog</span>
            <h1 class="mt-8 text-[28px] font-extrabold leading-tight text-[#1C1412] sm:text-5xl lg:text-[56px]">
                The Pubwhizz Link Building Blog
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-sm font-bold text-[#686677] sm:text-base">
                The Best SEO Tips, Techniques, Tricks, Strategies & Case Studies Every Week
            </p>
            <div class="relative mx-auto mt-9 max-w-xl" data-blog-search data-search-url="{{ route('blog.search', [], false) }}">
                <form action="{{ route('blog.index', [], false) }}" method="GET" class="flex h-14 items-center rounded-full border border-[#E97A37] bg-[#FFE5D133] pl-5 shadow-sm">
                    <input type="search" name="search" value="{{ $search }}" autocomplete="off" data-blog-search-input
                        placeholder="Search articles"
                        class="min-w-0 flex-1 bg-transparent text-sm font-semibold text-[#1C1412] outline-none placeholder:text-[#A4A2AE]">
                    <button type="submit" class="mr-1.5 flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#E97A37] text-white transition hover:bg-[#d66c2e]" aria-label="Search">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8" />
                            <path d="m21 21-4.3-4.3" />
                        </svg>
                    </button>
                </form>
                <div data-blog-search-panel class="absolute left-0 right-0 top-[calc(100%+0.75rem)] z-[80] hidden overflow-hidden rounded-[22px] border border-[#F1CDBA] bg-white text-left shadow-[0_18px_45px_rgba(28,20,18,0.16)]">
                    <div data-blog-search-status class="hidden px-5 py-4 text-sm font-bold text-[#686677]"></div>
                    <div data-blog-search-results class="max-h-[420px] overflow-y-auto p-2"></div>
                    <a href="{{ route('blog.index', [], false) }}" data-blog-search-view-all class="hidden border-t border-[#F1CDBA] px-5 py-3 text-sm font-extrabold text-[#E97A37] transition hover:bg-[#FFE5D1]/50">
                        View all matching articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@if($trendingArticle)
    <section class="mx-auto mt-5 max-w-375 px-4 pb-20 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-extrabold text-[#1C1412]">Weekly Trending</h2>
        <a href="{{ route('blog.show', $trendingArticle->slug) }}" class="group mt-8 block overflow-hidden rounded-[22px] border border-[#F1CDBA]">
            <div class="relative h-105 sm:h-130">
                <img src="{{ $trendingArticle->image ?: $fallbackImage }}" alt="{{ $trendingArticle->title }}" class="h-full w-full object-cover">
                <div class="absolute inset-0 bg-black/55"></div>
                <span class="absolute right-5 top-5 rounded-full bg-[#F5F5F5] px-4 py-2 text-sm font-bold text-brand shadow-sm border border-brand flex items-center gap-2 sm:right-8 sm:top-8">
                    <svg width="11" height="16" viewBox="0 0 11 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.35769 6.36759C8.82894 6.48259 8.37269 6.77759 8.15894 7.28634C8.03019 7.59509 7.85019 8.39259 7.35644 8.18634C7.12019 8.08884 7.12394 7.75009 7.15144 7.53884C7.21019 7.10509 7.40519 6.70884 7.53894 6.29634C7.67644 5.86884 7.79519 5.43884 7.88019 4.99634C8.16519 3.53134 8.08644 1.84384 7.05019 0.672587C6.87519 0.472587 6.43394 0.0100868 6.14269 8.67596e-05C5.96269 -0.00491324 6.14019 0.207587 6.19019 0.278837C6.29144 0.425087 6.37644 0.583837 6.44144 0.750087C7.20769 2.70509 5.31894 4.19384 4.07769 5.35259C3.48269 5.90884 3.00769 6.49884 2.58019 7.18759C2.53769 7.25384 2.44394 7.47634 2.32269 7.43009C2.17894 7.37509 2.16394 7.04634 2.11894 6.92384C2.03394 6.68884 1.90269 6.43259 1.73394 6.24884C1.40769 5.89134 0.951442 5.65009 0.457692 5.68259C0.438942 5.68384 0.385192 5.69259 0.318942 5.70759C0.215192 5.73009 -0.0623081 5.76634 0.0126919 5.93384C0.0514419 6.02009 0.165192 6.01259 0.246442 6.03634C1.28894 6.35634 1.26519 7.44884 1.09644 8.32634C0.791442 9.92384 -0.0535581 11.4338 0.546442 13.0763C1.25394 15.0126 3.46894 16.2213 5.47894 15.8888C6.02769 15.7988 6.66019 15.6213 7.15269 15.3563C7.67644 15.0738 8.25019 14.6876 8.65894 14.2526C9.18519 13.6938 9.52019 12.9776 9.61894 12.2188C9.73519 11.3413 9.45519 10.5138 9.20019 9.68509C8.89269 8.68509 8.53894 7.05259 9.81644 6.56384C9.87894 6.53884 10.0039 6.52009 10.0477 6.45384C10.2102 6.21134 9.43019 6.35259 9.35769 6.36759Z" fill="#ED6C30" />
                    </svg>
                    <span>Trending</span>
                </span>
                <div class="absolute bottom-8 left-6 right-6 sm:left-8">
                    <span class="inline-flex rounded-full bg-white px-3 py-1.5 text-xs font-bold text-brand">{{ $trendingArticle->display_category }}</span>
                    <h3 class="mt-3 max-w-3xl text-2xl font-extrabold leading-tight text-white sm:text-4xl">{{ $trendingArticle->title }}</h3>
                </div>
            </div>
        </a>
    </section>
@endif

<section class="mx-auto max-w-375 px-4 pb-24 sm:px-6 lg:px-8" x-data="{ active: 'all' }">
    <div class="mb-8 flex flex-col gap-5">
        <div>
            <h2 class="text-2xl font-extrabold text-[#1C1412]">Blog Posts</h2>
            @if($search !== '')
                <p class="mt-2 text-sm font-bold text-[#686677]">Showing results for "{{ $search }}"</p>
            @endif
        </div>
        <div class="flex w-full items-center gap-2 rounded-xl bg-white px-3 py-2 sm:w-91.25 sm:h-13.5" style="box-shadow: 0px 0px 4px 0px #00000040;">
            <button @click="active = 'all'" :class="active === 'all' ? 'bg-brand text-white' : 'border border-[#CBCAD7] bg-white text-[#8E8C9C]'" class="flex-1 rounded-lg px-4 py-1.5 text-xs font-bold sm:flex-none sm:px-7 sm:py-2.5 sm:text-sm">All</button>
            <button @click="active = 'Publisher'" :class="active === 'Publisher' ? 'bg-brand text-white' : 'border border-[#CBCAD7] bg-white text-[#8E8C9C]'" class="flex-1 rounded-lg px-3 py-1.5 text-xs font-semibold whitespace-nowrap sm:flex-none sm:px-4 sm:py-2.5 sm:text-sm">For Publisher</button>
            <button @click="active = 'Advertiser'" :class="active === 'Advertiser' ? 'bg-brand text-white' : 'border border-[#CBCAD7] bg-white text-[#8E8C9C]'" class="flex-1 rounded-lg px-3 py-1.5 text-xs font-semibold whitespace-nowrap sm:flex-none sm:px-4 sm:py-2.5 sm:text-sm">For Advertiser</button>
        </div>
    </div>

    <div class="grid gap-8 lg:grid-cols-2">
        @forelse ($posts as $post)
            <article x-show="active === 'all' || active === '{{ $post->display_category }}'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" class="overflow-hidden rounded-[22px] border border-[#F1CDBA] bg-white">
                <a href="{{ route('blog.show', $post->slug) }}" class="group block">
                    <div class="relative h-64 sm:h-80">
                        <img src="{{ $post->image ?: $fallbackImage }}" alt="{{ $post->title }}" class="h-full w-full object-cover transition duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-black/25"></div>
                        <span class="absolute left-4 top-4 rounded-full bg-white px-3 py-1.5 text-xs font-bold border border-brand text-brand">{{ $post->display_category }}</span>
                    </div>
                    <div class="p-5 sm:p-6">
                        <div class="flex gap-3 text-xs font-semibold text-[#8E8C9C]">
                            <span>{{ optional($post->published_at)->format('F j, Y') }}</span>
                            <span class="text-brand">{{ $post->author?->name ?: $post->author_name }}</span>
                        </div>
                        <h3 class="mt-4 text-xl font-extrabold leading-snug text-[#1C1412] sm:text-2xl">{{ $post->title }}</h3>
                        <p class="mt-4 text-sm leading-relaxed text-[#686677]">{{ $post->excerpt }}</p>
                        <span class="mt-5 inline-flex min-w-40 items-center justify-center gap-2 rounded-lg border border-brand px-6 py-2.5 text-sm font-bold text-brand">
                            Read more
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14" />
                                <path d="m12 5 7 7-7 7" />
                            </svg>
                        </span>
                    </div>
                </a>
            </article>
        @empty
            <div class="rounded-[22px] border border-[#F1CDBA] bg-white p-8 text-center lg:col-span-2">
                <p class="text-sm font-bold text-[#686677]">{{ $search !== '' ? 'No articles matched your search.' : 'No published blog posts yet.' }}</p>
            </div>
        @endforelse
    </div>

    @if($articles instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $articles->hasPages())
        <div class="-mx-4 mt-10 flex justify-center sm:mx-0">
            <div class="flex w-full items-center justify-center gap-2 rounded-none bg-white px-3 py-3 shadow-[0_2px_14px_rgba(28,20,18,0.12)] sm:w-auto sm:rounded-lg sm:py-2">
                @if($articles->onFirstPage())
                    <span class="flex h-8 w-8 items-center justify-center rounded-md text-[#8E8C9C] opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </span>
                @else
                    <a href="{{ $articles->previousPageUrl() }}" class="flex h-8 w-8 items-center justify-center rounded-md text-[#1C1412] transition hover:bg-[#FFE5D1]" aria-label="Previous page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m15 18-6-6 6-6" />
                        </svg>
                    </a>
                @endif

                <div class="flex items-center gap-1">
                    @foreach($paginationPages as $page)
                        @if($page === '...')
                            <span class="px-1 text-sm font-bold text-[#686677]">...</span>
                        @elseif($page == $articles->currentPage())
                            <span class="flex h-6 min-w-6 items-center justify-center rounded-full bg-[#F6CFD3] px-2 text-xs font-bold text-[#686677]">{{ $page }}</span>
                        @else
                            <a href="{{ $articles->url($page) }}" class="flex h-6 min-w-6 items-center justify-center rounded-full px-2 text-xs font-semibold text-[#1C1412] transition hover:bg-[#FFE5D1]">{{ $page }}</a>
                        @endif
                    @endforeach
                </div>

                @if($articles->hasMorePages())
                    <a href="{{ $articles->nextPageUrl() }}" class="flex h-8 w-8 items-center justify-center rounded-md text-[#1C1412] transition hover:bg-[#FFE5D1]" aria-label="Next page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                @else
                    <span class="flex h-8 w-8 items-center justify-center rounded-md text-[#8E8C9C] opacity-40">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </span>
                @endif

                <form method="GET" action="{{ route('blog.index') }}" class="ml-2 hidden sm:block">
                    @if($search !== '')
                        <input type="hidden" name="search" value="{{ $search }}">
                    @endif
                    <select name="per_page" onchange="this.form.submit()" class="h-9 rounded-full border border-[#CBCAD7] bg-white px-3 text-xs font-semibold text-[#1C1412] outline-none focus:border-brand">
                        @foreach([10, 20, 30] as $option)
                            <option value="{{ $option }}" @selected($perPage === $option)>{{ $option }} / page</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>
    @endif
</section>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const root = document.querySelector('[data-blog-search]');

        if (!root) {
            return;
        }

        const input = root.querySelector('[data-blog-search-input]');
        const panel = root.querySelector('[data-blog-search-panel]');
        const status = root.querySelector('[data-blog-search-status]');
        const results = root.querySelector('[data-blog-search-results]');
        const viewAll = root.querySelector('[data-blog-search-view-all]');
        const searchUrl = root.dataset.searchUrl;
        let timer = null;
        let controller = null;

        function showPanel() {
            panel.classList.remove('hidden');
        }

        function hidePanel() {
            panel.classList.add('hidden');
        }

        function setStatus(message) {
            results.innerHTML = '';
            viewAll.classList.add('hidden');
            status.textContent = message;
            status.classList.remove('hidden');
            showPanel();
        }

        function resultCard(result) {
            const link = document.createElement('a');
            link.href = result.url;
            link.className = 'flex gap-3 rounded-2xl p-3 transition hover:bg-[#FFE5D1]/45';

            const image = document.createElement('img');
            image.src = result.image || 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=240&q=80';
            image.alt = '';
            image.className = 'h-16 w-16 shrink-0 rounded-xl object-cover';

            const body = document.createElement('span');
            body.className = 'min-w-0 flex-1';

            const meta = document.createElement('span');
            meta.className = 'flex flex-wrap gap-2 text-[11px] font-extrabold uppercase tracking-wide text-[#E97A37]';
            meta.textContent = [result.category, result.date].filter(Boolean).join(' • ');

            const title = document.createElement('span');
            title.className = 'mt-1 block truncate text-sm font-extrabold text-[#1C1412]';
            title.textContent = result.title;

            const excerpt = document.createElement('span');
            excerpt.className = 'mt-1 line-clamp-2 block text-xs font-semibold leading-relaxed text-[#686677]';
            excerpt.textContent = result.excerpt || '';

            body.append(meta, title, excerpt);
            link.append(image, body);

            return link;
        }

        function renderResults(items, query) {
            status.classList.add('hidden');
            results.innerHTML = '';

            if (!items.length) {
                setStatus('No matching articles found.');
                return;
            }

            items.forEach((item) => results.append(resultCard(item)));
            viewAll.href = `${root.querySelector('form').action}?search=${encodeURIComponent(query)}`;
            viewAll.classList.remove('hidden');
            showPanel();
        }

        async function search(query) {
            if (query.length < 2) {
                hidePanel();
                return;
            }

            controller?.abort();
            controller = new AbortController();
            setStatus('Searching articles...');

            try {
                const response = await fetch(`${searchUrl}?q=${encodeURIComponent(query)}`, {
                    headers: { Accept: 'application/json' },
                    signal: controller.signal,
                });

                if (!response.ok) {
                    setStatus('Search is unavailable right now.');
                    return;
                }

                const data = await response.json();
                renderResults(data.results || [], query);
            } catch (error) {
                if (error.name !== 'AbortError') {
                    setStatus('Search is unavailable right now.');
                }
            }
        }

        input.addEventListener('input', () => {
            clearTimeout(timer);
            const query = input.value.trim();
            timer = setTimeout(() => search(query), 220);
        });

        input.addEventListener('focus', () => {
            if (results.children.length || status.textContent) {
                showPanel();
            }
        });

        document.addEventListener('click', (event) => {
            if (!root.contains(event.target)) {
                hidePanel();
            }
        });
    });
</script>
