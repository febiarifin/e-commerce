<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">

            <a href="/" class="logo text-white fs-3">
                {{ config('app.name') }}
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item {{ $active == 'dashboard' ? 'active' : null }}">
                    <a href="#">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ $active == 'product' ? 'active' : null }}">
                    <a href="{{ route('products.index') }}">
                        <i class="fas fa-table"></i>
                        <p>Product</p>
                    </a>
                </li>
                <li class="nav-item {{ $active == 'report' ? 'active' : null }}">
                    <a href="#">
                        <i class="fas fa-chart-bar"></i>
                        <p>Report</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
