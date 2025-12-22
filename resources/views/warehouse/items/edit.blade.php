@section('title', 'Edit Data Item Barang')
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
                                    <span class="h5">Edit Data Item Barang</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.warehouse_items.index') }} " class="btn btn-outline-primary">← Kembali</a>
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
                        <form method="POST" action="{{ route('admin.warehouse_items.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header">Edit Data Item Barang</h5>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="kode_barang" class="form-label">Kode Barang</label>
                                                <input type="text" class="form-control" value="{{ $item->kode_barang }}" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="nama_barang" class="form-label">Nama Barang</label>
                                                <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $item->nama_barang) }}" required>
                                                @error('nama_barang') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Kategori Item</label>
                                                <select name="category_id" class="form-select" required>
                                                    @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ old('category_id', $item->category_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->nama_kategori }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="mb-3">
                                                <label for="unit_type" class="form-label">Unit</label>
                                                <select name="unit_type" class="form-select" required>
                                                    @foreach(['unit', 'roll', 'meter', 'lainnya'] as $unit)
                                                    <option value="{{ $unit }}" {{ old('unit_type', $item->unit_type) == $unit ? 'selected' : '' }}>{{ ucfirst($unit) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="spesifikasi" class="form-label">Spesifikasi</label>
                                                <textarea name="spesifikasi" class="form-control">{{ old('spesifikasi', $item->spesifikasi) }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="barcode" class="form-label">Barcode (opsional)</label>
                                                <input type="text" name="barcode" class="form-control" value="{{ old('barcode', $item->barcode) }}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="harga_satuan" class="form-label">Harga Satuan (opsional)</label>
                                                <input type="number" name="harga_satuan" class="form-control" value="{{ old('harga_satuan', $item->harga_satuan) }}">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-12 d-flex gap-2 pt-2">
                                <button class="btn btn-primary">Simpan</button>
                                <a href="{{ route('admin.warehouse_category.index') }}" class="btn btn-outline-secondary">Batal</a>
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