@extends('blog::admin.layout')

@section('title', 'Edit Blog Category - Creavibe Admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-900 dark:text-white">
        <a href="{{ route('blog-admin.blog-categories.index') }}" class="text-gray-400 transition hover:text-brand-accent">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        Edit Blog Category
    </h1>
</div>

<form action="{{ route('blog-admin.blog-categories.update', $category) }}" method="POST">
    @csrf
    @method('PUT')
    @include('blog::admin.blog-categories.partials.form')
</form>
@endsection
