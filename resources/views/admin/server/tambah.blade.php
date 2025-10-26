@section('title', 'Tambah Server')
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
                                    <span class="h5">Tambah Data Server(POP)</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.server.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                                <form method="POST" action="{{ route('admin.server.store') }}" novalidate>
                                    @csrf
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label">Nama POP <span class="text-danger">*</span></label>
                                            <input name="nama_pop" class="form-control @error('nama_pop') is-invalid @enderror"
                                                value="{{ old('nama_pop') }}" required>
                                            @error('nama_pop')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Lokasi</label>
                                            <input name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
                                                value="{{ old('lokasi') }}" placeholder="Alamat/Deskripsi lokasi">
                                            @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">IP Public</label>
                                            <input name="ip_public" class="form-control @error('ip_public') is-invalid @enderror"
                                                value="{{ old('ip_public') }}" placeholder="x.x.x.x">
                                            @error('ip_public')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">IP Static</label>
                                            <input name="ip_static" class="form-control @error('ip_static') is-invalid @enderror"
                                                value="{{ old('ip_static') }}" placeholder="x.x.x.x">
                                            @error('ip_static')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">User <span class="text-danger">*</span></label>
                                            <input name="user" class="form-control @error('user') is-invalid @enderror"
                                                value="{{ old('user') }}" required>
                                            @error('user')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label class="form-label">Password <span class="text-danger">*</span></label>
                                            <input name="password" type="text"
                                                class="form-control @error('password') is-invalid @enderror"
                                                value="{{ old('password') }}" required>
                                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>

                                        <div class="col-12 d-flex gap-2 pt-2">
                                            <button class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('admin.server.index') }}" class="btn btn-outline-secondary">Batal</a>
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