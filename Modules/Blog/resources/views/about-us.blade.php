@extends('blog::layouts.app')

@section('title', setting('seo_about_title', 'About Us | PubWhizz'))
@section('meta_description', setting('seo_about_desc', 'Learn about PubWhizz, our mission, values, and founder.'))
@section('font_href', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Sedgwick+Ave+Display&display=swap')

@section('content')
    <x-blog::about.page />
@endsection
