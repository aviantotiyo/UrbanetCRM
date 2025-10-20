@section('title', 'Daftar Pelanggan')
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
                        {{-- Filter/Search bar --}}
                        <form method="GET" action="{{ route('admin.pelanggan.index') }}" class="card mb-3 border-0 shadow-sm">
                            <div class="card-body py-3">
                                <div class="row g-2 align-items-end">
                                    <div class="col-md-4">
                                        <label class="form-label mb-1">Cari</label>
                                        <input
                                            type="search"
                                            name="q"
                                            value="{{ $q ?? '' }}"
                                            class="form-control"
                                            placeholder="Cari nama / NoPel / HP / email / alamat"
                                            id="client-search-input">
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="">— Semua status —</option>
                                            @foreach($statusOptions as $st)
                                            <option value="{{ $st }}" {{ ($status ?? '') === $st ? 'selected' : '' }}>
                                                {{ ucfirst($st) }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label mb-1">Paket</label>
                                        <select name="paket" class="form-select">
                                            <option value="">— Semua paket —</option>
                                            @foreach($paketOptions as $opt)
                                            <option value="{{ $opt }}" {{ ($paket ?? '') === $opt ? 'selected' : '' }}>
                                                {{ $opt }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label mb-1">Kabupaten</label>
                                        <select name="kecamatan" class="form-select">
                                            <option value="">— Semua kec —</option>
                                            @foreach($kecamatanOptions as $opt)
                                            <option value="{{ $opt }}" {{ ($kabupaten ?? '') === $opt ? 'selected' : '' }}>
                                                {{ $opt }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 d-flex gap-2 mt-2">
                                        <button class="btn btn-primary">
                                            <i class="ti ti-search me-1"></i> Terapkan
                                        </button>
                                        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary">
                                            Reset
                                        </a>

                                        <div class="ms-auto small text-muted align-self-center">
                                            Menampilkan {{ $clients->firstItem() ?? 0 }}–{{ $clients->lastItem() ?? 0 }} dari {{ $clients->total() }} data
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="card">
                            <h5 class="card-header">Data Pelanggan</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama</th>
                                            <th>Paket</th>
                                            <th>Lokasi</th>
                                            <th>Kontak</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @forelse($clients as $i => $c)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium"><a href="{{ route('admin.pelanggan.show', $c->id) }}"> {{ $c->nopel }}</a></p>
                                                        <small>{{ $c->nama }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">{{ $c->paket }}</p>
                                                        <small>Rp {{ number_format((float) $c->tagihan, 0, ',', '.') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">{{ $c->alamat }}</p>
                                                        <small>{{ $c->kecamatan }}/{{ $c->kabupaten }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $c->no_hp }}</td>
                                            <td><span class="badge text-bg-secondary">{{ $c->status }}</span></td>

                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-pencil me-1"></i> Edit</a>
                                                        <a class="dropdown-item" href="javascript:void(0);"><i class="ti ti-trash me-1"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada data.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    {{-- Links pagination --}}
                                    {{ $clients->onEachSide(1)->withQueryString()->links() }}
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