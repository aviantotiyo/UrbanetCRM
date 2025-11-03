@section('title', 'Daftar Transaksi')
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
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <div class="col-md-6 col-xxl-4 mb-6">
                            <div class="card h-100">
                                <div class="card-body">

                                    <h5 class="mb-2">Daftar Tagihan</h5>
                                    <hr />
                                    @if($billings->isEmpty())
                                    <p>Tidak ada transaksi ditemukan.</p>
                                    @else
                                    <ul class="list-group">
                                        @foreach ($billings as $billing)
                                        @foreach ($billing->items as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0"><a href="{{ route('client.transaksi.show',  $billing->merchant_ref)  }}">
                                                            Tagihan {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</a></h6>
                                                    <small class="text-body d-block">{{ $billing->merchant_ref }}</small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">Rp {{ number_format($item->amount, 0, ',', '.') }} <span class="badge rounded-pill bg-label-primary">{{ $billing->status }}</span></p>
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endforeach
                                    </ul>
                                    @endif

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