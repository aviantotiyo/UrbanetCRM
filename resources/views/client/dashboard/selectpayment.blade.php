@section('title', 'Pilih Pembayaran')
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
                                    @php
                                    $amountTotal = 0;

                                    foreach ($unpaidBillings as $billing) {
                                    foreach ($billing->items as $item) {
                                    $amountTotal += $item->amount + $item->denda - $item->discount;
                                    }
                                    }

                                    $amountTotal -= $client->point;

                                    // Admin bank misalnya Rp 4.500
                                    $adminFee = 4500;
                                    $finalTotal = $amountTotal + $adminFee;
                                    @endphp

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
                                                    <p class="mb-0">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
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
                                                    <p class="mb-0 ">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>
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
                                                    <p class="mb-0 text-success">Rp {{ number_format($item->discount, 0, ',', '.') }}</p>
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
                                                    <small class="text-body d-block">potongan point</small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 text-success" id="pointDisplay">Rp 0</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endif


                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total Bayar</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        admin bank Rp {{ number_format($channels[0]['total_fee']['flat'] + ($amountTotal * ($channels[0]['total_fee']['percent'] / 100)), 0, ',', '.') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0" id="totalDisplay">Menghitung...</p>
                                                    <!-- <p class="mb-0 fw-semibold" id="final-total">Rp {{ number_format($finalTotal, 0, ',', '.') }}</p> -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>


                                    <form action="{{ route('billing.payment.process', ['id' => $billing->merchant_ref]) }}" method="GET">

                                        <h5 class="mb-2">Pilih Pembayaran</h5>
                                        <div class="demo-inline-spacing mt-4">
                                            <div class="list-group">
                                                @foreach ($channels as $channel)
                                                <label class="list-group-item d-flex align-items-center">
                                                    <input
                                                        class="form-check-input me-2 payment-option"
                                                        type="radio"
                                                        name="method"
                                                        value="{{ $channel['code'] }}"
                                                        data-flat="{{ $channel['total_fee']['flat'] }}"
                                                        data-percent="{{ $channel['total_fee']['percent'] }}"
                                                        {{ $loop->first ? 'checked' : '' }}
                                                        required>
                                                    <div class="d-flex align-items-center">
                                                        <img src="{{ $channel['icon_url'] }}" alt="{{ $channel['name'] }}" width="28" class="me-3">
                                                        <span>{{ $channel['name'] }}</span>
                                                    </div>
                                                </label>
                                                @endforeach

                                            </div>

                                        </div>
                                </div>

                                <input type="hidden" name="flat" id="flatFee">
                                <input type="hidden" name="percent" id="percentFee">
                                <input type="hidden" name="point_used" id="pointUsed">
                                <div class="card-body">
                                    <button type="submit" class="btn btn-primary w-100">Bayar Tagihan</button>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- / Content -->
                    <!-- @if (!empty($response))
                    <div class="card my-4">
                        <div class="card-header">
                            <strong>Debug Response JSON dari Tripay</strong>
                        </div>
                        <div class="card-body">
                            <pre>{{ print_r(json_decode($response, true), true) }}</pre>
                        </div>
                    </div>
                    @endif -->


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


    @include('client.template.count')
    <!-- @include('client.template.calculatepoint') -->
    @include('client.template.select')

    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>


    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
</body>

</html>