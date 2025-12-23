@section('title', 'Edit Stock Item Barang')
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
                                    <span class="h5">Edit Stock Barang</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <form action="{{ route('admin.warehouse_stocks.delete', $stock->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="ti ti-trash me-1"></i> Hapus
                                    </button>
                                </form>

                                <a href="{{ route('admin.warehouse_stocks.index') }}" class="btn btn-outline-primary">← Kembali</a>
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
                        <form method="POST" action="{{ route('admin.warehouse_stocks.update', $stock->id) }}">
                            @csrf
                            <div class="row g-6">
                                <div class="col-md-6">
                                    <div class="card">
                                        <h5 class="card-header">Data Stock Barang</h5>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label class="form-label">Lokasi Gudang</label>
                                                <select name="warehouse_id" class="form-select" disabled>
                                                    @foreach($warehouses as $wh)
                                                    <option value="{{ $wh->id }}" {{ (old('warehouse_id', $stock->warehouse_id ?? '') == $wh->id) ? 'selected' : '' }}>
                                                        {{ $wh->nama_gudang }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Item Barang</label>
                                                <select name="item_id" class="form-select" disabled>
                                                    @foreach($items as $item)
                                                    <option value="{{ $item->id }}" {{ (old('item_id', $stock->item_id ?? '') == $item->id) ? 'selected' : '' }}>
                                                        {{ $item->nama_barang }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Kategori Barang</label>
                                                <select name="category_id" class="form-select" disabled>
                                                    @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}" {{ (old('category_id', $stock->category_id ?? '') == $cat->id) ? 'selected' : '' }}>
                                                        {{ $cat->nama_kategori }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Stok Saat Ini</label>
                                                <input type="number" name="jumlah" class="form-control" value="{{ $stock->jumlah }}" disabled>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Tambah Stok</label>
                                                <input type="number" name="jumlah_tambah" class="form-control"
                                                    min="1"
                                                    placeholder="Masukkan jumlah penambahan stok">
                                                <small class="text-muted">* Stok hanya bisa ditambah, tidak bisa dikurangi</small>
                                            </div>



                                            <div class="mb-3" class="form-label">
                                                <label>Kode Rak</label>
                                                <input type="text" name="kode_rak" class="form-control" value="{{ old('kode_rak', $stock->kode_rak ?? '') }}">
                                            </div>
                                            <input type="hidden" name="warehouse_id" value="{{ old('warehouse_id', $stock->warehouse_id ?? '') }}">
                                            <input type="hidden" name="item_id" value="{{ old('item_id', $stock->item_id ?? '') }}">
                                            <input type="hidden" name="category_id" value="{{ old('category_id', $stock->category_id ?? '') }}">
                                            <input type="hidden" name="jumlah" value="{{ old('jumlah', $stock->jumlah ?? '') }}">
                                            <button class="btn btn-primary">Simpan</button>
                                            <a href="{{ route('admin.warehouse_stocks.index') }}" class="btn btn-secondary">Batal</a>
                                        </div>

                                    </div>
                                </div>
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