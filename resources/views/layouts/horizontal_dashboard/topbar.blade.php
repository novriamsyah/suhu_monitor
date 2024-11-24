<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <ul class="menu-inner">
            <!-- Dashboards -->
            <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
                <a href="{{ route('dashboard.index') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-smart-home"></i>
                    <div data-i18n="Dashboards">Dashboards</div>
                </a>
            </li>

            <li class="menu-item {{ Str::contains(request()->url(), ['data/all/report']) ? 'active open' : '' }}">
                <a href="{{ route('all.report.page') }}" class="menu-link">
                    <i class="menu-icon tf-icons ti ti-report"></i>
                    <div data-i18n="Report">Report</div>
                </a>
            </li>
            
            <!-- <li class="menu-item {{ Str::contains(request()->url(), ['data/all/report', 'data/energi/report']) ? 'active open' : '' }}">
                <a href="javascript:void(0)" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons ti ti-report"></i>
                    <div data-i18n="Report">Report</div>
                </a>
                <ul class="menu-sub">
                    <li class="menu-item {{ request()->is('data/all/report') ? 'active' : '' }}">
                        <a href="{{ route('all.report.page') }}" class="menu-link">
                            <i class="menu-icon tf-icons ti ti-chart-pie-2"></i>
                            <div data-i18n="All">All</div>
                        </a>
                    </li>
                </ul>
            </li> -->
        </ul>
    </div>
</aside>