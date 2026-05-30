@extends('admin.layouts.master')

@section('main-content')
    @include('admin.shared.content-index', [
        'title' => 'Skills Management',
        'subtitle' => 'Manage the skill cards and experience categories on your portfolio.',
        'routePrefix' => 'skills',
        'items' => $items,
        'activeCount' => $activeCount,
        'inactiveCount' => $inactiveCount,
        'columns' => ['label' => 'Label'],
        'emptyIcon' => 'bi-lightning-charge',
    ])
@endsection
