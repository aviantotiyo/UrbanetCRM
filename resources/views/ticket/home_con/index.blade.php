@section('title', 'Daftar Home Connection')
@include('template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class=" layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('template.sidebar')
            <div class="menu-mobile-toggler d-xl-none rounded-1">
                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large text-bg-secondary p-2 rounded-1">
                    <i class="ti tabler-menu icon-base"></i>
                    <i class="ti tabler-chevron-right icon-base"></i>
                </a>
            </div>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                @include('template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div
                            class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-6 row-gap-4">
                            <div class="d-flex flex-column justify-content-center">
                                <div class="mb-1">
                                    <span class="h5">Data Instalasi Baru</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <!-- <a href="{{ route('admin.dashboard.ticket.create') }}" class="btn btn-outline-primary">Tambah Data</a> -->
                            </div>
                        </div>
                        {{-- Alert sukses --}}
                        @if (session('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        {{-- (Opsional) Alert error umum --}}
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! session('error') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif


                        <div class="card">
                            <h5 class="card-header">Data Instalasi Baru</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Client</th>
                                            <th>Client</th>
                                            <th>Teknisi</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody class="table-border-bottom-0">
                                        @forelse($tickets as $ticket)
                                        <tr>
                                            <td>

                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">
                                                            <a href="{{ route('admin.dashboard.ticket_hc.edit', $ticket->id) }}">{{ $ticket->ticket_code }}</a>
                                                        </p>
                                                        <small>{{ \Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y H:i') }} WIB</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">
                                                            <a href="{{ route('admin.pelanggan.show', $ticket->client->id) }}">
                                                                {{ $ticket->client->nama ?? '-' }}</a>
                                                        </p>
                                                        <small>{{ $ticket->client->nopel ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">
                                                            {{ $ticket->client->alamat ?? '-' }}
                                                        </p>
                                                        <small>{{ $ticket->client->provinsi ?? '-' }}/{{ $ticket->client->kabupaten ?? '-' }}/{{ $ticket->client->kecamatan ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <!-- Menampilkan nama installer dari relasi DataTeamSite -->
                                                @if($ticket->teamSite)
                                                {{ $ticket->teamSite->user->name ?? 'Installer Tidak Ditemukan' }}
                                                @else
                                                Belum Ada Installer
                                                @endif
                                            </td>
                                            <td>
                                                {{ $ticket->status }}
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">

                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.pelanggan.show', $ticket->client->id) }}"><i class="ti ti-search me-1"></i> Detail User</a>
                                                            <a class="dropdown-item" href="{{ route('admin.dashboard.ticket_hc.edit', $ticket->id) }}"><i class="ti ti-edit me-1"></i> Edit/Process</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">Tidak ada data tiket tersedia.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>


                                </table>
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    {{-- Links pagination --}}
                                    {{ $tickets->links() }}
                                </div>
                            </div>

                        </div>

                    </div>
                    <!-- / Content -->

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>

        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>
    <!-- / Layout wrapper -->

    @include('template.footer')

</body>

</html>