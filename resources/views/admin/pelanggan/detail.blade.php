@section('title', 'Detail Planggan Pelanggan')
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
                                    <span class="h5">Detail Data Pelanggan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-primary">← Kembali</a>

                            </div>
                        </div>

                        {{-- Alert error --}}
                        @if ($errors->any())
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Periksa input!</strong>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="row g-6">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Data Pelanggan</h5>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">No. Pelanggan (NoPel)</div>
                                                <div class="fw-semibold">{{ $client->nopel }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Nama</div>
                                                <div class="fw-semibold">{{ $client->nama }}</div>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Email</div>
                                                <div class="fw-semibold">{{ $client->email ?: '—' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">No HP</div>
                                                <div class="fw-semibold">{{ $client->no_hp ?: '—' }}</div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">NIK</div>
                                            <div class="fw-semibold">{{ $client->nik ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Alamat</div>
                                            <div class="fw-semibold">{{ $client->alamat ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Kecamatan / Kabupaten / Provinsi</div>
                                            <div class="fw-semibold">
                                                {{ $client->kecamatan ?: '—' }} /
                                                {{ $client->kabupaten ?: '—' }} /
                                                {{ $client->provinsi ?: '—' }}
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Lokasi Client</div>
                                            <div class="fw-semibold"><a href="{{ $client->loc_client ?: '—' }}" target="_blank">Maps</a> </div>
                                        </div>
                                        <hr class="mb-3">
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Paket</div>
                                                <div class="fw-semibold">{{ $client->paket ?: '—' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Tagihan</div>
                                                <div class="fw-semibold">Rp {{ number_format((float) $client->tagihan, 0, ',', '.') }}</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Data Teknis Pelanggan</h5>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="row g-3">
                                                <div class="col-md-6 mb-3">
                                                    <div class="text-muted small">Status</div>
                                                    <span class="badge text-bg-secondary">{{ $client->status }}</span>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="text-muted small">Active User</div>
                                                    <div class="fw-semibold">
                                                        {{ $client->active_user ? \Carbon\Carbon::parse($client->active_user)->format('Y-m-d H:i') : '—' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">User PPPoE</div>
                                                <div class="fw-semibold">{{ $client->user_pppoe }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Pass PPPoE</div>
                                                <div class="fw-semibold">{{ $client->pass_pppoe }}</div>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Profile / Limit Radius</div>
                                                <div class="fw-semibold">
                                                    {{ $client->name_profile ?: '—' }} / {{ $client->limit_radius ?: '—' }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">ODP ID / ODP Port ID</div>
                                                <div class="fw-semibold">
                                                    {{ $client->odp?->kode_odp ?? '—' }} / {{ $client->odpPort?->port_numb ?? '—' }}
                                                </div>
                                            </div>
                                        </div>


                                        <div class="mb-3">
                                            <div class="text-muted small">Catatan</div>
                                            <div class="fw-semibold">{{ $client->note ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Tag</div>
                                            <div class="fw-semibold">{{ $client->tag ?: '—' }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="text-muted small">Foto Depan</div>
                                            @if ($client->foto_depan)
                                            <div class="fw-semibold mb-2">{{ $client->foto_depan }}</div>
                                            {{-- Jika nanti berupa URL/asset, bisa tampilkan img: --}}
                                            {{-- <img class="img-fluid rounded border" src="{{ asset($client->foto_depan) }}" alt="Foto Depan"> --}}
                                            @else
                                            <div class="fw-semibold">—</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12 d-flex gap-2 pt-2">
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="#" class="btn btn-outline-secondary">Batal</a>
                                </div> -->

                            </div>

                            <!-- Disini -->


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