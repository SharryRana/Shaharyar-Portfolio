@extends('blog::layouts.app')

@section('title', setting('seo_privacy_title', 'Privacy Policy | PubWhizz'))
@section('meta_description', setting('seo_privacy_desc', 'Privacy Policy for PubWhizz.'))

@section('content')
    <x-blog::legal.privacy-policy :page="$page ?? null" />
@endsection
