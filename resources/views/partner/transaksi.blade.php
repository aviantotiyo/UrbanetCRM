@section('title', 'Daftar Transaksi Mitra')
@include('client.template.head')
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("partner.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('partner.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-md-6 col-xxl-4 mb-6">
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
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="mb-2">Daftar Pembayaran Tagihan</h5>
                                    <hr />
                                    <ul class="list-group">
                                        @forelse($billings as $index => $billing)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">
                                                        <a href="{{ route('partner.payment.detail', ['merchant_ref' => $billing->merchant_ref]) }}">
                                                            {{ $billing->client->nama ?? '-' }}
                                                        </a>
                                                    </h6>
                                                    <small class="text-body d-block">{{ $billing->merchant_ref }} | {{ $billing->created_at->format('m/Y') }}</small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">
                                                        Rp {{ number_format($billing->total_amount, 0, ',', '.') }}
                                                        <span class="badge rounded-pill bg-label-primary">{{ $billing->status }}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        @empty
                                        <p>Belum ada transaksi.</p>
                                        @endforelse
                                    </ul>

                                    {{-- Tambahkan ini di bawah daftar --}}
                                    <div class="mt-3">
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
    @include('client.template.footer')

</body>

</html>