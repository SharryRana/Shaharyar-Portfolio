@extends('admin.layouts.master')

@section('title', 'Add Experience | Admin')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Experience</h2>
    <a href="{{ route('admin.experiences.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Experience List
    </a>
</div>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.experiences.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.experiences._form', ['experience' => $experience, 'isEdit' => false])
        </form>
    </div>
</div>
@endsection
