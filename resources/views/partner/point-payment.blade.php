@section('title', 'Bayar Dengan Point')
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
                                                    <p class="mb-0">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>

                                        @if(!empty($item->denda) && $item->denda != 0)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Denda </h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @if(!empty($item->discount) && $item->discount != 0)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Discount </h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0">Rp {{ number_format($item->discount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach



                                        @php
                                        $totalTagihan = (($item->amount + $item->denda) - $item->discount);
                                        $poinTersedia = $client->point;
                                        $poinDigunakan = min($totalTagihan, $poinTersedia);
                                        $sisaPoin = max(0, $poinTersedia - $poinDigunakan);
                                        $sisaTagihan = $totalTagihan - $poinDigunakan;
                                        @endphp

                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Point Loyalti</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Sisa point: {{ number_format($sisaPoin, 0, ',', '.') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 text-success">{{ number_format($client->point, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>


                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Pembayaran
                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0" id="total">Rp {{ number_format($sisaTagihan , 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>

                                    <h6 class="mb-2">Ketentuan:</h6>
                                    <ul>
                                        <li>Pembayaran dengan point loyalti dari pelanggan</li>
                                        <li>Mitra hanya membantu memproses transaksi, tidak ada fee mitra</li>
                                    </ul>
                                    <hr />
                                    <form method="POST" action="{{ route('partner.process.point', $item->merchant_ref_id) }}">
                                        @csrf
                                        <input type="hidden" name="merchant_ref_id" value="{{ $item->merchant_ref_id }}">
                                        <input type="hidden" name="sisa_poin" value="{{ $sisaPoin }}">
                                        <input type="hidden" name="sisa_tagihan" value="{{ $sisaTagihan }}">
                                        <input type="hidden" name="poin_digunakan" value="{{ $poinDigunakan }}">
                                        <input type="hidden" name="partner_auth_id" value="{{ session('partner_auth_id') }}">
                                        <button type="submit" class="btn btn-primary w-100">Bayar Dengan Point</button>
                                    </form>


                                    <!-- <p class="mb-0" id="total">
                                        Total Tagihan: Rp {{ number_format($totalTagihan, 0, ',', '.') }} <br>
                                        Poin Digunakan: Rp {{ number_format($poinDigunakan, 0, ',', '.') }} <br>
                                        Sisa Poin: Rp {{ number_format($sisaPoin, 0, ',', '.') }} <br>
                                        Sisa Tagihan: Rp {{ number_format($sisaTagihan , 0, ',', '.') }}
                                    </p> -->
                                </div>
                            </div>

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


    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>


    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
</body>

</html>