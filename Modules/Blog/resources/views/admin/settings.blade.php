@extends('blog::admin.layout')

@section('title', 'Platform Settings')

@section('content')
@php
    $inputClass = 'block w-full rounded-lg border border-gray-300 bg-white px-3.5 py-2.5 text-sm text-gray-900 shadow-sm transition placeholder:text-gray-400 focus:border-brand-accent focus:outline-none focus:ring-4 focus:ring-brand-accent/10 dark:border-gray-600 dark:bg-gray-800 dark:text-white dark:placeholder:text-gray-500';
    $textareaClass = $inputClass . ' resize-y leading-6';
    $labelClass = 'block text-sm font-semibold text-gray-800 dark:text-gray-200';
    $smallLabelClass = 'block text-xs font-bold uppercase tracking-wide text-gray-500 dark:text-gray-400';
    $helpClass = 'mt-1.5 text-xs leading-5 text-gray-500 dark:text-gray-400';
    $sectionIntroClass = 'rounded-xl border border-gray-200 bg-gray-50/70 p-5 dark:border-gray-700 dark:bg-gray-800/50';
@endphp

<div class="px-4 sm:px-6 lg:px-8 py-8">

    <div class="md:flex md:items-center md:justify-between mb-8">
        <div class="flex-1 min-w-0">
            <h2 class="text-2xl font-bold leading-7 text-gray-900 dark:text-white sm:text-3xl sm:truncate">Platform Settings</h2>
            <p class="mt-2 max-w-2xl text-sm text-gray-500 dark:text-gray-400">Manage global platform details, homepage content, and SEO metadata from one place.</p>
        </div>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="mb-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-400 px-6 py-4 rounded-xl flex items-center gap-3" role="alert">
            <svg class="h-5 w-5 flex-shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="mb-6 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 text-red-800 dark:text-red-400 px-6 py-4 rounded-xl" role="alert">
            <div class="flex items-start gap-3">
                <svg class="h-5 w-5 flex-shrink-0 mt-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <p class="font-medium mb-2">There were some errors with your submission:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('blog-admin.settings.update') }}" method="POST" class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-gray-700 dark:bg-gray-800">
        @csrf

        <div class="divide-y divide-gray-200 dark:divide-gray-700">
            <!-- General Settings -->
            <div class="p-6 lg:p-8">
                <div class="{{ $sectionIntroClass }}">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">General Information</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Global settings for your website.</p>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <label for="site_name" class="{{ $labelClass }}">Site Name</label>
                        <div class="mt-2">
                            <input type="text" name="site_name" id="site_name" value="{{ $settings['site_name'] ?? 'Creavibe' }}" class="{{ $inputClass }}">
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label for="contact_email" class="{{ $labelClass }}">Contact Email</label>
                        <div class="mt-2">
                            <input type="email" name="contact_email" id="contact_email" value="{{ $settings['contact_email'] ?? 'support@creavibe.com' }}" class="{{ $inputClass }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hero Section Settings -->
            <div class="p-6 lg:p-8">
                <div class="{{ $sectionIntroClass }}">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Hero Section</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Customize the main hero section on your homepage.</p>
                </div>
                <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <label for="home_page_title" class="{{ $labelClass }}">Home Page Title (Browser Tab)</label>
                        <div class="mt-2">
                            <input type="text" name="home_page_title" id="home_page_title" value="{{ $settings['home_page_title'] ?? 'Creavibe | Digital PR for Publishers' }}" class="{{ $inputClass }}" placeholder="Creavibe | Digital PR for Publishers">
                        </div>
                        <p class="{{ $helpClass }}">Title shown in browser tab and search results.</p>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="hero_title" class="{{ $labelClass }}">Hero Title</label>
                        <div class="mt-2">
                            <input type="text" name="hero_title" id="hero_title" value="{{ $settings['hero_title'] ?? 'Digital PR That Helps Publishers Grow' }}" class="{{ $inputClass }}" placeholder="Digital PR That Helps Publishers Grow">
                        </div>
                        <p class="{{ $helpClass }}">Main headline displayed in the hero section.</p>
                    </div>

                    <div class="sm:col-span-6">
                        <label for="hero_subtitle" class="{{ $labelClass }}">Hero Subtitle</label>
                        <div class="mt-2">
                            <textarea name="hero_subtitle" id="hero_subtitle" rows="3" class="{{ $textareaClass }}" placeholder="Hand-picked discounts, promo codes, and offers from your favorite stores. Never pay full price again.">{{ $settings['hero_subtitle'] ?? 'Hand-picked discounts, promo codes, and offers from your favorite stores. Never pay full price again.' }}</textarea>
                        </div>
                        <p class="{{ $helpClass }}">Descriptive text below the hero title.</p>
                    </div>
                </div>
            </div>

            <!-- Global SEO Settings -->
            <div class="p-6 lg:p-8">
                <div class="{{ $sectionIntroClass }}">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">Global SEO & Static Pages</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Manage SEO metadata for pages that are not articles.</p>
                </div>

                <!-- Home Page SEO -->
                <div class="mt-6 rounded-xl border border-gray-200 bg-white p-5 dark:border-gray-700 dark:bg-gray-900/30">
                    <h4 class="mb-5 flex items-center gap-2 text-sm font-bold uppercase tracking-wide text-gray-900 dark:text-white">
                        <span class="h-2.5 w-2.5 rounded-full bg-brand-accent"></span>
                        Home Page
                    </h4>
                    <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-4">
                            <label class="{{ $labelClass }}">Meta Title</label>
                            <input type="text" name="seo_home_title" value="{{ $settings['seo_home_title'] ?? '' }}" class="mt-2 {{ $inputClass }}" placeholder="Creavibe Publisher Growth Platform">
                        </div>
                        <div class="sm:col-span-6">
                            <label class="{{ $labelClass }}">Meta Description</label>
                            <textarea name="seo_home_desc" rows="3" class="mt-2 {{ $textareaClass }}" placeholder="Grow publisher revenue with Creavibe digital PR campaigns.">{{ $settings['seo_home_desc'] ?? '' }}</textarea>
                        </div>
                        <div class="sm:col-span-6">
                            <label class="{{ $labelClass }}">Meta Keywords (Global Default)</label>
                            <input type="text" name="seo_home_keywords" value="{{ $settings['seo_home_keywords'] ?? '' }}" class="mt-2 {{ $inputClass }}" placeholder="digital pr, publishers, creavibe">
                        </div>
                    </div>
                </div>

                @php
                    $staticSeoPages = [
                        ['label' => 'About Us Page', 'key' => 'about'],
                        ['label' => 'Contact Us Page', 'key' => 'contact'],
                        ['label' => 'Privacy Policy', 'key' => 'privacy'],
                        ['label' => 'Terms of Service', 'key' => 'terms'],
                        ['label' => 'FAQs Page', 'key' => 'faqs'],
                        ['label' => 'What Is Creavibe Page', 'key' => 'what_is_creavibe'],
                        ['label' => 'Blog Page', 'key' => 'blog'],
                    ];
                @endphp

                <!-- Static Pages Grid -->
                <div class="mt-6 grid grid-cols-1 gap-5 xl:grid-cols-2">
                    @foreach($staticSeoPages as $page)
                        <div class="rounded-xl border border-gray-200 bg-white p-5 shadow-sm transition hover:border-brand-accent/40 dark:border-gray-700 dark:bg-gray-900/30">
                            <h4 class="mb-5 text-sm font-bold uppercase tracking-wide text-gray-900 dark:text-white">{{ $page['label'] }}</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="{{ $smallLabelClass }}">Meta Title</label>
                                    <input type="text" name="seo_{{ $page['key'] }}_title" value="{{ $settings['seo_' . $page['key'] . '_title'] ?? '' }}" class="mt-2 {{ $inputClass }}">
                                </div>
                                <div>
                                    <label class="{{ $smallLabelClass }}">Meta Description</label>
                                    <textarea name="seo_{{ $page['key'] }}_desc" rows="3" class="mt-2 {{ $textareaClass }}">{{ $settings['seo_' . $page['key'] . '_desc'] ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="border-t border-gray-200 bg-gray-50 px-6 py-4 dark:border-gray-700 dark:bg-gray-900/50">
            <div class="flex justify-end gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-lg border border-transparent bg-brand-accent px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-[#d66c2e] focus:outline-none focus:ring-4 focus:ring-brand-accent/20">Save All Settings</button>
            </div>
        </div>
    </form>
</div>
@endsection
