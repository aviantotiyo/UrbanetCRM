@section('title', 'Detail Tagihan Pelanggan')
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
                                    <span class="h5">Detail Data Tagihan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <a href="{{ route('admin.billing.index') }}" class="btn btn-outline-primary">← Kembali</a>

                            </div>
                        </div>

                        {{-- Alert error --}}
                        @if ($errors->any())
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                            <strong>Periksa input!</strong>
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="row g-6">
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Data Tagihan</h5>
                                    <div class="card-body">
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">No. Pelanggan (NoPel)</div>
                                                <div class="fw-semibold">{{ $billing->client->nopel ?? '-' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Nama</div>
                                                <div class="fw-semibold">{{ $billing->client->nama ?? '-' }}</div>
                                            </div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Email</div>
                                                <div class="fw-semibold">{{ $billing->client->email ?? '-' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">No HP</div>
                                                <div class="fw-semibold">{{ $billing->client->no_hp ?? '-' }}</div>
                                            </div>
                                        </div>

                                        <hr class="mb-3">
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Merchant Ref</div>
                                                <div class="fw-semibold">{{ $billing->merchant_ref }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Status</div>
                                                <div class="fw-semibold">{{ $billing->status }}</div>
                                            </div>
                                        </div>
                                        <hr class="mb-3">
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Metode Pembayaran</div>
                                                <div class="fw-semibold">{{ $billing->payment_method ?? '-' }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Chanel Pembayaran</div>
                                                <div class="fw-semibold">{{ $billing->payment_name ?? '-' }}</div>
                                            </div>
                                        </div>
                                        <hr class="mb-3">
                                        <div class="row g-3">
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Total Pembayaran</div>
                                                <div class="fw-semibold">Rp {{ number_format($billing->total_amount, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Pembayaran Diterima</div>
                                                <div class="fw-semibold">Rp {{ number_format($billing->amount_received, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Pembayaran Setelah Pajak</div>
                                                <div class="fw-semibold">Rp {{ number_format($billing->after_tax, 0, ',', '.') }}</div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="text-muted small">Ppn</div>
                                                <div class="fw-semibold">Rp {{ number_format($billing->tax, 0, ',', '.') }}</div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <h5 class="card-header">Data Item Tagihan</h5>
                                    <div class="card-body">
                                        <div class="row g-3">

                                            @forelse ($billing->items as $item)
                                            <hr />
                                            <dl class="row mb-0 gx-2">
                                                <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Paket</dt>
                                                <dd class="col-sm-9">{{ $item->name }}</dd>
                                                <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Tagihan</dt>
                                                <dd class="col-sm-9">Rp {{ number_format($item->amount, 0, ',', '.') }}</dd>
                                                <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Periode</dt>
                                                <dd class="col-sm-9">{{ $item->billing_cycle->format('m/Y') }}</dd>
                                                <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Denda</dt>
                                                <dd class="col-sm-9">Rp {{ number_format($item->denda, 0, ',', '.') }}</dd>
                                                <dt class="col-sm-3 mb-sm-2 text-nowrap fw-medium text-heading">Discount</dt>
                                                <dd class="col-sm-9">Rp {{ number_format($item->discount, 0, ',', '.') }}</dd>
                                            </dl>

                                            @empty
                                            <p class="text-muted">Tidak ada item tagihan.</p>
                                            @endforelse

                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-12 d-flex gap-2 pt-2">
                                    <button class="btn btn-primary">Simpan</button>
                                    <a href="#" class="btn btn-outline-secondary">Batal</a>
                                </div> -->

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

</body>

</html>