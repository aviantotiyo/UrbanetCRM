@section('title', 'Edit Data Pelanggan CSR')
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
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
                            <div>
                                <h4 class="fw-bold">Tambah Data Pelanggan</h4>
                            </div>
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" form="client-edit-form" class="btn btn-outline-danger">Hapus Image</button>
                                <a href="{{ route('admin.pelanggan_csr.index') }}" class="btn btn-outline-primary">← Kembali</a>
                            </div>
                        </div>

                        {{-- Flash success --}}
                        @if (session('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form id="client-edit-form" method="POST" action="{{ route('admin.pelanggan_csr.update', $item->id) }}" enctype="multipart/form-data" novalidate>
                            @csrf

                            <div class="row">
                                {{-- Kolom Kiri --}}
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <h5 class="card-header">Data Pelanggan</h5>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <label class="form-label">Name Penerima<span class="text-danger">*</span></label>
                                                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama', $item->nama) }}" required data-titlecase>
                                                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <hr>
                                            <h5>PPPoE Detail</h5>
                                            <div class="mb-4">
                                                <label class="form-label">User PPPoE</label>
                                                <input name="user_pppoe" type="text" class="form-control @error('user_pppoe') is-invalid @enderror"
                                                    value="{{ old('user_pppoe', $item->user_pppoe) }}" readonly data-titlecase>
                                                @error('user_pppoe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>
                                            <div class="mb-4">
                                                <label class="form-label">Pass PPPoE</label>
                                                <input name="pass_pppoe" type="text" class="form-control @error('pass_pppoe') is-invalid @enderror"
                                                    value="{{ old('pass_pppoe', $item->pass_pppoe) }}" readonly data-titlecase>
                                                @error('pass_pppoe')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <hr>
                                            <h5>Paket Internet</h5>
                                            <div class="mb-4">
                                                <label class="form-label">Paket</label>
                                                <select id="paket" name="paket" class="form-select @error('paket') is-invalid @enderror">
                                                    <option value="">— pilih paket —</option>
                                                    @foreach($pakets as $p)
                                                    <option value="{{ $p->nama_paket }}" {{ old('paket', $item->paket) === $p->nama_paket ? 'selected' : '' }}>
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
                                                    value="{{ old('name_profile', $item->name_profile) }}" placeholder="home-20m / biz-50m" readonly>
                                                @error('name_profile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Limit Radius</label>
                                                <input id="limit_radius" name="limit_radius" type="text"
                                                    class="form-control @error('limit_radius') is-invalid @enderror"
                                                    value="{{ old('limit_radius', $item->limit_radius) }}" placeholder="512k/512k" readonly>
                                                @error('limit_radius')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <hr>
                                            <h5>Pilih ODP</h5>
                                            <div class="mb-4">
                                                <label class="form-label">ODP</label>
                                                <select name="odp_id"
                                                    id="select-odp"
                                                    class="form-select @error('odp_id') is-invalid @enderror"
                                                    data-selected="{{ old('odp_id', $item->odp_id) }}"
                                                    required>
                                                    <option value="">-- Pilih --</option>
                                                    @foreach ($odps as $odp)
                                                    <option value="{{ $odp->id }}" {{ old('odp_id', $item->odp_id) == $odp->id ? 'selected' : '' }}>
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
                                                    data-selected="{{ old('odp_port_id', $item->odp_port_id) }}"
                                                    required>
                                                    <option value="">-- Pilih --</option>
                                                    {{-- Port list akan diisi lewat JavaScript --}}
                                                </select>
                                                @error('odp_port_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>


                                        </div>
                                        <div class="card-footer d-flex gap-2">
                                            <button class="btn btn-primary">Update</button>
                                            <a href="#" class="btn btn-outline-secondary">Batal</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="col-md-6 mb-4">
                                    <div class="card">
                                        <h5 class="card-header">Lokasi Pelanggan</h5>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <label class="form-label">Lokasi Client (Link Gmap)</label>
                                                <input name="loc_client" type="text" class="form-control @error('loc_client') is-invalid @enderror"
                                                    value="{{ old('loc_client', $item->loc_client) }}" placeholder="https://maps.app.goo.gl/...">
                                                @error('loc_client')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Alamat</label>
                                                <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                    value="{{ old('alamat', $item->alamat) }}">
                                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="mb-4">
                                                        <label class="form-label">Latitude</label>
                                                        <input name="lat" type="text" class="form-control @error('lat') is-invalid @enderror"
                                                            value="{{ old('lat', $item->lat) }}">
                                                        @error('lat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="mb-4">
                                                        <label class="form-label">Longitude</label>
                                                        <input name="long" type="text" class="form-control @error('long') is-invalid @enderror"
                                                            value="{{ old('long', $item->long) }}">
                                                        @error('long')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Provinsi -->
                                            <div class="mb-4">
                                                <label class="form-label" for="provinsi_pel">Provinsi</label>
                                                <select id="provinsi_pel" name="provinsi" class="form-select @error('provinsi') is-invalid @enderror">
                                                    <option value="">-- pilih provinsi --</option>
                                                    @foreach($provinsiRaw as $prov)
                                                    <option
                                                        value="{{ $prov['name'] }}"
                                                        data-id="{{ $prov['id'] }}"
                                                        {{ old('provinsi', $item->provinsi) === $prov['name'] ? 'selected' : '' }}>
                                                        {{ $prov['name'] }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('provinsi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Kabupaten -->
                                            <div class="mb-4">
                                                <label class="form-label" for="kabupaten_pel">Kabupaten/Kota</label>
                                                <select
                                                    id="kabupaten_pel"
                                                    name="kabupaten"
                                                    class="form-select @error('kabupaten') is-invalid @enderror"
                                                    data-selected="{{ old('kabupaten', $item->kabupaten) }}">
                                                    <option value="">-- pilih kabupaten/kota --</option>
                                                    {{-- Isi akan dipopulasi via JS --}}
                                                </select>
                                                @error('kabupaten')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- Kecamatan -->
                                            <div class="mb-4">
                                                <label class="form-label" for="kecamatan_pel">Kecamatan</label>
                                                <select
                                                    id="kecamatan_pel"
                                                    name="kecamatan"
                                                    class="form-select @error('kecamatan') is-invalid @enderror"
                                                    data-selected="{{ old('kecamatan', $item->kecamatan) }}">
                                                    <option value="">-- pilih kecamatan --</option>
                                                    {{-- Isi akan dipopulasi via JS --}}
                                                </select>
                                                @error('kecamatan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <!-- <div class="mb-4">
                                                <label class="form-label">Status <span class="text-danger">*</span></label>
                                                @php $statuses = ['booking','active','isolir','suspend','inactive']; @endphp
                                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                                    @foreach ($statuses as $s)
                                                    <option value="{{ $s }}" {{ old('status', $item->status) === $s ? 'selected' : '' }}>
                                                        {{ ucfirst($s) }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div> -->

                                            @if (empty($client->foto_depan))
                                            <div class="mb-3">
                                                <label for="foto_depan" class="form-label">Upload Foto Depan Baru</label>
                                                <input type="file" name="foto_depan" id="foto_depan" class="form-control" accept="image/*">
                                            </div>
                                            @else
                                            <div class="mb-2">
                                                <label class="form-label">Foto Depan Saat Ini</label><br>
                                                <img src="{{ $client->foto_depan }}" alt="Foto Depan" class="img-thumbnail" style="max-width: 200px;">
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>






                <!-- Content wrapper -->

                <!-- / Layout page -->


                <!-- Overlay -->
                <div class="layout-overlay layout-menu-toggle"></div>

                <!-- Drag Target Area To SlideIn Menu On Small Screens -->
                <div class="drag-target"></div>

                <!-- / Layout wrapper -->




                @include('template.js.select-edit-csr')
                @include('template.js.select-odp-edit')
                @include('template.js.paket')
                @include('template.js.no-hp')
                @include('template.js.nik')
                @include('template.footer')
</body>

</html>