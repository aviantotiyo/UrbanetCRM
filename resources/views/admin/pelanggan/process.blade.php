@section('title', 'Proses Pelanggan')
@include('template.head')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />

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
                                    <span class="h5">Proses Pelanggan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-primary">← Kembali</a>
                                <a class="btn btn-primary" href="{{ route('admin.pelanggan.show', $client->id) }}">Detail Pelanggan</a>
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
                                                <div class="text-muted small">No. Pelanggan</div>
                                                <div class="fw-semibold">{{ $client->nopel }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Nama</div>
                                                <div class="fw-semibold">{{ $client->nama }}</div>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">No HP</div>
                                                <div class="fw-semibold">{{ $client->no_hp ?: '—' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">NIK</div>
                                                <div class="fw-semibold">{{ $client->nik ?: '—' }}</div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <div class="text-muted small">Alamat</div>
                                            <div class="fw-semibold">{{ $client->alamat ?: '—' }}
                                                <br>{{ $client->kecamatan ?: '—' }}/{{ $client->kabupaten ?: '—' }}/{{ $client->provinsi ?: '—' }}
                                                <br><a href="{{ $client->loc_client ?: '—' }}">Map</a>
                                            </div>
                                        </div>
                                        <hr>
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
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">User PPPoE</div>
                                                <div class="fw-semibold">{{ $client->user_pppoe ?: '—' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Password PPPoE</div>
                                                <div class="fw-semibold">{{ $client->pass_pppoe ?: '—' }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Proses Pelanggan</h5>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <div class="text-muted small">Prorata Non-promo</div>
                                                <div class="fw-semibold" id="prorataResult">Rp 0</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="text-muted small">Sisa hari</div>
                                                <div class="fw-semibold"><span id="selisihResult">-</span></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <hr>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <div class="text-muted small">Promo hingga</div>
                                                <div class="fw-semibold"><span id="masaPromoResult">-</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-muted small">Tagihan kedepan</div>
                                                <div class="fw-semibold"><span id="tagihanKedepanResult">-</span></div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="text-muted small">Total tagihan</div>
                                                <div class="fw-semibold"><span id="totalTagihanResult">Rp 0</span></div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <hr>
                                        </div>
                                        <form method="POST" action="{{ route('admin.pelanggan.process.store', $client->id) }}" novalidate>
                                            @csrf

                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Pilih ODP <span class="text-danger">*</span></label>
                                                    <select id="select-odp" name="odp_id" class="form-select @error('odp_id') is-invalid @enderror" required>
                                                        <option value="">-- pilih ODP --</option>
                                                        @foreach($odps as $o)
                                                        <option value="{{ $o->id }}"
                                                            {{ old('odp_id', $client->odp_id) === $o->id ? 'selected' : '' }}>
                                                            {{ $o->kode_odp }}{{ $o->nama_odp ? ' — '.$o->nama_odp : '' }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('odp_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>

                                                <div class="col-md-6">
                                                    <label class="form-label">Pilih Port <span class="text-danger">*</span></label>
                                                    <select id="select-port" name="odp_port_id" class="form-select @error('odp_port_id') is-invalid @enderror" required>
                                                        <option value="">-- pilih port --</option>
                                                        {{-- opsi akan diisi via JS berdasarkan ODP --}}
                                                    </select>
                                                    @error('odp_port_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    <div class="form-text">Hanya port <b>available</b> yang ditampilkan.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Promo / Day</label>
                                                    <input type="number" min="0" id="promo_day" name="promo_day" class="form-control" value="0" required>
                                                    <div class="form-text">Masukkan jumlah hari promo. 0 = tanpa promo.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="promo_start" class="form-label">Tanggal Aktif</label>
                                                    <input type="text"
                                                        class="form-control datepicker @error('promo_start') is-invalid @enderror"
                                                        id="flatpickr-date"
                                                        name="promo_start"
                                                        value="{{ old('promo_start') }}"
                                                        placeholder="Pilih tanggal"
                                                        autocomplete="off" required>
                                                    @error('promo_start')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                            </div>

                                            <div class="d-flex gap-2 mt-4">
                                                <button class="btn btn-primary">Simpan</button>
                                                <!-- <a class="btn btn-outline-secondary" href="{{ route('admin.pelanggan.show', $client->id) }}">Batal</a> -->
                                            </div>
                                        </form>
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


            <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
            <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
            @include('template.js.calculator')
            @include('template.js.calculator2')
            @include('template.footer')
            @include('template.js.process-pelanggan')
</body>

</html>