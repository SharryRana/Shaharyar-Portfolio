@extends('blog::layouts.app')

@section('title', setting('seo_blog_title', 'Blog | PubWhizz'))
@section('meta_description', setting('seo_blog_desc', 'SEO tips, link building techniques, tricks, strategies, and case studies from PubWhizz.'))

@section('content')
    <x-blog::blog.listing :articles="$articles ?? collect()" :trending-article="$trendingArticle ?? null" />
@endsection
