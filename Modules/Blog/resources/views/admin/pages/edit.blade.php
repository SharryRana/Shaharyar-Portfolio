@extends('blog::admin.layout')

@section('title', 'Edit ' . $page->title . ' - Creavibe Admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <a href="{{ route('blog-admin.pages.index') }}" class="text-gray-400 hover:text-brand-accent transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            Edit {{ $page->title }}
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update page content with rich text editor</p>
    </div>
</div>

<div class="max-w-5xl mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('blog-admin.pages.update', $page->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Page Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" id="title" value="{{ old('title', $page->title) }}" required
                       class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-brand-accent focus:border-brand-accent transition outline-none"
                       placeholder="e.g. About Us">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Page Content <span class="text-red-500">*</span></label>
                <textarea name="content" id="content" rows="12"
                          class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-brand-accent focus:border-brand-accent transition outline-none"
                          placeholder="Write the page content...">{{ old('content', $page->content) }}</textarea>
                <p class="mt-1 text-xs text-gray-500">Use the editor to format text with headings (H1-H6), lists, bold, italic, and alignment options.</p>
                <p id="content-error" class="mt-1 text-sm text-red-600 hidden">Content is required</p>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $page->is_active) ? 'checked' : '' }}
                       class="h-4 w-4 text-brand-accent focus:ring-brand-accent border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    Active (Display on website)
                </label>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('blog-admin.pages.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>
                <button type="submit" class="bg-brand-accent border border-transparent rounded-lg shadow-sm py-2 px-8 inline-flex justify-center text-sm font-medium text-white hover:bg-[#d66c2e] focus:outline-none transition">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Update Page
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<style>
    .ck-editor__editable {
        min-height: 400px;
        background-color: transparent !important;
        color: inherit !important;
    }
    .ck.ck-editor__main>.ck-editor__editable {
        background: transparent;
    }
    .dark .ck.ck-editor__main>.ck-editor__editable {
        background-color: #1f2937 !important;
        color: #f3f4f6 !important;
    }
    .dark .ck.ck-toolbar {
        background-color: #111827 !important;
        border-color: #374151 !important;
    }
    .dark .ck.ck-toolbar__button:hover {
        background-color: #374151 !important;
    }
</style>
<script>
    let editorInstance;

    ClassicEditor
        .create(document.querySelector('#content'), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'underline', 'link', '|',
                'bulletedList', 'numberedList', 'blockQuote', '|',
                'alignment', '|', 'undo', 'redo'
            ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            alignment: {
                options: [ 'left', 'center', 'right', 'justify' ]
            }
        })
        .then(editor => {
            editorInstance = editor;
        })
        .catch(error => {
            console.error(error);
        });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const errorElement = document.getElementById('content-error');

        if (editorInstance && editorInstance.getData().trim() === '') {
            e.preventDefault();
            errorElement.classList.remove('hidden');
            document.querySelector('.ck-editor').scrollIntoView({ behavior: 'smooth', block: 'center' });
            return false;
        }

        errorElement.classList.add('hidden');
    });
</script>
@endsection
