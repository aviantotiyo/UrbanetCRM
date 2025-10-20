@section('title', 'Tambah Data Pelanggan')
@include('template.head')
<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" /> -->

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />

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
                                    <span class="h5">Tambah Data Pelanggan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-primary">← Kembali</a>
                            </div>
                        </div>

                        <div class="container-xxl flex-grow-1 container-p-y">
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <div class="card">
                                        <form method="POST" action="{{ route('admin.pelanggan.store') }}" novalidate>
                                            @csrf
                                            <h5 class="card-header">Data Pelanggan</h5>
                                            <div class="card-body">
                                                <div class="mb-4">
                                                    <label class="form-label">Name <span class="text-danger">*</span></label>
                                                    <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                                        value="{{ old('nama') }}" required>
                                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    <div id="defaultFormControlHelp" class="form-text">
                                                        Nama sesuai KTP.
                                                    </div>
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">NIK <span class="text-danger">*</span></label>
                                                    <input name="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                                        value="{{ old('nik') }}">
                                                    @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">No HP</label>
                                                    <input name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                        value="{{ old('no_hp') }}" placeholder="628xxxxxxxxxx">
                                                    @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Email</label>
                                                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                        value="{{ old('email') }}" placeholder="email@domain.com">
                                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <hr>
                                                <h5>Paket Berlangganan</h5>
                                                <div class="mb-4">
                                                    <label class="form-label">Paket</label>
                                                    <input name="paket" type="text" class="form-control @error('paket') is-invalid @enderror"
                                                        value="{{ old('paket') }}" placeholder="Home 20M / Biz 50M">
                                                    @error('paket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Tagihan</label>
                                                    <input name="tagihan" type="text" class="form-control @error('tagihan') is-invalid @enderror"
                                                        value="{{ old('tagihan') }}" placeholder="250000">
                                                    @error('tagihan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Name Profile</label>
                                                    <input name="name_profile" type="text" class="form-control @error('name_profile') is-invalid @enderror"
                                                        value="{{ old('name_profile') }}" placeholder="home-20m / biz-50m">
                                                    @error('name_profile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="mb-4">
                                                    <label class="form-label">Limit Radius</label>
                                                    <input name="limit_radius" type="text" class="form-control @error('limit_radius') is-invalid @enderror"
                                                        value="{{ old('limit_radius') }}" placeholder="512k/512k">
                                                    @error('limit_radius')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                            </div>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header">Lokasi Pelanggan</h5>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <label class="form-label">Lokasi Client (Link Gmap)</label>
                                                <input name="loc_client" type="text" class="form-control @error('loc_client') is-invalid @enderror"
                                                    value="{{ old('loc_client') }}" placeholder="">
                                                @error('loc_client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                <div id="defaultFormControlHelp" class="form-text">
                                                    Contoh: https://maps.app.goo.gl/YZKJaJuhwXUFCJs27
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Alamat</label>
                                                <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                    value="{{ old('alamat') }}">
                                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label" for="provinsi_pel">Provinsi</label>
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

                                            <div class="mb-4">
                                                <label class="form-label" for="kabupaten_pel">Kabupaten/Kota</label>
                                                <select id="kabupaten_pel" name="kabupaten" class="form-select @error('kabupaten') is-invalid @enderror">
                                                    <option value="">-- pilih kabupaten/kota --</option>
                                                </select>
                                                @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="kecamatan_pel">Kecamatan</label>
                                                <select id="kecamatan_pel" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror">
                                                    <option value="">-- pilih kecamatan --</option>
                                                </select>
                                                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex gap-2 pt-2">
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary">Batal</a>
                                </div>
                                </form>
                            </div>

                            <!-- Disini -->

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



        @include('template.js.select-city')
        @include('template.footer')
</body>

</html>