@section('title', 'Tambah Data CSR')
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
                                    <span class="h5">Tambah Data Pelanggan CSR</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.pelanggan_csr.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                        <div class="row g-6">
                            <div class="col-md-6">
                                <div class="card">
                                    <form method="POST" action="{{ route('admin.pelanggan_csr.store') }}" enctype="multipart/form-data" novalidate>
                                        @csrf
                                        <h5 class="card-header">Data Penerima</h5>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <label class="form-label">Nama Penerima<span class="text-danger">*</span></label>
                                                <input id="title" name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama') }}" required>
                                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                            </div>



                                            <hr>
                                            <h5>Paket Internet</h5>
                                            <div class="mb-4">
                                                <label class="form-label">Paket</label>
                                                <select id="paket" name="paket" class="form-select @error('paket') is-invalid @enderror">
                                                    <option value="">— pilih paket —</option>
                                                    @foreach($pakets as $p)
                                                    <option value="{{ $p->nama_paket }}" {{ old('paket') === $p->nama_paket ? 'selected' : '' }}>
                                                        {{ $p->nama_paket }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('paket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                <div class="form-text">Pilih paket layanan dari master paket.</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Name Profile</label>
                                                <input id="name_profile" name="name_profile" type="text"
                                                    class="form-control @error('name_profile') is-invalid @enderror"
                                                    value="{{ old('name_profile') }}" placeholder="home-20m / biz-50m" readonly>
                                                @error('name_profile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Limit Radius</label>
                                                <input id="limit_radius" name="limit_radius" type="text"
                                                    class="form-control @error('limit_radius') is-invalid @enderror"
                                                    value="{{ old('limit_radius') }}" placeholder="512k/512k" readonly>
                                                @error('limit_radius')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <hr>
                                            <h5>Pilih ODP</h5>
                                            <div class="mb-4">
                                                <label class="form-label">ODP</label>
                                                <select name="odp_id"
                                                    id="select-odp"
                                                    class="form-select @error('odp_id') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($odps as $odp)
                                                    <option value="{{ $odp->id }}" {{ old('odp_id') == $odp->id ? 'selected' : '' }}>
                                                        {{ $odp->kode_odp ?? $odp->id }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('odp_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">ODP Port</label>
                                                <select name="odp_port_id"
                                                    id="select-odp-port"
                                                    class="form-select @error('odp_port_id') is-invalid @enderror"
                                                    required>
                                                    <option value="">-- Pilih --</option>
                                                    {{-- Port list diisi via JS --}}
                                                </select>
                                                @error('odp_port_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-4">
                                                    <label class="form-label">Latitude</label>
                                                    <input name="lat" type="text" class="form-control @error('lat') is-invalid @enderror"
                                                        value="{{ old('lat') }}" placeholder="">
                                                    @error('lat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    <div id="defaultFormControlHelp" class="form-text">
                                                        Contoh: -7.4063726
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-4">
                                                    <label class="form-label">Longitude</label>
                                                    <input name="long" type="text" class="form-control @error('long') is-invalid @enderror"
                                                        value="{{ old('long') }}" placeholder="">
                                                    @error('long')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    <div id="defaultFormControlHelp" class="form-text">
                                                        Contoh: 112.5841074
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-4">
                                            <label class="form-label">Alamat</label>
                                            <input id="title" name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
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

                                        <div class="mb-4">
                                            <label class="form-label">Status <span class="text-danger">*</span></label>
                                            <select name="status" class="form-select">
                                                <option value="">-- Pilih Status --</option>
                                                @foreach (['active', 'isolir', 'inactive'] as $s)
                                                <option value="{{ $s }}" {{ old('status', $item->status ?? '') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                                                @endforeach
                                            </select>
                                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>



                                        <div class="mb-3">
                                            <label for="foto_depan" class="form-label">Upload Foto Depan</label>
                                            <input type="file" name="foto_depan" id="foto_depan" accept="image/*" class="form-control">
                                            @error('foto_depan')
                                            <div class="text-danger small">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-flex gap-2 pt-2">
                                <button class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.pelanggan_csr.index') }}" class="btn btn-outline-secondary">Batal</a>
                            </div>
                            </form>
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

        @include('template.js.title-case')
        @include('template.js.paket')
        @include('template.js.no-hp')
        @include('template.js.nik')
        @include('template.js.select-city')
        @include('template.footer')
        @include('template.js.select-odp-csr')



</body>

</html>