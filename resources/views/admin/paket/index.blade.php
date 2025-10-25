@section('title', 'Daftar Paket Layanan')
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
                                    <span class="h5">Data Lengkap Layanan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.paket.create') }}" class="btn btn-outline-primary">Tambah Layanan</a>
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

                            <h5 class="card-header">Detail Layanan</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Paket</th>
                                            <th>Aktif/Tayang</th>
                                            <th>Deskripsi</th>
                                            <th>Dibuat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse($pakets as $i => $p)
                                        <tr>
                                            <td>{{ $pakets->firstItem() + $i }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">{{ $p->nama_paket }}</p>
                                                        <small>Rp {{ number_format((float) $p->harga, 0, ',', '.') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="fw-semibold">{{ $p->active ? 'Active' : 'Tidak Active' }} / {{ $p->tayang ? 'Tayang' : 'Tidak Tayang' }}
                                            </td>
                                            <td class="small text-muted">{{ $p->deskripsi ?: '—' }}</td>
                                            <td class="small text-muted">{{ $p->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                                            <td>
                                                <a href="{{ route('admin.paket.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada paket.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    {{-- Links pagination --}}

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