    <header>
        <div class="container nav-container">
            <a href="{{ route('blog.index') }}" class="logo">
                <i class="fas fa-blog"></i>
                Creavibe<span>Blog</span>
            </a>

            <button class="hamburger" id="hamburger">
                <i class="fas fa-bars"></i>
            </button>

            <ul class="nav-menu" id="navMenu">
                <li class="nav-item"><a href="{{ route('blog.index') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="{{ route('blog.category') }}" class="nav-link">Categories</a></li>
                <li class="nav-item"><a href="{{ route('blog.feature') }}" class="nav-link">Features</a></li>
                <li class="nav-item"><a href="{{ route('blog.about') }}" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{ route('blog.contactus') }}" class="nav-link">Contact</a></li>
            </ul>

            <div class="nav-actions">
                <button class="theme-toggle" id="themeToggle">
                    <i class="fas fa-moon"></i>
                </button>
            </div>
        </div>
    </header>
