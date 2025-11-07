<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

			<!-- Sidebar content -->
			<div class="sidebar-content">

				<!-- Sidebar header -->
				<div class="sidebar-section">
					<div class="sidebar-section-body d-flex justify-content-center">
						<h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navigation</h5>

						<div>
							<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
								<i class="ph-arrows-left-right"></i>
							</button>

							<button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
								<i class="ph-x"></i>
							</button>
						</div>
					</div>
				</div>
				<!-- /sidebar header -->


				<!-- Main navigation -->
				<div class="sidebar-section">
					<ul class="nav nav-sidebar" data-nav-type="accordion">

						<!-- Main -->
						<li class="nav-item-header pt-0">
							<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Main</div>
							<i class="ph-dots-three sidebar-resize-show"></i>
						</li>
						<li class="nav-item">
                            <x-nav-link  class="nav-link active" :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                                <i class="ph-house"></i>
                                <span>
                                    {{ __('Dashboard') }}
                                </span>
                            </x-nav-link>
						</li>

						<!-- Forms -->
						<li class="nav-item-header">
							<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Forms</div>
							<i class="ph-dots-three sidebar-resize-show"></i>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-note-pencil"></i>
								<span>{{ __('ADPs') }}</span>
							</a>
							<ul class="nav-group-sub collapse">
                               <li class="nav-item">
                                    <x-nav-link :href="route('adps.index')" class="nav-link" :active="request()->routeIs('adps.index')">
                                        {{ __('ADPs List') }}
                                    </x-nav-link>
                                </li>
                                <li class="nav-item">
                                    <x-nav-link :href="route('adps.create')" class="nav-link" :active="request()->routeIs('adps.create')">
                                        {{ __('ADPs Create') }}
                                    </x-nav-link>
                                </li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-text-aa"></i>
								<span>{{ __('Schemes') }}</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item">
                                    <x-nav-link :href="route('schemes.index')" class="nav-link" :active="request()->routeIs('schemes.index')">
                                        {{ __('Schemes List') }}
                                    </x-nav-link>
                                </li>
                                <li class="nav-item">
                                    <x-nav-link :href="route('schemes.create')" class="nav-link" :active="request()->routeIs('schemes.create')">
                                        {{ __('Schemes Create') }}
                                    </x-nav-link>
								</li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-wrench"></i>
								<span>{{ __('Administration') }}</span>
							</a>
							<ul class="nav-group-sub collapse">
                                <li class="nav-item">
                                    <x-nav-link :href="route('categories.index')" class="nav-link" :active="request()->routeIs('categories.index')">
                                        {{ __('Categories List') }}
                                    </x-nav-link>
                                </li>
                                <li class="nav-item">
                                    <x-nav-link :href="route('categories.create')" class="nav-link" :active="request()->routeIs('categories.create')">
                                        {{ __('Categories Create') }}
                                    </x-nav-link>
                                </li>
							</ul>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-hand-pointing "></i>
								<span>{{ __('Tenders') }}</span>
							</a>
							<ul class="nav-group-sub collapse">
                                <li class="nav-item">
                                    <x-nav-link :href="route('tenders.index')" class="nav-link" :active="request()->routeIs('tenders.index')">
                                        {{ __('Tenders List') }}
                                    </x-nav-link>
                                </li>
                                <li class="nav-item">
                                    <x-nav-link :href="route('tenders.create')" class="nav-link" :active="request()->routeIs('tenders.create')">
                                        {{ __('Tenders Create') }}
                                    </x-nav-link>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-smiley-wink"></i>
								<span>{{ __('Portfolios') }}</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item">
                                    <x-nav-link :href="route('portfolios.index')" class="nav-link" :active="request()->routeIs('portfolios.index')">
                                        {{ __('Portfolios List') }}
                                    </x-nav-link>
                                </li>
                                <li class="nav-item">
                                    <x-nav-link :href="route('portfolios.create')" class="nav-link" :active="request()->routeIs('portfolios.create')">
                                        {{ __('Portfolios Create') }}
                                    </x-nav-link>
                                </li>
							</ul>
						</li>
                        <li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-browser"></i>
								<span>{{ __('NOCs') }}</span>
							</a>
							<ul class="nav-group-sub collapse">
                                <li class="nav-item">
                                    <x-nav-link :href="route('nocs.index')" class="nav-link" :active="request()->routeIs('nocs.index')">
                                        {{ __('NOCs List') }}
                                    </x-nav-link>
                                </li>
                                <li class="nav-item">
                                    <x-nav-link :href="route('nocs.create')" class="nav-link" :active="request()->routeIs('nocs.create')">
                                        {{ __('NOCs Create') }}
                                    </x-nav-link>
                                </li>
							</ul>
						</li>
						<!-- /forms -->

						<!-- Components -->
						<li class="nav-item-header">
							<div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Reports</div>
							<i class="ph-dots-three sidebar-resize-show"></i>
						</li>
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link">
								<i class="ph-squares-four"></i>
								<span>ADPS Dashboard</span>
							</a>
							<ul class="nav-group-sub collapse">
								<li class="nav-item">
                                    <x-nav-link :href="route('adps.dashboard')" class="nav-link" :active="request()->routeIs('adps.dashboard')">
                                        {{ __('ADPs Dashboard') }}
                                    </x-nav-link>
                                </li>
							</ul>
						</li>
						<!-- /components -->



					</ul>
				</div>
				<!-- /main navigation -->

			</div>
			<!-- /sidebar content -->

		</div>
		<!-- /main sidebar -->
