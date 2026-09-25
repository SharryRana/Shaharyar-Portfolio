<header id="header">
    <div class="container nav-container">
        <a href="{{ route('home') }}" class="logo" aria-label="Creavibe home">Creavibe<span>.</span></a>

        <nav class="nav-primary" aria-label="Primary navigation">
            <ul class="nav-menu" id="nav-menu" role="menubar">
                <li role="none"><a href="{{ route('home') }}" role="menuitem" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
                <li role="none"><a href="{{ route('about') }}" role="menuitem" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
                <li role="none"><a href="{{ route('saas.index') }}" role="menuitem" class="{{ request()->routeIs('saas.*') ? 'active' : '' }}">SaaS</a></li>
                <li role="none"><a href="{{ route('projects.index') }}" role="menuitem" class="{{ request()->routeIs('projects.*') ? 'active' : '' }}">Projects</a></li>
                <li role="none" class="nav-dropdown">
                    <a href="{{ route('services.index') }}" role="menuitem" class="{{ request()->routeIs('services.*') ? 'active' : '' }}" aria-haspopup="true" aria-expanded="false">Services <i class="fas fa-chevron-down" aria-hidden="true" style="font-size:.7em"></i></a>
                    <ul class="nav-dropdown-menu" role="menu">
                        <li><a href="{{ route('services.show', 'backend-development') }}" role="menuitem">Backend Development</a></li>
                        <li><a href="{{ route('services.show', 'full-stack-development') }}" role="menuitem">Full-Stack Development</a></li>
                        <li><a href="{{ route('services.show', 'saas-development') }}" role="menuitem">SaaS Development</a></li>
                        <li><a href="{{ route('services.show', 'api-development') }}" role="menuitem">API Development</a></li>
                        <li><a href="{{ route('services.show', 'fintech-development') }}" role="menuitem">FinTech Development</a></li>
                    </ul>
                </li>
                <li role="none"><a href="{{ route('blog.index') }}" role="menuitem" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a></li>
                <li role="none"><a href="{{ route('contact') }}" role="menuitem" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a></li>
            </ul>
        </nav>

        <div class="nav-actions">
            <button class="theme-toggle" id="theme-toggle" aria-label="Toggle dark mode" title="Toggle theme">
                <i class="fas fa-moon" aria-hidden="true"></i>
            </button>
            <button class="hamburger" id="hamburger" aria-label="Open navigation menu" aria-expanded="false" aria-controls="nav-menu">
                <i class="fas fa-bars" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</header>
