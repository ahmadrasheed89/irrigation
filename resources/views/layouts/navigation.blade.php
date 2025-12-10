<!-- Main sidebar -->
<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center py-2">
                <div class="position-absolute top-0 end-0 mt-1 me-2">
                    <button type="button" class="btn btn-light btn-icon btn-sm rounded-circle sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right fs-6"></i>
                    </button>

                    <button type="button" class="btn btn-light btn-icon btn-sm rounded-circle sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x fs-6"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->

        <!-- User quick info -->
        <div class="sidebar-section border-bottom border-white-10 mx-2 pb-2 mb-1">
            <div class="d-flex align-items-center sidebar-resize-hide">
                <div class="avatar avatar-xs bg-success rounded-circle me-2">
                    <i class="ph-user text-white fs-6"></i>
                </div>
                <div class="flex-grow-1">
                    <div class="fw-semibold text-white fs-6">{{ Auth::user()->first_name ?? 'User' }}</div>
                    <small class="text-white-50 fs-xs">{{ Auth::user()->username ?? 'User' }}</small>
                </div>
            </div>
        </div>

        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header pt-0 mb-1">
                    <div class="text-uppercase fs-xs lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Main</div>
                    <i class="ph-dots-three sidebar-resize-show text-white fs-6"></i>
                </li>
                <li class="nav-item">
                    <x-nav-link class="nav-link text-white rounded-2 mb-1 mx-2 py-2" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        <i class="ph-house me-2 fs-6"></i>
                        <span class="fw-medium fs-6">
                            {{ __('Dashboard') }}
                        </span>
                    </x-nav-link>
                </li>

                <!-- Reports -->
                <li class="nav-item-header mt-1 mb-1">
                    <div class="text-uppercase fs-xs lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Analytics & Reports</div>
                    <i class="ph-dots-three sidebar-resize-show text-white fs-6"></i>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-chart-line me-2 fs-6 bg-orange rounded p-1"></i>
                        <span class="fw-medium fs-6">ADPS Dashboard</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('adps.dashboard')" class="nav-link text-white-80 py-1" :active="request()->routeIs('adps.dashboard')">
                                <i class="ph-gauge me-2 fs-6"></i>
                                <span class="fs-6">{{ __('ADPs Dashboard') }}</span>
                                <span class="badge bg-success ms-auto fs-xs">Live</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Task System -->
                <li class="nav-item-header mt-1 mb-1">
                    <div class="text-uppercase fs-xs lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Tasks Management</div>
                    <i class="ph-dots-three sidebar-resize-show text-white fs-6"></i>
                </li>
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-check-square me-2 fs-6 bg-pink rounded p-1"></i>
                        <span class="fw-medium fs-6">Tasks Center</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('reports.dashboard')" class="nav-link text-white-80 py-1" :active="request()->routeIs('reports.dashboard')">
                                <i class="ph-gauge me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Tasks Dashboard') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('task.explorer')" class="nav-link text-white-80 py-1" :active="request()->routeIs('task.explorer')">
                                <i class="ph-magnifying-glass me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Task Explorer') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('tasks.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('task.index')">
                                <i class="ph-list me-2 fs-6"></i>
                                <span class="fs-6">{{ __('All Tasks') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('tasks.kanban')" class="nav-link text-white-80 py-1" :active="request()->routeIs('task.kanban')">
                                <i class="ph-columns me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Kanban Board') }}</span>
                                <span class="badge bg-primary ms-auto fs-xs">New</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Forms -->
                <li class="nav-item-header mt-1 mb-1">
                    <div class="text-uppercase fs-xs lh-sm opacity-75 sidebar-resize-hide fw-semibold" style="color: #a8c6ff;">Forms Management</div>
                    <i class="ph-dots-three sidebar-resize-show text-white fs-6"></i>
                </li>

                <!-- ADPs -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-note-pencil me-2 fs-6 bg-primary rounded p-1"></i>
                        <span class="fw-medium fs-6">{{ __('ADPs') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('adps.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('adps.index')">
                                <i class="ph-list me-2 fs-6"></i>
                                <span class="fs-6">{{ __('ADPs List') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('adps.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('adps.create')">
                                <i class="ph-plus me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Create ADP') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Schemes -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-text-aa me-2 fs-6 bg-success rounded p-1"></i>
                        <span class="fw-medium fs-6">{{ __('Schemes') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('schemes.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('schemes.index')">
                                <i class="ph-list me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Schemes List') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('schemes.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('schemes.create')">
                                <i class="ph-plus me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Create Scheme') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>



                <!-- Tenders -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-hand-pointing me-2 fs-6 bg-info rounded p-1"></i>
                        <span class="fw-medium fs-6">{{ __('Tenders') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('tenders.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('tenders.index')">
                                <i class="ph-list me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Tenders List') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Portfolios -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-smiley-wink me-2 fs-6 bg-purple rounded p-1"></i>
                        <span class="fw-medium fs-6">{{ __('Portfolios') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('portfolios.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('portfolios.index')">
                                <i class="ph-briefcase me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Portfolios') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('portfolios.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('portfolios.create')">
                                <i class="ph-plus me-2 fs-6"></i>
                                <span class="fs-6">{{ __('New Portfolio') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- NOCs -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-browser me-2 fs-6 bg-teal rounded p-1"></i>
                        <span class="fw-medium fs-6">{{ __('NOCs') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('nocs.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('nocs.index')">
                                <i class="ph-file-text me-2 fs-6"></i>
                                <span class="fs-6">{{ __('NOCs List') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('nocs.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('nocs.create')">
                                <i class="ph-plus me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Create NOC') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                @if(Auth::user()->role == 1 || Auth::user()->role == 2)
                <!-- Administration -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-wrench me-2 fs-6 bg-warning rounded p-1"></i>
                        <span class="fw-medium fs-6">{{ __('Administration') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('categories.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('categories.index')">
                                <i class="ph-folders me-2 fs-6"></i>
                                <span class="fs-6">{{ __('AA Categories') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('categories.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('categories.create')">
                                <i class="ph-plus-circle me-2 fs-6"></i>
                                <span class="fs-6">{{ __('New AA') }}</span>
                            </x-nav-link>
                        </li>

                        <li class="nav-item">
                            <x-nav-link :href="route('noc-categories.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('categories.index')">
                                <i class="ph-folders me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Nocs Categories') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('noc-categories.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('categories.create')">
                                <i class="ph-plus-circle me-2 fs-6"></i>
                                <span class="fs-6">{{ __('New Noc Category') }}</span>
                            </x-nav-link>
                        </li>

                        <li class="nav-item">
                            <x-nav-link :href="route('contractors.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('categories.index')">
                                <i class="ph-folders me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Contractores') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('contractors.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('categories.create')">
                                <i class="ph-plus-circle me-2 fs-6"></i>
                                <span class="fs-6">{{ __('New Contractor') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>

                <!-- Users -->
                <li class="nav-item nav-item-submenu">
                    <a href="#" class="nav-link text-white rounded-2 mb-1 mx-2 py-2">
                        <i class="ph-user me-2 fs-6 bg-success rounded p-1"></i>
                        <span class="fw-medium fs-6">{{ __('Users') }}</span>
                        <i class="ph-caret-down ms-auto transition-3s fs-5"></i>
                    </a>
                    <ul class="nav-group-sub collapse" style="background: rgba(255,255,255,0.05); border-radius: 6px; margin: 0 6px;">
                        <li class="nav-item">
                            <x-nav-link :href="route('users.index')" class="nav-link text-white-80 py-1" :active="request()->routeIs('users.index')">
                                <i class="ph-file-text me-2 fs-6"></i>
                                <span class="fs-6">{{ __('User Management') }}</span>
                            </x-nav-link>
                        </li>
                        <li class="nav-item">
                            <x-nav-link :href="route('users.create')" class="nav-link text-white-80 py-1" :active="request()->routeIs('users.create')">
                                <i class="ph-plus me-2 fs-6"></i>
                                <span class="fs-6">{{ __('Create User') }}</span>
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
                @endif

            </ul>
        </div>
        <!-- /main navigation -->

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
    transform: translateX(3px);
}

.nav-link.active {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
    box-shadow: 0 3px 10px rgba(102, 126, 234, 0.3);
}

.nav-item-submenu .nav-link:not(.active):hover {
    background: rgba(255, 255, 255, 0.05) !important;
}

.nav-group-sub {
    border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
    margin-left: 15px !important;
    padding: 2px 0 !important;
}

.nav-group-sub .nav-link {
    padding-left: 0.75rem !important;
    padding-top: 0.25rem !important;
    padding-bottom: 0.25rem !important;
    font-size: 0.8125rem;
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

/* Reduced font sizes */
.fs-xs { font-size: 0.75rem !important; }
.fs-sm { font-size: 0.875rem !important; }
.fs-6 { font-size: 0.9rem !important; }

/* Compact spacing */
.py-2 { padding-top: 0.4rem !important; padding-bottom: 0.4rem !important; }
.py-1 { padding-top: 0.25rem !important; padding-bottom: 0.25rem !important; }
.mb-1 { margin-bottom: 0.25rem !important; }
.mt-1 { margin-top: 0.25rem !important; }
.mx-2 { margin-left: 0.5rem !important; margin-right: 0.5rem !important; }
.pb-2 { padding-bottom: 0.5rem !important; }
.pt-0 { padding-top: 0 !important; }

/* Smaller badges */
.badge.fs-xs {
    font-size: 0.65rem !important;
    padding: 0.15rem 0.35rem !important;
}

/* Reduced icon padding */
.rounded.p-1 {
    padding: 0.25rem !important;
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
