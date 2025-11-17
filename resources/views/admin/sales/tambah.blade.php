@section('title', 'Tambah Prospek Pelanggan')
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
                                    <span class="h5">Sales Prospek</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">

                                <a href="{{ route('admin.sales.index') }}" class="btn btn-outline-secondary">Kembali</a>

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
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {!! session('error') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif


                        <div class="card">
                            <h5 class="card-header">Data Calon Pelanggan</h5>
                            <div class="card-body">
                                <div class="col-12">
                                    <form method="POST" action="{{ route('admin.sales.store') }}">
                                        @csrf

                                        {{-- Nama --}}
                                        <div class="col-12 col-md-4 col-12 col-md-4 mb-3">
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
                                        <div class="col-12 col-md-4 col-12 col-md-4 mb-3">
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
                                        <div class="col-12 col-md-4 col-12 col-md-4 mb-3">
                                            <label for="no_hp" class="form-label">No Whatsapp<span class="text-danger">*</span></label>
                                            <input name="no_hp" id="no_hp"
                                                class="form-control @error('no_hp') is-invalid @enderror"
                                                value="{{ old('no_hp') }}">
                                            @error('no_hp')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Email --}}
                                        <div class="col-12 col-md-4 col-12 col-md-4 mb-3">
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
                                        <div class="col-12 col-md-4 col-12 col-md-4 mb-3">
                                            <label for="alamat" class="form-label">Alamat<span class="text-danger">*</span></label>
                                            <textarea name="alamat" id="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                            @error('alamat')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12 col-md-4 col-12 col-md-4 mb-3">
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

                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label" for="kabupaten_pel">Kabupaten/Kota<span class="text-danger">*</span></label>
                                            <select id="kabupaten_pel" name="kabupaten" class="form-select @error('kabupaten') is-invalid @enderror">
                                                <option value="">-- pilih kabupaten/kota --</option>
                                            </select>
                                            @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 col-md-4 mb-3">
                                            <label class="form-label" for="kecamatan_pel">Kecamatan<span class="text-danger">*</span></label>
                                            <select id="kecamatan_pel" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror">
                                                <option value="">-- pilih kecamatan --</option>
                                            </select>
                                            @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>


                                        {{-- Paket --}}
                                        <div class="col-12 col-md-4 col-12 col-md-4 mb-3">
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

                                        <button class="btn btn-primary mt-2">Simpan Data Pelanggan</button>
                                    </form>
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

    @include('template.js.select-city')
    @include('template.js.nik')
    @include('template.js.title-case')
    @include('template.js.no-hp')

</body>

</html>