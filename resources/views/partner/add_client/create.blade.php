@section('title', 'Registrasi Pelanggan')
@include('client.template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("partner.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('partner.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y ">
                        <div class="col-md-6 col-xxl-4 mb-6">

                            <div class="card h-100">
                                <div class="card-body">


                                    @if ($errors->any())
                                    <div class="alert alert-primary">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif
                                    <h6 class="mb-2">Data Pelanggan Baru</h6>
                                    <form method="POST" action="{{ route('partner.add_client.store') }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama Lengkap<span class="text-danger">*</span></label>
                                            <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama') }}" required>
                                            @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            <div class="form-text">Harus sesuai KTP.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nik" class="form-label">No KTP<span class="text-danger">*</span></label>
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                value="{{ old('nik') }}" placeholder="____.____.____.____" required>
                                            <!-- @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror -->

                                        </div>

                                        <div class="mb-3">
                                            <label for="no_hp" class="form-label">Nomor HP<span class="text-danger">*</span></label>
                                            <input type="text" name="no_hp" id="no_hp" class="form-control"
                                                value="{{ old('no_hp') }}" placeholder="6281122334455" required>
                                            <!-- @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror -->

                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email (Opsional)</label>
                                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                                value="{{ old('email') }}">
                                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="alamat" class="form-label">Alamat Lengkap<span class="text-danger">*</span></label>
                                            <input name="alamat" id="nama" class="form-control @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat') }}" required>
                                            @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>


                                        <div class="mb-3">
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

                                        <div class="mb-3">
                                            <label class="form-label" for="kabupaten_pel">Kabupaten/Kota<span class="text-danger">*</span></label>
                                            <select id="kabupaten_pel" name="kabupaten" class="form-select @error('kabupaten') is-invalid @enderror">
                                                <option value="">-- pilih kabupaten/kota --</option>
                                            </select>
                                            @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="kecamatan_pel">Kecamatan<span class="text-danger">*</span></label>
                                            <select id="kecamatan_pel" name="kecamatan" class="form-select @error('kecamatan') is-invalid @enderror">
                                                <option value="">-- pilih kecamatan --</option>
                                            </select>
                                            @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="paket_id" class="form-label">Pilih Paket Internet<span class="text-danger">*</span></label>
                                            <select name="paket_id" id="paket_id"
                                                class="form-select @error('paket_id') is-invalid @enderror" required>
                                                <option value="">-- Pilih Paket --</option>
                                                @foreach($paketList as $paket)
                                                <option value="{{ $paket->id }}" {{ old('paket_id') === $paket->id ? 'selected' : '' }}>
                                                    {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                                </option>
                                                @endforeach
                                            </select>
                                            @error('paket_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                </div>

                                <div class="card-body">
                                    <!-- <button type="submit" class="btn btn-primary px-5 w-100">Kirim Registrasi</button> -->
                                    <button type="submit" class="btn btn-primary px-5 w-100" id="submitBtn">
                                        <span class="spinner-border spinner-border-sm me-2 d-none" role="status" aria-hidden="true" id="spinner"></span>
                                        Kirim Registrasi
                                    </button>

                                </div>
                                </form>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submitBtn');
            const spinner = document.getElementById('spinner');

            form.addEventListener('submit', function() {
                submitBtn.disabled = true;
                spinner.classList.remove('d-none');
            });
        });
    </script>

    @include('template.js.select-city')
    @include('client.template.footer')
    @include('template.js.nik')
    @include('template.js.title-case')
    @include('template.js.no-hp')
</body>

</html>