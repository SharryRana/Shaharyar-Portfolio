<nav id="sidebar">
    <div class="sidebar-header">
        <a href="{{ route('dashboard') }}">
            <img class="logo-img"
                src="{{ auth()->user()->avatar
                    ? asset(auth()->user()->avatar)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random' }}"
                alt="Admin Logo">
        </a>
        <h3>Admin Panel</h3>
    </div>

    <div class="sidebar-menu">
        <ul>
            {{-- Dashboard --}}
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('dashboard') }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            {{-- Messages --}}
            <li class="{{ request()->is('admin/contact-messages') ? 'active' : '' }}">
                <a href="{{ route('contactus.index') }}">
                    <i class="bi bi-envelope"></i>
                    <span>Messages</span>
                </a>
            </li>

            {{-- Visitors --}}
            <li class="{{ request()->is('admin/visitors') ? 'active' : '' }}">
                <a href="{{ route('visitors.index') }}">
                    <i class="bi bi-graph-up"></i>
                    <span>Visitors</span>
                </a>
            </li>

            {{-- Blog Categories --}}
            <li class="{{ request()->is('admin/blog/create-category') ? 'active' : '' }}">
                <a href="{{ route('admin.category.index') }}">
                    <i class="bi bi-folder"></i>
                    <span>Categories</span>
                </a>
            </li>

            {{-- Blog Posts --}}
            <li class="{{ request()->is('admin/blog-posts*') ? 'active' : '' }}">
                <a href="{{ route('visitors.index') }}">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Posts</span>
                </a>
            </li>

            {{-- Profile Settings --}}
            <li class="{{ request()->is('admin/admin-profile') ? 'active' : '' }}">
                <a href="{{ route('admin.profile') }}">
                    <i class="bi bi-gear"></i>
                    <span>Profile Settings</span>
                </a>
            </li>

            {{-- Logout --}}
            <li>
                <a href="{{ route('admin.logout') }}">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
