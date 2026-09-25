@extends('admin.layouts.master')

@section('title', 'Add Project | Admin')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Project / Case Study</h2>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Projects
    </a>
</div>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.projects._form', ['project' => $project, 'isEdit' => false])
        </form>
    </div>
</div>
@endsection
