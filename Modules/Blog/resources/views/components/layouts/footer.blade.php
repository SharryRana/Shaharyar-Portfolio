@php
    $footerCategories = \Modules\Blog\Models\BlogCategory::query()
        ->where('is_active', true)
        ->withCount(['articles' => fn ($query) => $query->where('status', 'Published')->whereNotNull('published_at')->where('show_on_blog', true)])
        ->orderByDesc('articles_count')
        ->orderBy('name')
        ->take(5)
        ->get();
@endphp

<footer>
    <div class="container footer-content">
        <div class="footer-widget">
            <a href="{{ route('blog.index') }}" class="footer-logo">
                <i class="fas fa-blog"></i>
                Creavibe Blog
            </a>
            <p class="footer-text">
                A modern blog platform sharing insights about web development, design, and technology. Join our
                community of creators.
            </p>
        </div>

        <div class="footer-widget">
            <h3 class="footer-title">Quick Links</h3>
            <ul class="footer-links">
                <li class="footer-link"><a href="{{ route('blog.index') }}">Home</a></li>
                <li class="footer-link"><a href="{{ route('blog.about') }}">About</a></li>
                <li class="footer-link"><a href="{{ route('blog.category') }}">Categories</a></li>
                <li class="footer-link"><a href="{{ route('blog.feature') }}">Features</a></li>
                <li class="footer-link"><a href="{{ route('blog.contactus') }}">Contact</a></li>
            </ul>
        </div>

        <div class="footer-widget">
            <h3 class="footer-title">Categories</h3>
            <ul class="footer-links">
                @forelse ($footerCategories as $category)
                    <li class="footer-link"><a href="{{ route('blog.category.show', $category->slug) }}">{{ $category->name }}</a></li>
                @empty
                    <li class="footer-link"><a href="{{ route('blog.category') }}">All Categories</a></li>
                @endforelse
            </ul>
        </div>

        <div class="footer-widget">
            <h3 class="footer-title">Connect With Us</h3>
            <div class="social-links">
                <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <a href="#" aria-label="GitHub"><i class="fab fa-github"></i></a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright">
            <p>&copy; {{ date('Y') }} Creavibe Blog. All rights reserved.</p>
        </div>
    </div>
</footer>
