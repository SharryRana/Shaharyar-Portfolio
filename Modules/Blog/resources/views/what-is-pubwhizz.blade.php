@extends('blog::layouts.app')

@section('title', setting('seo_what_is_pubwhizz_title', 'What Is PubWhizz? | PubWhizz'))
@section('meta_description', setting('seo_what_is_pubwhizz_desc', 'Learn what PubWhizz is, how content publication works, and view PubWhizz company registration details.'))
@section('font_href', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap')

@section('content')
    <x-blog::what-is-pubwhizz.page />
@endsection
