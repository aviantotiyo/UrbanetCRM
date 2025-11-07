@section('title', 'Edit Data Registrasi Pelanggan')
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
                                    <span class="h5">Tambah Data Pelanggan</span>
                                </div>

                            </div>


                            <div class="d-flex align-content-center flex-wrap gap-2">

                                <a href="{{ route('admin.userregist.index') }}" class="btn btn-outline-primary">← Kembali</a>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('admin.userregist.update', $regist->id) }}" enctype="multipart/form-data" novalidate>
                            @csrf
                            {{-- @method('POST')  <-- Tidak perlu jika rute update memang POST. Jika pakai PUT/PATCH, gunakan: @method('PUT') --}}
                            <div class="row">
                                <div class="col-md-6">
                                    @if (session('success'))
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif

                                    @if ($errors->has('status'))
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        {{ $errors->first('status') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                    @endif
                                    <div class="card">
                                        <h5 class="card-header">Data Pelanggan</h5>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <label class="form-label">Name <span class="text-danger">*</span></label>
                                                <input type="text" name="nama" value="{{ old('nama', $regist->nama) }}" class="form-control" required>
                                                @error('nama')<div class=" invalid-feedback">{{ $message }}
                                                </div>@enderror
                                                <div class="form-text">Nama sesuai KTP.</div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">NIK</label>
                                                <input id="nik" name="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                                    value="{{ old('nik', $regist->nik) }}" placeholder="____.____.____.____" required>
                                                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">No HP</label>
                                                <input id="no_hp" name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                    value="{{ old('no_hp', $regist->no_hp) }}" placeholder="628xxxxxxxxxx" required>
                                                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Email</label>
                                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $regist->email) }}">
                                                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Alamat</label>
                                                <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                    value="{{ old('alamat', $regist->alamat) }}" placeholder="" required>
                                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="provinsi_pel">Provinsi</label>
                                                <input type="text" name="provinsi" value="{{ old('provinsi', $regist->provinsi) }}" class="form-control" required>
                                                @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="kabupaten_pel">Kabupaten/Kota</label>
                                                <input type="text" name="kabupaten" value="{{ old('kabupaten', $regist->kabupaten) }}" class="form-control" required>
                                                @error('kabupaten')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="kecamatan_pel">Kecamatan</label>
                                                <input type="text" name="kecamatan" value="{{ old('kecamatan', $regist->kecamatan) }}" class="form-control" required>
                                                @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Paket</label>
                                                <select name="paket_id" class="form-select" required>
                                                    @foreach($paketList as $paket)
                                                    <option value="{{ $paket->id }}" {{ old('paket_id', $regist->paket_id) == $paket->id ? 'selected' : '' }}>
                                                        {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select" required>
                                                    <option value="pending" {{ $regist->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="process" {{ $regist->status === 'process' ? 'selected' : '' }}>Process</option>
                                                    <option value="rejected" {{ $regist->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <button class="btn btn-primary">Update</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header">Data Pelengkap Registrasi</h5>
                                        <div class="card-body">
                                            <div class="mb-4">
                                                <label class="form-label">Note:</label>
                                                <ul>
                                                    <li>Pastikan posisi alamat rumah dalam jangkauan ODP</li>
                                                    <li>Validasi dahulu data ini sudah benar, NIK, Nama KTP, No WA. </li>
                                                    <li>Minta data pelengkap share lock rumah </li>
                                                    <li>Minta data pelengkap foto dengan rumah </li>
                                                    <li>Minta data pelengkap email (bila ada) </li>
                                                    <li>Setelah itu baru lanjutkan ke status "Process"</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <!-- Content wrapper -->

            <!-- / Layout page -->


            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>

            <!-- Drag Target Area To SlideIn Menu On Small Screens -->
            <div class="drag-target"></div>

            <!-- / Layout wrapper -->


            @include('template.js.no-hp')
            @include('template.js.nik')
            @include('template.footer')
</body>

</html>