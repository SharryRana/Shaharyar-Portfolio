@extends('blog::admin.layout')

@section('title', 'Edit FAQ - Creavibe')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
            <a href="{{ route('blog-admin.faqs.index') }}" class="text-gray-400 hover:text-brand-accent transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            Edit FAQ
        </h1>
    </div>
</div>

<div class="max-w-2xl mx-auto">
    <div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
        <form action="{{ route('blog-admin.faqs.update', $faq->id) }}" method="POST" class="p-6 space-y-6" x-data="{ category: @js(old('category', $faq->category)), stats: @js($categoryStats) }">
            @csrf
            @method('PUT')

            <div>
                <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select name="category" id="category" required x-model="category"
                        class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-brand-accent focus:border-brand-accent transition outline-none">
                    @foreach($categories as $value => $label)
                        <option value="{{ $value }}" @selected(old('category', $faq->category) === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('category')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="question" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Question</label>
                <input type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" required
                       class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-brand-accent focus:border-brand-accent transition outline-none"
                       placeholder="e.g. How do I start with Creavibe?">
                @error('question')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="answer" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Answer</label>
                <textarea name="answer" id="answer" rows="5" required
                          class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-brand-accent focus:border-brand-accent transition outline-none"
                          placeholder="Provide a detailed answer...">{{ old('answer', $faq->answer) }}</textarea>
                @error('answer')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Display Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', $faq->order) }}"
                       class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-brand-accent focus:border-brand-accent transition outline-none"
                       placeholder="0">
                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                    <span x-text="stats[category]?.count ?? 0"></span> other FAQs exist in this category.
                    Suggested next order: <span class="font-semibold text-brand-accent" x-text="stats[category]?.next_order ?? 1"></span>.
                    Lower numbers appear first.
                </p>
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}
                       class="h-4 w-4 text-brand-accent focus:ring-brand-accent border-gray-300 rounded">
                <label for="is_active" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                    Active (Display on FAQ page)
                </label>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100 dark:border-gray-700">
                <a href="{{ route('blog-admin.faqs.index') }}" class="px-6 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                    Cancel
                </a>
                <button type="submit" class="bg-brand-accent border border-transparent rounded-lg shadow-sm py-2 px-8 inline-flex justify-center text-sm font-medium text-white hover:bg-[#d66c2e] focus:outline-none transition">
                    Update FAQ
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
