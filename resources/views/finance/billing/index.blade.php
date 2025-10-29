@section('title', 'Data Billing')
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
                                    <span class="h5">Data Billing Pelanggan</span>
                                </div>

                            </div>
                            <div class="d-flex align-content-center flex-wrap gap-2">
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



                        <div class="card">

                            <h5 class="card-header">Data Tagihan Pelanggan</h5>
                            <div class="table-responsive text-nowrap">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Inv</th>
                                            <th>NoPel</th>
                                            <th>Nama Tagihan</th>
                                            <th>Total</th>
                                            <th>Denda</th>
                                            <th>Tagihan</th>
                                            <th>user</th>
                                            <th>Status</th>
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
                                                        <small>{{ \Carbon\Carbon::parse($billing->created_at)->format('d/m/Y') }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap align-items-center mb-50">
                                                    <div>
                                                        <p class="mb-0 small fw-medium">{{ $billing->client->nama ?? '-' }}</p>
                                                        <small>{{ $billing->client->nopel ?? '-' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $item->name ?? '-' }}</td>
                                            <td>Rp {{ number_format((float) $item->amount, 0, ',', '.') }}</td>
                                            <td>Rp {{ number_format((float) $item->denda, 0, ',', '.') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</td>
                                            <td>
                                                <span class="badge {{ $billing->client->status === 'active' ? 'text-bg-primary' : 'text-bg-secondary' }}">
                                                    {{ $billing->client->status }}
                                                </span>
                                            </td>
                                            <td>{{ $billing->status }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="{{ route('admin.billing.detail', $billing->id) }}"><i class="ti ti-search me-1"></i> Detail Billing</a>
                                                            <a class="dropdown-item" href="{{ route('admin.pelanggan.show',  $billing->client->id) }}"><i class="ti ti-user me-1"></i> Detail User</a>
                                                            @auth
                                                            @if(in_array(auth()->user()->role, ['Admin', 'Finance']))
                                                            @if($billing->status === 'UNPAID')
                                                            <a class="dropdown-item text-success"
                                                                href="{{ route('admin.billing.pay', $billing->id) }}"
                                                                onclick="return confirm('Tandai tagihan ini sebagai sudah dibayar secara manual?')">
                                                                <i class="ti ti-check me-1"></i> Bayar
                                                            </a>
                                                            @endif
                                                            @endif
                                                            @endauth
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