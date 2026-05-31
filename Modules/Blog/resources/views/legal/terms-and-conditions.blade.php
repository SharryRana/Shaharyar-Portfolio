@extends('blog::layouts.app')

@section('title', setting('seo_terms_title', 'Terms & Conditions | PubWhizz'))
@section('meta_description', setting('seo_terms_desc', 'Terms and Conditions for PubWhizz.'))

@section('content')
    <x-blog::legal.terms-and-conditions :page="$page ?? null" />
@endsection
