<aside class="app-sidebar bg-primary shadow" data-bs-theme="dark">

    {{-- Brand --}}
    <div class="sidebar-brand">
        <a href="{{ route('admin.dashboard') }}"
           class="brand-link text-decoration-none d-flex align-items-center gap-2 px-3 py-3">

            <i class="bi bi-building text-white fs-4"></i>

            <div class="d-flex flex-column">
                <span class="brand-text fw-bold text-white">
                    DPWH ProjectHub
                </span>
                <small class="text-white-50">
                    Negros Island Region
                </small>
            </div>
        </a>
    </div>


    {{-- Sidebar Menu --}}
    <div class="sidebar-wrapper">

        <nav class="mt-3">

            <ul class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false">


                {{-- MAIN NAVIGATION --}}
                <li class="nav-header text-uppercase text-white-50 small fw-semibold px-3 mb-2">
                    Main Navigation
                </li>


                {{-- Dashboard --}}
                <li class="nav-item">

                    <a href="{{ route('admin.dashboard') }}"
                       class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>

                    </a>

                </li>


                {{-- Projects --}}
                <li class="nav-item">

                    <a href="{{ route('projects.index') }}"
                       class="nav-link {{ request()->routeIs('projects.index', 'projects.create', 'projects.edit', 'projects.update') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-folder2-open"></i>
                        <p>Projects</p>

                    </a>

                </li>


                {{-- Project Map --}}
                <li class="nav-item">

                    <a href="{{ route('projects.map') }}"
                       class="nav-link {{ request()->routeIs('projects.map') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-geo-alt-fill"></i>
                        <p>Project Map</p>

                    </a>

                </li>


                {{-- Survey Forms --}}
                <li class="nav-item">

                    <a href="{{ route('survey.index') }}"
                       class="nav-link {{ request()->routeIs('survey.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-ui-checks-grid"></i>
                        <p>Survey Forms</p>

                    </a>

                </li>


                {{-- Reports --}}
                <li class="nav-item">

                    <a href="{{ route('reports.index') }}"
                       class="nav-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-file-earmark-bar-graph-fill"></i>
                        <p>Reports</p>

                    </a>

                </li>


                {{-- ACCOUNT SECTION --}}
                <li class="nav-header text-uppercase text-white-50 small fw-semibold mt-4 px-3 mb-2">
                    Account
                </li>


                {{-- Profile --}}
                <li class="nav-item">

                    <a href="{{ route('profile.edit') }}"
                       class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">

                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>My Profile</p>

                    </a>

                </li>


                {{-- Logout --}}
                <li class="nav-item mt-2">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="nav-link border-0 bg-transparent text-start w-100 text-white">

                            <i class="nav-icon bi bi-box-arrow-right"></i>
                            <p>Logout</p>

                        </button>
                    </form>

                </li>


            </ul>

        </nav>

    </div>

</aside>