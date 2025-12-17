@section('title', 'Edit Data Warehouse')
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
                                    <span class="h5">Edit Data Gudang</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.dashboard_warehouse.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                        <form method="POST" action="{{ route('admin.dashboard_warehouse.update', $gudang->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header">Data Pelanggan</h5>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="kode_gudang" class="form-label">Kode Gudang</label>
                                                <input type="text" name="kode_gudang" class="form-control" value="{{ old('kode_gudang', $gudang->kode_gudang) }}" required disabled readonly>
                                                @error('kode_gudang') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_gudang" class="form-label">Nama Gudang</label>
                                                <input type="text" name="nama_gudang" class="form-control" value="{{ old('nama_gudang', $gudang->nama_gudang) }}" required>
                                                @error('nama_gudang') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="lokasi" class="form-label">Lokasi (Opsional)</label>
                                                <textarea name="lokasi" class="form-control">{{ old('lokasi', $gudang->lokasi) }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="jenis" class="form-label">Jenis Gudang</label>
                                                <select name="jenis" class="form-select" required>
                                                    <option value="internal" {{ old('jenis', $gudang->jenis) == 'internal' ? 'selected' : '' }}>Internal</option>
                                                    <option value="personal" {{ old('jenis', $gudang->jenis) == 'personal' ? 'selected' : '' }}>Personal</option>
                                                </select>
                                                @error('jenis') <div class="text-danger">{{ $message }}</div> @enderror
                                            </div>

                                        </div>


                                    </div>
                                </div>

                                <div class="col-12 d-flex gap-2 pt-2">
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="{{ route('admin.dashboard_warehouse.index') }}" class="btn btn-outline-secondary">Batal</a>
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
    @include('template.js.title-case')

</body>

</html>