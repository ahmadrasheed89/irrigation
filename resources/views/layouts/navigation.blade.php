<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center py-3">
                {{-- <div class="text-center">
                    <div class="sidebar-resize-hide">
                        <div class="avatar avatar-lg bg-white rounded-circle mb-2 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="ph-navigation-arrow text-primary fs-4"></i>
                        </div>
                        <h5 class="text-white mb-0 fw-bold">Navigation</h5>
                        <small class="text-white-50">Management Portal</small>
                    </div>
                </div> --}}

                <div class="position-absolute top-0 end-0 mt-1 me-2">
                    <button type="button" class="btn btn-light btn-icon btn-sm rounded-circle sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-light btn-icon btn-sm rounded-circle sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->

        <!-- User quick info -->
        <div class="sidebar-section border-bottom border-white-10 mx-3 pb-3 mb-1">
            <div class="d-flex align-items-center sidebar-resize-hide">
                <div class="avatar avatar-sm bg-success rounded-circle me-2">
                    <i class="ph-user text-white"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold text-white">{{ Auth::user()->first_name ?? 'User' }}</div>
                    <small class="text-white-50">{{ Auth::user()->username ?? 'User' }}</small>
                </div>
                {{-- <span class="badge bg-primary rounded-pill">Pro</span>   --}}
            </div>
        </div>

        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header pt-0 mb-1">
                    <div class="text-uppercase fs-sm lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Main</div>
                    <i class="ph-dots-three sidebar-resize-show text-white"></i>
                </li>
                <li class="nav-item">
                    <x-nav-link class="nav-link text-white rounded-3 mb-1 mx-2" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="ph-house me-3 fs-5"></i>
                        <span class="fw-medium">
                            {{ __('Dashboard') }}
                        </span>
                        {{-- <span class="badge bg-success ms-auto">New</span> --}}
                    </x-nav-link>
                </li>

                <!-- Reports -->
                <li class="nav-item-header mt-1 mb-1">
                    <div class="text-uppercase fs-sm lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Analytics & Reports</div>
                    <i class="ph-dots-three sidebar-resize-show text-white"></i>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-chart-line me-3 fs-5 bg-orange rounded p-1"></i>
                        <span class="fw-medium">ADPS Dashboard</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('adps.dashboard')" class="nav-link text-white-80" :active="request()->routeIs('adps.dashboard')">
                                <i class="ph-gauge me-2"></i>
                                {{ __('ADPs Dashboard') }}
                                <span class="badge bg-success ms-auto">Live</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                <!-- /components -->

                <!-- Task System -->
                <li class="nav-item-header mt-1 mb-1">
                    <div class="text-uppercase fs-sm lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Tasks Management</div>
                    <i class="ph-dots-three sidebar-resize-show text-white"></i>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-check-square me-3 fs-5 bg-pink rounded p-1"></i>
                        <span class="fw-medium">Tasks Center</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('reports.dashboard')" class="nav-link text-white-80" :active="request()->routeIs('reports.dashboard')">
                                <i class="ph-gauge me-2"></i>
                                {{ __('Tasks Dashboard') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('task.explorer')" class="nav-link text-white-80" :active="request()->routeIs('task.explorer')">
                                <i class="ph-magnifying-glass me-2"></i>
                                {{ __('Task Explorer') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('tasks.index')" class="nav-link text-white-80" :active="request()->routeIs('task.index')">
                                <i class="ph-list me-2"></i>
                                {{ __('All Tasks') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('tasks.kanban')" class="nav-link text-white-80" :active="request()->routeIs('task.kanban')">
                                <i class="ph-columns me-2"></i>
                                {{ __('Kanban Board') }}
                                <span class="badge bg-primary ms-auto">New</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                <!-- /Task System -->

                <!-- Forms -->
                <li class="nav-item-header mt-1 mb-1">
                    <div class="text-uppercase fs-sm lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Forms Management</div>
                    <i class="ph-dots-three sidebar-resize-show text-white"></i>
                </li>

                <!-- ADPs -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-note-pencil me-3 fs-5 bg-primary rounded p-1"></i>
                        <span class="fw-medium">{{ __('ADPs') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('adps.index')" class="nav-link text-white-80" :active="request()->routeIs('adps.index')">
                                <i class="ph-list me-2"></i>
                                {{ __('ADPs List') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('adps.create')" class="nav-link text-white-80" :active="request()->routeIs('adps.create')">
                                <i class="ph-plus me-2"></i>
                                {{ __('Create ADP') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Schemes -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-text-aa me-3 fs-5 bg-success rounded p-1"></i>
                        <span class="fw-medium">{{ __('Schemes') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('schemes.index')" class="nav-link text-white-80" :active="request()->routeIs('schemes.index')">
                                <i class="ph-list me-2"></i>
                                {{ __('Schemes List') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('schemes.create')" class="nav-link text-white-80" :active="request()->routeIs('schemes.create')">
                                <i class="ph-plus me-2"></i>
                                {{ __('Create Scheme') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Administration -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-wrench me-3 fs-5 bg-warning rounded p-1"></i>
                        <span class="fw-medium">{{ __('Administration') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('categories.index')" class="nav-link text-white-80" :active="request()->routeIs('categories.index')">
                                <i class="ph-folders me-2"></i>
                                {{ __('Categories') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('categories.create')" class="nav-link text-white-80" :active="request()->routeIs('categories.create')">
                                <i class="ph-plus-circle me-2"></i>
                                {{ __('New Category') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Tenders -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-hand-pointing me-3 fs-5 bg-info rounded p-1"></i>
                        <span class="fw-medium">{{ __('Tenders') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('tenders.index')" class="nav-link text-white-80" :active="request()->routeIs('tenders.index')">
                                <i class="ph-list me-2"></i>
                                {{ __('Tenders List') }}
                            </x-nav-link>
                        </li>
                        {{-- <li class="nav-item">
                            <x-nav-link :href="route('tenders.create')" class="nav-link text-white-80" :active="request()->routeIs('tenders.create')">
                                <i class="ph-plus me-2"></i>
                                {{ __('Create Tender') }}
                            </x-nav-link>
                        </li> --}}
                    </ul>
                </li>

                <!-- Portfolios -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-smiley-wink me-3 fs-5 bg-purple rounded p-1"></i>
                        <span class="fw-medium">{{ __('Portfolios') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('portfolios.index')" class="nav-link text-white-80" :active="request()->routeIs('portfolios.index')">
                                <i class="ph-briefcase me-2"></i>
                                {{ __('Portfolios') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('portfolios.create')" class="nav-link text-white-80" :active="request()->routeIs('portfolios.create')">
                                <i class="ph-plus me-2"></i>
                                {{ __('New Portfolio') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- NOCs -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-browser me-3 fs-5 bg-teal rounded p-1"></i>
                        <span class="fw-medium">{{ __('NOCs') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('nocs.index')" class="nav-link text-white-80" :active="request()->routeIs('nocs.index')">
                                <i class="ph-file-text me-2"></i>
                                {{ __('NOCs List') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('nocs.create')" class="nav-link text-white-80" :active="request()->routeIs('nocs.create')">
                                <i class="ph-plus me-2"></i>
                                {{ __('Create NOC') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                <!-- /forms -->

                <!-- NOCs -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-3 mb-1 mx-2">
                        <i class="ph-user me-3 fs-5 bg-success rounded p-1"></i>
                        <span class="fw-medium">{{ __('Users') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 8px; margin: 0 8px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('users.index')" class="nav-link text-white-80" :active="request()->routeIs('users.index')">
                                <i class="ph-file-text me-2"></i>
                                {{ __('User Management') }}
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('users.create')" class="nav-link text-white-80" :active="request()->routeIs('users.create')">
                                <i class="ph-plus me-2"></i>
                                {{ __('Create User') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                <!-- /forms -->





            </ul>
        </div>
        <!-- /main navigation -->

        {{-- <!-- Sidebar footer -->
        <div class="sidebar-section mt-auto">
            <div class="sidebar-section-body text-center sidebar-resize-hide">
                <div class="mb-3">
                    <div class="progress" style="height: 4px;">
                        <div class="progress-bar bg-success" style="width: 65%;"></div>
                    </div>
                    <small class="text-white-50">Storage: 65% used</small>
                </div>
                <button class="btn btn-outline-light btn-sm rounded-pill">
                    <i class="ph-gear me-1"></i>Settings
                </button>
            </div>
        </div>
        <!-- /sidebar footer --> --}}

    </div>
    <!-- /sidebar content -->

</div>
<!-- /main sidebar -->

<style>
.sidebar-dark {
    --sidebar-bg: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%) !important;
}

.nav-link {
    transition: all 0.3s ease;
    border: none !important;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.1) !important;
    transform: translateX(5px);
}

.nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.nav-item-submenu .nav-link:not(.active):hover {
    background: rgba(255, 255, 255, 0.05) !important;
}

.nav-group-sub {
    border-left: 2px solid rgba(255, 255, 255, 0.1) !important;
    margin-left: 20px !important;
}

.nav-group-sub .nav-link {
    padding-left: 1rem !important;
    font-size: 0.875rem;
}

.nav-group-sub .nav-link:hover {
    background: rgba(255, 255, 255, 0.08) !important;
}

.bg-purple { background-color: #8b5cf6 !important; }
.bg-teal { background-color: #14b8a6 !important; }
.bg-orange { background-color: #f97316 !important; }
.bg-pink { background-color: #ec4899 !important; }

.transition-3s {
    transition: transform 0.3s ease;
}

.nav-item-submenu.show .ph-caret-down {
    transform: rotate(180deg);
}

.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
}

.border-white-10 {
    border-color: rgba(255, 255, 255, 0.1) !important;
}

.text-white-80 {
    color: rgba(255, 255, 255, 0.8) !important;
}

.text-white-50 {
    color: rgba(255, 255, 255, 0.5) !important;
}

/* Smooth scrolling for sidebar */
.sidebar-content {
    scrollbar-width: thin;
    scrollbar-color: rgba(255,255,255,0.3) transparent;
}

.sidebar-content::-webkit-scrollbar {
    width: 4px;
}

.sidebar-content::-webkit-scrollbar-track {
    background: transparent;
}

.sidebar-content::-webkit-scrollbar-thumb {
    background-color: rgba(255,255,255,0.3);
    border-radius: 10px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add smooth transitions for dropdown arrows
    const dropdownToggles = document.querySelectorAll('.nav-item-submenu > .nav-link');

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            const icon = this.querySelector('.ph-caret-down');
            if (icon) {
                icon.style.transition = 'transform 0.3s ease';
            }
        });
    });

    // Add active state animations
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', function() {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>
