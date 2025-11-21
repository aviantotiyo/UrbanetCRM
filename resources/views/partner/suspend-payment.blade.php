@section('title', 'Pilih Pembayaran')
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
                    <div class="container-xxl flex-grow-1 container-p-y ">
                        <div class="col-md-6 col-xxl-4 mb-6">

                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="mb-2">Detail Tagihan</h6>
                                    <hr />
                                    <ul class="p-0 m-0 mb-4 list-unstyled">
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $client->nama }}</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ $client->nopel }} | {{ $client->paket }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0"><span class="badge rounded-pill bg-label-primary">{{ $client->status }}</span></p>

                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <hr />

                                    <ul class="p-0 m-0 mb-4 list-unstyled">
                                        @php
                                        $totalAmount = 0;
                                        $totalDenda = 0;
                                        $totalDiscount = 0;

                                        foreach ($billingItems as $item) {
                                        $totalAmount += $item->amount ?? 0;
                                        $totalDenda += $item->denda ?? 0;
                                        $totalDiscount += $item->discount ?? 0;
                                        }

                                        $totalPembayaran = ($totalAmount + $totalDenda) - $totalDiscount;
                                        @endphp

                                        @foreach ($billingItems as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Tagihan {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ $item->merchant_ref_id }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 amount">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach


                                        @foreach ($billingItems as $item)
                                        @if (!is_null($item->denda) && $item->denda != 0)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Denda</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 amount">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach


                                        @foreach ($billingItems as $item)
                                        @if (!is_null($item->discount) && $item->discount != 0)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Discount</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 amount text-success">Rp {{ number_format($item->discount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach


                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Pembayaran
                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0" id="total">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>



                                    <h6 class="mb-2">Pilih Pembayaran</h6>
                                    <hr />
                                    <form method="POST" action="{{ route('partner.user_suspend.paymentprocess', ['merchant_ref' => $billing->merchant_ref]) }}">
                                        @csrf
                                        <input type="hidden" name="total_amount" value="{{ $totalPembayaran }}">
                                        <div class="list-group">
                                            <label class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="bank" value="BCA" checked required>
                                                Bank BCA
                                            </label>
                                            <label class="list-group-item">
                                                <input class="form-check-input me-1" type="radio" name="bank" value="BRI" required>
                                                Bank BRI
                                            </label>
                                        </div>

                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-100">Proses Tagihan</button>
                                        </div>
                                    </form>
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
            @include('template.js.no-hp')

</body>

</html>