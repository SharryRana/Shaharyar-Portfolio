@extends('admin.layouts.master')

@section('main-content')
    @include('admin.shared.content-index', [
        'title' => 'Featured Projects Management',
        'subtitle' => 'Manage portfolio project cards, categories, tags, and links.',
        'routePrefix' => 'featured-projects',
        'items' => $items,
        'activeCount' => $activeCount,
        'inactiveCount' => $inactiveCount,
        'columns' => ['category' => 'Category'],
        'emptyIcon' => 'bi-window-stack',
    ])
@endsection
