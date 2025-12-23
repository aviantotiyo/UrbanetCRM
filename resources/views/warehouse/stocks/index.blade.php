@section('title', 'Persediaan Barang')
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
                                    <span class="h5">Persediaan Barang</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.warehouse_stocks.create') }}" class="btn btn-outline-primary">Tambah Data</a>
                            </div>
                        </div>
                        {{-- Alert sukses --}}
                        @if (session('success'))
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            {!! session('success') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        {{-- (Opsional) Alert error umum --}}
                        @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                        @endif



                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="GET" class="row g-3 mb-3 align-items-end">
                                    <div class="col-md-3">
                                        <label class="form-label">Gudang</label>
                                        <select name="warehouse_id" class="form-select">
                                            <option value="">Semua Gudang</option>
                                            @foreach($warehouses as $wh)
                                            <option value="{{ $wh->id }}" {{ request('warehouse_id') == $wh->id ? 'selected' : '' }}>
                                                {{ $wh->nama_gudang }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Kategori</label>
                                        <select name="category_id" class="form-select">
                                            <option value="">Semua Kategori</option>
                                            @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->nama_kategori }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <label class="form-label">Cari Nama Barang</label>
                                        <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Nama barang...">
                                    </div>

                                    <!-- <div class="col-md-1">
                                        <button type="submit" class="btn btn-outline-success w-100">Excel</button>
                                    </div> -->
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="card">
                            <h5 class="card-header">Data Persediaan Barang</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Warehouse</th>
                                            <th>Item</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Kode Rak</th>
                                            <th>Update</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="table-border-bottom-0">
                                        @foreach ($stocks as $stock)
                                        <tr>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">
                                                            {{ $stock->warehouse->nama_gudang ?? '-' }}

                                                        </p>
                                                        <small> {{ $stock->warehouse->kode_gudang ?? '-' }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $stock->item->nama_barang ?? '-' }}</td>
                                            <td>{{ $stock->category->nama_kategori ?? '-' }}</td>
                                            <td>{{ $stock->jumlah }}</td>
                                            <td>{{ $stock->kode_rak ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($stock->updated_at)->format('d/m/Y H:i') }} WIB</td>
                                            <td>
                                                <a href="{{ route('admin.warehouse_stocks.edit', $stock->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                                <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                    {{-- Links pagination --}}
                                    {{ $stocks->links() }}
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

    @include('template.footer')

</body>

</html>