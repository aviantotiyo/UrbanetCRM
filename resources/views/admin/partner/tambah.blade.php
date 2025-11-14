@section('title', 'Tambah Mitra Pembayaran')
@include('template.head')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
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
                                    <span class="h5">Tambah Mitra Pembayaran</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.partner.index') }}" class="btn btn-outline-primary">← Kembali</a>
                            </div>
                        </div>

                        {{-- Alert error --}}
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Periksa input:</strong>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <!-- <div class="row g-6"> -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form action="{{ route('admin.partner.store') }}" method="POST">
                                    @csrf
                                    <div class="row gx-3 gy-4">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label for="nama_partner" class="form-label">Nama Mitra</label>
                                                <input
                                                    type="text"
                                                    class="form-control @error('nama_partner') is-invalid @enderror"
                                                    name="nama_partner"
                                                    value="{{ old('nama_partner', $partner->nama_partner ?? '') }}"
                                                    placeholder="Cnth: Toko Sembako Srijaya"
                                                    required>
                                                @error('nama_partner')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="no_hp" class="form-label">Nomor HP</label>
                                                <input
                                                    type="text"
                                                    class="form-control @error('no_hp') is-invalid @enderror"
                                                    id="no_hp"
                                                    name="no_hp"
                                                    value="{{ old('no_hp', $partner->no_hp ?? '') }}"
                                                    required>
                                                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="alamat" class="form-label">Alamat</label>
                                                <textarea
                                                    class="form-control @error('alamat') is-invalid @enderror"
                                                    name="alamat"
                                                    rows="2">{{ old('alamat', $partner->alamat ?? '') }}</textarea>
                                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>


                                        <div class="col-md-6 col-12">
                                            <div class="mb-3">
                                                <label class="form-label">Provinsi</label>
                                                <select id="provinsi_pel" name="provinsi" class="form-select @error('provinsi') is-invalid @enderror">
                                                    <option value="">-- pilih provinsi --</option>
                                                    @foreach(($provinsiRaw ?? []) as $p)
                                                    <option value="{{ $p['name'] ?? '' }}" data-id="{{ $p['id'] ?? '' }}"
                                                        {{ old('provinsi')===($p['name'] ?? '') ? 'selected' : '' }}>
                                                        {{ $p['name'] ?? '' }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kabupaten</label>
                                                <select id="kabupaten_pel" name="kabupaten" class="form-select @error('kabupaten') is-invalid @enderror">
                                                    <option value="">-- pilih kabupaten/kota --</option>
                                                </select>
                                                @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Kecamatan</label>
                                                <select id="kecamatan_pel" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror">
                                                    <option value="">-- pilih kecamatan --</option>
                                                </select>
                                                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>

                                        <div class="col-12  mt-4">
                                            <div class="mb-3 col-md-4">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" name="status" required>
                                                    <option value="active">Aktif</option>
                                                    <option value="inactive">Tidak Aktif</option>
                                                </select>
                                            </div>

                                            <div class="mb-3 col-md-4">
                                                <label for="password" class="form-label">Password Login</label>
                                                <input type="text" class="form-control" name="password" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <!-- </div> -->
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



    @include('template.js.title-case')
    @include('template.js.no-hp')
    @include('template.js.select-city')
    @include('template.footer')

    <!-- Vendors JS -->
    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('assets/js/forms-selects.js') }}"></script>


    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>


</body>

</html>