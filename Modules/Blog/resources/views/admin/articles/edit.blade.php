@extends('blog::admin.layout')

@section('title', 'Edit Article - Creavibe Editorial')

@section('content')
@php
    $showOnBlog = session()->hasOldInput() ? old('show_on_blog', false) : ($article->show_on_blog ?? true);
    $isTrending = $showOnBlog && (session()->hasOldInput() ? old('is_trending', false) : ($article->is_trending ?? false));
@endphp
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <a href="{{ route('blog-admin.articles.index') }}" class="text-gray-400 hover:text-brand-accent transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
            </a>
            Edit: {{ Str::limit($article['title'], 30) }}
        </h1>
    </div>
    
    <div class="flex gap-3">
        <button type="button" data-article-preview-open class="bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm py-2 px-4 inline-flex justify-center text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none transition">
            Preview
        </button>
        <button type="submit" form="article-edit-form" class="bg-brand-accent border border-transparent rounded-md shadow-sm py-2 px-6 inline-flex justify-center text-sm font-medium text-white hover:bg-[#d66c2e] focus:outline-none transition">
            Save Changes
        </button>
    </div>
</div>

<form id="article-edit-form" action="{{ route('blog-admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data" class="flex flex-col lg:flex-row gap-6">
    @csrf
    @method('PUT')
    <!-- Main Editorial Column -->
    <div class="min-w-0 flex-1 space-y-6">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden p-6">
            <div class="mb-6">
                <label for="title" class="sr-only">Article Title</label>
                <input type="text" name="title" id="title" value="{{ old('title', $article->title) }}" required class="block w-full border-0 border-b border-transparent bg-transparent text-gray-900 dark:text-white text-3xl font-extrabold focus:border-brand-accent focus:ring-0 px-0 transition placeholder-gray-400 dark:placeholder-gray-500" placeholder="Enter headline here...">
            </div>

            <div class="mb-6">
                <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">URL Slug</label>
                <div class="mt-1 flex rounded-md shadow-sm">
                    <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400">/</span>
                    <input type="text" id="slug" name="slug" value="{{ old('slug', $article->slug) }}" class="block w-full rounded-none rounded-r-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="seo-friendly-url-slug" data-initial-slug="{{ old('slug', $article->slug) }}">
                </div>
                <p id="slug-help" class="mt-1 text-xs text-gray-500 dark:text-gray-400">Current article slug. Edit it or clear it to regenerate from the headline.</p>
            </div>

            <div class="mb-6">
                <label for="excerpt" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Excerpt (Brief Summary)</label>
                <textarea id="excerpt" name="excerpt" rows="3" class="shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 rounded-md focus:outline-none p-3 placeholder-gray-400" placeholder="A short summary of the article...">{{ $article->excerpt }}</textarea>
            </div>

            <div class="ck-editor-container article-content-editor min-w-0 rounded-xl border border-gray-100 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
                <div class="flex items-center justify-between gap-3 bg-white px-6 py-5 dark:bg-gray-800">
                    <div class="flex min-w-0 items-center gap-4">
                        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-md bg-[#DED0FF] text-3xl font-extrabold text-[#5B2EE6]">A</span>
                        <div class="min-w-0">
                            <label for="content" class="block text-2xl font-bold leading-tight text-gray-900 dark:text-white">Article Content <span class="text-red-500">*</span></label>
                            <p class="mt-1 text-sm font-medium text-gray-500 dark:text-gray-400">Write your main content</p>
                        </div>
                    </div>
                    <button type="button" data-article-preview-open class="shrink-0 rounded-md border border-gray-300 bg-white px-3 py-1.5 text-xs font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                        Preview
                    </button>
                </div>
                <textarea id="content" name="content" class="hidden">{{ $article->content }}</textarea>
                <p class="px-6 py-3 text-xs text-gray-500 dark:text-gray-400">Use the media button or paste a YouTube/Vimeo URL to show a video block inside the article.</p>
            </div>
        </div>
    </div>

    <!-- SEO & Metadata Sidebar -->
    <div class="w-full lg:w-80 flex-shrink-0 space-y-6">
        
        <!-- Post Settings -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Publish Settings</h3>
            </div>
            <div class="p-4 space-y-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Status</label>
                    <select id="status" name="status" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none appearance-none">
                        <option value="Draft" {{ $article->status == 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Published" {{ $article->status == 'Published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div>
                    <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Blog Category</label>
                    <select id="category_id" name="blog_category_id" required class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none appearance-none">
                        <option value="">Select an active category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" @selected((int) old('blog_category_id', $article->blog_category_id) === $category->id)>{{ $category->name }}{{ $category->is_active ? '' : ' (Inactive)' }}</option>
                        @endforeach
                    </select>
                    @error('blog_category_id')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="author_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Author</label>
                    <select id="author_id" name="author_id" required class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none appearance-none">
                        <option value="">Select an active author</option>
                        @foreach($authors as $author)
                            @php
                                $authorData = [
                                'id' => $author->id,
                                'name' => $author->name,
                                'avatar' => $author->avatar,
                                'signature' => $author->signature,
                                'bio' => $author->bio,
                                'designation' => $author->designation,
                                'is_active' => $author->is_active,
                                ];
                            @endphp
                            <option value="{{ $author->id }}" @selected((int) old('author_id', $article->author_id) === $author->id) data-author="{{ json_encode($authorData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) }}">{{ $author->name }}{{ $author->designation ? ' - '.$author->designation : '' }}{{ $author->is_active ? '' : ' (Inactive)' }}</option>
                        @endforeach
                    </select>
                    @error('author_id')
                        <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                    <div id="article-author-preview" class="mt-3 hidden rounded-lg border border-gray-200 bg-gray-50 p-3 dark:border-gray-700 dark:bg-gray-900/40">
                        <div class="flex items-start gap-3">
                            <img data-author-preview-avatar src="" alt="" class="hidden h-12 w-12 rounded-full border-2 border-brand-accent object-cover">
                            <span data-author-preview-initials class="flex h-12 w-12 items-center justify-center rounded-full border-2 border-brand-accent bg-brand-accent/10 text-sm font-bold text-brand-accent">A</span>
                            <div class="min-w-0 flex-1">
                                <p data-author-preview-name class="font-semibold text-gray-900 dark:text-white"></p>
                                <p data-author-preview-role class="text-xs font-semibold uppercase tracking-wide text-brand-accent"></p>
                                <p data-author-preview-bio class="mt-2 text-sm leading-relaxed text-gray-600 dark:text-gray-300"></p>
                                <img data-author-preview-signature src="" alt="" class="mt-3 hidden max-h-12 w-auto">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="space-y-3 rounded-lg border border-gray-200 p-3 dark:border-gray-700">
                    <label class="flex items-start gap-2">
                        <input type="checkbox" id="show_on_blog" name="show_on_blog" value="1" {{ $showOnBlog ? 'checked' : '' }} class="mt-1 h-4 w-4 rounded border-gray-300 text-brand-accent focus:ring-brand-accent">
                        <span>
                            <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Show in blog listing</span>
                            <span class="block text-xs text-gray-500 dark:text-gray-400">If disabled, this article is hidden from /blog and opens from /{{ $article->slug }} for SEO landing pages.</span>
                        </span>
                    </label>
                    <label class="flex items-start gap-2">
                        <input type="checkbox" id="is_trending" name="is_trending" value="1" {{ $isTrending ? 'checked' : '' }} {{ $showOnBlog ? '' : 'disabled' }} class="mt-1 h-4 w-4 rounded border-gray-300 text-brand-accent focus:ring-brand-accent disabled:cursor-not-allowed disabled:opacity-50">
                        <span>
                            <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Feature as Weekly Trending</span>
                            <span class="block text-xs text-gray-500 dark:text-gray-400">Only one listed article can be trending at a time.</span>
                        </span>
                    </label>
                </div>
                <button type="submit" class="w-full bg-brand-accent border border-transparent rounded-md shadow-sm py-2 px-6 inline-flex justify-center text-sm font-medium text-white hover:bg-[#d66c2e] focus:outline-none transition">
                    Update Article
                </button>
            </div>
        </div>

        <!-- Featured Image -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider">Featured Image</h3>
            </div>
            <div class="p-4 space-y-4">
                @if($article->image)
                <div class="mb-2">
                    <p class="text-xs text-gray-500 mb-1">Current Image:</p>
                    <img src="{{ $article->image }}" class="w-full h-32 object-cover rounded-md border border-gray-200 dark:border-gray-700">
                </div>
                @endif
                <div>
                    <label for="image_file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Upload New Image</label>
                    <input type="file" id="image_file" name="image_file" class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-brand-accent/10 file:text-brand-accent hover:file:bg-brand-accent/20 transition cursor-pointer">
                </div>
                <div class="relative flex items-center py-2">
                    <div class="flex-grow border-t border-gray-200 dark:border-gray-700"></div>
                    <span class="flex-shrink mx-4 text-gray-400 text-xs uppercase">OR</span>
                    <div class="flex-grow border-t border-gray-200 dark:border-gray-700"></div>
                </div>
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image URL</label>
                    <input type="text" id="image" name="image" value="{{ old('image', $article->image) }}" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="https://...">
                </div>
                <div class="border-t border-gray-200 pt-4 dark:border-gray-700">
                    <h4 class="text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400">Image SEO</h4>
                    <div class="mt-3 space-y-4">
                        <div>
                            <label for="image_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image Title</label>
                            <input type="text" id="image_title" name="image_title" value="{{ old('image_title', $article->image_title) }}" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="Descriptive image title">
                        </div>
                        <div>
                            <label for="image_alt_text" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image Alt Text</label>
                            <input type="text" id="image_alt_text" name="image_alt_text" value="{{ old('image_alt_text', $article->image_alt_text) }}" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="Describe the image for search and accessibility">
                        </div>
                        <div>
                            <label for="image_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image Description</label>
                            <textarea id="image_description" name="image_description" rows="3" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="Longer image SEO description">{{ old('image_description', $article->image_description) }}</textarea>
                        </div>
                        <div>
                            <label for="image_caption" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image Caption</label>
                            <textarea id="image_caption" name="image_caption" rows="2" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="Optional visible caption if used later">{{ old('image_caption', $article->image_caption) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SEO Setting -->
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white uppercase tracking-wider">SEO Metadata</h3>
            </div>
            <div class="p-4 space-y-4">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ $article->meta_title }}" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="Optimized title...">
                </div>
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="3" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="Brief summary for search engines...">{{ $article->meta_description }}</textarea>
                </div>
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Meta Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ $article->meta_keywords }}" class="mt-1 shadow-sm focus:ring-brand-accent focus:border-brand-accent block w-full sm:text-sm border border-gray-300 dark:border-gray-600 px-3 py-2 rounded-md bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none" placeholder="digital pr, seo, publishers">
                </div>
            </div>
        </div>

    </div>
</form>

@include('blog::admin.articles.partials.editor-assets')
@include('blog::admin.articles.partials.preview-modal', [
    'publishedAt' => optional($article->published_at)->format('F j, Y'),
    'authorAvatar' => $article->author?->avatar ?: $article->author_avatar,
    'authorSignature' => $article->author?->signature ?: $article->author_signature,
])
<script>
    const showOnBlogCheckbox = document.querySelector('#show_on_blog');
    const trendingCheckbox = document.querySelector('#is_trending');

    function syncTrendingAvailability() {
        if (!showOnBlogCheckbox || !trendingCheckbox) {
            return;
        }

        trendingCheckbox.disabled = !showOnBlogCheckbox.checked;

        if (!showOnBlogCheckbox.checked) {
            trendingCheckbox.checked = false;
        }
    }

    showOnBlogCheckbox?.addEventListener('change', syncTrendingAvailability);
    syncTrendingAvailability();

    createArticleEditor('#content', @js(route('blog-admin.articles.upload', ['_token' => csrf_token()], false)));
    setupArticleAuthorPreview('#author_id', '#article-author-preview');
    setupArticlePreview({
        formSelector: '#article-edit-form',
        currentAuthorName: @json($article->author?->name ?: $article->author_name),
        currentAuthorAvatar: @json($article->author?->avatar ?: $article->author_avatar),
        currentAuthorSignature: @json($article->author?->signature ?: $article->author_signature),
        currentAuthorBio: @json($article->author?->bio),
        currentAuthorDesignation: @json($article->author?->designation),
    });
    setupArticleSlugGenerator({
        titleSelector: '#title',
        slugSelector: '#slug',
        helpSelector: '#slug-help',
        resolveUrl: @js(route('blog-admin.articles.resolve-slug', [], false)),
        ignoreId: {{ $article->id }},
    });
</script>
@endsection
