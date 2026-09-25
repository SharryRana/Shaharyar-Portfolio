@extends('admin.layouts.master')

@section('title', 'Add Testimonial | Admin')

@section('main-content')
<section class="content-admin-hero mb-4">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="mb-1">Add New Testimonial</h2>
            <p class="mb-0 opacity-75">Add a new client review or recommendation.</p>
        </div>
        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-light">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>
</section>

<div class="card content-admin-card">
    <div class="card-body p-4">
        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @include('admin.testimonials._form')
        </form>
    </div>
</div>
@endsection
