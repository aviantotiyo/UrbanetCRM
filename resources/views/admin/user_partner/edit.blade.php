@section('title', 'Edit Data Pelanggan Dari Mitra')
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
                                    <span class="h5">Proses/Edit Data Pelanggan</span>
                                </div>

                            </div>


                            <div class="d-flex align-content-center flex-wrap gap-2">

                                <a href="{{ route('admin.list-prospek-mitra.user_partner.index') }}" class="btn btn-outline-primary">← Kembali</a>
                            </div>
                        </div>






                        <form id="client-edit-form" method="POST" action="{{ route('admin.list-prospek-mitra.user_partner.update', $prospect->id) }}" enctype="multipart/form-data" novalidate>
                            @csrf

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
                                                <input name="nama" type="text" class="form-control @error('nama') is-invalid @enderror"
                                                    value="{{ old('nama', $prospect->nama) }}" required data-titlecase>
                                                @error('nama')<div class=" invalid-feedback">{{ $message }}
                                                </div>@enderror
                                                <div class="form-text">Nama sesuai KTP.</div>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">NIK</label>
                                                <input id="nik" name="nik" type="text" class="form-control @error('nik') is-invalid @enderror"
                                                    value="{{ old('nik', $prospect->nik) }}" placeholder="____.____.____.____">
                                                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Email (Opsional)</label>
                                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email', $prospect->email) }}">
                                                @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">No HP</label>
                                                <input id="no_hp" name="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                                    value="{{ old('no_hp', $prospect->no_hp) }}" placeholder="628xxxxxxxxxx">
                                                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label">Alamat</label>
                                                <input name="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                                                    value="{{ old('alamat', $prospect->alamat) }}" placeholder="">
                                                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="provinsi_pel">Provinsi</label>
                                                <select id="provinsi_pel" name="provinsi" class="form-select @error('provinsi') is-invalid @enderror">
                                                    <option value="">-- pilih provinsi --</option>
                                                    @foreach(($provinsiRaw ?? []) as $p)
                                                    <option value="{{ $p['name'] }}" data-id="{{ $p['id'] }}"
                                                        {{ old('provinsi', $prospect->provinsi) === $p['name'] ? 'selected' : '' }}>
                                                        {{ $p['name'] }}
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
                                                <label class="form-label">Paket</label>
                                                <select name="paket_id" class="form-select" required>
                                                    @foreach($paketList as $paket)
                                                    <option value="{{ $paket->id }}" {{ old('paket_id', $prospect->paket_id) == $paket->id ? 'selected' : '' }}>
                                                        {{ $paket->nama_paket }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @auth
                                            @if(in_array(auth()->user()->role, ['Admin', 'Finance', 'AdminCust', ]))
                                            <div class="mb-4">
                                                <label class="form-label">Status</label>
                                                <select name="status" class="form-select">
                                                    <option value="pending" {{ old('status', $prospect->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="process" {{ old('status', $prospect->status) == 'process' ? 'selected' : '' }}>Process</option>
                                                    <option value="reject" {{ old('status', $prospect->status) == 'reject' ? 'selected' : '' }}>Rejected</option>
                                                </select>
                                            </div>
                                            @endif
                                            @endauth

                                            <div class="mb-4">
                                                <button class="btn btn-primary" @if($prospect->status === 'active' || $prospect->status === 'process') disabled @endif>Update</button>
                                                <a href="{{ route('admin.list-prospek-mitra.user_partner.index') }}" class="btn btn-outline-secondary">Kembali</a>
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


            @include('template.js.edit-kota-referral')

            @include('template.js.no-hp')
            @include('template.js.nik')
            @include('template.footer')
</body>

</html>