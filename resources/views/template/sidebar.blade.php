<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path
                        opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                        fill="#161616" />
                    <path
                        opacity="0.06"
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                        fill="#161616" />
                    <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Urbanet</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item">
            <a href="{{ route('admin.dashboard') }}" class="menu-link menu-toggle">

                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div data-i18n="Dashboards">Dashboards</div>
                <!-- <div class="badge bg-danger rounded-pill ms-auto">5</div> -->

            </a>

        </li>

        <!-- Billing -->
        @auth
        @if(in_array(auth()->user()->role, ['Admin', 'Finance', 'CustomerCare']))
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Billing & Report">Billing &amp; Report</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.billing.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-file-dollar"></i>
                <div data-i18n="Billing">Billing</div>
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.billing.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.billing.index') }}" class="menu-link">
                        <div data-i18n="Tagihan Pelanggan">Tagihan Pelanggan</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @endauth


        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Pelanggan & Pelaporan">Pelanggan &amp; Pelaporan</span>
        </li>
        <!-- Layouts -->
        <li class="menu-item {{ request()->routeIs('admin.pelanggan.*', 'admin.referral.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex justify-content-between align-items-center">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Data Pelanggan">Data Pelanggan</div>
                @if ($pending_cust_referral > 0 || $pending_cust_regist > 0 )
                <span class="badge badge-center rounded-pill bg-primary">
                    <i class="ti ti-bell"></i>
                </span>
                @endif
            </a>

            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.pelanggan.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.pelanggan.index') }}" class="menu-link">
                        <div data-i18n="Daftar Pelanggan">Daftar Pelanggan</div>
                    </a>
                </li>

                @auth
                @if(in_array(auth()->user()->role, ['Admin', 'NOC', 'CustomerCare', 'Finance']))
                <!-- <li class="menu-item {{ request()->routeIs('admin.pelanggan.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.pelanggan.create') }}" class="menu-link">
                        <div data-i18n="Tambah Pelanggan">Tambah Pelanggan</div>
                    </a>
                </li> -->

                <li class="menu-item {{ request()->routeIs('admin.userregist.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.userregist.index') }}" class="menu-link">
                        <div data-i18n="Online Registrasi">Online Registrasi</div>
                        @if ($pending_cust_regist > 0)
                        <div class="badge bg-primary rounded-pill ms-auto">{{ $pending_cust_regist }}</div>
                        @endif
                    </a>
                </li>

                <li class="menu-item {{ request()->routeIs('admin.referral.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.referral.index') }}" class="menu-link">
                        <div data-i18n="Program Referral">Program Referral</div>
                        @if ($pending_cust_referral > 0)
                        <div class="badge bg-primary rounded-pill ms-auto">{{ $pending_cust_referral }}</div>
                        @endif

                    </a>
                </li>
                @endif
                @endauth
            </ul>
        </li>


        <li class="menu-item {{ request()->routeIs('admin.dashboard.ticket.*', 'admin.dashboard.ticket_hc.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="menu-icon tf-icons ti ti-messages me-2"></i>
                    <div data-i18n="Pelaporan">Pelaporan</div>
                </div>
                @if ($jumlah_ticket_open > 0 || $jumlah_ticket_hc_open > 0 )
                <span class="badge badge-center rounded-pill bg-primary">
                    <i class="ti ti-bell"></i>
                </span>
                @endif
            </a>


            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.dashboard.ticket.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard.ticket.index') }}" class="menu-link">
                        <div data-i18n="Laporan Gangguan">Laporan Gangguan</div>
                        @if ($jumlah_ticket_open > 0)
                        <div class="badge bg-primary rounded-pill ms-auto">{{ $jumlah_ticket_open }}</div>
                        @endif
                    </a>
                </li>
                <li class="menu-item  {{ request()->routeIs('admin.dashboard.ticket_hc.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard.ticket_hc.index') }}" class="menu-link">
                        <div data-i18n="Permintaan Instalasi">Permintaan Instalasi</div>
                        @if ($jumlah_ticket_hc_open > 0)
                        <div class="badge bg-primary rounded-pill ms-auto">{{ $jumlah_ticket_hc_open }}</div>
                        @endif
                    </a>
                </li>
            </ul>
        </li>


        @auth
        @if(in_array(auth()->user()->role, ['Admin', 'NOC', 'CustomerCare', 'Finance']))
        <!-- Apps & Pages -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Server & Layanan">Server &amp; Layanan</span>
        </li>

        <!-- Front Pages -->
        <li class="menu-item {{ request()->routeIs('admin.paket.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-files"></i>
                <div data-i18n="Paket Layanan">Paket Layanan</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.paket.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.paket.index') }}" class="menu-link">
                        <div data-i18n="Daftar Layanan">Daftar Layanan</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.paket.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.paket.create') }}" class="menu-link">
                        <div data-i18n="Tambah Layanan">Tambah Layanan</div>
                    </a>
                </li>

            </ul>
        </li>
        @endif
        @endauth
        @auth
        @if(in_array(auth()->user()->role, ['Admin', 'NOC']))
        <li class="menu-item {{ request()->routeIs('admin.server.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti ti-database"></i>
                <div data-i18n="Server / POP">Server / POP</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.server.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.server.index') }}" class="menu-link">
                        <div data-i18n="Data Server">Data Server</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.server.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.server.create') }}" class="menu-link">
                        <div data-i18n="Tambah Server">Tambah Server</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.odp.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti ti-layout-kanban"></i>
                <div data-i18n="ODP">ODP</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.odp.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.odp.index') }}" class="menu-link">
                        <div data-i18n="Data ODP">Data ODP</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.odp.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.odp.create') }}" class="menu-link">
                        <div data-i18n="Tambah ODP">Tambah ODP</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ request()->routeIs('admin.odc.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base ti ti-arrow-fork"></i>
                <div data-i18n="ODC">ODC</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.odc.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.odc.index') }}" class="menu-link">
                        <div data-i18n="Data ODC">Data ODC</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.odc.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.odc.create') }}" class="menu-link">
                        <div data-i18n="Tambah ODC">Tambah ODC</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @endauth
        <!-- Apps & Pages -->
        @auth
        @if(auth()->user()->role === 'Admin')
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="Team & Admin">Team &amp; Admin</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.team.*') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div data-i18n="Team & Admin">Team &amp; Admin</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ request()->routeIs('admin.team.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.team.index') }}" class="menu-link">
                        <div data-i18n="Data Team">Data Team</div>
                    </a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.team.create') ? 'active' : '' }}">
                    <a href="{{ route('admin.team.create') }}" class="menu-link">
                        <div data-i18n="Tambah Team">Tambah Team</div>
                    </a>
                </li>
            </ul>
        </li>
        @endif
        @endauth

        @auth
        @if(in_array(auth()->user()->role, ['Admin', 'Finance']))
        <!-- Apps & Pages -->
        <li class="menu-header small">
            <span class="menu-header-text" data-i18n="MISC">MISC</span>
        </li>
        <li class="menu-item {{ request()->routeIs('admin.setting.*') ? 'active open' : '' }}">
            <a href="{{ route('admin.setting.edit') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-settings"></i>
                <div data-i18n="Pengaturan">Pengaturan</div>
            </a>
        </li>
        @endif
        @endauth


</aside>