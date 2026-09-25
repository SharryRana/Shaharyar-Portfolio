@extends('frontend.layouts.master')
@section('title', '500  Server Error | Creavibe')
@section('robots', 'noindex, nofollow')
@section('main-content')
<main id="main-content" style="min-height:70vh;display:flex;align-items:center;">
    <div class="container text-center" style="padding:80px 0;">
        <div class="skill-icon" style="font-size:5rem;margin-bottom:24px;">
            <i class="fas fa-triangle-exclamation" aria-hidden="true"></i>
        </div>
        <h1 style="font-size:clamp(3rem,8vw,6rem);margin-bottom:8px;">500</h1>
        <h2 style="margin-top:0;">Server Error</h2>
        <p style="max-width:480px;margin:0 auto 32px;">
            Something went wrong on our end. Please try again in a moment.
        </p>
        <a href="{{ route('home') }}" class="btn">Go Home</a>
    </div>
</main>
@endsection
