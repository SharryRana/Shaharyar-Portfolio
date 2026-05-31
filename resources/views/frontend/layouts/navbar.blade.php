    <header id="header">
        <div class="container nav-container">
            <a href="{{ route('home') }}#home" class="logo">Creavibe<span>.</span></a>

            <nav class="nav-primary" aria-label="Primary">
                <ul class="nav-menu" id="nav-menu">
                    <li><a href="{{ route('home') }}#home">Home</a></li>
                    <li><a href="{{ route('home') }}#skills">Skills</a></li>
                    <li><a href="{{ route('home') }}#projects">Projects</a></li>
                    <li><a href="{{ route('home') }}#clients">Clients</a></li>
                    <li><a href="{{ route('home') }}#team">Team</a></li>
                    <li><a href="{{ route('home') }}#blog">Blog</a></li>
                    <li><a href="{{ route('home') }}#contact">Contact</a></li>
                </ul>
            </nav>

            <div class="nav-actions">
                <button class="theme-toggle" id="theme-toggle" aria-label="Toggle dark mode" title="Toggle theme">
                    <i class="fas fa-moon" aria-hidden="true"></i>
                </button>

                <button class="hamburger" id="hamburger" aria-label="Open navigation menu" aria-expanded="false"
                    aria-controls="nav-menu">
                    <i class="fas fa-bars" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </header>
