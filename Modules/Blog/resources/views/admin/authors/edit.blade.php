@extends('blog::admin.layout')

@section('title', 'Edit Author - Creavibe Admin')

@section('content')
<div class="mb-6 flex items-center justify-between">
    <h1 class="flex items-center gap-2 text-2xl font-bold text-gray-900 dark:text-white">
        <a href="{{ route('blog-admin.authors.index') }}" class="text-gray-400 transition hover:text-brand-accent">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        Edit Author
    </h1>
</div>

<form action="{{ route('blog-admin.authors.update', $author) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('blog::admin.authors.partials.form')
</form>
@endsection
