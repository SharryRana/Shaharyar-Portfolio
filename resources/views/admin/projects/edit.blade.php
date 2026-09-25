@extends('admin.layouts.master')

@section('title', 'Edit Project | Admin')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Project: {{ $project->title }}</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Projects
    </a>
</div>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.projects._form', ['project' => $project, 'isEdit' => true])
        </form>
    </div>
</div>
@endsection
