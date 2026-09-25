@extends('admin.layouts.master')

@section('title', 'Edit Service | Admin')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Edit Service: {{ $service->name }}</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.services._form', ['service' => $service, 'isEdit' => true])
        </form>
    </div>
</div>
@endsection
