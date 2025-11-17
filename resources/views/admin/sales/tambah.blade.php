@section('title', 'Tambah Data Pelanggan')
@include('template.head')
<!-- <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" /> -->

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
                                    <span class="h5">Tambah Data Prospek Pelanggan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.sales.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                        <form method="POST" action="{{ route('admin.sales.store') }}">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header">Data Pelanggan</h5>
                                        <div class="card-body">
                                            {{-- Nama --}}
                                            <div class=" mb-3">
                                                <label for="nama" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                                <input name="nama" id="nama"
                                                    class="form-control @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama') }}" required>
                                                @error('nama')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Harus sesuai KTP.</div>
                                            </div>

                                            {{-- NIK --}}
                                            <div class=" mb-3">
                                                <label for="nik" class="form-label">NIK<span class="text-danger">*</span></label>
                                                <input name="nik" id="nik"
                                                    class="form-control @error('nik') is-invalid @enderror"
                                                    value="{{ old('nik') }}"
                                                    placeholder="____.____.____.____">
                                                @error('nik')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- No HP --}}
                                            <div class=" mb-3">
                                                <label for="no_hp" class="form-label">No Whatsapp<span class="text-danger">*</span></label>
                                                <input name="no_hp" id="no_hp"
                                                    class="form-control @error('no_hp') is-invalid @enderror"
                                                    value="{{ old('no_hp') }}">
                                                @error('no_hp')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            {{-- Email --}}
                                            <div class=" mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input name="email" id="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}">
                                                @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">Opsional</div>
                                            </div>

                                            {{-- Alamat --}}
                                            <div class=" mb-3">
                                                <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                                                <textarea name="alamat" id="alamat"
                                                    class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                                @error('alamat')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class=" mb-3">
                                                <label class="form-label" for="provinsi_pel">Provinsi<span class="text-danger">*</span></label>
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

                                            <div class=" mb-3">
                                                <label class="form-label" for="kabupaten_pel">Kabupaten/Kota<span class="text-danger">*</span></label>
                                                <select id="kabupaten_pel" name="kabupaten" class="form-select @error('kabupaten') is-invalid @enderror">
                                                    <option value="">-- pilih kabupaten/kota --</option>
                                                </select>
                                                @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class=" mb-3">
                                                <label class="form-label" for="kecamatan_pel">Kecamatan<span class="text-danger">*</span></label>
                                                <select id="kecamatan_pel" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror">
                                                    <option value="">-- pilih kecamatan --</option>
                                                </select>
                                                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            {{-- Paket --}}
                                            <div class="mb-3">
                                                <label for="paket_id" class="form-label">Paket</label>
                                                <select name="paket_id" id="paket_id"
                                                    class="form-select @error('paket_id') is-invalid @enderror" required>
                                                    @foreach($paketList as $paket)
                                                    <option value="{{ $paket->id }}"
                                                        {{ old('paket_id') == $paket->id ? 'selected' : '' }}>
                                                        {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                @error('paket_id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header">Data Pelengkap</h5>
                                        <div class="card-body">
                                            {{-- No HP --}}
                                            <div class=" mb-3">
                                                <label for="loc_client" class="form-label">Lokasi Client (Link Gmap)</label>
                                                <input name="loc_client" id="loc_client"
                                                    class="form-control @error('loc_client') is-invalid @enderror"
                                                    value="{{ old('loc_client') }}">
                                                @error('loc_client')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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


                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 d-flex gap-2 pt-2">
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.sales.index') }}" class="btn btn-outline-secondary">Batal</a>
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

    @include('template.footer')

    @include('template.js.select-city')
    @include('template.js.nik')
    @include('template.js.title-case')
    @include('template.js.no-hp')
</body>

</html>