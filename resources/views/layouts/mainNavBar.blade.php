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

 <!-- Quick Actions Menu -->
        <div class="d-none d-lg-flex align-items-center ms-3">
            <div class="btn-group me-2">
                <button type="button" class="btn btn-outline-light btn-sm rounded-pill dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="ph-rocket me-1"></i>
                    Quick Actions
                </button>
                <ul class="dropdown-menu" style="border-radius: 12px; min-width: 220px;">
                    <!-- Users -->
                    <li class="dropdown-header">User Management</li>
                    <li>
                        <a class="dropdown-item" href="{{ route('users.index') }}">
                            <i class="ph-users me-2 text-primary"></i>
                            All Users
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('users.create') }}">
                            <i class="ph-user-plus me-2 text-success"></i>
                            New User
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>

                    <!-- ADP -->
                    <li class="dropdown-header">ADP Management</li>
                    <li>
                        <a class="dropdown-item" href="{{ route('adps.index') }}">
                            <i class="ph-note-pencil me-2 text-primary"></i>
                            ADPs List
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('adps.create') }}">
                            <i class="ph-plus me-2 text-success"></i>
                            Create ADP
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>

                    <!-- Schemes -->
                    <li class="dropdown-header">Schemes Management</li>
                    <li>
                        <a class="dropdown-item" href="{{ route('schemes.index') }}">
                            <i class="ph-text-aa me-2 text-primary"></i>
                            Schemes List
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('schemes.create') }}">
                            <i class="ph-plus me-2 text-success"></i>
                            Create Scheme
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>

                    <!-- NOCs -->
                    <li class="dropdown-header">NOC Management</li>
                    <li>
                        <a class="dropdown-item" href="{{ route('nocs.index') }}">
                            <i class="ph-browser me-2 text-primary"></i>
                            NOCs List
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('nocs.create') }}">
                            <i class="ph-plus me-2 text-success"></i>
                            Create NOC
                        </a>
                    </li>
                    <li class="dropdown-divider"></li>

                    <!-- Tenders -->
                    <li class="dropdown-header">Tender Management</li>
                    <li>
                        <a class="dropdown-item" href="{{ route('tenders.index') }}">
                            <i class="ph-hand-pointing me-2 text-primary"></i>
                            Tenders
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Search section -->
        <div class="navbar-collapse justify-content-center flex-lg-1 order-2 order-lg-1 collapse" id="navbar_search">
            <div class="navbar-search flex-fill position-relative mt-2 mt-lg-0 mx-lg-3">
                <div class="form-control-feedback form-control-feedback-start flex-grow-1">
                    <input type="text" class="form-control bg-white bg-opacity-10 border-0 text-white rounded-pill ps-4"
                           placeholder="Search ADP, Schemes, NOCs, Tenders..." data-bs-toggle="dropdown"
                           style="backdrop-filter: blur(10px);">
                    <div class="form-control-feedback-icon">
                        <i class="ph-magnifying-glass text-white"></i>
                    </div>

                    <!-- Enhanced dropdown -->
                    <div class="dropdown-menu w-100 border-0 shadow-lg" style="border-radius: 16px; margin-top: 8px;">
                        <div class="p-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <h6 class="mb-0 fw-semibold">Quick Search</h6>
                                <span class="badge bg-primary ms-2">All Modules</span>
                            </div>
                        </div>

                        <div class="dropdown-menu-scrollable-lg p-3">
                            <!-- Recent searches -->
                            <div class="mb-4">
                                <div class="d-flex align-items-center mb-3">
                                    <h6 class="mb-0 fs-sm fw-semibold text-muted">Recent Searches</h6>
                                    <a href="#" class="text-primary fs-sm ms-auto">
                                        Clear all
                                    </a>
                                </div>
                                <div class="d-flex flex-wrap gap-2">
                                    <span class="badge bg-light text-dark border cursor-pointer">ADP Reports</span>
                                    <span class="badge bg-light text-dark border cursor-pointer">NOC Applications</span>
                                    <span class="badge bg-light text-dark border cursor-pointer">Tender Notices</span>
                                    <span class="badge bg-light text-dark border cursor-pointer">Scheme Budgets</span>
                                    <span class="badge bg-light text-dark border cursor-pointer">User Management</span>
                                </div>
                            </div>

                            <!-- Quick actions -->
                            <div class="mb-4">
                                <h6 class="fs-sm fw-semibold text-muted mb-3">Quick Create</h6>
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="{{ route('adps.create') }}" class="btn btn-outline-primary btn-sm w-100 text-start">
                                            <i class="ph-note-pencil me-2"></i>New ADP
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('schemes.create') }}" class="btn btn-outline-success btn-sm w-100 text-start">
                                            <i class="ph-text-aa me-2"></i>New Scheme
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('nocs.create') }}" class="btn btn-outline-info btn-sm w-100 text-start">
                                            <i class="ph-browser me-2"></i>New NOC
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('tenders.index') }}" class="btn btn-outline-warning btn-sm w-100 text-start">
                                            <i class="ph-hand-pointing me-2"></i>Tenders
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('users.create') }}" class="btn btn-outline-purple btn-sm w-100 text-start">
                                            <i class="ph-user-plus me-2"></i>New User
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="{{ route('portfolios.create') }}" class="btn btn-outline-teal btn-sm w-100 text-start">
                                            <i class="ph-smiley-wink me-2"></i>New Portfolio
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Module Stats -->
                            <div class="bg-light rounded-3 p-3">
                                <h6 class="fs-sm fw-semibold text-muted mb-2">Module Overview</h6>
                                <div class="row text-center g-2">
                                    <div class="col-3">
                                        <div class="fw-bold text-primary">24</div>
                                        <small class="text-muted">ADPs</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="fw-bold text-success">18</div>
                                        <small class="text-muted">Schemes</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="fw-bold text-info">12</div>
                                        <small class="text-muted">NOCs</small>
                                    </div>
                                    <div class="col-3">
                                        <div class="fw-bold text-warning">8</div>
                                        <small class="text-muted">Tenders</small>
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
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Module</label>
                            <div class="d-flex flex-wrap gap-3">
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked>
                                    <span class="form-check-label d-flex align-items-center">
                                        <i class="ph-note-pencil text-primary me-2"></i>ADP
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked>
                                    <span class="form-check-label d-flex align-items-center">
                                        <i class="ph-text-aa text-success me-2"></i>Schemes
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked>
                                    <span class="form-check-label d-flex align-items-center">
                                        <i class="ph-browser text-info me-2"></i>NOCs
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked>
                                    <span class="form-check-label d-flex align-items-center">
                                        <i class="ph-hand-pointing text-warning me-2"></i>Tenders
                                    </span>
                                </label>
                                <label class="form-check">
                                    <input type="checkbox" class="form-check-input" checked>
                                    <span class="form-check-label d-flex align-items-center">
                                        <i class="ph-users text-purple me-2"></i>Users
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select">
                                <option value="1" selected>All Status</option>
                                <option value="2">Active</option>
                                <option value="3">Pending</option>
                                <option value="4">Completed</option>
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

                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Sort By</label>
                            <select class="form-select">
                                <option value="1" selected>Recent First</option>
                                <option value="2">Oldest First</option>
                                <option value="3">A to Z</option>
                                <option value="4">Z to A</option>
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
            <!-- Module Quick Actions -->
            <li class="nav-item d-none d-lg-block">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-primary btn-sm rounded-pill dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="ph-plus-circle me-1"></i>
                        Quick Create
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 12px; min-width: 200px;">
                        <li>
                            <a class="dropdown-item" href="{{ route('adps.create') }}">
                                <i class="ph-note-pencil me-2 text-primary"></i>
                                New ADP
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('schemes.create') }}">
                                <i class="ph-text-aa me-2 text-success"></i>
                                New Scheme
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('nocs.create') }}">
                                <i class="ph-browser me-2 text-info"></i>
                                New NOC
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('tenders.index') }}">
                                <i class="ph-hand-pointing me-2 text-warning"></i>
                                Tenders
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('users.create') }}">
                                <i class="ph-user-plus me-2 text-purple"></i>
                                New User
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Notifications -->
            <li class="nav-item nav-item-dropdown-lg dropdown">
                <a href="#" class="navbar-nav-link align-items-center rounded-pill p-1 position-relative bg-white bg-opacity-10 me-2 nav-dropdown-toggle"
                   data-bs-toggle="dropdown" data-bs-auto-close="outside">
                    <i class="ph-bell text-white fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-white">
                        5
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-0" style="border-radius: 16px; min-width: 320px;">
                    <div class="p-3 border-bottom">
                        <div class="d-flex align-items-center">
                            <h6 class="mb-0 fw-semibold">Notifications</h6>
                            <span class="badge bg-primary ms-2">5 New</span>
                        </div>
                    </div>

                    <div class="dropdown-menu-scrollable-lg" style="max-height: 300px;">
                        <!-- ADP Notification -->
                        <a href="{{ route('adps.index') }}" class="dropdown-item py-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-primary rounded-2 p-2">
                                        <i class="ph-note-pencil text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">ADP Update</div>
                                    <div class="text-muted fs-sm">New ADP requires approval</div>
                                    <small class="text-muted">10 minutes ago</small>
                                </div>
                            </div>
                        </a>

                        <!-- Scheme Notification -->
                        <a href="{{ route('schemes.index') }}" class="dropdown-item py-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-success rounded-2 p-2">
                                        <i class="ph-text-aa text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Scheme Alert</div>
                                    <div class="text-muted fs-sm">Scheme budget needs review</div>
                                    <small class="text-muted">1 hour ago</small>
                                </div>
                            </div>
                        </a>

                        <!-- NOC Notification -->
                        <a href="{{ route('nocs.index') }}" class="dropdown-item py-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-info rounded-2 p-2">
                                        <i class="ph-browser text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">NOC Application</div>
                                    <div class="text-muted fs-sm">New NOC application submitted</div>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </div>
                        </a>

                        <!-- Tender Notification -->
                        <a href="{{ route('tenders.index') }}" class="dropdown-item py-3 border-bottom">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-warning rounded-2 p-2">
                                        <i class="ph-hand-pointing text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">Tender Deadline</div>
                                    <div class="text-muted fs-sm">Tender closing in 24 hours</div>
                                    <small class="text-muted">3 hours ago</small>
                                </div>
                            </div>
                        </a>

                        <!-- User Notification -->
                        <a href="{{ route('users.index') }}" class="dropdown-item py-3">
                            <div class="d-flex">
                                <div class="flex-shrink-0">
                                    <div class="bg-purple rounded-2 p-2">
                                        <i class="ph-user-plus text-white"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <div class="fw-semibold">New User</div>
                                    <div class="text-muted fs-sm">New user registration pending</div>
                                    <small class="text-muted">4 hours ago</small>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="p-3 border-top text-center">
                        <a href="#" class="btn btn-outline-primary btn-sm">View All Notifications</a>
                    </div>
                </div>
            </li>

            <!-- Module Quick Links -->
            <li class="nav-item d-none d-lg-block">
                <div class="btn-group me-2">
                    <button type="button" class="btn btn-outline-light btn-sm rounded-pill dropdown-toggle" data-bs-toggle="dropdown">
                        <i class="ph-grid-four me-1"></i>
                        Modules
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 12px; min-width: 180px;">
                        <li>
                            <a class="dropdown-item" href="{{ route('adps.index') }}">
                                <i class="ph-note-pencil me-2 text-primary"></i>
                                ADPs
                                <span class="badge bg-primary ms-auto">24</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('schemes.index') }}">
                                <i class="ph-text-aa me-2 text-success"></i>
                                Schemes
                                <span class="badge bg-success ms-auto">18</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('nocs.index') }}">
                                <i class="ph-browser me-2 text-info"></i>
                                NOCs
                                <span class="badge bg-info ms-auto">12</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('tenders.index') }}">
                                <i class="ph-hand-pointing me-2 text-warning"></i>
                                Tenders
                                <span class="badge bg-warning ms-auto">8</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="{{ route('users.index') }}">
                                <i class="ph-users me-2 text-purple"></i>
                                Users
                                <span class="badge bg-purple ms-auto">42</span>
                            </a>
                        </li>
                    </ul>
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

                <div class="dropdown-menu dropdown-menu-end border-0 shadow-lg" style="border-radius: 16px; min-width: 280px;">
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
                    </a>
                    <a href="{{ route('users.edit', auth()->user()->id) }}" class="dropdown-item py-2">
                        <i class="ph-pencil-simple me-2"></i>
                        Edit Profile
                    </a>
                    <a href="#" class="dropdown-item py-2" data-bs-toggle="modal" data-bs-target="#passwordModal">
                        <i class="ph-key me-2"></i>
                        Change Password
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- Module Management -->
                    <div class="p-2">
                        <small class="text-muted px-3">MODULE MANAGEMENT</small>
                    </div>
                    <a href="{{ route('adps.index') }}" class="dropdown-item py-2">
                        <i class="ph-note-pencil me-2 text-primary"></i>
                        ADPs
                        <span class="badge bg-primary ms-auto">24</span>
                    </a>
                    <a href="{{ route('schemes.index') }}" class="dropdown-item py-2">
                        <i class="ph-text-aa me-2 text-success"></i>
                        Schemes
                        <span class="badge bg-success ms-auto">18</span>
                    </a>
                    <a href="{{ route('nocs.index') }}" class="dropdown-item py-2">
                        <i class="ph-browser me-2 text-info"></i>
                        NOCs
                        <span class="badge bg-info ms-auto">12</span>
                    </a>
                    <a href="{{ route('tenders.index') }}" class="dropdown-item py-2">
                        <i class="ph-hand-pointing me-2 text-warning"></i>
                        Tenders
                        <span class="badge bg-warning ms-auto">8</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- Admin Section -->
                    <div class="p-2">
                        <small class="text-muted px-3">ADMIN SECTION</small>
                    </div>
                    <a href="{{ route('users.index') }}" class="dropdown-item py-2">
                        <i class="ph-users me-2 text-purple"></i>
                        Manage Users
                        <span class="badge bg-purple ms-auto">42</span>
                    </a>

                    <div class="dropdown-divider"></div>

                    <!-- Quick stats -->
                    <div class="p-3 bg-light rounded-3 mx-2 my-2">
                        <div class="row text-center g-2">
                            <div class="col-4">
                                <div class="fw-bold text-primary">24</div>
                                <small class="text-muted">ADPs</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold text-success">18</div>
                                <small class="text-muted">Schemes</small>
                            </div>
                            <div class="col-4">
                                <div class="fw-bold text-info">12</div>
                                <small class="text-muted">NOCs</small>
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

<!-- Password Change Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('users.password.update', auth()->user()->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Current Password</label>
                        <input type="password" name="current_password" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control" required minlength="8">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm New Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Password</button>
                </div>
            </form>
        </div>
    </div>
</div>

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

.bg-purple {
    background-color: #8b5cf6 !important;
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

/* Quick Actions button group */
.btn-group .btn-outline-light:hover {
    background: rgba(255, 255, 255, 0.2) !important;
    color: white !important;
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

    // Password Modal Handler
    const passwordModal = document.getElementById('passwordModal');
    if (passwordModal) {
        passwordModal.addEventListener('show.bs.modal', function() {
            // Reset form when modal opens
            const form = this.querySelector('form');
            if (form) {
                form.reset();
            }
        });
    }

    // User search integration
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            const searchTerm = this.value.trim();
            if (searchTerm) {
                window.location.href = `{{ route('users.index') }}?search=${encodeURIComponent(searchTerm)}`;
            }
        }
    });
});
</script>
