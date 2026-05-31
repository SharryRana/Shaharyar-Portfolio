@php
    $publishedAt = $publishedAt ?? null;
    $authorAvatar = $authorAvatar ?? null;
    $authorSignature = $authorSignature ?? null;
@endphp

<div id="article-preview-modal" class="fixed inset-0 z-50 hidden bg-gray-950/70 backdrop-blur-sm">
    <div class="flex h-full flex-col">
        <div class="flex items-center justify-between border-b border-gray-200 bg-white px-4 py-3 shadow-sm dark:border-gray-700 dark:bg-gray-900 sm:px-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-wider text-brand-accent">Live Preview</p>
                <h2 class="text-base font-bold text-gray-900 dark:text-white">Blog detail page preview</h2>
            </div>
            <button type="button" id="article-preview-close" class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700">
                Close Preview
            </button>
        </div>

        <div class="min-h-0 flex-1 overflow-y-auto bg-white" id="article-preview-scroll">
            <section class="pt-16 sm:pt-20">
                <div class="mx-auto max-w-[1500px] px-4 text-center sm:px-6 lg:px-8">
                    <p id="preview-date" class="text-lg font-bold text-[#E97A37]" data-fallback-date="{{ $publishedAt ?: now()->format('F j, Y') }}">{{ $publishedAt ?: now()->format('F j, Y') }}</p>
                    <h1 id="preview-title" class="mx-auto mt-8 max-w-6xl text-[25px] font-extrabold leading-tight text-[#1C1412] sm:text-5xl lg:text-[40px]">
                        Untitled article
                    </h1>
                    <div class="relative mx-auto mt-12 max-w-[1250px]">
                        <div class="pointer-events-none absolute -bottom-10 left-1/2 h-36 w-[92%] -translate-x-1/2 rounded-[100%] bg-[#FFE5D1] opacity-80 blur-3xl"></div>
                        <img id="preview-hero-image" src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80" alt="Article preview image" class="relative z-10 h-[260px] w-full rounded-[18px] object-cover sm:h-[560px]">
                        <div class="absolute bottom-0 right-0 z-20 flex h-[76px] w-[222px] items-center justify-start rounded-tl-[18px] bg-gradient-to-br from-[#FFE5D1] via-[#FFF2E8] to-white p-1.5 sm:h-[94px] sm:w-[334px] sm:p-2">
                            <div class="flex h-[64px] w-[210px] items-center gap-3 rounded-xl bg-white px-4 shadow-xl sm:h-[82px] sm:w-[310px] sm:gap-4 sm:rounded-2xl sm:px-5">
                                <img id="preview-author-avatar" src="{{ $authorAvatar ?: '' }}" alt="Author avatar" class="{{ $authorAvatar ? '' : 'hidden' }} h-12 w-12 rounded-full border-4 border-[#77C88D] object-cover sm:h-16 sm:w-16">
                                <span id="preview-author-initials" class="{{ $authorAvatar ? 'hidden' : '' }} flex h-12 w-12 items-center justify-center rounded-full border-4 border-[#77C88D] bg-gradient-to-br from-[#FFE5D1] via-[#F5A876] to-[#E97A37] text-base font-extrabold text-white shadow-sm sm:h-16 sm:w-16 sm:text-xl">A</span>
                                <span id="preview-author-name" class="text-base font-extrabold text-[#1C1412] sm:text-2xl">Admin</span>
                            </div>
                        </div>
                    </div>
                    <p id="preview-image-caption" class="mx-auto mt-4 hidden max-w-[920px] text-sm font-medium leading-relaxed text-[#686677]"></p>
                </div>
            </section>

            <section class="mt-12 pb-24">
                <div class="mx-auto grid max-w-[1500px] gap-10 px-4 sm:px-6 lg:grid-cols-[430px_1fr] lg:px-8">
                    <aside class="hidden lg:block">
                        <div class="sticky top-6 overflow-hidden rounded-lg bg-white shadow-sm">
                            <div class="flex items-center justify-between bg-[#FFE5D1] px-5 py-5">
                                <h2 class="text-2xl font-semibold text-[#1C1412]">NAVIGATION</h2>
                                <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 7L7 1L13 7" stroke="#1C1412" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <nav id="preview-navigation">
                                <div class="border-t border-[#E6E3EA] px-5 py-4 text-[15px] font-semibold text-[#686677]">Article</div>
                            </nav>
                        </div>
                    </aside>

                    <article class="min-w-0 rounded-none bg-white lg:pt-0">
                        <div class="prose-content mx-auto max-w-[920px] text-[#686677]">
                            <div id="preview-content">
                                <p>Start writing content to preview the article.</p>
                            </div>

                            <div id="preview-tags" class="mt-8 flex flex-wrap gap-3"></div>

                            <div id="preview-signature-wrap" class="{{ $authorSignature ? '' : 'hidden' }} mt-10">
                                <p class="text-sm font-semibold text-[#686677]">I wish you luck</p>
                                <img id="preview-author-signature" src="{{ $authorSignature ?: '' }}" alt="Author signature" class="mt-2 h-auto w-42" loading="lazy">
                            </div>

                            <div class="mt-10 rounded-xl bg-[#FFE5D1] p-5 sm:p-7">
                                <div class="flex items-start justify-between">
                                    <p class="text-sm font-bold text-[#686677]">About Author</p>
                                </div>
                                <div class="mt-4 inline-flex min-h-0 items-center gap-3 rounded-lg bg-white px-4 py-2 align-middle">
                                    <img id="preview-about-avatar" src="{{ $authorAvatar ?: '' }}" alt="Author avatar" class="{{ $authorAvatar ? '' : 'hidden' }} author-avatar h-10 w-10 rounded-full border-4 border-[#77C88D] object-cover">
                                    <span id="preview-about-initials" class="{{ $authorAvatar ? 'hidden' : '' }} flex h-12 w-12 items-center justify-center rounded-full border-4 border-[#77C88D] bg-gradient-to-br from-[#FFE5D1] via-[#F5A876] to-[#E97A37] text-base font-extrabold text-white shadow-sm">A</span>
                                    <span>
                                        <span id="preview-about-author-name" class="block font-extrabold text-[#1C1412]">Admin</span>
                                        <span id="preview-about-author-role" class="hidden text-xs font-bold uppercase tracking-wide text-[#E97A37]"></span>
                                    </span>
                                </div>
                                <p id="preview-excerpt" class="mt-3 text-sm leading-relaxed text-[#686677]">A short summary of the article will appear here.</p>
                            </div>
                        </div>
                    </article>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    function setupArticlePreview(options = {}) {
        const form = document.querySelector(options.formSelector);
        const modal = document.querySelector('#article-preview-modal');

        if (!form || !modal) {
            return;
        }

        const fallbackHero = 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1600&q=80';
        const currentAuthorName = options.currentAuthorName || 'Admin';
        const currentAvatar = options.currentAuthorAvatar || '';
        const currentSignature = options.currentAuthorSignature || '';
        const currentAuthorBio = options.currentAuthorBio || '';
        const currentAuthorDesignation = options.currentAuthorDesignation || '';
        const objectUrls = new Set();
        let updateTimer = null;

        const fields = {
            title: form.querySelector('#title'),
            excerpt: form.querySelector('#excerpt'),
            category: form.querySelector('#category_id, #category'),
            image: form.querySelector('#image'),
            imageFile: form.querySelector('#image_file'),
            imageTitle: form.querySelector('#image_title'),
            imageAltText: form.querySelector('#image_alt_text'),
            imageCaption: form.querySelector('#image_caption'),
            authorSelect: form.querySelector('#author_id'),
            metaKeywords: form.querySelector('#meta_keywords'),
        };

        const preview = {
            modal,
            scroll: modal.querySelector('#article-preview-scroll'),
            close: modal.querySelector('#article-preview-close'),
            title: modal.querySelector('#preview-title'),
            heroImage: modal.querySelector('#preview-hero-image'),
            imageCaption: modal.querySelector('#preview-image-caption'),
            authorName: modal.querySelector('#preview-author-name'),
            authorInitials: modal.querySelector('#preview-author-initials'),
            authorAvatar: modal.querySelector('#preview-author-avatar'),
            aboutAuthorName: modal.querySelector('#preview-about-author-name'),
            aboutAuthorRole: modal.querySelector('#preview-about-author-role'),
            aboutInitials: modal.querySelector('#preview-about-initials'),
            aboutAvatar: modal.querySelector('#preview-about-avatar'),
            content: modal.querySelector('#preview-content'),
            navigation: modal.querySelector('#preview-navigation'),
            tags: modal.querySelector('#preview-tags'),
            excerpt: modal.querySelector('#preview-excerpt'),
            signatureWrap: modal.querySelector('#preview-signature-wrap'),
            signature: modal.querySelector('#preview-author-signature'),
        };

        function fieldValue(field, fallback = '') {
            return (field?.value || '').trim() || fallback;
        }

        function optionText(field, fallback = '') {
            const option = field?.selectedOptions?.[0];
            const text = (option?.textContent || '').replace(/\s+\(Inactive\)\s*$/, '').trim();

            return text || fieldValue(field, fallback);
        }

        function escapeHtml(value) {
            return value.replace(/[&<>"']/g, char => ({
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;',
            }[char]));
        }

        function initialsFor(name) {
            const initials = name
                .split(/\s+/)
                .filter(Boolean)
                .slice(0, 2)
                .map(part => part.charAt(0).toUpperCase())
                .join('');

            return initials || 'A';
        }

        function selectedAuthor() {
            if (typeof getSelectedArticleAuthor === 'function') {
                return getSelectedArticleAuthor(fields.authorSelect);
            }

            return null;
        }

        function objectUrlFor(fileInput) {
            const file = fileInput?.files?.[0];

            if (!file) {
                return '';
            }

            const url = URL.createObjectURL(file);
            objectUrls.add(url);

            return url;
        }

        function setImagePair(image, initials, src, initialsText) {
            if (src) {
                image.src = src;
                image.classList.remove('hidden');
                initials.classList.add('hidden');
            } else {
                image.removeAttribute('src');
                image.classList.add('hidden');
                initials.textContent = initialsText;
                initials.classList.remove('hidden');
            }
        }

        function videoEmbed(url) {
            const decodedUrl = document.createElement('textarea');
            decodedUrl.innerHTML = url;
            const cleanUrl = decodedUrl.value;
            let embedUrl = '';
            const youtube = cleanUrl.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/|youtube\.com\/embed\/|youtube\.com\/shorts\/)([A-Za-z0-9_-]{6,})/);
            const vimeo = cleanUrl.match(/vimeo\.com\/(?:video\/)?([0-9]+)/);

            if (youtube) {
                embedUrl = `https://www.youtube.com/embed/${youtube[1]}`;
            } else if (vimeo) {
                embedUrl = `https://player.vimeo.com/video/${vimeo[1]}`;
            }

            if (!embedUrl) {
                return null;
            }

            return `<div class="blog-video-embed"><iframe src="${escapeHtml(embedUrl)}" title="Article video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen loading="lazy"></iframe></div>`;
        }

        function slugify(value, fallback) {
            const slug = value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');

            return slug || fallback;
        }

        function renderContent(rawHtml) {
            const wrapper = document.createElement('div');
            wrapper.innerHTML = rawHtml || '<p>Start writing content to preview the article.</p>';

            wrapper.querySelectorAll('figure.media oembed[url], oembed[url]').forEach(oembed => {
                const embed = videoEmbed(oembed.getAttribute('url') || '');

                if (!embed) {
                    return;
                }

                const figure = oembed.closest('figure.media');
                const replacement = document.createElement('div');
                replacement.innerHTML = embed;
                (figure || oembed).replaceWith(replacement.firstElementChild);
            });

            const usedIds = new Set();
            const headings = [];

            wrapper.querySelectorAll('h1, h2, h3, h4, h5, h6').forEach((heading, index) => {
                const title = heading.textContent.trim();
                const baseId = slugify(title, `section-${index + 1}`);
                let id = baseId;
                let suffix = 2;

                while (usedIds.has(id)) {
                    id = `${baseId}-${suffix}`;
                    suffix += 1;
                }

                usedIds.add(id);
                heading.id = id;
                headings.push({
                    id,
                    title: title || `Section ${index + 1}`,
                    level: Number(heading.tagName.replace('H', '')),
                });
            });

            preview.content.innerHTML = wrapper.innerHTML;
            renderNavigation(headings);
        }

        function renderNavigation(headings) {
            if (!headings.length) {
                preview.navigation.innerHTML = '<div class="border-t border-[#E6E3EA] px-5 py-4 text-[15px] font-semibold text-[#686677]">Article</div>';
                return;
            }

            preview.navigation.innerHTML = headings.map(heading => `
                <a href="#${heading.id}" data-preview-section="${heading.id}" class="flex items-center gap-3 border-t border-[#E6E3EA] px-5 py-4 text-[15px] font-semibold text-[#686677] transition hover:bg-[#FFE5D1] hover:text-[#E97A37] ${heading.level >= 3 ? 'pl-8 text-[13px]' : ''}">
                    <span>${escapeHtml(heading.title)}</span>
                </a>
            `).join('');
        }

        function renderTags(category, keywords) {
            const tags = [category, ...keywords.split(',').map(tag => tag.trim()).filter(Boolean)];
            preview.tags.innerHTML = tags
                .filter(Boolean)
                .map(tag => `<span class="rounded-lg border border-[#CBCAD7] px-4 py-2 text-sm font-semibold text-[#686677]">#${escapeHtml(tag)}</span>`)
                .join('');
        }

        function updatePreview() {
            objectUrls.forEach(url => URL.revokeObjectURL(url));
            objectUrls.clear();

            const title = fieldValue(fields.title, 'Untitled article');
            const author = selectedAuthor();
            const authorName = author?.name || currentAuthorName || 'Admin';
            const authorBio = author?.bio || currentAuthorBio || fieldValue(fields.excerpt, 'A short summary of the article will appear here.');
            const authorDesignation = author?.designation || currentAuthorDesignation || '';
            const initials = initialsFor(authorName);
            const heroImage = objectUrlFor(fields.imageFile) || fieldValue(fields.image) || fallbackHero;
            const avatarImage = author?.avatar || currentAvatar;
            const signatureImage = author?.signature || currentSignature;
            const rawContent = window.articleContentEditor?.getData() || form.querySelector('#content')?.value || '';
            const content = typeof normalizeArticleLinks === 'function' ? normalizeArticleLinks(rawContent) : rawContent;

            preview.title.textContent = title;
            preview.heroImage.src = heroImage;
            preview.heroImage.alt = fieldValue(fields.imageAltText, title);
            preview.heroImage.title = fieldValue(fields.imageTitle, title);
            const imageCaption = fieldValue(fields.imageCaption);
            preview.imageCaption.textContent = imageCaption;
            preview.imageCaption.classList.toggle('hidden', !imageCaption);
            preview.authorName.textContent = authorName;
            preview.aboutAuthorName.textContent = authorName;
            preview.aboutAuthorRole.textContent = authorDesignation;
            preview.aboutAuthorRole.classList.toggle('hidden', !authorDesignation);
            preview.excerpt.textContent = authorBio;

            setImagePair(preview.authorAvatar, preview.authorInitials, avatarImage, initials);
            setImagePair(preview.aboutAvatar, preview.aboutInitials, avatarImage, initials);

            if (signatureImage) {
                preview.signature.src = signatureImage;
                preview.signature.alt = `${authorName} signature`;
                preview.signatureWrap.classList.remove('hidden');
            } else {
                preview.signature.removeAttribute('src');
                preview.signatureWrap.classList.add('hidden');
            }

            renderContent(content);
            renderTags(optionText(fields.category, 'Link Building'), fieldValue(fields.metaKeywords));
        }

        function scheduleUpdate() {
            clearTimeout(updateTimer);
            updateTimer = setTimeout(updatePreview, 80);
        }

        function openPreview() {
            updatePreview();
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
            preview.scroll.scrollTop = 0;
        }

        function closePreview() {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }

        form.querySelectorAll('input, textarea, select').forEach(input => {
            input.addEventListener('input', scheduleUpdate);
            input.addEventListener('change', scheduleUpdate);
        });

        preview.close.addEventListener('click', closePreview);
        modal.addEventListener('click', event => {
            if (event.target === modal) {
                closePreview();
            }
        });
        preview.navigation.addEventListener('click', event => {
            const link = event.target.closest('[data-preview-section]');

            if (!link) {
                return;
            }

            event.preventDefault();
            preview.content.querySelector(`#${CSS.escape(link.dataset.previewSection)}`)?.scrollIntoView({
                behavior: 'smooth',
                block: 'start',
            });
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape' && !modal.classList.contains('hidden')) {
                closePreview();
            }
        });
        document.addEventListener('article-editor-ready', event => {
            event.detail.editor.model.document.on('change:data', scheduleUpdate);
            scheduleUpdate();
        });

        if (window.articleContentEditor) {
            window.articleContentEditor.model.document.on('change:data', scheduleUpdate);
        }

        document.querySelectorAll('[data-article-preview-open]').forEach(button => {
            button.addEventListener('click', openPreview);
        });

        scheduleUpdate();
    }
</script>
