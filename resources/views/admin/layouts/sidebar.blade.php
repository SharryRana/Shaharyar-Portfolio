        <nav id="sidebar">
            <div class="sidebar-header">
                <a href="{{ route('admin.dashboard') }}">
                    <img class="logo-img"
                        src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random' }}"
                        alt="Admin Logo">
                </a>
                <h3>Admin Panel</h3>
            </div>

            <div class="sidebar-menu">
                <ul>
                    <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <a href="{{ route('admin.dashboard') }}">
                            <i class="bi bi-speedometer2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/contact-messages') ? 'active' : '' }}">
                        <a href="{{ route('admin.contactus.index') }}">
                            <i class="bi bi-envelope"></i>
                            <span>Messages</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/visitors') ? 'active' : '' }}">
                        <a href="{{ route('admin.visitors.index') }}">
                            <i class="bi bi-graph-up"></i>
                            <span>Visitor</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/skills*') ? 'active' : '' }}">
                        <a href="{{ route('admin.skills.index') }}">
                            <i class="bi bi-lightning-charge"></i>
                            <span>Skills</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/featured-projects*') ? 'active' : '' }}">
                        <a href="{{ route('admin.featured-projects.index') }}">
                            <i class="bi bi-window-stack"></i>
                            <span>Homepage Projects</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/saas-products*') ? 'active' : '' }}">
                        <a href="{{ route('admin.saas-products.index') }}">
                            <i class="bi bi-box-seam"></i>
                            <span>SaaS Products</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/client-work*') ? 'active' : '' }}">
                        <a href="{{ route('admin.client-work.index') }}">
                            <i class="bi bi-briefcase"></i>
                            <span>Client Work</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/team-members*') ? 'active' : '' }}">
                        <a href="{{ route('admin.team-members.index') }}">
                            <i class="bi bi-people"></i>
                            <span>Team Members</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.projects.index') }}">
                            <i class="bi bi-folder-symlink"></i>
                            <span>Projects</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.services.index') }}">
                            <i class="bi bi-cpu"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.experiences.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.experiences.index') }}">
                            <i class="bi bi-award"></i>
                            <span>Experience</span>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.testimonials.index') }}">
                            <i class="bi bi-chat-quote"></i>
                            <span>Testimonials</span>
                        </a>
                    </li>

                    <li class="{{ request()->is('admin/admin-profile') ? 'active' : '' }}">
                        <a href="{{ route('admin.profile') }}">
                            <i class="bi bi-gear"></i>
                            <span>Profile Settings</span>
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/logout') ? 'active' : '' }}">
                        <a href="{{ route('admin.logout') }}">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
