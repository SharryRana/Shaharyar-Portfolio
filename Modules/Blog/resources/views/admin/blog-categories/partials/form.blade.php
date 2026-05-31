@php
    $isEditing = $category->exists;
@endphp

<div class="grid gap-6 lg:grid-cols-[1fr_340px]">
    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <div class="space-y-5">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" required class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Link Building">
                    @error('name') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Slug</label>
                    <div class="mt-1 flex rounded-md shadow-sm">
                        <span class="inline-flex items-center rounded-l-md border border-r-0 border-gray-300 bg-gray-50 px-3 text-sm text-gray-500 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-400">/category/</span>
                        <input type="text" id="slug" name="slug" value="{{ old('slug', $category->slug) }}" class="block w-full rounded-none rounded-r-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="link-building" data-initial-slug="{{ old('slug', $category->slug) }}">
                    </div>
                    <p id="category-slug-help" class="mt-1 text-xs text-gray-500 dark:text-gray-400">Auto-generated from the category name. You can edit it manually.</p>
                    @error('slug') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Category Description</label>
                    <textarea id="description" name="description" rows="6" class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Describe this blog category">{{ old('description', $category->description) }}</textarea>
                    @error('description') <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <h3 class="text-sm font-semibold uppercase tracking-wider text-gray-900 dark:text-white">SEO Metadata</h3>
            <div class="mt-4 space-y-5">
                <div>
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SEO Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Optimized category title">
                </div>
                <div>
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SEO Meta Description</label>
                    <textarea id="meta_description" name="meta_description" rows="4" class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="Search description">{{ old('meta_description', $category->meta_description) }}</textarea>
                </div>
                <div>
                    <label for="meta_keywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300">SEO Keywords</label>
                    <input type="text" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $category->meta_keywords) }}" class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-brand-accent focus:outline-none focus:ring-brand-accent dark:border-gray-600 dark:bg-gray-700 dark:text-white" placeholder="seo, backlinks, digital pr">
                </div>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <label class="flex items-start gap-3">
                <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="mt-1 h-4 w-4 rounded border-gray-300 text-brand-accent focus:ring-brand-accent">
                <span>
                    <span class="block text-sm font-semibold text-gray-900 dark:text-white">Active category</span>
                    <span class="block text-xs text-gray-500 dark:text-gray-400">Only active categories appear in the article dropdown.</span>
                </span>
            </label>
        </div>

        <button type="submit" class="w-full rounded-md border border-transparent bg-brand-accent px-6 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#d66c2e]">
            {{ $isEditing ? 'Update Category' : 'Create Category' }}
        </button>
    </div>
</div>

<script>
    function setupCategorySlugGenerator(options) {
        const nameInput = document.querySelector(options.nameSelector);
        const slugInput = document.querySelector(options.slugSelector);
        const helpText = document.querySelector(options.helpSelector);

        if (!nameInput || !slugInput) {
            return;
        }

        let manualSlug = Boolean(slugInput.value.trim());
        let debounceTimer = null;

        function cleanSlug(value) {
            return (value || '')
                .toString()
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-+|-+$/g, '');
        }

        function setHelp(message) {
            if (helpText) {
                helpText.textContent = message;
            }
        }

        function resolveSlug(value) {
            const cleaned = cleanSlug(value);

            if (!cleaned) {
                slugInput.value = '';
                setHelp('Enter a category name to generate a slug.');
                return;
            }

            slugInput.value = cleaned;
            setHelp('Checking slug availability...');
            clearTimeout(debounceTimer);

            debounceTimer = setTimeout(async () => {
                const url = new URL(options.resolveUrl, window.location.origin);
                url.searchParams.set('value', cleaned);

                if (options.ignoreId) {
                    url.searchParams.set('ignore_id', options.ignoreId);
                }

                try {
                    const response = await fetch(url, { headers: { Accept: 'application/json' } });

                    if (!response.ok) {
                        return;
                    }

                    const data = await response.json();
                    slugInput.value = cleanSlug(data.slug || cleaned);
                    setHelp('Slug is clean and available.');
                } catch (error) {
                    setHelp('Slug will be cleaned again when you save.');
                }
            }, 250);
        }

        nameInput.addEventListener('input', () => {
            if (!manualSlug) {
                resolveSlug(nameInput.value);
            }
        });

        slugInput.addEventListener('input', () => {
            manualSlug = Boolean(slugInput.value.trim());
            slugInput.value = cleanSlug(slugInput.value);
            resolveSlug(slugInput.value || nameInput.value);
        });

        if (!slugInput.value.trim() && nameInput.value.trim()) {
            resolveSlug(nameInput.value);
        }
    }

    setupCategorySlugGenerator({
        nameSelector: '#name',
        slugSelector: '#slug',
        helpSelector: '#category-slug-help',
        resolveUrl: @js(route('blog-admin.blog-categories.resolve-slug', [], false)),
        ignoreId: {{ $category->exists ? $category->id : 'null' }},
    });
</script>
