@extends('admin.layouts.master')

@section('main-content')
    @include('admin.shared.content-index', [
        'title' => 'Client Work Management',
        'subtitle' => 'Manage client work and experience categories on the portfolio.',
        'routePrefix' => 'client-work',
        'items' => $items,
        'activeCount' => $activeCount,
        'inactiveCount' => $inactiveCount,
        'columns' => ['category' => 'Category'],
        'emptyIcon' => 'bi-briefcase',
    ])
@endsection
