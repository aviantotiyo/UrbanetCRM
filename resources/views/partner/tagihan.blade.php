@section('title', 'Atur Pembayaran')
@include('client.template.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            @include("client.template.sidebar")

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
                                    @foreach ($billings as $billing)
                                    <ul class="p-0 m-0 mb-4 list-unstyled">
                                        @foreach ($billingItems->where('merchant_ref_id', $billing->merchant_ref) as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Tagihan {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ $billing->merchant_ref }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 amount">Rp {{ number_format($item->amount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach

                                        @if($item->denda)
                                        @foreach ($billingItems->where('merchant_ref_id', $billing->merchant_ref) as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Denda</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 denda">Rp {{ number_format($item->denda, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif

                                        @if($item->discount)
                                        @foreach ($billingItems->where('merchant_ref_id', $billing->merchant_ref) as $item)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Discount</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        {{ \Carbon\Carbon::parse($item->billing_cycle)->format('m/Y') }}
                                                    </small>

                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 text-success discount">Rp {{ number_format($item->discount, 0, ',', '.') }}</p>

                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                        @endif

                                        @if($client->point)
                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Point</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Loyalti Pelanggan
                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0 text-success" id="client-point">{{ number_format($client->point, 0, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        @endif

                                        <li class="d-flex mb-2">
                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">Total</h6>
                                                    <small class="text-body d-block" id="bank-fee-label">
                                                        Pembayaran
                                                    </small>
                                                </div>
                                                <div class="user-progress d-flex align-items-center gap-1">
                                                    <p class="mb-0" id="total">Rp </p>
                                                </div>
                                            </div>
                                        </li>

                                    </ul>
                                    @endforeach


                                    <h6 class="mb-2">Pilih Pembayaran</h6>
                                    <hr />
                                    <form method="POST" action="{{ route('partner.process.submit', $billing->merchant_ref) }}">
                                        @csrf

                                        <!-- <input type="text" class="form-control" value="{{ $billing->merchant_ref }}" readonly> -->
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
                                        <input type="hidden" name="total" id="hidden-total">
                                        <input type="hidden" name="client_point" id="hidden-client-point">
                                        <input type="hidden" name="merchant_ref" value="{{ $billing->merchant_ref }}">
                                        <div class="mt-4">
                                            <button type="submit" class="btn btn-primary w-100">Proses Tagihan</button>
                                        </div>
                                    </form>
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


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function parseRupiah(rpText) {
                return parseInt(rpText.replace(/[^\d]/g, '')) || 0;
            }

            let totalAmount = 0;
            let totalDenda = 0;
            let totalDiscount = 0;

            document.querySelectorAll('.amount').forEach(el => {
                totalAmount += parseRupiah(el.innerText);
            });

            document.querySelectorAll('.denda').forEach(el => {
                totalDenda += parseRupiah(el.innerText);
            });

            document.querySelectorAll('.discount').forEach(el => {
                totalDiscount += parseRupiah(el.innerText);
            });

            const point = parseRupiah(document.getElementById('client-point')?.innerText || '0');
            const totalFinal = (totalAmount + totalDenda) - totalDiscount - point;

            const formatRupiah = new Intl.NumberFormat('id-ID').format(totalFinal);

            document.getElementById('total').innerText = 'Rp ' + formatRupiah;
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Ambil nilai total & point dari halaman sebelumnya
            const totalText = document.getElementById('total')?.innerText || '0';
            const pointText = document.getElementById('client-point')?.innerText || '0';

            const total = parseInt(totalText.replace(/[^\d]/g, '')) || 0;
            const point = parseInt(pointText.replace(/[^\d]/g, '')) || 0;

            // Isi hidden input
            document.getElementById('hidden-total').value = total;
            document.getElementById('hidden-client-point').value = point;
        });
    </script>

    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>


    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
</body>

</html>