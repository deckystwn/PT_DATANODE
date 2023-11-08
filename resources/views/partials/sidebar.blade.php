<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="/" class="text-nowrap logo-img">
                <img src="{{ asset('assets/admin/images/logos/logo.png') }}" width="180" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Home</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('dashboard') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Master Data</span>
                </li>
                @if (Auth::user()->role_id == 1)
                    <li class="sidebar-item">
                        <a class="sidebar-link" href="{{ route('user') }}" aria-expanded="false">
                            <span>
                                <i class="ti ti-user-plus"></i>
                            </span>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('category') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-article"></i>
                        </span>
                        <span class="hide-menu">Galeri Kategori</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('gallery') }}" aria-expanded="false">
                        <span>
                            <i class="ti ti-cards"></i>
                        </span>
                        <span class="hide-menu">Galeri</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
