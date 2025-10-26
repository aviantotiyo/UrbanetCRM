@section('title', 'Detail ODP')
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
                                    <span class="h5">Data Lengkap ODP</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.odp.index') }}" class="btn btn-outline-primary">Kembali</a>
                                <a href="#" class="btn btn-primary">Edit</a>
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
                            <h5 class="card-header">Detail ODP Terpasang</h5>
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-12 col-md-6">

                                        <div class="mb-3">
                                            <div class="text-muted small">Kode ODP</div>
                                            <div class="fw-semibold">{{ $odp->kode_odp }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Nama ODP</div>
                                            <div class="fw-semibold">{{ $odp->nama_odp ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Alamat</div>
                                            <div class="fw-semibold">{{ $odp->alamat ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Provinsi / Kota / Kec / Desa</div>
                                            <div class="fw-semibold">
                                                {{ $odp->prov ?: '—' }} /
                                                {{ $odp->kota ?: '—' }} /
                                                {{ $odp->kec ?: '—' }} /
                                                {{ $odp->desa ?: '—' }}
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Lokasi (Gmap)</div>
                                            <div class="fw-semibold"><a href="{{ $odp->loc_odp ?: '—' }}" target="_blank">Maps</a></div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Latitude / Longitude</div>
                                            <div class="fw-semibold">{{ $odp->lat ?: '—' }}/{{ $odp->long ?: '—' }}</div>
                                        </div>
                                    </div>

                                    <div class="col-12 col-md-6">
                                        <div class="mb-3">
                                            <div class="text-muted small">Server / POP</div>
                                            <div class="fw-semibold">
                                                @if($odp->server)
                                                {{ $odp->server->nama_pop }}
                                                @if($odp->server->ip_public)
                                                <span class="text-muted">— {{ $odp->server->ip_public }}</span>
                                                @endif
                                                @else
                                                —
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div class="text-muted small">Port Capacity</div>
                                            <div class="fw-semibold">{{ $odp->port_cap ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Port Installed</div>
                                            <div class="fw-semibold">{{ $odp->port_install ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">VLAN</div>
                                            <div class="fw-semibold">{{ $odp->vlan ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Warna Core</div>
                                            <div class="fw-semibold">{{ $odp->warna_core ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Core Cable</div>
                                            <div class="fw-semibold">{{ $odp->core_cable ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Catatan</div>
                                            <div class="fw-semibold">{{ $odp->note ?: '—' }}</div>
                                        </div>
                                    </div>
                                </div>

                                <hr>
                                <div class="small text-muted">
                                    Dibuat: {{ $odp->created_at?->format('Y-m-d H:i') ?? '—' }} ·
                                    Diubah: {{ $odp->updated_at?->format('Y-m-d H:i') ?? '—' }}
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm mt-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h2 class="h6 mb-0">Port ODP</h2>
                                    <a href="{{ route('admin.odp_port.create', $odp->id) }}" class="btn btn-sm btn-primary">
                                        + Tambah Port
                                    </a>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-sm table-striped align-middle">
                                        <thead class="table-light">
                                            <tr>
                                                <th>#</th>
                                                <th>Port</th>
                                                <th>Status</th>
                                                <th>Client</th>
                                                <th>Dibuat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($ports as $i => $p)
                                            <tr>
                                                <td>{{ $i+1 }}</td>
                                                <td class="fw-semibold">{{ $p->port_numb }}</td>
                                                <td>
                                                    @php
                                                    $badge = match($p->status) {
                                                    'active' => 'success',
                                                    'reserved' => 'info',
                                                    'faulty' => 'warning',
                                                    'blocked' => 'secondary',
                                                    default => 'light',
                                                    };
                                                    @endphp
                                                    <span class="badge text-bg-{{ $badge }}">{{ $p->status }}</span>
                                                </td>
                                                <td>
                                                    @if($p->client)
                                                    {{-- Kalau kamu punya route detail client: admin.pelanggan.show --}}
                                                    <a href="{{ route('admin.pelanggan.show', $p->client->id) }}">
                                                        {{ $p->client->nopel }} — {{ $p->client->nama }}
                                                    </a>
                                                    @else
                                                    <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td class="small text-muted">{{ $p->created_at?->format('Y-m-d H:i') ?? '—' }}</td>
                                                <td>
                                                    <a href="{{ route('admin.odp_port.edit', $p->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center text-muted">Belum ada port pada ODP ini.</td>
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