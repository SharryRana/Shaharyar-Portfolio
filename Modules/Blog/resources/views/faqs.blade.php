@extends('blog::layouts.app')

@section('title', setting('seo_faqs_title', 'FAQs | PubWhizz'))
@section('meta_description', setting('seo_faqs_desc', 'Frequently asked questions about PubWhizz.'))

@section('content')
    <x-blog::faqs.page :initial-tab="$initialTab ?? 'general'" :faq-groups="$faqGroups ?? []" />
@endsection
