   <nav class="top-navbar">
       <div class="d-flex align-items-center">
           <button id="sidebarCollapse" class="btn btn-primary sidebar-collapse me-2" aria-label="Open menu">
               <i class="bi bi-list"></i>
           </button>
           <button id="sidebarToggle" class="btn btn-outline-primary d-none d-md-inline-flex"
               aria-label="Collapse sidebar">
               <i class="bi bi-layout-sidebar-inset"></i>
           </button>
       </div>

       <div class="d-flex align-items-center">
           <button id="themeToggle" class="btn btn-outline-secondary me-2" aria-label="Toggle theme">
               <i class="bi bi-moon-stars"></i>
           </button>
           <div class="dropdown ms-3">
               <a href="#" class="dropdown-toggle text-decoration-none d-flex align-items-center" role="button"
                   id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ auth()->user()->avatar ? asset(auth()->user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->name) . '&background=random' }}"
                    class="profile-img rounded-circle" alt="Avatar">   <span class="ms-2 d-none d-md-inline">{{ auth()->user()->name; }}</span>
               </a>
               <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                   <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bi bi-person me-2"></i>Profile</a>
                   </li>
                   <li><a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="bi bi-gear me-2"></i>Settings</a></li>
                   <li>
                       <hr class="dropdown-divider">
                   </li>
                   <li><a class="dropdown-item" href="{{ route('admin.logout') }}"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
               </ul>
           </div>
       </div>
   </nav>
