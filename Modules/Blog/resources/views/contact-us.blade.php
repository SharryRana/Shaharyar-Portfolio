@extends('blog::layouts.app')

@section('title', setting('seo_contact_title', 'Contact Us | PubWhizz'))
@section('meta_description', setting('seo_contact_desc', 'Get in touch with PubWhizz using our inquiry form or contact details.'))

@section('content')
    <x-blog::contact.page />
@endsection
