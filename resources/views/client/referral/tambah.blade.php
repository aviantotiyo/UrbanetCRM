@section('title', 'Daftarkan Referral')
@include('client.template.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("client.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('client.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-md-6 col-xxl-4 mb-6">

                            @if ($errors->any())
                            <div class="alert alert-danger mb-2">
                                <strong>Info:</strong>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="card h-100">
                                <div class="card-body">

                                    <h5 class="mb-2">Data Pelanggan Baru</h5>
                                    <hr />
                                    <form action="{{ route('client.referral.store') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label class="form-label">Nama sesuai KTP</label>
                                            <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">No KTP</label>
                                            <input type="text" id="nik" name="nik" class="form-control" placeholder="____.____.____.____" value="{{ old('nik') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">No Whatsapp</label>
                                            <input type="text" id="no_hp" name="no_hp" class="form-control" placeholder="62812345XXXX" value="{{ old('no_hp') }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Detail Alamat</label>
                                            <textarea name="alamat" class="form-control" required>{{ old('alamat') }}</textarea>
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

                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        <a href="{{ route('client.referral.index') }}" class="btn btn-secondary">Kembali</a>
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
    @include('client.template.footer')
    @include('template.js.nik')
    @include('template.js.no-hp')
    @include('template.js.title-case')
    @include('template.js.select-city')
</body>

</html>