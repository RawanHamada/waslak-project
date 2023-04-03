<div id="scrollbar">
    <div class="container-fluid">

        <div id="two-column-menu">
        </div>
        <ul class="navbar-nav" id="navbar-nav">
            <li class="menu-title"><span data-key="t-menu">{{ __('site.menu') }}</span></li>
            <li class="nav-item">
                <a @if (request()->routeIs('admin.home') ) class="nav-link menu-link collapsed active" aria-expanded="true" @endif class="nav-link menu-link" href="#sidebarDashboards" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarDashboards">
                    <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">{{ __('site.dashboard') }}</span>
                </a>
                <div @if (request()->routeIs('admin.home') ) class="menu-dropdown collapse show" @endif class="collapse menu-dropdown" id="sidebarDashboards">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a @if (request()->routeIs('admin.home') ) class="nav-link active" @endif href="{{ route('admin.home') }}" class="nav-link" data-key="t-analytics">
                                {{ __('site.home') }} </a>
                        </li>


                    </ul>
                </div>
            </li> <!-- end Dashboard Menu -->

            <li class="nav-item">
                <a @if (request()->routeIs('admin.users') ) class="nav-link menu-link collapsed active" aria-expanded="true" @endif
                    class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button" aria-expanded="false"
                    aria-controls="sidebarApps">
                    <i class="ri-account-circle-line"></i> <span data-key="t-apps">{{ __('site.users') }}</span>
                </a>
                <div @if (request()->routeIs('admin.users') ) class="menu-dropdown collapse show" @endif class="collapse menu-dropdown" id="sidebarApps">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a @if (request()->routeIs('admin.users') ) class="nav-link active" @endif
                                href="{{ route('admin.users') }}" class="nav-link" data-key="t-calendar">
                                {{ __('site.all_users ') }}</a>
                        </li>


                    </ul>
                </div>
            </li>

            <li class="nav-item">
                <a @if (request()->routeIs('orders') ) class="nav-link menu-link collapsed active" aria-expanded="true" @endif class="nav-link menu-link" href="#sidebarLayouts" data-bs-toggle="collapse" role="button"
                     aria-controls="sidebarLayouts">
                    <i class="ri-layout-3-line"></i> <span data-key="t-layouts">{{ __('site.orders ') }}</span>
                </a>
                <div @if (request()->routeIs('orders') ) class="menu-dropdown collapse show" @endif class="collapse menu-dropdown" id="sidebarLayouts">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item" >
                            <a @if (request()->routeIs('orders') ) class="nav-link active" @endif href="{{ route('orders') }}" class="nav-link"
                                data-key="t-horizontal">{{ __('site.all_orders ') }}</a>
                        </li>


                    </ul>
                </div>
            </li> <!-- end Dashboard Menu -->

            <li class="menu-title"><i class="ri-more-fill"></i> <span
                    data-key="t-pages">{{ __('site.settings') }}</span></li>




            <li class="nav-item">
                <a @if (request()->routeIs('terms.create') ) class="nav-link menu-link collapsed active" aria-expanded="true" @endif class="nav-link menu-link" href="#sidebarLanding" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarLanding">
                    <i class="ri-rocket-line"></i> <span data-key="t-landing">{{ __('site.terms') }}</span>
                </a>
                <div @if (request()->routeIs('terms.create') ) class="menu-dropdown collapse show" @endif class="collapse menu-dropdown" id="sidebarLanding">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a @if (request()->routeIs('terms.create') ) class="nav-link active" @endif href="{{ route('terms.create') }}" class="nav-link"
                                data-key="t-one-page">{{ __('site.add_term_and_policy ') }}</a>
                        </li>
                        <li class="nav-item">
    <a @if (request()->routeIs('terms.index') ) class="nav-link active" @endif href="{{ route('terms.index') }}" class="nav-link" data-key="t-one-page">
        {{ __('site.all_term_and_policy ') }} </a>
</li>

                    </ul>
                </div>

                {{-- <div @if (request()->routeIs('terms.index') ) class="menu-dropdown collapse show" @endif class="collapse menu-dropdown" id="sidebarLanding"> --}}
                    {{-- <ul class="nav nav-sm flex-column"> --}}
{{--                          --}}
{{--                          --}}
{{--                          --}}
{{--                          --}}

                    {{-- </ul> --}}
                {{-- </div> --}}
            </li>



            <li class="nav-item">
                <a @if (request()->routeIs('complaint.index') ) class="nav-link menu-link collapsed active" aria-expanded="true" @endif class="nav-link menu-link collapsed" href="#sidebarCharts" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarCharts">
                    <i class="ri-pie-chart-line"></i> <span data-key="t-charts">{{ __('site.complaints') }}</span>
                </a>
                <div @if (request()->routeIs('complaint.index') ) class="menu-dropdown collapse show" @endif class="collapse menu-dropdown" id="sidebarCharts">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a @if (request()->routeIs('complaint.index') ) class="nav-link active" @endif href="{{ route('complaint.index') }}" class="nav-link" data-key="t-line">
                                {{ __('site.all_complaints') }}
                            </a>
                        </li>


                    </ul>
                </div>
            </li>


            <li class="nav-item">
                <a @if (request()->routeIs('market.testindex') ) class="nav-link menu-link collapsed active" aria-expanded="true" @endif class="nav-link menu-link collapsed" href="#sidebarForms" data-bs-toggle="collapse" role="button"
                    aria-expanded="false" aria-controls="sidebarForms">
                    <i class="ri-file-list-3-line"></i> <span data-key="t-forms">{{ __('site.markets') }}</span>
                </a>
                <div @if (request()->routeIs('market.create') ) class="menu-dropdown collapse show" @endif class="collapse menu-dropdown" id="sidebarForms">
                    <ul class="nav nav-sm flex-column">
                        <li class="nav-item">
                            <a @if (request()->routeIs('market.create') ) class="nav-link active" @endif href="{{ route('market.create') }}" class="nav-link"
                                data-key="t-basic-elements">{{ __('site.add_markets') }}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a @if (request()->routeIs('market.testindex') ) class="nav-link active" @endif href="{{ route('market.testindex') }}" class="nav-link"
                                data-key="t-basic-elements">{{ __('site.all_markets') }}
                            </a>
                        </li>

                    </ul>
                </div>
            </li>




        </ul>
    </div>
    <!-- Sidebar -->
</div>
