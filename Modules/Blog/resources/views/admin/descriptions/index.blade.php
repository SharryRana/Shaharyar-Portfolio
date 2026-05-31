@extends('blog::admin.layout')

@section('title', 'Manage Descriptions')

@section('content')
<div class="mb-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Descriptions</h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Manage descriptions displayed on the home page.</p>
    </div>
    <div>
        <a href="{{ route('blog-admin.descriptions.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-brand-accent hover:bg-[#d66c2e] focus:outline-none transition">
            <svg class="-ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Add Description
        </a>
    </div>
</div>

@if(session('success'))
<div class="mb-4 p-4 bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300 rounded-lg border border-green-200 dark:border-green-800">
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-gray-800 shadow-sm rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">All Descriptions</h3>
    </div>

    <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
        @forelse($descriptions as $description)
        <li class="px-6 py-4 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                            Order: {{ $description->order }}
                        </span>
                        @if($description->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/40 text-green-800 dark:text-green-300">
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900/40 text-red-800 dark:text-red-300">
                                Inactive
                            </span>
                        @endif
                    </div>
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white mb-1">{{ $description->title }}</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">{{ $description->content }}</p>
                </div>
                <div class="flex items-center gap-3 ml-4">
                    <a href="{{ route('blog-admin.descriptions.edit', $description->id) }}" class="text-gray-400 hover:text-brand-accent transition" title="Edit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                        </svg>
                    </a>
                    <form action="{{ route('blog-admin.descriptions.destroy', $description->id) }}" method="POST" data-confirm="This description will be permanently deleted from the home page content." data-confirm-title="Delete description?" data-confirm-button="Delete Description">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Delete">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </li>
        @empty
        <li class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
            No descriptions found. Click "Add Description" to create one.
        </li>
        @endforelse
    </ul>
</div>
@endsection
