@section('title', 'Registrasi Pelanggan')
@include('client.template.head')
@include('client.template.recaptcha')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->
                <div class="col-md-6 col-xxl-4 mb-6">
                    <nav
                        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                        id="layout-navbar">
                        <a href="index.html" class="app-brand-link">
                            <span class="app-brand-logo demo">
                                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="#7367F0" />
                                    <path
                                        opacity="0.06"
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616" />
                                    <path
                                        opacity="0.06"
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616" />
                                    <path
                                        fill-rule="evenodd"
                                        clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="#7367F0" />
                                </svg>
                            </span>
                            <span class="app-brand-text demo menu-text fw-bold">Urbanet</span>
                        </a>

                    </nav>
                </div>
                <!-- / Navbar -->

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

                                    <form method="POST" action="{{ route('client.regist.store') }}">
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
                                                value="{{ old('no_hp') }}" required>
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
                                        <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
                                        <!-- <div class="d-flex justify-content-center mt-4">
                                            <button type="submit" class="btn btn-primary px-5">Kirim Registrasi</button>
                                        </div> -->

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