@if(!empty($crumbs))
<nav aria-label="Breadcrumb" class="breadcrumb-nav">
    <div class="container">
        <ol class="breadcrumb" itemscope itemtype="https://schema.org/BreadcrumbList">
            @foreach($crumbs as $i => $crumb)
                <li class="breadcrumb-item" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                    @if(isset($crumb['url']) && $i < count($crumbs) - 1)
                        <a href="{{ $crumb['url'] }}" itemprop="item"><span itemprop="name">{{ $crumb['label'] }}</span></a>
                    @else
                        <span itemprop="name" aria-current="page">{{ $crumb['label'] }}</span>
                    @endif
                    <meta itemprop="position" content="{{ $i + 1 }}">
                </li>
            @endforeach
        </ol>
    </div>
</nav>
@endif
