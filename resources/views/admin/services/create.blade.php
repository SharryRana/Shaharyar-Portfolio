@extends('admin.layouts.master')

@section('title', 'Add Service | Admin')

@section('main-content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Add New Service</h2>
    <a href="{{ route('admin.services.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Services
    </a>
</div>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.services._form', ['service' => $service, 'isEdit' => false])
        </form>
    </div>
</div>
@endsection
