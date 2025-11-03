@section('title', 'Dashboard Pelanggan')
@include('client.template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("client.template.sidebar")
            <!-- Layout container -->
            <div class="layout-page">
                @include('client.template.navbar')

                <!-- Content wrapper -->
                <div class="content-wrapper">
                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y ">
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
                                    <div class="bg-label-primary rounded text-center mb-4 pt-4">
                                        <img
                                            class="img-fluid"
                                            src="../../assets/img/illustrations/girl-with-laptop.png"
                                            alt="Card girl image"
                                            width="140" />
                                    </div>
                                    <h5 class="mb-2">Halo. {{ $client->nama }}</h5>
                                    <p class="small">
                                        Terimakasih saat ini anda masih menggunakan layanan internet dari Urbanet.
                                    </p>
                                    <div class="row g-3">
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-address-book ti-28px"></i></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-nowrap">{{ $client->nopel }}</h6>
                                                    <small>NoPel</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="d-flex">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-album ti-28px"></i></span>
                                                </div>
                                                <div>
                                                    <h6 class="mb-0 text-nowrap">{{ $client->paket }}</h6>
                                                    <small>Paket</small>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    <h5 class="mb-1">Daftar Tagihan</h5>
                                    <ul class="p-0 m-0">
                                        @forelse ($unpaidBillings as $billing)
                                        @foreach ($billing->items as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Tagihan {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</h6>
                                                    <small class="text-body d-block">{{ $billing->merchant_ref }}</small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @empty
                                        <p class="text-muted">Tidak ada tagihan.</p>
                                        @endforelse
                                    </ul>


                                </div>
                                @if($unpaidBillings->isNotEmpty())
                                <div class="card-body">
                                    <a href="{{ route('client.paywithpoint') }}" class="btn btn-primary w-100">Bayar Tagihan</a>
                                </div>
                                @endif
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