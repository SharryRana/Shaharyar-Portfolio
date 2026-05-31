<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
<style>
    .article-content-editor .ck.ck-editor {
        border-radius: 0 0 0.75rem 0.75rem;
        max-width: 100%;
        overflow: visible;
    }

    .article-content-editor .ck.ck-editor__top,
    .article-content-editor .ck.ck-sticky-panel,
    .article-content-editor .ck.ck-sticky-panel__content {
        overflow: visible;
    }

    .article-content-editor .ck.ck-toolbar {
        background: #f5f5f5;
        border-color: #eef0f4;
        border-left: 0;
        border-right: 0;
        gap: 0.2rem;
        padding: 0.8rem 1rem;
        max-width: 100%;
        overflow: visible;
    }

    .article-content-editor .ck.ck-toolbar > .ck-toolbar__items {
        flex-wrap: wrap;
        max-width: 100%;
    }

    .article-content-editor .ck.ck-toolbar .ck-button,
    .article-content-editor .ck.ck-toolbar .ck-dropdown__button {
        border-radius: 0.35rem;
        min-height: 2rem;
        min-width: 2rem;
    }

    .article-content-editor .ck.ck-toolbar .ck-toolbar__separator {
        background: #d7d5e2;
        height: 2rem;
        margin-left: 0.45rem;
        margin-right: 0.45rem;
    }

    .article-content-editor .ck.ck-dropdown .ck-button__label {
        font-size: 0.95rem;
    }

    .article-content-editor .ck.ck-toolbar .ck-button.ck-on,
    .article-content-editor .ck.ck-toolbar .ck-dropdown__button.ck-on {
        background: #fff4ee;
        color: #d4651f;
    }

    .article-content-editor .ck.ck-editor__main > .ck-editor__editable {
        background: #ffffff;
        border-color: #eef0f4;
        border-top: 0;
        color: #1c1412;
        min-height: 620px;
        padding: 2.25rem;
        width: 100%;
    }

    .article-content-editor .ck.ck-editor__main > .ck-editor__editable.ck-focused {
        border-color: #e97a37;
        box-shadow: 0 0 0 1px #e97a37;
    }

    .article-content-editor .ck-source-editing-area textarea {
        min-height: 620px;
        padding: 1.5rem;
    }

    .ck.ck-balloon-panel {
        max-width: min(320px, calc(100vw - 2rem)) !important;
        width: auto !important;
        z-index: 80;
    }

    .ck.ck-balloon-panel .ck-balloon-rotator__content,
    .ck.ck-balloon-panel .ck-responsive-form,
    .ck.ck-balloon-panel .ck-form__row {
        max-width: 100% !important;
        min-width: 0 !important;
        width: 100% !important;
    }

    .ck.ck-balloon-panel .ck-insert-table-dropdown__grid {
        max-height: min(320px, 46vh);
        overflow-y: auto;
        overscroll-behavior: contain;
        padding-right: 0.25rem;
    }

    .ck.ck-balloon-panel .ck-insert-table-dropdown__label {
        position: sticky;
        bottom: 0;
        background: #ffffff;
        padding-top: 0.35rem;
    }

    .ck.ck-balloon-panel .ck-media-form,
    .ck.ck-balloon-panel .ck-link-form {
        align-items: stretch;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        max-width: min(300px, calc(100vw - 2rem)) !important;
        min-width: 0 !important;
        width: min(300px, calc(100vw - 2rem)) !important;
    }

    .ck.ck-balloon-panel .ck-media-form .ck-labeled-field-view,
    .ck.ck-balloon-panel .ck-link-form .ck-labeled-field-view {
        flex: 1 1 100%;
        min-width: 0;
        width: 100% !important;
    }

    .ck.ck-balloon-panel .ck-media-form .ck-input,
    .ck.ck-balloon-panel .ck-link-form .ck-input,
    .ck.ck-balloon-panel input.ck-input,
    .ck.ck-balloon-panel input.ck-input_text {
        min-width: 0 !important;
        width: 100% !important;
    }

    .ck.ck-balloon-panel .ck-media-form .ck-button,
    .ck.ck-balloon-panel .ck-link-form .ck-button {
        flex: 0 0 auto;
    }

    .article-content-editor .ck-content {
        font-family: Inter, ui-sans-serif, system-ui, sans-serif;
        font-size: 1.0625rem;
        line-height: 1.75;
    }

    .article-content-editor .ck-content h1,
    .article-content-editor .ck-content h2,
    .article-content-editor .ck-content h3,
    .article-content-editor .ck-content h4,
    .article-content-editor .ck-content h5,
    .article-content-editor .ck-content h6 {
        color: #1c1412;
        font-weight: 800;
        letter-spacing: 0;
        line-height: 1.18;
    }

    .article-content-editor .ck-content h1 {
        font-size: 2.5rem;
        margin: 2.75rem 0 1.25rem;
    }

    .article-content-editor .ck-content h2 {
        font-size: 2rem;
        margin: 2.4rem 0 1rem;
    }

    .article-content-editor .ck-content h3 {
        font-size: 1.5rem;
        margin: 2rem 0 0.85rem;
    }

    .article-content-editor .ck-content h4 {
        font-size: 1.2rem;
        margin: 1.75rem 0 0.75rem;
    }

    .article-content-editor .ck-content h5 {
        font-size: 1.1rem;
        margin: 1.5rem 0 0.65rem;
    }

    .article-content-editor .ck-content h6 {
        font-size: 1rem;
        margin: 1.35rem 0 0.6rem;
        text-transform: uppercase;
    }

    .article-content-editor .ck-content h1:first-child,
    .article-content-editor .ck-content h2:first-child,
    .article-content-editor .ck-content h3:first-child,
    .article-content-editor .ck-content h4:first-child,
    .article-content-editor .ck-content h5:first-child,
    .article-content-editor .ck-content h6:first-child {
        margin-top: 0;
    }

    .article-content-editor .ck-content p {
        color: #686677;
        font-size: 1.0625rem;
        line-height: 1.75;
        margin: 1.15rem 0;
    }

    .article-content-editor .ck-content .ck-placeholder::before {
        color: #77758a;
        font-size: 1.1rem;
        font-weight: 400;
    }

    .article-content-editor .ck-content strong {
        color: #1c1412;
        font-weight: 800;
    }

    .article-content-editor .ck-content em {
        color: #4f4b5c;
    }

    .article-content-editor .ck-content a {
        color: #e97a37;
        font-weight: 700;
        text-decoration: none;
    }

    .article-content-editor .ck-content u,
    .article-content-editor .ck-content a u,
    .article-content-editor .ck-content u a {
        text-decoration: underline;
        text-underline-offset: 0.18em;
    }

    .article-content-editor .ck-content ul,
    .article-content-editor .ck-content ol {
        color: #686677;
        font-size: 1.0625rem;
        line-height: 1.75;
        margin: 1.25rem 0;
        padding-left: 1.65rem;
    }

    .article-content-editor .ck-content ul {
        list-style: disc;
    }

    .article-content-editor .ck-content ol {
        list-style: decimal;
    }

    .article-content-editor .ck-content li {
        padding-left: 0.25rem;
    }

    .article-content-editor .ck-content li + li {
        margin-top: 0.45rem;
    }

    .article-content-editor .ck-content blockquote {
        background: #fff4ee;
        border-left: 5px solid #e97a37;
        border-radius: 0.65rem;
        color: #1c1412;
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 1.6;
        margin: 1.75rem 0;
        padding: 1.1rem 1.35rem;
    }

    .article-content-editor .ck-content blockquote p {
        color: inherit;
        font-size: inherit;
        margin: 0.35rem 0;
    }

    .article-content-editor .ck-content .article-lead {
        color: #1c1412;
        font-size: 1.2rem;
        font-weight: 700;
        line-height: 1.65;
    }

    .article-content-editor .ck-content .article-callout {
        background: #fff4ee;
        border-left: 5px solid #e97a37;
        border-radius: 0.65rem;
        color: #1c1412;
        font-weight: 700;
        padding: 1rem 1.25rem;
    }

    .article-content-editor .ck-content figure.image,
    .article-content-editor .ck-content figure.media {
        margin: 1.75rem 0;
    }

    .article-content-editor .ck-content figure.image img,
    .article-content-editor .ck-content img {
        border-radius: 0.85rem;
        display: block;
        height: auto;
        max-width: 100%;
    }

    .article-content-editor .ck-content figcaption {
        color: #686677;
        font-size: 0.875rem;
        margin-top: 0.65rem;
        text-align: center;
    }

    .article-content-editor .ck-content figure.table {
        margin: 1.75rem 0;
        overflow-x: auto;
    }

    .article-content-editor .ck-content table {
        border-collapse: collapse;
        color: #1c1412;
        font-size: 0.95rem;
        min-width: 620px;
        width: 100%;
    }

    .article-content-editor .ck-content th,
    .article-content-editor .ck-content td {
        border: 1px solid #e6e3ea;
        padding: 0.75rem 0.9rem;
        vertical-align: top;
    }

    .article-content-editor .ck-content th {
        background: #fff4ee;
        font-weight: 800;
    }

    .article-content-editor .ck-content .media {
        background: #1c1412;
        border-radius: 0.85rem;
        overflow: hidden;
        padding: 0;
    }

    .dark .article-content-editor .ck.ck-toolbar {
        background-color: #111827;
        border-color: #374151;
    }

    .dark .article-content-editor .ck.ck-toolbar .ck-button,
    .dark .article-content-editor .ck.ck-toolbar .ck-dropdown__button {
        color: #f3f4f6;
    }

    .dark .article-content-editor .ck.ck-toolbar .ck-button:hover,
    .dark .article-content-editor .ck.ck-toolbar .ck-dropdown__button:hover {
        background-color: #374151;
    }

    .dark .article-content-editor .ck.ck-toolbar .ck-button.ck-on,
    .dark .article-content-editor .ck.ck-toolbar .ck-dropdown__button.ck-on {
        background-color: rgba(233, 122, 55, 0.18);
        color: #f5a876;
    }

    .dark .article-content-editor .ck.ck-editor__main > .ck-editor__editable {
        background-color: #1f2937;
        border-color: #374151;
        color: #f3f4f6;
    }

    .dark .article-content-editor .ck-content h1,
    .dark .article-content-editor .ck-content h2,
    .dark .article-content-editor .ck-content h3,
    .dark .article-content-editor .ck-content h4,
    .dark .article-content-editor .ck-content h5,
    .dark .article-content-editor .ck-content h6,
    .dark .article-content-editor .ck-content strong {
        color: #ffffff;
    }

    .dark .article-content-editor .ck-content p,
    .dark .article-content-editor .ck-content ul,
    .dark .article-content-editor .ck-content ol,
    .dark .article-content-editor .ck-content figcaption {
        color: #d1d5db;
    }

    .dark .article-content-editor .ck-content blockquote {
        background: rgba(233, 122, 55, 0.13);
        color: #f9fafb;
    }

    .dark .article-content-editor .ck-content th {
        background: rgba(233, 122, 55, 0.15);
        color: #ffffff;
    }

    .dark .article-content-editor .ck-content td {
        color: #f3f4f6;
    }

    @media (max-width: 640px) {
        .article-content-editor .ck.ck-editor__main > .ck-editor__editable {
            min-height: 520px;
            padding: 1.25rem;
        }

        .article-content-editor .ck-content h1 {
            font-size: 2rem;
        }

        .article-content-editor .ck-content h2 {
            font-size: 1.65rem;
        }

        .article-content-editor .ck-content h3 {
            font-size: 1.35rem;
        }
    }
</style>
<script>
    function createArticleEditor(selector, uploadUrl) {
        const EditorConstructor = window.CKEDITOR?.ClassicEditor || window.ClassicEditor;

        if (!EditorConstructor) {
            console.error('CKEditor failed to load.');
            return Promise.reject(new Error('CKEditor failed to load.'));
        }

        window.articleContentEditorPromise = EditorConstructor
            .create(document.querySelector(selector), {
                placeholder: 'Start writing your article here... Tell your story, share your insights, and engage your readers.',
                ckfinder: {
                    uploadUrl
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Normal', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'H1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'H2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'H3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'H4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'H5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'H6', class: 'ck-heading_heading6' }
                    ]
                },
                toolbar: {
                    items: [
                        'sourceEditing', '|',
                        'link', '|',
                        'undo', 'redo', '|',
                        'heading', '|',
                        'style', '|',
                        'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'underline', '|',
                        'numberedList', 'bulletedList', '|',
                        'alignment:left', 'alignment:center', 'alignment:right', 'alignment:justify', '|',
                        'blockQuote', '|',
                        'removeFormat', '|',
                        'imageUpload', 'insertTable', 'mediaEmbed',
                    ],
                    shouldNotGroupWhenFull: false,
                },
                style: {
                    definitions: [
                        {
                            name: 'Article lead',
                            element: 'p',
                            classes: ['article-lead'],
                        },
                        {
                            name: 'Callout',
                            element: 'p',
                            classes: ['article-callout'],
                        },
                    ],
                },
                link: {
                    defaultProtocol: 'https://',
                    addTargetToExternalLinks: false,
                    decorators: {
                        doFollow: {
                            mode: 'manual',
                            label: 'Dofollow (default)',
                            attributes: {
                                'data-link-follow': 'dofollow',
                            },
                        },
                        openInNewTab: {
                            mode: 'manual',
                            label: 'Open in new tab',
                            attributes: {
                                target: '_blank',
                            },
                        },
                        addNoFollow: {
                            mode: 'manual',
                            label: 'Nofollow',
                            attributes: {
                                rel: 'nofollow',
                            },
                        },
                        addSponsored: {
                            mode: 'manual',
                            label: 'Sponsored',
                            attributes: {
                                rel: 'sponsored',
                            },
                        },
                        addUgc: {
                            mode: 'manual',
                            label: 'UGC',
                            attributes: {
                                rel: 'ugc',
                            },
                        },
                    },
                },
                image: {
                    toolbar: [
                        'imageTextAlternative',
                        'toggleImageCaption',
                        'imageStyle:inline',
                        'imageStyle:block',
                        'imageStyle:side'
                    ]
                },
                table: {
                    contentToolbar: ['tableColumn', 'tableRow', 'mergeTableCells']
                },
                alignment: {
                    options: ['left', 'center', 'right', 'justify'],
                },
                htmlSupport: {
                    allow: [
                        {
                            name: 'a',
                            attributes: {
                                href: true,
                                rel: true,
                                target: true,
                                title: true,
                                style: true,
                                class: true,
                            },
                        },
                    ],
                },
                mediaEmbed: {
                    previewsInData: false
                },
                removePlugins: [
                    'AIAssistant',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    'MathType',
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced',
                    'CaseChange',
                ],
            })
            .then(editor => {
                window.articleContentEditor = editor;
                const sourceElement = document.querySelector(selector);
                const form = sourceElement?.closest('form');

                form?.addEventListener('submit', () => {
                    sourceElement.value = normalizeArticleLinks(editor.getData());
                });

                document.dispatchEvent(new CustomEvent('article-editor-ready', { detail: { editor } }));
                setupEditorPopupClamp(sourceElement.closest('.article-content-editor'));

                return editor;
            })
            .catch(error => {
                console.error(error);
            });

        return window.articleContentEditorPromise;
    }

    function setupEditorPopupClamp(editorContainer) {
        if (!editorContainer) {
            return;
        }

        let clampTimer = null;

        function clampPanels() {
            const containerRect = editorContainer.getBoundingClientRect();
            const safeLeft = containerRect.left + 8;
            const safeRight = containerRect.right - 8;

            document.querySelectorAll('.ck.ck-balloon-panel').forEach(panel => {
                const panelRect = panel.getBoundingClientRect();
                let shift = 0;

                if (panelRect.right > safeRight) {
                    shift = safeRight - panelRect.right;
                }

                if (panelRect.left + shift < safeLeft) {
                    shift += safeLeft - (panelRect.left + shift);
                }

                if (shift !== 0) {
                    const currentMargin = Number.parseFloat(panel.style.marginLeft || '0') || 0;
                    panel.style.marginLeft = `${currentMargin + shift}px`;
                }
            });
        }

        function scheduleClamp() {
            clearTimeout(clampTimer);
            clampTimer = setTimeout(clampPanels, 30);
        }

        const observer = new MutationObserver(scheduleClamp);
        observer.observe(document.body, {
            childList: true,
            subtree: true,
            attributes: true,
            attributeFilter: ['class', 'style'],
        });

        window.addEventListener('resize', scheduleClamp);
        document.addEventListener('scroll', scheduleClamp, true);
        editorContainer.addEventListener('click', scheduleClamp);
        scheduleClamp();
    }

    function normalizeArticleLinks(html) {
        const wrapper = document.createElement('div');
        wrapper.innerHTML = html || '';

        wrapper.querySelectorAll('a[href]').forEach(link => {
            link.removeAttribute('data-link-follow');

            const relTokens = new Set(
                (link.getAttribute('rel') || '')
                    .split(/\s+/)
                    .map(token => token.trim().toLowerCase())
                    .filter(Boolean)
            );

            relTokens.delete('dofollow');

            if (link.getAttribute('target') === '_blank') {
                relTokens.add('noopener');
                relTokens.add('noreferrer');
            } else {
                relTokens.delete('noopener');
                relTokens.delete('noreferrer');
                link.removeAttribute('target');
            }

            if (relTokens.size) {
                link.setAttribute('rel', Array.from(relTokens).sort().join(' '));
            } else {
                link.removeAttribute('rel');
            }
        });

        return wrapper.innerHTML;
    }

    function setupArticleSlugGenerator(options) {
        const titleInput = document.querySelector(options.titleSelector);
        const slugInput = document.querySelector(options.slugSelector);
        const helpText = document.querySelector(options.helpSelector);

        if (!titleInput || !slugInput) {
            return;
        }

        let manualSlug = Boolean(slugInput.value.trim());
        let lastAutoSlug = cleanSlug(slugInput.value || titleInput.value);
        let debounceTimer = null;
        let requestId = 0;

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

        function setHelp(message, state = 'default') {
            if (!helpText) {
                return;
            }

            helpText.textContent = message;
            helpText.classList.toggle('text-brand-accent', state === 'ok');
            helpText.classList.toggle('text-gray-500', state !== 'ok');
            helpText.classList.toggle('dark:text-gray-400', state !== 'ok');
        }

        function resolveSlug(value, source) {
            const cleaned = cleanSlug(value);

            if (!cleaned) {
                slugInput.value = '';
                setHelp('Enter a headline to generate a slug.');
                return;
            }

            slugInput.value = cleaned;
            setHelp('Checking slug availability...');
            clearTimeout(debounceTimer);

            const currentRequestId = ++requestId;
            debounceTimer = setTimeout(async () => {
                const url = new URL(options.resolveUrl, window.location.origin);
                url.searchParams.set('value', cleaned);

                if (options.ignoreId) {
                    url.searchParams.set('ignore_id', options.ignoreId);
                }

                try {
                    const response = await fetch(url, {
                        headers: {
                            Accept: 'application/json',
                        },
                    });

                    if (!response.ok || currentRequestId !== requestId) {
                        return;
                    }

                    const data = await response.json();
                    const resolvedSlug = cleanSlug(data.slug || cleaned);
                    slugInput.value = resolvedSlug;

                    if (source === 'auto') {
                        lastAutoSlug = resolvedSlug;
                    }

                    setHelp(
                        resolvedSlug === cleaned
                            ? 'Slug is clean and available.'
                            : `Slug already existed, using ${resolvedSlug}.`,
                        'ok',
                    );
                } catch (error) {
                    setHelp('Slug will be cleaned again when you save.');
                }
            }, 250);
        }

        titleInput.addEventListener('input', () => {
            if (manualSlug) {
                resolveSlug(slugInput.value, 'manual');
                return;
            }

            resolveSlug(titleInput.value, 'auto');
        });

        slugInput.addEventListener('input', () => {
            const cleaned = cleanSlug(slugInput.value);
            slugInput.value = cleaned;

            if (!cleaned) {
                manualSlug = false;
                resolveSlug(titleInput.value, 'auto');
                return;
            }

            manualSlug = cleaned !== lastAutoSlug || Boolean(slugInput.dataset.initialSlug);
            resolveSlug(cleaned, 'manual');
        });

        slugInput.addEventListener('blur', () => {
            const cleaned = cleanSlug(slugInput.value);

            if (!cleaned) {
                manualSlug = false;
                resolveSlug(titleInput.value, 'auto');
                return;
            }

            slugInput.value = cleaned;
            resolveSlug(cleaned, manualSlug ? 'manual' : 'auto');
        });

        if (!slugInput.value.trim() && titleInput.value.trim()) {
            resolveSlug(titleInput.value, 'auto');
        } else if (slugInput.value.trim()) {
            resolveSlug(slugInput.value, 'manual');
        }
    }

    function getSelectedArticleAuthor(select) {
        const selectedOption = select?.selectedOptions?.[0];

        if (!selectedOption?.dataset?.author) {
            return null;
        }

        try {
            return JSON.parse(selectedOption.dataset.author);
        } catch (error) {
            return null;
        }
    }

    function setupArticleAuthorPreview(selectSelector, previewSelector) {
        const select = document.querySelector(selectSelector);
        const preview = document.querySelector(previewSelector);

        if (!select || !preview) {
            return;
        }

        const avatar = preview.querySelector('[data-author-preview-avatar]');
        const initials = preview.querySelector('[data-author-preview-initials]');
        const name = preview.querySelector('[data-author-preview-name]');
        const role = preview.querySelector('[data-author-preview-role]');
        const bio = preview.querySelector('[data-author-preview-bio]');
        const signature = preview.querySelector('[data-author-preview-signature]');

        function initialsFor(value) {
            return (value || 'A')
                .split(/\s+/)
                .filter(Boolean)
                .slice(0, 2)
                .map(part => part.charAt(0).toUpperCase())
                .join('') || 'A';
        }

        function render() {
            const author = getSelectedArticleAuthor(select);

            if (!author) {
                preview.classList.add('hidden');
                return;
            }

            preview.classList.remove('hidden');
            name.textContent = author.name || 'Author';
            role.textContent = author.designation || '';
            role.classList.toggle('hidden', !author.designation);
            bio.textContent = author.bio || 'No bio added for this author yet.';
            initials.textContent = initialsFor(author.name);

            if (author.avatar) {
                avatar.src = author.avatar;
                avatar.alt = author.name || 'Author avatar';
                avatar.classList.remove('hidden');
                initials.classList.add('hidden');
            } else {
                avatar.removeAttribute('src');
                avatar.classList.add('hidden');
                initials.classList.remove('hidden');
            }

            if (author.signature) {
                signature.src = author.signature;
                signature.alt = `${author.name || 'Author'} signature`;
                signature.classList.remove('hidden');
            } else {
                signature.removeAttribute('src');
                signature.classList.add('hidden');
            }
        }

        select.addEventListener('change', render);
        render();
    }
</script>
