@section('title', 'Detail ODC')
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
                                    <span class="h5">Data Lengkap ODC</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.odc.index') }}" class="btn btn-outline-primary">Kembali</a>
                                <a href="{{ route('admin.odc.edit', $odc->id) }}" class="btn btn-primary">Edit</a>
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
                            <h5 class="card-header">Detail ODC Terpasang</h5>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-6">

                                        <div class="mb-3">
                                            <div class="text-muted small">Kode ODC</div>
                                            <div class="fw-semibold">{{ $odc->kode_odc }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Nama ODC</div>
                                            <div class="fw-semibold">{{ $odc->nama_odc ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Alamat</div>
                                            <div class="fw-semibold">{{ $odc->alamat ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Lokasi</div>
                                            <div class="fw-semibold">{{ $odc->desa ?: '—' }}/{{ $odc->kec ?: '—' }}/{{ $odc->kota ?: '—' }}/{{ $odc->prov ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Server / POP</div>
                                            <div class="fw-semibold">
                                                @if($odc->server)
                                                {{ $odc->server->nama_pop }}
                                                @if($odc->server->ip_public)
                                                <span class="text-muted">— {{ $odc->server->ip_public }}</span>
                                                @endif
                                                @else
                                                —
                                                @endif
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <div class="text-muted small">Peta</div>
                                            <div class="fw-semibold"><a href="{{ $odc->loc_odp ?: '—' }}" target="_blank">Google Maps</a> / {{ $odc->lat ?: '—' }} / {{ $odc->long ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Rasio</div>
                                            <div class="fw-semibold">{{ $odc->rasio ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Port Capacity / Installed</div>
                                            <div class="fw-semibold">{{ $odc->port_cap ?: '—' }} / {{ $odc->port_install ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Warna Core</div>
                                            <div class="fw-semibold">{{ $odc->warna_core ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Core Cable</div>
                                            <div class="fw-semibold">{{ $odc->core_cable ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Gambar</div>
                                            <div class="fw-semibold">
                                                @if($odc->image)
                                                <a href="{{ $odc->image }}" target="_blank" class="text-decoration-none">Lihat gambar</a>
                                                @else
                                                —
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <div class="text-muted small">Catatan</div>
                                            <div class="fw-semibold">{{ $odc->note ?: '—' }}</div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="small text-muted">
                                    Dibuat: {{ $odc->created_at?->format('Y-m-d H:i') ?? '—' }} ·
                                    Diubah: {{ $odc->updated_at?->format('Y-m-d H:i') ?? '—' }}
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm mt-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h2 class="h6 mb-0">Daftar Port</h2>
                                    <a href="{{ route('admin.odc_port.create', $odc->id) }}" class="btn btn-sm btn-primary">+ Tambah Port</a>
                                </div>

                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Port</th>
                                                <th>Status</th>
                                                <th>ODP Tujuan</th>
                                                <th>Aksi</th> {{-- kolom baru --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($odc->ports as $i => $p)
                                            <tr>
                                                <td>{{ $i+1 }}</td>
                                                <td class="fw-semibold">{{ $p->port_numb }}</td>
                                                <td>{{ ucfirst($p->status) }}</td>
                                                <td>
                                                    @if($p->odp)
                                                    <a href="{{ route('admin.odp.show', $p->odp->id) }}" class="text-decoration-none">
                                                        <span class="fw-semibold">{{ $p->odp->kode_odp }}</span>
                                                        @if($p->odp->nama_odp)
                                                        <span class="text-muted"> — {{ $p->odp->nama_odp }}</span>
                                                        @endif
                                                    </a>
                                                    @else
                                                    <span class="text-muted">—</span>
                                                    @endif
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.odc_port.edit', $p->id) }}"
                                                        class="btn btn-sm btn-outline-primary">
                                                        Edit
                                                    </a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Belum ada port untuk ODC ini.</td>
                                            </tr>
                                            @endforelse
                                        </tbody>

                                    </table>
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