@section('title', 'Bayar Dengan Point')
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

                                    <h5 class="mb-2">Bayar Tagihan Dengan Point</h5>
                                    <hr />
                                    <form method="POST" action="{{ route('client.billing.redeempoint') }}">
                                        @csrf
                                        <ul class="p-0 m-0 mb-4 list-unstyled">
                                            @forelse ($unpaidBillings as $billing)
                                            @foreach ($billing->items as $item)
                                            <li class="d-flex mb-3 border-bottom pb-2">
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Tagihan {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</h6>
                                                        <small class="text-body d-block">{{ $billing->merchant_ref }}</small>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <p class="mb-0" data-type="amount">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            @empty
                                            <li class="text-muted text-center">Tidak ada tagihan yang belum dibayar.</li>
                                            @endforelse

                                            @forelse ($unpaidBillings as $billing)
                                            @foreach ($billing->items as $item)
                                            @if ($item->denda > 0)
                                            <li class="d-flex mb-3 border-bottom pb-2">
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Denda</h6>
                                                        <small class="text-body d-block">{{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</small>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <p class="mb-0" data-type="denda">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                            @empty
                                            @endforelse


                                            @forelse ($unpaidBillings as $billing)
                                            @foreach ($billing->items as $item)
                                            @if ($item->discount > 0)
                                            <li class="d-flex mb-3 border-bottom pb-2">
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Discount</h6>
                                                        <small class="text-body d-block">{{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</small>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <p class="mb-0 text-success" data-type="discount">Rp {{ number_format($item->discount, 0, ',', '.') }}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                            @empty
                                            @endforelse

                                            @if ($client->point > 0)
                                            <li class="d-flex mb-3 border-bottom pb-2">
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Loyalti Point</h6>
                                                        <small class="text-body d-block" id="sisaPointLabel">Sisa point</small>
                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <!-- Ubah ini agar bisa dimanipulasi oleh JS -->
                                                        <p class="mb-0 text-success" id="pointUsedLabel">0</p>

                                                    </div>
                                                </div>
                                            </li>
                                            @endif


                                            <li class="d-flex mb-2">
                                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                    <div class="me-2">
                                                        <h6 class="mb-0">Total Bayar</h6>
                                                        <small class="text-body d-block" id="bank-fee-label">
                                                            Tagihan perlu dibayar
                                                        </small>

                                                    </div>
                                                    <div class="user-progress d-flex align-items-center gap-1">
                                                        <p class="mb-0" id="totalPayment">Menghitung...</p>

                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <input type="hidden" name="merchant_ref" value="{{ $billing->merchant_ref }}">
                                        <input type="hidden" name="totalPayment" id="inputTotalPayment">
                                        <input type="hidden" name="pointUsedLabel" id="inputPointUsedLabel">
                                        <input type="hidden" name="sisaPointLabel" id="inputSisaPointLabel">
                                        <input type="hidden" id="clientPoint" value="{{ $client->point }}">
                                        <div class="card-body">
                                            <button type="submit" class="btn btn-primary w-100">Bayar Tagihan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


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

        @include('client.template.calculatepoint')
        <script src="../../assets/vendor/js/bootstrap.js"></script>
        <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>


        <script src="../../assets/vendor/js/menu.js"></script>

        <!-- Main JS -->
        <script src="../../assets/js/main.js"></script>

        <!-- Page JS -->
</body>

</html>