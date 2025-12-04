<!-- Main navbar -->
<div class="navbar navbar-dark navbar-expand-lg navbar-static border-0" style="background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);">
    <div class="container-fluid">
        <!-- Mobile toggle -->
        <div class="d-flex d-lg-none me-2">
            <button type="button" class="navbar-toggler sidebar-mobile-main-toggle rounded-pill bg-white bg-opacity-10 border-0">
                <i class="ph-list text-white"></i>
            </button>
        </div>

        <!-- Brand logo -->
        <div class="navbar-brand flex-1 flex-lg-0">
            <a href="{{ route('dashboard') }}" class="d-inline-flex align-items-center">
                <div class="bg-white rounded-3 p-2 me-2 shadow-sm">
                    <img src="https://themes.kopyov.com/limitless/demo/template/assets/images/logo_icon.svg" alt="Logo" class="h-24px">
                </div>
                <span class="text-white fw-bold fs-4 d-none d-sm-inline-block">Management Portal</span>
            </a>
        </div>

        <!-- Search section -->
        <div class="navbar-collapse justify-content-center flex-lg-1 order-2 order-lg-1 collapse" id="navbar_search">
            <div class="navbar-search flex-fill position-relative mt-2 mt-lg-0 mx-lg-3">
                <div class="form-control-feedback form-control-feedback-start flex-grow-1">
                    <input type="text" class="form-control bg-white bg-opacity-10 border-0 text-white rounded-pill ps-4"
                           placeholder="Search tasks, projects, users..." data-bs-toggle="dropdown"
                           style="backdrop-filter: blur(10px);">
                    <div class="form-control-feedback-icon">
                        <i class="ph-magnifying-glass text-white"></i>
                    </div>

                    <!-- Enhanced dropdown -->
                    <div class="dropdown-menu w-100 border-0 shadow-lg" style="border-radius: 16px; margin-top: 8px;">
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 fw-semibold">Quick Search</h6>
                                <span class="badge bg-primary ms-2">New</span>
                            </div>
                        </div>

                        <div class="dropdown-menu-scrollable-lg p-3">
                            <!-- Recent searches -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <h6 class="mb-0 fs-sm fw-semibold text-muted">Recent</h6>
                                    <a href="#" class="text-primary fs-sm ms-auto">
                                        Clear all
                                    </a>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark border cursor-pointer">Dashboard reports</span>
                                    <span class="badge bg-light text-dark border cursor-pointer">Pending tasks</span>
                                    <span class="badge bg-light text-dark border cursor-pointer">User management</span>
                                </div>
                            </div>

                            <!-- Quick actions -->
                            <div class="mb-4">
                                <h6 class="fs-sm fw-semibold text-muted mb-3">Quick Actions</h6>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary btn-sm w-100 text-start">
                                            <i class="ph-plus-circle me-2"></i>New Task
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-success btn-sm w-100 text-start">
                                            <i class="ph-chart-line me-2"></i>View Reports
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-info btn-sm w-100 text-start">
                                            <i class="ph-users me-2"></i>Team Members
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-warning btn-sm w-100 text-start">
                                            <i class="ph-calendar me-2"></i>Schedule
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick stats -->
                            <div class="bg-light rounded-3 p-3">
                                <h6 class="fs-sm fw-semibold text-muted mb-2">Today's Overview</h6>
                                <div class="row text-center g-2">
                                    <div class="col-4">
                                        <div class="fw-bold text-primary">12</div>
                                        <small class="text-muted">New Tasks</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="fw-bold text-success">8</div>
                                        <small class="text-muted">Completed</small>
                                    </div>
                                    <div class="col-4">
                                        <div class="fw-bold text-warning">3</div>
                                        <small class="text-muted">Pending</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Filter button -->
                <a href="#" class="navbar-nav-link align-items-center justify-content-center w-40px h-32px rounded-pill position-absolute end-0 top-50 translate-middle-y p-0 me-1 bg-white bg-opacity-10 border-0"
                   data-bs-toggle="dropdown" data-bs-auto-close="outside">
                    <i class="ph-faders-horizontal text-white"></i>
                </a>

                <!-- Filter dropdown -->
                <div class="dropdown-menu w-100 p-3 border-0 shadow-lg" style="border-radius: 16px;">
                    <div class="d-flex align-items-center mb-3">
                        <h6 class="mb-0 fw-semibold">🔍 Advanced Search</h6>
                        <a href="#" class="text-primary rounded-pill ms-auto">
                            <i class="ph-clock-counter-clockwise"></i>
                        </a>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Category</label>
                            <div class="d-flex flex-column gap-2">
                                <label class="form-check form-check-simple">
                                    <input type="checkbox" class="form-check-input" checked>
                                    <span class="form-check-label">Tasks</span>
                                </label>
                                <label class="form-check form-check-simple">
                                    <input type="checkbox" class="form-check-input">
                                    <span class="form-check-label">Projects</span>
                                </label>
                                <label class="form-check form-check-simple">
                                    <input type="checkbox" class="form-check-input">
                                    <span class="form-check-label">Users</span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select">
                                <option value="1" selected>All Status</option>
                                <option value="2">Active</option>
                                <option value="3">Completed</option>
                                <option value="4">Pending</option>
                                <option value="5">Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Priority</label>
                            <select class="form-select">
                                <option value="1" selected>All Priorities</option>
                                <option value="2">High</option>
                                <option value="3">Medium</option>
                                <option value="4">Low</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Date Range</label>
                            <select class="form-select">
                                <option value="1" selected>Any Time</option>
                                <option value="2">Today</option>
                                <option value="3">This Week</option>
                                <option value="4">This Month</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex mt-4 pt-2 border-top">
                        <button type="button" class="btn btn-light">Reset</button>
                        <div class="ms-auto">
                            <button type="button" class="btn btn-light">Cancel</button>
                            <button type="button" class="btn btn-primary ms-2">
                                <i class="ph-magnifying-glass me-2"></i>Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right side items -->
        <ul class="nav flex-row justify-content-end order-1 order-lg-2">
            <!-- Notifications -->
            <li class="nav-item nav-item-dropdown-lg dropdown">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1 position-relative bg-white bg-opacity-10 me-2 nav-dropdown-toggle"
                   data-bs-toggle="dropdown" data-bs-auto-close="outside">
                    <i class="ph-bell text-white fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-white">
                        3
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-0" style="border-radius: 16px; min-width: 320px;">
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 fw-semibold">Notifications</h6>
                            <span class="badge bg-primary ms-2">3 New</span>
                        </div>
                    </div>

                    <div class="dropdown-menu-scrollable-lg" style="max-height: 300px;">
                        <!-- Notification items -->
                        <a href="#" class="dropdown-item py-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-success rounded-2 p-2">
                                        <i class="ph-check-circle text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Task Completed</div>
                                    <div class="text-muted fs-sm">Project dashboard design approved</div>
                                    <small class="text-muted">2 minutes ago</small>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="dropdown-item py-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning rounded-2 p-2">
                                        <i class="ph-warning text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Deadline Approaching</div>
                                    <div class="text-muted fs-sm">Client meeting in 1 hour</div>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </a>

                        <a href="#" class="dropdown-item py-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-info rounded-2 p-2">
                                        <i class="ph-user-plus text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">New Team Member</div>
                                    <div class="text-muted fs-sm">Sarah Johnson joined your project</div>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="p-3 border-top text-center">
                        <a href="#" class="btn btn-outline-primary btn-sm">View All Notifications</a>
                    </div>
                </div>
            </li>

            <!-- User dropdown -->
            <li class="nav-item nav-item-dropdown-lg dropdown ms-lg-2">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1 bg-white bg-opacity-10 border-0 nav-dropdown-toggle"
                   data-bs-toggle="dropdown">
                    <div class="status-indicator-container position-relative">
                        <div class="avatar bg-gradient-primary text-white rounded-pill d-flex align-items-center justify-content-center"
                             style="width: 36px; height: 36px;">
                            {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                        </div>
                        <span class="status-indicator bg-success border border-2 border-white"></span>
                    </div>
                    <span class="d-none d-lg-inline-block mx-lg-2 fw-semibold text-white">{{ auth()->user()->username }}</span>
                    <i class="ph-caret-down text-white d-none d-lg-inline-block"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 16px; min-width: 240px;">
                    <!-- User header -->
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <div class="avatar bg-gradient-primary text-white rounded-pill me-3 d-flex align-items-center justify-content-center"
                                 style="width: 40px; height: 40px;">
                                {{ strtoupper(substr(auth()->user()->username, 0, 2)) }}
                            </div>
                            <div class="flex-grow-1">
                                <div class="fw-semibold">{{ auth()->user()->first_name }}</div>
                                <small class="text-muted">{{ auth()->user()->username }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- User menu -->
                    <a href="{{ route('users.show', auth()->user()->id) }}" class="dropdown-item py-2">
                        <i class="ph-user-circle me-2"></i>
                        My Profile
                        <span class="badge bg-success ms-auto"></span>
                    </a>
                    <a href="#" class="dropdown-item py-2">
                        <i class="ph-gear me-2"></i>
                        Account Settings
                    </a>
                    <a href="#" class="dropdown-item py-2">
                        <i class="ph-bell me-2"></i>
                        Notifications
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- Quick stats -->
                    <div class="p-3 bg-light rounded-3 mx-2 my-2">
                        <div class="row text-center g-2">
                            <div class="col-4">
                                <div class="fw-bold text-primary">5</div>
                                <small class="text-muted">Projects</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold text-success">12</div>
                                <small class="text-muted">Tasks</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold text-warning">3</div>
                                <small class="text-muted">Pending</small>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown-divider"></div>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item py-2 text-danger">
                            <i class="ph-sign-out me-2"></i>
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- /main navbar -->

<style>
.navbar {
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255,255,255,0.1) !important;
}

.navbar-nav-link {
    transition: all 0.3s ease;
    border: none !important;
}

.navbar-nav-link:hover {
    background: rgba(255, 255, 255, 0.15) !important;
    transform: translateY(-1px);
}

.navbar-nav-link.active {
    background: rgba(255, 255, 255, 0.2) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.status-indicator-container {
    position: relative;
    display: inline-block;
}

.status-indicator {
    position: absolute;
    bottom: 2px;
    right: 2px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    border: 2px solid;
}

.avatar {
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 0.875rem;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
}

.dropdown-menu {
    backdrop-filter: blur(20px);
    background: rgba(255, 255, 255, 0.95) !important;
}

.form-check-simple {
    padding-left: 0;
}

.form-check-simple .form-check-input {
    margin-right: 0.5rem;
}

/* Smooth animations */
.dropdown-menu {
    animation: slideDown 0.2s ease;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Custom scrollbar for dropdowns */
.dropdown-menu-scrollable-lg::-webkit-scrollbar {
    width: 4px;
}

.dropdown-menu-scrollable-lg::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 10px;
}

.dropdown-menu-scrollable-lg::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 10px;
}

.dropdown-menu-scrollable-lg::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced search functionality
    const searchInput = document.querySelector('#navbar_search input[type="text"]');
    const searchDropdown = new bootstrap.Dropdown(searchInput);

    // Add search debounce
    let searchTimeout;
    searchInput.addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            // Simulate search results
            console.log('Searching for:', this.value);
        }, 500);
    });

    // Notification badge update
    const notificationBell = document.querySelector('[data-bs-toggle="dropdown"] .ph-bell').parentElement;
    const notificationBadge = notificationBell.querySelector('.badge');

    // Simulate notification count update
    setInterval(() => {
        const currentCount = parseInt(notificationBadge.textContent);
        if (currentCount < 5) {
            notificationBadge.textContent = currentCount + 1;
        }
    }, 30000); // Update every 30 seconds for demo

    // Active dropdown management
    const dropdownToggles = document.querySelectorAll('.nav-dropdown-toggle');
    let activeDropdown = null;

    dropdownToggles.forEach(toggle => {
        // Initialize Bootstrap dropdown
        const dropdown = new bootstrap.Dropdown(toggle);

        toggle.addEventListener('click', function(e) {
            // If clicking the currently active dropdown, do nothing
            if (activeDropdown === this) {
                return;
            }

            // Remove active class from all dropdown toggles
            dropdownToggles.forEach(item => {
                item.classList.remove('active');
            });

            // Close any previously active dropdown
            if (activeDropdown && activeDropdown !== this) {
                const prevDropdown = bootstrap.Dropdown.getInstance(activeDropdown);
                if (prevDropdown) {
                    prevDropdown.hide();
                }
            }

            // Set current dropdown as active
            this.classList.add('active');
            activeDropdown = this;
        });

        // Handle dropdown hide event
        toggle.addEventListener('hide.bs.dropdown', function() {
            this.classList.remove('active');
            if (activeDropdown === this) {
                activeDropdown = null;
            }
        });
    });

    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.nav-item-dropdown-lg')) {
            dropdownToggles.forEach(toggle => {
                toggle.classList.remove('active');
            });
            activeDropdown = null;
        }
    });
});
</script>
