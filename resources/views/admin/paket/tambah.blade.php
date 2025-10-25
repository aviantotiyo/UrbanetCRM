@section('title', 'Tambah Data Layanan')
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
                                    <span class="h5">Tambah Data Layanan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.paket.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                        <!-- <div class="row g-6"> -->
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.paket.store') }}" novalidate>
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama Paket <span class="text-danger">*</span></label>
                                            <input name="nama_paket" class="form-control @error('nama_paket') is-invalid @enderror"
                                                value="{{ old('nama_paket') }}" required>
                                            @error('nama_paket')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Harga <span class="text-danger">*</span></label>
                                            <input name="harga" class="form-control @error('harga') is-invalid @enderror"
                                                value="{{ old('harga') }}" required placeholder="250000">
                                            @error('harga')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Name Profile</label>
                                            <input name="name_profile" class="form-control @error('name_profile') is-invalid @enderror"
                                                value="{{ old('name_profile') }}" placeholder="home-20m / biz-50m">
                                            @error('name_profile')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Limit Radius</label>
                                            <input name="limit_radius" class="form-control @error('limit_radius') is-invalid @enderror"
                                                value="{{ old('limit_radius') }}" placeholder="512k/512k">
                                            @error('limit_radius')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-block">Aktifkan Paket</label>
                                            @php $oldActive = old('active','1'); @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="active" id="active1" value="1" {{ $oldActive==='1'?'checked':'' }}>
                                                <label class="form-check-label" for="active1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="active" id="active0" value="0" {{ $oldActive==='0'?'checked':'' }}>
                                                <label class="form-check-label" for="active0">Tidak</label>
                                            </div>
                                            @error('active')<div class="text-danger small">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label d-block">Tayang di UI?</label>
                                            @php $oldTayang = old('tayang','1'); @endphp
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tayang" id="tayang1" value="1" {{ $oldTayang==='1'?'checked':'' }}>
                                                <label class="form-check-label" for="tayang1">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="tayang" id="tayang0" value="0" {{ $oldTayang==='0'?'checked':'' }}>
                                                <label class="form-check-label" for="tayang0">Tidak</label>
                                            </div>
                                            @error('tayang')<div class="text-danger small">{{ $message }}</div>@enderror
                                        </div>


                                        <div class="col-12">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="deskripsi" rows="3" class="form-control @error('deskripsi') is-invalid @enderror"
                                                placeholder="Catatan paket...">{{ old('deskripsi') }}</textarea>
                                            @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 d-flex gap-2 pt-2">
                                            <button class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('admin.paket.index') }}" class="btn btn-outline-secondary">Batal</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- </div> -->

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
</body>

</html>