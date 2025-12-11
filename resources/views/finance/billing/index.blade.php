@section('title', 'Data Billing')
@include('template.head')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />

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
                                    <span class="h5">Data Billing Pelanggan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
                                <a href="{{ route('admin.billing.export_excel', request()->query()) }}"
                                    class="btn btn-outline-success mb-3">
                                    <i class="ti ti-download me-1"></i> Export ke Excel
                                </a>

                                <!-- <button class="btn btn-label-primary">Tambah Pelanggan</button> -->
                                <!-- <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-outline-primary">Tambah Pelanggan</a> -->
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
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {!! session('error') !!}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="card card-body mb-4">
                            <form method="GET" action="{{ route('admin.billing.index') }}" class="mb-4">
                                <div class="row g-2 align-items-end">

                                    {{-- Keyword --}}
                                    <div class="col-md-3">
                                        <label class="form-label">Nama / NoPel / No HP (Pakai 62+No)</label>
                                        <input type="text" name="q" class="form-control" value="{{ request('q') }}" placeholder="Cari...">
                                    </div>

                                    {{-- Status Billing --}}
                                    <div class="col-md-2">
                                        <label class="form-label">Status Tagihan</label>
                                        <select name="billing_status" class="form-select">
                                            <option value="">- Semua -</option>
                                            <option value="PAID" {{ request('billing_status') == 'PAID' ? 'selected' : '' }}>PAID</option>
                                            <option value="UNPAID" {{ request('billing_status') == 'UNPAID' ? 'selected' : '' }}>UNPAID</option>
                                            <option value="EXPIRED" {{ request('billing_status') == 'EXPIRED' ? 'selected' : '' }}>EXPIRED</option>
                                            <option value="PENDING" {{ request('billing_status') == 'PENDING' ? 'selected' : '' }}>PENDING</option>
                                        </select>
                                    </div>

                                    {{-- Status Client --}}
                                    <div class="col-md-2">
                                        <label class="form-label">Status Pelanggan</label>
                                        <select name="client_status" class="form-select">
                                            <option value="">- Semua -</option>
                                            <option value="active" {{ request('client_status') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ request('client_status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                            <option value="isolir" {{ request('client_status') == 'isolir' ? 'selected' : '' }}>Isolir</option>
                                            <option value="suspend" {{ request('client_status') == 'suspend' ? 'selected' : '' }}>Suspend</option>
                                        </select>
                                    </div>

                                    {{-- Rentang Billing Cycle --}}

                                    <div class="col-md-4">
                                        <label class="form-label">Rentan Waktu</label>
                                        <input type="text" class="form-control flatpickr-input active"
                                            placeholder="YYYY-MM-DD to YYYY-MM-DD" id="flatpickr-range"
                                            value="{{ request('billing_range') }}"
                                            name="billing_range"
                                            readonly="readonly">
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                                    </div>
                                </div>
                            </form>
                            <script>
                                flatpickr("#flatpickr-range", {
                                    mode: "range",
                                    dateFormat: "Y-m-d",
                                });
                            </script>

                        </div>

                        <div class="card mb-6">
                            <div class="card-header header-elements">
                                <h5 class="mb-0 me-2">Data Tagihan Pelanggan</h5>

                                <div class="card-header-elements ms-auto">

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Inv</th>
                                                <th>NoPel</th>
                                                <th>Tagihan</th>
                                                <th>Lainnya</th>
                                                <th>Periode</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="table-border-bottom-0">
                                            @forelse($billings as $billing)
                                            @foreach($billing->items as $item)
                                            <tr>
                                                <td>
                                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                                        <div>
                                                            <p class="mb-0 small fw-medium"><a href="{{ route('admin.billing.detail', $billing->id) }}">
                                                                    {{ $billing->merchant_ref }}</a></p>
                                                            <small>
                                                                <span class="badge rounded-pill {{ $billing->client->status === 'active' ? 'text-bg-primary' : 'text-bg-secondary' }}">
                                                                    {{ $billing->client->status }}
                                                                </span></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                                        <div>
                                                            <p class="mb-0 small fw-medium">
                                                                <a href="{{ route('admin.pelanggan.show',  $billing->client->id) }}">{{ $billing->client->nama ?? '-' }}</a>
                                                            </p>
                                                            <small>{{ $billing->client->nopel ?? '-' }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                                        <div>
                                                            <p class="mb-0 small fw-medium">{{ $item->name ?? '-' }}</p>
                                                            <small>Tagihan: Rp {{ number_format((float) $item->amount, 0, ',', '.') }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                                        <div>
                                                            <p class="mb-0 small fw-medium">Denda: Rp {{ number_format((float) $item->denda, 0, ',', '.') }}</p>
                                                            <small>Discount: Rp {{ number_format((float) $item->discount, 0, ',', '.') }}</small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-wrap align-items-center mb-50">
                                                        <div>
                                                            <p class="mb-0 small fw-medium">Periode: {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</p>
                                                            <small>Status: <span class="badge rounded-pill {{ $billing->status === 'PAID' ? 'text-bg-success' : 'text-bg-secondary' }}">
                                                                    {{ $billing->status }}
                                                                </span>
                                                            </small>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="dropdown">
                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                <i class="ti ti-dots-vertical"></i>
                                                            </button>
                                                            <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="{{ route('admin.billing.detail', $billing->id) }}">
                                                                    <i class="ti ti-search me-1"></i> Detail Billing
                                                                </a>
                                                                <a class="dropdown-item" href="{{ route('admin.pelanggan.show',  $billing->client->id) }}">
                                                                    <i class="ti ti-user me-1"></i> Detail User
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                            @endforeach
                                            @empty
                                            <tr>
                                                <td colspan="5" class="text-center">Belum ada data billing</td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    <div class="card-footer bg-white d-flex justify-content-between align-items-center flex-wrap gap-2">
                                        {{-- Links pagination --}}
                                        {{ $billings->links() }}

                                    </div>
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
    <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('assets/js/forms-pickers.js') }}"></script>
    @include('template.footer')

</body>

</html>